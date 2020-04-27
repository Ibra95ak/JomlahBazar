<?php
//Get base class
require_once '../../libraries/Base.php';
//Get supplier class
require_once '../../libraries/Ser_Suppliers.php';
$db = new Ser_Suppliers();
$err=-1;
//delete supplier
if(isset($_GET['supplierId'])){
    $del_suppliers = $db->DeleteSupplierById($_GET['supplierId']);
}
if($del_suppliers){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_suppliers.php?err=$err");
exit;
?>