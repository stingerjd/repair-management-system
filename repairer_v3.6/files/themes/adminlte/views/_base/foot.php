<?php if ( $this->ion_auth->logged_in() ): ?>
<div class="modal fade" id="sendSMSModal" role="dialog" aria-labelledby="sendSMSModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"><?=lang('send_sms_label');?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" id="SendSMS">
      <div class="form-group">
          <?php $client_dp = array(); if($clients): foreach ($clients as $client) {
            if (is_numeric($client->telephone)) {
              $client_dp[$client->id] = $client->name;
            }
          } endif;
          ?>
          <?= form_dropdown('client_id', $client_dp, set_value('client_id'), 'class="form-control" style="width:100%;" id="client_id_sms"');?>
          </div>
          <div>
            <textarea required="" name="text" id="fastsms" class="textarea" placeholder="Message" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
          </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=lang('close');?></button>
        <button type="submit" form="SendSMS" class="btn btn-primary" value="Submit"><?=lang('send');?></button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sendEmailModal" role="dialog" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"><?=lang('send_email_label');?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="#" method="post" id="sendEmail">
                <div class="form-group">
                  <?php $client_dp = array(); if($clients): foreach ($clients as $client) {
                    if (filter_var($client->email, FILTER_VALIDATE_EMAIL)) {
                      $client_dp[$client->id] = $client->name;
                    }
                  }endif;
                  ?>
                  <?= form_dropdown('email_to[]', $client_dp, set_value('email_to'), 'class="form-control" multiple style="width:100%;"');?>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="<?= lang('email_subject'); ?>">
                </div>
                <div>
                  <textarea name="body" id="sms_body" class="textarea" placeholder="<?= lang('email_body'); ?>" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=lang('close');?></button>
        <button type="submit" form="sendEmail"  class="btn btn-primary"><?=lang('send');?></button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$("#sendEmail").submit(function(e) {
  e.preventDefault();
  $('#loadingmessage').show();  // show the loading message.
  emailto = jQuery('#emailto').val();
  subject = jQuery('#subject').val();
  body = jQuery('#body').val();
  jQuery.ajax({
    type: "POST",
    url: base_url + "panel/welcome/send_mail",
    data: $('#sendEmail').serialize(),
    cache: false,
    dataType: "json",
    success: function (data) {
      $('#loadingmessage').hide();
      if (data == 2) {
        toastr.info('<?= lang('field_empty'); ?>');
      }else if (data == 1) {
        toastr.success('<?= lang('email_sent'); ?>');
      }else{
        toastr.warning('<?= lang('email_not_sent'); ?>');
      }
      }
  });
});

$("#SendSMS").submit(function(e) {
  e.preventDefault();
  dta = $(this).serialize();
  jQuery.ajax({
      type: "POST",
      url: base_url + "panel/reparation/send_sms",
      data: dta,
      cache: false,
      dataType: "json",
      success: function(data) {
        if(data.status == true) {
            toastr.success('<?= lang('sms_sent'); ?>');
        } else{
            toastr.warning('<?= lang('sms_not_sent'); ?>');
        }
      }  
  });
});


</script>
<?php endif;?>


<div class="modal fade show" id="myModal" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    </div>
  </div>
</div>


<div class="modal fade show" id="myModal2" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    </div>
  </div>
</div>



<div class="modal fade show" id="myModalLG" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    </div>
  </div>
</div>

<!-- /.modal -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>

$('#myModal').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});
$('#myModalLG').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});
$.widget.bridge('uibutton', $.ui.button);
$.extend(true, $.fn.dataTable.defaults, {"oLanguage":<?=json_encode(lang('datatables_lang'));?>});
jQuery(document).on("click", "#add_timestamp", function (e) {
    comment = $(this).next();
    comment.val(comment.val() + moment().format('DD-MM-YYYY @ hh:mm')+'h ');
    comment.focus();
});


	     
</script>



    <!-- jQuery Knob Chart -->
    <script src="<?= $assets ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= $assets ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- Summernote -->
    <script src="<?= $assets ?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= $assets ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= $assets ?>dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= $assets ?>dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= $assets ?>dist/js/pages/dashboard.js"></script>
    <script type="text/javascript">
      $('.summernote').summernote();
    </script>



</body>
</html>