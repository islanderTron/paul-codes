<?php
	/**
		* @package     Joostrap.Template
		* @subpackage  JoostrapBase v3.4
		*
		* @copyright   Copyright (C) 2005 - 2014 Joostrap. All rights reserved.
		* @license     GNU General Public License version 2 or later; see LICENSE.txt
	*/
	defined('_JEXEC') or die;
	require_once __DIR__ . '/functions/tpl-init.php';
	require_once  JPATH_LIBRARIES  . '/constants.php';
	require_once  JPATH_LIBRARIES  . '/recaptcha/recaptchalib.php';
 	$this->setTitle('PerfectGift');
 	include_once "components/com_createmessage/controller.php";
?>
<!DOCTYPE html>
<!--[if IE 8]>
    <html class="no-js lt-ie9" lang="<?php echo $htmlLang; ?>" >
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="<?php echo $htmlLang; ?>" >
<!--<![endif]-->
<head>
<meta name="viewport" content="initial-scale=1 user-scalable=0" />
<?php if ($loadBootstrap == 1) : ?>
<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/bootstrap.min.css'); ?>">
<?php elseif ($loadBootstrap == 2) : ?>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
<?php endif; ?>
<?php if ($loadFontawesome == 1) : ?>
<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/font-awesome.css'); ?>" type="text/css" media="screen" />
<?php elseif ($loadFontawesome == 2) : ?>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" />
<?php endif; ?>
<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/animate.css'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/j-backbone.css'); ?>" type="text/css" media="screen" />
<?php if (@filesize('templates/' . $this->template . '/css/style' . $color_style . '.css') > 50): ?>
<link rel="stylesheet" href="<?php echo $tplUrl . 'file:///css/style' . $color_style . '.css'; ?>" type="text/css" media="screen" />
<?php endif; ?>
<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/jquery.datepick.css'); ?>">
<?php if (@filesize('templates/' . $this->template . '/css/custom.css') > 5): ?>
<link rel="stylesheet" href="<?php echo $tplUrl; ?>/css/custom.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo $tplUrl; ?>/css/custom.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo $tplUrl; ?>/css/gift_box.css" type="text/css" media="screen" />
<!--link rel="stylesheet" href="<?php //echo $tplUrl; ?>/css/tinycarousel.css" type="text/css" media="screen" /-->
<?php endif; ?>
<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/jquery.mmenu.all.css'); ?>">
<link rel="stylesheet" href="<?php echo getDebugAssetUrl($tplUrl . '/css/jquery.mmenu.header.css'); ?>">
<?php if ($loadJquery == 1) : ?>
<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/jquery.lazyload.js'); ?>" type="text/javascript"></script>
<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/jquery-noconflict.js'); ?>" type="text/javascript"></script>
<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo JUri::base() . 'components/com_createmessage/js/ajax.js'; ?> " type="text/javascript"></script>
<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/jquery.inview.js'); ?>"></script>
<?php elseif ($loadJquery == 2) : ?>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<?php endif; ?>
<jdoc:include type="head" />
<?php if ($loadBootstrap == 1) : ?>
<script src="<?php echo getDebugAssetUrl($tplUrl . '/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<?php elseif ($loadBootstrap == 2) : ?>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<?php endif; ?>
<!--[if lt IE 9]>
			<script src="<?php echo $tplUrl; ?>/js/html5shiv.js" type="text/javascript"></script>
			<script src="<?php echo $tplUrl; ?>/js/respond.min.js" type="text/javascript"></script>
		<![endif]-->
<script src="<?php echo $tplUrl; ?>/js/modernizr.custom.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.mmenu.min.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.mmenu.header.min.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/template.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/j-backbone.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo JURI::base()?>media/editors/tinymce/tinymce.min.js"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.plugin.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.datepick.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/bootstrap-file.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.confirm.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
<?php if (@filesize('templates/' . $this->template . '/js/analytics-head.js') > 5): ?>
<?php include_once 'templates/' . $this->template . '/js/analytics-head.js'; ?>
<?php endif; ?>
<script src="<?php echo $tplUrl; ?>/js/custom.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.transit.min.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.confetti.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/gift_box.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.cloudinary.js" type="text/javascript"></script>
<script type="text/javascript" src="plugins/slider/js/jquery.bxslider.js"></script>
<link rel="stylesheet" type="text/css" href="plugins/slider/css/jquery.bxslider.css">
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
<script src="<?php echo $tplUrl; ?>/js/constants.js" type="text/javascript"></script>
<!--script src="<?php //echo $tplUrl; ?>/js/jquery.tinycarousel.min.js" type="text/javascript"></script-->
<script src="<?php echo $tplUrl; ?>/js/jquery.creditCardValidator.js" type="text/javascript"></script>
<script src="<?php echo $tplUrl; ?>/js/jquery.tablesorter.min.js" type="text/javascript"></script>



<!--<link rel="icon" type="image/png" sizes="512x512"  href="/images/fav_new/android-chrome-512x512.png">
 <link rel="icon" type="image/png" sizes="32x32" href="/images/fav_new/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/images/fav_new/android-chrome-192x192.png">
<link rel="apple-touch-icon" sizes="57x57" href="/images/fav_new/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/fav_new/favicon-16x16.png"> -->
<!-- <link rel="manifest" href="/images/fav_new/manifest.json"> -->

<meta name="msapplication-TileColor" content="#ffffff">
<!-- <meta name="msapplication-TileImage" content="/images/fav/ms-icon-144x144.png" /> -->

<meta name="theme-color" content="#016e8b" />
<meta name="msapplication-navbutton-color" content="#016e8b">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="#016e8b">
<style type="text/css">
			.module.testimonials{
				background-image: url(<?php echo JURI::root(); ?>images/quotes_bg.png);
				background-repeat: repeat;
			}
			.module.testimonials .module-content .showbiz-container{
				margin-top: 0px !important;
			}
			.showbiz .overflowholder ul{
				padding-top: 20px !important;
			}
			p.txt-center{
				color: white !important;
				font-size: 16px !important;
				min-width: 60% !important;
				margin: auto !important;
			}
			#showbiz_2_1 .showbiz-title, #showbiz_2_1 .showbiz-title a, #showbiz_2_1 .showbiz-title a:visited, #showbiz_2_1 .showbiz-title a:hover{
				color: white !important;
			}
			.showbiz .mediaholder img{
				display: none !important;
			}
			#showbiz_2_1  ul li{
				height: 200px !important;
			}
			.menusample3{
				background-color: rgba(0, 0, 0, 0.3); width:100%; height:90px; color:white;
			}
			@media screen and (max-width: 767px){
				.menusample3{
					background-color: rgba(0, 0, 0, 0); width:100%; height:90px; color:white;
				}
			}
			a:hover{
				color: #18baea;
			}
			.justify-text{
				text-align: justify;
				text-align-last: justify;
				-moz-text-align-last: justify;
			}
			.justify-text:after{
				content: "";
				display: inline-block;
				width: 100%;
			}
			.unjustify {
			    word-spacing: -2.5rem;
			}
			.custom-container {
			    padding-right: 15px;
			    padding-left: 15px;
			    margin-right: auto;
			    margin-left: auto;
			}
			.margin-auto{
				margin: auto;
			}
			@media (min-width: 768px){
				.custom-container {
				    width: 750px;
				}
				.unjustify {
				    word-spacing: -5px;
				}
			}
			@media (min-width: 850px){
				.custom-container {
				    width: 850px;
				}
				.unjustify {
				    word-spacing: -10px;
				}
			}
			@media (min-width: 970px){
				.custom-container {
				    width: 970px;
				}
				.unjustify {
				    word-spacing: -15px;
				}
			}
			@media (min-width: 1070px){
				.custom-container {
				    width: 1070px;
				}
				.unjustify {
				    word-spacing: -25px;
				}
			}
			@media (min-width: 1200px){
				.custom-container {
				    width: 1380px;
				}
				.unjustify {
				    word-spacing: -2.5rem;
				}
			}
		</style>
<?php include "tracking.php"; ?>
</head>
<script type="text/javascript">
		LOAD_HOMEPAGE_GIFTS = false;
	</script>
<body id="main" <?php if(@$_GET['task']=='giftassistant') { ?> class="gift_assistant_body <?php echo  $loggedin. " " .$rtl_detection; ?>" 
<?php } 
	if(@$_SERVER['REQUEST_URI'] == '/ojolie') { ?> 
		class="ojlie-body 
		<?php echo  $loggedin. " " .$rtl_detection; ?>"
<?php } if(@$_SERVER['REQUEST_URI'] == '/flash-sale') { ?> class="flash-sale-body <?php echo  $loggedin. " " .$rtl_detection; ?>" <?php } else {?> class="<?php echo $bodyclass. " " .$pageclass. " parentid-" .$parentId. " " .$parentName. " " .$option. " view-" .$view. " " .$frontpage. " itemid-" .$itemid. " " .$loggedin. " " .$rtl_detection; ?>" } <?php } ?> >
<div class="font_preload" style="opacity: 0"> <span style="font-family: 'Open Sans', Helvetica, Arial, sans-serif;"></span> </div>
<span style="display:none;" class="alert" id="NotificationBar"></span>
<?php
			$language = JFactory::getLanguage();
			$language->load('com_customlanguage');
			$constantsValue =  constants::getInstance();
			$is_international_delivery_enable = $constantsValue -> getConstantValues("IS_INTERNATIONAL_DELIVERY");
		?>
