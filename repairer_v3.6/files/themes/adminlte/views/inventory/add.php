<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
     $(document).ready(function () {
        $('.gen_slug').change(function(e) {
            getSlug($(this).val(), 'products');
        });
        $("#subcategory").empty().attr("placeholder", "<?= lang('select_category_to_load') ?>").select2({
            placeholder: "<?= lang('select_category_to_load') ?>", minimumResultsForSearch: 7, data: [
                {id: '', text: '<?= lang('select_category_to_load') ?>'}
            ]
        });
        $('.select').select2();
        $('#category').change(function () {
            var v = $(this).val();
            if (v) {
                $.ajax({
                    type: "get",
                    async: false,
                    url: "<?= base_url('panel/inventory/getSubCategories') ?>/" + v,
                    dataType: "json",
                    success: function (scdata) {
                        if (scdata != null) {
                            scdata.push({id: '', text: '<?= lang('select_subcategory') ?>'});
                            $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('select_subcategory') ?>").select2({
                                placeholder: "<?= lang('select_category_to_load') ?>",
                                minimumResultsForSearch: 7,
                                data: scdata
                            });
                        } else {
                            $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('no_subcategory') ?>").select2({
                                placeholder: "<?= lang('no_subcategory') ?>",
                                minimumResultsForSearch: 7,
                                data: [{id: '', text: '<?= lang('no_subcategory') ?>'}]
                            });
                        }
                    },
                    error: function () {
                        bootbox.alert('<?= lang('ajax_error') ?>');
                        $('#modal-loading').hide();
                    }
                });
            } else {
                $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('select_category_to_load') ?>").select2({
                    placeholder: "<?= lang('select_category_to_load') ?>",
                    minimumResultsForSearch: 7,
                    data: [{id: '', text: '<?= lang('select_category_to_load') ?>'}]
                });
            }
            $('#modal-loading').hide();
        });
        $('#code').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>


