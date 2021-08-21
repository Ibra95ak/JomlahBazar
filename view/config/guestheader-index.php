<?php
require_once 'model/Base.php';/*fetch Directory variables*/
require_once 'vendor/autoload.php';/*call composer functions*/

use Anam\Phpcart\Cart;
$cart = new Cart();

if (isset($_SESSION['userId'])) {
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$userId = $usr->userId;
	$username = $usr->fullname;
	$url_lgn = DIR_VIEW . DIR_USR . "form_user.php";
}else{
	$userId = 0;
	$username = "Sign in";
	$cartTotal=0;
	$url_lgn = DIR_VIEW . DIR_USR . "login.php";
}
$client = new GuzzleHttp\Client();
$res_mcat = $client->request('GET', DIR_CONT . DIR_MCAT . 'CON_maincategories.php?action=get&maincategoryId=0');/*fetch all categories*/
$main_categories = json_decode($res_mcat->getBody());
$res_role = $client->request('GET', DIR_JSON . 'Read.php?jsonname=roles.json');/*fetch all categories*/
$main_roles = json_decode($res_role->getBody());
$res_servicesrole = $client->request('GET', DIR_JSON . 'Read.php?jsonname=servicesroles.json');/*fetch all categories*/
$main_servicesroles = json_decode($res_servicesrole->getBody());
// if(isset($_GET['mcat'])) $mcat_ini=$_GET['mcat'];
// else $mcat_ini="";
if(isset($_GET['searchtext'])) $searchtext=$_GET['searchtext'];
else $searchtext='';
?>
<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

<head>
	<base href="">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex">
	<title>JomlahBazar</title>
	<meta name="description" content="JomlahBazar is an online wholesale marketplace for B2B and B2C buyers of the UAE and MENA markets. Grab the amazing deals on your favorite Perfume, Make Up, Grocery products and more.">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="jK4Bt2ICskPGXlqQJ7qQQROATHsxinJhOKQf_AztMA8" />
	<!--begin::Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
	<!--end::Fonts -->
	<!--begin::Page Vendors Styles(used by this page) -->
	<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles -->
	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->
	<!--begin::Layout Skins(used by all pages) -->
	<link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/wizard/wizard-2.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/needim/noty/77268c46/lib/noty.css">
	<script type="text/javascript" src="https://cdn.rawgit.com/needim/noty/77268c46/lib/noty.min.js"></script>
	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/brand/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/aside/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/support-center/faq-3.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/pages/support-center/feedback.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/pages/support-center/home-1.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0VYKEQKQ5Q"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0VYKEQKQ5Q');
