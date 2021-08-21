<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if(isset($_SESSION['userId'])){
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$roleId = $usr->roleId;
	$userId = $usr->userId;
	switch ($roleId) {
		case 2:
			$res_con = $client->request('GET', DIR_CONT.DIR_USR.'CON_buyer_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;
		case 3:
			$res_con = $client->request('GET', DIR_CONT.DIR_USR.'CON_seller_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;

		default:
			$res_con = $client->request('GET', DIR_CONT.DIR_USR.'CON_buyer_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;
	}
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
$data = json_decode($res_con->getBody());
if($data){
  foreach ($data->contactlist as $user) {
    if($user->fullname!=Null) $username=$user->fullname;
    elseif($user->email!=Null) $username=$user->email;
    elseif($user->otp!=Null) $username=$user->otp;
		if ($user->profile_pic!=null) {
				$profile = '<img src="'.$user->profile_pic.'" alt="">';
		} else {
			$profile = '<span class="kt-badge kt-badge--xl kt-badge--brand">'.substr($username, 0, 2).'</span>';
		}
    echo '<div class="col-xl-2"><div class="kt-portlet kt-portlet--height-fluid" style="height: 140px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img kt-hidden" src="assets/media/users/default.jpg" alt="image"><div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest">'.$profile.'</div></div><div class="kt-widget__content"><div class="kt-widget__section"> <a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$user->userId.'" class="kt-widget__username">'.$username.'</a></div></div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
 ?>
