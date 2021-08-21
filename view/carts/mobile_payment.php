<?php
require_once '../../model/Base.php';/*fetch Directory variables*/
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
	<!--end::Page Vendors Styles -->
	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->
	<!--begin::Layout Skins(used by all pages) -->
	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/brand/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/aside/light.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
		alert("hello");
	</script>
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
							<div class="header-slot">
								<a href="<?php echo DIR_ROOT ; ?>">
									<img alt="Logo" src="assets/media/logos/supplychain-jomlahbazar-emarket-wholesale-expo2020-logo-desktop-black.jpg" class="nav-logo" />
								</a>
							</div>
						</div>
					</div>
					<!-- end: Header Menu -->
				</div>

				<!-- end:: Header -->
				<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->
    <div class="row kt-mt-50">
        <div class="col-md-12">
					 <?php
					 echo "price=".$_COOKIE['price'];
					 //include "https://jomlahbazar.com/api/mashreq/IFRAME_KIT/dataFrom.htm?tp=".$_POST['cookiestp']."&userId=".$_COOKIE['cookiesuserId']."&adid=".$_COOKIE['cookiesaddressId']."&orderId=".$_COOKIE['cookiesorderId']."&orderdetailIds=".$_COOKIE['cookiesorderdetailIds'];
					 ?>
        </div>
    </div>

		<!--End::Dashboard 3-->
</div>
<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script type="text/javascript">
function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}
var price = getCookie('price');
alert('price='+price);
</script>