<div class="wrapper" id="page">
<div class="content-container">
<div> <span style="display: none;" class="alert alert-success" id="NotificationBar">You already Have some information on create message box</span> </div>
<?php		
							if($_SERVER['REQUEST_URI'] == "/home-page-sample"){ ?>
<div class="container top-menu_content menusample2 menusample3">
<?php }else{ ?>
<!-- <div class="container top-menu_content">
 -->
<?php } ?>
<?php		
							if($_SERVER['REQUEST_URI'] == "/home-page-sample-2"){ ?>
<div class="container top-menu_content li.active a menusample" style="width:100%; height:100px;" >
<?php }else{ ?>
<div class="top-menu_content">
  <?php } ?>
  <?php if ($this->countModules('above-content-below')): ?>
  <div class="nav-header col-md-12 no-padding">
    <div class="nav-header col-md-12" >
      <div class="nav-header-test custom-container no-padding">
        
        <div class="col-xs-12 col-md-4 inclusiveprices"> <span><a href="<?php echo JURI::root();?>customer-service-shipping-policy">All Gifts include Tax and Shipping *  | PERFECT GIFT</a><span> </div>
        <div id="above-content-below" class="col-md-8 mobile-nav hidden-sm"> 
         

         <jdoc:include type="modules" name="above-content-below" style="standard"/>
          <div style="float: right;margin-top: 5px;">
            <!--<a href="<?php echo JURI::base();?>"><img src="<?php echo JURI::base();?>images/logos/us.png" width="20"></a>
												<a href="perfectgift.uk"><img src="<?php echo JURI::base();?>images/logos/gb.png" width="20"></a>
												<a href="perfectgift.in"><img src="<?php echo JURI::base();?>images/logos/in.png" width="20"></a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('navbar-brand')) : ?>
  <div>
    <jdoc:include type="modules" name="navbar-brand" style="standard" />
  </div>
  <?php else: ?>
  <div class="logo-main col-xs-12">
    <!-- Navigation: Mobile part 1 -->
    <nav id="navbar-example" class="navbar col-xs-4" role="navigation">
      <div class="navbar-header" style="padding: 0;">
        <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-js-navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
    </nav>
    <div class="custom-container">
    <!-- Logo -->
    <div class="col-md-3 col-xs-4 sillogo"> <a href="<?php echo JURI::root();?>"> <img  class="img-responsive manual-desktop-logo" src="images/logo_new_final.png" alt="PerfectGift" title="PerfectGift" /> <img class="img-responsive manual-mobile-logo hidden-lg hidden-md" src="images/logo-mobile.png" alt="PerfectGift" title="PerfectGift"> </a> </div>
    <!-- Navigation: Desktop -->
    <div class="col-xs-6 navDesktop">
      <ul id='nav'>
        <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242">MEN</a>
          <div class="sub-nav">
            <ul class="col-sm-6" style="padding: 15px;">
              <div class="col-sm-12">
                <li style="color:black;"><strong>Gifts</strong></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242">For Him</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242,221">Books</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242,49">Electronics</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242,110">Kitchen</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242,112">Sports and Outdoors</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242,1030">Games</a></li>
              </div>
            </ul>
            <ul class="col-sm-6" style="padding: 15px;">
              <div class="col-sm-12">
                <li style="color:black;"><strong>By Price</strong></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=0_25&categories=242">Under $25</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=25_50&categories=242">$25-$50</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=50_100&categories=242">$50-$100</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=100_250&categories=242">$100-$250</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=250_500&categories=242">$250-$500</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=500_1000&categories=242">$500-$1000</a></li>
              </div>
            </ul>
            <div class="col-sm-12 byInterests" style="padding: 15px;">
              <p class="col-sm-12"><strong>By Interest</strong></p>
              <div class="col-sm-3">
                <p>Market</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242,240"><img src="<?php echo JURI::base();?>images/marker.jpg" class="interest-cat"></a> </div>
              <div class="col-sm-3">
                <p>Athletes</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242,238"><img src="<?php echo JURI::base();?>images/athletes.jpg" class="interest-cat"></a> </div>
              <div class="col-sm-3">
                <p>Bookworms</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242,239"><img src="<?php echo JURI::base();?>images/bookworms.jpg" class="interest-cat"></a> </div>
              <div class="col-sm-3">
                <p>Geeks</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242,237"><img src="<?php echo JURI::base();?>images/geeks.jpg" class="interest-cat"></a> </div>
            </div>
          </div>
        </li>
        <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243">WOMEN</a>
          <div class="sub-nav">
            <ul class="col-sm-6" style="padding: 15px;">
              <div class="col-sm-12">
                <li style="color:black;"><strong>Gifts</strong></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243">For Her</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,54">Beauty & Wellness</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,254">Jewelry</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,49">Electronics</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,110">Kitchen</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,104">Flowers</a></li>
              </div>
            </ul>
            <ul class="col-sm-6" style="padding: 15px;">
              <div class="col-sm-12">
                <li style="color:black;"><strong>By Price</strong></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=0_25&categories=243">Under $25</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=25_50&categories=243">$25-$50</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=50_100&categories=243">$50-$100</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=100_250&categories=243">$100-$250</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=250_500&categories=243">$250-$500</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=500_1000&categories=243">$500-$1000</a></li>
              </div>
            </ul>
            <div class="col-sm-12 byInterests" style="padding: 15px;">
              <p class="col-sm-12"><strong>By Interest</strong></p>
              <div class="col-sm-3">
                <p>Market</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,240"><img src="<?php echo JURI::base();?>images/marker.jpg" class="interest-cat"></a> </div>
              <div class="col-sm-3">
                <p>Athletes</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,238"><img src="<?php echo JURI::base();?>images/athletes.jpg" class="interest-cat"></a> </div>
              <div class="col-sm-3">
                <p>Bookworms</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,239"><img src="<?php echo JURI::base();?>images/bookworms.jpg" class="interest-cat"></a> </div>
              <div class="col-sm-3">
                <p>Geeks</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,237"><img src="<?php echo JURI::base();?>images/geeks.jpg" class="interest-cat"></a> </div>
            </div>
          </div>
        </li>
        <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231">KIDS</a>
          <div class="sub-nav">
            <ul class="col-sm-6" style="padding: 15px;">
              <div class="col-sm-12">
                <li style="color:black;"><strong>Gifts</strong></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,53">Toys and Games</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235">Babies & Toddlers</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,234">Gifts for Teens</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,49">Electronics</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,241">Gifts for Under $50</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=241,101">Chocolates and Sweets</a></li>
              </div>
            </ul>
            <ul class="col-sm-6" style="padding: 15px;">
              <div class="col-sm-12">
                <li style="color:black;"><strong>By Price</strong></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=0_25&categories=231">Under $25</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=25_50&categories=231">$25-$50</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=50-100&categories=231">$50-$100</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=100_250&categories=231">$100-$250</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=250_500&categories=231">$250-$500</a></li>
                <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&price=500_1000&categories=231">$500-$1000</a></li>
              </div>
            </ul>
            <div class="col-sm-12 byInterests" style="padding: 15px;">
              <p class="col-sm-12"><strong>By Interest</strong></p>
              <div class="col-sm-3">
                <p>Market</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,240"><img src="<?php echo JURI::base();?>images/marker.jpg" class="interest-cat"></a> </div>
              <div class="col-sm-3">
                <p>Athletes</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,238"><img src="<?php echo JURI::base();?>images/athletes.jpg" class="interest-cat"></a> </div>
              <div class="col-sm-3">
                <p>Bookworms</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,239"><img src="<?php echo JURI::base();?>images/bookworms.jpg" class="interest-cat"></a> </div>
              <div class="col-sm-3">
                <p>Geeks</p>
                <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,237"><img src="<?php echo JURI::base();?>images/geeks.jpg" class="interest-cat"></a> </div>
            </div>
          </div>
        </li>
        <li><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=244">FEATURED</a></li>
        <li><a href="<?php echo JURI::base();?>flash-sale">FLASH SALE</a></li>
        <li><a href="<?php echo JURI::base();?>component/createmessage?task=giftassistant">GIFTING ASSISTANT</a></li>


      </ul>
    </div>
    <?php 
											function filterProducts(){
												// $app = JFactory::getApplication();
												// $jinput = $app->input;
												// $user = JFactory::getUser();
												$session = JFactory::getSession();
												$search = $_POST['search'];
												$filters = json_decode($_POST['filters'],true);
												$sort = $_POST['sort'];
												if(isset($_POST['start'])){
													$start = $_POST['start'];
												}
												else{
													$start = 0;
												}
												if(isset($_POST['isLoadMoreRedeem']) && $_POST['isLoadMoreRedeem'] == 1){
													$view = $this->getView('loadproducts', 'raw'); // get the view
													$view->assign('isLoadMoreRedeem',$_POST['isLoadMoreRedeem']);
												} else {
													$view = $this->getView('redeemproducts', 'raw'); // get the view
												}
												$model  = $this->getModel('createmessage');
												$productList = $model->getFilteredProducts($search, $filters, $sort, $start);
												$session->set("productList",$productList['data']);
												echo json_encode($productList);
											}
										?>
    <!-- Search bar -->
    <div class="col-md-3 col-xs-4 searchBar">
      <input type="search" name="search" id='searchbox' placeholder="find the PerfectGift" class="searchBarTest" value="" />
      <!-- <button class="search-icon" onclick="searchproduct("", 0, "submit");"><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts"></a></button> -->
      <!-- Set if statement to check there's value in search bar and then this button will become cickable -->
      <button class="search-icon""></button>
    </div>
  </div>
  </div>
  <!-- Mobile Navigation  -->
  <div class="navbar-collapse bs-js-navbar-collapse collapse col-xs-12" style="height: 0.8px;padding: 0px;text-align: center;width: 100%;background: white;margin-top: -1px; z-index: 11111;">
    <div class="col-xs-12" style="padding: 10px 0;text-align:left;background: #f5f5f5;">
      <div class="col-xs-4"><a href="<?php echo JURI::base()?>login?view=registration">Sign Up</a></div>
      <div class="col-xs-4" style="border-left:1px solid black;border-right:1px solid black;"><a href="<?php echo JURI::base()?>login">Log In</a></div>
      <div class="col-xs-4"><a href="<?php echo JURI::base()?>about">About Us</a></div>
    </div>
    <ul class="nav navbar-nav col-xs-12">
      <li class="col-xs-12 dropdown"> <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Men <b class="caret"></b></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242">For Him</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=221">Books</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=     ">Electronics</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=110">Kitchen</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=112">Sports and Outdoors</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories= ">Games</a></li>
        </ul>
      </li>
      <li class="col-xs-12 dropdown"> <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Women<b class="caret"></b></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243">For Her</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=54">Beauty & Wellness</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=254">Jewelry</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,49">Electronics</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,110">Kitchen</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243,104">Flowers</a></li>
        </ul>
      </li>
      <li class="col-xs-12 dropdown"> <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Kids<b class="caret"></b></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=53">Toys and Games</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=235">Babies & Toddlers</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234">Gifts for Teens</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,49">Electronics</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,241">Gifts for Under $50</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=241,101">Chocolates and Sweets</a></li>
        </ul>
      </li>
      <li class="col-xs-12"> <a id="drop1" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=244" role="button">Featured</a> </li>
      <li class="col-xs-12"> <a id="drop1" href="<?php echo JURI::base();?>flash-sale" role="button">Flash Sale</a> </li>
      <li class="col-xs-12"> <a id="drop1" href="<?php echo JURI::base();?>component/createmessage?task=giftassistant" role="button">Gifting Assistant</a></li>


    </ul>
    <?php endif; ?>
  </div>
