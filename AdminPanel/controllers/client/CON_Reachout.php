<?php
//Get base class
require_once '../libraries/base.php';
//Get reachouts class
require_once '../libraries/Ser_Reachouts.php';
$db = new Ser_Reachouts();
//results array
$results=array();
//get all leads details
$getAll_reachouts = $db->GetReachouts();
if($getAll_reachouts){
    foreach($getAll_reachouts as $reachouts){
        array_push($results,$reachouts);
    }   
}
//fill result in json file
$fp = fopen('json/reachouts.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>