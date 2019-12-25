<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.7.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>SMA NEGERI 1 RAMBATAN </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?=base_url();?>asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>asset/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>asset/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>asset/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url();?>asset/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>asset/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?=base_url();?>asset/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>asset/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>asset/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?=base_url();?>asset/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>asset/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?=base_url();?>asset/images/tut_wuri_handayani.png"/>
<link rel="stylesheet" href="<?=base_url();?>asset/css/costume.css">

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
	<img class="logo-login" src="<?=base_url();?>asset/images/tut_wuri_handayani.png" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?=base_url();?>controller/verifikasi_login" method="post">
		<h3 class="form-title text-center">SMA 1 NEGERI RAMBATAN</h3>
		<?php if ($this->session->userdata('error')):?>
						<div id="message_error" class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-ban"></i> Maaf !</h4>
							<?php echo $this->session->userdata('error');?>
						</div>
						<?php elseif ($this->session->userdata('success')):?>
						<div id="message_success" class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Success !</h4>
							<?php echo $this->session->userdata('success');?>
						</div>
						<?php endif;?>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<!-- <input type="checkbox" name="remember" value="1"/> Remember me </label> -->
			<button type="submit" class="btn blue pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		
	</form>
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2019 &copy; SMA 1 Negeri Rambatan.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?=base_url();?>asset/respond.min.js"></script>
<script src="<?=base_url();?>asset/excanvas.min.js"></script> 
<![endif]-->
<script src="<?=base_url();?>asset/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=base_url();?>asset/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url();?>asset/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url();?>asset/scripts/metronic.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?=base_url();?>asset/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
Layout.init(); // init current layout
  Login.init();
  Demo.init();
       // init background slide images
       $.backstretch([
        "<?=base_url();?>asset/admin/pages/media/bg/1.jpg",
        "<?=base_url();?>asset/admin/pages/media/bg/2.jpg",
        "<?=base_url();?>asset/admin/pages/media/bg/3.jpg",
        "<?=base_url();?>asset/admin/pages/media/bg/4.jpg"
        ], {
          fade: 1000,
          duration: 8000
    }
    );
});
</script>
<script>
		window.setTimeout(function () {
		$("#message_error").fadeTo(1000, 0).slideUp(500, function () {
			$(this).remove();
		});
	}, 6000);
	window.setTimeout(function () {
		$("#message_success").fadeTo(1000, 0).slideUp(500, function () {
			$(this).remove();
		});
	}, 6000);
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>