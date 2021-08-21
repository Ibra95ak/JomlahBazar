<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if(isset($_SESSION['userId'])){
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$roleId = $usr->roleId;
	$userId = $usr->userId;
	switch ($_SESSION['Login_as']) {
		case 1:
			include("../".DIR_CON."header_buyer.php");
			$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_buyer_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;
		case 2:
			include("../".DIR_CON."header_supplier.php");
			$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_seller_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;

		default:
			include("../".DIR_CON."CON_buyer_profile.php");
			$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_buyer_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;
	}
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
$user = json_decode($res_user->getBody());
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
  <div class="row">
    <div class="col-md-6">
      <div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													My Contact List
												</h3>
											</div>
                      <div class="kt-portlet__head-toolbar">
											<div class="kt-portlet__head-wrapper">
												<div class="btn-group btn-group" role="group" aria-label="...">
																<button id="btn-dt" type="button" class="btn btn-secondary"><i class="fa fa-list"></i></button>
																<button id="btn-gd" type="button" class="btn btn-secondary"><i class="fa fa-th"></i></button>
																<button id="btn-map-contacts" type="button" class="btn btn-secondary"><i class="fa fa-globe"></i></button>
															</div>
											</div>
										</div>
										</div>

										<!--begin::Form-->
                    <div id="kt_gmap_c"></div>
											<div id="rec-dt" class="kt-portlet__body">
												<div class="kt-section kt-section--first">
                          <div class="kt-widget4">
        <?php
        if ($user->contactlist) {
          foreach ($user->contactlist as $contact) {
              $username='';
              if ($contact->fullname!='') {
                  $username=$contact->fullname;
              } elseif ($contact->email!='') {
                  $username=$contact->email;
              } elseif ($contact->otp!='') {
                  $username=$contact->otp;
              }
              echo '<div class="kt-widget4__item">';
              echo '<div class="kt-widget4__pic kt-widget4__pic--pic">';
              if ($contact->profile_pic!=null) {
                  echo '<img src="'.$contact->profile_pic.'" alt="">';
              } else {
                  echo '<span class="kt-badge kt-badge--xl kt-badge--brand">'.substr($username, 0, 2).'</span>';
              }
              echo '</div>';
              echo '<div class="kt-widget4__info">';
              echo '<a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$contact->userId.'" class="kt-widget4__username">'.$username.'</a>';
              echo '<p class="kt-widget4__text">'.$contact->nationality.'</p>';
              echo '</div>';
              echo '<div class="kt-widget__action">';
              if (isset($contact->phone) && $contact->phone!=null) {
                  echo '<a href="tel:'.$contact->phone.'" class="btn btn-icon btn-circle btn-label-info" target="_blank"><i class="fa fa-phone"></i></a>';
              }
              if (isset($contact->whatsapp) && $contact->whatsapp!=null) {
                  echo '<a href="https://wa.me/'.$contact->whatsapp.'?text=Im%20interested%20in%20your%20products" class="btn btn-icon btn-circle btn-label-success"  target="_blank"><i class="fab fa-whatsapp "></i></a>';
              }
              if (isset($contact->telegram) && $contact->telegram!=null) {
                  echo '<a href="https://t.me/'.$contact->telegram.'" class="btn btn-icon btn-circle btn-label-brand" target="_blank"><i class="fab fa-telegram-plane"></i></a>';
              }
              if (isset($contact->messenger) && $contact->messenger!=null) {
                  echo '<a href="https://m.me/'.$contact->messenger.'" class="btn btn-icon btn-circle btn-label-facebook" target="_blank"><i class="fab fa-facebook-messenger"></i></a>';
              }
              if (isset($contact->linkedin) && $contact->linkedin!=null) {
                  echo '<a href="linkedin:'.$contact->linkedin.'" class="btn btn-icon btn-circle btn-label-linkedin" target="_blank"><i class="fab fa-linkedin"></i></a>';
              }
              if (isset($contact->sms) && $contact->sms!=null) {
                  echo '<a href="sms:'.$contact->sms.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="fa fa-sms"></i></a>';
              }
              echo '</div></div>';
          }
        }

         ?>
													</div>
                        </div>
											</div>
                      <div class="row align-items-center" id="rec-gd" style="display:none"></div>
										<!--end::Form-->
									</div>
    </div>
  </div>
	<!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script id="uid" src="assets\js\pages\custom\user\contactlist.js?userId=<?php echo $userId?>" type="text/javascript"></script>
