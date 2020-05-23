<?php
/*Get AAA class*/
require_once '../libraries/Ser_AAA.php';
/*Create AAA instance*/
$db = new Ser_AAA();
/*Get aaa url parameters*/
$aaaId=$_GET['aaaId'];
$activation_code=$_GET['activation_code'];
$activation_salt=$_GET['activation_salt'];
/*Error flag*/
    $err=-1;
/*Fetch aaa info by Id from database*/
$aaa_info = $db->getBYId_aaa($aaaId);
/*Check if data is matching*/
if($activation_code == $aaa_info['activation_code'] && $activation_salt == $aaa_info['activation_salt']){
 /*Activate aaa*/
$aaa_activate = $db->activateAAA($aaaId);  
    $err=0;
}else{
   $err=1; 
}
echo json_encode($err);
?>