<script type="text/javascript" src="<?=$assets;?>plugins/renderjson.js"></script>

<link href="<?= $assets;?>/plugins/patternlock/patternLock.css"  rel="stylesheet" type="text/css" />
<script src="<?= $assets;?>/plugins/patternlock/patternLock.min.js"></script>
<style type="text/css">
  .timeline-image {
  width: 30px;
  height: 30px;
  font-size: 15px;
  line-height: 30px;
  position: absolute;
  color: #666;
  background: #d2d6de;
  border-radius: 50%;
  text-align: center;
  left: 18px;
  background-color: #00c0ef !important;
  top: 0;
  }
  /* Always set the map height explicitly to define the size of the div
  * element that contains the map. */
  #map {
  height: 100%;
  }
  #autocomplete{
  z-index: 9999;   
  }
  .pac-container {
  background-color: #FFF;
  z-index: 9999;
  position: fixed;
  display: inline-block;
  float: left;
  }
  .checkbox-toggle-styled-material,
  .checkbox-toggle-styled-on-off,
  .checkbox-toggle-styled-yes-no {
  padding-left: 20px;
  }
  .checkbox-toggle-styled-material label,
  .checkbox-toggle-styled-on-off label,
  .checkbox-toggle-styled-yes-no label {
  display: inline-block;
  font-weight: normal;
  position: relative;
  padding-left: 35px;
  }
  .checkbox-toggle-styled-material label:before {
  content: "";
  display: inline-block;
  position: absolute;
  width: 45px;
  height: 4px;
  top: 7px;
  left: 0;
  text-align: right;
  padding-right: 5px;
  margin-left: -20px;
  border-radius: 20px;
  background: #dee1e6;
  font-size: 10px;
  }
  .checkbox-toggle-styled-on-off label:before,
  .checkbox-toggle-styled-yes-no label:before {
  display: inline-block;
  position: absolute;
  width: 47px;
  height: 20px;
  left: 0;
  text-align: right;
  padding-right: 5px;
  line-height: 1.95em;
  text-transform: uppercase;
  margin-left: -20px;
  border-radius: 20px;
  font-weight: 900;
  background: #dee1e6;
  font-size: 10px;
  }
  .checkbox-toggle-styled-on-off label:before {
  content: "✓";
  background-color: green;
  }
  .checkbox-toggle-styled-yes-no label:before {
  content: "no";
  }
  .checkbox-toggle-styled-material label:after {
  content: "";
  display: inline-block;
  position: absolute;
  width: 18px;
  height: 18px;
  left: 0;
  top: 0;
  margin-left: -20px;
  padding-left: 5px;
  padding-top: 1px;
  font-size: 12px;
  background: #caced6;
  border-radius: 50%;
  -webkit-transition: margin 0.2s ease-in 0s;
  transition: margin 0.2s ease-in 0s;
  }
  .checkbox-toggle-styled-on-off label:after,
  .checkbox-toggle-styled-yes-no label:after {
  font-family: "Font Awesome 5 Free";
  content: "\f111";
  display: inline-block;
  position: absolute;
  width: 18px;
  height: 18px;
  left: 0;
  top: 0;
  margin-left: -20px;
  padding-left: 5px;
  padding-top: 1px;
  font-size: 12px;
  color: #51596a;
  -webkit-transition: margin 0.2s ease-in 0s;
  transition: margin 0.2s ease-in 0s;
  }
  .checkbox-toggle-styled-material input[type="checkbox"],
  .checkbox-toggle-styled-on-off input[type="checkbox"],
  .checkbox-toggle-styled-yes-no input[type="checkbox"] {
  display: none;
  }
  .checkbox-toggle-styled-material input[type="checkbox"]:checked + label:before,
  .checkbox-toggle-styled-on-off input[type="checkbox"]:checked + label:before,
  .checkbox-toggle-styled-yes-no input[type="checkbox"]:checked + label:before {
  position: absolute;
  text-align: left;
  padding-left: 8px;
  }
  .checkbox-toggle-styled-on-off input[type="checkbox"]:checked + label:before {
  content: "✘";
  background-color: red;
  }
  .checkbox-toggle-styled-yes-no input[type="checkbox"]:checked + label:before {
  content: "yes";
  }
  .checkbox-toggle-styled-material input[type="checkbox"]:checked + label:after {
  content: "";
  text-align: right;
  margin-left: 8px;
  padding-left: 0;
  background: #9099aa;
  -webkit-transition: margin 0.2s ease-in 0s;
  transition: margin 0.2s ease-in 0s;
  }
  .checkbox-toggle-styled-on-off input[type="checkbox"]:checked + label:after,
  .checkbox-toggle-styled-yes-no input[type="checkbox"]:checked + label:after {
  font-family: "Font Awesome 5 Free";
  content: "\f111";
  text-align: right;
  margin-left: 4px;
  padding-left: 0;
  -webkit-transition: margin 0.2s ease-in 0s;
  transition: margin 0.2s ease-in 0s;
  }
  .has-success .checkbox-toggle-styled-material label:before {
  background: #d1dfaa;
  }
  .has-error .checkbox-toggle-styled-material label:before {
  background: #f9d0d4;
  }
  .has-success .checkbox-toggle-styled-material label:after {
  background: #bcd185;
  }
  .has-error .checkbox-toggle-styled-material label:after {
  background: #f1969e;
  }
  .has-success .checkbox-toggle-styled-material input[type="checkbox"]:checked + label:after {
  background: #9ab946;
  }
  .has-error .checkbox-toggle-styled-material input[type="checkbox"]:checked + label:after {
  background: #e74958;
  }
  .has-error .checkbox-toggle-styled-on-off label:before,
  .has-error .checkbox-toggle-styled-yes-no label:before {
  background-color: #e74958;
  color: #fff;
  border: 1px solid #e74958;
  }
  .has-success .checkbox-toggle-styled-on-off label:before,
  .has-success .checkbox-toggle-styled-yes-no label:before {
  background-color: #9ab946;
  color: #fff;
  border: 1px solid #9ab946;
  }
  .has-error .checkbox-toggle-styled-on-off label:after,
  .has-error .checkbox-toggle-styled-yes-no label:after,
  .has-success .checkbox-toggle-styled-on-off label:after,
  .has-success .checkbox-toggle-styled-yes-no label:after {
  color: #ffffff;
  }
  .radio-styled input[type="radio"]:disabled + label,
  .checkbox-styled input[type="checkbox"]:disabled + label,
  .checkbox-toggle-styled-material input[type="checkbox"]:disabled + label,
  .checkbox-toggle-styled-on-off input[type="checkbox"]:disabled + label,
  .checkbox-toggle-styled-yes-no input[type="checkbox"]:disabled + label,
  fieldset[disabled] .radio-styled input[type="radio"] + label,
  fieldset[disabled] .checkbox-styled input[type="checkbox"] + label,
  fieldset[disabled] .checkbox-toggle-styled-material input[type="checkbox"] + label,
  fieldset[disabled] .checkbox-toggle-styled-on-off input[type="checkbox"] + label,
  fieldset[disabled] .checkbox-toggle-styled-yes-no input[type="checkbox"] + label {
  opacity: 0.65;
  cursor: not-allowed;
  }
</style>
<script type="text/javascript">
  function IDGenerate() {
      var text = "";
      var hdntxt = "";
      var captchatext = "";
      var possible = "ABCDEFGHIkLMNOPQRSTUVWXYZ0123456789";
      for (var i = 0; i < 6; i++) {
          text += possible.charAt(Math.floor(Math.random() * possible.length));         
      }
  
      return text;
  }
  
  
  function update_by(x) {
      if (x=='') {
          return '<?=lang('not_modified');?>';
      }
      return x;
    }
    jQuery(document).on("click", ".view", function () {
      var num = jQuery(this).data("num");
      find_reparation(num);
  });
   jQuery(document).on("click", ".view_client", function () {
      var num = jQuery(this).data("num");
      find_client(num);
  });
  
    jQuery(document).on("keyup", "textarea", function (event) {
       if (event.which==13) {
          $(this).val($(this).val() + "\n")
      }
    });
  
  lock = null;
   $(document).ready(function () {
  
    $('textarea').keypress(function(event) {
    if (event.which == 13) {
      event.preventDefault();
      this.value = this.value;
    }
  });
  
      lock = new PatternLock('#patternHolder',{
          enableSetPattern : true,
          onDraw:function(pattern){
              $('#patternlock').val(pattern);
          }
      });
  });
  function setEditPattern(argument) {
      lock.setPattern(argument);
  }
  function alphanumeric_unique() {
      return Math.random().toString(36).split('').filter( function(value, index, self) { 
          return self.indexOf(value) === index;
      }).join('').substr(2,8);
  }    
  jQuery(document).on("click", "#sendsmsfast", function() {
      var txt = jQuery('#fastsms').val();
      var number = jQuery('#rv_phone_number').val();
      jQuery.ajax({
          type: "POST",
          url: base_url + "panel/reparation/send_sms",
          data: "text=" + txt + "&number=" + number + "&token=<?=$_SESSION['token'];?>",
          cache: false,
          dataType: "json",
          success: function(data) {
              if(data.status == true) toastr['success']("<?= $this->lang->line('quick_sms');?>", '<?= $this->lang->line('sms_sent');?>');
              else toastr['error']("<?= $this->lang->line('quick_sms');?>", '<?= $this->lang->line('sms_not_sent');?>');
          }
      });
  });
  jQuery(document).on("click", "#delete_reparation", function () {
      var num = jQuery(this).data("num");
      bootbox.prompt({
          title: "Are you sure!",
          inputType: 'checkbox',
          inputOptions: [
              {
                  text: '<?= lang('want_to_add_to_stock-delete'); ?>',
                  value: '1',
              },
          ],
          callback: function (result) {
              if (result) {
                  var add_to_stock = false;
                  if (result.length == 1) {
                      add_to_stock = true;
                  }
                  jQuery.ajax({
                      type: "POST",
                      url: base_url + "panel/reparation/delete",
                      data: "id=" + encodeURI(num) + "&add_to_stock=" + encodeURI(add_to_stock),
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
                          toastr['success']("<?= lang('deleted'); ?>: ", "<?= lang('reparation_deleted'); ?>");
                          $('#dynamic-table').DataTable().ajax.reload();
                      }
                  });
              }
          }
      });
  });
