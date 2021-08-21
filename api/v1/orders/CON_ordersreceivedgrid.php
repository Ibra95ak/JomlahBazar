<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
// $url = DIR_JSON.'Read.php?jsonname=products.json';
// if(isset($_GET['active'])) $url .= '&query[active]='.$_GET['active'];
// if(isset($_GET['generalSearch'])) $url .= '&query[generalSearch]='.$_GET['generalSearch'];
$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
$usr = json_decode($res_uid->getBody());
$userId = $usr->userId;
if (!isset($_GET['from'])) {
    $_GET['from'] = date("Y/m/d",strtotime("-3 month"));
}
if (!isset($_GET['to'])) {
    $_GET['to'] = date("Y/m/d");
}
$res_orders_details = $client->request('GET', DIR_CONT . DIR_ORD . 'CON_Orders.php?action=seller_orders&userId=' . $userId . '&from=' . $_GET['from'] . '&to=' . $_GET['to']);
$orderDetails = json_decode($res_orders_details->getBody());
 ?>
     <div class="tab-content">
     <div class="tab-pane active" id="kt_tabs_2_1" role="tabpanel">
       <div class="row">
     <?php
     if ($orderDetails) {
        foreach ($orderDetails as $detail) {
          print_r($detail);
          echo '<div class="col-xl-3"><div class="kt-portlet kt-portlet--height-fluid"><div class="kt-portlet__head kt-portlet__head--noborder"><div class="kt-portlet__head-label"><h3 class="kt-portlet__head-title"></h3></div><div class="kt-portlet__head-toolbar"> <a href="#" class="btn btn-clean btn-icon" data-toggle="dropdown"> <i class="flaticon-more-1"></i> </a><div class="dropdown-menu dropdown-menu-right"><ul class="kt-nav"><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-line-chart"></i> <span class="kt-nav__link-text">Reports</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-send"></i> <span class="kt-nav__link-text">Messages</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i> <span class="kt-nav__link-text">Charts</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-avatar"></i> <span class="kt-nav__link-text">Members</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-settings"></i> <span class="kt-nav__link-text">Settings</span> </a></li></ul></div></div></div><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img" src="'.$detail->path.'" alt="image"></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="#" class="kt-widget__username">'.$detail->name.'</a><div class="kt-widget__button"> <span class="btn btn-label-warning btn-sm">Active</span></div><div class="kt-widget__action"> <a href="#" class="btn btn-icon btn-circle btn-label-facebook"> <i class="socicon-facebook"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-twitter"> <i class="socicon-twitter"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-linkedin"> <i class="socicon-linkedin"></i> </a></div></div></div></div></div></div></div></div>';
        }
      }else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
    ?>
    </div>
     </div>
     <div class="tab-pane" id="kt_tabs_2_2" role="tabpanel">
       <div class="row">
     <?php if (is_array($ordersArray['opened']) || is_object($ordersArray['opened'])) {
    foreach ($ordersArray['opened'] as $detail) {
      echo '<div class="col-xl-3"><div class="kt-portlet kt-portlet--height-fluid"><div class="kt-portlet__head kt-portlet__head--noborder"><div class="kt-portlet__head-label"><h3 class="kt-portlet__head-title"></h3></div><div class="kt-portlet__head-toolbar"> <a href="#" class="btn btn-clean btn-icon" data-toggle="dropdown"> <i class="flaticon-more-1"></i> </a><div class="dropdown-menu dropdown-menu-right"><ul class="kt-nav"><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-line-chart"></i> <span class="kt-nav__link-text">Reports</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-send"></i> <span class="kt-nav__link-text">Messages</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i> <span class="kt-nav__link-text">Charts</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-avatar"></i> <span class="kt-nav__link-text">Members</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-settings"></i> <span class="kt-nav__link-text">Settings</span> </a></li></ul></div></div></div><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img" src="'.$detail->path.'" alt="image"></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="#" class="kt-widget__username">'.$detail->name.'</a><div class="kt-widget__button"> <span class="btn btn-label-warning btn-sm">Active</span></div><div class="kt-widget__action"> <a href="#" class="btn btn-icon btn-circle btn-label-facebook"> <i class="socicon-facebook"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-twitter"> <i class="socicon-twitter"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-linkedin"> <i class="socicon-linkedin"></i> </a></div></div></div></div></div></div></div></div>';
    }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
?>
     </div>
     </div>
     <div class="tab-pane" id="kt_tabs_2_3" role="tabpanel">
       <div class="row">
     <?php if (is_array($ordersArray['cancelled']) || is_object($ordersArray['cancelled'])) {
    foreach ($ordersArray['cancelled'] as $detail) {
      echo '<div class="col-xl-3"><div class="kt-portlet kt-portlet--height-fluid"><div class="kt-portlet__head kt-portlet__head--noborder"><div class="kt-portlet__head-label"><h3 class="kt-portlet__head-title"></h3></div><div class="kt-portlet__head-toolbar"> <a href="#" class="btn btn-clean btn-icon" data-toggle="dropdown"> <i class="flaticon-more-1"></i> </a><div class="dropdown-menu dropdown-menu-right"><ul class="kt-nav"><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-line-chart"></i> <span class="kt-nav__link-text">Reports</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-send"></i> <span class="kt-nav__link-text">Messages</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i> <span class="kt-nav__link-text">Charts</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-avatar"></i> <span class="kt-nav__link-text">Members</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-settings"></i> <span class="kt-nav__link-text">Settings</span> </a></li></ul></div></div></div><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img" src="'.$detail->path.'" alt="image"></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="#" class="kt-widget__username">'.$detail->name.'</a><div class="kt-widget__button"> <span class="btn btn-label-warning btn-sm">Active</span></div><div class="kt-widget__action"> <a href="#" class="btn btn-icon btn-circle btn-label-facebook"> <i class="socicon-facebook"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-twitter"> <i class="socicon-twitter"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-linkedin"> <i class="socicon-linkedin"></i> </a></div></div></div></div></div></div></div></div>';
    }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
?>
     </div>
     </div>
     <div class="tab-pane" id="kt_tabs_2_4" role="tabpanel">
       <div class="row">
     <?php if (is_array($ordersArray['completed']) || is_object($ordersArray['completed'])) {
    foreach ($ordersArray['completed'] as $detail) {
      echo '<div class="col-xl-3"><div class="kt-portlet kt-portlet--height-fluid"><div class="kt-portlet__head kt-portlet__head--noborder"><div class="kt-portlet__head-label"><h3 class="kt-portlet__head-title"></h3></div><div class="kt-portlet__head-toolbar"> <a href="#" class="btn btn-clean btn-icon" data-toggle="dropdown"> <i class="flaticon-more-1"></i> </a><div class="dropdown-menu dropdown-menu-right"><ul class="kt-nav"><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-line-chart"></i> <span class="kt-nav__link-text">Reports</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-send"></i> <span class="kt-nav__link-text">Messages</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i> <span class="kt-nav__link-text">Charts</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-avatar"></i> <span class="kt-nav__link-text">Members</span> </a></li><li class="kt-nav__item"> <a href="#" class="kt-nav__link"> <i class="kt-nav__link-icon flaticon2-settings"></i> <span class="kt-nav__link-text">Settings</span> </a></li></ul></div></div></div><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img" src="'.$detail->path.'" alt="image"></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="#" class="kt-widget__username">'.$detail->name.'</a><div class="kt-widget__button"> <span class="btn btn-label-warning btn-sm">Active</span></div><div class="kt-widget__action"> <a href="#" class="btn btn-icon btn-circle btn-label-facebook"> <i class="socicon-facebook"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-twitter"> <i class="socicon-twitter"></i> </a> <a href="#" class="btn btn-icon btn-circle btn-label-linkedin"> <i class="socicon-linkedin"></i> </a></div></div></div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';?>
     </div>
     </div>
     </div>
