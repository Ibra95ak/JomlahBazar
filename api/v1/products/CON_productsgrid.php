<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
$url = DIR_JSON.'Read.php?jsonname=products.json';
if(isset($_GET['active'])) $url .= '&query[active]='.$_GET['active'];
if(isset($_GET['generalSearch'])) $url .= '&query[generalSearch]='.$_GET['generalSearch'];
$res_products = $client->request('GET', $url);/*fetch userId*/
$data = json_decode($res_products->getBody());
if($data->data){
  foreach ($data->data as $product) {
    echo '<div class="col-xl-3"><div class="kt-portlet kt-portlet--height-fluid"><div class="kt-portlet__head kt-portlet__head--noborder"><div class="kt-portlet__head-label"><h3 class="kt-portlet__head-title"></h3></div></div><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img kt-hidden" src="assets/media/users/default.jpg" alt="image"><div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest">'.substr($product->product_name,0,2).'</div></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="#" class="kt-widget__username">'.$product->product_name.'</a><div class="kt-widget__button"> <span class="btn btn-label-warning btn-sm">Active</span></div></div></div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
 ?>
