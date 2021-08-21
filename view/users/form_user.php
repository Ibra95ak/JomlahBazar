<?php
session_start();/*start browser session*/
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
			break;
		case 2:
			include("../".DIR_CON."header_supplier.php");
			break;

		default:
			include("../".DIR_CON."header_buyer.php");
			break;
	}
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
/*url parameters*/
$res_roles = $client->request('GET', DIR_JSON.'Read.php?jsonname=roles.json');/*fetch all roles*/
$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_user_profile.php?action=get&userId='.$userId);/*fetch user info*/
$roles=json_decode($res_roles->getBody());
/*Fetch user info*/
$user = json_decode($res_user->getBody());
if ($user->info) {
    $userId = $user->info[0]->userId;
    $fullname = $user->info[0]->fullname;
    $email = $user->info[0]->email;
    $otp = $user->info[0]->otp;
    $roleId = $user->info[0]->roleId;
} else {
    $userId = 0;
    $fullname = '';
    $email = '';
    $otp = '';
    $roleId = '';
}
if ($user->address) {
    $ipaddress = $user->address[0]->ipaddress;
    $address1 = $user->address[0]->address1;
    $address2 = $user->address[0]->address2;
    $city = $user->address[0]->city;
    $state = $user->address[0]->state;
    $postalcode = $user->address[0]->postalcode;
    $country = $user->address[0]->country;
    $latitude = $user->address[0]->latitude;
    $longitude = $user->address[0]->longitude;
} else {
    $ipaddress = '';
    $address1 = '';
    $address2 = '';
    $city = '';
    $state = '';
    $postalcode = '';
    $country = '';
    $latitude = '';
    $longitude = '';
}
if ($user->reachout) {
    $reachoutId = $user->reachout[0]->reachoutId;
    $phone = $user->reachout[0]->phone;
    $whatsapp = $user->reachout[0]->whatsapp;
    $telegram = $user->reachout[0]->telegram;
    $messenger = $user->reachout[0]->messenger;
    $linkedin = $user->reachout[0]->linkedin;
    $sms = $user->reachout[0]->sms;
    $facebook = $user->reachout[0]->facebook;
    $instagram = $user->reachout[0]->instagram;
    $teams = $user->reachout[0]->teams;
    $zoom = $user->reachout[0]->zoom;
} else {
    $reachoutId = 0;
    $phone = '';
    $whatsapp = '';
    $telegram = '';
    $messenger = '';
    $linkedin = '';
    $sms = '';
}
if ($user->company) {
    $companyname=$user->company[0]->companyname;
    $profile_pic=$user->company[0]->profile_pic;
} else {
    $companyname='';
    $profile_pic='assets/media/stores/default.png';
}
if ($user->categories) {
    $sel_categories=array();
    foreach ($user->categories as $category) {
        array_push($sel_categories, $category->categoryId);
    }
} else {
    $sel_categories=array();
}
if ($user->brands) {
    $sel_brands=array();
    foreach ($user->brands as $brand) {
        array_push($sel_brands, $brand->brandId);
    }
} else {
    $sel_brands=array();
}
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->

	<div class="kt-portlet">
		<div class="kt-portlet__body kt-portlet__body--fit">
			<div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="first">
				<div class="kt-grid__item kt-wizard-v2__aside">

					<!--begin: Form Wizard Nav -->
					<div class="kt-wizard-v2__nav">
													<!--doc: Remove "kt-wizard-v2__nav-items clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
													<div class="kt-wizard-v2__nav-items kt-wizard-v2__nav-items--clickable">
														<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-globe"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		Marketing Profile
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		Setup Your Account Details
																	</div>
																</div>
															</div>
														</div>
														<div class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="pending">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-network"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		Social Accounts
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		Add Your Social Accounts
																	</div>
																</div>
															</div>
														</div>
														<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-responsive"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		Devices
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		Review your trusted devices.
																	</div>
																</div>
															</div>
														</div>
														<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon2-group"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		My Contact list
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		Review my contacts.
																	</div>
																</div>
															</div>
														</div>
														<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-confetti"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		Company Profile Review!
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		Review and Submit
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<!--end: Form Wizard Nav -->
											</div>
											<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">

												<!--begin: Form Wizard Form-->
												<form class="kt-form" id="kt_form" novalidate="novalidate">
													<input type="hidden" class="form-control" name="userId" id="userId" value="<?php echo $userId;?>">
													<!--begin: Form Wizard Step 1-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
														<div class="kt-heading kt-heading--md">Enter Salesman Details</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v2__form">
																<div class="form-group">
																	<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" value="<?php echo $fullname;?>" required>
																	<span class="form-text text-muted">Please enter your fullname name.</span>
																</div>
																<div class="form-group">
																	<input type="tel" class="form-control" name="otp" id="otp" placeholder="Phone" value="<?php echo $otp;?>"  required>
																	<span class="form-text text-muted">Please enter your phone number.</span>
																</div>
																<div class="form-group">
																	<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email;?>">
																	<span class="form-text text-muted">Please enter your email address.</span>
																</div>
																<div class="form-group kt-hidden">
																	<select class="form-control" name="roleId" id="roleId" required>
																		<option>Choose your role</option>
																		<?php
            foreach ($roles->data as $role) {
                if ($role->roleId==$roleId) {
                    echo '<option value="'.$role->roleId.'" selected>'.$role->role.'</option>';
                } else {
                    echo '<option value="'.$role->roleId.'">'.$role->role.'</option>';
                }
            }
            ?>
																	</select>
																	<span class="form-text text-muted">Please select your role.</span>
																</div>
																<div class="form-group kt-hidden">
																	<label class="kt-checkbox kt-checkbox--solid">
																		<input type="checkbox" name="activate" id="activate"> Activate user
																		<span></span>
																	</label>
																</div>
															</div>
														</div>
													</div>
													<!--end: Form Wizard Step 1-->

													<!--begin: Form Wizard Step 3-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">My Social Account Details</div>
														<div class="kt-form__section kt-form__section--first">
															<input type="hidden" class="form-control" name="reachoutId" id="reachoutId" value="<?php echo $reachoutId?>">
															<div class="kt-wizard-v2__form">
															<div class="row safari-row-flex">
																<div class="col-xl-6">
																	<div class="form-group ">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="socicon-viber"></i></span></div>
																			<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" aria-describedby="basic-addon1" value="<?php echo $phone?>">
																		</div>
																		</div>
																	</div>

																<div class="col-xl-6">
																	<div class="form-group ">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="socicon-whatsapp"></i></span></div>
																			<input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Whatsapp" aria-describedby="basic-addon1" value="<?php echo $whatsapp?>">
																		</div>
																	</div>
															</div>
															</div>

														<div class="row safari-row-flex">

															<div class="col-xl-6">
																<div class="form-group ">
																	<div class="input-group">
																		<div class="input-group-prepend"><span class="input-group-text"><i class="socicon-telegram"></i></span></div>
																		<input type="text" class="form-control" name="telegram" id="telegram" placeholder="Telegram" aria-describedby="basic-addon1" value="<?php echo $telegram?>">
																	</div>
																</div>
															</div>

															<div class="col-xl-6">
																<div class="form-group ">
																	<div class="input-group">
																		<div class="input-group-prepend"><span class="input-group-text"><i class="socicon-telegram"></i></span></div>
																		<input type="text" class="form-control" name="messenger" id="messenger" placeholder="Messenger" aria-describedby="basic-addon1" value="<?php echo $messenger?>">
																	</div>
																</div>
															</div>

														</div>

														<div class="row safari-row-flex">

															<div class="col-xl-6">
																<div class="form-group ">
																	<div class="input-group">
																		<div class="input-group-prepend"><span class="input-group-text"><i class="socicon-linkedin"></i></span></div>
																		<input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="linkedin" aria-describedby="basic-addon1" value="<?php echo $linkedin?>">
																	</div>
																</div>
															</div>

															<div class="col-xl-6">
																<div class="form-group ">
																	<div class="input-group">
																		<div class="input-group-prepend"><span class="input-group-text"><i class="socicon-telegram"></i></span></div>
																		<input type="text" class="form-control" name="sms" id="sms" placeholder="SMS" aria-describedby="basic-addon1" value="<?php echo $sms?>">
																	</div>
																</div>
															</div>
														</div>

														<div class="row safari-row-flex">

															<div class="col-xl-6">
																<div class="form-group ">
																	<div class="input-group">
																		<div class="input-group-prepend"><span class="input-group-text"><i class="socicon-facebook"></i></span></div>
																		<input type="text" class="form-control" name="facebook" id="facebook" placeholder="facebook" aria-describedby="basic-addon1" value="<?php echo $facebook?>">
																	</div>
																</div>
															</div>

															<div class="col-xl-6">
																<div class="form-group ">
																	<div class="input-group">
																		<div class="input-group-prepend"><span class="input-group-text"><i class="socicon-instagram"></i></span></div>
																		<input type="text" class="form-control" name="instagram" id="instagram" placeholder="instagram" aria-describedby="basic-addon1" value="<?php echo $instagram?>">
																	</div>
																</div>
															</div>
														</div>

														<div class="row safari-row-flex">

															<div class="col-xl-6">
																<div class="form-group ">
																	<div class="input-group">
																		<div class="input-group-prepend"><span class="input-group-text"><img src="<?php echo DIR_ROOT.DIR_ICON;?>teams.png" style="width: 24px;"/></span></div>
																		<input type="text" class="form-control" name="teams" id="teams" placeholder="teams" aria-describedby="basic-addon1" value="<?php echo $teams?>">
																	</div>
																</div>
															</div>

															<div class="col-xl-6">
																<div class="form-group ">
																	<div class="input-group">
																		<div class="input-group-prepend"><span class="input-group-text"><img src="<?php echo DIR_ROOT.DIR_ICON;?>zoom.ico" style="width: 24px;"/></span></div>
																		<input type="text" class="form-control" name="zoom" id="zoom" placeholder="zoom" aria-describedby="basic-addon1" value="<?php echo $zoom?>">
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>

													<!--end: Form Wizard Step 3-->
													<!--begin: Form Wizard Step 4-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">My Devices</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-section">
												<div class="kt-section__content">
													<table class="table table-light table-responsive">
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
              }
            }

            ?>
														</tbody>
													</table>
												</div>
											</div>
												</div>
											</div>

													<!--end: Form Wizard Step 4-->
													<!--begin: Form Wizard Step 5-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">My Contact list</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-section">
												<div class="kt-section__content">
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
              echo '<a href="#" class="kt-widget4__username">'.$username.'</a>';
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
												</div>
											</div>

													<!--end: Form Wizard Step 5-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Review your Details and Submit</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v2__review kt-font-dark">
																<div class="kt-wizard-v2__review-item">
																	<div class="kt-wizard-v2__review-title">
																		Account Details
																	</div>
																	<div class="kt-wizard-v2__review-content">
																		<span id="l_fullname"></span><br>
																		Phone: <span id="l_otp"></span><br>
																		Email: <span id="l_email"></span><br>
																		Role: <span id="l_roleId"></span>
																	</div>
																</div>
																<div class="kt-wizard-v2__review-item">
																	<div class="kt-wizard-v2__review-title">
																		Support Channels
																	</div>
																	<div class="kt-wizard-v2__review-content">
																		Phone: <span id="l_phone"></span><br>
																		Whatsapp: <span id="l_whatsapp"></span><br>
																		Telegram: <span id="l_telegram"></span><br>
																		Messenger: <span id="l_messenger"></span><br>
																		linkedin: <span id="l_linkedin"></span><br>
																		SMS: <span id="l_sms"></span>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<!--end: Form Wizard Step 6-->

													<!--begin: Form Actions -->
													<div class="kt-form__actions">
														<button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
															Previous
														</button>
														<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
															Submit
														</button>
														<button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
															Next Step
														</button>
													</div>

													<!--end: Form Actions -->
												</form>

												<!--end: Form Wizard Form-->
											</div>
										</div>
									</div>
								</div>
							</div>
            </div>
					</div>

					<!--end: Form Wizard Nav -->
				</div>
      </div>
		</div>
	</div>
	<!-- end:: Content -->
</div>
<!-- end:: Page -->
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/pages/custom/wizard/wizard-2.js" type="text/javascript"></script>
<script>
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
			alert("Geolocation is not supported by this browser.");
		}
	}

	function showPosition(position) {
		document.getElementById('latitude').value = position.coords.latitude;
		document.getElementById('longitude').value = position.coords.longitude;
	}

	function deletedevice(deviceId) {
		location.href = DIR_CONT+DIR_USR+"CON_userdevices.php?action=delete&deviceId=" + deviceId;
	}
</script>
		<!--end::Page Scripts -->
	</body>
	<!-- end::Body -->
</html>
