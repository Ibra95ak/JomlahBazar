<?php
//Get base class
require_once '../libraries/Base.php';
//Get buyer class
require_once '../libraries/Ser_Buyers.php';
$db = new Ser_Buyers();
//results array
$results=array();
//get all leads details
$getAll_buyers = $db->GetBuyers();
foreach($getAll_buyers as $buyer){
    array_push($results,$buyer);
}

$fp = fopen('json/buyers.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>