</div>
<?php 
$app = JFactory::getApplication();
$menu = $app->getMenu();
$lang = JFactory::getLanguage();
?>

<header class="banner-img <?php if(isset($_REQUEST['id']) && $_REQUEST['id']=='432') { ?> flash-sale-background <?php } ?>">
<?php 

if ($menu->getActive() == $menu->getDefault($lang->getTag())) : ?>
									
<jdoc:include type="modules" name="position-7" style="standard" />

<?php 
endif;

 ?>
<div class="clearfix">
<div class="custom-container">
  <div <?php if(JRequest::getVar('view') != 'login' && JRequest::getVar('view') != 'registration' && @$_GET['task']!='giftassistant') {?> class="row" <?php } else { ?> class="" <?php }?> >
<?php 


if ($menu->getActive() == $menu->getDefault($lang->getTag())) : ?>
    <div class="col-md-9 col-xs-12">
<?php else : ?>
<div class="col-xs-12 no-inner_space">
<?php endif;

if(@$_GET['task']=='giftassistant')
{ ?>
	<div class="select-as-gift-img">
	<div class="gift-banner-content">
		<div class="user-banner-img"><img src="images/gift_assistant_banner.jpg"></div>
	</div>
</div>
<?php } else {

if ($this->countModules('above-content')): ?>
      <jdoc:include type="modules" name="above-content" style="standard" />
<?php endif;
}
 ?>
    </div>

<?php if ($menu->getActive() == $menu->getDefault($lang->getTag())) :  ?>
    <div class="col-md-3 col-xs-12 padding_none">
      <a href="<?php echo JURI::base();?>flash-sale"><div class="banner_col1 col-md-12 col-xs-6"><img src="<?php echo JURI::base();?>/images/flash-mobile.png">
        <div class="sale_text">Flash Sale</div >
      </div></a>
      <a href="<?php echo JURI::base();?>component/createmessage?task=giftassistant">
      	<div class="banner_col2 col-md-12 col-xs-6">
      		<!-- <img src="<?php echo JURI::base();?>/images/Perfect-gift-finer-logo-A_Fotor.png"> -->
      		<img src="<?php echo JURI::base();?>/images/gift_finder.png">
        	<button class="sale_text">Perfect Gift Finder <span style="font-size:10px;">TM</span></button>
        </div>
        </a>
      </div>
