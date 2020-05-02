<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Subcategories.php';
$db = new Ser_Subcategories();
$err=-1;

if(isset($_POST['subcategoryId'])) $subcategoryId=$_POST['subcategoryId'];
else $subcategoryId=0;

//get data from form
$categoryId=$_POST['categoryId'];
$productId=$_POST['productId'];
$brandId=$_POST['brandId'];
$active=$_POST['active'];

if($subcategoryId>0){
    //Edit subcategory
    $edit_subcategory=$db->editSubcategory($subcategoryId,$active);
    if($edit_subcategory) $err=0;
    else $err=1;
}else{
    //add subcategory
    $add_subcategory=$db->addSubcategory($categoryId,$productId,$brandId,$active);
    if($add_subcategory) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>