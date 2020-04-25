<?php
//Get base class
require_once '../libraries/Base.php';
//Get creditcarddetail class
require_once '../libraries/Ser_Creditcarddetails.php';
$db = new Ser_Creditcarddetails();
//results array
$results=array();
//get all leads details
$getAll_creditcarddetails = $db->GetCreditcarddetails();
foreach($getAll_creditcarddetails as $creditcarddetail){
    array_push($results,$creditcarddetail);
}

$fp = fopen('json/creditcarddetails.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>