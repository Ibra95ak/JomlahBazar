<?php
//Get base class
require_once '../../libraries/Base.php';
//Get wishlist class
require_once '../../libraries/Ser_Wishlists.php';
$db = new Ser_Wishlists();
$err=-1;
//delete wishlist
if(isset($_GET['wishlistId'])){
    $del_wishlists = $db->DeleteWishlistById($_GET['wishlistId']);
}
if($del_wishlists){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_wishlists.php?err=$err");
exit;
?>