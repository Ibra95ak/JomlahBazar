<?php
/*Get base class*/
require_once '../../libraries/base.php';
/*Call Products class*/
require_once '../../libraries/Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*Fetch best seller products*/
$bestsellers = $db->GetBestSellerProducts();
// if($bestsellers){
//   foreach($bestsellers as $bestseller){
//     $bestseller_pic = $db->GetProductPicture($bestseller['productId']);
//     echo '<div class="item"><div class="product">';
//     echo '<a class="product-img" href="single_product.php?productId='.$bestseller['productId'].'"><img src="../AdminPanel/pics/'.$bestseller_pic['path'].'" alt="" /></a>';
//     echo '<h5 class="product-type">'.$bestseller['brand_name'].'</h5>';
//     echo '<h3 class="product-name">'.$bestseller['name'].'</h3>';
//     echo '<h3 class="product-price">$'.$bestseller['unitprice'].'</h3>';
//     echo '</div></div>';
// }  
// }
echo json_encode($bestsellers);
?>