<?php
//Get base class
require_once '../../libraries/Base.php';
//Get review class
require_once '../../libraries/Ser_Reviews.php';
$db = new Ser_Reviews();
$err=-1;
//delete review
if(isset($_GET['reviewId'])){
    $del_reviews = $db->DeleteReviewById($_GET['reviewId']);
}
if($del_reviews){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_reviews.php?err=$err");
exit;
?>