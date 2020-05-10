<?php
//Get base class
require_once '../libraries/Base.php';
//Get Categories class
require_once '../libraries/Ser_Categories.php';
$db = new Ser_Categories();
//results array
$results=array();
//get all leads details
$getAll_categories = $db->GetCategories();
if($getAll_categories){
    foreach($getAll_categories as $category){
        array_push($results,$category);
    }   
}
$fp = fopen('json/categories.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>