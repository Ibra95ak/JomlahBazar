<?php
//Get base class
require_once '../../libraries/base.php';
//Get wishlist class
require_once '../../libraries/Ser_Wishlists.php';
$db = new Ser_Wishlists();
//results array
$results=array();
/*error flag*/
$err=-1;
/*parameters*/
$userId=$_GET['userId'];
$productId=$_GET['productId'];
/*Check if prodect already exist*/
if($db->isExist_Wishlist($userId,$productId)) $err=1;
else{
    //add
    $add_wishlist = $db->addWishlist($userId,$productId,1);
    if($add_wishlist) $err=0;
    else $err=2;
}
echo json_encode($err);
?>