<?php endif;?>
    </div>
  </div>
  
  </header>
  <!-- Valentine Modal -->
  <!-- <div class="row"> -->
  <!-- Desktop Modal -->
  <!-- <div class="modal fade confirmation-modal hidden-xs" id="valentinePopUp" role="dialog" style="background: rgba(128, 128, 128, 0.62);">
						<div class="modal-dialog" style="width: 500px">
							<div class="modal-content" style="width: 500px;background: #912642; border-radius: 0;">
								<div class="modal-header">
									<img src="<?php echo JURI::base()?>images/valentine-logo.png" style="width: 150px;">
									<button type="button" class="close valentinePopUp" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body" style="text-align: center;">
									<h1 style="color:white;font-family:OpenSansLight">Valentine's Day Speical</h1>
									<img src="<?php echo JURI::base()?>images/hearts1.png">
									<p style="color:white; padding: 10px 0;">Free Shipping and $5 off your order!</p>
								</div>
							</div>
						</div>
					</div> -->
  <!-- Mobile Modal -->
  <!-- <div class="modal fade confirmation-modal hidden-lg hidden-md hidden-sm" id="valentinePopUp2" role="dialog" style="background: rgba(128, 128, 128, 0.62);">
						<div class="modal-dialog" style="width: 300px">
							<div class="modal-content" style="width: 300px;background: #912642; border-radius: 0;">
								<div class="modal-header">
									<img src="<?php echo JURI::base()?>images/valentine-logo.png" style="width: 120px;">
									<button type="button" class="close valentinePopUp" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body" style="text-align: center;">
									<h1 style="color:white;font-family:OpenSansLight">Valentine's Day Speical</h1>
									<img src="<?php echo JURI::base()?>images/hearts1.png">
									<p style="color:white; padding: 10px 0;">Free Shipping and $5 off your order!</p>
								</div>
							</div>
						</div>
					</div>
				</div> -->
  <!-- FREE Main SHIPPING Popup -->
  <!-- <div class="modal fade confirmation-modal hidden-xs" id="myMainModal" role="dialog" >
				<div class="modal-dialog hidden-xs"  style="width:350px;">
		      		<div class="modal-content freeshippingpopup" style="height:470px; border-color:#FCFCFC; background-image: url('<?php echo JURI::base();?>images/Assset_backgroundtruck.png');">
		      			<div class="modal-body modal-custom_body">
		      				<div class="modal-header" style="margin-top:-20px; margin-bottom:-20px; margin-left:287px">
		      					<button type="button" class="close color-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		      				</div>
		     				
		     				<div class="modal-body modal-custom modal-custom_popup">
		      					<div class="col-xs-12 col-md-12 text-center custom-box custom-breakpoint">
		      						<div class="textpopup4 color-white"  style="padding-top:-100px;"><div style="margin-bottom:-20px; margin-top:-15px">FREE </div>
		      						<div class="textpopup2 color-white">SHIPPING</div>
		      						<div class="textpopup6 color-white" style="margin-top:-5px"> on all items</div>
		      						<div class="textpopup3 color-white" style="padding-top:40px;">Now through Christmas</div></div>
		      							<p class="textpopup5 color-white text-center" style="margin-top:40px; margin-bottom:-10px;">Simply create a free account, send a gift, and make someone's day special!</p>
									</div>

									<form action="//senditlater.us11.list-manage.com/subscribe/post?u=fbccf61bc03db417f438e4da7&amp;id=9c487ac506" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate subscribe-it" target="_blank" novalidate="novalidate">
			       
			       						<div class="col-sm-12 col-xs-12 col-md-12 spacer-top-30 mobile-center">
				     						<input type="email" name="EMAIL" placeholder="Email" class="required email" id="mce-EMAIL" aria-required="true">
			       						</div>

			       						<div id="mce-responses" class="row">
											<div class="response text-center center1 mce_inline_error hidden-element" id="mce-error-response"></div>
												<div class="response text-center center1 hidden-element" id="mce-success-response"></div>				
										</div>
			
										<div style="position: absolute; left: -5000px;">
                               				<input type="text" name="b_fbccf61bc03db417f438e4da7_9c487ac506" tabindex="-1" value="">
                        				</div>
									
									</form>

		      						<div class="col-sm-12 col-xs-12 col-md-12 mobile-center">
		      							<div class="row">
		      								<a class="btn btn-custom-red btn-medium btn-for_popup" id="mc-embedded-subscribe" style="width:260px" href="<?php echo JURI::base();?>component/createmessage?task=showproducts">Start Gifting</a>
		      							</div>
		      						</div>
		      	
		      				</div>

		      			</div>
		      			<div class="modal-backdrop fade in"></div>

		      		</div>
		      	</div>
		      	</div>

		      	<div class="modal fade confirmation-modal hidden-sm hidden-md hidden-lg" id="myMainModal2" role="dialog" >
				<div class="modal-dialog hidden-sm hidden-md hidden-lg">
		      		<div class="modal-content freeshippingpopup" style="border-color:#FCFCFC; background-image: url('<?php echo JURI::base();?>images/Assset_backgroundtruck.png');">
		      			<div class="modal-body modal-custom_body">
		      				<div class="modal-header" style="margin-top:-20px; margin-bottom:-20px; margin-left:287px; margin:auto;">
		      					<button type="button" class="close color-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		      				</div>
		     				
		     				<div class="modal-body modal-custom modal-custom_popup">
		      					<div class="col-xs-12 col-md-12 text-center custom-box custom-breakpoint">
		      						<div class="textpopup4 color-white"  style="margin-top:-60px;"><div style="margin-bottom:-20px; margin-top:-15px">FREE</div>

		      						<div class="textpopup2 color-white">SHIPPING</div>
		      						<div class="textpopup6 color-white" style="margin-top:-5px"> on all items</div>

		      						<div class="textpopup3 color-white" style="padding-top:30px;">Now through Christmas</div></div>
		      							<p class="textpopup5 color-white text-center" style="margin-top:30px; margin-bottom:-10px;">Simply create a free account, send a gift, and make someone's day special!</p>
									</div>

									<form action="//senditlater.us11.list-manage.com/subscribe/post?u=fbccf61bc03db417f438e4da7&amp;id=9c487ac506" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate subscribe-it" target="_blank" novalidate="novalidate">
			       
			       						<div class="col-sm-12 col-xs-12 col-md-12 spacer-top-30 mobile-center">
				     						<input type="email" name="EMAIL" placeholder="Email" class="required email" id="mce-EMAIL" aria-required="true">
			       						</div>

			       						<div id="mce-responses" class="row">
											<div class="response text-center center1 mce_inline_error hidden-element" id="mce-error-response"></div>
												<div class="response text-center center1 hidden-element" id="mce-success-response"></div>				
										</div>
			
										<div style="position: absolute; left: -5000px;">
                               				<input type="text" name="b_fbccf61bc03db417f438e4da7_9c487ac506" tabindex="-1" value="">
                        				</div>
									
									</form>
		      		
		      						<div class="col-sm-12 col-xs-12 col-md-12 mobile-center" style="margin-bottom: -50px">
		      							<div class="row">
		      								<button class="btn btn-custom-red btn-medium btn-for_popup" id="mc-embedded-subscribe" vstyle="width:auto;" onclick="window.location.href='<?php echo JURI::base();?>component/createmessage?task=showproducts'">Start Gifting</button>
		      							</div>
		      						</div>
		      	
		      				</div>

		      			</div>


		      			<div class="modal-backdrop fade in"></div>

		      		</div>
		      	</div>
		      	</div> -->
  <!-- End Main FREE SHIPPING Popup -->
  <!-- How it works changes for mobile -->
  <!-- <div id="myHowitWorksModal" class="modal fade confirmation-modal" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-body modal-custom_body">
								<div class="modal-header" style="margin-top:-20px; margin-bottom:-10px; margin-left:277px; margin: auto;">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
								</div>
							<div class="row">
								<div class="col-sm-12">
									<p class="module-heading">How it Works</p>
								</div>
							</div>


								<div class="row section-post_work spacer-top-20">
									<div class="col-xs-12" style="text-align: center; margin-top: 4%;">

									<button class="btn btn-danger" style="color: white; font-size: 16px; min-width: 240px;margin-bottom: 5%; margin: auto;" data-toggle="modal" data-target="#myVidModal">Watch the Video!</button>

										<div id="myVidModal" class="modal fade" role="dialog">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-body modal-custom_body">
														<button id="innerVid" type="button" class="close close-btn" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<div class="row" style="margin-top:20px">
														<div class="col-sm-12">
															<div style="margin-top: 15px; position:relative; padding-bottom: 56.25%; padding-top: 25px; height: 0;" >
																	<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" class="videoFrame" width="98%" height="auto" src="https://www.youtube.com/embed/fZmRttM4zOo" frameborder="0" allowfullscreen>
																	</iframe>
															</div>
														</div>
													</div>
													</div>
												</div>
											</div>
										</div>
										<script type="text/javascript">
											
												jQuery("#innerVid").click(function(){
												    jQuery('#myVidModal').modal('hide');
												});
												
										</script>
							
											<div class="col-md-1 hidden-xs" style="width: 3.5%; display: inline-block; float: none;"> </div>
					
										<a id="storyButton" class="btn btn-featured" style="min-width: 240px; font-size: 16px; margin-top:10px" href="#demo" data-toggle="collapse">Read Our Story</a>
					
											<div id="demo" class="collapse" style="height: 0px;">
												<p class="color-black" style="margin-top: 2%;">It started with a simple, but powerful e-gifting idea:</p>
												<h3 class="banner-heading color-black" style="margin-top: 1%;">Be there when you can't.</h3>
										
												<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
													<p style="padding: 2% 5% 2% 5%; font-family: 'OpenSansLight'; font-size: 0.7; text-align: left; height: 100%;">SendItLater was born from a place of love, and remains true to that purpose today. We want you to connect with the people in your life during the times that matter most. We want you to give something special to your loved ones – something they’ll never forget.<br /> <br /> At SendItLater you’re doing so much more than just sending a gift. You’re gifting an experience; a memory that can last a lifetime. You can schedule a gift to be delivered a few weeks before an important event, or even 10 years in the future. No matter the time, occasion, or distance between you, we guarantee that you will be present during those important moments for the people you care about most.</p>
												</div>
												
												<div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
													<p style="padding: 2% 5% 2% 5%; font-family: 'OpenSansLight'; font-size: 0.7; text-align: left; height: 100%;">We want your e-gifting experience to do more. No matter what you decide to send, your friends and family will always get the perfect gift. Choose from thousands of items from over 100 countries. Send anything from cash or bitcoins, to a beautiful bouquet or a trip to Paris. Or, if they’d like, let them choose from our thousands of carefully curated products and services. With SendItLater, you always send the perfect gift.<br /> <br /> SendItLater’s service enables you to cross remembering off your to-do list with our free e-card service as well. Write any message you want, schedule it today, and it will arrive right on time. We’re bringing a physical gifting experience to the digital world, and perfecting it so that you always give your loved one something perfect. Try out e-gifting today – we guarantee you’ll love it.</p>
												</div>
											</div>
									</div>

										<div class="col-sm-4 col-md-4 col-xs-12 text-center space-top-10 section-post_item" style="margin-top:30px;"><img style="margin-bottom: 23px;" src="images/create_message/notepad.png" alt="" />
											<p>1. Create message. Include an optional gift.</p>
										</div>
									<div class="col-sm-4 col-md-4 col-xs-12 text-center space-top-10 section-post_item"><img class="spacer-bottom-20" src="images/create_message/note-2.png" alt="" />
											<p>2. Schedule message to arrive now or in the future.</p>
								</div>
									<div class="col-sm-4 col-md-4 col-xs-12 text-center space-top-10 section-post_item no-bottom_space-mobile"><img class="spacer-bottom-20 remove-on_mobile space-fix" style="margin-top: -33px;" src="images/create_message/note3.png" alt="" />
											<p>3. Surprise! Recipient receives message and select their gifts.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
  <?php if ($this->countModules('collection-1')): ?>
  <div style="padding-top: 20px;">
    <div class="custom-container">
      <!-- <div class="row">
							<h3 class="module-heading hidden-lg hidden-md">Shop by <b>Recipient</b></h3>
							<div class="col-xs-12 hidden-lg hidden-md justify-text">
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242">MEN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243">WOMAN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235">CHILD</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234">TEEN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=236">SENIOR</a>
							</div>
							<div class="col-lg-12 hidden-sm hidden-xs justify-text">
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242">MEN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243">WOMAN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235">CHILD</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234">TEEN</a>
								&#124;
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=236">SENIOR</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=244">FEATURED</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=232" class="unjustify">FOR HIM</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=233" class="unjustify">FOR HER</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=237" class="unjustify">FOR GEEKS</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=238" class="unjustify">FOR ATHLETES</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=240" class="unjustify">FOR MAKERS</a>
							</div>
						</div> -->
      <div class="row hidden-sm hidden-xs">
        <div class="col-lg-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=244"><img class="img-responsive " src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Featured.jpg"></a> </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=232"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/GIFT-FOR-HIM.png.png"></a>

         </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=233"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/collection_forher.png"></a> </div>
        <div class="col-lg-3 col-md-6 hidden-sm hidden-xs spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=237"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Geeks.jpg"></a> </div>
        <div class="col-lg-3 col-md-6 hidden-sm hidden-xs spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=238"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/collection_Athletes.jpg"></a> </div>
        <div class="hidden-lg hidden-md col-sm-6 col-xs-6 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/collection_Kids.jpg"></a> </div>
        <div class="hidden-lg hidden-md col-sm-6 col-xs-6 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/collection_Teens.jpg"></a> </div>
      </div>
      <div class="row hidden-xs spacer-bottom-20">
        <div class="col-lg-12"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=230"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_PromoBanner.jpg"></a> </div>
      </div>
      <div class="row hidden-sm hidden-md hidden-lg spacer-bottom-20">
        <div class="col-xs-12"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=230"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_PromoBannerMobile.jpg"></a> </div>
      </div>
      <div class="row">
        <h3 class="module-heading hidden-lg hidden-md">Shop by <b>Interest</b></h3>
        <div class="col-xs-12 hidden-lg hidden-md justify-text"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=237">GEEKS</a> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=238">ATHLETES</a> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=240">MAKERS</a> </div>
        <div class="col-xs-12 col-sm-6 hidden-md hidden-lg spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=237"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Geeks.jpg"></a> </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=240"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Makers.jpg"></a> </div>
        <!-- <div class="col-lg-4 col-md-4 hidden-sm hidden-xs spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=0_50"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Under50.jpg"></a> </div> -->
        <div class="col-lg-4 col-md-4 hidden-sm hidden-xs spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=239"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Bookworms.jpg"></a> </div>
        <div class="col-xs-6 col-sm-6 hidden-md hidden-lg spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=238"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Athletes.jpg"></a> </div>
        <div class="col-xs-6 col-sm-6 hidden-md hidden-lg spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=239"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Bookworms.jpg"></a> </div>
      </div>
      <div class="row hidden-sm hidden-xs">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Kids.jpg"></a> </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=236"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Seniors.jpg"></a> </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Teens.jpg"></a> </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=256"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_LastMinuteShoppers.jpg"></a> </div>
      </div>
      <div class="row hidden-xs">
        <div class="col-lg-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=giftassistant"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Gift-Assistant.jpg"></a> </div>
      </div>
      <div class="row hidden-sm hidden-md hidden-lg">
        <div class="col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=giftassistant"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-1-desktop/Assets_Collection_Gift-AssistantMobile.jpg"></a> </div>
      </div>
    </div>
  </div>
  <div class="hidden-xs hidden-sm" style="padding:20px;box-shadow: 0 35px 27px -23px #ccc inset, 0 0px 27px -23px #ccc inset;-moz-box-shadow: 0 35px 27px -23px #ccc inset, 0 0px 27px -23px #ccc inset;-webkit-box-shadow: 0 35px 27px -23px #ccc inset, 0 0px 27px -23px #ccc inset;">
    <div class="custom-container">
      <div class="row">
        <div class="col-lg-2 col-md-2"> <img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/target.png"> </div>
        <div class="col-lg-2 col-md-2"> <img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/amazon.png"> </div>
        <div class="col-lg-2 col-md-2"> <img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/walmart.png"> </div>
        <div class="col-lg-2 col-md-2"> <img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/beanbox.png"> </div>
        <div class="col-lg-2 col-md-2"> <img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/samsung.png"> </div>
        <div class="col-lg-2 col-md-2"> <img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/stockpile.png"> </div>
      </div>
    </div>
  </div>
  <div style="background:#484C53;padding-top: 40px;padding-bottom: 40px;color:white;font-family: OpenSansLight;">
    <div class="custom-container">
      <div class="row hidden-sm hidden-xs">
        <div class="col-lg-12">
          <h3 style="color:white;font-family: OpenSansLight;font-size: 24px;    margin-bottom: 15px;margin-top: 15px;">What We Do</h3>
        </div>
        <div class="col-lg-6" style="font-family: OpenSans-Semibold;">SendItLater was born from the difficulty of finding the perfect gift. We've all been there - you THINK the gift will be perfect, but you're just not sure. It's stressful - no one wants to give a dissapointing gift! We decided there is no benefit in the guessing game of gift giving. Why not create a service that allows you to send the perfect gift everytime, hasslefree?</div>
        <div class="col-lg-6" style="font-family: OpenSansLight;">Send It Later™ enables anyone to schedule messages and gifts now and into the future. Simply choose a gift, select a date, and send! We'll take care of everything else. There is no need to worry - if your recipient doesn't love your gift, they can exchange it for any other gift on our website. Guessing is a thing of the past - choose a gift from your heart, without the pressure of the gift not being perfect. This is SendItLater.</div>
      </div>
      <div class="row hidden-md hidden-lg" style="padding-left: 20px;padding-right: 20px;">
        <div class="col-xs-12 text-center">
          <h3 style="color:white;font-family: OpenSansLight;font-size: 24px;margin-bottom: 15px;margin-top: 15px;">What We Do</h3>
        </div>
        <div class="col-xs-12 text-center" style="font-family: OpenSans-Semibold;margin-bottom: 15px;">SendItLater was born from the difficulty of finding the perfect gift. We've all been there - you THINK the gift will be perfect, but you're just not sure. It's stressful - no one wants to give a dissapointing gift! We decided there is no benefit in the guessing game of gift giving. Why not create a service that allows you to send the perfect gift everytime, hasslefree?</div>
        <div class="col-xs-12 text-center" style="font-family: OpenSansLight;">Send It Later™ enables anyone to schedule messages and gifts now and into the future. Simply choose a gift, select a date, and send! We'll take care of everything else. There is no need to worry - if your recipient doesn't love your gift, they can exchange it for any other gift on our website. Guessing is a thing of the past - choose a gift from your heart, without the pressure of the gift not being perfect. This is SendItLater.</div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('collection-2')): ?>
  <div style="padding-top: 20px;">
    <div class="custom-container">
      <!-- <div class="row">
							<div class="col-xs-12 hidden-lg hidden-md justify-text">
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242">MEN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243">WOMAN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235">CHILD</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234">TEEN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=236">SENIOR</a>
							</div>
							<div class="col-lg-12 hidden-sm hidden-xs justify-text">
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=242">MEN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=243">WOMAN</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235">CHILD</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234">TEEN</a>
								&#124;
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=236">SENIOR</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=244">FEATURED</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=232" class="unjustify">FOR HIM</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=233" class="unjustify">FOR HER</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=237" class="unjustify">FOR GEEKS</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=238" class="unjustify">FOR ATHLETES</a>
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=240" class="unjustify">FOR MAKERS</a>
							</div>
						</div> -->
      <div class="row">
       <div class="col-lg-12">
        <div class=" how_it_work hidden-sm hidden-xs">
          <div class="how_it_work_one">You choose a gift and schedule the message <strong>informing the recipient</strong> to arrive any day.</div>
          <div class="how_it_work_one">He or she can keep the gift or choose something else they would like.</div>
          <div class="how_it_work_one" style="padding-right: 0;">Always give the <strong>Perfect</strong> Gift.</div>
          <div class="hidden-md hidden-lg icon-first-img">
                <img src="<?php echo JURI::base();?>images/icon-first.png">
                <img src="<?php echo JURI::base();?>images/icon-second.png">
                </div>
          <div class="how_it_work_four"><button id="SILVideoPopup" style="float: none; cursor: auto; margin: auto;">Watch How it Works.</button></div>
        </div>
        </div>
        <div class="col-lg-12">
        <div class=" how_it_work hidden-lg hidden-md">
          <div class="how_it_work_one">You choose a gift and schedule the message <strong>informing the recipient</strong> to arrive any day. He or she can keep the gift or choose something else they would like. Always give the <strong>Perfect</strong> Gift.</div>
          <div class="hidden-md hidden-lg icon-first-img">
                <img src="<?php echo JURI::base();?>images/icon-first.png">
                <img src="<?php echo JURI::base();?>images/icon-second.png">
                </div>
          <div class="how_it_work_four"><button id="SILVideoPopup" style="float: none; cursor: auto; margin: auto;">Watch How it Works.</button></div>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="unique_gift">
		  <div class="unique_gif_section">
          <div class="unique_gift_left">Unique Gifts for Yourself and for a Special Person.</div>
          <div class="unique_gift_right"><a href="<?php echo JURI::base();?>component/createmessage?task=giftassistant">Choose a Gift</a></div>
		  </div>
          <ul>
         <li>
          <div class="unique_gift_img first_img">
