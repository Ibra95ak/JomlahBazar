<?php
//Get base class
require_once '../libraries/Base.php';
//Get adminpriviledge class
require_once '../libraries/Ser_Adminpriviledges.php';
$db = new Ser_Adminpriviledges();
//results array
$results=array();
//get all leads details
$getAll_adminpriviledges = $db->GetAdminpriviledges();
foreach($getAll_adminpriviledges as $adminpriviledge){
    array_push($results,$adminpriviledge);
}

$fp = fopen('json/adminpriviledges.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>