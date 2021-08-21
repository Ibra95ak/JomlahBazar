<?php
/*initiate session*/
session_start();
/*fetch Directory variables*/
require_once '../../model/Base.php';
/*call composer functions*/
require_once '../../vendor/autoload.php';
/*logout the user by destroying the session*/
if(isset($_GET['logout']) && $_GET['logout']=='true') unset($_SESSION['userId']);
use Anam\Phpcart\Cart;
$cart = new Cart();
if (isset($_SESSION['userId'])) header("Location:".DIR_ROOT);
$client = new GuzzleHttp\Client();
/*fetch all Main Categories*/
$res_mcat = $client->request('GET', DIR_CONT.DIR_CAT.'CON_categories.php?action=get-mcat');
$maincategories=json_decode($res_mcat->getBody());
?>
<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="../../">
		<meta charset="utf-8"/>
		<title>JomlahBazar</title>
		<meta name="description" content="JomlahBazar B2B/B2C portal">
		<meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="301552150059-pu3l9ca3mon5qhjreksj12nflqtd41ie.apps.googleusercontent.com">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
		<!--end::Fonts -->
		<!--begin::Page Custom Styles(used by this page) -->
		<link href="assets/css/pages/login/login-4.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles -->
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
    <link rel="stylesheet" href="assets/plugins/intl-tel-input/build/css/intlTelInput.css">
		<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0VYKEQKQ5Q"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0VYKEQKQ5Q');
</script>
<!-- Event snippet for Page view conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-451853618/tbQqCP2a2_gBELL6utcB'});
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5X8ZXZG');</script>
<!-- End Google Tag Manager -->
	</head>
	<script>
	function init() {
	gapi.load('auth2', function() {
	  auth2 = gapi.auth2.init({
	    client_id: '301552150059-pu3l9ca3mon5qhjreksj12nflqtd41ie.apps.googleusercontent.com',
	    scope: 'profile email'
	  });
	  auth2.attachClickHandler(element, {},
	    function(googleUser) {
	      var id_token = googleUser.getAuthResponse().id_token;
	      $.ajax({url: DIR_CONT+"CON_user_access.php?action=g-signin&idtoken="+id_token, success: function(result){
	        location.href=DIR_ROOT;
	      }});
	      }, function(error) {
	        console.log('Sign-in error', error);
	      }
	    );
	});
	element = document.getElementById('googleSignIn');
	}
  </script>
	<!-- end::Head -->
	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading particles-wrapper">
	<script src="https://my.rtmark.net/p.js?f=sync&lr=1&partner=c3937e83ad8bf141f79c079e2b38213e28454a1762c1666f04dacf075b489681" defer></script> <noscript><img src="https://my.rtmark.net/img.gif?f=sync&lr=1&partner=c3937e83ad8bf141f79c079e2b38213e28454a1762c1666f04dacf075b489681" width="1" height="1" /></noscript>
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5X8ZXZG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <!-- <script>

  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '216971036137973',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v1.0'           // Use this Graph API version for this call.
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };

  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

</script> -->


<!-- The JS SDK Login Button -->

<!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div> -->

<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
	<div class="kt-header-mobile__logo">
		<a href="javascript:void(0)" class="kt-menu__link hamburger_menu kt-mr-5" data-toggle="modal" data-target="#kt_modal_hamburger"><i class="fa fa-bars" style="font-size: 20px;"></i></a>
		<a href="<?php echo DIR_ROOT;?>">
			<img alt="Logo" src="assets/media/logos/jb-logo-sm-black.png" style="width: 150px;" />
		</a>
	</div>
	<div class="kt-header-mobile__toolbar">
		<span class="kt-font-dark kt-font-md">Hello, Sign in</span>
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

