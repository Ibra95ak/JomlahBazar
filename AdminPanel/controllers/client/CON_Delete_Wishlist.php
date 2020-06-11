<?php
//Get base class
require_once '../../libraries/base.php';
//Get wishlist class
require_once '../../libraries/Ser_Wishlists.php';
$db = new Ser_Wishlists();
//results array
$results=array();
$err=-1;
/*parameters*/
$wishlistId=$_GET['wishlistId'];
//get all leads details
$delete_wishlist = $db->DeleteWishlistById($wishlistId);
if($delete_wishlist) $err=0;
else $err=1;
echo json_encode($err);
?>