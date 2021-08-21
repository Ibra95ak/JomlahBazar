<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
$url = DIR_CONT.DIR_USR.'CON_users.php?action=get';
if(isset($_GET['brandId'])) $url .= '&query[brandId]='.$_GET['brandId'];
if(isset($_GET['categoryId'])) $url .= '&query[categoryId]='.$_GET['categoryId'];
if(isset($_GET['city'])) $url .= '&query[city]='.$_GET['city'];
if(isset($_GET['companyId'])) $url .= '&query[companyId]='.$_GET['companyId'];
if(isset($_GET['generalSearch'])) $url .= '&query[generalSearch]='.$_GET['generalSearch'];
$res_user = $client->request('GET', $url);
$data = json_decode($res_user->getBody());
if($data){
  foreach ($data as $user) {
    if($user->fullname!=Null) $username=$user->fullname;
    elseif($user->email!=Null) $username=$user->email;
    elseif($user->otp!=Null) $username=$user->otp;

    echo '<div class="col-xl-2"><div class="kt-portlet kt-portlet--height-fluid" style="height: 140px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img kt-hidden" src="assets/media/users/default.jpg" alt="image"><div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest">'.substr($username,0,2).'</div></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="storedetails.php?userId='.$user->userId.'" class="kt-widget__username">'.$username.'</a></div></div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
 ?>