<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class="dropdownwrapper"> <img class=" dropdownbtn" src="<?php echo JURI::base();?>images/BC-Logotype.png">
         </div>
         <div class="unique_gift_txt"><p style="text-align: center;">Wallet & Bitcoins</p></div>
          <div class="dropdown-content">
            <p>Establish and send a wallet with a designated number or bitcoins.</p>
          </div>
          </a>
         </li>
<li>
<div class="unique_gift_img second_img">
 <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class=" dropdownwrapper"> <img class=" dropdownbtn" src="<?php echo JURI::base();?>images/starbuckswithgoldnew.png"></div>
          <div class="unique_gift_txt"><p style="text-align: center;">Gold/Fractional Shares </br> in a Favorite Company</p></div>
          <div class="dropdown-content">
            <p>The ability to send fractional shares (less than the price of a full share) or any amount of gold.</p>
          </div>
          </a>
</li>
<li>
 <div class="unique_gift_img third_img"><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class=" dropdownwrapper"> <img class="dropdownbtn" src="<?php echo JURI::base();?>images/cashnew.png">
</div>
          <div class="unique_gift_txt"><p style="text-align: center;">Cash</p></div>
          <div class="dropdown-content">
            <p>Send cash in the form of a certified check</p>
          </div>
          </a> </li><li> <div class="unique_gift_img fourth_img"><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class=" dropdownwrapper"> <img class="dropdownbtn" src="<?php echo JURI::base();?>images/experience.png"></div>
         <div class="unique_gift_txt"> <p style="text-align: center;">Experiences</p></div>
          <div class="dropdown-content">
            <p>Give the gift of kayaking down the Nile or rappelling down a waterfall in the Amazon</p>
          </div>
          </a> </li><li>
<div class="unique_gift_img fifth_img">
<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class=" dropdownwrapper"> <img class="dropdownbtn" src="<?php echo JURI::base();?>images/online_class.png">
</div>
          <div class="unique_gift_txt"><p style="text-align: center;">Online Classes</p></div>
          <div class="dropdown-content">
            <p>Send one gift card that the recipient can exchange for one of 200 popular gift cards, including Amazon, Target, Visa, etc.</p>
          </div>
          </a> </li><li>
<div class="unique_gift_img sixth_img">
<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class="dropdownwrapper"> <img class="dropdownbtn" src="<?php echo JURI::base();?>images/giftcards.png">
</div>
          <div class="unique_gift_txt"><p style="text-align: center;">Gift Cards</p></div>
          <div class="dropdown-content">
            <p>Enable your loved ones to learn online with the best courses from the top institutions. Anytime. Anywhere.</p>
          </div>
          </a> </li></ul>
     </div>
     </div>
      </div>
      <!--<div class="row hidden-lg hidden-md hidden-sm">
        <div class="col-xs-12 spacer-bottom-20">
          <!-- <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=244"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/Assets_Collection500x500_Popular.jpg"></a> 
          <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class="col-xs-6"><img class="col-xs-12" src="<?php echo JURI::base();?>images/BC_Logotype.png">
          <p style="text-align: center;">Wallet & Bitcoins</p>
          </a> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class="col-xs-6"><img class="col-xs-12" src="<?php echo JURI::base();?>images/starbuckswithgold.png">
          <p style="text-align: center;">Gold/Fractional Shares in a Favorite Company</p>
          </a> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class="col-xs-6"><img class="col-xs-12" src="<?php echo JURI::base();?>images/cash.png">
          <p style="text-align: center;">Cash</p>
          </a> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class="col-xs-6"><img class="col-xs-12" src="<?php echo JURI::base();?>images/argentina.png">
          <p style="text-align: center;">Experiences</p>
          </a> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class="col-xs-6"><img class="col-xs-12" src="<?php echo JURI::base();?>images/mit-dome.png">
          <p style="text-align: center;">Online Classes</p>
          </a> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&brand=40" class="col-xs-6"><img class="col-xs-12" src="<?php echo JURI::base();?>images/gift_card_1.png">
          <p style="text-align: center;">Gift Cards</p>
          </a> </div>
      </div>-->
      
      <div class="row">
        <div class="col-lg-4 col-md-4 hidden-sm hidden-xs spacer-bottom-20 top-gift-box"> 
          <div class="collection_div">
<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=232"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/home-detail-img1.png"></a> 
<a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=232">Gifts for Him</a>
         </div>
        </div>
        <div class="col-lg-4 col-md-4 hidden-sm hidden-xs spacer-bottom-20  top-gift-box"> 
          <div class="collection_div">
<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=233"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/home-detail-img2.png" style="padding-top: 15px;"></a> 
<a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=233">Gifts for Her</a>
           </div>
        </div>
        <div class="col-lg-4 col-md-4 hidden-sm hidden-xs spacer-bottom-20  top-gift-box"> 
         <div class="collection_div">
   <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=238"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/home-detail-img3.png" style="padding-top: 10px;padding-left: 43px;"></a>
<a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=238">Gifts for Athletes</a>
        </div>
       </div>

        <div class="hidden-md hidden-lg col-sm-6 col-xs-12 spacer-bottom-20"> 
         <div class="collection_div">
