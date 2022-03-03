
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
    <link rel="stylesheet" href="<?= $assets; ?>plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $assets; ?>plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= $assets; ?>dist/css/custom/home.css">
    <link rel="stylesheet" href="<?= $assets; ?>dist/css/custom/custom.css">
    <link rel="stylesheet" href="<?= $assets; ?>plugins/font-awesome/css/font-awesome.min.css">
    <script src="<?= $assets ?>plugins/jquery/dist/jquery.min.js"></script>
    <script src="<?= $assets ?>plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= $assets ?>plugins/toastr/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

    <script src="<?= $assets ?>plugins/typeahead.bundle.js"></script>
    <style type="text/css">
      .input-group .tt-menu.tt-open {
          top: 34px !important;
      }
      .btn-black{
        background: #000;
        color: #FFF;
      }
      .modal-body {
        color: black !important;
      }
      .form-control{
        border: 2px black solid !important;
      }
      .form-control[disabled], fieldset[disabled] .form-control{
        background: #FFF;
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
      .repair_headings{
        font-size: 17px;
        text-decoration: underline;
      }
      </style>  
    <script>var base_url = "<?= base_url(); ?>";</script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  
    <style type="text/css">
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
      <div class="header clearfix">
        <center><img height="90" src="<?= base_url(); ?>assets/uploads/logos/<?= $settings->logo; ?>"></center>
      </div>

      <?php if (isset($_SESSION['message'])) { ?>
          <div class="alert alert-success">
              <button data-dismiss="alert" class="close" type="button">×</button>
              <?= $_SESSION['message']; ?>
          </div>
      <?php } ?>
      <?php if (isset($_SESSION['error'])) { ?>
          <div class="alert alert-danger">
              <button data-dismiss="alert" class="close" type="button">×</button>
              <?= ($_SESSION['error']); ?>
          </div>
      <?php } ?>
      <?php if (isset($_SESSION['warning'])) { ?>
          <div class="alert alert-warning">
              <button data-dismiss="alert" class="close" type="button">×</button>
              <?= ($_SESSION['warning']); ?>
          </div>
      <?php } ?>



      <?= form_open('welcome/save_repair', 'id="add_repair"');?>
        <div class="modal-body">
            <p class="repair_headings">Personal Details</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="First Name" class="">First Name</label>
                        <input class="form-control" placeholder="First Name" required="required" name="first_name" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Last Name" class="">Last Name</label>
                        <input class="form-control" placeholder="Last Name" required="required" name="last_name" type="text">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Phone" class="">Phone</label>
                        <input class="form-control" placeholder="Phone" name="phone" type="text">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Email" class="">Email</label>
                        <input class="form-control" placeholder="Email" name="email" type="email">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Address" class="">Address</label>
                        <input class="form-control" placeholder="Address" name="address" type="text">
                    </div>
                </div>
            </div>
            
            <p class="repair_headings">Repair Details</p>

             <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <?=lang('reparation_imei', 'reparation_imei');?>
                        <input class="form-control" id="reparation_imei" name="imei" required="" style="width: 100%;">
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <?=lang('reparation_model', 'reparation_model');?>
                        <input class="form-control model_name_typeahead" id="reparation_model" name="model" required="" style="width: 100%;">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <?=lang('model_manufacturer', 'reparation_manufacturer');?>
                        <input class="form-control manufacturer_name_typeahead" id="reparation_manufacturer" name="manufacturer" required="" style="width: 100%;">
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <?=lang('reparation_model', 'reparation_model');?>
                        <input class="form-control model_name_typeahead" id="reparation_model" name="model" required="" style="width: 100%;">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="passcode" class="">Passcode <small>(We will use this to test your device after repair)</small></label>
                        <input class="form-control" placeholder="Passcode" required="required" name="passcode" type="text">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label for="where_you_hear_about_us" class="">How did you hear about us</label>
                     <?= form_dropdown('where_you_hear_about_us', $this->repairer->getReferencesHear(),'', 'class="form-control"'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="form-group">
                        <label for="defect" class="">Brief Description about the problem</label>
                        <textarea class="form-control wysihtml5" placeholder="Problem" required="required" rows="3" name="problem" cols="50"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                    <div class="form-group">
                        <label for="defect" class="">Terms &amp; Conditions</label>
                        <textarea class="form-control" disabled rows="3" cols="50"><?= $settings->disclaimer; ?></textarea>
                    </div>
                     <label form="terms">
                      <input type="checkbox" name="terms" id="terms">
                      <?=lang('tnc_title');?>  </label>
                </div>
            </div>
            <h3>Customer Signature</h3>
            <script src="<?=$assets;?>plugins/jSignature/jSignature.min.js"></script>
         <script type="text/javascript">


                $('#add_repair').submit(function(event){
                    if($('#terms').is(':checked') == false){
                        event.preventDefault();
                        bootbox.alert("<?=lang('tnc_error');?>");
                        return false;
                    }else if($('#sign_id').val() == ''){
                        event.preventDefault();
                        bootbox.alert("<?=lang('signature_error');?>");
                        return false;
                    }
                });
                jQuery(document).ready(function () {
                    // $("#signature").jSignature();
                    var $sigdiv = $("#signature").jSignature({color: "#000", lineWidth: 3 })

                    $("#signature").bind('change', function(e){ 
                        var datapair = $('#signature').jSignature("getData", 'base30');
                        $('#sign_id').val(datapair);
                    });
                });
                       
                jQuery(document).on("click", "#reset_sign", function (e) {
                    e.preventDefault();
                    $("#signature").jSignature('reset');
                });
         </script>
         <style type="text/css">
            #signatureparent {
                color: black;
                /*background-color: lightgrey;*/
                padding: 15px;
                border: 2px black solid;
            }

            canvas.jSignature { height: 300px !important; }

         </style>

            <div id="signatureparent">
                <button id="reset_sign" class="btn btn-black pull-right">Reset</button>
                <div id="signature"></div>
            </div>
            <input type="hidden" name="sign_id" id="sign_id" value="">
            <div class="form-group" style="margin-top: 10px">
              <button type="submit" class="btn btn-black pull-right">Submit</button>
            </div>
        </div>
        </form>
        <?= form_close(); ?>
    </div>
      <footer class="footer" style="text-align: center;color:black;border: none;">
        <p>&copy; <?= date('Y'); ?> <?= $settings->title;?></p>
      </footer>
      <script type="text/javascript">
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
                    "<?=$manufacturer->name;?>",
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

            $('.model_name_typeahead').typeahead(null, {
                name: 'model',
                display: 'name',
                source: function(query, syncResults, asyncResults) {
                    $.get( '<?=base_url();?>panel/misc/getModels/'+query+'?manufacturer='+encodeURI($('#reparation_manufacturer').val()), function(data) {
                        asyncResults(data);
                    });
                }
            });
      </script>
    </div> <!-- /container -->
  </body>
</html>

