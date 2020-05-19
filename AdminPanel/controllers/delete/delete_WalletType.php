<?php
//Get base class
require_once '../../libraries/base.php';
//Get wallet class
require_once '../../libraries/Ser_Wallettypes.php';
$db = new Ser_Wallettypes();
$err=-1;
//delete wallet
if(isset($_GET['wallettypeId'])){
    $del_wallettype = $db->DeleteWalletTypeById($_GET['wallettypeId']);
}
if($del_wallettype){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_wallettype.php?err=$err");
exit;
?>