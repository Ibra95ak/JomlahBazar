<?php
//Get base class
require_once '../libraries/base.php';
//Get priviledge class
require_once '../libraries/Ser_Priviledges.php';
$db = new Ser_Priviledges();
//results array
$results=array();
//get all leads details
$adminpriviledgeId=$_GET['adminpriviledgeId'];
if($adminpriviledgeId>0){
    //get all priviledges for admin
    $getAll_priviledges = $db->GetAdminPrivledgespriv($adminpriviledgeId);
}else {
    //get all priviledges 
    $getAll_priviledges = $db->Getpriviledges();
}
if($getAll_priviledges){
    foreach($getAll_priviledges as $priviledge){
        array_push($results,$priviledge);
    }    
}

//fill result injson file
$fp = fopen('json/priviledges.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>