<?php
//Get base class
require_once '../libraries/Base.php';
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
foreach($getAll_adminpriviledge as $admin){
    array_push($results,$admin);
}

$fp = fopen('json/adminpriviledges.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>