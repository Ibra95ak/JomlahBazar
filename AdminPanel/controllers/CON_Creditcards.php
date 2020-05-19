<?php
//Get base class
require_once '../libraries/base.php';
//Get creditcard class
require_once '../libraries/Ser_Creditcards.php';
$db = new Ser_Creditcards();
//results array
$results=array();
//get all leads details
$getAll_creditcards = $db->GetCreditcards();
if($getAll_creditcards){
    foreach($getAll_creditcards as $creditcard){
        array_push($results,$creditcard);
    }  
}
//fill result in json file
$fp = fopen('json/creditcards.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>