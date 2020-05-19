<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Subscriptionplans.php';
$db = new Ser_Subscriptionplans();
$err=-1;

if(isset($_POST['subscriptionplanId'])) $subscriptionplanId=$_POST['subscriptionplanId'];
else $subscriptionplanId=0;

//get data from form
$purchaseId=$_POST['purchaseId'];
$name=$_POST['name'];

if($subscriptionplanId>0){
    //Edit subscriptionplan
    $edit_subscriptionplan=$db->editSubscriptionplan($subscriptionplanId,$name);
    if($edit_subscriptionplan) $err=0;
    else $err=1;
}else{
    //add subscriptionplan
    $add_subscriptionplan=$db->addSubscriptionplan($purchaseId,$name);
    if($add_subscriptionplan) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>