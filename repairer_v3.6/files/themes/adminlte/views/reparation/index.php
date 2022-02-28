
<style type="text/css">
    div.dt-buttons{
        margin-left: 10px;
    }
    .panel-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
    .select2-selection__rendered{
        text-align: left;
    }

    .select2-container--default {
        display: table!important;
        table-layout: fixed!important;
    }
    .dt-button-collection .buttons-columnVisibility:before,
    .dt-button-collection .buttons-columnVisibility.active span:before {
        display:block;
        position:absolute;
        top:1.2em;
        left:0;
        width:12px;
        height:12px;
        box-sizing:border-box;
    }

    .dt-button-collection .buttons-columnVisibility:before {
        content:' ';
        margin-top:-6px;
        margin-left:10px;
        border:1px solid black;
        border-radius:3px;
    }

    .dt-button-collection .buttons-columnVisibility.active span:before {
        content:'\2714';
        margin-top:-11px;
        margin-left:12px;
        text-align:center;
        text-shadow:1px 1px #DDD, -1px -1px #DDD, 1px -1px #DDD, -1px 1px #DDD;
    }

    .dt-button-collection .buttons-columnVisibility span {
        margin-left:20px;    
    }




    .warranty_row td:first-child {
        position: relative;
        overflow: hidden;
        width: 300px;
    }
    .warranty_row td:first-child:before {
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        background: <?= $settings->warranty_ribbon_color; ?>;
        top: -16px;
        left: -15px;
        text-align: center;
        line-height: 90px;
        transform: rotate(49deg);
    }
</style>
<script>

  var table;
var datatableInit = function(status = null) {
    if ($.fn.DataTable.isDataTable('#dynamic-table') ) {
      $('#dynamic-table').DataTable().destroy();
    }
     var oTable = $('#dynamic-table').dataTable({
            "aaSorting": [[7, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": <?=$settings->rows_per_page;?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?=base_url(); ?>panel/reparation/getAllReparations/',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });

                if(status == 'completed'){
                    aoData.push({
                        "name": "completed",
                        "value": "true"
                    });
                }
    
                <?php if($this->input->post('has_warranty')): ?>
                aoData.push({
                    "name": "has_warranty",
                    "value": "<?= $this->input->post('has_warranty');?>"
                });
                <?php endif;?>

                <?php if($this->input->post('manufacturer')): ?>
                aoData.push({
                    "name": "manufacturer",
                    "value": "<?= $this->input->post('manufacturer');?>"
                });
                <?php endif;?>

                <?php if($this->input->post('status')): ?>
                aoData.push({
                    "name": "status",
                    "value": "<?= $this->input->post('status');?>"
                });
                <?php endif;?>

                if(parseInt(status) > 0) {
                    aoData.push({
                        "name": "status",
                        "value": status
                    });
                }

                <?php if($this->input->post('start_date') && $this->input->post('end_date')): ?>
                aoData.push({
                    "name": "start_date",
                    "value": "<?= $this->input->post('start_date');?>"
                });
                aoData.push({
                    "name": "end_date",
                    "value": "<?= $this->input->post('end_date');?>"
                });
                <?php endif;?>
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            }, 
              "aoColumns": [
                null,
                null,
                {"mRender": client_name},
                null,
                null,
                null,
                null,
                {"mRender": fld},
                {"mRender": status_},
                null,
                null,
                {"mRender": update_by},
                null,
                {"mRender": formatMyDecimal},
                {"mRender": formatPayments},
                null,
            ],

            dom: 'lBfrtip',
            buttons: [
             {
                extend: 'colvis',
                collectionLayout: 'fixed two-column'
            }],
            stateSave: true,
            "stateSaveParams": function (settings, data) {
                data.search.search = "";
              },
            "stateSaveCallback": function (settings, data) {
                $.ajax({
                    "url": '<?=base_url(); ?>panel/misc/state_save',
                    "data": {state: JSON.stringify(data), table:'reparations'},
                    "dataType": "json",
                    "type": "POST",
                    "success": function () {
                    }
                });
            },
            <?php if($settings->reparation_table_state !== ''): ?>
            'stateLoadCallback': function (settings) {
                var o;
                $.ajax ({
                    'url': '<?=base_url(); ?>panel/misc/load_state',
                    "data": {table:'reparations'},
                    'async': false,
                    'dataType': 'json',
                    'success': function (json) {
                        if (undefined === json) {

                        }else{
                            o = json;
                        }
                    }
                });
                return o;
            },
            <?php endif; ?>
            "createdRow": function( row, data, dataIndex){
                x = data[8];
                warranty = data[14];
                if (warranty !== '' && warranty !== null) {
                    if (warranty !== '0') {
                        $(row).addClass('warranty_row');
                    }
                }

                if (x == 'cancelled') {
                    $('td:first', row).attr('bgcolor', '#000');
                    $('td:first', row).attr('style', 'color:#FFF;vertical-align: inherit;');
                }else{
                     x = x.split('____');
                    $('td:first', row).attr('bgcolor', x[1]);
                    $('td:first', row).attr('style', 'color:'+x[2]+';vertical-align: inherit;');
                    $('td:first', row).attr('style', 'color:'+x[2]+';vertical-align: inherit;background-color:'+x[1]+';');
                    $('td:first a', row).attr('style', 'color:'+x[2]+';vertical-align: inherit;');
                }
               
                $('td:not(:first-child)', row).attr('style', 'vertical-align: inherit;');
                $('td', row).attr('align', 'center');
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "invoice_link";
                return nRow;
            },
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var subtotal = 0;
                for (var i = 0; i < aaData.length; i++) {
                    subtotal += parseFloat(aaData[aiDisplay[i]][13]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[13].innerHTML = formatMoney(parseFloat(subtotal));
            }
        });


};


    $(document).ready(function () {

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("data-table") // activated tab
            datatableInit(target);
        });

        datatableInit();

        jQuery(document).on("click", "#print_reparation", function() {
            var num = jQuery(this).data("num");
            var tipo = jQuery(this).data("type");
            toastr['success']("<?= $this->lang->line('reparation_is_printing');?>");
            var thePopup = window.open( base_url + "panel/reparation/invoice/" + encodeURI(num) + "/" + tipo, '_blank', "width=890, height=700");
        });
        $.fn.modal.Constructor.prototype.enforceFocus = $.noop;

    });



