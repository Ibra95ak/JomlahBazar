<?php
//Get base class
require_once '../libraries/base.php';
//Get discounttype class
require_once '../libraries/Ser_Discounttypes.php';
$db = new Ser_Discounttypes();
//results array
$results=array();
//get all leads details
$getAll_discounttypes = $db->GetDiscounttypes();
if($getAll_discounttypes){
    foreach($getAll_discounttypes as $discounttype){
        array_push($results,$discounttype);
    }   
}
//fill result in json file
$fp = fopen('json/discounttypes.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>