<?php
session_start();
//Get cart class
require_once '../../../model/Base.php';/*fetch Directory variables*/

require_once '../../../vendor/autoload.php';

require_once '../../../' . DIR_MOD . 'Ser_Carts.php';

use Anam\Phpcart\Cart;

$db = new Ser_Carts();
$action = $_GET['action'];
/*Response Array*/
$response = array();
/*Error flag*/
$response['err'] = -1;
$response['carts'] = array();
$response['cart_count'] = array();
if ($action == 'get') {
  $carts = $db->GetCartByUserId($_GET['userId']);
  $response['carts'] = $carts;
  echo json_encode($response);
}

if ($action == 'get_basic_user_cart') {
  $carts = $db->GetCartByUserId($_GET['id']);
  echo json_encode($carts);
}

if ($action == 'delete_cart') {
  $deleted = $db->DeleteCartByUserId($_GET['productId'], $_GET['userId']);
  if ($deleted) {
    $cart = new Cart;
    $cart->remove($_GET['productId']);
    $response['err'] = 0;
  } else {
    $response['err'] = 1;
  }
  header("location:".DIR_VIEW.DIR_CAR."cart.php?err=" . $response['err']);
}
if ($action == 'cart_count') {
$getuser_cart = $db->GetCartCount($_GET['userId']);
if($getuser_cart){
        array_push($response['cart_count'],$getuser_cart);
}
echo json_encode($response);
}
