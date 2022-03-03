<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>

    $(document).ready(function () {
        var oTable = $('#POData').dataTable({
            "aaSorting": [[1, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=lang('all')?>"]],
            "iDisplayLength": <?=$settings->rows_per_page; ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('panel/purchases/getPurchases'); ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?=$this->security->get_csrf_token_name()?>",
                    "value": "<?=$this->security->get_csrf_hash()?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [
                    {"bSortable": false,"mRender": checkbox},
                    {"mRender": fld},
                    null, 
                    null, 
                    {"mRender": row_status}, 
                    {"mRender": currencyFormat}, 
                    {"bSortable": false, "mRender": attachment}, 
                    {"bSortable": false}
                ],
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "purchase_link";
                return nRow;
            },
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var total = 0, paid = 0, balance = 0;
                for (var i = 0; i < aaData.length; i++) {
                    total   +=  parseInt(aaData[aiDisplay[i]]['5']);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[5].innerHTML = '<?= $settings->currency; ?> ' + (total);
            }
        })
    });
   
$('body').on('click', '.purchase_link td:not(:first-child, :nth-child(5), :nth-last-child(2), :last-child)', function() {


        $('#myModal .modal-dialog').load(site.base_url + 'panel/purchases/modal_view/' + $(this).parent('.purchase_link').attr('id'));
        $('#myModal').modal('show');
        //window.location.href = site.base_url + 'purchases/view/' + $(this).parent('.purchase_link').attr('id');
    });
 $('body').on('click', '.bpo', function(e) {
        e.preventDefault();
        $(this).popover({html: true, trigger: 'manual'}).popover('toggle');
        return false;
    });
    $('body').on('click', '.bpo-close', function(e) {
        $('.bpo').popover('hide');
        return false;
    });
</script>
<?php 
    echo form_open('panel/purchases/purchase_actions', 'id="action-form"');
?>



<div class="row">
  <div class="col-12">
    <div class="card">

    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3"><?= lang('purchases'); ?></h3>
        <ul class="nav nav-pills ml-auto p-2">
            <li class="dropdown dropleft">
                    <div class="btn-group dropleft" style="list-style-type: none;">
                        <a data-toggle="dropdown" class="dropdown-toggle btn-round btn btn-default" href="#" >
                            <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i> 
                        </a>
                        <ul class="dropdown-menu  tasks-menus" role="menu" aria-labelledby="dLabel">
                          <a class="dropdown-item" href="<?=site_url('panel/purchases/add')?>">
                                <i class="fas fa-plus-circle"></i> <?= lang('add_purchase'); ?>
                            </a>
                        
                        
                            <a class="dropdown-item" href="#" id="excel" data-action="export_excel">
                                <i class="fas fa-file-excel"></i> <?= lang('export_to_excel'); ?>
                            </a>
                        
                            <a class="dropdown-item" href="#" id="excel" data-action="export_pdf">
                                <i class="fas fa-file-pdf"></i> <?= lang('export_to_pdf') ?>
                            </a>
                        
                            <a class="dropdown-item" href="#" class="bpo" title="<b><?= lang('delete_purchases'); ?></b>"
                                data-content="<p><?= lang('r_u_sure'); ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure'); ?></a> <button class='btn bpo-close'><?= lang('no'); ?></button>"
                                data-html="true" data-placement="left">
                                <i class="fas fa-trash"></i> <?= lang('delete_purchases'); ?>
                            </a>
                        
                        </ul>
                    </div>
            </li>
        </ul>
    </div>
      <div class="card-body">

         <table id="POData" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-hover table-striped" width="100%">
                <thead>
                <tr class="default">
                    <th style="min-width:30px; width: 30px; text-align: center;">
                        <input class="checkbox checkft" type="checkbox" name="check"/>
                    </th>
                    <th><?= lang('date'); ?></th>
                    <th><?= lang('reference_no'); ?></th>
                    <th><?= lang('supplier'); ?></th>
                    <th><?= lang('status'); ?></th>
                    <th><?= lang('grand_total'); ?></th>
                    <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                    <th style="width:100px;"><?= lang('actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="11" class="dataTables_empty"><?=lang('loading_data_from_server');?></td>
                </tr>
                </tbody>
                <tfoot class="dtFilter">
                <tr>
                    <th style="min-width:30px; width: 30px; text-align: center;">
                        <input class="checkbox checkft" type="checkbox" name="check"/>
                    </th>
                    <th><?= lang('date'); ?></th>
                    <th><?= lang('reference_no'); ?></th>
                    <th><?= lang('supplier'); ?></th>
                    <th><?= lang('status'); ?></th>
                    <th><?= lang('grand_total'); ?></th>
                    <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                    <th style="width:100px;"><?= lang('actions'); ?></th>
                </tr>
                </tfoot>
            </table>
            
      </div>
  </div>
</div>

<div style="display: none;">
    <input type="hidden" name="form_action" value="" id="form_action"/>
    <?=form_submit('performAction', 'performAction', 'id="action-form-submit"')?>
</div>
<?=form_close()?>
