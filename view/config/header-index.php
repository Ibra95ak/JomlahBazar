<?php
require_once 'model/Base.php';/*fetch Directory variables*/
require_once 'vendor/autoload.php';
$client = new GuzzleHttp\Client();
/*Call Users class*/
require_once 'model/Ser_Users.php';
$res_uid = $client->request('GET', DIR_CONT.DIR_USR.'CON_sessions.php?action=get&jbidentifier='.$_SESSION['userId']);/*fetch userId*/
$usr = json_decode($res_uid->getBody());
$userId = $usr->userId;
$username = $usr->fullname;
/*Create Users instance*/
$db = new Ser_Users();
$user_info = $db->getUserById($userId);
if ($user_info['fullname'] != null) {
	$username = $user_info['fullname'];
} elseif ($user_info['email'] != null) {
	$username = $user_info['email'];
} elseif ($user_info['otp'] != null) {
	$username = $user_info['otp'];
}
switch ($user_info['roleId']) {
	case 1:
		$display = "";
		break;
	case 3:
		$display = "kt-hidden";
		break;
	default:
		$display = "kt-hidden";
		break;
}
$client = new GuzzleHttp\Client();
$res_notif = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_functions.php?action=get_notification&userId='.$userId);
$notifs = json_decode($res_notif->getBody());

?>
<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