</script>
<!-- ============= MODAL VISUALIZZA ORDINI/RIPARAZIONI ============= -->
<div class="col-md-12 modal fade" id="view_reparation" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-ku">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <div id="titoloOE"></div>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-md-12 col-lg-4 bio-row">
              <p><span class="bold"><i class="fa fa-laptop"></i> <?= lang('reparation_imei'); ?> </span><span id="rv_imei"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row">
              <p><span class="bold"><i class="fa fa-user"></i> <?= lang('client_title'); ?></span><span id="rv_client"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row stato">
              <p><span class="bold"><i class="fa fa-signal"></i> <?= lang('reparation_condition'); ?> </span><span class="label" id="rv_condition"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row">
              <p><span class="bold"><i class="fa fa-calendar"></i> <?= lang('reparation_opened_at'); ?> </span><span id="rv_created_at"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row">
              <p><span class="bold"><i class="fas fa-link"></i> <?= lang('reparation_defect'); ?> </span><span id="rv_defect"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row">
              <p><span class="bold"><i class="fa fa-sitemap"></i> <?= lang('reparation_category'); ?> </span><span id="rv_category"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row">
              <p><span class="bold"><i class="fa fa-desktop"></i> <?= lang('reparation_model'); ?> </span><span id="rv_model"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row nofloat">
              <p><span class="bold"><i class="fas fa-money-bill-alt"></i><?= lang('reparation_price'); ?> </span><span id="rv_price"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row">
              <p><span class="bold"><i class="fa fa-phone"></i> <?= lang('client_telephone'); ?> </span><span id="rv_phone_number"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row">
              <p><span class="bold"><i class="glyphicon glyphicon-qrcode"></i> <?= lang('reparation_code'); ?> </span><span id="rv_rep_code"></span></p>
            </div>
            <div class="col-md-12 col-lg-4 bio-row nofloat">
              <p><span class="bold"><i class="fas fa-retweet"></i><?= lang('warranty'); ?> </span><span id="rv_warranty"></span></p>
            </div>
            <?php 
              $custom_fields = explode(',', $settings->custom_fields);
              foreach($custom_fields as $line){
                  if (!empty($line)) {
              ?>
            <div class="col-md-12 col-lg-4 bio-row">
              <p><span class="bold"><i class="fa fa-info-circle"></i> <?= $line; ?> </span><span class="show_custom" id="v<?= bin2hex($line); ?>"></span></p>
            </div>
            <?php }} ?>
          </div>
            <div class="row">
                <div class="col-md-6 bio-row textareacom">
                  <div class="form-group comment">
                    <?= lang('reparation_comment', 'rv_comment'); ?>
                    <textarea class="form-control" id="rv_comment" rows="6" disabled=""></textarea>
                  </div>
                </div>
                <div class="col-md-6 bio-row textareacom">
                  <div class="form-group comment">
                    <?= lang('reparation_diagnostics', 'rv_diagnostics'); ?>
                    <textarea class="form-control" id="rv_diagnostics" rows="6" disabled=""></textarea>
                  </div>
                </div>
                <div class="col-md-6 bio-row fastsms">
                  <div class="form-group rv_comment">
                    <?=lang('quick_sms', 'fastsms');?>
                    <textarea class="form-control" id="fastsms" rows="6" placeholder="Instantly send a text message to the client by entering your text here"></textarea>
                    <button type="button" class="btn btn-xs btn-primary" id="sendsmsfast"><i class="fa fa-check"></i> <?=lang('send');?></button>
                  </div>
                </div>
            </div>
        <div id="timeline"></div>
      </div>
      <div id="footerOR" class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- ============= MODAL reparation add ============= -->
