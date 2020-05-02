<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Categories.php';
$db = new Ser_Categories();
$err=-1;

if(isset($_POST['CategoryId'])) $CategoryId=$_POST['CategoryId'];
else $CategoryId=0;

//get data from form
$name=$_POST['name'];
$icon=$_POST['icon'];
$productId=$_POST['productId'];
$subcategoryId=$_POST['subcategoryId'];
$brandId=$_POST['brandId'];
$active=$_POST['active'];

if($CategoryId>0){
    //Edit Category
    $edit_Category=$db->editCategory($categoryId,$name,$icon,$active);
    if($edit_Category) $err=0;
    else $err=1;
}else{
    //add Category
    $add_Category=$db->addCategory($name,$icon,$productId,$subcategoryId,$brandId,$active);
    if($add_Category) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>