<head>
	<base href="">
	<meta charset="utf-8" />
	<title>JB</title>
	<meta name="description" content="JomlahBazar is an online wholesale marketplace for B2B and B2C buyers of the UAE and MENA markets. Grab the amazing deals on your favorite Perfume, Make Up, Grocery products and more.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<link href="assets/css/skins/header/base/dark.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/header/menu/dark.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading kt-font-dark">
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
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper kt-pl0" id="kt_wrapper">

				<!-- begin:: Header -->
				<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed left0">
					<!-- begin: Header Menu -->
					<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
						<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
							<a href="<?php echo DIR_ROOT ; ?>">
								<img alt="Logo" src="assets/media/logos/jb-logo-sm-white.png" class="nav-logo-seller">
							</a>
							<ul class="kt-menu__nav ">
								<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle kt-font-light"><i class="kt-menu__link-icon flaticon-profile-1"></i><span class="kt-menu__link-text">My Store</span><i class="kt-menu__ver-arrow flaticon2-next " style="font-size: 14px;"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "form_useraccount.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Marketing Profile</span></a></li>
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "form_usersocial.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Social Accounts </span></a></li>
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "form_userdevices.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Devices</span></a></li>
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "form_usercontacts.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">My Contact list </span></a></li>
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_STR . "storedetails.php?userId=1" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">My Store </span></a></li>
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "form_useraddress.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Setup Locations </span></a></li>
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "form_userwallets.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">My Wallet </span></a></li>
										</ul>
									</div>
								</li>
								<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "dt_users.php" ?>" class="kt-menu__link kt-font-light"><i class="kt-menu__link-icon flaticon-star"></i><span class="kt-menu__link-text">eMarket People</span></a></li>
								<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle kt-font-light"><i class="kt-menu__link-icon flaticon2-grids"></i><span class="kt-menu__link-text">My Inventory</span><i class="kt-menu__ver-arrow flaticon2-next " style="font-size: 14px;"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_BRND . "dt_brands.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">My Brands</span></a></li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_CAT . "dt_categories.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">My Categories</span></a></li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_PRO . "dt_products.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Add a product</span></a></li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_PRO . "dt_myproducts.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">My product list</span></a></li>
											<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_PRO . "bulkupload.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Add a product via upload</span></a></li>
										</ul>
									</div>
								</li>
								<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle kt-font-light"><?php if (isset($notifs)) echo "(" . count($notifs) . ")"; ?><img class="header_icon" src="assets/media/icons/myorders.png" /><span class="kt-menu__link-text">My Orders/Sales</span><i class="kt-menu__ver-arrow flaticon2-next " style="font-size: 14px;"></i></a>
									<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
										<ul class="kt-menu__subnav">
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW;?>dt_suppliercarts.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Buyers' Carts</span></a></li>
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW;?>dt_supplierwishlists.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">Buyers' Wishlist</span></a></li>
											<li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle kt-font-light"><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">My Orders</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
												<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right" style="padding: 0px 0px;">
													<ul class="kt-menu__subnav">
														<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_ORD . "b2c-received-orders.php?from=".date('Y-m-d').'&to='.date('Y-m-d') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Orders I Received</span></a></li>
														<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_ORD . "b2c-my-orders.php" ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Orders I Made</span></a></li>
													</ul>
												</div>
											</li>
											<li class="kt-menu__item" aria-haspopup="true"><a href="<?php echo DIR_VIEW;?>dt_users.php" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text">My Qoutations</span></a></li>
										</ul>
									</div>
								</li>
								<li class="kt-menu__item kt-hidden" aria-haspopup="true"><a href="#" class="kt-menu__link kt-font-light"><i class="kt-menu__link-icon flaticon-star"></i><span class="kt-menu__link-text">Reviews</span></a></li>
							</ul>
						</div>
					</div>
					<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
					<!-- end: Header Menu -->

					<!-- begin:: Header Topbar -->
					<div class="kt-header__topbar">
						<!--begin: Notifications -->
						<div class="kt-header__topbar-item dropdown">
							<!--begin: Cart -->
							<div class="kt-header__topbar-item">
								<div class="kt-header__topbar-wrapper" data-offset="10px,0px">
									<span class="kt-header__topbar-icon">
										<a href="<?php echo DIR_VIEW . DIR_CAR . "cart.php" ?>"><i class="flaticon2-shopping-cart-1"></i></a>
									</span>
								</div>
							</div>
							<!--end: Cart-->

							<!--begin: Wish List -->
							<div class="kt-header__topbar-item">
								<div class="kt-header__topbar-wrapper" data-offset="10px,0px">
									<span class="kt-header__topbar-icon">
										<a href="<?php echo DIR_VIEW . DIR_CAR . "wishlist.php" ?>"><i class="flaticon-black"></i></a>
									</span>
								</div>
							</div>
							<!--end: Wish List-->

						</div>

						<!--begin: Notifications -->
						<div class="kt-header__topbar-item dropdown">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
								<span class="kt-header__topbar-icon"><i class="flaticon2-bell-alarm-symbol"></i></span>
								<span class="kt-hidden kt-badge kt-badge--dot kt-badge--notify kt-badge--sm"></span>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
								<form>

									<!--begin: Head -->
									<div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
										<h3 class="kt-head__title">
											Notifications
											&nbsp;
											<span class="btn btn-label-primary btn-sm btn-bold btn-font-md"><?php if (isset($notifs)) echo count($notifs);
																											else echo 0 ?> new</span>
										</h3>
										<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
											<li class="nav-item">
												<a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">New Order</a>
											</li>
											<!-- <li class="nav-item">
    													<a class="nav-link" data-toggle="tab" href="#topbar_notifications_events" role="tab" aria-selected="false">Events</a>
    												</li>
    												<li class="nav-item">
    													<a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs" role="tab" aria-selected="false">Logs</a>
    												</li> -->
										</ul>
									</div>

									<!--end: Head -->
									<div class="tab-content">
										<div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
											<div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
												<?php if (is_array($notifs) || is_object($notifs)) {
													foreach ($notifs as $notif) { ?>
														<a href="javascript::void(0)" class="kt-notification__item" onclick="readNotif(<?php echo $notif->id ?>)">
															<div class="kt-notification__item-icon">
																<i class="flaticon2-line-chart kt-font-success"></i>
															</div>

															<div class="kt-notification__item-details">
																<div class="kt-notification__item-title">
																	<?php echo $notif->message ?>
																</div>
																<div class="kt-notification__item-time">
																	<?php echo $notif->timestamp ?>
																</div>
															</div>

														</a>

												<?php }
												} else {
													echo "There is no new notification";
												} ?>

											</div>
										</div>

										<script>
											function readNotif(id) {

												$.ajax({
													url: DIR_CONT+DIR_CAR+'CON_functions.php?action=change_notification_status',
													type: "POST",
													success: function(data) {
														window.location.href = DIR_VIEW+DIR_ORD+'b2c-received-orders.php'
													}
												});

											}
										</script>

									</div>
								</form>
							</div>
						</div>

						<!--end: Notifications -->

						<!--end: Notifications -->

						<!--begin: User Bar -->
						<div class="kt-header__topbar-item kt-header__topbar-item--user">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
								<div class="kt-header__topbar-user">
									<span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
									<span class="kt-header__topbar-username kt-hidden-mobile">Sean</span>
									<img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

									<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
									<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">S</span>
								</div>
							</div>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

								<!--begin: Head -->
								<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(assets/media/misc/bg-1.jpg)">
									<div class="kt-user-card__avatar">
										<img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>
									</div>
									<div class="kt-user-card__name">
										Sean Stone
									</div>
									<div class="kt-user-card__badge">
										<span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
									</div>
								</div>

								<!--end: Head -->

								<!--begin: Navigation -->
								<div class="kt-notification">
									<a href="custom/apps/user/profile-1/personal-information.html" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-calendar-3 kt-font-success"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												My Profile
											</div>
											<div class="kt-notification__item-time">
												Account settings and more
											</div>
										</div>
									</a>
									<a href="custom/apps/user/profile-3.html" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-mail kt-font-warning"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												My Messages
											</div>
											<div class="kt-notification__item-time">
												Inbox and tasks
											</div>
										</div>
									</a>
									<a href="custom/apps/user/profile-2.html" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-rocket-1 kt-font-danger"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												My Activities
											</div>
											<div class="kt-notification__item-time">
												Logs and notifications
											</div>
										</div>
									</a>
									<a href="custom/apps/user/profile-3.html" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-hourglass kt-font-brand"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												My Tasks
											</div>
											<div class="kt-notification__item-time">
												latest tasks and projects
											</div>
										</div>
									</a>
									<a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">
										<div class="kt-notification__item-icon">
											<i class="flaticon2-cardiogram kt-font-warning"></i>
										</div>
										<div class="kt-notification__item-details">
											<div class="kt-notification__item-title kt-font-bold">
												Billing
											</div>
											<div class="kt-notification__item-time">
												billing & statements <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2 pending</span>
											</div>
										</div>
									</a>
									<div class="kt-notification__custom kt-space-between">
										<a href="custom/user/login-v2.html" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
										<a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>
									</div>
								</div>

								<!--end: Navigation -->
							</div>
						</div>

						<!--end: User Bar -->
					</div>

					<!-- end:: Header Topbar -->
				</div>

				<!-- end:: Header -->
				<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
