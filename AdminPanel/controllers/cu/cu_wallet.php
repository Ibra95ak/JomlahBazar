<?php
//Get base class
require_once '../../libraries/Base.php';
//Get Wallet class
require_once '../../libraries/Ser_Wallets.php';
$db = new Ser_Wallets();
$err=-1;

if(isset($_POST['walletId'])) $walletId=$_POST['walletId'];
else $walletId=0;

//get data from form
$type=$_POST['type'];
$typeId=$_POST['typeId'];
$active=$_POST['active'];

if($walletId>0){
    //Edit wallet
    $edit_wallet=$db->editWallet($walletId,$type,$typeId,$active);
    if($edit_wallet) $err=0;
    else $err=1;
}else{
    //add wallet
    $add_wallet=$db->addWallet($type,$typeId,$active);
    if($add_wallet) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>