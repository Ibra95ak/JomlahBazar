<?php
/*Get product class*/
require_once '../../libraries/Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*results array*/
$results=array();
/*Parameters*/
$search=$_GET['search'];
$query="SELECT products.productId, products.name, products.unitprice FROM products";
$where="";
$orderby="";
if(isset($_GET['order_by'])){ 
    switch ($_GET['order_by']) {
      case 1:
        $orderby.=" ORDER BY products.name ASC";
        break;
      case 2:
        $orderby.=" ORDER BY products.name DESC";
        break;
      case 3:
        $orderby.=" ORDER BY products.unitprice DESC";
        break;
      case 4:
        $orderby.=" ORDER BY products.unitprice ASC";
        break;
      default:
        $orderby.="";
    } 
}
if(isset($_GET['filter_category']) && $_GET['filter_category']!=0){
    if($where=="") $where.=" WHERE products.categoryId=".$_GET['filter_category'];
    else $where.=" AND products.categoryId=".$_GET['filter_category'];
} 
if(isset($_GET['min_price']) && isset($_GET['max_price'])){
    if($_GET['min_price']==0 and $_GET['max_price']==0) $where.="";
    else{
       if($where=="") $where.=" WHERE unitprice BETWEEN ".$_GET['min_price']." AND ".$_GET['max_price'];
       else $where.=" AND unitprice BETWEEN ".$_GET['min_price']." AND ".$_GET['max_price']; 
    }
}
if(isset($_GET['fp'])){
    if($where=="") $where.=" WHERE products.featured =1";
    else $where.=" AND products.featured=1";
}
if(isset($_GET['bp'])){
    if($where=="") $where.=" WHERE products.bestseller=1";
    else $where.=" AND products.bestseller=1";
}
if(isset($_GET['dp'])){
    if($where=="") $where.=" WHERE products.discount =1";
    else $where.=" AND products.discount=1";
}
if(isset($_GET['filter_brand']) && $_GET['filter_brand']!=0){
    if($where=="") $where.=" WHERE products.brandId =".$_GET['filter_brand'];
    else $where.=" AND products.brandId=".$_GET['filter_brand'];
}
if(isset($_GET['filter_rank']) && $_GET['filter_rank']!=0){
    if($where=="") $where.=" WHERE products.ranking =".$_GET['filter_rank'];
    else $where.=" AND products.ranking=".$_GET['filter_rank'];
}
/*get all products */

//if($search!=NULL) $getAll_products = $db->SearchProducts($search);
//else $getAll_products = $db->GetProducts();
$sql=$query.$where.$orderby;
//echo $sql;
$getAll_products = $db->GetProducts($sql);
if($getAll_products){
    foreach($getAll_products as $product){
        array_push($results,$product);
    }   
}
echo json_encode($results);
?>