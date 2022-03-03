<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?= lang('reparation'); ?></h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="fa">&times;</i>
        </button>
    </div>
    <div class="modal-body">
        <script>
             $('#view-repars-table').dataTable({
                "aaSorting": [[3, "asc"]],
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "iDisplayLength": <?=$settings->rows_per_page; ?>,
                'bProcessing': true, 'bServerSide': true,
                'sAjaxSource': '<?=base_url(); ?>panel/reparation/getAllReparations/<?=$id;?>',
                'fnServerData': function (sSource, aoData, fnCallback) {
                    aoData.push({
                        "name": "<?= $this->security->get_csrf_token_name() ?>",
                        "value": "<?= $this->security->get_csrf_hash() ?>"
                    });
                    $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
                }, 
                "aoColumns": [
                    {"mRender": reparationID_link},
                    null,
                    null,
                    null,
                    null,
                    {"mRender": status},
                    null,
                    {"mRender": update_by},
                    {"mRender": formatMyDecimal},
                ],
                 "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                    var subtotal = 0;
                    for (var i = 0; i < aaData.length; i++) {
                        subtotal += parseFloat(aaData[aiDisplay[i]][8]);
                    }
                    var nCells = nRow.getElementsByTagName('th');
                    nCells[8].innerHTML = formatMoney(parseFloat(subtotal));
                }
            });
        </script>
        <!-- Main content -->
        <div class="modal-body">
            <div class="table-responsive">
                <table class="display compact table table-bordered table-striped" id="view-repars-table">
                    <thead>
                        <tr>
                            <th><?= lang('reparation_code'); ?></th>
                            <th><?= lang('reparation_imei'); ?></th>
                            <th><?= lang('reparation_defect'); ?></th>
                            <th><?= lang('reparation_model'); ?></th>
                            <th><?= lang('reparation_opened_at'); ?></th>
                            <th><?= lang('reparation_status'); ?></th>
                            <th><?= lang('added_by'); ?></th>
                            <th><?= lang('last_modified_by'); ?></th>
                            <th><?= lang('grand_total'); ?></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><?= lang('reparation_code'); ?></th>
                            <th><?= lang('reparation_imei'); ?></th>
                            <th><?= lang('reparation_defect'); ?></th>
                            <th><?= lang('reparation_model'); ?></th>
                            <th><?= lang('reparation_opened_at'); ?></th>
                            <th><?= lang('reparation_status'); ?></th>
                            <th><?= lang('added_by'); ?></th>
                            <th><?= lang('last_modified_by'); ?></th>
                            <th><?= lang('grand_total'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>