
<script>
    $(document).ready(function () {

       $('body').on('click', '.bpo', function(e) {
            e.preventDefault();
            $(this).popover({html: true, trigger: 'manual'}).popover('toggle');
            return false;
        });
        $('body').on('click', '.bpo-close', function(e) {
            $('.bpo').popover('hide');
            return false;
        });


    //      $("#example1").DataTable({
    // 
    //   
    // })


        var oTable = $('#dynamic-table').DataTable({
            "aaSorting": [[3, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": <?=$settings->rows_per_page; ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?=base_url(); ?>panel/customers/getAllCustomers',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            }, 
              "responsive": true,  "autoWidth": false,
            "aoColumns": [
            {"bSortable": false, "mRender": checkbox}, 
            null,
            null,
            null,
            null,
            null,
            null,
            {mRender: formatMyDecimal},
            null
            ],
            dom: 'lBfrtip',

            "buttons": [{
                extend: 'colvis',
                collectionLayout: 'fixed two-column'
            }],

            language: {
                buttons: {
                    colvis: 'Change columns'
                }
            },
            stateSave: true,
            "stateSaveParams": function (settings, data) {
                data.search.search = "";
                data.yadcfState = "";
                $.each(data.columns, function() { 
                    this.search.search = '';
                });
            },
            
            "stateSaveCallback": function (settings, data) {
                $.ajax({
                    "url": '<?=base_url(); ?>panel/misc/state_save',
                    "data": {state: JSON.stringify(data), table:'clients'},
                    "dataType": "json",
                    "type": "POST",
                    "success": function () {
                    }
                });
            },
            'stateLoadCallback': function (settings) {
                var o;
                $.ajax ({
                    'url': '<?=base_url(); ?>panel/misc/load_state',
                    "data": {table:'clients'},
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
        });
    });

    jQuery(document).on("click", "#view_image", function (e) {
        e.preventDefault();
        image_name = $(this).data('num');
        if (image_name) {
            showImage('<?=base_url();?>assets/uploads/images/'+image_name);
        }else{
            bootbox.alert({
                message: '<?=lang('client_no_image');?>',
                backdrop: true
            });
        }
    });



    jQuery(document).on("click", "#delete_client", function () {
        var num = jQuery(this).data("num");
        bootbox.confirm({
            message: "Are you sure!",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm'
                }
            },
            callback: function (result) {
                if (result) {
                    jQuery.ajax({
                        type: "POST",
                        url: base_url + "panel/customers/delete",
                        data: "id=" + encodeURI(num),
                        cache: false,
                        dataType: "json",
                        success: function (data) {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "progressBar": true,
                                "positionClass": "toast-bottom-right",
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr['success']("<?= lang('deleted'); ?>: ", "<?= lang('client_deleted'); ?>");
                            $('#dynamic-table').DataTable().ajax.reload();
                        }
                    });

                }
            }
        });
        
    });
</script>

<?php if($this->Admin || $GP['customers-add']): ?>
    <button href="#clientmodal" class="add_c btn btn-primary">
        <i class="fa fa-plus-circle"></i> <?= lang('add'); ?> <?= lang('client_title'); ?>
    </button>
<?php endif; ?>


<!-- Main content -->
<?php echo form_open('panel/customers/customer_actions', 'id="action-form"'); ?>



<div class="row">
  <div class="col-12">
    <div class="card">

    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3"><?= lang('customers/index'); ?></h3>
        <ul class="nav nav-pills ml-auto p-2">
            <li class="dropdown dropleft">
                    <div class="btn-group dropleft" style="list-style-type: none;">
                        <a data-toggle="dropdown" class="dropdown-toggle btn-round btn btn-default" href="#" >
                            <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i> 
                        </a>
                        <ul class="dropdown-menu  tasks-menus" role="menu" aria-labelledby="dLabel">
                            
                            <a class="dropdown-item" href="<?=base_url();?>panel/customers/export_csv">
                                <i class="fas fa-file-excel"></i> <?= lang('export_to_excel') ?>
                            </a>
                        
                            <a class="dropdown-item" href="#" id="excel" data-action="export_pdf">
                                <i class="fas fa-file-pdf"></i> <?= lang('export_to_pdf') ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('panel/customers/import_csv'); ?>" data-toggle="modal" data-target="#myModal">
                                <i class="fas fa-file-excel"></i> <?= lang("import_customers_by_csv"); ?>
                            </a>
                            <a href="#" class="bpo dropdown-item" title="<b><?= lang("delete_selected") ?></b>" data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn-icon btn btn-danger' id='delete' data-action='delete'><i class='fas fa-trash img-circle text-danger'></i> <?= lang('i_m_sure') ?></a> <button class='btn bpo-close btn-default btn-icon'><i class='fas fa-trash img-circle text-muted'></i> <?= lang('no') ?></button>"  data-html="true" data-placement="left">
                                <i class="fas fa-trash "></i> <?= lang('delete_selected') ?>
                            </a>

                        </ul>
                    </div>
            </li>
        </ul>
    </div>
      <div class="card-body">

                <table id="dynamic-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="min-width:30px; width: 30px; text-align: center;">
                        <input class="checkbox checkth" type="checkbox" name="check"/>
                    </th>
                    <th><?= lang('client_name'); ?></th>
                    <th><?= lang('client_company'); ?></th>
                    <th><?= lang('client_address'); ?></th>
                    <th><?= lang('client_email'); ?></th>
                    <th><?= lang('client_telephone'); ?></th>
                    <th><?= lang('total_repairs'); ?></th>
                    <th><?= lang('total_spent'); ?></th>
                    <th><?= lang('actions'); ?></th>
                </tr>
            </thead>
    
            <tfoot>
                <tr>
                    <th style="min-width:30px; width: 30px; text-align: center;">
                        <input class="checkbox checkft" type="checkbox" name="check"/>
                    </th>
                    <th><?= lang('client_name'); ?></th>
                    <th><?= lang('client_company'); ?></th>
                    <th><?= lang('client_address'); ?></th>
                    <th><?= lang('client_email'); ?></th>
                    <th><?= lang('client_telephone'); ?></th>
                    <th><?= lang('total_repairs'); ?></th>
                    <th><?= lang('total_spent'); ?></th>
                    <th><?= lang('actions'); ?></th>
                </tr>
            </tfoot>
        </table>
        <div style="display: none;">
            <input type="hidden" name="form_action" value="" id="form_action"/>
            <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
        </div>


      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->


<?= form_close() ?>
    
<script type="text/javascript">

    if (getUrlVars()["id"]) {
        find_client(getUrlVars()["id"]);
        $('#view_client').modal('show');
    }

    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
            vars[key] = value;
        });
        return vars;
    }
</script>