<div class="modal fade" id="reparationmodal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-ku">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="titReparation"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <div class="panel-body">
          <p class="tips custip"></p>
          <form id="rpair_form" enctype="multipart/form-data">
            <input type="hidden" name="sign_id" id="repair_sign_id" value="">
            <input type="hidden" name="sign_name" id="repair_sign_name" value="">
            <input type="hidden" name="attachment_data" id="attachment_data" value>
            <input type="hidden" name="status_text" id="status_text" value>
            <div id="preprepair_hide"></div>
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('reparation_imei', 'imei');?>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fas fa-laptop"></i></span>
                          </div>
                          <input id="imei" name="imei" type="text" class="validate form-control imei_typeahead">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <?=lang('client_title', 'client_name');?>
                      <div class="input-group">
                        
                        <select required id="client_name" name="client_name" data-num="1" class="form-control m-bot15" >
                          <option></option>
                          <?php 
                            foreach ($clients as $client) :
                            echo '<option value="'.$client->id.'">'.$client->name.' '.$client->company. ' - ' . $client->telephone . '</option>';
                            endforeach; 
                            ?>
                        </select>
                         <div class="input-group-append">
                          <span  id="add_client" class="input-group-text add_c">
                          <i class="fa fa-user-plus"></i>
                          </span>
                        </div>

                       
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <?=lang('reparation_category', 'category_select');?>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                          <i class="fa  fa-folder"></i></span>
                        </div>
                        <input id="category" name="category" type="text" class="validate form-control categories_typeahead">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('assigned_to', 'assigned_to');?>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa fa-user"></i></span>
                          </div>
                          <select required id="assigned_to" name="assigned_to" class="form-control m-bot15" >
                          <?php
                            foreach($users as $user){
                                echo '<option value="'.$user->id.'">'.$user->first_name . ' ' . $user->last_name .'</option>';
                            } 
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('model_manufacturer', 'reparation_manufacturer');?>
                        

                          <input class="form-control manufacturer_name_typeahead" id="reparation_manufacturer" name="manufacturer" required="" >
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <?=lang('reparation_model', 'reparation_model');?>
                     
                        <input class="form-control model_name_typeahead" id="reparation_model" name="model" required="" >
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('reparation_defect', 'defect');?>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fas fa-link"></i></span>
                          </div>
                          <input required id="defect" name="defect" type="text" class="validate form-control defect_typeahead">
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php $hide_repair_fields = json_decode($settings->hide_repair_fields);?>

                  <?php if($hide_repair_fields->error_code): ?>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('error_code', 'error_code');?>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa fa-folder"></i></span>
                          </div>
                          <select id="error_code" name="error_code" class="form-control m-bot15" >
                          <?php
                            foreach($errors as $error){
                                echo '<option value="'.$error->code.'">'.$error->code . ' - ' . $error->description .'</option>';
                            } 
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif;?>


                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <?=lang('reparation_service_charges', 'service_charges');?>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                          <i class="fas fa-truck"></i></span>
                        </div>
                        <input required id="service_charges" name="service_charges" min="0" type="number" value="0" step="any" class="validate form-control">
                      </div>
                    </div>
                  </div>

                  <?php if($hide_repair_fields->expected_close_date): ?>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('expected_close_date', 'expected_close_date');?>

                          <div class="input-group date" id="expected_close_date_" data-target-input="nearest">
                             <div class="input-group-append" data-target="#expected_close_date_" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input id="expected_close_date" data-target="#expected_close_date_" name="expected_close_date" type="text" class="validate form-control datetimepicker-input">
                          </div>

                      
                      </div>
                    </div>
                  </div>
                  <?php endif;?>

                  
                  <?php if($hide_repair_fields->date_of_purchase): ?>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('date_of_purchase', 'date_of_purchase');?>


                         <div class="input-group date" id="date_of_purchase_" data-target-input="nearest">
                             <div class="input-group-append" data-target="#date_of_purchase_" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input id="date_of_purchase" data-target="#date_of_purchase_" name="date_of_purchase" type="text" class="validate form-control datetimepicker-input">
                          </div>
                      </div>
                    </div>
                  </div>
                  <?php endif;?>

                  
                  <?php if($hide_repair_fields->has_warranty): ?>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <?=lang('has_warranty', 'has_warranty');?>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fas fa-retweet"></i>
                          </span>
                        </div>
                        <?php $wm = array('1' => lang('in_warranty'), '0' => lang('out_warranty')); ?>
                        <?= form_dropdown('has_warranty', $wm, '', 'class="form-control" id="has_warranty" '); ?>
                      </div>
                    </div>
                  </div>
                  <?php endif;?>
                  <?php  

                          $warranties = array(
                              '0' => lang('no_warranty'),
                              '1M' => lang('1M'),
                              '2M' => lang('2M'),
                              '3M' => lang('3M'),
                              '4M' => lang('4M'),
                              '5M' => lang('5M'),
                              '6M' => lang('6M'),
                              '7M' => lang('7M'),
                              '8M' => lang('8M'),
                              '9M' => lang('9M'),
                              '10M' => lang('10M'),
                              '11M' => lang('11M'),
                              '12M' => lang('12M'),
                          ); 
                          ?>
                  <?php if($hide_repair_fields->warranty): ?>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <?=lang('warranty', 'warranty');?>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                          <i class="fas fa-retweet"></i></span>
                        </div>
                        <?php 
                          
                          echo form_dropdown('warranty', $warranties, '', 'class="form-control" id="warranty"');
                          ?>
                      </div>
                    </div>
                  </div>
                  <?php endif;?>

                  <?php if($hide_repair_fields->warranty_card_number): ?>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('warranty_card_number', 'warranty_card_number');?>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fas fa-retweet"></i></span>
                          </div>
                          <input required id="warranty_card_number" name="warranty_card_number" type="text" class="validate form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif;?>
                  
                  <?php if($hide_repair_fields->repair_type): ?>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('repair_type', 'repair_type');?>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fas fa-wrench"></i></span>
                          </div>
                          <input  id="repair_type" name="repair_type" type="text" class="validate form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endif;?>

                  <?php if($hide_repair_fields->client_date): ?>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <div class="form-group">
                        <?=lang('client_date', 'client_date');?>

                        <div class="input-group date" id="client_date_" data-target-input="nearest">
                             <div class="input-group-append" data-target="#client_date_" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input id="client_date" data-target="#client_date_" name="client_date" type="text" class="validate form-control datetimepicker-input">
                          </div>

                      </div>
                    </div>
                  </div>
                  <?php endif;?>

                  <?php 
                    $custom = explode(',', $settings->custom_fields);
                    foreach($custom as $line){
                        if (!empty($line)) {
                    
                    ?>
                  <div class="col-lg-4 col-sm-4 col-xs-12 col-md-4">
                    <div class="form-group">
                      <label><?= $line; ?></label>
                      <input id="custom_<?= bin2hex($line); ?>" name="custom_<?= bin2hex($line); ?>" type="text" class="custom validate form-control">
                    </div>
                  </div>
                  <?php } }?>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <?=lang('taxrate_title', 'potax2');?>
                  <select id="potax2" class="form-control input-tip select" name="order_tax" style="width: 100%;">
                    <?php foreach ($tax_rates as  $tax): ?>
                    <option value="<?= $tax['id'] ?>"><?= $tax['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group combo">
                  <?= lang("add_item", 'add_item'); ?>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-link"></i></span>
                      </div>

                    <?php echo form_input('add_item', '', 'class="form-control ttip" id="add_item" data-placement="top" data-trigger="focus" data-bv-notEmpty-message="' . ('please_add_items_below') . '" placeholder="' . lang("add_item") . '"'); ?>
                  </div>
                </div>
                <div class="control-group table-group">
                  <label class="table-label" for="combo"><?= lang("defective_items"); ?></label>
                  <div class="controls table-controls">
                    <table id="prTable"
                      class="table items table-striped table-bordered table-sm table-hover">
                      <thead>
                        <tr>
                          <th class="col-md-4 col-sm-4 col-xs-4"><?= lang("product_name") . " (" . lang("product_code") . ")"; ?></th>
                          <th class="col-md-2 col-sm-2 col-xs-2"><?= lang("quantity"); ?></th>
                          <th class="col-md-3 col-sm-3 col-xs-3"><?= lang("unit_price"); ?></th>
                          <th class="col-md-2 col-sm-2 col-xs-2 text-center">
                            <i class="fas fa-trash" style="opacity:0.5; filter:alpha(opacity=50);"></i>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <td colspan="4"><?= lang('nothing_to_display'); ?></td>
                      </tbody>
                    </table>
                    <table class="table items table-striped table-bordered table-sm table-hover">
                      <tfoot>
                        <tr>
                          <th colspan="1" class="warning"><span class="pull-right"><?= lang('tax');?></span></th>
                          <th colspan="1" class="success"><span id="tax_span">0.00</span></th>
                          <th colspan="1" class="warning"><span class="pull-right"><?=lang('subtotal')?></span></th>
                          <th colspan="1" class="info"><span id="price_span">0.00</span></th>
                        </tr>
                        <tr style="display: none;">
                          <th colspan="5" class="warning"><span class="pull-right"><?= lang('total'); ?></span></th>
                          <th colspan="1" class="success"><span id="totalprice_span">0.00</span></th>
                        </tr>
                        <tr>
                          <th colspan="1" class="warning"><span class="pull-right"><?=lang('reparation_service_charges')?></span></th>
                          <th colspan="1" class="success"><span id="sc_span">0.00</span></th>
                          <th class="warning"><span class="pull-right"><?= lang('grand_total'); ?></span></th>
                          <th class="success"><span id="gtotal">0.00</span></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <div style="clear: both;"></div>
              
              <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-12 col-md-6">
                  <div class="form-group">
                    <?=lang('accessories', 'accessories');?> <i id="add_timestamp" class="fa fa-calendar"></i>
                    <textarea class="form-control" id="accessories" name="accessories" rows="6"></textarea>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12 col-md-6">
                  <div class="form-group">
                    <?= lang('reparation_comment', 'comment'); ?> <i id="add_timestamp" class="fa fa-calendar"></i>
                    <textarea class="form-control" id="comment" name="comment" rows="6"></textarea>
                  </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12 col-md-6">
                  <div class="form-group">
                    <?= lang('reparation_diagnostics', 'diagnostics'); ?> <i id="add_timestamp" class="fa fa-calendar"></i>
                    <textarea class="form-control" id="diagnostics" name="diagnostics" rows="6"></textarea>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <div class="row">
          
          <button data-dismiss="modal" class="pull-left btn btn-default" type="button">
            <i class="fa fa-reply"></i> 
            <?= lang('go_back'); ?>
          </button>
          
          <div class="col-sm-2">

              <div class="input-group">
                <select id="status_edit" class="form-control">
                  <?php foreach ($statuses as $status): ?>
                  <option value="<?= $status->id; ?>"><?= $status->label; ?></option>
                  <?php endforeach; ?>
                  <option value="0"><?= lang('cancelled'); ?></option>
                </select>

                  <div class="input-group-prepend">
                    <span class="input-group-text" id="add_status_text">
                    <i class="fas fa-pencil-alt"></i></span>
                  </div>
              </div>

            

          </div>
          
          <div class="col-sm-3 col-md-2" style="padding-left: 0;">
              <input id="code" type="text" class="validate form-control" value="" placeholder="<?= lang('reparation_code');?>">
          </div>
          
          <div class="col-sm-7" id="footerReparation"></div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Sign Add -->
<div class="modal fade" id="signModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?=lang('signature');?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p class="tips custip"></p>
        <label id="signature_label"><?=lang('customer_signature_sign_below');?></label>
        <div id="signature"></div>
        <input type="hidden" name="sign_id" id="sign_id" value="">
        <center>
          <button id="submit_sign" data-mode="update_sign" class="btn-icon btn btn-success "><?=lang('save');?></button>
          <button id="reset_sign" class="btn-icon btn btn-primary btn-icon"><?=lang('reset');?></button>
        </center>
      </div>
    </div>
  </div>
</div>
<script src="<?=$assets;?>plugins/jSignature/jSignature.min.js"></script>
<script type="text/javascript">
  jQuery(document).on("change", "#has_warranty", function () {
   if (parseInt($(this).val()) == 1) {
     $('#date_of_purchase').attr('required', true);
     $('#error_code').attr('required', true);
     $('#warranty_card_number').attr('required', true);
   }else{
     $('#date_of_purchase').removeAttr('required');
     $('#error_code').removeAttr('required');
     $('#warranty_card_number').removeAttr('required');
   }
  });
  
  
  jQuery(document).on("click", "#sign_repair", function () {
     num = $(this).data('num');
     mode = $(this).data('mode');
     $('#submit_sign').data('mode', mode);
     jQuery.ajax({
         type: "POST",
         url: "<?= base_url(); ?>panel/misc/check_repair_signature",
         data: 'id='+num,
         cache: false,
         success: function (data) {
             $('#signature').html('');
             $('#submit_sign').hide();
             $('#reset_sign').hide();
             $('#sign_id').val(num);
             if (!data.exists) {
                 $('#signature_label').html("<?=lang('customer_signature_sign_below');?>");
                 $("#signature").jSignature();
                 $("#signature").resize();
                 $('#submit_sign').show();
                 $('#reset_sign').show();
             }else{
                 $('#signature_label').html("<?=lang('customer_signature');?>");
                 $("#signature").html('<img height="200px" src="<?= base_url('assets/uploads/signs/repair_'); ?>'+(data.name)+'">');
             }
         }
     });
  });
  
  jQuery(document).on("click", "#reset_sign", function () {
     $("#signature").jSignature('reset');
  });
  
  jQuery(document).on("click", "#submit_sign", function () {
     mode = $('#submit_sign').data('mode');
     num = $('#sign_id').val();
     if (mode == 'update_sign') {
         var datapair = $('#signature').jSignature("getData", 'base30');
         datapair = 'data='+(datapair[1])+'&id='+num;
         jQuery.ajax({
             type: "POST",
             url: "<?= base_url(); ?>panel/misc/save_repair_signature",
             data: datapair,
             cache: false,
             success: function (data) {
                 $("#signature").jSignature('reset');
                 $('#signModal').modal('hide');
             }
         });
     }else{
         var datapair = $('#signature').jSignature("getData", 'base30');
         $('#repair_sign_id').val(datapair);
         $('#signModal').modal('hide');
     }
  });
  
</script>
<!-- ============= MODAL Upload Manager ============= -->
<div class="modal fade" id="upload_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="upload_modal_title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <label for="upload_manager"><?=lang('Attachments');?></label>
        <div class="file-loading">
          <input id="upload_manager" name="upload_manager[]" type="file" multiple>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var count = 1;
  <?php if(lang('upload_manager')): ?>
     (function ($) {
     "use strict";
    
     $.fn.fileinputLocales['mylang'] = <?= json_encode(utf8ize(lang('upload_manager'))); ?>;
  })(window.jQuery);
  <?php endif; ?>
  jQuery(document).on("click", "#upload_modal_btn", function() {
     mode = $(this).attr('data-mode');
     num = $(this).attr('data-num');
     if (mode == 'edit') {
         $.ajax({
             type: 'POST',
             url: "<?=base_url();?>panel/reparation/getAttachments",
             dataType: "json",
             data:({"id":num}),
             success: function (data) {
                 $('#upload_manager').fileinput('destroy');
                 $("#upload_manager").fileinput({
                     initialPreviewAsData: true, 
                     initialPreview: data.urls,
                     initialPreviewConfig: data.previews,
                     deleteUrl: "<?=base_url();?>panel/reparation/delete_attachment",
                     maxFileSize: 999999,
                     uploadExtraData: {id:num},
                     uploadUrl: "<?=base_url();?>panel/reparation/upload_attachments",
                     uploadAsync: false,
                     overwriteInitial: false,
                     showPreview: true,
                     language: 'mylang',
                 }).on('filebatchuploadsuccess', function(event, data, previewId, index) {
                     $('#dynamic-table').DataTable().ajax.reload();
                 });
             }
         });
     }
     jQuery('#upload_modal').modal("show");
  });
  
  function IDGenerator() {
  
      this.length = 6;
      this.timestamp = +new Date;
      
      var _getRandomInt = function( min, max ) {
         return Math.floor( Math.random() * ( max - min + 1 ) ) + min;
      }
      
      this.generate = function() {
          var ts = this.timestamp.toString();
          var parts = ts.split( "" ).reverse();
          var id = "";
          
          for( var i = 0; i < this.length; ++i ) {
             var index = _getRandomInt( 0, parts.length - 1 );
             id += parts[index];  
          }
          
          return id;
      }
  
      
  }
  
  
  jQuery(".add_reparation").on("click", function (e) {
  
     $('#preprepair_hide').empty();
     $('#prerepair_form')[0].reset();
  
  
     $("#reparation_manufacturer, #reparation_model, #service_charges").val("").trigger('change');
     $('#rpair_form').find("input[type=text], textarea").val("").trigger('change');
  
     $('#rpair_form').find("select").val("").trigger('change');
     $('#rpair_form').parsley().reset();
     items = {};
     $('#prTable tbody').empty();
     $('#prTable tbody').html('<tr><td colspan="4"><?= lang('nothing_to_display') ?></td></tr>');
     localStorage.removeItem('slitems');
     loadRItems();
  
     // $.get( "<?=base_url();?>panel/reparation/getNextInsertID", function( data ) {
     //   code = data;
     //   $('#code').val(code);
     // });
     code = IDGenerate();
     $('#code').val(code);
     // Upload Manager Start
     $('#attachment_data').val('');
     $('#upload_manager').fileinput('destroy');
     $("#upload_manager").fileinput({
         uploadUrl: "<?=base_url();?>panel/reparation/upload_attachments",
         uploadAsync: false,
         language: 'mylang',
     }).on('filebatchuploadsuccess', function(event, data, previewId, index) {
         response = data.response;
         data = JSON.parse(response.data);
         $('#attachment_data').val(data.join(','))
     });
     // Upload Manager End
  
     $('#reparationmodal').modal({
        backdrop: 'static',
         keyboard: false
     });
  
     jQuery('#titReparation').html("<?= lang('add'); ?> <?= lang('reparation_title'); ?>");
  
     footer = '';
     footer += '<button id="upload_modal_btn" class="btn btn-success " data-mode="add"><i class="fa fa-cloud"></i> <?=lang('upload_file');?></button>';
     footer += '<span class=" badge badge-info label-xs" style="padding:6px 12px;width:auto;" ><?=lang('reparation_sms', 'repair_sms');?><input type="checkbox" value="1" name="sms" id="repair_sms"></span><span  style="padding:6px 12px;width:auto;" class=" badge badge-warning label-xs"><label for="repair_email"><?=lang('send_email_check');?></label><input type="checkbox" value="1" name="email" id="repair_email"></span><button class="btn btn-primary" id="sign_repair" href="#signModal" data-toggle="modal" data-mode="add_signature"><i class="fas fa-signature"></i> <?=lang('sign_repair');?></button><button href="#prerepair" class="prerepair_show btn btn-primary"><i class="fa fa-plus-circle"></i> <?=lang('pre_repair_checklist');?></button><button id="repair_submit"  role="button" form="rpair_form"  class="btn btn-success" data-mode="add"><i class="fa fa-user"></i> <?= lang("add"); ?> <?= lang("reparation_title"); ?></button>';
     jQuery('#footerReparation').html(footer);
  });
  jQuery(document).on("click", "#modify_reparation", function () {
     $('#rpair_form').find("input[type=text], textarea").val("");
     $('#rpair_form').find("select").val("").trigger('change');
     var num = $(this).data('num');
     jQuery('#titReparation').html("<?= lang('edit'); ?> <?= lang('reparation_title'); ?>");
     jQuery.ajax({
         type: "POST",
         url: base_url + "panel/reparation/getReparationByID",
         data: "id=" + encodeURI(num) + "&token=<?=$_SESSION['token'];?>",
         cache: false,
         dataType: "json",
         success: function (data) {
             if (data.status < 1) {
                 toastr['error']("<?=lang('cancelled_reparation_not_editable');?>");
                 $('#reparationmodal').modal('hide');
                 return;
             }
            
             jQuery('#titReparation').html("<?= lang('edit'); ?> <?= lang('reparation_title'); ?>" + data.model_name);
             jQuery('#warranty').val(data.warranty).trigger("change");
             jQuery('#client_name').val(parseInt(data.client_id)).trigger("change");
             jQuery('#category').val(data.category);
             jQuery('#reparation_model').val(data.model_name);
             jQuery('#reparation_manufacturer').val(data.manufacturer);
             jQuery('#defect').val(data.defect);
             jQuery('#service_charges').val(data.service_charges);
             jQuery('#potax2').val(parseInt(data.tax_id)).trigger("change");
             jQuery('#assigned_to').val(parseInt(data.assigned_to)).trigger("change");
             jQuery('#comment').val(data.comment);
             jQuery('#imei').val(data.imei);
             jQuery('#diagnostics').val(data.diagnostics);
             jQuery('#expected_close_date').val(fsd(data.expected_close_date));
  
             jQuery('#has_warranty').val(data.has_warranty).trigger("change");
             jQuery('#accessories').val(data.accessories);
             jQuery('#repair_type').val(data.repair_type);
             jQuery('#warranty_card_number').val(data.warranty_card_number);
             jQuery('#date_of_purchase').val(fsd(data.date_of_purchase));
             jQuery('#client_date').val(fsd(data.client_date));
  
             jQuery('#error_code').val(data.error_code).trigger("change");
             jQuery('#code').val(data.code);
  
  
             var ci = data.items;
             items = {};
             $('#prTable tbody').empty();
             $('#prTable tbody').html('<tr><td colspan="4"><?= lang('nothing_to_display') ?></td></tr>');
             localStorage.removeItem('slitems');
             loadRItems();
             $.each(ci, function() { add_product_item(this); });
       
             var IS_JSON = true;
             try {
                 var json = $.parseJSON(data.custom_field);
             } catch(err) {
                 IS_JSON = false;
             }                
  
             if(IS_JSON)  {
                 $.each(json, function(id_field, val_field) {
                     jQuery('#custom_'+id_field).val(val_field);
                 });
             }
  
                 //
             $('#preprepair_hide').empty();
             $('#prerepair_form')[0].reset();
  
             // Custom Toggles
             var IS_JSON = true;
             try {
                 var json = $.parseJSON(data.custom_toggles);
             } catch(err) {
                 IS_JSON = false;
             }
             console.log(data.custom_toggles);
             if(IS_JSON) {
                 $.each(json, function(id_field, val_field) {
                     if (parseInt(val_field) == 1) {
                         document.getElementById('checktoggle_'+id_field).checked = true;
                     }else{
                         document.getElementById('checktoggle_'+id_field).checked = false;
                     }
                 });
             }
  
             jQuery('input[name=cust_pin_code]').val(data.pin_code);
             jQuery('input[name=patternlock]').val(data.pattern);
             if (data.pattern && data.pattern !== '') {
                 setEditPattern(data.pattern);
             }
             $('#prerepair_form :input').not(':submit').clone().hide().appendTo('#preprepair_hide');
  
             footer = '';
             footer += '<button id="upload_modal_btn" class="btn btn-success pull-left" data-mode="edit" data-num="' + encodeURI(num) + '"><i class="fa fa-cloud"></i> <?=lang('view_attached');?></button>';
             
             footer += '<span class="pull-left badge badge-info label-xs" style="width:auto; padding:6px 12px;" ><?=lang('reparation_sms', 'repair_sms');?><input type="checkbox"  value="1" name="sms" id="repair_sms"></span><span  style="width:auto; padding:6px 12px;" class="pull-left badge badge-warning label-xs"><label for="repair_email"><?=lang('send_email_check');?></label><input type="checkbox"  value="1" name="email" id="repair_email"></span><button href="#prerepair" class="prerepair_show btn btn-primary"><i class="fa fa-plus-circle"></i> <?=lang('pre_repair_checklist');?></button><a id="sign_repair" class="btn btn-success" data-mode="update_sign" href="#signModal"  data-toggle="modal" data-num="' + encodeURI(num) + '"><i class="fas fa-signature"></i> <?=lang('sign_repair');?></a><button id="repair_submit" class="btn btn-success" role="button" form="rpair_form"   data-mode="modify" data-num="' + encodeURI(num) + '"><i class="fa fa-save"></i> <?=lang('save_reparation');?></button>';
             jQuery('#footerReparation').html(footer);
             jQuery('#status_edit').val(data.status).trigger('change');
             if (parseInt(data.sms) === 1) { $('#repair_sms').prop('checked', true); }
             if (parseInt(data.email) === 1) { $('#repair_email').prop('checked', true); }
         }
     });
  });
  $("#add_item").autocomplete({
         source: function (request, response) {
             $.ajax({
                 type: 'get',
                 url: '<?= site_url('panel/inventory/suggestions'); ?>',
                 dataType: "json",
                 data: {
                     term: request.term,
                     model_id: $("#model").val(),
                 },
                 success: function (data) {
                     response(data);
                 }
             });
         },
         // source: '<?= site_url('panel/inventory/suggestions'); ?>',
         minLength: 1,
         autoFocus: false,
         delay: 250,
         response: function (event, ui) {
             if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                 //audio_error.play();
                 bootbox.alert('<?= lang('no_product_found') ?>', function () {
                     $('#add_item').focus();
                 });
                 $(this).val('');
             }
             else if (ui.content.length == 1 && ui.content[0].id != 0) {
                 ui.item = ui.content[0];
                 $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                 $(this).autocomplete('close');
                 $(this).removeClass('ui-autocomplete-loading');
             }
             else if (ui.content.length == 1 && ui.content[0].id == 0) {
                 //audio_error.play();
                 bootbox.alert('<?= lang('no_product_found') ?>', function () {
                     $('#add_item').focus();
                 });
                 $(this).val('');
  
             }
         },
         select: function (event, ui) {
             event.preventDefault();
             if (ui.item.id !== 0) {
                 if (ui.item.type != 'service' && parseInt(site.settings.enable_overselling) == 0) {
                     if (ui.item.total_qty > 0) {
                         if (localStorage.getItem('prods')) {
                             slitems = JSON.parse(localStorage.getItem('prods'));
                             item_id = ui.item.id;
                             if (slitems[item_id]) {
                                 if (slitems[item_id].available_now != 0) {
                                     var row = add_product_item(ui.item);
                                     if (row)
                                         $(this).val('');
                                 }else{
                                     alert(ui.item.label + "<?= lang('not_in_stock');?>");
                                 }
                             }else{
                                 var row = add_product_item(ui.item);
                                 if (row)
                                     $(this).val(''); 
                             }
                         }else{
                                 var row = add_product_item(ui.item);
                                 if (row)
                                     $(this).val(''); 
                         }
                     }else{
                         alert(ui.item.label + "<?= lang('not_in_stock');?>");
                     }
                 }else{
                     var row = add_product_item(ui.item);
                     if (row)
                         $(this).val(''); 
                 }
  
                 
             } else {
                 //audio_error.play();
                 bootbox.alert('<?= ('no_product_found') ?>');
             }
         }
     });
     // var items = JSON.parse(localStorage.getItem('slitems'));
     $( "#add_item" ).autocomplete( "option", "appendTo", ".combo" );
  
  
  $(document).on('click', '#add_status_text', function () {
   bootbox.prompt({ 
     title: "<?=lang('change_status_desc');?>", 
     inputType: 'textarea',
     callback: function (result) {
       if (result) {
         $('#status_text').val(result);
       }
     }
   });
  });
  $(document).on('click', '.del', function () {
     var id = $(this).attr('id');
     $(this).closest('#row_' + id).remove();
     delete items[id];
     if(items.hasOwnProperty(id)) { } else {
         localStorage.setItem('slitems', JSON.stringify(items));
         loadRItems();
         return;
     }
     calculate_price();
  });
  
  if (localStorage.getItem('slitems')) {
     loadRItems();
  }
     function calculate_price() {
         var rows = $('#prTable').children('tbody').children('tr');
         var pp = 0;
         $.each(rows, function () {
             pp += parseFloat(parseFloat($(this).find('.rprice').val())*parseFloat($(this).find('.rquantity').val()));
         });
         var service_charges = $('#service_charges').val() ? parseFloat($('#service_charges').val()) : 0;
         $('#potax2').val();
         $('#price_span').html(parseFloat(pp ? pp : 0, 4));
         var potax2 = $('#potax2').val();
         total = $('#totalprice_span').html();
         total = total ? parseFloat(total) : 0;
         total += service_charges;
         invoice_tax = 0;
         $.each(tax_rates, function () {
             if (this.id == potax2) {
                 if (this.type == 2) {
                     invoice_tax = parseFloat(this.rate);
                 }
                 if (this.type == 1) {
                     invoice_tax = parseFloat((((total) * this.rate) / 100), 4);
                 }
             }
         });
  
         $('#totalprice_span').html(parseFloat((parseFloat(pp)), 4));
         $('#sc_span').html(formatDecimal(service_charges));
         $('#tax_span').html(parseFloat(invoice_tax ? invoice_tax : 0));
         gtotal = (total + invoice_tax); 
         $('#gtotal').html(formatDecimal(gtotal));
         return true;
     }
     var invoice_tax = null;
     var total = null;
     $('#potax2').on('change', function() {
         var potax2 = $('#potax2').val();
         var service_charges = $('#service_charges').val() ? parseFloat($('#service_charges').val()) : 0;
         total = $('#totalprice_span').html();
         total = total ? parseFloat(total) : 0;
         // total += service_charges;
  
         $.each(tax_rates, function () {
             if (this.id == potax2) {
                 if (this.type == 2) {
                     invoice_tax = parseFloat(this.rate);
                 }
                 if (this.type == 1) {
                     invoice_tax = parseFloat((((total) * this.rate) / 100), 4);
                 }
             }
         });
  
         $('#tax_span').html(formatDecimal(invoice_tax));
         $('#gtotal').html(formatDecimal((invoice_tax + total)));
     });
  
  
     
     old_row_qty = 1;
     old_row_price = 1;
  
     if ($('.repair_price').length > 0) {
       console.log($('.repair_price'));
  
       $('#rpair_form').on("focus", '.repair_price', function () {
           old_row_price = $(this).val();
       }).on("change", '.repair_price', function () {
           if (!is_numeric($(this).val()) || parseFloat($(this).val()) < 0) {
               $(this).val(old_row_price);
               // bootbox.alert('Unexpected Value');
               return;
           }
           var row = $(this).closest('tr');
           var new_price = parseFloat($(this).val()),
           item_id = row.attr('data-item-id');
           item = items[item_id];
           items[item_id].price = new_price;
           localStorage.setItem('slitems', JSON.stringify(items));
           loadRItems();
       });
     }
     if ($('.repair_quantity').length > 0) {
       console.log($('.repair_quantity'));
       $('#rpair_form').on("focus", '.repair_quantity', function () {
           old_row_qty = $(this).val();
       }).on("change", '.repair_quantity', function () {
           if (!is_numeric($(this).val()) || parseFloat($(this).val()) < 0) {
               $(this).val(old_row_qty);
               // bootbox.alert('Unexpected Value');
               return;
           }
           var row = $(this).closest('tr');
           var new_qty = parseFloat($(this).val()),
           item_id = row.attr('data-item-id');
           item = items[item_id];
           items[item_id].qty = new_qty;
           localStorage.setItem('slitems', JSON.stringify(items));
           loadRItems();
       });
     }
  
  
     $(document).on('change', '#service_charges', function () {
         calculate_price();
     });
      $(document).on('keyup', '#service_charges', function () {
         calculate_price();
     });
     function loadRItems() {
         if (localStorage.getItem('slitems')) {
             items = JSON.parse(localStorage.getItem('slitems'));
             var pp = 0;
             $("#prTable tbody").empty();
             $.each(items, function () {
                 var row_no = this.id;
                 var item_id = this.id;
                 var newTr = $('<tr id="row_' + row_no + '" class="item_' + this.id + '" data-item-id="' + row_no + '"></tr>');
                 tr_html = '<td><input name="item_id[]" id="item_id" type="hidden" value="' + this.id + '"><input name="item_name[]" type="hidden" value="' + this.name + '"><input name="item_code[]" type="hidden" value="' + this.code + '"><span id="name_' + row_no + '">' + this.name + ' (' + this.code + ')</span></td>';
                   tr_html += '<td>'+'<input class="form-control text-center rquantity repair_quantity" name="item_quantity[]" type="text" value="' + formatDecimal(this.qty) + '" data-id="' + row_no + '" data-item="' + this.id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
                 tr_html += '<td>'+'<input class="form-control text-center rprice repair_price" name="item_price[]" type="text" value="' + formatDecimal(this.price) + '" data-id="' + row_no + '" data-item="' + this.id + '" id="item_price_' + row_no + '" onClick="this.select();"></td>';
                 tr_html += '<td class="text-center"><i class="fa fa-times tip del" id="' + row_no + '" title="Remove" style="cursor:pointer;"></i></td>';
                 newTr.html(tr_html);
                 newTr.prependTo("#prTable");
                 pp += (parseFloat(this.price)*parseFloat(this.qty));
                 $('.item_' + item_id).addClass('warning');
             });
             $('#price_span').html(pp);
             var service_charges = parseFloat($('#service_charges').val());
             var total_ = parseFloat(pp) + service_charges;
             $('#totalprice_span').html(total_);
             var potax2 = $('#potax2').val();
             $.each(tax_rates, function () {
                 if (this.id == potax2) {
                     if (this.type == 2) {
                         invoice_tax = parseFloat(this.rate);
                     }
                     if (this.type == 1) {
                         invoice_tax = parseFloat((((total_) * this.rate) / 100), 4);
                     }
                 }
             });
             $('#sc_span').html(service_charges?service_charges:0);
             $('#tax_span').html(invoice_tax?invoice_tax:0);
             $('#gtotal').html(formatDecimal((invoice_tax?invoice_tax:0) + (total_?total_:0)));
         }else{
             var service_charges = ($('#service_charges').val()) ? $('#service_charges').val() : '0';
             var potax2 = $('#potax2').val();
             $.each(tax_rates, function () {
                 if (this.id == potax2) {
                     if (this.type == 2) {
                         invoice_tax = formatDecimal(this.rate);
                     }
                     if (this.type == 1) {
                         invoice_tax = formatDecimal((((service_charges) * this.rate) / 100), 4);
                     }
                 }
             });
             $('#tax_span').html(invoice_tax);
             $('#price_span').html(0);
             $('#sc_span').html(formatDecimal(service_charges?service_charges:0))
             $('#gtotal').html(formatDecimal(parseFloat(service_charges?service_charges:0) + parseFloat(invoice_tax)) );
         }
     }
  items = {};
  function add_product_item(item) {
         if (item == null) {
             return false;
         }
         item_id = item.id;
         if (items[item_id]) {
             items[item_id].qty = (parseFloat(items[item_id].qty) + 1).toFixed(2);
             if (item.type != 'service') {
                 items[item_id].available_now = (parseFloat(items[item_id].available_now) - 1).toFixed(2);
             }
         } else {
             items[item_id] = item;
             if (item.type != 'service') {
                 items[item_id].available_now -= 1;
             }
             
         }
  
         localStorage.setItem('slitems', JSON.stringify(items));
  
         loadRItems();
         return true;
     }
  $('select').select2({placeholder: "<?=lang('select_placeholder');?>"});
  
  $(function () {
   $('#rpair_form').parsley({
     errorsContainer: function(pEle) {
         var $err = pEle.$element.closest('.form-group');
         return $err;
     }
   }).on('form:submit', function(event) {
     jQuery('#repair_submit').attr('disabled', true);
  
     var mode = jQuery('#repair_submit').data("mode");
     var id = jQuery('#repair_submit').data("num");
     var code = jQuery('#code').val();
     var status_code = jQuery('#status_edit').val();
     var url = "";
     var dataString = new FormData($('#rpair_form')[0]);
     if ($('#category_select').val() == 'other') {
         $('#category_select').attr('required', false);
         $('#category_input').attr('required', true);
     }
     dataString.append('code',code);
     dataString.append('status',status_code);
     var sms = $('#repair_sms').prop('checked');
     var email = $('#repair_email').prop('checked');
     dataString.append('sms', sms);
     dataString.append('email', email);
  
     if (mode == "add") {
         <?php if($settings->open_report_on_repair_add > 0): ?>
          newWindow = window.open("", "_blank");
         <?php endif;?>
         url = base_url + "panel/reparation/add";
         $.ajax({
             url: url,
             type: "POST",
             data:  dataString,
             contentType:false,
             cache: false,
             processData:false,
             success: function (result) {
                 jQuery('#repair_submit').removeAttr('disabled');
  
                 toastr['success']("<?= lang('add'); ?>", "<?= lang('reparation_title'); ?> " + name + " " + " <?= lang('added'); ?>");

                 
                 <?php if($settings->open_report_on_repair_add > 0): ?>
                   newWindow.location = base_url + "panel/reparation/invoice/" + encodeURI(result.id) + "/" + (<?=$settings->open_report_on_repair_add;?>);
                 <?php endif;?>


                 setTimeout(function () {
                     $('#reparationmodal').modal('hide');
                     find_reparation(result.id);
                     $('#dynamic-table').DataTable().ajax.reload();
                     $('#dynamic-table-completed').DataTable().ajax.reload();
                     $('#view_reparation').modal('show');
                 }, 500);
  
             }
         });
  
     } else {
         url = base_url + "panel/reparation/edit";
         dataString.append('id',id);
         $.ajax({
             url: url,
             type: "POST",
             data:  dataString,
             contentType:false,
             cache: false,
             processData:false,
             success: function (result) {
                 jQuery('#repair_submit').removeAttr('disabled');
               
                 toastr['success']("<?= lang('edit'); ?>", "<?= lang('reparation_title'); ?>: " + name + " " + "<?= lang('edited'); ?>");
                 // sms_result = result.sms_result;
                 // if (sms_result.sms_sent !== 'true' && sms_result.sms_sent !== 'false') {
                 //     toastr['warning'](sms_result.sms_sent);
                 // }
                 setTimeout(function () {
                     $('#reparationmodal').modal('hide');
                     find_reparation(id);
                     $('#dynamic-table').DataTable().ajax.reload();
                     $('#dynamic-table-completed').DataTable().ajax.reload();
                     $('#view_reparation').modal('show');
                 }, 500);
             }
         });
     }
     return false;
  });
  });
  jQuery('.inp_cat').hide();
  
  jQuery("#category_select").on("select2:select", function (e) {
     var selected = jQuery("#category_select").val();
     if(selected === 'other') {
         jQuery('.select_cat').hide();
         jQuery('.inp_cat').show();
         jQuery('#category_input').val('');
         jQuery('#category_input').focus();
  
     }
     else
     {
         jQuery('#category_select').val(selected);
     }
  });
  
  function find_reparation(num) {
     jQuery.ajax({
         type: "POST",
         url: base_url + "panel/reparation/getReparationByID",
         data: "id=" + num,
         cache: false,
         dataType: "json",
         success: function(data) {
             console.log(data);
             if (typeof data.name === 'undefined') {
                 alert('Not Found');
             } else {
                 jQuery('#titoloOE').html("<?=lang('reparation_title');?>: " + " " + data.model_name + " <span>");
                 jQuery('#rv_client').html(data.name);
                 jQuery('#rv_condition').html(data.status);
                 jQuery('#rv_created_at').html(fld(data.date_opening));
                 jQuery('#rv_defect').html(data.defect);
                 jQuery('#rv_category').html(data.category);
                 jQuery('#rv_model').html(data.manufacturer + ' ' + data.model_name);
                 jQuery('#rv_price').html('<?= $settings->currency; ?>' + formatMoney(data.grand_total));
                 jQuery('#rv_phone_number').html(data.telephone);
                 jQuery('#rv_phone_number').val(data.telephone);
                 jQuery('#rv_rep_code').html(data.code);
                 jQuery('#rv_comment').html(data.comment);
                 jQuery('#rv_imei').html(data.imei);
                 jQuery('#rv_diagnostics').html(data.diagnostics);
                 warranties = <?=json_encode($warranties);?>;
                 jQuery('#rv_warranty').html(warranties[data.warranty]);
  
                 jQuery('.show_custom').html('');
                 var IS_JSON = true;
                 try
                 {
                     var json = $.parseJSON(data.custom_field);
                 }
                 catch(err)
                 {
                     IS_JSON = false;
                 }                
                 if(IS_JSON) 
                 {
                     $.each(json, function(id_field, val_field) {
                         jQuery('#v'+id_field).html(val_field);
                     });
                 }
  
                 var string = "<div class=\"pull-right btn-group\">"+'<span class="pull-left badge badge-info label-xs" style="padding:6px 12px;" ><?=lang('reparation_sms', 'sms');?><input type="checkbox" '+(parseInt(data.sms) === 1 ? 'checked' : '' )+' disabled value="1" name="sms"></span><span  style="padding:6px 12px;" class="pull-left badge badge-warning label-xs"><label for="email"><?=lang('send_email_check');?></label><input type="checkbox" '+(parseInt(data.email) === 1 ? 'checked' : '' )+' disabled value="1" name="email"></span>';
                 <?php if($this->Admin || $this->GP['repair-view_files']): ?>
                     string += '<button id="upload_modal_btn" class="btn btn-success pull-left" data-mode="edit" data-num="' + encodeURI(num) + '"><i class="fa fa-cloud"></i> <?=lang('view_attached');?></button>';
                 <?php endif;?> 
                 string += "<button type=\"button\" data-type=\"2\" data-num=\"" + data.id + "\" id=\"print_reparation\" class=\"btn btn-default\"><i class=\"fa fa-print\"></i> <?= lang('report'); ?></button><a target='_blank' href=\"<?=base_url();?>panel/reparation/invoice/" + data.id + "/1/\" class=\"btn btn-default\"><i class=\"fa fa-print\"></i> <?= lang('invoice');?></a><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> <?=lang('go_back');?></button></div><div class=\"btn-group pull-left\">";
  
                 <?php if($this->Admin || $GP['repair-delete']): ?>
                     string += "<button data-dismiss=\"modal\" id=\"delete_reparation\" data-num=\"" + data.id + "\" class=\"btn btn-danger\" type=\"button\"><i class=\"fa fa-trash-o \"></i> <?= lang('delete');?></button>";
                 <?php endif; ?>
                 <?php if($this->Admin || $GP['repair-edit']): ?>
                     string += "<button id=\"modify_reparation\" data-dismiss=\"modal\" href=\"#reparationmodal\" data-toggle=\"modal\" data-num=\"" + data.id + "\" class=\"btn btn-success\"><i class=\"fas fa-edit\"></i><?=lang('modify');?></button>";
                 <?php endif; ?>
                 next_status = data.next_status
                 
                 if (data.status > 0 && next_status) {
                     string = string + "<button type=\"button\" id=\"status_change\" class=\"btn btn-primary\" data-to_status=\"" + next_status.id + "\" data-num=\"" + data.id + "\"><i class=\"fa fa-check\"></i> "+"<?=lang('update_status');?>"+" </button>";
                 }
                 string = string + "</div>";
  
                 if (data.status > 0) {
                     jQuery('#rv_condition').html(data.status_name);
                     jQuery('#rv_condition').css('color',data.fg_color);
                     jQuery('#rv_condition').css('background-color',data.bg_color);
                 } else {
                     jQuery('#rv_condition').html("<?=lang('cancelled');?>");
                     jQuery('#rv_condition').css('color', '#FFF');
                     jQuery('#rv_condition').css('background-color', '#000');
  
                 }
  

                timeline = `<div class="timeline">
                  <!-- timeline time label -->
                  <div class="time-label">
                    <span class="bg-red"><?=lang('status_changes_title');?></span>
                  </div>
                  <!-- /.timeline-label -->`
                 
  
                 $.each(data.timeline, function(){
                   timeline += ` <!-- timeline item -->
                  <div>
                    <i class="fas ${this.log ? 'fa-edit' : 'fa-envelope'} bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> ${this.date}</span>
                      <h3 class="timeline-header">${this.log ? "<?=lang('edit');?>" : this.updated_by_name + ' changed status to ' + this.label}</h3>

                      <div class="timeline-body">
                       ${this.description || (this.log ? '<div class="log-json">'+(this.log)+'</div>' : '')}
                      </div>
                     
                    </div>
                  </div>
                  <!-- END timeline item -->`;
                 });
  

                timeline += `<div>
                    <i class="fas fa-clock bg-gray"></i>
                  </div>
                </div>`;


                 // timeline = '<ul class="timeline timeline-inverse">\
          
                 $('#timeline').html(timeline);
  

                $('.log-json').each(function(){

                  html = ($(this).html());

                  var response=jQuery.parseJSON(html);
                    if(typeof response =='object')
                    {
                      $(this).html(renderjson(response));
                    }
                    else
                    {
                      if(response ===false)
                      {
                         // the response was a string "false", parseJSON will convert it to boolean false
                      }
                      else
                      {
                        // the response was something else
                      }
                    }

                })

                 jQuery('#footerOR').html(string);
             }
         }
     });
  }
  
