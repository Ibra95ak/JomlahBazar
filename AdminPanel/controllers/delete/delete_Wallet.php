<?php
//Get base class
require_once '../../libraries/base.php';
//Get wallet class
require_once '../../libraries/Ser_Wallets.php';
$db = new Ser_Wallets();
$err=-1;
//delete wallet
if(isset($_GET['walletId'])){
    $del_wallets = $db->DeleteWalletById($_GET['walletId']);
}
if($del_wallets){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_wallets.php?err=$err");
exit;
?>