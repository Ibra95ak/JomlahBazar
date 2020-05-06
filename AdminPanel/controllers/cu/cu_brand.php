<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Brands.php';
$db = new Ser_Brands();
$err=-1;

if(isset($_POST['brandId'])) $brandId=$_POST['brandId'];
else $brandId=0;

//get data from form
$brandcategoryId=$_POST['brandcategoryId'];
$brand_name=$_POST['brand_name'];
$pictureId=$_POST['pictureId'];
$active=$_POST['active'];

if($brandId>0){
    //Edit brand
    $edit_brand=$db->editBrand($brandId,$brandcategoryId,$brand_name,$pictureId,$active);
    if($edit_brand) $err=0;
    else $err=1;
}else{
    //add brand
    $add_brand=$db->addBrand($brandcategoryId,$brand_name,$pictureId,$active);
    if($add_brand) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>