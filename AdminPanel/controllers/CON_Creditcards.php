<?php
//Get base class
require_once '../libraries/Base.php';
//Get creditcard class
require_once '../libraries/Ser_Creditcards.php';
$db = new Ser_Creditcards();
//results array
$results=array();
//get all leads details
$getAll_creditcards = $db->GetCreditcards();
foreach($getAll_creditcards as $creditcard){
    array_push($results,$creditcard);
}

$fp = fopen('json/creditcards.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>