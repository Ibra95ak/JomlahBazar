<?php
//Get base class
require_once '../libraries/base.php';
//Get admin class
require_once '../libraries/Ser_Admin.php';
$db = new Ser_Admin();

//results array
$results=array();
//get all leads details
$getAll_admins = $db->GetAdmins();
if($getAll_admins){
    foreach($getAll_admins as $admin){
        array_push($results,$admin);
    }   
}
//fill result in json file
$fp = fopen('json/admins.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>