</script>
<!-- Manufacturer Add -->
<div class="modal fade" id="modelmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="model_title_head"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <div class="panel-body">
          <p class="tips custip"></p>
          <form id="model_form" class="col s12">
            <div class="row">
              <div class="col-md-12 col-lg-6 input-field">
                <?= lang('model_name', 'model_name'); ?>
                <div class="form-line">
                  <select class="form-control" id="model_name" name="name[]" required="" multiple style="width: 100%;"></select>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 input-field">
                <?= lang('model_manufacturer', 'model_manufacturer'); ?>
                <div class="form-line">
                  <input class="form-control manufacturer_name_typeahead" id="manufacturer_name" name="parent_id" required="" style="width: 100%;">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer" id="model_footer">
        <!--    -->
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  .input-group .tt-menu.tt-open {
  top: 34px !important;
  }
  .tt-menu {
  min-width: 160px;
  margin-top: 2px;
  padding: 5px 0;
  background-color: #fff;
  border: 1px solid #ebebeb;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  width: 100%;
  }
  .tt-suggestion {
  display: block;
  padding: 4px 12px;
  }
  .tt-suggestion p {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  height: 17px;
  }
  .tt-suggestion:hover {
  color: #303641;
  background: #f3f3f3;
  }
  .twitter-typeahead{
  display: block !important;
  }
