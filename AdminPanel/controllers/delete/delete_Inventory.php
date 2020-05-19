<?php
//Get base class
require_once '../../libraries/base.php';
//Get inventory class
require_once '../../libraries/Ser_Inventories.php';
$db = new Ser_Inventories();
$err=-1;
//delete inventory
if(isset($_GET['inventoryId'])){
    $del_inventories = $db->DeleteInventoryById($_GET['inventoryId']);
}
if($del_inventories){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_inventories.php?err=$err");
exit;
?>