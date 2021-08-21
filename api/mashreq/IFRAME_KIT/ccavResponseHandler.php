<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
?>
<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

<head>
	<base href="../../../">
	<meta charset="utf-8" />
	<title>JB</title>
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
</head>
<!-- end::Head -->
<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading kt-font-dark">
	<!-- begin:: Page -->
	<!-- begin:: Header Mobile -->
	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
		<div class="kt-header-mobile__logo">
			<a href="javascript:void(0)" class="kt-menu__link hamburger_menu kt-mr-5"><i class="fa fa-bars" style="font-size: 20px;" data-toggle="modal" data-target="#kt_modal_hamburger"></i></a>
			<a href="<?php echo DIR_ROOT;?>">
				<img alt="Logo" src="assets/media/logos/jb-logo-sm-black.png" style="width: 150px;" />
			</a>
		</div>
	</div>
	<!-- end:: Header Mobile -->
	<div class="kt-grid kt-grid--hor kt-grid--root safari-row-block safari-row-desktop-block">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper kt-pl0" id="kt_wrapper" style="padding-top: 35px;">

				<!-- begin:: Header -->
				<div id="kt_header" class="kt-header kt-header-b2c kt-grid__item kt-header--fixed left0 diplay-block shadow">
					<!-- begin: Header Menu -->
					<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
						<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
							<a href="javascript:void(0)" class="kt-menu__link hamburger_menu"><i class="fa fa-bars" style="font-size: 20px;" data-toggle="modal" data-target="#kt_modal_hamburger"></i><span class="kt-font-md kt-ml-5">All</span></a>
							<div class="header-slot">
								<a href="<?php echo DIR_ROOT ; ?>">
									<img alt="Logo" src="assets/media/logos/supplychain-jomlahbazar-emarket-wholesale-expo2020-logo-desktop-black.jpg" class="nav-logo" />
								</a>
							</div>

							<ul class="kt-menu__nav ">
								<li class="kt-menu__item  kt-menu__item--submenu header-slot kt-transparent" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><i class="flaticon-placeholder-2 kt-font-dark kt-font-lg"></i><a href="javascript:;" class="kt-menu__link kt-menu__toggle kt-transparent"><img src="assets/media/icons/uae.webp" alt="" style="width: 35px;height: 35px;"><i class="fa fa-caret-down dropdown-flag kt-font-dark"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item " aria-haspopup="true"><a href="javascript:void(0)" class="kt-menu__link "><span class="kt-menu__link-text">You are now shopping on Jomlahbazar.com (UAE Marketplace)</span></a></li>
										</ul>
									</div>
								</li>
							</ul>
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
										foreach ($main_categories->data as $main_category) {
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
									foreach ($main_categories->data as $mcategory) {
										echo '<p><a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?mcat=' . $mcategory->maincategoryId . '" class="kt-link kt-font-transform-u kt-font-dark kt-font-bolder">' . $mcategory->name . '</a><i class="fa fa-angle-down mcat-angle-down" onclick="showcat(' . $mcategory->maincategoryId . ')"></i></p>';
										$res_mcats = $client->request('GET', DIR_CONT . DIR_MCAT . 'CON_maincategories.php?action=get&maincategoryId=' . $mcategory->maincategoryId);/*fetch all categories*/
										$mcategories = json_decode($res_mcats->getBody());
										echo '<div id="categories' . $mcategory->maincategoryId . '" style="position:relative;left:20px;display:none;">';
										foreach ($mcategories->categories as $mcat) {
											echo '<p><a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?cat=' . $mcat->categoryId . '" class="kt-link kt-font-transform-u kt-font-dark">' . $mcat->name . '</a></i></p>';
										}
										echo '</div>';
									}
									?>
									<hr>
									<h3 class="kt-font-lg kt-font-dark kt-font-bolder">Help & Settings</h3>
									<br>
									<p><a href="<?php echo $url_lgn;?>" class="kt-link kt-font-transform-u kt-font-dark">Your Account</a></p>
									<p><a href="<?php echo DIR_VIEW . DIR_CON . "supportcenter.php" ?>" class="kt-link kt-font-transform-u kt-font-dark">Help</a></p>
									<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-link kt-font-transform-u kt-font-dark">Sign In</a></p>
								</div>
							</div>
						</div>
					</div>
					<!-- end:: Hamburger menu -->
<?php include('Crypto.php')?>
<?php

	error_reporting(0);
	require_once '../../../' . DIR_MOD . 'Ser_Orders.php';
	$db = new Ser_Orders();
	$workingKey='D52F1B0FADA05C308AA4273C9A4E1087';		//Working Key should be provided here.
	$encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
	$rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	echo "<center>";

	for($i = 0; $i < $dataSize; $i++)
	{
		$information=explode('=',$decryptValues[$i]);
		if($i==0)	$orderNumber=$information[1];
		if($i==1)	$refId=$information[1];
		if($i==3)	$order_status=$information[1];
		if($i==10)	$total_price=$information[1];
	}

	if($order_status==="Success")
	{
		$pay_seller = $db->UpdateOrderSellerPayments($orderNumber,$refId, $order_status);
		$pay_buyer=$db->UpdateOrderBuyerPayments($orderNumber,$refId, $order_status);
		$msg = "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";

	}
	else if($order_status==="Aborted")
	{
		$pay_seller = $db->UpdateOrderSellerPayments($orderNumber,$refId, $order_status);
		$pay_buyer=$db->UpdateOrderBuyerPayments($orderNumber,$refId, $order_status);
		$msg = "Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";

	}
	else if($order_status==="Failure")
	{
		$pay_seller = $db->UpdateOrderSellerPayments($orderNumber,$refId, "Declined");
		$pay_buyer=$db->UpdateOrderBuyerPayments($orderNumber,$refId, "Declined");
		$msg = "Thank you for shopping with us.However,the transaction has been declined.";
	}
	else
	{
		$pay_seller = $db->UpdateOrderSellerPayments($orderNumber,$refId, "Declined");
		$pay_buyer=$db->UpdateOrderBuyerPayments($orderNumber,$refId, "Declined");
		$msg = "Security Error. Illegal access detected";
	}
	echo "</center>";
?>
<div class="kt-portlet kt-portlet--mobile" id="paymentStatus">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Order Payment
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">
											<?php echo $msg;?>
											<button type="button" class="btn btn-warning btn-elevate btn-elevate-air kt-m30" onclick="myorders()">Go to order page</button>
										</div>
									</div>
<script type="text/javascript">
	function myorders() {
		location.href= DIR_VIEW+DIR_ORD+'b2c-my-orders.php?order=ordersuccess';
	}
</script>
<?php include(DIR_VIEW.DIR_CON."footer.php"); ?>
