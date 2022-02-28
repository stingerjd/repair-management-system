<!DOCTYPE html>
<html>
	<head>
	  	<meta charset="utf-8">
	  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="pragma" content="no-cache">

	  	<title><?php echo $page_title; ?></title>
	  	<!-- Tell the browser to be responsive to screen width -->
	  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  	


		  <!-- Google Font: Source Sans Pro -->
		  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="<?= $assets ?>plugins/fontawesome-free/css/all.min.css">
		  <!-- Tempusdominus Bootstrap 4 -->
		  <link rel="stylesheet" href="<?= $assets ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  		<!-- Select2 -->
	  	<link rel="stylesheet" href="<?= $assets ?>plugins/select2/css/select2.min.css">
	  	<link rel="stylesheet" href="<?= $assets ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">



		  <!-- Theme style -->
		  <link rel="stylesheet" href="<?= $assets ?>dist/css/adminlte.min.css">
		  <!-- overlayScrollbars -->
		  <link rel="stylesheet" href="<?= $assets ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		  <!-- Daterange picker -->
		  <link rel="stylesheet" href="<?= $assets ?>plugins/daterangepicker/daterangepicker.css">
		  <!-- summernote -->
		  <link rel="stylesheet" href="<?= $assets ?>plugins/summernote/summernote-bs4.min.css">




		<!-- iCheck for checkboxes and radio inputs -->
  		<link rel="stylesheet" href="<?= $assets ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">






		 <!-- DataTables -->
	  	<link rel="stylesheet" href="<?= $assets ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	  	<link rel="stylesheet" href="<?= $assets ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	  	<link rel="stylesheet" href="<?= $assets ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">




		<!-- bootstrap color picker -->
	  	<link rel="stylesheet" href="<?= $assets ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	  	<!-- Toastr -->
	  	<link rel="stylesheet" href="<?= $assets ?>plugins/toastr/toastr.min.css">
	  	<!-- Custom CSS -->
	  	<link rel="stylesheet" href="<?= $assets ?>plugins/parsley/parsley.css">


		<!-- jQuery -->
		<script src="<?= $assets ?>plugins/jquery/jquery.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="<?= $assets ?>plugins/jquery-ui/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
		  $.widget.bridge('uibutton', $.ui.button)
		</script>
		<!-- Bootstrap 4 -->
		<script src="<?= $assets ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


		<script src="<?= $assets ?>plugins/select2/js/select2.full.min.js"></script>


		<!-- Tempusdominus Bootstrap 4 -->
		<script src="<?= $assets ?>plugins/moment/moment.min.js"></script>
		<script src="<?= $assets ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>


	  	<!-- daterange picker -->
		<script src="<?= $assets ?>plugins/daterangepicker/daterangepicker.js"></script>



		<script src="<?= $assets ?>plugins/toastr/toastr.min.js"></script>

		<script src="<?= $assets ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>



		
		<!-- DataTables -->
		<script src="<?= $assets ?>plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?= $assets ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?= $assets ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?= $assets ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<script src="<?= $assets ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
		<script src="<?= $assets ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
		<script src="<?= $assets ?>plugins/jszip/jszip.min.js"></script>
		<script src="<?= $assets ?>plugins/pdfmake/pdfmake.min.js"></script>
		<script src="<?= $assets ?>plugins/pdfmake/vfs_fonts.js"></script>
		<script src="<?= $assets ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
		<script src="<?= $assets ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
		<script src="<?= $assets ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>




		

		<!-- Bootbox.js -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		<!-- Bootstrap Validator -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
		


		<!-- Custom -->
		<script src="<?= $assets ?>plugins/custom/core.js"></script>
		<script src="<?= $assets ?>plugins/custom/custom.js"></script>
		<script src="<?= $assets ?>plugins/parsley/parsley.min.js"></script>
		<link rel="stylesheet" href="<?= $assets ?>plugins/bootstrap-fileinput/css/fileinput.min.css">

		<!-- _Underscore.js -->
		<script src="<?= $assets ?>plugins/custom/underscore.js"></script>
		<!-- Accounting.js -->
		<script src="<?= $assets ?>plugins/custom/accounting.min.js"></script>




		<script src="<?= $assets ?>plugins/bootstrap-fileinput/js/fileinput.min.js"></script>
		<script src="<?= $assets ?>plugins/typeahead.bundle.js"></script>


	  	<link rel="stylesheet" href="<?= $assets ?>dist/css/custom/custom.css">

	  	<?php if($settings->language == 'arabic'): ?>
	  		<link rel="stylesheet" href="<?= $assets ?>dist/css/custom/custom.css">
	  	<?php endif;?>


	  	<style type="text/css">
	  		.modal-ku {
	  			width: calc(100% - 30px);
	  		}
	  	</style>

		<script type="text/javascript">
        	var base_url = "<?=site_url();?>";
        	<?php 
        		$Settings = $settings;
				if ( !$this->ion_auth->logged_in() )
					unset($Settings->setting_id, $Settings->smtp_user, $Settings->smtp_pass, $Settings->smtp_port,$Settings->default_email, $Settings->smtp_crypto, $Settings->smtp_host, $Settings->google_api_key, $Settings->nexmo_api_key,$Settings->nexmo_api_secret,$Settings->twilio_account_sid,$Settings->twilio_auth_token,$Settings->twilio_number, $Settings->reparation_table_state); 

        	?>
			var site = <?= json_encode(array('base_url' => base_url(), 'settings' => $Settings, 'dateFormats' => $dateFormats));?>;
	        var tax_rates = <?php echo json_encode($taxRates); ?>;
	        jQuery.migrateMute = true
		</script>

		

	  	
		<script type="text/javascript">
		    $(function() {

			$('body').on('click', '[data-toggle="modal"]', function(){
		        $($(this).attr("data-target")+' .modal-dialog').load($(this).attr("href"));
		    });  

		        $('#sidebar_toggle').on('click', function(e) {
		            var body = $('body');
		            var state = '';

		            if (!body.hasClass('sidebar-collapse')) {
		                state = 'sidebar-collapse';
		            }

		            $.ajax({
		                type: 'post',
		                mode: 'queue',
		                url: '<?php echo base_url('panel/welcome/nav_toggle'); ?>',
		                data: {
		                    state: state
		                },
		                success: function(data) {

		                }
		            });
		        });
		        $('.select').select2();

		    });

			$(document).ajaxStart(function() {
			  $("#loadingmessage").show();
			});

			$(document).ajaxStop(function() {
			  $("#loadingmessage").hide();
			});
			function formatMyDecimal(number) {
				var options = {
					decimal : "<?= $settings->decimal_seperator; ?>",
					thousand: "<?= $settings->thousand_seperator; ?>",
					precision : 2,
				};
				return accounting.formatNumber(number, options)
			}
			function formatDecimal(number) {
				var options = {
					decimal : ".",
					thousand: "",
					precision : 2,
				};
				return accounting.formatNumber(number, options)
			}


		</script>
		
		<style type="text/css">
		  	.loader {
		      	color: white;
		        top: 30px;
				right: -9px;
		      	position:fixed; z-index:9999;
		      	width: 106px;
		      	height: 106px;
		      	background: url('<?= $assets ?>dist/img/loading-page.gif') no-repeat center;
		  	}
		  
		  	<?php if($settings->use_dark_theme): ?>
				.skin-custom .main-header {
				  background-color: <?=$settings->header_color; ?>;
				}
				.skin-custom .main-header .navbar .nav > li > a {
				  color: #ffffff;
				}
				.skin-custom .main-header .navbar .nav > li > a:hover,
				.skin-custom .main-header .navbar .nav > li > a:active,
				.skin-custom .main-header .navbar .nav > li > a:focus,
				.skin-custom .main-header .navbar .nav .open > a,
				.skin-custom .main-header .navbar .nav .open > a:hover,
				.skin-custom .main-header .navbar .nav .open > a:focus,
				.skin-custom .main-header .navbar .nav > .active > a {
				  background: rgba(0, 0, 0, 0.1);
				  color: #f6f6f6;
				}
				.skin-custom .main-header .navbar .sidebar-toggle {
				  color: #ffffff;
				}
				.skin-custom .main-header .navbar .sidebar-toggle:hover {
				  color: #f6f6f6;
				  background: rgba(0, 0, 0, 0.1);
				}
				.skin-custom .main-header .navbar .sidebar-toggle {
				  color: #fff;
				}
				.skin-custom .main-header .navbar .sidebar-toggle:hover {
				  background-color: <?=$settings->header_color; ?>;
				}
				@media (max-width: 767px) {
				  .skin-custom .main-header .navbar .dropdown-menu li.divider {
				    background-color: rgba(255, 255, 255, 0.1);
				  }
				}
				.skin-custom .main-header .logo {
				  background-color: <?=$settings->header_color; ?>;
				  color: #ffffff;
				  border-bottom: 0 solid transparent;
				}
				.skin-custom .main-header .logo:hover {
				  background-color: <?=$settings->header_color; ?>;
				}
				.skin-custom .main-header li.user-header {
				  background-color: <?=$settings->header_color; ?>;
				}
				.skin-custom .content-header {
				  background: transparent;
				}
				.skin-custom .wrapper,
				.skin-custom .main-sidebar,
				.skin-custom .left-side {
				  background-color: <?=$settings->menu_color; ?>;
				}
				.skin-custom .user-panel > .info,
				.skin-custom .user-panel > .info > a {
				  color: <?=$settings->mmenu_text_color; ?>;
				}
				.skin-custom .nav-sidebar > li.header {
				  color: <?=$settings->mmenu_text_color; ?>;
				  background: <?=$settings->menu_color; ?>;
				}
				.skin-custom .nav-sidebar > li:hover > a,
				.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
				  color: <?=$settings->mmenu_text_color; ?>;
				  background: <?=$settings->menu_active_color; ?>;
				}
				.skin-custom .nav-sidebar > li > .nav-sidebar {
				  margin: 0 1px;
				  background: <?=$settings->menu_active_color; ?>;
				}
				.skin-custom .nav-link {
				  color: <?=$settings->mmenu_text_color; ?>;
				}
				.skin-custom .sidebar a:hover {
				  text-decoration: none;
				}
				.skin-custom .nav-sidebar > li > a {
				  color: <?=$settings->menu_text_color; ?>;
				}
				.skin-custom .nav-sidebar > li.active > a,
				.skin-custom .nav-sidebar > li > a:hover {
				  color: #ffffff;
				}
				.skin-custom .sidebar-form {
				  border-radius: 3px;
				  border: 1px solid #374850;
				  margin: 10px 10px;
				}
				.skin-custom .sidebar-form input[type="text"],
				.skin-custom .sidebar-form .btn {
				  box-shadow: none;
				  background-color: #374850;
				  border: 1px solid transparent;
				  height: 35px;
				}
				.skin-custom .sidebar-form input[type="text"] {
				  color: #666;
				  border-top-left-radius: 2px;
				  border-top-right-radius: 0;
				  border-bottom-right-radius: 0;
				  border-bottom-left-radius: 2px;
				}
				.skin-custom .sidebar-form input[type="text"]:focus,
				.skin-custom .sidebar-form input[type="text"]:focus + .input-group-btn .btn {
				  background-color: #fff;
				  color: #666;
				}
				.skin-custom .sidebar-form input[type="text"]:focus + .input-group-btn .btn {
				  border-left-color: #fff;
				}
				.skin-custom .sidebar-form .btn {
				  color: #999;
				  border-top-left-radius: 0;
				  border-top-right-radius: 2px;
				  border-bottom-right-radius: 2px;
				  border-bottom-left-radius: 0;
				}
				.skin-custom.layout-top-nav .main-header > .logo {
				  background-color: <?=$settings->header_color; ?>;
				  color: #ffffff;
				  border-bottom: 0 solid transparent;
				}
				.skin-custom.layout-top-nav .main-header > .logo:hover {
				  background-color: #3b8ab8;
				}

				.content-wrapper {
				    background-color: <?=$settings->bg_color; ?> !important;
				}
				
				.spinner-wrapper {
					position: fixed;
					top: 0;
					left: 0;
					right: 0;
					bottom: 0;
					/*background-color: #ff6347;*/
					z-index: 999999;
				}
				.spinner {
				  width: 40px;
				  height: 40px;

				  position: relative;
				  /*margin: 100px auto;*/
				  position: absolute;
					top: 48%;
					left: 48%;
				}

				.double-bounce1, .double-bounce2 {
				  width: 100%;
				  height: 100%;
				  border-radius: 50%;
				  background-color: #333;
				  opacity: 0.6;
				  position: absolute;
				  top: 0;
				  left: 0;
				  
				  -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
				  animation: sk-bounce 2.0s infinite ease-in-out;
				}

				.double-bounce2 {
				  -webkit-animation-delay: -1.0s;
				  animation-delay: -1.0s;
				}

				@-webkit-keyframes sk-bounce {
				  0%, 100% { -webkit-transform: scale(0.0) }
				  50% { -webkit-transform: scale(1.0) }
				}

				@keyframes sk-bounce {
				  0%, 100% { 
				    transform: scale(0.0);
				    -webkit-transform: scale(0.0);
				  } 50% { 
				    transform: scale(1.0);
				    -webkit-transform: scale(1.0);
				  }
				}
				.main-header .sidebar-toggle:before {
				        font-family: "Font Awesome 5 Free"; font-weight: 900; content: "\f0c9";

				}
				.content-header h1 {
				    color: <?=$settings->bg_text_color; ?>;
				}
			<?php endif;?>
			body{
				font-size: <?=$settings->body_font; ?>px;
			}

		</style>
		</style>
		  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		  <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		  <![endif]-->
		 
	</head>
	<?php if($settings->use_topbar): ?>
		<body class="<?php echo $body_class; ?> layout-top-nav">
	<?php else:?>
		<body class="<?php echo $body_class; ?> skin-custom <?= $this->session->userdata('main_sidebar_state'); ?>">
	<?php endif;?>

	<div id='loadingmessage' class="loader" style="display: none;"></div>