<div class="row">
  <div class="col-12">
    <div class="card">

      <div class="card-header">
              <h3 class="card-title"><i class="fa-fw fa fa-plus"></i><?= lang('add_product'); ?></h3>
          </div>
      <!-- /.card-header -->
      <div class="card-body">

                        <div class="col-lg-12">
                            <?php
                            $attrib = array('data-toggle' => 'validator', 'role' => 'form');
                            echo form_open_multipart("panel/inventory/add", $attrib)
                            ?>
                    <div class="row">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <?= lang("product_type", "type") ?>
                                    <?php
                                    $opts = array('standard' => lang('standard'), 'service' => lang('service'));
                                    echo form_dropdown('type', $opts, (isset($_POST['type']) ? $_POST['type'] : ($product ? $product->type : '')), 'class="form-control" id="type" required="required"');
                                    ?>
                                </div>
                                <div class="form-group all">
                                    <?= lang("product_name", 'name') ?>
                                    <?= form_input('name', (isset($_POST['name']) ? $_POST['name'] : ($product ? $product->name : '')), 'class="form-control" id="name" required="required"'); ?>
                                </div>
                                <div class="form-group all">
                                    <?= lang("product_code", 'code') ?>
                                    <div class="input-group">
                                        <?= form_input('code', (isset($_POST['code']) ? $_POST['code'] : ($product ? $product->code : '')), 'class="form-control" id="code"  required="required"') ?>
                                        <span class="input-group-addon pointer" id="random_num" style="padding: 1px 10px;">
                                            <i class="fa fa-random"></i>
                                        </span>
                                    </div>
                                    <span class="help-block"><?= lang('you_scan_your_barcode_too') ?></span>
                                </div>
                                 <div class="form-group all">
                                    <?= lang("category", "category") ?>
                                    <?php
                                    $cat[''] = lang('please_select');
                                    foreach ($categories as $category) {
                                        $cat[$category->id] = $category->name;
                                    }
                                    echo form_dropdown('category', $cat, (isset($_POST['category']) ? $_POST['category'] : ($product ? $product->category_id : '')), 'class="form-control select" id="category" placeholder="' . lang("select") . " " . lang("category") . '" required="required" style="width:100%"')
                                    ?>
                                </div>
                                <div class="form-group all">
                                    <?= lang("subcategory", "subcategory") ?>
                                    <div class="controls" id="subcat_data"> 
                                        <select style="width: 100%;" name="subcategory" id="subcategory">
                                            <option selected disabled><?= lang("select_category_to_load"); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group all">
                                    <?= lang("model_title", 'model') ?>
                                    <?php
                                    $br = array();
                                    if ($models) {
                                        foreach ($models as $model) {
                                            $br[$model->id] = $model->name;
                                        }
                                    }
                                    echo form_dropdown('model', $br, (isset($_POST['model']) ? $_POST['model'] : ($product ? $product->model_id : '')), 'class="form-control select" id="model" placeholder="' . ("select") . " " . ("model") . '" style="width:100%"')
                                    ?>
                                </div>
                                
                                <div class="form-group standard">
                                    <?= lang("alert_quantity", 'alert_quantity') ?>
                                     <?= form_input('alert_quantity', (isset($_POST['alert_quantity']) ? $_POST['alert_quantity'] : ($product ?($product->alert_quantity) : '')), 'class="form-control tip" id="alert_quantity"') ?>
                                </div>
                                <div class="form-group standard">
                                    <?= lang("quantity", 'quantity') ?>
                                    <?= form_input('quantity', (isset($_POST['quantity']) ? $_POST['quantity'] : ($product ? ($product->quantity) : '0')), 'class="form-control tip" id="quantity" required="required"') ?>

                                </div>
                                
                            </div>

                            
                            <div class="col-md-6 col-md-offset-1">

                                <?php if ($settings->tax1) { ?>
                                    <div class="form-group all">
                                        <?= lang("product_tax", 'tax_rate') ?>
                                        <?php
                                        $tr[""] = "";
                                        foreach ($tax_rates as $tax) {
                                            $tr[$tax['id']] = $tax['name'];
                                        }
                                        echo form_dropdown('tax_rate', $tr, (isset($_POST['tax_rate']) ? $_POST['tax_rate'] : ($product ? $product->tax_rate : $settings->default_tax_rate2)), 'class="form-control select" id="tax_rate" placeholder="' . lang("select") . ' ' . lang("product_tax") . '" style="width:100%"')
                                        ?>
                                    </div>
                                    
                                    <div class="form-group all">
                                        <?= lang("tax_method", 'tax_method') ?>
                                        <?php
                                        $tm = array('0' => lang('inclusive'), '1' => lang('exclusive'));
                                        echo form_dropdown('tax_method', $tm, (isset($_POST['tax_method']) ? $_POST['tax_method'] : ($product ? $product->tax_method : '')), 'class="form-control select" id="tax_method" placeholder="' . lang("select") . ' ' . lang("tax_method") . '" style="width:100%"')
                                        ?>
                                    </div>
                                <?php } ?>

                                <div class="form-group all">
                                    <?= lang("supplier", "supplier") ?>
                                    <?php
                                    $sup = array();
                                    if($suppliers): foreach ($suppliers as $supplier) {
                                        $sup[$supplier->id] = $supplier->name;
                                    }endif;
                                    echo form_dropdown('supplier[]', $sup, set_value('supplier'), 'class="form-control select" multiple id="supplier" placeholder="' . lang("select") . " " . lang("supplier") . '" required="required" style="width:100%"')
                                    ?>
                                </div>

                                    
                                <div class="form-group standard">
                                    <?= lang('product_unit', 'unit'); ?>
                                    <?= form_input('unit', (isset($_POST['unit']) ? $_POST['unit'] : ($product ? $product->unit : '')), 'class="form-control" id="unit" required="required"'); ?>
                                </div>
                                <div class="form-group standard">
                                    <?= lang("product_cost", 'cost') ?>
                                    <?= form_input('cost', (isset($_POST['cost']) ? $_POST['cost'] : ($product ? ($product->cost) : '')), 'class="form-control tip" id="cost" required="required"') ?>
                                </div>
                                <div class="form-group all">
                                    <?= lang("product_price", 'price') ?>
                                    <?= form_input('price', (isset($_POST['price']) ? $_POST['price'] : ($product ? ($product->price) : '')), 'class="form-control tip" id="price" required="required"') ?>
                                </div>
                                 
                                 <div class="form-group all">
                                    <?= lang("product_image", "product_image") ?>
                                    <input id="product_image" type="file" data-language="mylang" data-browse-label="<?= lang('browse'); ?>" name="product_image" data-show-upload="false"
                                           data-show-preview="false" accept="image/*" class="form-control file">
                                </div>

                            </div>

                            <div class="col-md-12">
                                
                              
                                <div class="form-group all">
                                    <?= lang("product_details", 'details') ?>
                                    <?= form_textarea('details', (isset($_POST['details']) ? $_POST['details'] : ($product ? $product->details : '')), 'class="form-control" id="details"'); ?>
                                </div>

                                <div class="form-group">
                                    <?php echo form_submit('add_product', lang("add_product"), 'class="btn btn-primary"'); ?>
                                </div>

                        </div>
                            </div>
                            <?= form_close(); ?>


                    </div>
                </div>
        </div>
    </div>
