<?php
//Get base class
require_once '../../libraries/base.php';
//Get product class
require_once '../../libraries/Ser_Products.php';
$db = new Ser_Products();
$err=-1;
//delete product
if(isset($_GET['productId'])){
    $del_products = $db->DeleteProductById($_GET['productId']);
}
if($del_products){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_products.php?err=$err");
exit;
?>