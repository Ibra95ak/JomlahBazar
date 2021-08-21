<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../' . DIR_MOD . 'Ser_Wishlist.php';/*call carts class*/
require_once '../../../vendor/autoload.php';/*call composer functionalities*/
/*fetch session variables*/
if (isset($_GET['userId'])) {
  $userId = $_GET['userId'];
}else {
  $userId = 0;
}
$db = new Ser_Wishlists();/*create carts instance*/
/*url parameters*/
$action = $_GET['action'];
/*response Array*/
$response = array();
$response['err'] = -1;/*Error flag*/
$response['wishlists'] = array();/*array of carts*/
if (isset($_GET['userId'])) {
  $userId = $_GET['userId'];
}else {
  $userId = 0;
}
/*fetching*/
if ($action == 'get-wishlist') {
  $carts = $db->GetWishListBySupplierId($userId);/*fetch all user carts*/
  if ($carts) {
    foreach ($carts as $cart) {
      array_push($response['wishlists'], $cart);
    }
  }
  echo json_encode($response['wishlists']);
}
if ($action == 'get-loc') {
  $carts = $db->GetWishlistLocationBySupplierId($userId);/*fetch all user carts*/
  print_r($carts);
  if ($carts) {
    foreach ($carts as $cart) {
      array_push($response['carts'], $cart);
    }
  }
  echo json_encode($response['carts']);
}
