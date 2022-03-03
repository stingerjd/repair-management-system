<script type="text/javascript" src="<?=$assets;?>plugins/renderjson.js"></script>
<script type="text/javascript">
function jsonFormatter(json) {
    json = (json[8]);
    return renderjson(JSON.parse(json));
}
    
function actionValue(x) {
    x = x.split('___');
    if (x.length == 3) {
        amount = "";
        if (x[1] > 0) {
            amount = " +" + x[1] + " From " + x[2];
        }else{
            amount = " " +  x[1] + " From " + x[2];
        }
        return x[0] + amount;
    }
    return x[0];
}

function link_id(x) {
    x = x.split('___');
    return x[1];
}
var table;
$(document).ready(function() {
    var datatableInit = function() {
        var $table = $('#dynamic-table');
        table = $table.DataTable({
            "aaSorting": [[5, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": <?=$settings->rows_per_page;?>,
            'bProcessing': false, 'bServerSide': true,
            'sAjaxSource': '<?=base_url(); ?>panel/log/getLog',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });

                aoData.push({
                    "name": "sRangeSeparator2",
                    "value": "-yadcf_delim-"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            }, 
            "createdRow": function( row, data, dataIndex){
                if (data[9]) {
                    if (data[10] == 'update' || data[10] == 'return-sale') {
                        color = 'warning';
                    }else if (data[10] == 'add' ) {
                        color = 'success';
                    }else if (data[10] == 'delete' ) {
                        color = 'danger';
                    }
                    
                    if(data[9] > 0){
                        $(row).addClass(color);
                    }else{
                        $(row).addClass(color);
                    }
                }
            },
            "aoColumns": [
                {
                    "width": '20px',
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { 
                    width: '70px',
                    mRender: actionValue,
                },
                { width: '70px'},
                { 
                    width: '70px',
                    mRender: link_id,

                },
                { width: '70px'},
                { width: '70px',
                    mRender: fld,
                },
                { width: '70px'},
                // { width: '70px'},
            ],
        });
    };

       
    datatableInit();
    // Add event listener for opening and closing details
    $('#dynamic-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( jsonFormatter(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
    $('.yadcf-filter-range').addClass('form-control');
    $('.yadcf-filter-range').addClass('width_100');
} );
</script>

<script type="text/javascript" src="<?=$assets;?>plugins/yadcf/jquery.dataTables.yadcf.js"></script>
<style type="text/css">
.renderjson {
    text-align: left;
}
    td.details-control {
        background: url('<?=$assets;?>dist/img/details_open.png') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('<?=$assets;?>dist/img/details_close.png') no-repeat center center;
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
   
    .table-responsive {
      overflow-y: visible !important;
    }
    .width_100{
        width: 100% !important;
    }
    .external_filter_style{
        width: 100%;
        display: block;
    }
    .yadcf-filter-wrapper{
        display: block;
    }
    .yadcf-filter-wrapper-inner {
        display: flex;
        border: none;
        /* border: 1px solid #ABADB3; */
    }
</style>

<section class="box">
    <div class="box-body">
            <div class="table-responsive">
                <table class="table table-responsive-md table-striped mb-0" id="dynamic-table">
                    <thead>
                        <th></th>
                        <th><?= lang('log_action'); ?></th>
                        <th><?= lang('log_model'); ?></th>
                        <th><?= lang('log_link_id'); ?></th>
                        <th><?= lang('log_user_id'); ?></th>
                        <th><?= lang('log_timestamp'); ?></th>
                        <th><?= lang('log_ip_addr'); ?></th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function scrollToTable() {
        $('html, body').animate({
            scrollTop: $("#dynamic-table").offset().top
        }, 500);
    }
</script>