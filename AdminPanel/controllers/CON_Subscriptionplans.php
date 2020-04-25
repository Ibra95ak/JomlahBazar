<?php
//Get base class
require_once '../libraries/Base.php';
//Get subscriptionplan class
require_once '../libraries/Ser_Subscriptionplans.php';
$db = new Ser_Subscriptionplans();
//results array
$results=array();
//get all leads details
$getAll_subscriptionplans = $db->GetSubscriptionplans();
foreach($getAll_subscriptionplans as $subscriptionplan){
    array_push($results,$subscriptionplan);
}

$fp = fopen('json/subscriptionplans.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>