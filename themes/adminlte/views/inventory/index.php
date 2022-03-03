<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>

    var oTable;
    $(document).ready(function () {
        oTable = $('#PRData').dataTable({
            "aaSorting": [[2, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": <?=$settings->rows_per_page; ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('panel/inventory/getProducts'); ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "product_link";
                return nRow;
            },
            "aoColumns": [
                {"bSortable": false, "mRender": checkbox}, 
                 {"bSortable": false, "mRender": img_hl},
                null,
                null,
                {'mRender': currencyFormat},
                {'mRender': currencyFormat},
                {'mRender': currencyFormat},
                {'mRender': currencyFormat},
                {"bSortable": false}, 
                
            ]
        });

    });
   
   $('body').on('click', '.product_link td:not(:first-child, :nth-child(2), :last-child)', function() {
        $('#myModal .modal-dialog').load(site.base_url + 'panel/inventory/modal_view/' + $(this).parent('.product_link').attr('id'));
        $('#myModal').modal('show');
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
<?php if($this->Admin || $GP['inventory-product_actions']): ?>
    <?php echo form_open('panel/inventory/product_actions', 'id="action-form"'); ?>
<?php endif; ?>



        <div class="row">
  <div class="col-12">
    <div class="card">

    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3"><?= lang('inventory'); ?></h3>
        <ul class="nav nav-pills ml-auto p-2">
            <li class="dropdown dropleft">
                    <div class="btn-group dropleft" style="list-style-type: none;">
                        <a data-toggle="dropdown" class="dropdown-toggle btn-round btn btn-default" href="#" >
                            <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang("actions") ?>"></i> 
                        </a>
                        <ul class="dropdown-menu  tasks-menus" role="menu" aria-labelledby="dLabel">
                           
                                <a class="dropdown-item" href="<?= site_url('panel/inventory/add') ?>">
                                    <i class="fas fa-plus-circle"></i> <?= lang('add_product') ?>
                                </a>
                            
                            
                                <a class="dropdown-item" href="#" id="labelProducts" data-action="labels">
                                    <i class="fas fa-print"></i> <?= lang('print_barcode_label') ?>
                                </a>
                            
                            
                                <a class="dropdown-item" href="#" id="excel" data-action="export_excel">
                                    <i class="fas fa-file-excel"></i> <?= lang('export_to_excel') ?>
                                </a>
                            
                            
                                <a class="dropdown-item" href="#" id="excel" data-action="export_pdf">
                                    <i class="fas fa-file-pdf"></i> <?= lang('export_to_pdf') ?>
                                </a>
                            
                            
                                <a class="dropdown-item" href="<?=base_url();?>panel/inventory/import_csv">
                                    <i class="fas fa-file-excel"></i> <?= lang('import_products') ?>
                                </a>
                            
                            
                                <a href="#" class="bpo dropdown-item" title="<b><?= lang("delete_products") ?></b>"
                                    data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>"
                                    data-html="true" data-placement="left">
                                <i class="fas fa-trash"></i> <?= lang('delete_products') ?>
                                 </a>
                             
                        </ul>
                    </div>
            </li>
        </ul>
    </div>
      <div class="card-body">

                    <table id="PRData" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr class="primary">
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check"/>
                                </th>
                                <th><?= lang("image") ?></th>
                                <th><?= lang("code") ?></th>
                                <th><?= lang("name") ?></th>
                                <th><?= lang("cost") ?></th>
                                <th><?= lang("price") ?></th>
                                <th><?= lang("quantity") ?></th>
                                <th><?= lang("alert_quantity") ?></th>
                                <th style="min-width:65px; text-align:center;"><?= lang("actions") ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="11" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
                        </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check"/>
                                </th>
                                <th><?= lang("image") ?></th>
                                <th><?= lang("code") ?></th>
                                <th><?= lang("name") ?></th>
                                <th><?= lang("cost") ?></th>
                                <th><?= lang("price") ?></th>
                                <th><?= lang("quantity") ?></th>
                                <th><?= lang("alert_quantity") ?></th>
                                <th style="min-width:65px; text-align:center;"><?= lang("actions") ?></th>
                            </tr>
                        </tfoot>
                    </table>
      </div>
  </div>
</div>


    <?php if($this->Admin || $GP['inventory-product_actions']): ?>
        <div style="display: none;">
            <input type="hidden" name="form_action" value="" id="form_action"/>
            <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
        </div>
    <?php endif; ?>

    <?= form_close() ?>
