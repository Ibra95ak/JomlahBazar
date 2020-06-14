<?php
/*Get Categories class*/
require_once '../../libraries/Ser_Categories.php';
/*Create Categories Instance*/
$db = new Ser_Categories();
/*results array*/
$results=array();
/*Parameters*/
$search=$_GET['search'];
/*get products' categories */
if($search!=NULL) $get_productscategories = $db->FilterSearchProductsCategories($search);
else $get_productscategories = $db->GetCategories();
if($get_productscategories){
    foreach($get_productscategories as $category){
        array_push($results,$category);
    }   
}
echo json_encode($results);
?>