<div class="kt-grid kt-grid--hor kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
		<?php //include('asidemenu.php')
		?>
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
							<div class="typeahead">
								<input type="text" class="form-control height-40 header-search-width rounded-0" aria-label="Text input with dropdown button" id="header_search_text" placeholder="">
							</div>
							<div class="input-group-append">
								<button class="btn btn-light height-40" id="reset_search"><i class="la la-times kt-font-light"></i></button>
								<button class="btn btn-warning height-40 rounded-right" type="button" id="header_search" ><i class="la la-search"></i></button>
							</div>
						</div>
						<ul class="kt-menu__nav kt-pl100">
							<li class="kt-menu__item  kt-menu__item--submenu header-slot kt-transparent" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><i class="flaticon-placeholder-2 kt-font-dark kt-font-lg"></i><a href="javascript:;" class="kt-menu__link kt-menu__toggle kt-transparent"><img src="assets/media/icons/uae.webp" alt="" style="width: 35px;height:35px;"><i class="fa fa-caret-down dropdown-flag kt-font-dark"></i></a>
								<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
									<ul class="kt-menu__subnav">
										<li class="kt-menu__item " aria-haspopup="true"><a href="javascript:void(0)" class="kt-menu__link "><span class="kt-menu__link-text">You are now shopping on Jomlahbazar.com (UAE Marketplace)</span></a></li>
									</ul>
								</div>
							</li>
							<li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--active kt-menu__item--open-dropdown header-slot" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle kt-transparent"><span class="kt-menu__link-text kt-topheader-toptext">Hello, Sign in</span><span class="kt-menu__link-text kt-topheader-bottomtext">Account & Lists <i class="fa fa-caret-down"></i></span></a>
								<div class="kt-menu__submenu  kt-menu__submenu--fixed kt-menu__submenu--center" style="width:380px">
									<div class="kt-menu__subnav">
										<ul class="kt-menu__content">
											<li class="kt-menu__item "><h3 class="kt-menu__heading kt-menu__toggle kt-pt5"><div class="kt-login__account">
												<p><a href="javascript:void(0);" class="btn btn-warning btn-width-full" onclick="login(0,0,0,0)">Sign In</a></p>
												<span class="kt-login__account-msg kt-font-sm ">
													Become a Seller.
												</span>&nbsp;&nbsp;
												<a href="javascript:void(0);" class="kt-link kt-link--light kt-login__account-link kt-font-sm kt-font-brand" onclick="login(0,0,0,0)">Start here</a>
											</div></h3></li>
											<img src="<?php echo DIR_ROOT.DIR_ICON.'buyer.webp'?>" style="width:100px;" class="kt-mr-50"/>
										</ul>
										<ul class="kt-menu__content">
											<li class="kt-menu__item ">
												<h3 class="kt-menu__heading kt-menu__toggle"><span class="kt-menu__link-text kt-font-bolder /*kt-font-light*/">My Account</span></h3>
												<ul class="kt-menu__inner">
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Personal Account</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Wallet</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Orders</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Qoutations</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "form_useraddress.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Addresses</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Lists</span></a></li>
												</ul>
											</li>
											<li class="kt-menu__item kt-hidden">
												<img src="<?php echo DIR_ROOT.DIR_ICON.'supplier.png'?>" style="width:100px;" class="kt-hidden"/>
												<h3 class="kt-menu__heading kt-menu__toggle"><span class="kt-menu__link-text kt-font-bolder /*kt-font-light*/">My Business Account</span><i class="kt-menu__ver-arrow la la-angle-right"></i></h3>
												<ul class="kt-menu__inner">
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">My Store</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Company Account</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Accounting</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Orders</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Qoutations</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Inventory</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text">Dashboard</span></a></li>
													<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-menu__link "></i><span class="kt-menu__link-text kt-font-warning">Access to Business World</span></a></li>
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
								<h5 class="modal-title kt-font-light" id="exampleModalLabel"> Hello, Sign in</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								</button>
							</div>
							<div class="modal-body full-height">
								<?php
								foreach ($maincategories->maincategories as $mcategory) {
									echo '<p><a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?mcat=' . $mcategory->maincategoryId . '" class="kt-link kt-font-transform-u kt-font-dark kt-font-bolder">' . $mcategory->name . '</a><i class="fa fa-angle-down mcat-angle-down kt-font-dark" onclick="showcat(' . $mcategory->maincategoryId . ')"></i></p>';
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
								<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php";?>" class="kt-link kt-font-transform-u kt-font-dark">Your Account</a></p>
								<p><a href="<?php echo DIR_VIEW . DIR_CON . "supportcenter.php" ?>" class="kt-link kt-font-transform-u kt-font-dark">Help</a></p>
								<p><a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="kt-link kt-font-transform-u kt-font-dark">Sign In</a></p>
							</div>
						</div>
					</div>
				</div>
				<!-- end:: Hamburger menu -->
		<!-- begin:: Page -->
		<div id="background" class="kt-grid kt-grid--ver kt-grid--root kt-page" style='background-image: url("<?php echo DIR_ROOT.DIR_MED;?>bg/sign-in-page-city.jpeg");'>
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--phone" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper" style="z-index: 1;">
						<!-- <span><a href="<?php echo DIR_ROOT;?>"><img src="assets/media/logos/jb-logo-sm-black.png" style="width: 250px;"></a></span> -->
						<div class="kt-login__container kt-login-mac">
							<div class="kt-login__phone">
								<div class="kt-login__head text-center">
									<div class="row">
										<div class="col-md-11 text-center">
											<h2 class="kt-font-dark kt-pl5">Sign-In</h2>
										</div>
										<div class="col-md-1 text-right">
											<a href="<?php echo DIR_ROOT;?>"><i class="la la-times kt-font-dark kt-font-md"></i></a>
										</div>
									</div>
								</div>
								<form class="kt-form" action="">
									<div class="form-group">
										<input type="hidden" name="cc" id="cc" value="971">
										<input type="hidden" name="iso2" id="iso2" value="ae">
										<input class="form-control" type="text" placeholder="Phone Number" name="login_phone" id="login_phone">
										<span class="form-text kt-font-dark kt-font-md"># Enter your Registered Mobile</span>
                    <script src="assets/plugins/intl-tel-input/build/js/intlTelInput.js"></script>
                    <script>
                      var input = document.querySelector("#login_phone");
                      var iti1 = window.intlTelInput(input, {
                        initialCountry: "ae",
                        placeholderNumberType: "MOBILE",
												separateDialCode: true
                      });
											var iso2 = document.getElementById('iso2').value;
											if(iso2!=''){
												iti1.setCountry(iso2);
											}
											input.addEventListener("countrychange", function() {
												var countryData = iti1.getSelectedCountryData();
												$('#cc').val(countryData.dialCode);
												$('#iso2').val(countryData.iso2);
											});
                    </script>
									</div>
									<div class="form-group row safari-row-flex">
										<div class="col-md-12 kt-pl0">
											<button id="kt_login_phone_signin_submit" type="submit" class="btn btn-warning btn-elevate btn-pill btn-wide btn-font-md" style="width: 100%;border: 1px solid #8f8c86;margin-top: 13px !important;">Continue</button>
										</div>
									</div>
							  </form>
							</div>
              <div class="kt-login__otp">
								<div class="kt-login__head">
									<h3 class="kt-login__title kt-font-dark">Jomlah Bazar Two-Step Verification</h3>
                  <span class="form-text text-muted" style="margin: 0 55px;"># For added security, please enter the one-time password (OTP) that has been sent to the phone </span>
								</div>
								<form class="kt-form" action="">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Enter OTP:" name="login_token" id="login_token">
										<input class="form-control" type="hidden" placeholder="Code" name="otp" id="otp">
									</div>
									<div class="kt-login__actions">
                    <button id="kt_login_otp_signin_submit" type="submit" class="btn btn-warning btn-elevate btn-pill btn-font-md" style="width:100%">Continue</button><br>
                    <a href="javascript:;" data-toggle="modal" data-target="#kt_modal_1"  class="kt-login__account-link">Didn't receive the OTP?</a>
									</div>
							  </form>
							</div>
              <div class="kt-login__signup">
								<div class="kt-login__head text-center">
											<h2 class="kt-font-dark kt-pl5">Create Account</h2>
								</div>
								<form class="kt-form" action="">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Full Name" name="fullname" id="fullname" autocomplete="off">
									</div>
									<div class="input-group">
										<input class="form-control" type="te" placeholder="Email" name="email" id="email" autocomplete="off">
									</div>
									<div class="input-group" style="margin-top: 1rem;">
										<input type="hidden" name="ccsu" id="ccsu" value="971">
										<input type="hidden" name="iso2su" id="iso2su" value="ae">
  										<input class="form-control" type="tel" placeholder="Phone Number" name="login_phone_signup" id="login_phone_signup">
											<input class="form-control" type="hidden" placeholder="Code" name="otp_signup" id="otp_signup">
                      <span class="form-text kt-font-dark kt-font-md"># Enter your Registered Mobile</span>
                      <script src="assets/plugins/intl-tel-input/build/js/intlTelInput.js"></script>
											<script>
											var input1 = document.querySelector("#login_phone_signup");
											var iti = window.intlTelInput(input1, {
												initialCountry: "ae",
												placeholderNumberType: "MOBILE",
											});
												var iso2 = document.getElementById('iso2su').value;
												if(iso2!=''){
													iti.setCountry(iso2);
												}
												input1.addEventListener("countrychange", function() {
													var countryData = iti.getSelectedCountryData();
													$('#ccsu').val(countryData.dialCode);
													$('#iso2su').val(countryData.iso2);
												});
	                    </script>
									</div>
									<select class="form-control select-white kt-font-gray" name="usertypesu" id="usertypesu">
											<option value="" disabled selected>Register As</option>
											<option value="1">Buyer</option>
											<option value="2">Seller</option>
									</select>

									<div class="row kt-login__extra">
										<div class="col kt-align-left kt-font-dark">
											<label class="kt-checkbox">
												<input type="checkbox" name="agree" id="agree">I Agree the <a href="<?php echo DIR_VIEW . DIR_CON . "Conditions_of_use.php" ?>" class="kt-link kt-login__link kt-font-bold">terms and conditions</a>.
												<span></span>
											</label>
											<span class="form-text text-muted"></span>
										</div>
									</div>
									<div class="kt-login__desc text-muted">
										We will send you a text to verify your phone.<br>
										Message and Data rates may apply.
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_signup_submit" class="btn btn-warning btn-elevate btn-pill btn-font-md" style="width:100%">Continue</button>
									</div>
									<hr>
									<span class="kt-login__account-msg kt-font-dark">
										Already have an account?
									</span>
									<a href="<?php echo DIR_VIEW.DIR_USR;?>login.php"  class="kt-link kt-login__link kt-font-bold">Sign In</a>
								</form>
							</div>
							<div class="kt-login__signupotp">
								<div class="kt-login__head">
									<h3 class="kt-login__title kt-font-dark">Jomlah Bazar Two-Step Verification1</h3>
                  <span class="form-text text-muted" style="margin: 0 55px;"># For added security, please enter the one-time password (OTP) that has been sent to the phone </span>
								</div>
								<form class="kt-form" action="">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Enter OTP:" name="signup_token" id="signup_token">
										<input class="form-control" type="hidden" name="signup_fullname" id="signup_fullname">
										<input class="form-control" type="hidden" name="signup_email" id="signup_email">
										<input class="form-control" type="hidden" name="signup_usertypesu" id="signup_usertypesu">
										<input class="form-control" type="hidden" name="otp_versignup" id="otp_versignup">
									</div>
									<div class="kt-login__actions">
                    <button id="kt_register_phone_submit" type="submit"  class="btn btn-warning btn-elevate btn-pill btn-font-md" style="width:100%">Continue</button><br>
                    <a href="javascript:;" data-toggle="modal" data-target="#kt_modal_1" class="kt-login__account-link">Didn't receive the OTP?</a>
									</div>
							  </form>
							</div>
              <div class="kt-login__account">
                <span class="form-text kt-font-dark kt-font-md text-left">By signing in, you agree to Jomlah Bazar's <a href="<?php echo DIR_VIEW . DIR_CON . "Conditions_of_use.php" ?>" class="kt-link kt-login__link kt-font-bold">Conditions of Use</a> and <a href="<?php echo DIR_VIEW . DIR_CON . "Privacy_Notice.php" ?>" class="kt-link kt-login__link kt-font-bold">Privacy Notice.</a> </span><br>
                <!-- <button id="googleSignIn" type="button" class="btn btn-outline-dark btn-elevate btn-circle btn-icon"><i class="fab fa-google"></i></button>
                <script src="https://apis.google.com/js/platform.js?onload=init" async defer></script>
                <button id="googleSignIn" type="button" class="btn btn-outline-dark btn-elevate btn-circle btn-icon"><i class="fab fa-facebook-f"></i></button>
                <button id="linkedinSignin" type="button" class="btn btn-outline-dark btn-elevate btn-circle btn-icon"><i class="fab fa-linkedin-in"></i></button> -->
								<div class="kt-divider kt-font-dark kt-pt-10">
									<span></span>
									<span>New to JomlahBazar?</span>
									<span></span>
								</div>
              </div>
              <div class="kt-login__actions kt-pt15">
                <button id="kt_login_signup" type="button" class="btn btn-light btn-elevate btn-pill btn-font-md" style="width:100%;">Create your account</button>
              </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="kt_modal_welcome" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
					</div>
					<div class="modal-body">
						<h2 class="kt-font-dark kt-font-center kt-font-bolder kt-font-lg">Welcome to <img alt="Logo" src="assets/media/logos/supplychain-jomlahbazar-emarket-wholesale-expo2020-logo-desktop-black.jpg"/></h2>

					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!--begin::Modal-->
							<div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Resend OTP</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<p id="resend_note" class="kt-font-dark kt-font-md"></p>
											<button type="button" class="btn btn-warning"  id="kt_login_phone_resend_submit">Resend OTP to phone.</button>
											<button type="button" class="btn btn-primary" id="kt_login_email_resend_submit" data-type="0">Resend OTP to email.</button>
										</div>
									</div>
								</div>
							</div>

							<!--end::Modal-->
		<!-- end:: Page -->
		<?php
		if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
		else include(DIR_VIEW . DIR_CON . "guest-footer.php");
		?>
		<!--begin::Page Scripts(used by this page) -->
		<script src="assets/js/pages/custom/login/login-general.js" type="text/javascript"></script>
		<!-- <script type="text/javascript">
			 var images = ['login-bg.jpeg', 'login-bg2.png', 'login-bg.jpeg', 'login-bg2.png'];
			 $('#background').css({'background-image': 'url('+DIR_ROOT+DIR_MED+'bg/' + images[Math.floor(Math.random() * images.length)] + ')'});
		</script> -->
