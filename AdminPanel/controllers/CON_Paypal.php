<?php
//Get base class
require_once '../libraries/Base.php';
//Get paypal class
require_once '../libraries/Ser_Paypals.php';
$db = new Ser_Paypals();
//results array
$results=array();
//get all leads details
$getAll_paypals = $db->GetPaypals();
foreach($getAll_paypals as $paypal){
    array_push($results,$paypal);
}

$fp = fopen('json/paypals.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>