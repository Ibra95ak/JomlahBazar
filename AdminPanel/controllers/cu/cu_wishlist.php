<?php
//Get base class
require_once '../../libraries/Base.php';
//Get Wishlist class
require_once '../../libraries/Ser_Wishlists.php';
$db = new Ser_Wishlists();
$err=-1;

if(isset($_POST['wishlistId'])) $wishlistId=$_POST['wishlistId'];
else $wishlistId=0;

//get data from form
$userId=$_POST['userId'];
$productId=$_POST['productId'];
$active=$_POST['active'];

if($wishlistId>0){
    //Edit wishlist
    $edit_wishlist=$db->editWishlist($wishlistId,$userId,$productId,$active);
    if($edit_wishlist) $err=0;
    else $err=1;
}else{
    //add wishlist
    $add_wishlist=$db->addWishlist($userId,$productId,$active);
    if($add_wishlist) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>