<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Productdetails.php';
$db = new Ser_Productdetails();
$err=-1;

if(isset($_POST['productdetailId'])) $productdetailId=$_POST['productdetailId'];
else $productdetailId=0;

//get data from form
$description=$_POST['description'];
$size=$_POST['size'];
$color=$_POST['color'];
$weight=$_POST['weight'];
$barcode=$_POST['barcode'];

if($productdetailId>0){
    //Edit productdetail
    $edit_productdetail=$db->editProductdetail($productdetailId,$description,$size,$color,$weight,$barcode);
    if($edit_productdetail) $err=0;
    else $err=1;
}else{
    //add productdetail
    $add_productdetail=$db->addProductdetail($description,$size,$color,$weight,$barcode);
    if($add_productdetail) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>