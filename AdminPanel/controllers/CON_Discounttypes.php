<?php
//Get base class
require_once '../libraries/Base.php';
//Get discounttype class
require_once '../libraries/Ser_Discounttypes.php';
$db = new Ser_Discounttypes();
//results array
$results=array();
//get all leads details
$getAll_discounttypes = $db->GetDiscounttypes();
foreach($getAll_discounttypes as $discounttype){
    array_push($results,$discounttype);
}

$fp = fopen('json/discounttypes.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>