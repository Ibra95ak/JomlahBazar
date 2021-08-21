<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call roles class*/
require_once '../../../'.DIR_MOD.'Ser_Seller.php';
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*Create Users instance*/
$db = new Ser_Seller();
$dbp = new Ser_Products();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['count_pending']=array();
$response['count_shipped']=array();
$response['count_completed']=array();
$response['count_canceled']=array();
$response['count_refunded']=array();

/*URL parameters*/
$action=$_GET['action'];
if (isset($_GET['userId'])) $userId=$_GET['userId'];
else $userId=0;
if ($action=='get') {
  $response['count_pending'] = $db->GetSellerOrdersStats($userId,1);
  $response['count_shipped'] = $db->GetSellerOrdersStats($userId,2);
  $response['count_completed'] = $db->GetSellerOrdersStats($userId,3);
  $response['count_canceled'] = $db->GetSellerOrdersStats($userId,4);
  $response['count_refunded'] = $db->GetSellerOrdersStats($userId,5);
  $response['count_sales_daily'] = $db->GetSellerSalesStatsDaily($userId);
  $response['count_sales_weekly'] = $db->GetSellerSalesStatsWeekly($userId);
  $response['count_sales_monthly'] = $db->GetSellerSalesStatsMonthly($userId);
  $response['count_products_inventory'] = $dbp->countProductsBySupplierId($userId);
  $response['count_products_cart'] = $db->GetSellerCartsStats($userId);
  $response['count_products_wishlist'] = $db->GetSellerWishlistsStats($userId);
  $response['count_sellers'] = $db->GetSellersStats();
  $response['err']=0;
}
echo json_encode($response);
?>
