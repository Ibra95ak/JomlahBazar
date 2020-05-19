<?php
//Get base class
require_once '../libraries/base.php';
//Get wallet class
require_once '../libraries/Ser_Wallettypes.php';
$db = new Ser_Wallettypes();
//results array
$results=array();
//get all leads details
$getAll_wallettypess = $db->GetwalletTypes();
if($getAll_wallettypess){
    foreach($getAll_wallettypess as $wallettype){
        array_push($results,$wallettype);
    }    
}
//fill result in json file
$fp = fopen('json/wallettypes.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>