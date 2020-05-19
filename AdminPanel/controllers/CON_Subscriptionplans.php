<?php
//Get base class
require_once '../libraries/base.php';
//Get subscriptionplan class
require_once '../libraries/Ser_Subscriptionplans.php';
$db = new Ser_Subscriptionplans();
//results array
$results=array();
//get all leads details
$getAll_subscriptionplans = $db->GetSubscriptionplans();
if($getAll_subscriptionplans){
    foreach($getAll_subscriptionplans as $subscriptionplan){
        array_push($results,$subscriptionplan);
    }
}
//fill result in json file
$fp = fopen('json/subscriptionplans.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>