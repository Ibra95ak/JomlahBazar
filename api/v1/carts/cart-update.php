<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
require_once '../../../'.DIR_MOD.'Ser_Carts.php';
use Anam\Phpcart\Cart;
$cart = new Cart();
$db = new Ser_Carts();
if (isset($_GET['userId'])) {
	$userId=$_GET['userId'];
}else {
	$userId=0;
}
if (isset($_GET['update'])) {
	$update=$_GET['update'];
}else {
	$update=0;
}
if ($userId!=0) {
	$check = $db->isExist_Cart($userId,$_POST['pid']);
	if ($check) {
		if ($update==1) {
			$updated_quantity = $_POST['pqty'];
		}else {
			$updated_quantity = $check['quantity']+$_POST['pqty'];
		}
		$cart_item = $db->updateCart($userId,$_POST['pid'], $updated_quantity );
		$cartId = $cart_item['updateId'];
	}else {
		$cart_item = $db->addCart($userId, $_POST['pid'], $_POST['sid'], $_POST['pname'], $_POST['pp'], $_POST['pqty'],$_POST['wght'],1);
		$cartId = $cart_item['insertId'];
	}
	if ($update==1) header("Location:".DIR_VIEW.DIR_CAR."cart.php?msg=updated");
	else header("Location:".DIR_VIEW.DIR_CAR."cart-success.php?cartId=" . $cartId);
	exit;
}else{
	$cart->updateQty($_POST['pid'], $_POST['pqty']);
	$cart->updatePrice($_POST['pid'], $_POST['pp']);
	header("Location:".DIR_VIEW.DIR_CAR."cart.php?msg=updated");
	exit;
}