</script>


<!-- Main content -->
    <section class="content">

<script type="text/javascript">
    $(document).ready(function () {
      $('.daterange').daterangepicker({
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: (site.dateFormats.js_sdate).toUpperCase()
        },
        // startDate: moment(),
        // endDate  : moment()
      }, function (start, end) {
            start_date = start.format('YYYY-MM-DD');
            end_date = end.format('YYYY-MM-DD');

            $('#start_date').val(start_date);
            $('#end_date').val(end_date);
      });
    });
</script>

<?=form_open();?>
<div class="card collapsed-card">
      <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title"><i class="fa-fw fa fa-plus"></i><?= lang('filter_results'); ?></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body" style="display: none;">
            <div class="form-group row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?= lang('time_period'); ?></label>
                        <input type="text" name="date" value="<?=set_value('date');?>" class="daterange form-control">
                        <input type="hidden" name="start_date" id="start_date" value="<?=set_value('start_date', date('Y-m-d'));?>">
                        <input type="hidden" name="end_date" id="end_date" value="<?=set_value('end_date', date('Y-m-d'));?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?= lang('manufacturer'); ?></label>
                        <?php 
                            $m = [];
                            $m[] = lang('please_select');
                            foreach ($manufacturers as $manufacturer){
                                $m[$manufacturer->name] = $manufacturer->name;
                            }
                        ?>
                        <?= form_dropdown('manufacturer', $m, set_value('manufacturer'), 'class="form-control" style="width:100% !important"'); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?= lang('has_warranty'); ?></label>
                        <?php $wm = array('' => lang('please_select'), '1' => lang('in_warranty'), '2' => lang('out_warranty')); ?>
                        <?= form_dropdown('has_warranty', $wm, set_value('has_warranty'), 'class="form-control" style="width:100% !important"'); ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label><?= lang('reparation_status'); ?></label>
                        <?php 

                            $st[] = lang('please_select');

                            foreach ($statuses as $status){
                            $st[$status->id] = $status->label;
                        }?>
                        <?= form_dropdown('status', $st, set_value('status'), 'class="form-control" style="width:100% !important"'); ?>
                    </div>
                </div>

            </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer" style="display: none;">
                        <input type="submit" value="<?=lang('filter_results');?>" class="btn btn-primary">
      </div>
      <!-- /.card-footer-->
    </div>

        <?=form_close();?>



        <?php if($this->Admin || $GP['repair-add']): ?>
            <button href="#reparationmodal" class="add_reparation btn btn-primary">
                <i class="fa fa-plus-circle"></i> <?= lang('add'); ?> <?= lang('reparation_title'); ?>
            </button>
        <?php endif; ?>


        <a class="pull-right btn btn-primary" href="<?=base_url();?>panel/reparation/export?<?=http_build_query($_POST);?>"><i class="fa fa-file-excel"></i></a> 
        <a class="pull-right btn btn-primary" href="<?=base_url();?>panel/reparation/export/0/1?<?=http_build_query($_POST);?>"><i class="fa fa-file-pdf"></i></a> 

        <br>
        <br>

