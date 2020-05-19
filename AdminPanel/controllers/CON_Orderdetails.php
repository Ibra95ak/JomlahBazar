<?php
//Get base class
require_once '../libraries/base.php';
//Get orderdetail class
require_once '../libraries/Ser_Orderdetails.php';
$db = new Ser_Orderdetails();
//results array
$results=array();
//get all leads details
$orderId=$_GET['orderId'];
if($orderId>0){
    //get all priviledges for admin
    $getAll_orderdetails = $db->GetOrderDe($orderId);
}else {
    //get all priviledges 
    $getAll_orderdetails = $db->Getorderdetails();
}
if($getAll_orderdetails){
    foreach($getAll_orderdetails as $orderdetail){
        array_push($results,$orderdetail);
    }    
}
//fill result in json file
$fp = fopen('json/orderdetails.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>