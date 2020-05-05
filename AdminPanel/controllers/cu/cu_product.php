<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Products.php';
$db = new Ser_Products();
$err=-1;

if(isset($_POST['productId'])) $productId=$_POST['productId'];
else $productId=0;

//get data from form
$supplierId=$_POST['supplierId'];
$productdetailId=$_POST['productdetailId'];
$inventoryId=$_POST['inventoryId'];
$name=$_POST['name'];
$quantity=$_POST['quantity'];
$min_order=$_POST['min_order'];
$unitprice=$_POST['unitprice'];
$discount=$_POST['discount'];
$ranking=$_POST['ranking'];
$brandId=$_POST['brandId'];
$blockId=$_POST['blockId'];
$active=$_POST['active'];

if($productId>0){
    //Edit product
    $edit_product=$db->editProduct($productId,$supplierId,$productdetailId,$inventoryId,$name,$quantity,$min_order,$unitprice,$discount,$ranking,$brandId,$blockId,$active);
    if($edit_product) $err=0;
    else $err=1;
}else{
    //add product
    $add_product=$db->addProduct($supplierId,$productdetailId,$inventoryId,$name,$quantity,$min_order,$unitprice,$discount,$ranking,$brandId,$blockId,$active);
    if($add_product) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>