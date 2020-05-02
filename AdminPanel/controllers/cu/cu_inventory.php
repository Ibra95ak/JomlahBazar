<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Inventories.php';
$db = new Ser_Inventories();
$err=-1;

if(isset($_POST['inventoryId'])) $inventoryId=$_POST['inventoryId'];
else $inventoryId=0;

//get data from form
$userId=$_POST['userId'];
$productId=$_POST['productId'];
$supplierId=$_POST['supplierId'];
$inventorynumber=$_POST['inventorynumber'];
$order_date=$_POST['order_date'];
$statusId=$_POST['statusId'];
$blockId=$_POST['blockId'];
$active=$_POST['active'];

if($inventoryId>0){
    //Edit inventory
    $edit_inventory=$db->editInventory($inventoryId,$inventorynumber,$order_date,$active);
    if($edit_inventory) $err=0;
    else $err=1;
}else{
    //add inventory
    $add_inventory=$db->addInventory($userId,$productId,$supplierId,$inventorynumber,$order_date,$statusId,$blockId,$active);
    if($add_inventory) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>