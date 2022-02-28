<link rel="stylesheet" type="text/css" href="<?= $assets ?>plugins/datatables/ext/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?= $assets ?>plugins/datatables/ext/buttons.dataTables.min.css">
<script type="text/javascript" src="<?= $assets ?>plugins/datatables/ext/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?= $assets ?>plugins/datatables/ext/jszip.min.js"></script>
<script type="text/javascript" src="<?= $assets ?>plugins/datatables/ext/pdfmake.min.js"></script>
<script type="text/javascript" src="<?= $assets ?>plugins/datatables/ext/vfs_fonts.js"></script>
<script type="text/javascript" src="<?= $assets ?>plugins/datatables/ext/buttons.html5.min.js"></script>
<?php
$v = "";
if ($this->input->post('date_range')) {
    $dr = explode(' - ', $this->input->post('date_range'));
    $v .= "&start_date=" . $this->repairer->fsd($dr[0]);
    $v .= "&end_date=" . $this->repairer->fsd($dr[1]);
}
?>

<script type="text/javascript">
    function pqFormat(x) {
        if (x != null) {
            var d = '', pqc = x.split("___");
            for (index = 0; index < pqc.length; ++index) {
                var pq = pqc[index];
                var v = pq.split("__");
                d += v[0]+'<br>';
            }
            return d;
        } else {
            return '';
        }
    }


    jQuery(document).on("click", "#email_invoice", function() {
        num = $(this).attr('data-num');
        email = $(this).attr('data-email');
        if(email !== '') {
            $.ajax({
                type: "post",
                url: "<?= base_url('panel/pos/email_receipt') ?>",
                data: {email: email, id: num},
                dataType: "json",
                success: function (data) {
                    toastr.success(data.msg);
                },
                error: function () {
                    toastr.error("<?= lang('ajax_request_failed'); ?>");
                    return false;
                }
            });
        }else{
            bootbox.prompt({
                title: "Enter Email Address",
                inputType: 'email',
                value: "",
                callback: function (email_addr) {
                    if (email_addr != null) {
                        $.ajax({
                            type: "post",
                            url: "<?= base_url('panel/pos/email_receipt') ?>",
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
        }
        return false;
    });


    function formatToMoney(x) {
        return formatMoney(x);
    }
    function getFormattedDate(date){
        var dd = date.getDate();
        var mm = date.getMonth()+1;
        var yyyy = date.getFullYear();
        return mm +'/'+dd+'/'+yyyy;
    }

    $(document).ready(function () {

        $('.date').datepicker({ dateFormat: 'mm-dd-yy' });
        var oTable = $('#dynamic-table').dataTable({
            "aaSorting": [[0, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= base_url('panel/reports/getAllSales/?v=1' . $v) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            }, 
            "aoColumns": [
            null,
            null,
            null,
            {mRender: pqFormat},
            {mRender: formatToMoney},
            {mRender: formatToMoney},
            {mRender: formatToMoney},
            {mRender: formatToMoney},
            {mRender: formatToMoney},
            {"mRender": pay_status}, 
            null,
            ],
            dom: 'lfrtip',
            // buttons: [{
            //     extend: 'excelHtml5',
            //     exportOptions: {
            //       columns: ':not(:last-child)',
            //     },
            //     text: '<?= lang('excel');?>',
            // }, {
            //     extend: 'pdfHtml5',
            //     orientation: 'landscape',
            //     pageSize: 'A4',
            //     exportOptions: {
            //         columns: ':not(:last-child)',
            //     },
            //     text: '<?= lang('pdf');?>',
            // }],
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var subtotal = 0, tax = 0;
                var gtotal = 0, paid = 0, balance = 0;
                for (var i = 0; i < aaData.length; i++) {
                    subtotal += parseFloat(aaData[aiDisplay[i]][4]);
                    tax += parseFloat(aaData[aiDisplay[i]][5]);
                    gtotal += parseFloat(aaData[aiDisplay[i]][6]);
                    paid += parseFloat(aaData[aiDisplay[i]][7]);
                    balance += parseFloat(aaData[aiDisplay[i]][8]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[4].innerHTML = formatMoney(parseFloat(subtotal));
                nCells[5].innerHTML = formatMoney(parseFloat(tax));
                nCells[6].innerHTML = formatMoney(parseFloat(gtotal));
                nCells[7].innerHTML = formatMoney(parseFloat(paid));
                nCells[8].innerHTML = formatMoney(parseFloat(balance));
            }
        });
    });



var lang = {paid: '<?=lang('paid');?>', pending: '<?=lang('pending');?>', completed: '<?=lang('completed');?>', ordered: '<?=lang('ordered');?>', received: '<?=lang('received');?>', partial: '<?=lang('partial');?>', sent: '<?=lang('sent');?>', r_u_sure: '<?=lang('r_u_sure');?>', due: '<?=lang('due');?>', returned: '<?=lang('returned');?>', active: '<?=lang('active');?>', inactive: '<?=lang('inactive');?>', unexpected_value: '<?=lang('unexpected_value');?>', select_above: '<?=lang('select_above');?>', download: '<?=lang('download');?>',
    bill: '<?=lang('bill');?>',
    order: '<?=lang('order');?>',
    total: '<?=lang('total');?>',
    items: '<?=lang('items');?>',
    discount: '<?=lang('discount');?>',
    order_tax: '<?=lang('order_tax');?>',
    grand_total: '<?=lang('grand_total');?>',
    total_payable: '<?=lang('total_payable');?>',
    rounding: '<?=lang('rounding');?>',
    merchant_copy: '<?=lang('merchant_copy');?>',
    not_in_stock: '<?=lang('not_in_stock');?>',
    no_tax: '<?=lang('no_tax');?>',
    remove: '<?= lang('remove') ?>',
    edit: '<?= lang('edit') ?>',
    comment: '<?= lang('comment') ?>',
    password: '<?= lang('password') ?>',
    pin_code: '<?= lang('pin_code') ?>'
};

function pay_status(x) {


    if(x == null) {
        return '';
    } else if(x == 'pending') {
        return '<div class="text-center"><span class="payment_status badge badge-warning">'+lang[x]+'</span></div>';
    } else if(x == 'completed' || x == 'paid' || x == 'sent' || x == 'received') {
        return '<div class="text-center"><span class="payment_status badge badge-success">'+lang[x]+'</span></div>';
    } else if(x == 'partial' || x == 'transferring' || x == 'ordered') {
        return '<div class="text-center"><span class="payment_status badge badge-info">'+lang[x]+'</span></div>';
    } else if(x == 'due' || x == 'returned') {
        return '<div class="text-center"><span class="payment_status badge badge-danger">'+lang[x]+'</span></div>';
    } else {
        return '<div class="text-center"><span class="payment_status badge badge-default">'+x+'</span></div>';
    }
}
</script>




        <div class="row">
  <div class="col-12">
    <div class="card">

    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3"><?= lang('reports/sales'); ?></h3>
        <ul class="nav nav-pills ml-auto p-2">
            <li class="dropdown dropleft">
                    <div class="btn-group dropleft" style="list-style-type: none;">
                        <a data-toggle="dropdown" class="dropdown-toggle btn-round btn btn-default" href="#" >
                            <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i> 
                        </a>
                        <ul class="dropdown-menu  tasks-menus" role="menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" id="excel">
                                    <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                                </a>                       
                                <a class="dropdown-item" id="pdf">
                                    <i class="fa fa-file-pdf-o"></i> <?= lang('export_to_pdf') ?>
                                </a>
                        </ul>
                    </div>
            </li>
        </ul>
    </div>
      <div class="card-body">
         <?php echo form_open("panel/reports/sales"); ?>
                    <div class="form-group">
                        <?= lang('date_range', 'date_range'); ?>
                        <input class="form-control" type="text" name="date_range" class="date_range" id="date_range" value='<?= set_value('date_range'); ?>'>
                    </div>

                    <div class="form-group">
                        <div
                            class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
                    </div>
                    <?php echo form_close(); ?>
                    
             <table style="width: 100%;" class=" compact table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th><?= lang('sale_id'); ?></th>
                                <th><?= lang('date'); ?></th>
                                <th><?= lang('customer'); ?></th>
                                <th><?= lang('items'); ?></th>
                                <th><?= lang('subtotal'); ?></th>
                                <th><?= lang('tax'); ?></th>
                                <th><?= lang('total'); ?></th>
                                <th><?= lang('paid'); ?></th>
                                <th><?= lang('balance'); ?></th>
                                <th><?= lang('payment_status'); ?></th>
                                <th><?= lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><?= lang('sale_id'); ?></th>
                                <th><?= lang('date'); ?></th>
                                <th><?= lang('customer'); ?></th>
                                <th><?= lang('items'); ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?= lang('payment_status'); ?></th>
                                <th><?= lang('actions'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
      </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#pdf').click(function (event) {
            event.preventDefault();
            window.location.href = "<?=site_url('panel/reports/getAllSales/pdf/?v=1'.$v)?>";
            return false;
        });
        $('#xls').click(function (event) {
            event.preventDefault();
            window.location.href = "<?=site_url('panel/reports/getAllSales/0/xls/?v=1'.$v)?>";
            return false;
        });
        
        $('#date_range').daterangepicker({
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
        });

    });
</script>