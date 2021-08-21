<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call products class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*Create products instance*/
$db = new Ser_Products();
/*Call addresses class*/
require_once '../../../'.DIR_MOD.'Ser_Addresses.php';
/*Create products instance*/
$dba = new Ser_Addresses();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['suppliers']=array();
$response['location']=array();
$array_productIds=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['productId'])) $productId=$_GET['productId'];
else {
  $productId=0;
}
if(isset($_GET['supplierId'])) $supplierId=$_GET['supplierId'];
else {
  $supplierId=0;
}
if ($action=='get') {
  if($productId!=0){
    $response['suppliers'] = $db->GetsuppliersByproductId($productId);
    $response['err']=0;
  }else{
    /*code*/
  }
  echo json_encode($response);
}
if ($action=='getloc') {
  if($supplierId!=0){
    $response['location'] = $dba->getAddressByUserId($supplierId);
  }else{
    $response['location'] = $dba->getAddressByProductId($productId);
  }
  echo json_encode($response);
}
if ($action=='getpro') {
  if($supplierId!=0){
    $products = $db->GetSupplierProducts($supplierId,'');
    echo json_encode($products);
  }else{
    echo $supplierId;
    $response['err']=6;
  }
}
if ($action=='getprices') {
    $products = $db->GetSupplierProductPrice($productId, $supplierId);
    echo json_encode($products);
}
if ($action=='post-list') {
  $productIds = explode(",",$_POST['ids']);
  for ($i=0; $i < count($productIds) ; $i++) {
    $db->PushProductList($_SESSION['userId'], $productIds[$i]);
  }
}
if ($action=='post') {
  $boxquantity = $_POST['boxquantity'];
  $quantity = $_POST['totalquantity'];
  $is_carton = $_POST['is_carton'];
  $range1 = $_POST['range1'];
  $price1 = $_POST['price1'];
  $tax = $_POST['tax'];
  $discount = $_POST['discount'];
  $sellingprice = $_POST['sellingprice'];
  if(isset($_POST['range2']) && $_POST['range2']!=0) $range2 = $_POST['range2'];
  else $range2 = 0;
  if(isset($_POST['price2']) && $_POST['price2']!=0) $price2 = $_POST['price2'];
  else $price2 = 0;

  if(isset($_POST['production_date']) && $_POST['production_date']!="") $production_date = date("Y-m-d", strtotime($_POST['production_date']));
  else $production_date = NULL;
  if(isset($_POST['expiry_date']) && $_POST['expiry_date']!="") $expiry_date = date("Y-m-d", strtotime($_POST['expiry_date']));
  else $expiry_date = NULL;
  if(isset($_POST['temperature'])) $temperature = $_POST['temperature'];
  else $temperature = NULL;
  if(isset($_POST['humidity'])) $humidity = $_POST['humidity'];
  else $humidity = NULL;
  if(isset($_POST['is_domestic'])) $is_domestic = 2;
  else $is_domestic = 1;
  if(isset($_POST['is_pickable'])) $is_pickable = $_POST['is_pickable'];
  else $is_pickable = 2;
  if(isset($_POST['origin'])) $origin = $_POST['origin'];
  else $origin='';
  /*Check if product already exist*/
  $product_supplier = $db->IsExistSupplierProduct($productId, $supplierId);
  if($product_supplier){
    /*edit product of supplier store*/
    $supplierproductId=$product_supplier['supplierproductId'];
    $old_quantity=$product_supplier['quantity'];
    if($old_quantity!=0) $old_product_inv = $db->updateTotalInventoryless($productId, $old_quantity);
    $supplier_product = $db->EditSupplierProduct($supplierproductId, $boxquantity, $sellingprice, $is_carton, $range1, $price1, $range2, $price2, $quantity, $tax, $discount, $production_date, $expiry_date, $temperature, $humidity, $origin, $is_domestic, $is_pickable);
    $new_product_inv = $db->updateTotalInventorymore($productId, $quantity);
    if($supplier_product) $response['err']=0;
    else $response['err']=1;
  }else{
    /*add product to supplier store*/
    $supplier_product = $db->AddSupplierProduct($productId, $supplierId, $boxquantity , $sellingprice, $is_carton, $range1, $price1, $range2, $price2, $tax, $discount, $production_date, $expiry_date, $temperature, $humidity, $origin, $quantity, $is_domestic, $is_pickable);
    $product_inventory = $db->updateTotalInventorymore($productId, $quantity);
    if($supplier_product) $response['err']=0;
    else $response['err']=1;
  }
  $min_price = $db->Getproductminprice($productId);
  $db->editProductminprice($productId, $min_price['min_selling_price']);
  $db->editProductMOQ($productId, $min_price['range1']);
  echo json_encode($response);
}
