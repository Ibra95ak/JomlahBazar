<?php
//Get base class
require_once '../libraries/base.php';
//Get orders class
require_once '../libraries/Ser_Orders.php';
$db = new Ser_Orders();
//results array
$results=array();
//get all leads details
$getAll_orders = $db->GetOrders();
if($getAll_orders){
    foreach($getAll_orders as $order){
    array_push($results,$order);
}
}
//fill result in json file
$fp = fopen('json/orders.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>