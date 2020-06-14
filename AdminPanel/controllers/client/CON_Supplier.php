<?php
/*Get supplier class*/
require_once '../../libraries/Ser_Suppliers.php';
/*Create supplier Instance*/
$db = new Ser_Suppliers();
/*results array*/
$results=array();
/*parameters*/
$supplierId=$_GET['supplierId'];
/*get supplier details*/
$get_supplier = $db->GetSupplierById($supplierId);
if($get_supplier){
    foreach($get_supplier as $supplier){
        array_push($results,$supplier);
    }
}
echo json_encode($results);
?>