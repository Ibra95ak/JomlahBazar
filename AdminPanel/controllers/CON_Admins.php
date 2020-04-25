<?php
//Get base class
require_once '../libraries/Base.php';
//Get admin class
require_once '../libraries/Ser_Admin.php';
$db = new Ser_Admin();
//results array
$results=array();
//get all leads details
$getAll_admins = $db->GetAdmins();
foreach($getAll_admins as $admin){
    array_push($results,$admin);
}

$fp = fopen('json/admins.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>