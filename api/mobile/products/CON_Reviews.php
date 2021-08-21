<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call products class*/
require_once '../../../'.DIR_MOD.'Ser_Reviews.php';
$db = new Ser_Reviews();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['product_reviews']=array();
$response['user_reviews']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['productId'])) $productId=$_GET['productId'];
else {
  $productId=0;
}
if(isset($_GET['userId'])) $userId=$_GET['userId'];
else {
  $userId=0;
}
if(isset($_GET['supplierId'])) $supplierId=$_GET['supplierId'];
else {
  $supplierId=0;
}
/*fetching*/
if ($action=='get') {
  if($productId!=0){
    $response['product_reviews'] = $db->GetReviewsByproductId($productId);/*fetching brand categories*/
    echo json_encode($response);/*data returned*/
  }
  if($supplierId!=0){
    $response['user_reviews'] = $db->GetReviewsBysupplierId($supplierId);/*fetching brand categories*/
    echo json_encode($response);/*data returned*/
  }
}
/*managing*/
if ($action=='post') {
    $stars=$_POST['rating'];
    $description=$_POST['description'];
    $review = $db->addReview($productId, $userId, $stars, $description, 1);/*add new brand*/
    if($review) $response['err']=0;/*successfull add*/
    else $response['err']=3;/*failed to add brand due to database error*/
    echo json_encode($response);
}
if ($action=='post-supplier') {
    $stars=$_POST['rating'];
    $description=$_POST['description'];
    $review = $db->addUserReview($supplierId, $userId, $stars, $description, 1);/*add new brand*/
    if($review) $response['err']=0;/*successfull add*/
    else $response['err']=3;/*failed to add brand due to database error*/
    echo json_encode($response);
}
/*deletion*/
if ($action=='delete') {
  $review = $db->DeleteReviewById($reviewId);/*delete brand*/
  /*delete brand image*/
  if ($review) {
      $response['err']=0;/*successfull deletion*/
  } else {
      $response['err']=4;/*failed to delete*/
  }
  echo json_encode($response);
}

?>
