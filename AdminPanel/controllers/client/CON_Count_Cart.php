<?php
//Get base class
require_once '../../libraries/base.php';
//Get wishlist class
require_once '../../libraries/Ser_Carts.php';
$db = new Ser_Carts();
//results array
$results=array();
/*parameters*/
$userId=$_GET['userId'];
//get all leads details
$getuser_cart = $db->GetCartCount($userId);
if($getuser_cart){
        array_push($results,$getuser_cart);
}
echo json_encode($results);
?>