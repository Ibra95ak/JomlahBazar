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
$name=$_POST['name'];
$icon=$_POST['icon'];
$active=$_POST['active'];

if($subcategoryId>0){
    //Edit subcategory
    $edit_subcategory=$db->editSubcategory($subcategoryId,$categoryId,$name,$icon,$active);
    if($edit_subcategory) $err=0;
    else $err=10;
}else{
    //add subcategory
    // $add_subcategory=$db->addSubcategory($categoryId,$name,$icon,$active);
    // if($add_subcategory) $err=0;
    // else $err=1;
}
echo json_encode($err);
exit;
?>