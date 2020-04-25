<?php
//Get base class
require_once '../libraries/Base.php';
//Get priviledge class
require_once '../libraries/Ser_Priviledges.php';
$db = new Ser_Priviledges();
//results array
$results=array();
//get all leads details
$getAll_priviledges = $db->GetPriviledges();
foreach($getAll_priviledges as $priviledge){
    array_push($results,$priviledge);
}

$fp = fopen('json/priviledges.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>