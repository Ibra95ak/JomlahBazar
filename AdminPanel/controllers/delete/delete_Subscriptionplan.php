<?php
//Get base class
require_once '../../libraries/Base.php';
//Get subscription class
require_once '../../libraries/Ser_Subscriptionplans.php';
$db = new Ser_Subscriptionplans();
$err=-1;
//delete subscriptionplan
if(isset($_GET['subscriptionplanId'])){
    $del_subscriptionplans = $db->DeleteSubscriptionplanById($_GET['subscriptionplanId']);
}
if($del_subscriptionplans){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_subscriptionplans.php?err=$err");
exit;
?>