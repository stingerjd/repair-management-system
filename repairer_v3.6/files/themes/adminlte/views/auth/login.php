<style type="text/css">
    <?php if($settings->background): ?>
      .login-page {
        position: relative;
        /*opacity: 0.65;*/
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

      }
      .login-page {
        background-image: url('<?= base_url(); ?>assets/uploads/backgrounds/<?= $settings->background;?>');
        height: 100%;
      }
    <?php endif; ?>
</style>

<div class="login-box">
  <div class="login-logo">
    <img style="width: 100%" src="<?= base_url(); ?>assets/uploads/logos/<?= $settings->logo; ?>">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
    <p class="login-box-msg"><?php echo lang('login_subheading');?></p>
  
    <?php if(strip_tags($message)):?>
      <div class="alert alert-info" id="infoMessage"><?php echo strip_tags($message);?></div>
    <?php endif; ?>

      <?php echo form_open("panel/login", 'id="login_form"');?>

        <div class="form-group has-feedback">
          <?php echo form_input($identity, '', "class='form-control'");?>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          
          <?php echo form_input($password, '', "class='form-control'");?>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
           <?php if ($this->mSettings->enable_recaptcha): ?>
              <center>
                <?= $this->recaptcha->create_box(array('data-size'=>'compact')); ?>
                </center>
                <br>
            <?php endif; ?>


             <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                  <label for="remember">
                      <?php echo lang('login_remember_label');?>
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary btn-block"');?>
              </div>
              <!-- /.col -->
            </div>


        </div>

      <?php echo form_close();?>

        
    

      <p class="mb-1">
        <a  href="<?=base_url();?>/panel/login/forgot_password"><?=lang('login_forgot_password');?></a>
      </p>
      <p class="mb-0">
        <a href="<?=base_url();?>"><?=lang('back_homepage');?></a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<script type="text/javascript">

<?php if ($this->mSettings->enable_recaptcha): ?>
window.onload = function() {
  var recaptcha = document.forms["login_form"]["g-recaptcha-response"];
  recaptcha.required = true;
  recaptcha.oninvalid = function(e) {
    alert("<?=lang('complete_captcha');?>");
  }
}
<?php endif; ?>
</script>