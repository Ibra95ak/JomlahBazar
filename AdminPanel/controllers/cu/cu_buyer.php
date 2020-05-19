<?php
//Get base class
require_once '../../libraries/base.php';
//Get userId class
require_once '../../libraries/Ser_Buyers.php';
$db = new Ser_Buyers();
$err=-1;

if(isset($_POST['userId'])) $userId=$_POST['userId'];
else $userId=0;

//get data from form
$aaaId=$_POST['aaaId'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$addressId=$_POST['addressId'];
$reachoutId=$_POST['reachoutId'];
$walletId=$_POST['walletId'];
$identityId=$_POST['identityId'];
$blockId=$_POST['blockId'];

if($userId>0){
    //Edit userId
    $edit_userId=$db->editBuyer($userId,$aaaId,$first_name,$last_name,$addressId,$reachoutId,$walletId,$identityId,$blockId);
    if($edit_userId) $err=0;
    else $err=1;
}else{
    //add userId
    $add_userId=$db->addBuyer($aaaId,$first_name,$last_name,$addressId,$reachoutId,$walletId,$identityId,$blockId);
    if($add_userId) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>