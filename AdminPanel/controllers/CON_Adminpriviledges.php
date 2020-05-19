<?php
//Get base class
require_once '../libraries/base.php';
//Get adminpriviledge class
require_once '../libraries/Ser_Adminpriviledges.php';
$db = new Ser_Adminpriviledges();
//results array
$results=array();
//get all leads details
$adminId=$_GET['adminId'];
if($adminId>0){
    //get all adminpriviledge for admin
    $getAll_adminpriviledge = $db->GetAdminPriv($adminId);
}else {
    //get all adminpriviledge 
    $getAll_adminpriviledge = $db->Getadminpriviledges();
}
if($getAll_adminpriviledge){
    foreach($getAll_adminpriviledge as $admin){
        array_push($results,$admin);
    }
}
//fill result in json file
$fp = fopen('json/adminpriviledges.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>