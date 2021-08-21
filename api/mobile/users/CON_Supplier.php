<?php
/*get supplier class*/
require_once '../../libraries/Ser_Suppliers.php';
/*create supplier instance*/
$db = new Ser_Suppliers();
/*get products class*/
require_once '../../libraries/Ser_Products.php';
/*create product instance*/
$dbp = new Ser_Products();
/*get stores class*/
require_once '../../libraries/Ser_Stores.php';
/*create store instance*/
$dbs = new Ser_Stores();
/*get addresses class*/
require_once '../../libraries/Ser_Addresses.php';
/*create address instance*/
$dba = new Ser_Addresses();
/*get reachouts class*/
require_once '../../libraries/Ser_Reachouts.php';
/*create reachout instance*/
$dbr = new Ser_Reachouts();
/*results array*/
$results['supplier'] = array();
$results['products'] = array();
$results['stores'] = array();
$results['addresses'] = array();
$results['reachouts'] = array();
/*parameters*/
$supplierId=$_GET['supplierId'];
/*get supplier details*/
$get_supplier = $db->GetSupplierById($supplierId);
/*get supplier products */
$get_supplier_products = $dbp->GetSupplierProducts($supplierId);
/*get supplier stores*/
$get_supplierstores = $dbs->GetStoreBySupplierId($supplierId);
/*get supplier addresses*/
$get_supplieraddresses = $dba->GetAddressesBySupplierId($supplierId);
/*get supplier reachouts*/
$get_supplierreachouts = $dbr->GetReachoutById($get_supplier['reachoutId']);
if($get_supplier){
  array_push($results['supplier'],$get_supplier);
}
if($get_supplier_products){
  foreach($get_supplier_products as $product){
    $get_productslider = $dbp->GetProductSlider($product['productId']);
    $product['imgs'] = $get_productslider;
    array_push($results['products'],$product);
    }
}
if($get_supplierstores){
  array_push($results['stores'],$get_supplierstores);
}
if($get_supplieraddresses){
  array_push($results['addresses'],$get_supplieraddresses);
}
if($get_supplierreachouts){
  array_push($results['reachouts'],$get_supplierreachouts);
}
echo json_encode($results);
?>
