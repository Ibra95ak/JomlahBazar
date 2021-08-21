<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
	<base href="../../">
	<meta charset="utf-8" />
	<title>JB</title>
	<meta name="description" content="JomlahBazar is an online wholesale marketplace for B2B and B2C buyers of the UAE and MENA markets. Grab the amazing deals on your favorite Perfume, Make Up, Grocery products and more.">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
	<link href="assets/css/pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/needim/noty/77268c46/lib/noty.css">
	<script type="text/javascript" src="https://cdn.rawgit.com/needim/noty/77268c46/lib/noty.min.js"></script>
	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<link href="assets/css/skins/header/base/dark.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/header/menu/dark.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/support-center/faq-3.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/support-center/feedback.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/support-center/home-1.css" rel="stylesheet" type="text/css" />
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--fixed kt-page--loading">
	<!-- begin:: Page -->
	<!-- begin:: Header Mobile -->
	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
		<div class="kt-header-mobile__logo">
			<a href="<?php echo DIR_ROOT ; ?>">
				<img alt="Logo" src="assets/media/logos/jb-logo-bg-black.png" style="width: 50px;" />
			</a>
		</div>
		<div class="kt-header-mobile__toolbar">
			<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
			<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
			<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
		</div>
	</div>
	<!-- end:: Header Mobile -->

	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			<?php //include('asidemenu.php')
			?>
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper kt-pl0" id="kt_wrapper" style="padding-top: 25px;">

				<!-- begin:: Header -->
				<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " style="height: 50px;">

						<!-- begin:: Header Menu -->

						<!-- Uncomment this to display the close button of the panel
<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
-->
						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
								<ul class="kt-menu__nav ">
									<li class="kt-menu__item kt-p15"><a href="<?php echo DIR_VIEW.DIR_ADMN.'dt_users.php'?>" class="kt-link kt-font-light kt-font-bolder"><span class="kt-menu__link-text">Users</span></a>
									<li class="kt-menu__item kt-p15"><a href="<?php echo DIR_VIEW.DIR_ADMN.'dt_orders.php'?>" class="kt-link kt-font-light kt-font-bolder"><span class="kt-menu__link-text">Orders</span></a>
									</li>
									<li class="kt-menu__item kt-p15"><a href="<?php echo DIR_VIEW.DIR_ADMN.'dt_orderdetails.php'?>" class="kt-link kt-font-light kt-font-bolder"><span class="kt-menu__link-text">Order Details</span></a>
									</li>
									<li class="kt-menu__item kt-p15"><a href="<?php echo DIR_VIEW.DIR_ADMN.'dt_products.php'?>" class="kt-link kt-font-light kt-font-bolder"><span class="kt-menu__link-text">Products</span></a>
									</li>
									<li class="kt-menu__item kt-p15"><a href="<?php echo DIR_VIEW.DIR_ADMN.'dt_stores.php'?>" class="kt-link kt-font-light kt-font-bolder"><span class="kt-menu__link-text">Stores</span></a>
									</li>
									<li class="kt-menu__item kt-p15"><a href="<?php echo DIR_VIEW.DIR_ADMN.'dt_banktransfers.php'?>" class="kt-link kt-font-light kt-font-bolder"><span class="kt-menu__link-text">Bank Transfers</span></a>
									</li>
									<li class="kt-menu__item kt-p15"><a href="<?php echo DIR_VIEW.DIR_ADMN.'dt_refunds.php'?>" class="kt-link kt-font-light kt-font-bolder"><span class="kt-menu__link-text">Refunds</span></a>
									</li>
									<li class="kt-menu__item kt-p15"><a href="<?php echo DIR_VIEW.DIR_ADMN.'dt_shipments.php'?>" class="kt-link kt-font-light kt-font-bolder"><span class="kt-menu__link-text">Shipments</span></a>
									</li>
								</ul>
							</div>
						</div>
						<!-- end:: Header Menu -->
					</div>
				<!-- end:: Header -->
				<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
