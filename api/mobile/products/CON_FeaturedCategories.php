<?php
/*Start browser session*/
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Categories.php';
/*Create categories instant*/
$db = new Ser_Categories();
/*results array*/
$results=array();
/*Fetch categories */
$categories = $db->GetallCategories();
if($categories){
    foreach($categories as $category){
        array_push($results,$category);
    }
}
echo json_encode($results);
?>
