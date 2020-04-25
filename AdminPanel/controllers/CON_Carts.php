<?php
//Get base class
require_once '../libraries/Base.php';
//Get cart class
require_once '../libraries/Ser_Carts.php';
$db = new Ser_Carts();
//results array
$results=array();
//get all leads details
$getAll_carts = $db->GetCarts();
foreach($getAll_carts as $cart){
    array_push($results,$cart);
}

$fp = fopen('json/carts.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>