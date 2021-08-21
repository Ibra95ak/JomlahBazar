<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();/*start user session*/
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../' . DIR_MOD . 'Ser_Carts.php';/*call carts class*/
require_once '../../../' . DIR_MOD . 'Ser_Products.php';/*call carts class*/
require_once '../../../' . DIR_MOD . 'Ser_Users.php';/*call carts class*/
require_once '../../../' . DIR_MOD . 'Ser_Addresses.php';/*call carts class*/
require_once '../../../' . DIR_MOD . 'Ser_Wallets.php';/*call carts class*/
require_once '../../../vendor/autoload.php';/*call composer functionalities*/
/*fetch session variables*/
if (isset($_GET['userId'])) {
  $userId = $_GET['userId'];
}else {
  $userId = 0;
}
/*start -- composer libraries*/

use Anam\Phpcart\Cart;
/*end -- composer libraries*/

$db = new Ser_Carts();/*create carts instance*/
$dbp = new Ser_Products();/*create carts instance*/
$dbu = new Ser_Users();/*create carts instance*/
$dba = new Ser_Addresses();/*create carts instance*/
$dbw = new Ser_Wallets();/*create carts instance*/
/*url parameters*/
$action = $_GET['action'];
/*response Array*/
$response = array();
$response['err'] = -1;/*Error flag*/
$response['carts'] = array();/*array of carts*/
$response['cart_item'] = array();/*array of carts*/
$response['carts_suppliers'] = array();/*array of carts*/
$response['seller_info']=array();
$response['seller_company']=array();
$response['buyer_info']=array();
$response['buyer_company']=array();
$response['seller_default_address']=array();
$response['buyer_default_address']=array();
$response['buyer_seller_cart']=array();
$response['order']=array();
$response['cart_count'] = 0;
/*fetching*/
if ($action == 'get') {
  $carts = $db->GetCartByUserId($userId);/*fetch all user carts*/
  if ($carts) {
    foreach ($carts as $cart) {
      $product_seller_quantity = $dbp->getsellerproductquantity($cart['sellerId'],$cart['productId']);
      if ($cart['quantity']<=$product_seller_quantity['quantity']) $cart['available'] = 1;
      else $cart['available'] = 2;
      array_push($response['carts'], $cart);
    }
  }
  echo json_encode($response['carts']);
}
if ($action == 'get-cart-item') {
  $cartId = $_GET['cartId'];
  $carts = $db->GetCartById($cartId);/*fetch all user carts*/
  array_push($response['cart_item'], $carts);
  echo json_encode($response);
}
if ($action == 'get-cartcount') {
  $carts = $db->GetCartCount($userId);/*fetch all user carts*/
  if ($carts) {
    $response['cart_count'] = $carts['countc'];
  }else {
    $response['cart_count'] = 0;
  }
  echo json_encode($response['cart_count']);
}
if ($action == 'get-supplier-cartcount') {
  $carts = $db->SupplierCartProductsCount($userId);/*fetch all user carts*/
  if ($carts) {
    $response['cart_count'] = $carts['countsc'];
  }else {
    $response['cart_count'] = 0;
  }
  echo json_encode($response['cart_count']);
}
if ($action == 'get-sup') {
    $carts = $db->GetCartBySupplierId($userId);/*fetch all user carts*/
  if ($carts) {
    foreach ($carts as $cart) {
      array_push($response['carts'], $cart);
    }
  }
  echo json_encode($response['carts']);
}
if ($action == 'get-loc') {
  $carts = $db->GetCartLocationBySupplierId($userId);/*fetch all user carts*/
  if ($carts) {
    foreach ($carts as $cart) {
      array_push($response['carts'], $cart);
    }
  }
  echo json_encode($response['carts']);
}
if ($action == 'get-loc-buyer') {
  $carts = $db->GetCartLocationByUserId($userId);/*fetch all user carts*/
  if ($carts) {
    foreach ($carts as $cart) {
      $arraymerg = array();
      $seller = $dbu->getUserById($cart['sellerId']);
      $usercompanyId=$seller['usercompanyId'];
      $company = $dbu->getUserCompany($usercompanyId);
      array_push($arraymerg['companyname'], $company['companyname']);
      array_push($arraymerg, $cart);
      array_push($response['carts'], $arraymerg);
    }
  }
  echo json_encode($response['carts']);
}
if ($action == 'get-suppliers') {
  $carts = $db->GetCartSuppliersByUserId($userId);/*fetch all user carts*/
  if ($carts) {
    foreach ($carts as $cart) {
      $wired = $dbw->GetBankBySellerId($cart['sellerId']);/*fetch all user carts*/
      if ($wired) {
        $cart['wired'] = 1;
        $cart['account_number'] = $wired['account_number'];
        $cart['account_name'] = $wired['account_name'];
        $cart['bank_name'] = $wired['bank_name'];
        $cart['iban'] = $wired['iban'];
        $cart['swift_code'] = $wired['swift_code'];
        $cart['currency'] = $wired['currency'];
      }else {
        $cart['wired'] = 0;
      }
      $location = $dba->getDefaultAddressByUserId($cart['sellerId']);
      $cart['flag'] = $location['country'];
      array_push($response['carts_suppliers'], $cart);
    }
  }
  echo json_encode($response['carts_suppliers']);
}
if ($action == 'update-product-shipment') {
  $userId=$_POST['userId'];
  $type=$_POST['shipment_type'];
  $carts = $db->UpdateProductShipment($userId,$type);/*fetch all user carts*/
}
if ($action == 'update-product-payment') {
  $userId=$_POST['userId'];
  $type=$_POST['payment_type'];
  $carts = $db->UpdateProductPayment($userId,$type);/*fetch all user carts*/
}
if ($action == 'get-usercart-seller') {
  $totalPrice = 0;
  $sellerId=$_GET['sellerId'];
  $carts = $db->GetUserCartBySuppliers($userId,$sellerId);/*fetch all user carts*/
  $seller_modal = '';
  $seller = $dbu->getUserById($sellerId);
  $usercompanyId=$seller['usercompanyId'];
  $company = $dbu->getUserCompany($usercompanyId);
  if ($company['profile_pic']) {
    $profile_pic = $company['profile_pic'];
  }else {
    $profile_pic = DIR_ROOT.DIR_MED.DIR_USR."default.jpg";
  }
  $seller_modal.='<div class="row kt-pb-10"><div class="col-md-2"><img src="'.$profile_pic.'" class="supplier_pic"/></div><div class="col-md-6" style="margin: auto 0;"><h2>'.$company['companyname'].'</h2></div></div>';
  foreach ($carts as $item) {
    $productname = '';
    if(strlen($item['name'])>58) $productname = substr( $item['name'],0,55)."...";
    else $productname = $item['name'];
    $totalPrice += ($item['price'] * $item['quantity']);
    $seller_modal.= '<div class="kt-portlet"><div class="kt-portlet__body"><div class="kt-widget kt-widget--user-profile-3"><div class="kt-widget__top">';
    $seller_modal.= '<div class="kt-widget__media"><a href="'.DIR_VIEW . DIR_PRO.'productdetails.php?productId='.$item['productId'].'"><img src="'.$item['path'].'"></a></div>';
    $seller_modal.= '<div class="kt-widget__content"><div class="kt-widget__head">';
    $seller_modal.= '<div class="kt-widget__title">'.$productname.'</div>';
    $seller_modal.= '<div class="kt-widget__action"><span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED '.($item['price'] * $item['quantity']).'</span></div></div>';
    $seller_modal.= '<div class="kt-widget__info"><div class="kt-widget__stats d-flex align-items-center flex-fill"><div class="kt-widget__item">
    <div class="kt-widget__label"><span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED '.$item['price'].'/pcs </span></div></div>';
    $seller_modal.= '<div class="kt-widget__item"><div class="kt-widget__label"><input type="number" min="'.$item['range1'].'" step="'.$item['range1'].'" class="form-control" value="'.$item['quantity'].'" onchange="updateQty(this, '.$item['productId'].','.$item['range1'].','.$item['range2'].','.$item['price1'].','.$item['price2'].')" style="width: 60px;" ></div></div>';
    $seller_modal.= '<div class="kt-widget__item"><div class="kt-widget__action"><span class="btn btn-label-dark btn-sm btn-bold btn-upper">kg '.($item['weight'] * $item['quantity']).'</span></div></div>';
    $seller_modal.= '<div class="kt-widget__item"><div class="kt-widget__label"><a href="'.DIR_CONT. DIR_CAR.'CON_carts.php?action=delete&productId='.$item['productId'].'&userId='.$userId .'" class="kt-mr-10"><button type="button" class="btn btn-sm btn-upper" style="background: #edeff6">Remove item</button></a>';
    $seller_modal.= '<button type="button" class="btn btn-sm btn-upper" onclick="addToWishList('.$userId .','.$item['sellerId'].','.$item['productId'].')" style="background: #edeff6">Add to Wishlist</button>';
    $seller_modal.= '</div>';
    $seller_modal.= '</div></div></div></div></div></div></div></div>';
  }
  $seller_modal.='<div class="row kt-pt10"><div class="col-md-12 text-right"><h2 class="kt-font-md">Total: '.$totalPrice.'</h2></div></div>';
  echo $seller_modal;
}
if ($action == 'get-pickable') {
  $pickable = 0;
  $carts = $db->GetCartByUserId($userId);/*fetch all user carts*/
  foreach ($carts as $item) {
    $supplier_product = $dbp->IsPickableSupplierProduct($item['productId'],$item['sellerId']);
    if ($supplier_product['pro_pickable']!=1) {
      $pickable = 1;
      break;
    }
  }
  echo $pickable;
}
if ($action == 'get-proforminvoice') {
  $userId=$_GET['userId'];
  $sellerId=$_GET['sellerId'];
  $seller = $dbu->getUserById($sellerId);
  array_push($response['seller_info'],$seller);
  $usercompanyId=$seller['usercompanyId'];
  $company = $dbu->getUserCompany($usercompanyId);
  array_push($response['seller_company'],$company);
  $address = $dba->getDefaultAddressByUserId($sellerId);
  array_push($response['seller_default_address'],$address);
  $buyer = $dbu->getUserById($userId);
  array_push($response['buyer_info'],$buyer);
  if ($buyer['usercompanyId']!=0) {
    $buyercompanyId=$buyer['usercompanyId'];
    $buyercompany = $dbu->getUserCompany($buyercompanyId);
    array_push($response['buyer_company'],$buyercompany);
  }else {
    $response['buyer_company']=null;
  }
  $address_buyer = $dba->getDefaultAddressByUserId($userId);
  array_push($response['buyer_default_address'],$address_buyer);
  $cart_buyer_seller = $db->GetBuyerSellerCart($userId,$sellerId);
  if ($cart_buyer_seller) {
    foreach ($cart_buyer_seller as $item) {
      array_push($response['buyer_seller_cart'],$item);
    }
  }else {
    $response['buyer_seller_cart'] = NULL;
  }
  echo json_encode($response);
}
if ($action == 'get-jb-proforminvoice') {
  $userId=$_GET['userId'];
  $buyer = $dbu->getUserById($userId);
  array_push($response['buyer_info'],$buyer);
  if ($buyer['usercompanyId']!=0) {
    $buyercompanyId=$buyer['usercompanyId'];
    $buyercompany = $dbu->getUserCompany($buyercompanyId);
    array_push($response['buyer_company'],$buyercompany);
  }else {
    $response['buyer_company']=null;
  }
  $address_buyer = $dba->getDefaultAddressByUserId($userId);
  array_push($response['buyer_default_address'],$address_buyer);
  $sellers = $db->getCartSellersByUserId($userId);
  foreach ($sellers as $seller) {
    $seller['seller_info']=array();
    $seller['seller_company']=array();
    $seller['seller_default_address']=array();
    $seller['buyer_seller_cart']=array();
    $seller_info = $dbu->getUserById($seller['sellerId']);
    array_push($seller['seller_info'],$seller_info);
    $usercompanyId=$seller_info['usercompanyId'];
    $company = $dbu->getUserCompany($usercompanyId);
    array_push($seller['seller_company'],$company);
    $address = $dba->getDefaultAddressByUserId($sellerId);
    array_push($seller['seller_default_address'],$address);
    $cart_buyer_seller = $db->GetBuyerSellerCart($userId,$seller['sellerId']);
    if ($cart_buyer_seller) {
      foreach ($cart_buyer_seller as $item) {
        array_push($seller['buyer_seller_cart'],$item);
      }
    }else {
      $seller['buyer_seller_cart'] = NULL;
    }
    array_push($response['buyer_seller_cart'],$seller);
  }
  echo json_encode($response);
}
if ($action == 'buyagain'){
  $productId = $_POST['productId'];
  $quantity = $_POST['quantity'];
  $totalprice = $_POST['totalprice'];
  $sellerId = $_POST['sellerId'];
  $product = $dbp->GetProductById($productId);
  $weight = $product['weight'];
  $supplier_product = $dbp->GetSupplierProductPrice($productId,$sellerId);
  if ($supplier_product['range2']!=0 && $quantity>$supplier_product['range2']) $pieceprice = $supplier_product['price2'];
  else $pieceprice = $supplier_product['price1'];
  $check = $db->isExist_Cart($userId,$productId);
  if ($check) {
  	$cart_item = $db->updateCart($userId,$productId,$quantity);
  	$cartId = $cart_item['updateId'];
  }else {
  	$cart_item = $db->addCart($userId,$productId,$sellerId, $product['name'],$pieceprice, $quantity,$weight, 1);
  	$cartId = $cart_item['insertId'];
  }
  $response['err'] = 0;
  echo json_encode($response);
}
/*deletion*/
if ($action == 'delete') {

  $deleted = $db->DeleteCartByUserId($_GET['productId'], $_GET['userId']);/*remove product from cart*/
  if ($deleted) {
    /*successful delete*/
    $cart = new Cart;
    $cart->remove($_GET['productId']);
    $response['err'] = 0;
  } else {
    $response['err'] = 1;/*failed delete due to database error*/
  }

  header("location:" . DIR_VIEW . DIR_CAR . "cart.php?err=" . $response['err']);
}
