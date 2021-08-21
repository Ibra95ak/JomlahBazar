<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call products class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
require_once '../../../'.DIR_MOD.'Ser_Reviews.php';
/*Create products instance*/
$db = new Ser_Products();
$dbr = new Ser_Reviews();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['products']=array();
$response['suppliers']=array();
$response['productdetails'] =array();
$response['productpics'] =array();
$response['productqty'] =array();
$response['product_reviews'] =array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['productId'])) $productId=$_GET['productId'];
else $productId=0;
if ($action=='get') {
  if($productId!=0){
    /*get product by Id*/
    $response['products'] = $db->Admin_GetproductById($productId);
    switch ($response['products']['detailstype']) {
      case 1:
        $table_name='productdetail_care';
        break;
      case 2:
        $table_name='productdetail_cosmetics';
        break;
      case 3:
        $table_name='productdetail_grocery';
        break;
      case 4:
        $table_name='productdetail_perfumes';
        break;
      case 5:
          $table_name='productdetail_careappliances';
          break;
      case 6:
          $table_name='productdetail_desktop';
          break;

      default:
        $table_name='productdetail_care';
        break;
    }
    $response['productdetails'] = $db->GetproductdetailById($productId,$table_name);
    $response['productpics'] = $db->Admin_GetProductPics($productId);
    $response['productqty'] = $db->GetProductTotalQty($productId);
    $response['product_reviews'] = $dbr->GetReviewsByproductId($productId);
    $response['suppliers'] = $db->Admin_GetsuppliersByproductId($productId);
    $response['err']=0;
    echo json_encode($response);
  }else{
    /*get all products*/
    $products = $db->Admin_getallProducts();
    if($products){
        foreach($products as $product){
          array_push($response['products'],$product);
        }
    }
    $fp = fopen('../json/products.json', 'w');
    fwrite($fp, json_encode($response['products']));
    fclose($fp);
  }

}
?>