<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=232"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/home-detail-img1.png"></a> 
<a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=232">Gifts for Him</a>
         </div>
      </div>
        <div class="hidden-md hidden-lg col-sm-6 col-xs-12 spacer-bottom-20">
        	<div class="collection_div">
         <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=233"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/GIFT-FOR-HER.png"></a><a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=233">Gifts for Her</a> </div> </div>
         <div class="hidden-md hidden-lg col-sm-6 col-xs-12 spacer-bottom-20"> 
         <div class="collection_div">
   <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=238"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/GIFRT-FOR-ATHLETES.png"></a>
<a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=238">Gifts for Athletes</a>
        </div>
       </div>
        <div class="col-lg-4 col-md-4 hidden-sm hidden-xs spacer-bottom-20">
          <!-- <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=237"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/Assets_Collection_Geeks.jpg"></a> -->
          <div class="collection_div">
          <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=1016,232,233"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/home-detail-img4.png" style="padding-top: 15px;"></a> 
<a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=1016,232,233">Gifts for Love Ones</a>
          </div>
</div>
<div class="hidden-md hidden-lg col-sm-6 col-xs-12 spacer-bottom-20">
        	<div class="collection_div">
         <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=1016,232,233"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/GIFT-FOR-LOVE-ONCES.png"></a> 
<a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=1016,232,233">Gifts for Love Onces</a> </div> </div>
        <div class="col-lg-4 col-md-4 hidden-sm hidden-xs spacer-bottom-20"> 
         <div class="collection_div">
<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/home-detail-img5.png"></a> 
<a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234">Gifts for Teens</a>
         </div>
        </div>
        <div class="col-lg-4 col-md-4 hidden-sm hidden-xs spacer-bottom-20">
<div class="collection_div">
 <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/home-detail-img6.png" style="padding-top: 60px;padding-left: 15px;"></a>
<a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235">Gift for Kids</a>
</div>
 </div>
 <div class="hidden-lg hidden-md col-sm-6 col-xs-12 spacer-bottom-20">
<div class="collection_div">
  <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/GIFT-FOR-TEENS.png"></a><a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234">Gifts for Teens</a> 
</div>
  </div>
 <div class="hidden-lg hidden-md col-sm-6 col-xs-12 spacer-bottom-20">
 <div class="collection_div">
  <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/GIFT-FOR-KIDS.png"></a> <a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235">Gifts for Kids</a>
</div>
  </div> 
         
        <!-- <div class="hidden-lg hidden-md col-sm-12 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=241"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/Mobile_Assets_under50.jpg"></a> </div> -->
        <!-- <div class="hidden-lg hidden-md col-sm-6 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/collection_Kids.png"></a> <a class="collection_text" href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=231,235">Gift for Kids</a></div> -->
        <!-- <div class="hidden-lg hidden-md col-sm-6 col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=234"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/Mobile_Assets_Collection_Teens.jpg"></a> </div> -->
      </div>
<!--<div class="row">
      <div class="col-lg-7 spacer-bottom-20"> 
			<div class="home_custom_img">
				<a href="<?php echo JURI::root();?>component/createmessage?task=showproducts&categories=244">
					<img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/1-4.jpg">
					<div class="home_custom_img_inner">
						<a href="https://www.senditlater.com/component/createmessage?task=showproducts&categories=244"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/16.png"></a>
					</div>
				</a>
			</div>
	 </div>
	<div class="col-lg-5 spacer-bottom-20"> 
		<div class="home_custom_img_sec">
			<a href="<?php echo JURI::root();?>component/createmessage?task=showproducts&categories=244">
				<img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/head-phone.png">
				<div class="home_custom_img_inner">
					<a href="<?php echo JURI::root();?>component/createmessage?task=showproducts&categories=244">
						<img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/19.png">
					</a>
				</div>
			</a>
		</div>
	</div>
</div>-->
      <div class="row hidden-xs spacer-bottom-20">
        <div class="col-lg-12"> <div class="experience_img"><a href="<?php echo JURI::base();?>component/createmessage?task=showproducts&categories=99">
			Give the Experience of a Lifetime<br/>
			Shop the collection 
		</a></div> </div>
      </div>
      <div class="row hidden-lg hidden-md hidden-sm">
        <div class="col-xs-12 spacer-bottom-20"> 
        <div class="experience_img">
        <a href="<?php echo JURI::root();?>component/createmessage?task=showproducts&amp;categories=99">
			Give the Experience of a Lifetime<br>
			Shop the collection 
		</a></div> </div>
      </div>
      <!-- <div class="row spacer-bottom-20">
							<div class="col-xs-4">
								<hr style="border-top: 2px solid #eee;">
							</div>
							<div class="col-xs-4 text-center">
								<a href="<?php echo JURI::base();?>component/createmessage?task=showproducts" style="border-radius: 0px;padding: 5px 30px;" class="btn btn-featured">Find the Perfect Gift</a>
							</div>
							<div class="col-xs-4">
								<hr style="border-top: 2px solid #eee;">
							</div>
						</div> -->
     <!--  <div class="row hidden-sm hidden-md hidden-lg">
        <div class="col-xs-12 spacer-bottom-20"> <a href="<?php echo JURI::base();?>component/createmessage?task=giftassistant"><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/col-2-desktop/Mobile_Asset_500x500banner.jpg"></a> </div>
      </div> -->
    </div>
  </div>
 
    <div class="custom-container">
      <div class="row">
       <div class="col-lg-12">
        <div class="brandlist">
			<ul>
				<li><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/target.png"> </li>
				<li><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/amazon.png"></li>
				<li><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/walmart.png"></li>
				<li><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/beanbox.png"> </li>
				<li><img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/samsung.png"> </li>
				<li> <img class="img-responsive margin-auto" src="<?php echo JURI::base();?>images/partners/stockpile.png"></li>
			</ul>
      </div>
      </div>
    </div>
  </div>
  <!-- <div style="background:#484C53;padding-top: 40px;padding-bottom: 40px;color:white;font-family: OpenSansLight;">
					<div class="custom-container">
						<div class="row hidden-sm hidden-xs">
							<div class="col-lg-12">
								<h3 style="color:white;font-family: OpenSansLight;font-size: 24px;    margin-bottom: 15px;margin-top: 15px;">What We Do</h3>
							</div>
							<div class="col-lg-4" style="font-family: OpenSans-Semibold;">SendItLater™ enables anyone, from a busy mom to a soldier deployed overseas, to schedule messages and gifts from our partners now and into the future.</div>
							<div class="col-lg-8" style="font-family: OpenSansLight;">You are a busy person and sometimes it's hard to remember all the birthdays, anniversaries and other big days for all the special people in your life. SendItLater allows you to "premember" all of those events and to take care of everything months or even years in advance. Write them a personal message, include a gift, and we'll deliver everything on schedule. Just let us know who to send it to and when to send it.</div>

						</div>
						<div class="row hidden-md hidden-lg" style="padding-left: 20px;padding-right: 20px;">
							<div class="col-xs-12 text-center">
								<h3 style="color:white;font-family: OpenSansLight;font-size: 24px;margin-bottom: 15px;margin-top: 15px;">What We Do</h3>
							</div>
							<div class="col-xs-12 text-center" style="font-family: OpenSans-Semibold;margin-bottom: 15px;">SendItLater™ enables anyone, from a busy mom to a soldier deployed overseas, to schedule messages and gifts from our partners now and into the future.</div>
							<div class="col-xs-12 text-center" style="font-family: OpenSansLight;">You are a busy person and sometimes it's hard to remember all the birthdays, anniversaries and other big days for all the special people in your life. SendItLater allows you to "premember" all of those events and to take care of everything months or even years in advance. Write them a personal message, include a gift, and we'll deliver everything on schedule. Just let us know who to send it to and when to send it.</div>
						</div>
					</div>
				</div> -->
  <script type="text/javascript">
					// Stockpile Ad Video
					jQuery("#stockpileAd").mouseenter(function() {
						  jQuery(this).css("cursor", "pointer");
						}).mouseleave(function() {
						     jQuery(this).css("cursor", "auto");
						}).click(function(){
							var id = 'stockpileVid';
						var headerText = '<h2 style="color: #19b9ea;" class="text-center">Learn How Stockpile Works</h2>';
						var stockpileVid = '<div class="videoFrame" style="margin-top: 15px; position:relative; padding-bottom: 56.25%; padding-top: 25px; height: 0;"><video controls autoplay width="100%" height="auto" controls poster="<?php echo JURI::root();?>images/stockpile_thumbnail.png"><source src="<?php echo JURI::root();?>images/video/stockpile.mp4" type="video/mp4">Your browser does not support the video tag.</video></div>';
						var closeHtml = '<button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						jQuery('#articles-view-popUp .modal-custom_body').html(closeHtml+headerText+stockpileVid);
						jQuery('#articles-view-popUp').modal('show');
						hideShowNiceScrolls('',id,false);
						bodyFixedPosition();
						jQuery(document).click(function(){
							if(jQuery('.modal').is(':visible')){
								jQuery('.videoFrame').remove();
							}
						});
						jQuery('.modal-dialog').click(function(e){
							e.stopPropagation();
						});
						jQuery('.close.close-btn').click(function(){
							jQuery('#articles-view-popUp').trigger('click');
						});

					});
				</script>
  <?php endif; ?>
  <!-- How it works changes for mobile -->
  <?php if ($this->countModules('menu')): ?>
  <nav id="menu" class="clearfix">
    <div class="navbar-collapse collapse">
      <jdoc:include type="modules" name="menu" style="basic" />
    </div>
  </nav>
  <?php endif; ?>
  <?php if ($this->countModules('slideshow')): ?>
  <div id="slider">
    <jdoc:include type="modules" name="slideshow" style="standard" />
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('carousel')): ?>
  <div id="carousel">
    <jdoc:include type="modules" name="carousel" style="standard" />
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('strapline')): ?>
  <div id="strapline">
    <jdoc:include type="modules" name="strapline" style="standard" />
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('top')): ?>
  <div id="top" class="clearfix">
    <jdoc:include type="modules" name="top" style="standard" />
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('middle')): ?>
  <section class="middle">
    <jdoc:include type="modules" name="middle" style="standard" />
  </section>
  <?php endif; ?>
  <?php if ($this->countModules('breadcrumbs')): ?>
  <div id="breadcrumbs">
    <jdoc:include type="modules" name="breadcrumbs" style="standard" />
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('above-content-below')):
						 $modules = JModuleHelper::getModules('above-content-below');
							foreach($modules as $module):
								if(isset($is_international_delivery_enable) && $is_international_delivery_enable == 1 ):?>
  <div id="above-content-below" class="container">
    <jdoc:include type="modules" name="above-content-below" style="standard" />
  </div>
  <?php  endif;  endforeach;
						
						endif; ?>
  <?php if ($this->countModules('above')): ?>
  <div class="clearfix clearBoth hidden-xs">
    <jdoc:include type="modules" name="above" style="standard" />
  </div>
  <?php endif; ?>
  <?php if ($this->countModules('above-content-custom')): ?>
  <jdoc:include type="modules" name="above-content-custom" style="standard" />
  <div class="steps-section ">
    <?php		
							if($_SERVER['REQUEST_URI'] == "/home-page-sample" || $_SERVER['REQUEST_URI'] == "/home-page-sample-2"){ ?>
    <div style="margin-top:-32px;"></div>
    <?php }else{ ?>
    <!-- <div class="row spacer-top-10"> -->
    <!-- <div class="col-xs-12" style="margin-top:40px;"> -->
    <!-- <h2 class="module-heading no-margin" id="gift-page-title"><?php echo 'Send a Gifts'; ?> -->
    <?php
									if( (isset($pageToDisplay) && $pageToDisplay == 'giftSelection') || isset($_GET['prevstate']) ){ ?>
    <!-- <button type="button" class="btn btn-custom-red module-space_sm" id="sendOnlyMessageBtn">
											<?php echo JText::_('COM_CREATE_MESSAGE_SEND_ONLY_MESSAGE_BTN_TEXT');?>
										</button> -->
    <?php } ?>
    <!-- </h2>

								<p class="description text-center"><?php echo 'Choose a gift, Schedule delivery, Be a hero.'; ?></p>
								
							</div> -->
    <!-- </div> -->
    <?php } ?>
    <?php		
							if($_SERVER['REQUEST_URI'] == "/home-page-sample" || $_SERVER['REQUEST_URI'] == "/home-page-sample-2"){ ?>
    <!-- <div class="module-space container" style="width:100%"> -->
    <?php }else{ ?>
    <!-- <div class="module-space container"> -->
    <?php } ?>
    <!-- <div id="product-listing" class="MessageMain">
									<div id='products-loader' class="text-center">
										<img  src="<?php echo JURI::root();?>images/aaaa.gif" />&nbsp;Please Wait...
									</div>
									<jdoc:include type="modules" name="slideshow2" style="standard" />
								</div> -->
    <!-- </div>
						</div> -->
    <?php endif; ?>
    <?php if ($this->countModules('slideshow2')): ?>
    <div id="slider">
      <jdoc:include type="modules" name="slideshow2" style="standard" />
    </div>
    <?php endif; ?>
    <!-- Mainbody -->
