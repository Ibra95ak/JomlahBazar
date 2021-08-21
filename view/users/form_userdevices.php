<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if(isset($_SESSION['userId'])){
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$roleId = $usr->roleId;
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
			include("../".DIR_CON."header_buyer.php");
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
													Basic Form Layout
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form">
											<div class="kt-portlet__body">
												<div class="kt-section kt-section--first">
                          <table class="table table-light">
														<thead>
															<tr>
																<th>#</th>
																<th>Device type</th>
																<th>Operating system</th>
																<th>Browser</th>
																<th>IP address</th>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
            <?php
            if ($user->devices) {
              $counter=0;
              foreach ($user->devices as $device) {
                  $counter++;
                  echo '<tr>';
                  echo '<th scope="row">'.$counter.'</th>';
                  echo '<td>'.$device->type.'</td>';
                  echo '<td>'.$device->os.', '.$device->os_version.', '.$device->os_platform.'</td>';
                  echo '<td>'.$device->browser.', '.$device->browser_version.', '.$device->browser_engine.'</td>';
                  echo '<td>'.$device->ipaddress.'</td>';
                  echo '<td><button type="button" class="btn btn-danger btn-icon"><i class="fa fa-trash-alt" onclick="deletedevice('.$device->deviceId.')"></i></button></td>';
									echo '</tr>';
              }
            }else {
							echo '<tr>';
							echo '<td>You have no trusted devices!</td>';
							echo '</tr>';
            }

            ?>
														</tbody>
													</table>
                        </div>
											</div>
										</form>
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
