<?php
//Get base class
require_once '../../libraries/base.php';
//Get Wallet class
require_once '../../libraries/Ser_Wallettypes.php';
$db = new Ser_Wallettypes();
$err=-1;

if(isset($_POST['wallettypeId'])) $wallettypeId=$_POST['wallettypeId'];
else $wallettypeId=0;

//get data from form
$wallettype=$_POST['wallettype'];
if(isset($_POST['active'])) $active=1;
else $active=2;

if($wallettypeId>0){
    //Edit wallet
    $edit_wallettype=$db->editWalletType($wallettypeId,$wallettype,$active);
    if($edit_wallettype) $err=0;
    else $err=1;
}else{
    //add wallet
    $add_wallettype=$db->addWalletType($wallettype,$active);
    if($add_wallettype) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>