<?php $articleID = JRequest::getVar('id');?>
    <div id="mainbody" class="clearfix <?php if($articleID !='1') { ?> custom-container <?php } ?>">
      <!-- Content Block -->
      <div class="row row-desktop">
        <div id="content" class="col-md-<?php echo $span;?> no-inner_space">
          
          <?php
									$app = JFactory::getApplication();
									$menu = $app->getMenu();
									if ($frontpageshow)
									{
									?>
          <div id="LoadingOverlay" class="overlay" style="display:none; text-align:center;padding-right:50px;">
            <div class="overlay-container" style="position: absolute;"><img src="<?php echo JURI::root();?>media/media/images/ajax-loader-large.png" width="100"></div>
          </div>
		  <?php $top_url=explode("/",$_SERVER['REQUEST_URI']);
		  $page_name_top=$top_url[count($top_url)-1];
		 $topPageName=explode("?",$top_url[count($top_url)-1]);
		$topURL=@$topPageName[count($topPageName)-2];
		 if($topURL!="login"  && $page_name_top!="login"){?>
		  <div id="message-component" class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 hidden-element">
            <jdoc:include type="message" />
          </div>
		 <?php }?>
          <div id="content-area" class="no-inner_space">
		 
            <jdoc:include type="component" />
			<?php 
			 if($topURL=="login"  || $page_name_top=="login"){?>
		  <div id="message-component" class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 hidden-element">
            <jdoc:include type="message" />
          </div>
		 <?php }?>
          </div>
          <?php
									}
									else
									{ 
										if ($menu->getActive() !== $menu->getDefault())
										{
											// show on all pages but the default page
										?>
          <div id="content-area" class="container">
            <jdoc:include type="component" />
          </div>
          <?php
										}
									}
								?>
          <?php if ($this->countModules('below-content')): ?>
          <div id="below-content">
            <jdoc:include type="modules" name="below-content" style="standard" />
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php if ($this->countModules('right')) : ?>
      <aside class="sidebar-right col-md-<?php echo $right; ?>">
        <jdoc:include type="modules" name="right" style="standard" />
      </aside>
      <?php endif; ?>
    </div>
  </div>
  <div id="mm-sidebar" class="hidden-element">
    <div id="panel-overview">
      <div style="text-align: center;"><a href="<?php echo $this->baseurl ?>/" class="<?php echo $icon1; ?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#page" class="<?php echo $icon6; ?>"></a></div>
      <?php if ($this->countModules('mob-menu-above')): ?>
      <div class="mob-menu-above">
        <jdoc:include type="modules" name="mob-menu-above" style="standard" />
      </div>
      <?php endif; ?>
      <?php if ($this->countModules('menu')): ?>
      <jdoc:include type="modules" name="menu" style="none" />
      <?php endif; ?>
      <?php if ($this->countModules('mob-menu-below')): ?>
      <div class="mob-menu-below">
        <jdoc:include type="modules" name="mob-menu-below" style="standard" />
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php if ($totop) : ?>
  <a href="#" class="go-top backToTop">
  <?php if ($totoptext) : ?>
  <?php echo $gotoptext; ?>
  <?php  else : ?>
  <?php echo JText::_('TPL_JOOSTRAP_GOTOP_TEXT');?>
  <?php endif; ?>
  <?php if ($totopicon) : ?>
  <i class="<?php echo $gotopicon; ?>"></i>
  <?php  else : ?>
  <i class="<?php echo JText::_('TPL_JOOSTRAP_GOTOP_ICON');?>"></i>
  <?php endif; ?>
  </a>
  <?php endif; ?>
</div>
<!-- Footer starts -->
<div class="footer">
  <div class="custom-container">
    <!-- Cant get enough hear more -->
    <!-- Contact with us -->
    <!-- Let Us Help You -->
    <!-- About SenditLater -->
    <!-- Categories -->
    <div class="row footer-section">
   <div class="col-sm-8">
      <div class="footer_contact_info">
        <?php if ($this->countModules('footer')): ?>
        
          <jdoc:include type="modules" name="footer" style="standard" />
        
        <?php endif; ?>
      </div>
      <div class="footer_links">
        <?php if ($this->countModules('bottom1')): ?>
        
          <jdoc:include type="modules" name="bottom1" style="standard" />
        
        <?php endif; ?>
      </div>
       
      <?php if ($this->countModules('bottom2')): ?>
      <jdoc:include type="modules" name="bottom2" style="standard" />
      <?php endif; ?>
    
  </div>
<div class="col-sm-4">
      <!-- Footer Subscribe section -->
<div class="footer_subscribe_data">
<?php if ($this->countModules('footer1')): ?>
       <div class="col-xs-12 hidden-sm hidden-xs">
      <div class="footer-social-icons">
        <jdoc:include type="modules" name="footer1" style="standard" />
      </div>
       </div>
      <?php endif; ?>
      <?php if ($this->countModules('footer2')): ?>
      <jdoc:include type="modules" name="footer2" style="standard" />
      <?php endif; ?>
</div>
      <!-- Footer Subscribe section -->

    </div>

    
</div>
  </div>
</div>
<!-- Footer ends -->
<div id="send_msg" class="modal fade custom-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-center"><?php echo JText::_('COM_CREATE_MESSAGE_POPUP_TEXT');?></p>
      </div>
      <div class="modal-footer">
        <div class="row"> <a class="btn btn-modal text-uppercase btn-signup spacer-bottom-30" href="javascript:void(0);" onClick="loadNextForm('gift');" data-dismiss="modal"><?php echo JText::_('COM_CREATE_MESSAGE_CONFIRM_TEXT');?></a> </div>
        <div class="row"> <a class="btn btn-modal text-uppercase btn-signup" href="javascript:void(0);" onClick="sendOnlyMsgCheckLogin('msg');" data-dismiss="modal"><?php echo JText::_('COM_CREATE_MESSAGE_CLOSE_TEXT');?></a> </div>
      </div>
    </div>
  </div>
</div>
<div id="send_msgOnly" class="modal fade custom-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-center"><?php echo JText::_('COM_CREATE_MESSAGE_POPUP_TEXT');?></p>
      </div>
      <div class="modal-footer">
        <div class="row"> <a class="btn btn-modal text-uppercase btn-signup spacer-bottom-30" href="<?php echo JURI::base()?>/component/createmessage?task=showproducts"  data-dismiss="modal"><?php echo JText::_('COM_CREATE_MESSAGE_CONFIRM_TEXT');?></a> </div>
        <div class="row"> <a class="btn btn-modal text-uppercase btn-signup createMsgBtn" id="closeSendMsgOnlyModal" href="<?php echo JURI::base()?>component/createmessage"  ><?php echo JText::_('COM_CREATE_MESSAGE_CLOSE_TEXT');?></a> </div>
      </div>
    </div>
  </div>
</div>
<div id="doNotEmailWarning" class="modal fade custom-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-center donNotMail"><?php echo JText::sprintf('COM_CREATE_MESSAGE_DO_NOT_EMAIL','recipient');?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-modal text-uppercase okBtn" data-dismiss="modal" aria-label="Close" ><?php echo JText::_('COM_CREATE_MESSAGE_DO_NOT_EMAIL_OK_BTN');?></button>
      </div>
    </div>
  </div>
