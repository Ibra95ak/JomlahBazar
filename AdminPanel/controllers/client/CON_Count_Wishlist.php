<?php
//Get base class
require_once '../../libraries/base.php';
//Get wishlist class
require_once '../../libraries/Ser_Wishlists.php';
$db = new Ser_Wishlists();
//results array
$results=array();
/*parameters*/
$userId=$_GET['userId'];
//get all leads details
$getuser_wishlist = $db->GetWishlistCount($userId);
if($getuser_wishlist){
        array_push($results,$getuser_wishlist);
}
echo json_encode($results);
?>