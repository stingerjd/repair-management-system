
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $settings->title; ?></title>

    <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="<?= $assets ?>dist/css/adminlte.min.css">
      <link rel="stylesheet" href="<?= $assets ?>plugins/toastr/toastr.min.css">



    <link rel="stylesheet" href="<?= $assets; ?>dist/css/custom/home.css">
    <link rel="stylesheet" href="<?= $assets; ?>dist/css/custom/custom.css">


      <link rel="stylesheet" href="<?= $assets ?>plugins/fontawesome-free/css/all.min.css">


    <script src="<?= $assets ?>plugins/jquery/jquery.min.js"></script>


    <script src="<?= $assets ?>plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= $assets ?>plugins/toastr/toastr.min.js"></script>


    <script type="text/javascript">
        var base_url = "<?=site_url();?>";
        var site = <?= json_encode(array('base_url' => base_url(), 'dateFormats' => $dateFormats));?>;
    </script>
    <script src="<?= $assets ?>plugins/custom/core.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>

    jQuery(document).ready(function () {
     
    var postJSON;
    postJSON = 'aa'

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

    jQuery(document).on("click", "#submit_track", function () {
            $('#loadingmessage').show();  // show the loading message.

            var code = jQuery('#code').val();
            var id = jQuery('#repair_id').val();
            var url = "";
            var dataString = "";
            url = "<?=base_url();?>welcome/status";
            dataString = "code=" + code + '&id=' + id;
            jQuery.ajax({
                type: "POST",
                url: url,
                data: dataString,
                cache: false,
                dataType: "json",
                success: function (data) {
                    $('#loadingmessage').hide();
                    if(isEmpty(data)) {toastr['error']("<?= lang('error'); ?>", "<?= lang('main_invalid_code'); ?>");}
                    else {
                        var status = "<span class='label' style='background-color:"+data.bg_color+"; color:"+data.fg_color+"'>"+data.status+"</span>";
                        toastr['success']("<?= lang('main_success'); ?>", "<?= lang('main_success_code'); ?>")
                        jQuery('#client_name').html(data.name);
                        jQuery('#status').html(status);
                        jQuery('#date_opening').html(fld(data.date_opening));
                        jQuery('#defect').html(data.defect);
                        jQuery('#model_name').html(data.model_name);

             
                        jQuery('#grand_total').html("<?= $settings->currency; ?> "+(parseFloat(data.grand_total)).toFixed(2));
                        jQuery('#advance').html("<?= $settings->currency; ?> "+data.advance);
                        jQuery('#result').fadeIn(1000);
                        jQuery('#comment').html(data.comment);
                        jQuery('#diagnostics').html(data.diagnostics);

                        if(data.date_closing == null) {
                          jQuery('.centre_box div.date_closing_div').hide();
                        } else {
                          jQuery('.centre_box div.date_closing_div').fadeIn();
                          jQuery('#date_closing').html(fsd(data.date_closing))
                        }
                    }
                }
            });
        });

    });

     <?php if($this->input->get('code')): ?>
      setTimeout(function () {
        $('#submit_track').click();
      }, 500);
      <?php endif;?>

    function isEmpty(obj) {
        return Object.keys(obj).length === 0;
    }
    </script>
    <style type="text/css">
    .label{
      white-space: inherit;
      display: block;
    }
      .loader {
          color: white;
          top: 0;
          right: 0;
          position: fixed;
          width: 106px;
          height: 106px;
          background: url('<?= base_url(); ?>assets/dist/img/loading-page.gif') no-repeat center;
          z-index: 4;
      }
      .bio-row p span.bold{
        width: 100%;
      }

      body, html {
        height: 100%;
        margin: 0;
        font: 400 15px/1.8 "Lato", sans-serif;
        color: #777;
      }


    </style>
    <div id='loadingmessage' class="loader" style='display:none'></div>

  </head>

  <body class="">


    <div class="container ">
      <div class="main-header navbar navbar-expand navbar-white navbar-light">

        
        <img height="90" src="<?= base_url(); ?>assets/uploads/logos/<?= $settings->logo; ?>">


        <ul class="navbar-nav">
          <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" href="#"><?= lang('main_nav_home'); ?></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url();?>/panel" class="nav-link"><?= lang('main_nav_login'); ?></a>
          </li>
        </ul>


      </div>

      <div class="jumbotron">
        <h1><?= $settings->title; ?></h1>
        <div class="pull-left">
            <label><?= strtoupper(lang('main_reparation_code')); ?></label>
            <small><?= lang('main_reparation_code_sublines'); ?></small>
        </div>
        <!-- <input type="text" id="repair_id" name="id" placeholder="<?=lang('id');?>" value="<?=$this->input->get('id');?>" class="form-control"><br> -->
        <input type="text" id="code" name="code" placeholder="<?=lang('reparation_code');?>" value="<?=$this->input->get('code');?>" class="form-control"><br>
        
        <button class="btn btn-primary" id="submit_track"><?= lang('main_submit'); ?></button>
      </div>
            <div class="marketing">
                <div class=" col-lg-12">
                <div class="centre_box status_box" style="display: none;" id="result">
                    <div class="row">
                            <div class="col-md-6" style="text-align: center;">
                                <p><span style="font-size: 50px;"><?= $this->lang->line('status');?></span><br>
                                <span id="status" style="font-size: 43px;"></span></p>
                            </div>


                            <div class="col-md-6">
                                <div class="col-md-12 col-lg-12 bio-row">
                                    <p><span class="bold"><i class="fa fa-user"></i> <?= $this->lang->line('client_title');?> </span><span id="client_name"></span></p>
                                </div>

                                <div class="col-md-12 col-lg-12 bio-row">
                                  <p><span class="bold"><i class="fa fa-desktop"></i> <?= lang('reparation_model'); ?> </span><span id="model_name"></span></p>
                              </div>
                                 <div class="col-md-12 col-lg-12 bio-row">
                                    <p><span class="bold"><i class="fa fa-comment"></i> <?= $this->lang->line('reparation_comment');?> </span><span id="comment"></span></p>
                                </div>
                                <div class="col-md-12 col-lg-12 bio-row">
                                    <p><span class="bold"><i class="fa fa-comment"></i> <?= $this->lang->line('reparation_diagnostics');?> </span><span id="diagnostics"></span></p>
                                </div>
                                <div class="col-md-12 col-lg-6 bio-row date_closing_div">
                                    <p><span class="bold"><i class="fa fa-calendar"></i> <?= $this->lang->line('date_closing');?> </span><span id="date_closing"></span></p>
                                </div>
                                <div class="col-md-12 col-lg-6 bio-row nofloat">
                                    <p><span class="bold"><i class="fa fa-money"></i> <?= $this->lang->line('grand_total');?> </span><span id="grand_total"></span></p>
                                </div>
                                
                            </div>
                    </div>
                </div>
            </div>
            </div>
      <footer class="footer">
        <p>&copy; <?= date('Y'); ?> <?= $settings->title;?></p>
      </footer>
    </div> <!-- /container -->
  </body>
</html>
