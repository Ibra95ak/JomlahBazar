<?php
//Get base class
require_once '../../libraries/Base.php';
//Get paypal class
require_once '../../libraries/Ser_Paypals.php';
$db = new Ser_Paypals();
$err=-1;
//delete paypal
if(isset($_GET['paypalId'])){
    $del_paypals = $db->DeletePaypalById($_GET['paypalId']);
}
if($del_paypals){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_paypals.php?err=$err");
exit;
?>