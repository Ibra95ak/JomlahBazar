<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
// $url = DIR_JSON.'Read.php?jsonname=users.json';
// if(isset($_GET['roleId'])) $url .= '&query[roleId]='.$_GET['roleId'];
// if(isset($_GET['login'])) $url .= '&query[login]='.$_GET['login'];
// if(isset($_GET['generalSearch'])) $url .= '&query[generalSearch]='.$_GET['generalSearch'];
$res_con = $client->request('GET', DIR_CONT.DIR_USR.'CON_user_profile.php?action=get&userId=1');/*fetch user info*/
$data = json_decode($res_con->getBody());
if($data){
  foreach ($data->contactlist as $user) {
    if($user->fullname!=Null) $username=$user->fullname;
    elseif($user->email!=Null) $username=$user->email;
    elseif($user->otp!=Null) $username=$user->otp;
    echo '<div class="col-xl-2"><div class="kt-portlet kt-portlet--height-fluid" style="height: 140px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img kt-hidden" src="assets/media/users/default.jpg" alt="image"><div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest">'.substr($username,0,2).'</div></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="#" class="kt-widget__username">'.$username.'</a></div></div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
 ?>