</div>
<div id="warningModal" class="modal fade custom-modal  in" style="display: none;" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-center"><?php echo JText::_('COM_CREATE_MESSAGE_SELECT_IMAGE_WARNING'); ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-modal text-uppercase okBtn" data-dismiss="modal" aria-label="Close" ><?php echo JText::_('COM_CREATE_MESSAGE_DO_NOT_EMAIL_OK_BTN');?></button>
      </div>
    </div>
  </div>
</div>
<div id="loginModalRedeem" class="modal fade custom-modalbox hidden-element"></div>
<div id="orderConfirmRedeem" class="modal fade custom-modal hidden-element "></div>
<!--pop up for prompting user to create account 
	<div id="create_account" class="modal fade custom-modal ">-->
<div id="sign_up_confirmation_popup" class="modal custom-modalbox hidden-element"></div>
<!--pop up for articles-->
<div class="modal fade" id="articles-view-popUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog banner3Height" role="document">
    <div class="modal-content banner3Background">
      <div class="modal-body modal-custom_body"></div>
    </div>
  </div>
</div>
<!--pop up for career positions-->
<div class="modal fade" id="careerPosition-popUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body modal-custom_body"></div>
    </div>
  </div>
</div>
<?php 
		$session = JFactory::getSession();
		$selectedLanguage = $session->get('langaugedata');
		$user = JFactory::getUser();
		$lang = str_replace('-GB', '', $language->getTag());
		$lang = str_replace('-ES', '', $lang);
	?>
<input type="hidden" name="isUserLogin" id="isUserLogin" value="<?php echo $user->id;?>" />
<input type="hidden" name="currentLanguage" id="currentLanguage" value="<?php echo $lang;?>" />
<input type="hidden" name="isDone" id="isDone" />
<input type="hidden" value="yes" id="isScrollRequired" />
<input type="hidden" value="<?php echo JURI::root(); ?>" id="baseUrl" />
<script type="text/javascript">
		var token = '<?php echo JHtml::_('form.token');?>',
			selectedLanguage = "<?php echo $selectedLanguage; ?>";
		
		/* bootstrap tooltip */
		jQuery(document).ready(function () {
			window.onresize = function() {
			    jQuery('#youtube_iframe').css({'height':(parseInt(jQuery('#youtube_iframe').width())*0.5625)+'px'});
			}
			jQuery('#youtube_iframe').css({'height':(parseInt(jQuery('#youtube_iframe').width())*0.5625)+'px'});
		
			jQuery('.tooltip').tooltip({
				html: true
			});
			
			var get_url = "<?php echo JURI::base()?>login?view=registration&layout=complete";
			if(window.location.href == get_url) {
				jQuery(".sourcecoast ").hide();
			}
		
		/* 	if(jQuery('.sign-up-fields').length){
				jQuery('.sign-up-fields').append(token);
			} */

			jQuery("[rel=tooltip], #attachedFileName").tooltip();
			jQuery('#loginModalMsgOnlyModal').click(function(){
				jQuery('#loginModalMsgOnly').modal('hide');
			});
		
			jQuery(".main-nav li a").on('click', function(){
				var url= jQuery(this).attr("href");
				getAnalytics(url);
			});
	        
	        jQuery('.navbar-toggle').click(function(){
	          jQuery(this).toggleClass('open');
	        });
		});


		if(LOAD_HOMEPAGE_GIFTS){
			jQuery(window).bind("load", function($) {
				//jQuery(".nicescrollelement").niceScroll();
				loadProductsSection();
			});
		}
	</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

$( ".item-771" ).removeClass( "divider" );

        if($.cookie('mainpopup') != null && $.cookie('mainpopup') != "")
        {
            $("div#valentinePopUp.modal, .modal-backdrop").hide();
        }
        else
        {
            $('#valentinePopUp').modal('show');
            $.cookie('mainpopup', 'str');
        }
    });
	</script>
<script type="text/javascript">
		$(document).ready(function() {
	        if($.cookie('mainpopupmobile') != null && $.cookie('mainpopupmobile') != "")
	        {
	            $("div#valentinePopUp2.modal, .modal-backdrop").hide();
	        }
	        else
	        {
	            $('#valentinePopUp2').modal('show');
	            $.cookie('mainpopupmobile', 'str');
	        }
	    });
	</script>
<script type="text/javascript">
		sliderBanner();
		// $(document).ready(function() {
  //       if($.cookie('mainpopup') != null && $.cookie('mainpopup') != "")
  //       {
  //           $("div#myMainModal.modal, .modal-backdrop").hide();
  //       }
  //       else
  //       {
  //           $('#myMainModal').modal('show');
  //           $.cookie('mainpopup', 'str');
  //       }
  //   });
		
	</script>
<script type="text/javascript">
		// $(document).ready(function() {
  //       if($.cookie('mainpopupmobile') != null && $.cookie('mainpopupmobile') != "")
  //       {
  //           $("div#myMainModal2.modal, .modal-backdrop").hide();
  //       }
  //       else
  //       {
  //           $('#myMainModal2').modal('show');
  //           $.cookie('mainpopupmobile', 'str');
  //       }
  //   });
	</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
		function turnOnOffSearch(){
			var navBar = jQuery(".navbar "),
			searchbar = jQuery(".searchBar"),
			searchInput = jQuery("#searchbox"),
			searchIcon = jQuery(".search-icon"),
			mobileLogo = jQuery('.sillogo');

			if(jQuery(this).hasClass("open")){
				searchInput.css('visibility','hidden');
				searchbar.css({"width": "33.33%"});
				mobileLogo.css('visibility','visible');
				navBar.css({"width":"33.33%"});
				jQuery(this).removeClass("open");
			}else{
				mobileLogo.css('visibility','hidden');
				searchInput.css({'visibility':'visible',"outline":"none", "border":"none"});
				searchbar.css({"width": "85%","transition": ".5s ease-in-out", "position":"absolute", "right":"5px"});
				searchIcon.addClass("open");
				navBar.css({"width":"10%", "transition": ".5s ease-in-out"});
			}
		}
		function searchAction(){
			var currentURLValdiate = document.URL.substring(0, document.URL.lastIndexOf("&") +0),
				giftingPageValdiate = '<?php echo JURI::base();?>component/createmessage?task=showproducts',
				cagName = jQuery('.searchBarTest');
			
			jQuery(".search-icon").on("click", function(){
				// If this url is currently on gifting page, it would not reload page	
				if(currentURLValdiate == giftingPageValdiate){
					console.log('on gifting page!');
					searchproduct('',0,'submit');
				}
				// If this page is not currently on gifting page, it would redirect and add 'search' in url
				else{
					console.log('not on gifting page!');
					jQuery(location).attr('href', '<?php echo JURI::base();?>component/createmessage?task=showproducts&search=' + cagName.val());
				}
			});
			jQuery(document).on('keypress', '#searchbox', function(event){
				// If this url is currently on gifting page, it would not reload page
				if ( event.which == 13 ) {
					if(currentURLValdiate == giftingPageValdiate){
						console.log('on gifting page!');
						searchproduct('',0,'submit');
					}
					// If this page is not currently on gifting page, it would redirect and add 'search' in url
					else{
						console.log('not on gifting page!');
						jQuery(location).attr('href', '<?php echo JURI::base();?>component/createmessage?task=showproducts&search=' + cagName.val());
					}
				}
			});
		}
		if(jQuery(window).width() < 768){
			jQuery('.search-icon').on('click', turnOnOffSearch);
			searchAction();
		}else{
			searchAction();
		}

			jQuery('.homepage-banner .bx-viewport').height(514);
	jQuery('.homebanner-slider li').height(514);
	if (jQuery(window).width() < 900) {
    	jQuery("#SILVideoPopup").css("margin", "auto").css("display","block").css("float","none");
	}
	jQuery(window).resize(function () {
    	 if (jQuery(window).width() < 900) {
        jQuery("#SILVideoPopup").css("margin", "auto").css("display","block").css("float","none");
    	}
	});
	jQuery(document).ready(function(){
			 if (jQuery(window).width() > 900) {
    	jQuery("#SILVideoPopup").css("display","").css("float","none");
		}
	});
	jQuery(window).resize(function () {
    	 if (jQuery(window).width() > 900) {
        jQuery("#SILVideoPopup").css("display","").css("float","none");
    	}
	});
	jQuery("#SILVideoPopup").click(function(){
		var id = 'SILVideoPopup';
		var SILVideoPopup = '<div style="margin-top: 15px; position:relative; padding-bottom: 56.25%; padding-top: 25px; height: 0;" ><iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" class="videoFrame" width="98%" height="auto" src="https://www.youtube.com/embed/fZmRttM4zOo" frameborder="0" allowfullscreen></iframe></div>';
		var closeHtml = '<button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		jQuery('#articles-view-popUp .modal-custom_body').html(closeHtml+SILVideoPopup);
		jQuery('#articles-view-popUp').modal('show');
		hideShowNiceScrolls('',id,false);
		bodyFixedPosition();
		jQuery(document).click(function(){
			if(jQuery('.modal').is(':visible')){
				jQuery('.videoFrame').remove();
			}
		});
		jQuery('.modal-dialog').click(function(e){
			e.stopPropagation();
		});
		jQuery('.close.close-btn').click(function(){
			jQuery('#articles-view-popUp').trigger('click');
		});
	});

	</script>
	<script type="text/javascript">
	jQuery(document).ready(function(){
	    if (jQuery(window).width() < 900) {
	            jQuery('.content-ul').css('display','none');
	            jQuery('.cs-title').on('click', function(){
	                    if(jQuery('#ancillary').hasClass("open")){
	                            jQuery('.content-ul').css('display','none');
	                            jQuery('#ancillary').removeClass("open");
	                    }else{
	                            jQuery('#ancillary').addClass("open");
	                            jQuery('.content-ul').css('display','block');
	                            jQuery('.cs-title').css('clip', 'rect(41px,78px,58px,61px)');
	                    }
	                    jQuery(this).toggleClass('plus');
	            });
	    }
	});
	</script>
</body>
</html>