<div class="card">
  <div class="card-header ui-sortable-handle" style="cursor: move;">
    <h3 class="card-title">
      <i class="fas fa-chart-pie mr-1"></i>
      <?=lang('repair_table');?>
    </h3>
    <div class="card-tools">
      <ul class="nav nav-pills ml-auto">
        <li class="nav-item">
          <a class="nav-link " href="#CompletedRepairs" data-table="completed" data-toggle="tab"><?=lang('completed_repairs');?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#PendingRepairs" data-table="pending" data-toggle="tab"><?=lang('pending_repairs');?></a>
        </li>

         <li class="nav-item dropdown dropleft">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Status</a>
            <div class="dropdown-menu">
                <?php foreach ($statuses as $status): ?>
                    <a data-table="<?=$status->id;?>" data-toggle="tab" class="dropdown-item" href="#"><?=$status->label;?></a>
                <?php endforeach;?>
            </div>
          </li>


      </ul>
    </div>
  </div><!-- /.card-header -->
  <div class="card-body">
    <div class="tab-content p-0">
      <div class="tab-pane active" id="PendingRepairs" style="">
        <div class="table-responsive">
                    
                        <table class="table table-bordered table-sm table-striped" id="dynamic-table">
                            <thead>
                                <tr>
                                    <th><?= lang('id'); ?></th>
                                    <th><?= lang('reparation_code'); ?></th>
                                    <th><?= lang('reparation_name'); ?></th>
                                    <th><?= lang('reparation_imei'); ?></th>
                                    <th><?= lang('client_telephone'); ?></th>
                                    <th><?= lang('reparation_defect'); ?></th>
                                    <th><?= lang('reparation_model'); ?></th>
                                    <th><?= lang('reparation_opened_at'); ?></th>
                                    <th><?= lang('reparation_status'); ?></th>
                                    <th><?= lang('assigned_to'); ?></th>
                                    <th><?= lang('added_by'); ?></th>
                                    <th><?= lang('last_modified_by'); ?></th>
                                    <th><?= lang('reparation_attachements_count'); ?></th>
                                    <th><?= lang('grand_total'); ?></th>
                                    <th><?= lang('paid'); ?></th>
                                    <th><?= lang('actions'); ?></th>
                                </tr>
                            </thead>
                    
                            <tfoot>
                                <tr>
                                     <th><?= lang('id'); ?></th>
                                    <th><?= lang('reparation_code'); ?></th>
                                    <th><?= lang('reparation_name'); ?></th>
                                    <th><?= lang('reparation_imei'); ?></th>
                                    <th><?= lang('client_telephone'); ?></th>
                                    <th><?= lang('reparation_defect'); ?></th>
                                    <th><?= lang('reparation_model'); ?></th>
                                    <th><?= lang('reparation_opened_at'); ?></th>
                                    <th><?= lang('reparation_status'); ?></th>
                                    <th><?= lang('assigned_to'); ?></th>
                                    <th><?= lang('added_by'); ?></th>
                                    <th><?= lang('last_modified_by'); ?></th>
                                    <th><?= lang('reparation_attachements_count'); ?></th>
                                    <th><?= lang('grand_total'); ?></th>
                                    <th><?= lang('paid'); ?></th>
                                    <th><?= lang('actions'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

      </div>

    </div>
  </div><!-- /.card-body -->
  </div><!-- /.card-body -->
</div>

<script type="text/javascript">
jQuery(document).on("click", ".view", function () {
    var num = jQuery(this).data("num");
    find_reparation(num);
});


jQuery(document).on("click", "#email_invoice", function() {
    num = $(this).attr('data-num');
    email = $(this).attr('data-email');

    bootbox.prompt({
        title: "Enter Email Address",
        inputType: 'email',
        value: email,
        callback: function (email_addr) {
            if (email_addr != null) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('panel/reparation/email_invoice') ?>",
                    data: {email: email_addr, id: num},
                    dataType: "json",
                    success: function (data) {
                        toastr.success(data.msg);
                    },
                    error: function () {
                        toastr.error("<?= lang('ajax_request_failed'); ?>");
                        return false;
                    }
                });
            }
        }
    });
    return false;
});

if (getUrlVars()["id"]) {
    find_reparation(getUrlVars()["id"]);
    $('#view_reparation').modal('show');
}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}

</script>