</style>
<script>
  $(document).ready(function () {
      $(document).on('click', '.row_status', function(e) {
          var row = $(this).parent().closest('tr');
          var id = row.attr('id');

          $('#myModal .modal-dialog').load(site.base_url + 'panel/reparation/update_status/' + id);
          $('#myModal').modal('show');
          return false;
      });
  
  
      jQuery(document).on("click", "#status_change", function() {
          var id = jQuery(this).data("num");
          $('#myModal .modal-dialog').load(site.base_url + 'panel/reparation/update_status/' + id);
          $('#myModal').modal('show');
          return false;
      });
  
  
      $(":input").keypress(function(event){
          if ((event.which == '10' || event.which == '13') && event.target.nodeName !== 'TEXTAREA') {
              event.preventDefault();
          }
      });
      $("#model_name").select2({
        tags: true,
        tokenSeparators: [','],
        selectOnClose: true,
      });
  });
  

    function formatPayments(x) {
        if (x) {
            payments = x.split(',');
            paid = "";
            $.each(payments, function(x, payment){
                pay = payment.split('____');
                paid += pay[0] + ": " + formatMyDecimal(pay[1]) + "\n";
            });
            return paid;
        }
        return 0;
    }
    function isEmptyObject(obj) {

        // null and undefined are "empty"
        if (obj == null) return true;

        // Assume if it has a length property with a non-zero value
        // that that property is correct.
        if (obj.length > 0)    return false;
        if (obj.length === 0)  return true;

        // If it isn't an object at this point
        // it is empty, but it can't be anything *but* empty
        // Is it empty?  Depends on your application.
        if (typeof obj !== "object") return true;

        // Otherwise, does it have any properties of its own?
        // Note that this doesn't handle
        // toString and valueOf enumeration bugs in IE < 9
        for (var key in obj) {
            if (hasOwnProperty.call(obj, key)) return false;
        }

        return true;
    }
    
    
  

    function client_name(x) {
        x = x.split('___');
        return '<a class="view_client" href="#view_client" data-toggle="modal" data-num="'+x[0]+'">' + x[1] + '</a>';
    }
  

  var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
      var matches, substringRegex;
  
      // an array that will be populated with substring matches
      matches = [];
  
      // regex used to determine if a string contains the substring `q`
      substrRegex = new RegExp(q, 'i');
  
      // iterate through the pool of strings and for any string that
      // contains the substring `q`, add it to the `matches` array
      $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
          matches.push(str);
        }
      });
  
      cb(matches);
    };
  };
  
  var manufacturers = [
      <?php foreach ($manufacturers as $manufacturer): ?>
          '<?=$manufacturer->name;?>',
      <?php endforeach; ?>
  ];
  $('.manufacturer_name_typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
  }, {
      name: 'manufacturers',
      source: substringMatcher(manufacturers)
  });
  
  
  var categories = [
      <?php foreach (explode(',', $settings->category) as $line): ?>
          '<?=$line;?>',
      <?php endforeach; ?>
  ];
  $('.categories_typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
  }, {
      name: 'categories',
      source: substringMatcher(categories)
  });
  
  $('.model_name_typeahead').typeahead(null, {
      name: 'model',
      display: 'name',
      source: function(query, syncResults, asyncResults) {
          $.get( '<?=base_url();?>panel/inventory/getModels/'+query+'?manufacturer='+encodeURI($('#reparation_manufacturer').val()), function(data) {
              asyncResults(data);
          });
      }
  });
  
  var defectSuggestions = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
          url: '<?=base_url();?>panel/reparation/getDefects/%QUERY',
          wildcard: '%QUERY'
      }
  });
  
  $('.defect_typeahead').typeahead(null, {
      name: 'defect',
      display: 'defect',
      source: defectSuggestions
  });
  
  
  jQuery(".add_model").on("click", function (e) {
      $('#modelmodal').modal('show');
      $('#model_form').trigger("reset");
      $("#model_name").val("").trigger('change');
      $('#model_form').parsley().reset();
      jQuery('#model_title_head').html("<?= lang('add'); ?> <?= lang('model_title'); ?>");
      jQuery('#model_footer').html('<button data-dismiss="modal" class="pull-left btn btn-default" type="button"><i class="fa fa-reply"></i> <?= lang("go_back") ?></button><button id="submit" role="button" form="model_form" class="btn btn-success" data-mode="add"><i class="fa fa-user"></i> <?= lang("add"); ?> <?= lang("model_title"); ?></button>');
  });
  
   $(function () {
    $('#model_form').parsley({
      errorsContainer: function(pEle) {
          var $err = pEle.$element.closest('.form-group');
          return $err;
      }
    }).on('form:submit', function(event) {
      var mode = jQuery('#submit').data("mode");
      var id = jQuery('#submit').data("num");
  
      var name = jQuery('#model_name').val();
      var manufacturer = jQuery('#manufacturer_name').val();
     
      var url = "";
      var dataString = "";
  
      if (mode == "add") {
          url = base_url + "panel/inventory/add_model";
          dataString = $('#model_form').serialize();
          jQuery.ajax({
              type: "POST",
              url: url,
              data: dataString,
              cache: false,
              success: function (data) {
                  toastr['success']("<?= lang('add'); ?>", "<?= lang('model_title'); ?>: " + name + " " + manufacturer + " <?= lang('added'); ?>");
                  setTimeout(function () {
                      $('#modelmodal').modal('hide');
                      if ($('#reparationmodal').hasClass('show')) {
                          jQuery('#model').append('<option value="'+data+'">'+name+'</option>');
                          jQuery('#model').val(data);
                          $("#model").select2();
                      }else{
                          $('#dynamic-table').DataTable().ajax.reload();
                      }
                  }, 500);
  
              }
          });
      } else {
          url = base_url + "panel/inventory/edit_model";
          dataString = $('#model_form').serialize() + "&id=" + encodeURI(id);
          jQuery.ajax({
              type: "POST",
              url: url,
              data: dataString,
              cache: false,
              success: function (data) {
                  toastr['success']("<?= lang('save'); ?>", "<?= lang('model_title'); ?>: " + name + " " + manufacturer + "<?= lang('updated'); ?>");
                  setTimeout(function () {
                      $('#modelmodal').modal('hide');
                      $('#dynamic-table').DataTable().ajax.reload();
                  }, 500);
              }
          });
      }
      return false;
    });
  });
  
