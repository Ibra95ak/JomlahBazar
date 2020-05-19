<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Suppliers.php';
$db = new Ser_Suppliers();
$err=-1;

if(isset($_POST['supplierId'])) $supplierId=$_POST['supplierId'];
else $supplierId=0;

//get data from form
$aaaId=$_POST['aaaId'];
$subscriptionplanId=$_POST['subscriptionplanId'];
$discount_type=$_POST['discount_type'];
$registeredsupplierId=$_POST['registeredsupplierId'];
$blockId=$_POST['blockId'];

if($supplierId>0){
    //Edit supplier
    $edit_supplier=$db->editSupplier($supplierId,$aaaId,$subscriptionplanId,$discount_type,$registeredsupplierId,$blockId);
    if($edit_supplier) $err=0;
    else $err=1;
}else{
    //add supplier
    $add_supplier=$db->addSupplier($aaaId,$subscriptionplanId,$discount_type,$registeredsupplierId,$blockId);
    if($add_supplier) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>