<?php
/*Get base class*/
require_once '../../libraries/base.php';
/*Call Products class*/
require_once '../../libraries/Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*Fetch latest products*/
$latest_products = $db->GetLatestProducts();
/*Populate the slider*/
if($latest_products){
  foreach($latest_products as $latest_product){
    $latest_pic = $db->GetProductPicture($latest_product['productId']);
    echo '<div class="item"><div class="product">';
    echo '<a class="product-img" href="single_product.php productId='.$latest_product['productId'].'"><img src="../AdminPanel/pics/'.$latest_pic['path'].'" alt="" /></a>';
    echo '<h5 class="product-type">'.$latest_product['brand_name'].'</h5>';
    echo '<h3 class="product-name">'.$latest_product['name'].'</h3>';
    echo '<h3 class="product-price">$'.$latest_product['unitprice'].'</h3>';
    echo '</div></div>';
}    
}
    // echo json_encode($latest_products);
?>