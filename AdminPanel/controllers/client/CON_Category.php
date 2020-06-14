<?php
/*Get categories class*/
require_once '../../libraries/Ser_Categories.php';
/*Create categories Instance*/
$db = new Ser_Categories();
/*results array*/
$results=array();
/*parameters*/
$categoryId=$_GET['categoryId'];
/*get category details*/
$get_category = $db->GetCategoryById($categoryId);
if($get_category){
    foreach($get_category as $category){
        array_push($results,$category);
    }
}
echo json_encode($results);
?>