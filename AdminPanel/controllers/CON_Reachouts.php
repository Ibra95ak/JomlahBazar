<?php
//Get base class
require_once '../libraries/Base.php';
//Get reachouts class
require_once '../libraries/Ser_Reachouts.php';
$db = new Ser_Reachouts();
//results array
$results=array();
//get all leads details
$getAll_reachouts = $db->GetReachouts();
foreach($getAll_reachouts as $reachouts){
    array_push($results,$reachouts);
}

$fp = fopen('json/reachouts.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>