</script>
<!-- ============= MODAL View CLient ============= -->
<div class="modal fade" id="view_client" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          <div id="titoloclienti"></div>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12 col-lg-6 bio-row">
              <p><span class="bold"><i class="fa fa-user"></i> <?= lang('client_name'); ?> </span><span id="v_name"></span></p>
            </div>
            <div class="col-md-12 col-lg-6 bio-row">
              <p><span class="bold"><i class="fa fa-user"></i> <?= lang('client_company'); ?> </span><span id="v_company"></span></p>
            </div>
            <div class="col-md-12 col-lg-6 bio-row">
              <p><span class="bold"><i class="fa fa-road"></i> <?= lang('client_address'); ?></span><span id="v_address"></span></p>
            </div>
            <div class="col-md-12 col-lg-6 bio-row">
              <p><span class="bold"><i class="fa fa-globe"></i><?= lang('client_city'); ?></span><span id="v_city"></span></p>
            </div>
            <div class="col-md-12 col-lg-6 bio-row">
              <p>
                <span class="bold">
                <i class="fa fa-globe"></i>
                <?= lang('client_postal_code'); ?>
                </span>
                <span id="v_postal_code"></span>
              </p>
            </div>
            <div class="col-md-12 col-lg-6 bio-row">
              <p><span class="bold"><i class="fa fa-phone"></i> <?= lang('client_telephone'); ?> </span><span id="v_telephone"></span></p>
            </div>
            <div class="col-md-12 col-lg-6 bio-row">
              <p><span class="bold"><i class="fa fa-envelope"></i> <?= lang('client_email'); ?> </span><span id="v_email"></span></p>
            </div>
            <div class="col-md-12 col-lg-6 bio-row">
              <p><span class="bold"><i class="fa fa-barcode"></i> <?= lang('client_vat'); ?> </span><span id="v_vat"></span></p>
            </div>
            <div class="col-md-12 col-lg-6 bio-row">
              <p><span class="bold"><i class="fa fa-quote-left"></i> <?= lang('client_ssn'); ?> </span><span id="v_cf"></span></p>
            </div>
          </div>
          <div class="form-group commenti">
            <label><?= lang('client_comment'); ?></label>
            <textarea class="form-control" id="v_comment" rows="6" disabled></textarea>
          </div>
          <table class="display compact table table-bordered table-striped" id="dynamic-table2">
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
          </table>
        </div>
      </div>
      <div class="modal-footer" id="footerClient"></div>
    </div>
  </div>