</div>



<script type="text/javascript">
       
    $(document).ready(function () {
        var items = {};
   
        $('#type').change(function () {
            var t = $(this).val();
            if (t !== 'standard') {
                $('.standard').slideUp();
                $('#cost').attr('required', 'required');
                $('#track_quantity').iCheck('uncheck');
                $('form[data-toggle="validator"]').bootstrapValidator('addField', 'cost');
            } else {
                $('.standard').slideDown();
                $('#track_quantity').iCheck('check');
                $('#cost').removeAttr('required');
                $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'cost');
            }

        });

        var t = $('#type').val();
        if (t !== 'standard') {
            $('.standard').slideUp();
            $('#cost').attr('required', 'required');
            $('#track_quantity').iCheck('uncheck');
            $('form[data-toggle="validator"]').bootstrapValidator('addField', 'cost');
        } else {
            $('.standard').slideDown();
            $('#track_quantity').iCheck('check');
            $('#cost').removeAttr('required');
            $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'cost');
        }
        

        function calculate_price() {
            var rows = $('#prTable').children('tbody').children('tr');
            var pp = 0;
            $.each(rows, function () {
                pp += formatDecimal(parseFloat($(this).find('.rprice').val())*parseFloat($(this).find('.rquantity').val()));
            });
            $('#price').val(pp);
            return true;
        }

        $(document).on('change', '.rquantity, .rprice', function () {
            calculate_price();
        });

        $(document).on('click', '.del', function () {
            var id = $(this).attr('id');
            delete items[id];
            $(this).closest('#row_' + id).remove();
            calculate_price();
        });
        var su = 2;
       
        $(document).on('click', '.delAttr', function () {
            $(this).closest("tr").remove();
        });
        $(document).on('click', '.attr-remove-all', function () {
            $('#attrTable tbody').empty();
            $('#attrTable').hide();
        });

    });

    <?php if ($product) { ?>
    $(document).ready(function () {
        var t = "<?=$product->type?>";
        if (t !== 'standard') {
            $('.standard').slideUp();
            $('#cost').attr('required', 'required');
            $('#track_quantity').iCheck('uncheck');
            $('form[data-toggle="validator"]').bootstrapValidator('addField', 'cost');
        } else {
            $('.standard').slideDown();
            $('#track_quantity').iCheck('check');
            $('#cost').removeAttr('required');
            $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'cost');
        }


        $("#code").parent('.form-group').addClass("has-error");
        $("#code").focus();
    });
    <?php } ?>
        $('#random_num').click(function(){
        $(this).parent('.input-group').children('input').val(generateCardNo(8));
    });
        function generateCardNo(x) {
    if(!x) { x = 16; }
    chars = "1234567890";
    no = "";
    for (var i=0; i<x; i++) {
       var rnum = Math.floor(Math.random() * chars.length);
       no += chars.substring(rnum,rnum+1);
   }
   return no;
}
<?php if (validation_errors()) { ?>
    var text = '<?= trim(validation_errors()); ?>';
    toastr.warning(text);
<?php } ?>
</script>

