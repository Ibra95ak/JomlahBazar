<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
// $url = DIR_JSON.'Read.php?jsonname=products.json';
// if(isset($_GET['active'])) $url .= '&query[active]='.$_GET['active'];
// if(isset($_GET['generalSearch'])) $url .= '&query[generalSearch]='.$_GET['generalSearch'];
$res_pro = $client->request('GET', DIR_CONT.DIR_PRO.'CON_productsuppliers.php?action=getpro&supplierId='.$_GET['supplierId']);/*fetch user info*/
$data = json_decode($res_pro->getBody());
if($data){
  foreach ($data as $product) {
    echo '<div class="col-xl-3"><div class="kt-portlet kt-portlet--height-fluid"><div class="kt-portlet__head kt-portlet__head--noborder"><div class="kt-portlet__head-label"><h3 class="kt-portlet__head-title"></h3></div><div class="kt-portlet__head-toolbar"> <a href="#" class="btn btn-clean btn-icon" data-toggle="dropdown"> <i class="flaticon-more-1"></i> </a><div class="dropdown-menu dropdown-menu-right"><ul class="kt-nav"><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-line-chart"></i> <span class="kt-nav__link-text">Reports</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-send"></i> <span class="kt-nav__link-text">Messages</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i> <span class="kt-nav__link-text">Charts</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-avatar"></i> <span class="kt-nav__link-text">Members</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-settings"></i> <span class="kt-nav__link-text">Settings</span> </a></li></ul></div></div></div><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img" src="'.$product->path.'" alt="image"></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="#" class="kt-widget__username">'.$product->name.'</a><div class="kt-widget__button"> <span class="btn btn-label-warning btn-sm">Active</span></div><div class="kt-widget__action"> <a href="#" class="btn btn-icon btn-circle btn-label-facebook"> <i class="socicon-facebook"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-twitter"> <i class="socicon-twitter"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-linkedin"> <i class="socicon-linkedin"></i> </a></div></div></div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
 ?>
