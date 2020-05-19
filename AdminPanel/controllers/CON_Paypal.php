<?php
//Get base class
require_once '../libraries/base.php';
//Get paypal class
require_once '../libraries/Ser_Paypals.php';
$db = new Ser_Paypals();
//results array
$results=array();
//get all leads details
$getAll_paypals = $db->GetPaypals();
if($getAll_paypals){
    foreach($getAll_paypals as $paypal){
        array_push($results,$paypal);
    }
}
//fill result in json file
$fp = fopen('json/paypals.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>