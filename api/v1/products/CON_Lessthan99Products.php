<?php
/*Start browser session*/
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*create product instance*/
$db = new Ser_Products();
/*results array*/
$response=array();
/*Fetch best seller products*/
$lessthan99products = $db->Getlessthan99Products();
if($lessthan99products){
  foreach($lessthan99products as $lessthan99product){
    array_push($response,$lessthan99product);
  }
}
echo json_encode($response);
?>
