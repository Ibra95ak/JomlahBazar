<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Reviews.php';
$db = new Ser_Reviews();
$err=-1;

if(isset($_POST['reviewId'])) $reviewId=$_POST['reviewId'];
else $reviewId=0;

//get data from form
$productId=$_POST['productId'];
$customerId=$_POST['customerId'];
$title=$_POST['title'];
$stars=$_POST['stars'];
$description=$_POST['description'];
$posted_date=$_POST['posted_date'];
$pictureId=$_POST['pictureId'];
$active=$_POST['active'];

if($reviewId>0){
    //Edit review
    $edit_review=$db->editReview($reviewId,$stars,$title,$description,$posted_date,$active) ;
    if($edit_review) $err=0;
    else $err=1;
}else{
    //add review
    $add_review=$db->addReview($productId,$customerId,$stars,$title,$description,$posted_date,$pictureId,$active);
    if($add_review) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>