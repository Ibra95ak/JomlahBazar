<?php
/*Call categories class*/
require_once '../../libraries/Ser_Subcategories.php';
/*Create subcategories instant*/
$db = new Ser_Subcategories(); 
/*results array*/
$results=array();
/*Parameters*/
$categoryId = $_GET['categoryId'];
/*Fetch subcategories */
$subcategories = $db->GetSubcategoryByCategoryId($categoryId);
if($subcategories){
    foreach($subcategories as $subcategory){
        array_push($results,$subcategory);
    }   
}
echo json_encode($results);
?>