</script>
<script id="mcjs">!function(c,h,i,m,p){​​​​​​​m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}​​​​​​​(document,"script","https://chimpstatic.com/mcjs-connected/js/users/625e79d4c16dd964a3bef472e/5afae1c7319d6a62a25184465.js");</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5X8ZXZG');</script>
<!-- End Google Tag Manager -->
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading kt-font-dark">
<script src="https://my.rtmark.net/p.js?f=sync&lr=1&partner=c3937e83ad8bf141f79c079e2b38213e28454a1762c1666f04dacf075b489681" defer></script> <noscript><img src="https://my.rtmark.net/img.gif?f=sync&lr=1&partner=c3937e83ad8bf141f79c079e2b38213e28454a1762c1666f04dacf075b489681" width="1" height="1" /></noscript>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5X8ZXZG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<!-- begin:: Page -->
	<!-- begin:: Header Mobile -->
	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
		<div class="kt-header-mobile__logo">
			<a href="javascript:void(0)" class="kt-menu__link hamburger_menu kt-mr-5" data-toggle="modal" data-target="#kt_modal_hamburger"><i class="fa fa-bars" style="font-size: 20px;"></i></a>
			<a href="<?php echo DIR_ROOT;?>">
				<img alt="Logo" src="assets/media/logos/jb-logo-sm-black.png" style="width: 150px;" />
			</a>
		</div>
		<div class="kt-header-mobile__toolbar">
			<a href="javascript:void(0)" class="kt-menu__link hamburger_menu kt-mr-10"><i class="fa fa-user" style="font-size: 20px;" data-toggle="modal" data-target="#kt_modal_user"></i></a>
			<a href="<?php echo DIR_VIEW . 'carts/' . "cart.php" ?>" class="kt-menu__link kt-transparent"><span id="cart-count"><?php echo $cart->count() ?></span><img src="<?php echo DIR_ROOT.DIR_ICON?>cart-black.webp" class="cart-icon kt-mt-5"></a>
		</div>
	</div>
	<div class="input-group nav-search nav-search-mobile">
	<div class="typeahead">
		<input type="text" class="form-control height-40 header-search-width" aria-label="Text input with dropdown button" id="header_search_text_mobile" placeholder="">
	</div>
	<div class="input-group-append">
									<button class="btn btn-light height-40" type="button" id="header_search_mobile" ><i class="la la-search"></i></button>
								</div>
	</div>
	<!-- end:: Header Mobile -->

	<div class="kt-grid kt-grid--hor kt-grid--root safari-row-block safari-row-desktop-block">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<!-- end:: Aside -->
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper kt-pl0" id="kt_wrapper" style="padding-top: 35px;">

				<!-- begin:: Header -->
				<div id="kt_header" class="kt-header kt-header-b2c kt-grid__item kt-header--fixed left0 diplay-block shadow">
					<!-- begin: Header Menu -->
					<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
						<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
							<a href="javascript:void(0)" class="kt-menu__link hamburger_menu" data-toggle="modal" data-target="#kt_modal_hamburger"><i class="fa fa-bars" style="font-size: 20px;"></i><span class="kt-font-md kt-ml-5">All</span></a>
							<div class="header-slot">
								<a href="<?php echo DIR_ROOT ; ?>">
									<img alt="Logo" src="assets/media/logos/supplychain-jomlahbazar-emarket-wholesale-expo2020-logo-desktop-black.jpg" class="nav-logo" />
								</a>
							</div>
							<div class="input-group nav-search">
								<!-- <div class="input-group-prepend">
									<button type="button" class="btn btn-light dropdown-toggle height-40" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="search-dropdown">
										Products
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item search-opt" href="javascript:void(0)" data-id="Products">Products</a>
										<a class="dropdown-item search-opt kt-hidden" href="javascript:void(0)" data-id="Services">Services</a>
										<a class="dropdown-item search-opt kt-hidden" href="javascript:void(0)" data-id="Suppliers">Suppliers</a>
										<a class="dropdown-item search-opt kt-hidden" href="javascript:void(0)" data-id="Location">Location</a>
									</div>
								</div> -->
								<div class="input-group-prepend">
									<button type="button" class="btn btn-light dropdown-toggle height-40 rounded-left" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="search_maincat-dropdown">
										All
									</button>
									<input type="hidden" id="search_maincat-id" value="<?php //echo $mcat_ini;?>">
									<div class="dropdown-menu">
										<a class="dropdown-item search-mcat" href="javascript:void(0)" data-id="0">All</a>
										<?php
										foreach ($main_categories as $main_category) {
											echo '<a class="dropdown-item search-mcat" href="javascript:void(0)" data-id="' . $main_category->maincategoryId . '">' . $main_category->name . '</a>';
										}
										?>

									</div>
								</div>
								<div class="input-group-prepend">
									<button type="button" class="btn btn-light dropdown-toggle height-40" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="search_servicesrole-dropdown" style="display:none;">
										All
									</button>
									<input type="hidden" id="search_servicesrole-id" value="<?php //echo $mcat_ini;?>">
									<div class="dropdown-menu">
										<a class="dropdown-item search_servicesrole" href="javascript:void(0)" data-id="0">All</a>
										<?php
										foreach ($main_servicesroles->data as $main_servicesrole) {
											echo '<a class="dropdown-item search_servicesrole" href="javascript:void(0)" data-id="' . $main_servicesrole->roleId . '">' . $main_servicesrole->role . '</a>';
										}
										?>

									</div>
								</div>
								<div class="input-group-prepend">
									<button type="button" class="btn btn-light dropdown-toggle height-40" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="search_role-dropdown" style="display:none;">
										All
									</button>
									<input type="hidden" id="search_role-id" value="<?php //echo $mcat_ini;?>">
									<div class="dropdown-menu">
										<a class="dropdown-item search-role" href="javascript:void(0)" data-id="0">All</a>
										<?php
										foreach ($main_roles->data as $main_role) {
											echo '<a class="dropdown-item search-role" href="javascript:void(0)" data-id="' . $main_role->roleId . '">' . $main_role->role . '</a>';
										}
										?>

									</div>
								</div>
								<div class="typeahead">
									<input type="text" class="form-control height-40 header-search-width rounded-0" aria-label="Text input with dropdown button" id="header_search_text" placeholder="">
								</div>
								<div class="input-group-append">
									<button class="btn btn-light height-40" id="reset_search"><i class="la la-times kt-font-light"></i></button>
									<button class="btn btn-warning height-40 rounded-right" type="button" id="header_search" ><i class="la la-search"></i></button>
								</div>
							</div>
							<ul class="kt-menu__nav kt-mr-5">
								<li class="kt-menu__item  kt-menu__item--submenu header-slot kt-transparent" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><i class="flaticon-placeholder-2 kt-font-dark kt-font-lg"></i><a href="javascript:;" class="kt-menu__link kt-menu__toggle kt-transparent"><img src="assets/media/icons/uae.webp" alt="" style="width: 35px;height: 35px;"><i class="fa fa-caret-down dropdown-flag kt-font-dark"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item " aria-haspopup="true"><a href="javascript:void(0)" class="kt-menu__link "><span class="kt-menu__link-text">You are now shopping on Jomlahbazar.com (UAE Marketplace)</span></a></li>
										</ul>
									</div>
								</li>
							</ul>
							<ul class="kt-menu__nav">
								<li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--active kt-menu__item--open-dropdown header-slot" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle kt-transparent"><span class="kt-menu__link-text kt-topheader-toptext">Hello, <?php echo $username;?></span><span class="kt-menu__link-text kt-topheader-bottomtext">Account & Lists <i class="fa fa-caret-down"></i></span></a>
									<div class="kt-menu__submenu  kt-menu__submenu--fixed kt-menu__submenu--center" style="width:380px">
										<div class="kt-menu__subnav">
											<ul class="kt-menu__content">
												<li class="kt-menu__item "><h3 class="kt-menu__heading kt-menu__toggle kt-pt5"><div class="kt-login__account">
													<p><a href="javascript:void(0);" class="btn btn-warning btn-width-full" onclick="login()">Sign In</a></p>
													<span class="kt-login__account-msg kt-font-sm ">
														Become a Seller.
													</span>&nbsp;&nbsp;
													<a href="javascript:void(0);" class="kt-link kt-link--light kt-login__account-link kt-font-sm kt-font-brand" onclick="login()">Start here</a>
												</div></h3></li>
												<img src="<?php echo DIR_ROOT.DIR_ICON.'buyer.webp'?>" style="width:100px;height:100px;" class="kt-mr-50"/>
											</ul>
											<ul class="kt-menu__content">
												<li class="kt-menu__item ">
													<h3 class="kt-menu__heading kt-menu__toggle"><span class="kt-menu__link-text kt-font-bolder /*kt-font-light*/">My Account</span></h3>
													<ul class="kt-menu__inner">
														<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Personal Account</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Wallet</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Orders</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Quotations</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Addresses</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Lists</span></a></li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li class="kt-menu__item header-slot kt-transparent"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link kt-transparent"><span class="kt-menu__link-text kt-topheader-toptext">Returns</span><span class="kt-menu__link-text kt-topheader-bottomtext">& Orders </span></a></li>
								<li class="kt-menu__item  header-slot"><a href="<?php echo DIR_VIEW . 'carts/' . "cart.php" ?>" class="kt-menu__link kt-transparent"><span id="cart-count"><?php echo $cart->count() ?></span><img src="<?php echo DIR_ROOT.DIR_ICON?>cart-black.webp"/ class="cart-icon"><span id="cart-lable">cart</span></a></li>
							</ul>
						</div>
					</div>
					<!-- end: Header Menu -->
				</div>

				<!-- end:: Header -->
				<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
					<!-- begin:: Hamburger menu -->
					<div class="modal fade" id="kt_modal_hamburger" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal_hamburger" role="document">
							<div class="modal-content">
								<div class="modal-header bg-dark">
									<img src="<?php echo DIR_ROOT.DIR_ICON?>user.webp" width="25" height="25" style="margin-right:5px;"/>
									<h5 class="modal-title kt-font-light" id="exampleModalLabel"> Hello, <?php echo $username;?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									</button>
								</div>
								<div class="modal-body full-height">
									<?php
									foreach ($main_categories as $mcategory) {
										if ($mcategory->maincategoryId!=2) {
											echo '<p><a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?mcat=' . $mcategory->maincategoryId . '" class="kt-link kt-font-transform-u kt-font-dark kt-font-bolder">' . $mcategory->name . '</a><i class="fa fa-angle-down mcat-angle-down" onclick="showcat(' . $mcategory->maincategoryId . ')"></i></p>';
											$res_mcats = $client->request('GET', DIR_CONT . DIR_MCAT . 'CON_maincategories.php?action=get&maincategoryId=' . $mcategory->maincategoryId);/*fetch all categories*/
											$mcategories = json_decode($res_mcats->getBody());
											echo '<div id="categories' . $mcategory->maincategoryId . '" style="position:relative;left:20px;display:none;">';
											foreach ($mcategories->categories as $mcat) {
												if ($mcat->count_pro!=0) {
													echo '<p><a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?cat=' . $mcat->categoryId . '" class="kt-link kt-font-transform-u kt-font-dark">' . $mcat->name . '</a></i></p>';
												}
											}
											echo '</div>';
										}else {
											echo '<p><a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?mcat=' . $mcategory->maincategoryId . '" class="kt-link kt-font-transform-u kt-font-dark kt-font-bolder">' . $mcategory->name . '</a><i class="fa fa-angle-down mcat-angle-down" onclick="showcat(' . $mcategory->maincategoryId . ')"></i></p>';
											$res_mcats = $client->request('GET', DIR_CONT . DIR_MCAT . 'CON_maincategories.php?action=get&maincategoryId=' . $mcategory->maincategoryId);/*fetch all categories*/
											$mcategories = json_decode($res_mcats->getBody());
											echo '<div id="categories' . $mcategory->maincategoryId . '" style="position:relative;left:20px;display:none;">';
											foreach ($mcategories->categories as $mcat) {
												switch ($mcat->name) {
													case 'Perfume For Women':
														$feature_name = 'ff';
														$feature_value = 1;
														break;
													case 'Perfume For Men':
													$feature_name = 'ff';
													$feature_value = 2;
														break;
													case 'Arabic Scents':
														$feature_name = 'as';
														$feature_value = 1;
														break;
													case 'Luxury Perfume':
														$feature_name = 'lx';
														$feature_value = 1;
														break;
													case 'Tester':
														$feature_name = 'ts';
														$feature_value = 1;
														break;
													case 'Giftset':
														$feature_name = 'gt';
														$feature_value = 1;
														break;

													default:
														$feature_name = 'ts';
														$feature_value = 1;
														break;
												}
												echo '<p><a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?'.$feature_name.'=' . $feature_value. '" class="kt-link kt-font-transform-u kt-font-dark">' . $mcat->name . '</a></i></p>';
											}
											echo '</div>';
										}
									}
									?>
									<hr>
									<h3 class="kt-font-md kt-font-dark kt-font-bolder">Help & Settings</h3>
									<br>
									<p><a href="<?php echo $url_lgn;?>" class="kt-link kt-font-transform-u kt-font-dark">Your Account</a></p>
									<p><a href="<?php echo DIR_VIEW . DIR_CON . "supportcenter.php" ?>" class="kt-link kt-font-transform-u kt-font-dark">Help</a></p>
									<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-link kt-font-transform-u kt-font-dark">Sign In</a></p>
								</div>
							</div>
						</div>
					</div>
					<!-- end:: Hamburger menu -->
					<!-- begin:: Hamburger menu -->
					<div class="modal fade" id="kt_modal_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal_hamburger" role="document">
							<div class="modal-content">
								<div class="modal-header bg-dark">
									<img src="<?php echo DIR_ROOT.DIR_ICON?>user.webp" width="25" height="25" style="margin-right:5px;"/>
									<h5 class="modal-title kt-font-light" id="exampleModalLabel"> Hello, <?php echo $username;?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									</button>
								</div>
								<div class="modal-body full-height">
										<h3 class="kt-menu__heading kt-menu__toggle"><span class="kt-menu__link-text kt-font-bolder /*kt-font-light*/">My Account</span></h3>
											<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Personal Account</span></a></p>
											<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Wallet</span></a></p>
											<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Orders</span></a></p>
											<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Quotations</span></a></p>
											<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Addresses</span></a></p>
											<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Lists</span></a></p>
											<a href="https://wa.me/971545277180"><i class="flaticon-whatsapp kt-font-success kt-font-lg"></i></a>
								</div>
							</div>
						</div>
					</div>
					<!-- end:: Hamburger menu -->
