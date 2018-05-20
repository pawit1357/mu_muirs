<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.4
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
<meta charset="utf-8" />
<title><?php echo ConfigUtil::getApplicationTitle();?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />


<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo ConfigUtil::getAppName();?>/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo ConfigUtil::getAppName();?>/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo ConfigUtil::getAppName();?>/css/jquery-ui-1.11.4.custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ConfigUtil::getAppName();?>/css/about.min.css" rel="stylesheet" type="text/css" />

<!--  <link href="<?//php echo ConfigUtil::getAppName();?>/css/SpecialDateSheet.css" rel="stylesheet" type="text/css" /> -->

<!-- END THEME LAYOUT STYLES -->
<!-- <link rel="shortcut icon" href="favicon.ico" /> -->
<!-- END HEAD -->
</head>

<!-- END HEAD -->
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">

<!-- <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white"> -->
<!-- BEGIN HEADER -->
<!--  style=" background-color: #0d19a5; !important" -->
<div class="page-header navbar navbar-fixed-top">
<!-- BEGIN HEADER INNER -->
<div class="page-header-inner ">
<!-- BEGIN LOGO -->
<div class="page-logo">
			<a href="#">  <img src="<?php echo ConfigUtil::getAppName();?>/images/logo_main.png" alt="logo" class="logo-default" style="position: absolute;top: -28px;left:-10px; !important" height="70" /> 

				</a>
<div class="menu-toggler sidebar-toggler"></div>
</div>
<!-- END LOGO -->
<!-- BEGIN TOP NAVIGATION MENU -->
<div class="top-menu">
 <img src="<?php echo ConfigUtil::getAppName();?>/images/ataluk.png" style="position: absolute;top: 0px;right:0px; !important" />
</div>
<!-- END TOP NAVIGATION MENU -->
</div>
<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->

<!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
<div class="page-content">
<div class="page-bar">
<ul class="page-breadcrumb">
<?//php echo MenuUtil::getNavigator($_SERVER['REQUEST_URI']);?>
</ul>
<div class="page-toolbar">
<?//php echo ConfigUtil::getApplicationUpdateVersion();?>
</div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title">
<!-- <asp:Literal ID="litPageTitle" runat="server" /> -->
</h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<?php echo $content; ?>
</div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<a href="javascript:;" class="page-quick-sidebar-toggler">
<i class="icon-login"></i>
</a>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
<div class="page-footer-inner">
<?php echo ConfigUtil::getApplicationCopyRight();?>
<span><?php echo ConfigUtil::getApplicationAddress();?></span>
 
</div>
<div class="scroll-to-top">
<i class="icon-arrow-up"></i>
</div>
</div>
<!-- END FOOTER -->

<script src="<?php echo ConfigUtil::getAppName();?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {

});
</script>
</body>

</html>




