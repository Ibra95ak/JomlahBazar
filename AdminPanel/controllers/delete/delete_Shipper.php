<?php
//Get base class
require_once '../../libraries/base.php';
//Get shipper class
require_once '../../libraries/Ser_Shippers.php';
$db = new Ser_Shippers();
$err=-1;
//delete shipper
if(isset($_GET['shipperId'])){
    $del_shippers = $db->DeleteShipperById($_GET['shipperId']);
}
if($del_shippers){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_shippers.php?err=$err");
exit;
?>