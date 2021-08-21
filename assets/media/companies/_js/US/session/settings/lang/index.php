<?php

	session_start();

	$ccode = $_SESSION['countrycode1'];

	if($ccode == "FR" || $ccode == "MA" || $ccode == "DZ" || $ccode == "BE" || $ccode == "LU" || $ccode == "MC" || $ccode == "CH" || $ccode == "CM" || $ccode == "TN" || $ccode == "CA" || $ccode == "GP" || $ccode == "MQ"){

		$SESSION["LANG"] = include("../settings/lang/fr.php");

	} else{
		$SESSION["LANG"] = include("../settings/lang/en.php");
	}