</div>
<!-- ============= MODAL MODIFY CLIENTI ============= -->
<div class="modal fade" id="clientmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="titclienti"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="client_form" class="col s12" data-parsley-validate">
          <div class="row">
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <?= lang('client_name', 'name1'); ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-user"></i></span>
                  </div>
                  <input id="name1" name="name" type="text" class="validate form-control" required>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <?= lang('client_company', 'company1'); ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-user"></i></span>
                  </div>
                  <input name="company" id="company1" type="text" class="validate form-control">
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <label><?=lang('geolocate');?></label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-map-marker"></i></span>
                  </div>
                  <div id="locationField">
                    <input id="autocomplete" class="form-control" placeholder="<?=lang('enter_address');?>"
                      onFocus="geolocate()" type="text"></input>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <?= lang('client_address', 'address1'); ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-road"></i></span>
                  </div>
                  <input type="hidden" class="field form-control input-xs" id="street_number">
                  <input type="hidden" class="field form-control input-xs" id="administrative_area_level_1">
                  <input name="address"  id="route" type="text" class="validate form-control input-xs">
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <?= lang('client_city', 'city1'); ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-globe"></i></span>
                  </div>
                  <input name="city" id="locality" type="text" class="validate form-control">
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <?= lang('client_postal_code', 'postal_code'); ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-globe"></i></span>
                  </div>
                  <input name="postal_code" id="postal_code" type="text" class="validate form-control">
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <?= lang('client_telephone', 'telephone'); ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-phone"></i></span>
                  </div>
                  <input id="telephone" name="telephone" type="text" class="validate form-control" data-mask="(999) 999-9999">
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <?= lang('client_email', 'email1'); ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-envelope"></i></span>
                  </div>
                  <input id="email1" name="email" type="email" class="validate form-control">
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <?= lang('client_vat', 'vat1'); ?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-envelope"></i></span>
                  </div>
                  <input name="vat" id="vat1" class="validate form-control">
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-6 input-field">
              <div class="form-group">
                <?= lang('client_ssn', 'cf1'); ?>
                <div class="input-group mb-3">
                  <input name="vat" id="vat1" class="validate form-control">
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-12 input-field">
              <div class="form-group">
                <?=lang('client_image_upload', 'image');?>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa  fa-upload"></i></span>
                  </div>
                  <input id="image" type="file" data-browse-label="Browse" name="image" data-show-upload="false" data-show-preview="false" accept="image/*" class="form-control file">
                </div>
              </div>
            </div>
            <div class="col-lg-4 input-field">
              <div id="showIfImage" style="display: none;">
                <button class="btn btn-primary" id="view_image_in" data-num><i class="fa fa-eye"></i></button>
                <button class="btn btn-danger" id="delete_customer_image" data-num><i class="fa fa-trash-o"></i> <?=lang('delete')?></button>
              </div>
            </div>
            <div class="col-md-12 input-field">
              <div class="form-group">
                <?= lang('client_comment', 'comment1'); ?> <i id="add_timestamp" class="fa fa-calendar"></i>
                <textarea class="form-control" id="comment1" name="comment" rows="6"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" id="footerClient1"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery(document).on("click", ".add_c", function (e) {
      $('#clientmodal').modal('show');
      $('#client_form').trigger("reset");
      $('#client_form').parsley().reset();
      $('#showIfImage').hide();
  
      jQuery('#titclienti').html("<?= lang('add'); ?> <?= lang('client_title'); ?>");
      jQuery('#footerClient1').html('<button data-dismiss="modal" class="pull-left btn btn-default" type="button"><i class="fa fa-reply"></i> <?= lang("go_back"); ?></button><button role="button" form="client_form" id="submit" class="btn btn-success" data-mode="add"><i class="fa fa-user"></i> <?= lang("add"); ?> <?= lang("client_title"); ?></button>');
  });
  
  function showImage(url) {
      var img = new Image();
      img.src = url;
      img.onload = function() {
          bootbox.dialog({ message: "<a target='_blank' href='"+url+"'><center><img src='"+url+"'></center></a>" , backdrop:true, onEscape:true}).find("div.modal-dialog").css({ "width": (this.width)+40+"px"});
      }
  
  };
  
  
  jQuery(document).on("click", "#view_image_in", function (e) {
      e.preventDefault();
      image_name = $(this).attr('data-num');
      if (image_name) {
          showImage('<?=base_url();?>assets/uploads/images/'+image_name);
      }else{
          bootbox.alert({
              message: '<?=lang('client_no_image');?>',
              backdrop: true
          });
      }
  });
  
  jQuery(document).on("click", "#delete_customer_image", function (e) {
      e.preventDefault();
      var num = jQuery(this).attr("data-num");
      jQuery.ajax({
          type: "POST",
          url: base_url + "panel/customers/delete_image",
          data: "id=" + encodeURI(num),
          cache: false,
          dataType: "json",
          success: function (data) {
              if (data.success) {
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
                  toastr['success']("client image removed");
                  $('#showIfImage').hide();
  
              }else{
                  toastr['error']("error client image not removed");
              }
          }
      });
  });
  
  jQuery(document).on("click", "#modify_client", function () {
          jQuery('#titclienti').html('<?= lang('edit'); ?> <?= lang('client_title'); ?>');
          var num = jQuery(this).data("num");
          $('#client_form').trigger("reset");
          $('#client_form').parsley().reset();
  
          jQuery.ajax({
              type: "POST",
              url: base_url + "panel/customers/getCustomerByID",
              data: "id=" + encodeURI(num) + "&token=<?=$_SESSION['token'];?>",
              cache: false,
              dataType: "json",
              success: function (data) {
                  jQuery('#name1').val(data.name);
                  jQuery('#company1').val(data.company);
                  jQuery('#route').val(data.address);
                  jQuery('#locality').val(data.city)
                  jQuery('#telephone').val(data.telephone);
                  jQuery('#email1').val(data.email)
                  jQuery('#comment1').val(data.comment);
                  jQuery('#postal_code').val(data.postal_code);
                  jQuery('#vat1').val(data.vat);
                  jQuery('#cf1').val(data.cf);
  
                  $('#showIfImage').hide();
                  if (data.image) {
                      $('#showIfImage').show();
                      $('#view_image_in').attr('data-num', data.image);
                      $('#delete_customer_image').attr('data-num', data.id);
                  }
                  jQuery('#footerClient1').html('<button data-dismiss="modal" class="pull-left btn btn-default" type="button"><i class="fa fa-reply"></i> <?= lang("go_back"); ?></button><button id="submit" role="button" form="client_form" class="btn btn-success" data-mode="modify" data-num="' + encodeURI(num) + '"><i class="fa fa-save"></i> <?= lang("save"); ?> <?= lang("client_title"); ?></button>')
              }
          });
      });
  
  $(function () {
  $('#client_form').parsley({
      errorsContainer: function(pEle) {
          var $err = pEle.$element.closest('.form-group');
          return $err;
      }
  }).on('form:submit', function(event) {
      var mode = jQuery('#submit').data("mode");
      var id = jQuery('#submit').data("num");
  
      var name = jQuery('#name1').val();
      var company = jQuery('#company1').val();
      var address = jQuery('#address1').val();
      var city = jQuery('#city1').val();
      var telephone = jQuery('#telephone').val();
      var email = jQuery('#email1').val();
      var comment = jQuery('#comment1').val();
      var vat = jQuery('#vat1').val();
      var cf = jQuery('#cf1').val();
  
      var url = "";
      var formData = new FormData($('form#client_form')[0]);
      if (mode == "add") {
          url = base_url + "panel/customers/add";
          jQuery.ajax({
              url: url,
              type: 'POST',
              data: formData,
              async: false,
              cache: false,
              contentType: false,
              processData: false,
              success: function (data) {
                  if(data.success)  {
                      toastr['success']("<?= lang('add');?>", "<?= lang('client_title');?> " + name + " " + company + " <?= lang('added');?>");
                      if (data.error) {
                          toastr['error'](data.error);
                      }
                      setTimeout(function () {
                          $('#clientmodal').modal('hide');
                          jQuery('#client_name').append('<option value="'+data.id+'">'+name+' '+company+'</option>');
                          if ($('#reparationmodal').hasClass('show')) {
                              $('#client_name').val(data.id);
                              $("#client_name").select2();
                          }else{
                              find_client(data.id);
                              $('#dynamic-table').DataTable().ajax.reload();
                              $('#view_client').modal('show');
                          }
                      }, 500);
                  }else{
                      toastr['error'](data.error);

                  }

                 
              }
          });
      } else {
          formData.append('id', id);
          url = base_url + "panel/customers/edit";
          jQuery.ajax({
              url: url,
              type: 'POST',
              data: formData,
              async: false,
              cache: false,
              contentType: false,
              processData: false,
              success: function (data) {
                  if(data.success)  {

                      toastr['success']("<?= lang('edit');?>", "<?= lang('client_title');?>: " + name + " " + company + "<?= lang('updated');?>");
                      if (data.error) {
                          toastr['error'](data.error);
                      }
                      setTimeout(function () {
                          $('#clientmodal').modal('hide');
                          find_client(id);
                          $('#dynamic-table').DataTable().ajax.reload();
                          $('#view_client').modal('show');
                      }, 500);
                  }else{
                      toastr['error'](data.error);

                  }
              }
          });
      }
      return false;
  });
  });
  
  
  jQuery(document).on("click", "#status_change_inline", function () {
    var num = jQuery(this).data("num");
    var repair = jQuery(this).data("repair");
    var statuses = <?=json_encode($statuses);?>;
    dropdown = '<select class="form-control" id="status_dropdown" data-repair="'+repair+'">';
    $.each(statuses, function() { 
        dropdown += '<option '+(num==this.id ? 'selected' : '')+' value="'+this.id+'">'+this.label+'</option>';
    });
    dropdown += '</select>';
    $(this).parent().html(dropdown);
  });
  
  jQuery(document).on("change", "#status_dropdown", function () {
  new_value = $(this).val();
  var repair = jQuery(this).data("repair");
  $(this).parent().html(set_status_by_id(new_value));
  // Ajax Change Status
  jQuery.ajax({
      type: "POST",
      url: base_url + "panel/reparation/status_toggle",
      data: "id=" + encodeURI(repair) + "&to_status="+encodeURI(new_value),
      cache: false,
      dataType: "json",
      success: function(data) {
          if (data.success) {
              msg = '';
              if (data.data.sms_sent) {
                  msg += "<?= lang('sms_sent'); ?>\n";
              }else{
                  msg += "<?= lang('sms_not_sent'); ?>\n";
              }
              if (data.data.email_sent) {
                  msg += "<?= lang('email_sent'); ?>\n";
              }else{
                  msg += "<?= lang('email_not_sent'); ?>\n";
              }
              toastr['success']("<?= lang('status_changed_to');?> "+data.data.label+"\n"+msg);
  
              $('#dynamic-table').DataTable().ajax.reload();
              $('#dynamic-table-completed').DataTable().ajax.reload();
  
          } else {
              toastr['error']("<?= lang('error_support');?>");
          }
      }
  });
  
  
  });
  
  
