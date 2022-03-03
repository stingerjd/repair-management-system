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

function formatToMoney(x) {
    return formatMoney(x);
}

function formatProfit(x) {
    if (x < 0) {
        return '<span class="badge badge-danger">'+formatToMoney(x)+'</span>'
    }else{
        return '<span class="badge badge-success">'+formatToMoney(x)+'</span>'
    }
}

    $(document).ready(function () {
        var tt = '';
        $('.date').datepicker({ dateFormat: 'mm-dd-yy' });
        var oTable = $('#dynamic-table').dataTable({
            "aaSorting": [[0, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('panel/reports/getDrawerReport/?v=1' . $v) ?>',
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
            null,
            null,
            null,
            ],
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[6];
                if (aData[7] == 'open') {
                    nRow.className = "register_link danger";
                }else{
                    nRow.className = "register_link success";
                }
                return nRow;
            },
            columnDefs: [
                { width: 200, targets: [4] }
            ],
        });
    });
</script>

        <div class="row">
  <div class="col-12">
    <div class="card">

    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3"><?= lang('reports/drawer'); ?></h3>
        <ul class="nav nav-pills ml-auto p-2">
            <li class="dropdown dropleft">
                    <div class="btn-group dropleft" style="list-style-type: none;">
                        <a data-toggle="dropdown" class="dropdown-toggle btn-round btn btn-default" href="#" >
                            <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i> 
                        </a>
                        <ul class="dropdown-menu  tasks-menus" role="menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#" id="xls" data-action="export_excel">
                                    <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                                </a>                       
                                <a class="dropdown-item" href="#" id="pdf" data-action="export_pdf">
                                    <i class="fa fa-file-pdf-o"></i> <?= lang('export_to_pdf') ?>
                                </a>
                        </ul>
                    </div>
            </li>
        </ul>
    </div>
      <div class="card-body">
        <?php echo form_open("panel/reports/drawer"); ?>
        <div class="form-group">
            <label>Date Range</label>
            <input class="form-control" type="text" name="date_range" class="date_range" id="date_range" value='<?= set_value('date_range'); ?>'>
        </div>

        <div class="form-group">
            <div
                class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
        </div>
        <?php echo form_close(); ?>
        
        <table class=" compact table table-bordered table-striped" id="dynamic-table">
            <thead>
                <tr>
                    <th><?= lang('opened_by'); ?></th>
                    <th><?= lang('open_time'); ?></th>
                    <th><?= lang('cash_in_hand'); ?></th>
                    <th><?= lang('closed_by'); ?></th>
                    <th><?= lang('close_time'); ?></th>
                    <th><?= lang('close_cash'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?= lang('opened_by'); ?></th>
                    <th><?= lang('open_time'); ?></th>
                    <th><?= lang('cash_in_hand'); ?></th>
                    <th><?= lang('closed_by'); ?></th>
                    <th><?= lang('close_time'); ?></th>
                    <th><?= lang('close_cash'); ?></th>
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
            window.location.href = "<?=site_url('panel/reports/getDrawerReport/pdf/?v=1'.$v)?>";
            return false;
        });
        $('#xls').click(function (event) {
            event.preventDefault();
            window.location.href = "<?=site_url('panel/reports/getDrawerReport/0/xls/?v=1'.$v)?>";
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