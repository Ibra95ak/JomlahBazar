<?php
/*Get brand class*/
require_once '../../libraries/Ser_Brands.php';
/*Create brand Instance*/
$db = new Ser_Brands();
/*results array*/
$results=array();
/*parameters*/
$brandId=$_GET['brandId'];
/*get brand details*/
$get_brand = $db->GetBrandById($brandId);
if($get_brand){
    foreach($get_brand as $brand){
        array_push($results,$brand);
    }
}
echo json_encode($results);
?>