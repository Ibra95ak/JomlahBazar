<?php
//Get base class
require_once '../../libraries/Base.php';
//Get address class
require_once '../../libraries/Ser_Addresses.php';
$db = new Ser_Addresses();
$err=-1;
//delete address
if(isset($_GET['addressId'])){
    $del_addresses = $db->DeleteAddressById($_GET['addressId']);
}
if($del_addresses){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_addresses.php?err=$err");
exit;
?>