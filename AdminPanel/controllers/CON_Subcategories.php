<?php
//Get base class
require_once '../libraries/Base.php';
//Get subcategory class
require_once '../libraries/Ser_Subcategories.php';
$db = new Ser_Subcategories();
//results array
$results=array();
//get all leads details
$getAll_subcategories = $db->GetSubcategories();
foreach($getAll_subcategories as $subcategory){
    array_push($results,$subcategory);
}

$fp = fopen('json/subcategories.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>