function set_status_by_id(id) {
    var statuses = <?=json_encode($statuses);?>;
    status = null;
    $.each(statuses, function() { 
        if (id == this.id) {
            status = this;
        }
    });
    if (status) {
        return '<span class="row_status badge" style="background-color:'+status.bg_color+'; color:'+status.fg_color+';">'+status.label+'</span>';
    }
  }
  
  function reparationID_link(x) {
      x = x.split('___');
      return '<a data-dismiss="modal" class="view" href="#view_reparation" data-toggle="modal" data-num="'+x[0]+'">'+x[1]+'</a>';
  }
  function status_(x) {
      if (x == 'cancelled') {
          return '<div class="text-center"><span class="row_status badge" style="background-color:#000;"><?=lang('cancelled');?></span></div>';
      }
      x = x.split('____');
      return '<div class="text-center"><span id="" data-num="'+x[3]+'" data-repair="'+x[4]+'" class="row_status badge" style="background-color:'+x[1]+'; color:'+x[2]+';">'+x[0]+'</span></div>';
  }
  
  // View Client - FIND
  var oTable;
  function find_client(num) {
      jQuery.ajax({
          type: "POST",
          url: base_url + "panel/customers/getCustomerByID",
          data: "id=" + encodeURI(num) + "&token=<?=$_SESSION['token'];?>",
          cache: false,
          dataType: "json",
          success: function (data) {
              if (typeof data.name === 'undefined') {
                  $('#view_client').modal('hide');
                  toastr['error']('No Client', '');
              } else {
                  jQuery('#titoloclienti').html('Client: ' + data.name);
                  jQuery( ".flatb.add" ).data( "name", data.name+' '+data.company);
                  jQuery( ".flatb.add" ).data( "id_name", data.id);
                  jQuery( ".flatb.lista" ).data( "name", data.name+' '+data.company);
                  jQuery('#v_name').html(data.name);
                  jQuery('#v_company').html(data.company);
                  jQuery('#v_address').html(data.address);
                  jQuery('#v_city').html(data.city)
                  jQuery('#v_telephone').html(data.telephone);
                  jQuery('#v_email').html(data.email)
                  jQuery('#v_comment').html(data.comment);
                  jQuery('#v_vat').html(data.vat);
                  jQuery('#v_postal_code').html(data.postal_code);
                  jQuery('#v_cf').html(data.cf);
  
                  if ($.fn.DataTable.isDataTable('#dynamic-table2') ) {
                    $('#dynamic-table2').DataTable().destroy();
                  }
  
                  var tableCR = $('#dynamic-table2').dataTable({
                      "aaSorting": [[3, "asc"]],
                      "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                      "iDisplayLength": <?=$settings->rows_per_page; ?>,
                      'bProcessing': true, 'bServerSide': true,
                      'sAjaxSource': '<?=base_url(); ?>panel/reparation/getAllReparations/'+data.id,
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
                  });
  
                  var string = "<button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> <?= lang('go_back');?></button>";
                  <?php if($this->Admin || $GP['customers-edit']): ?>
                      string += "<button data-dismiss=\"modal\" id=\"modify_client\" href=\"#clientmodal\" data-toggle=\"modal\" data-num=\"" + encodeURI(num) + "\" class=\"btn btn-success\"><i class=\"fa fa-pencil\"></i> <?= lang('modify'); ?></button>";
                  <?php endif; ?>
                  <?php if($this->Admin || $GP['customers-delete']): ?>
                      string += "<button id=\"delete_client\" data-dismiss=\"modal\" data-num=\"" + encodeURI(num) + "\" class=\"btn btn-danger\" type=\"button\"><i class=\"fa fa-trash-o \"></i> <?= lang('delete'); ?></button>";
                  <?php endif; ?>
                  jQuery('#footerClient').html(string);
              }
          }
      });
  }
  
</script>
<script>
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.
  
  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
  
  var placeSearch, autocomplete;
  
  var componentForm = {
    street_number: 'long_name',
    route: 'long_name',
    locality: 'long_name',
     administrative_area_level_1: 'short_name',
    // country: 'long_name',
     postal_code: 'short_name'
  };
  
  
  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});
  
    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
  }
  
  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
  
    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }
  
    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    var fullAddress = [];
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }
        if (addressType == "street_number") {
            fullAddress[0] = val;
        } else if (addressType == "route") {
            fullAddress[1] = val;
        }
    }
    document.getElementById('route').value = fullAddress.join(" ");
    if (document.getElementById('route').value !== "") {
      document.getElementById('route').disabled = false;
    }
  }
  
  
  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
  
  
  $(document).ready(function () {
    jQuery("#submit_prerepairs").on("click", function (e) {
        e.preventDefault();
        $('#preprepair_hide').empty();
        $('#prerepair_form :input').not(':submit').clone().hide().appendTo('#preprepair_hide');
        $('#prerepair').modal('hide');
    });
    jQuery("#exit_prepair").on("click", function (e) {
        e.preventDefault();
        $('#preprepair_hide').empty();
        $('#prerepair_form :input').not(':submit').clone().hide().appendTo('#preprepair_hide');
        $('#prerepair').modal('hide');
    });
  
    jQuery(document).on("click", ".prerepair_show", function(event) {
        event.preventDefault();
        $('#preprepair_hide').empty();
        $('#prerepair').modal({
            backdrop: 'static',
            keyboard: false
        }).appendTo('body');
    });
        
  });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= $settings->google_api_key?>&libraries=places&callback=initAutocomplete"
  async defer></script>
<div class="modal modal-default-filled fade" id="prerepair" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?=lang('pre_repair_checklist');?></h4>
        <button type="button" class="close" id="exit_prepair" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <div class="panel-body">
            <form id="prerepair_form">
          <div class="row">
              <div class="col-md-6">
          <div class="row">

                <?php
                  $repair_custom_toggles = trim($settings->repair_custom_toggles);
                  if ($repair_custom_toggles !== ''):
                      $repair_custom_toggles = explode(',', $repair_custom_toggles);
                      foreach($repair_custom_toggles as $line): ?>

                <div class="col-lg-6">
                  <div class="checkbox-toggle-styled-on-off">
                    <input name="checktoggle_<?= bin2hex($line); ?>" type="hidden" value="0">
                    <input name="checktoggle_<?= bin2hex($line); ?>" id="checktoggle_<?= bin2hex($line); ?>" value="1" type="checkbox">
                    <label for="checktoggle_<?= bin2hex($line); ?>"><?= $line; ?></label>
                  </div>
                </div>
                <?php endforeach; endif;?>
              </div>
              </div>
              <div class="col-md-6">

                

                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="one-tab-default-tab" data-toggle="pill" href="#one-tab-default" role="tab" aria-controls="one-tab-default" aria-selected="true"><?=lang('pin_code');?></a>
                    </li>

                    <li class="nav-item ">
                      <a class="nav-link active" id="one-tab-default-tab" data-toggle="pill" href="#two-tab-default" role="tab" aria-controls="two-tab-default" aria-selected="true"><?=lang('pattern');?></a>
                    </li>

                  </ul>


                
                  <div class="tab-content">
                    <div class="tab-pane" id="one-tab-default">
                      <div class="form-group">
                        <label><?=lang('pin_code');?></label>
                        <input type="text" name="cust_pin_code" class="form-control">
                      </div>
                    </div>
                    <div class="tab-pane active" id="two-tab-default">
                      <div id="patternHolder"></div>
                      <input type="hidden" name="patternlock" id="patternlock">
                    </div>
                  </div>
          </div>
                </div>
              </div>
            </form>
        </div>
      </div>
      <div id="" class="modal-footer">
        <button class="btn btn-submit btn-primary" id="submit_prerepairs"><?=lang('submit');?></button>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  @media (min-width: 768px) {
  .modal-xl {
    width: calc(100% - 30px);
   max-width:calc(100% - 30px);
  }
}
.input-group > .select2-container--bootstrap {
    width: auto;
    flex: 1 1 auto;
}

.input-group > .select2-container--bootstrap .select2-selection--single {
    height: 100%;
    line-height: inherit;
    padding: 0.5rem 1rem;
}
</style>