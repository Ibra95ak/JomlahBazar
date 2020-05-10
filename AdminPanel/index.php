<?php 
session_start();
//logout admin
if(isset($_GET['logout'])){
   //Get admin class
    require_once 'libraries/Ser_Admin.php';
    $db = new Ser_Admin();
    $logout= $db->logoutAdmin($_SESSION['adminId']);  
}
//call base paths
include('libraries/base.php');
?>
<!DOCTYPE html>
<html lang="en">
	<!-- begin::Head -->
	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>Jomlah Bazar | Admin Panel</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
		<!--end::Fonts -->
		<!--begin::Page Custom Styles(used by this page) -->
		<link href="assets/css/pages/login/login-2.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles -->
		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles -->
		<!--begin::Layout Skins(used by all pages) -->
		<link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>
	<!-- end::Head -->
	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(assets/media/bg/bg-1.jpg);">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
						<div class="kt-login__container">
							<div class="kt-login__logo">
								<a href="#">
									<img src="assets/media/logos/logo-mini-2-md.png">
								</a>
							</div>
							<div class="kt-login__signin">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Admin Sign In</h3>
								</div>
								<form class="kt-form" action="<?php echo DIR_ROOT.DIR_ADMINP.DIR_CON."CON_Login.php";?>" method="post">
                                    <div class="input-group">
										<input class="form-control" type="text" placeholder="Username" name="username" id="username">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" name="password" id="password">
									</div>
									<div class="kt-login__actions">
										<button id="kt_login_signin_submit" class="btn btn-pill kt-login__btn-primary">Sign In</button>
									</div>
								</form>
							</div>
							<div class="kt-login__signup">
								<div class="kt-login__head">
									<h3 class="kt-login__title">Sign Up</h3>
									<div class="kt-login__desc">Enter your details to create your account:</div>
								</div>
								<form class="kt-login__form kt-form" action="<?php echo DIR_ROOT.DIR_ADMINP.DIR_CON."CON_Register.php";?>" method="post">
									<div class="input-group">
										<input class="form-control" type="text" placeholder="Username" name="username" id="username">
									</div>
									<div class="input-group">
										<input class="form-control" type="password" placeholder="Password" name="password" id="password">
                                    </div>
									<div class="kt-login__actions">
										<button id="kt_login_signup_submit" class="btn btn-pill kt-login__btn-primary">Sign Up</button>&nbsp;&nbsp;
										<button id="kt_login_signup_cancel" class="btn btn-pill kt-login__btn-secondary">Cancel</button>
									</div>
								</form>
							</div>
							<div class="kt-login__account" id="kt-login__account">
								<span class="kt-login__account-msg">
									Don't have an account yet ?
								</span>&nbsp;&nbsp;
								<a href="javascript:;" id="kt_login_signup" class="kt-link kt-link--light kt-login__account-link">Sign Up</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="assets/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts(used by this page) -->
		<script src="assets/js/pages/custom/login/login-general.js" type="text/javascript"></script>

		<!--end::Page Scripts -->
        
		<!--begin::Custom Scripts -->
        <script type="text/javascript">
            $(document).ready(function(){
                var url_string = window.location.href
                var url = new URL(url_string);
                var reg = url.searchParams.get("reg");
                 var div_signup = document.getElementById("kt-login__account");
                 if (reg) div_signup.style.display = "inline";
                 //else div_signup.style.display = "none";
            });
        </script>
		<!--end::Custom Scripts -->
        
	</body>

	<!-- end::Body -->
</html>