<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Suppliers.php';
$db = new Ser_Suppliers();
$err=-1;

if(isset($_POST['supplierId'])) $supplierId=$_POST['supplierId'];
else $supplierId=0;

//get data from form
$userId=$_POST['userId'];
$discount_type=$_POST['discount_type'];
$categoryId=$_POST['categoryId'];
$subplanId=$_POST['subplanId'];
$storeId=$_POST['storeId'];
$registered_supId=$_POST['registered_supId'];
$active=$_POST['active'];

if($supplierId>0){
    //Edit supplier
    $edit_supplier=$db->editSupplier($supplierId,$discounttype);
    if($edit_supplier) $err=0;
    else $err=1;
}else{
    //add supplier
    $add_supplier=$db->addSupplier($userId,$discount_type,$categoryId,$subplanId,$storeId,$registered_supId,$blockId);
    if($add_supplier) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>