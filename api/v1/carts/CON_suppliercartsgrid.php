<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
$url = DIR_CONT.DIR_CAR.'CON_carts.php?action=get-sup';
if(isset($_GET['generalSearch'])) $url .= '&generalSearch='.$_GET['generalSearch'];
if(isset($_GET['userId'])) $url .= '&userId='.$_GET['userId'];
$res_sup = $client->request('GET', $url);/*fetch user info*/
$data = json_decode($res_sup->getBody());
if($data){
  foreach ($data as $product) {
    echo '<div class="col-xl-2"><div class="kt-portlet kt-portlet--height-fluid" style="height: 140px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img" src="'.$product->path.'" alt="image"></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="storedetails.php?userId='.$product->productId.'" class="kt-widget__username">'.$product->name.'</a></div></div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
 ?>
