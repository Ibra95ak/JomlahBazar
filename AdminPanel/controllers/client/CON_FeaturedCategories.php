<?php
/*Call categories class*/
require_once '../../libraries/Ser_Categories.php';
/*Create categories instant*/
$db = new Ser_Categories(); 
/*results array*/
$results=array();
/*Fetch categories */
$categories = $db->GetCategories();
if($categories){
    foreach($categories as $category){
        array_push($results,$category);
    }   
}
echo json_encode($results);
?>