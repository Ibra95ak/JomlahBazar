<?php
/*Get brand class*/
require_once '../../libraries/Ser_Brands.php';
/*Create brand Instance*/
$db = new Ser_Brands();
/*results array*/
$results=array();
/*get brand details*/
$get_brands = $db->Getbrands();
if($get_brands){
    foreach($get_brands as $brand){
        array_push($results,$brand);
    }
}
echo json_encode($results);
?>