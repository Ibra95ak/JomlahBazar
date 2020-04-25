<?php
//Get base class
require_once '../libraries/Base.php';
//Get orderdetail class
require_once '../libraries/Ser_Orderdetails.php';
$db = new Ser_Orderdetails();
//results array
$results=array();
//get all leads details
$getAll_orderdetails = $db->GetOrderdetails();
foreach($getAll_orderdetails as $orderdetail){
    array_push($results,$orderdetail);
}

$fp = fopen('json/orderdetails.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>