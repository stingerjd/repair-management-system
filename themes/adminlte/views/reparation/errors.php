<script>
    $(document).ready(function () {

        var oTable = $('#dynamic-table').dataTable({
            "aaSorting": [[3, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": <?=$settings->rows_per_page; ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?=base_url(); ?>panel/errors/getAllErrors',
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
            ],
        });
    });

  

    jQuery(document).on("click", "#delete_error", function () {
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
                        url: base_url + "panel/errors/delete",
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
                            toastr['success']("<?= lang('deleted'); ?>: ", "<?= lang('error_deleted'); ?>");
                            $('#dynamic-table').DataTable().ajax.reload();
                        }
                    });

                }
            }
        });
        
    });
</script>

<button href="#errormodal" class="add_error btn btn-primary">
    <i class="fa fa-plus-circle"></i> <?= lang('add'); ?> <?= lang('reparation_error'); ?>
</button>
    

    <div class="row">
  <div class="col-12">
    <div class="card">

      <!-- /.card-header -->
      <div class="card-body">
         <table class="display compact table table-bordered table-striped" id="dynamic-table">
                        <thead>
                            <tr>
                                <th><?= lang('error_defect'); ?></th>
                                <th><?= lang('error_code'); ?></th>
                                <th><?= lang('error_description'); ?></th>
                                <th><?= lang('error_reason'); ?></th>
                                <th><?= lang('actions'); ?></th>
                            </tr>
                        </thead>
                
                        <tfoot>
                            <tr>
                              
                                <th><?= lang('error_defect'); ?></th>
                                <th><?= lang('error_code'); ?></th>
                                <th><?= lang('error_description'); ?></th>
                                <th><?= lang('error_reason'); ?></th>
                                <th><?= lang('actions'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
      </div>
  </div>
</div>





<!-- ============= MODAL MODIFY CLIENTI ============= -->
<div class="modal fade" id="errormodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_error"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                        <form id="error_form" class="col s12" data-parsley-validate>
                    <div class="row">
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <?= lang('error_defect', 'error_defect'); ?>
                                    <div class="input-group">

                                         <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa  fa-link"></i></span>
                                          </div>


                                        <input id="error_defect" name="defect" type="text" class="validate form-control" required>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <?= lang('error_code', 'error_code'); ?>
                                    <div class="input-group">

                                         <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa  fa-link"></i></span>
                                          </div>

                                        <input id="error_code" name="code" type="text" class="validate form-control" required>
                                    </div>
                                   
                                </div>
                            </div>
                            
                            <div class="input-field col-lg-12">
                                <div class="form-group">
                                    <?= lang('error_description', 'error_description'); ?>
                                    <textarea class="form-control" id="error_description" name="description" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="input-field col-lg-12">
                                <div class="form-group">
                                    <?= lang('error_reason', 'error_reason'); ?>
                                    <textarea class="form-control" id="error_reason" name="reason" rows="6"></textarea>
                                </div>
                            </div>
                </div>

                        </form>
            </div>
            <div class="modal-footer" id="footerError">
                  <!--    -->
            </div>
        </div>
    </div>
</div>
</div>




<script type="text/javascript">
    jQuery(document).on("click", ".add_error", function (e) {
        $('#errormodal').modal('show');
        $('#error_form').trigger("reset");
        $('#error_form').parsley().reset();

        jQuery('#title_error').html("<?= lang('add'); ?> <?= lang('reparation_error'); ?>");
        jQuery('#footerError').html('<button data-dismiss="modal" class="pull-left btn btn-default" type="button"><i class="fa fa-reply"></i> <?= lang("go_back"); ?></button><button role="button" form="error_form" id="error_submit" class="btn btn-success" data-mode="add"><i class="fa fa-user"></i> <?= lang("add"); ?> <?= lang("reparation_error"); ?></button>');
    });

    jQuery(document).on("click", "#modify_error", function () {
            jQuery('#title_error').html('<?= lang('edit'); ?> <?= lang('reparation_error'); ?>');
            var num = jQuery(this).data("num");
            $('#error_form').trigger("reset");
            $('#error_form').parsley().reset();

            jQuery.ajax({
                type: "POST",
                url: base_url + "panel/errors/getErrorByID",
                data: "id=" + encodeURI(num) + "&token=<?=$_SESSION['token'];?>",
                cache: false,
                dataType: "json",
                success: function (data) {
                    jQuery('#error_code').val(data.code);
                    jQuery('#error_defect').val(data.defect);
                    jQuery('#error_reason').val(data.reason);
                    jQuery('#error_description').val(data.description)

                    jQuery('#footerError').html('<button data-dismiss="modal" class="pull-left btn btn-default" type="button"><i class="fa fa-reply"></i> <?= lang("go_back"); ?></button><button id="error_submit" role="button" form="error_form" class="btn btn-success" data-mode="modify" data-num="' + encodeURI(num) + '"><i class="fa fa-save"></i> <?= lang("save"); ?> <?= lang("reparation_error"); ?></button>')
                }
            });
        });

$(function () {
    $('#error_form').parsley({
        errorsContainer: function(pEle) {
            var $err = pEle.$element.closest('.form-group');
            return $err;
        }
    }).on('form:submit', function(event) {
        var mode = jQuery('#error_submit').data("mode");
        var id = jQuery('#error_submit').data("num");

        var error_defect = jQuery('#error_defect').val();

        var url = "";
        var formData = new FormData($('form#error_form')[0]);
        if (mode == "add") {
            url = base_url + "panel/errors/add";
            jQuery.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    toastr['success']("<?= lang('add');?>", "<?= lang('reparation_error');?> " + name  + " <?= lang('added');?>");
                    if (data.error) {
                        toastr['error'](data.error);
                    }
                    setTimeout(function () {
                        $('#errormodal').modal('hide');
                        $('#dynamic-table').DataTable().ajax.reload();
                    }, 500);
                }
            });
        } else {
            formData.append('id', id);
            url = base_url + "panel/errors/edit";
            jQuery.ajax({
                url: url,
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    toastr['success']("<?= lang('edit');?>", "<?= lang('reparation_error');?>: " + name  + "<?= lang('updated');?>");
                    if (data.error) {
                        toastr['error'](data.error);
                    }
                    setTimeout(function () {
                        $('#errormodal').modal('hide');
                        $('#dynamic-table').DataTable().ajax.reload();
                    }, 500);
                }
            });
        }
        return false;
    });
});
   
</script>