<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/

require_once '../../' . DIR_MOD . 'Ser_Carts.php';/*call carts class*/

use Anam\Phpcart\Cart;

$client = new GuzzleHttp\Client();

$cart = new Cart;

$response = [];
$response['pid'] = $_POST['pid'];
$response['pqty'] = $_POST['pqty'];
$response['pp'] = $_POST['pp'];
$response['sid'] = $_POST['sid'];
$response['pname'] = $_POST['pname'];


$res_product = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_products.php?action=get&productId=' . $response['pid']);
$product = json_decode($res_product->getBody());
$cart->add([
	'id'		=> $response['pid'],
	'seller_id'	=> $response['sid'],
	'name'		=> $response['pname'],
	'price'		=> intval($response['pp']),
	'quantity'		=> $response['pqty'],
	'weight'		=> $product->products->weight,
	'path' => $product->productpics[0]->path
]);

if ($_POST['buynow'] == 1) {
	header("Location: cart.php?message=addedtocart");
	exit;
} else {
	header("Location: cart-success.php?product_id=" .  $response['pid']);
	exit;
}
