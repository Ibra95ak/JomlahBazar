<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
$res_user = $client->request('GET',DIR_CONT.DIR_ADMN.'CON_users.php?action=get&userId='.$_GET['id']);
$user = json_decode($res_user->getBody());
include("../" . DIR_CON . "header_admin.php");
if($user->info){
	$profile_pic=$user->info[0]->profile_pic;
	$fullname=$user->info[0]->fullname;
	$email=$user->info[0]->email;
	$otp=$user->info[0]->otp;
	$nationality=$user->info[0]->Nationality;
	$active=$user->info[0]->active;
	$googlesub=$user->info[0]->googlesub;
	$linkedinidentifier=$user->info[0]->linkedinidentifier;
	if ($googlesub) $con_google="Connected";
	else $con_google="Not Connected";
	if ($linkedinidentifier) $con_linkedin="Connected";
	else $con_linkedin="Not Connected";
	if($profile_pic){
		$display_img = '';
		$display_nm = 'kt-hidden';
	}else {
		$display_img = 'kt-hidden';
		$display_nm = '';
	}
	if($active){
		$activate = 'Activate';
		$activate_color = 'btn-success';
	}else {
		$activate = 'Deactivate';
		$activate_color = 'btn-danger';
	}
}else {
	$profile_pic='';
	$fullname='';
	$email='';
	$otp='';
	$nationality='';
	$display_img = 'kt-hidden';
	$display_nm = 'kt-hidden';
	$activate = 'Activate';
	$activate_color = 'btn-success';
	$con_google="Not Connected";
	$con_linkedin="Not Connected";
}
if ($user->reachouts) {
	$phone=$user->reachouts[0]->phone;
	$whatsapp=$user->reachouts[0]->whatsapp;
	$telegram=$user->reachouts[0]->telegram;
	$messenger=$user->reachouts[0]->messenger;
	$linkedin=$user->reachouts[0]->linkedin;
	$sms=$user->reachouts[0]->sms;
	$facebook=$user->reachouts[0]->facebook;
	$instagram=$user->reachouts[0]->instagram;
	$teams=$user->reachouts[0]->teams;
	$zoom=$user->reachouts[0]->zoom;
}else {
	$phone='';
	$whatsapp='';
	$telegram='';
	$messenger='';
	$linkedin='';
	$sms='';
	$facebook='';
	$instagram='';
	$teams='';
	$zoom='';
}
if ($user->company) {
	$companyname=$user->company[0]->companyname;
	$companyprofile=$user->company[0]->profile_pic;
}else {
	$companyname='';
	$companyprofile='';
}
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<!--Begin::Section-->
							<div class="row">
								<div class="col-xl-12">
									<!--begin:: Widgets/Applications/User/Profile3-->
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__body">
											<div class="kt-widget kt-widget--user-profile-3">
												<div class="kt-widget__top">
													<div class="kt-widget__media <?php echo $display_img;?>">
														<img src="<?php echo DIR_ROOT.$profile_pic?>" alt="image">
													</div>
													<div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light <?php echo $display_nm;?>">
														<?php echo substr($fullname,0,2);?>
													</div>
													<div class="kt-widget__content">
														<div class="kt-widget__head">
															<a href="#" class="kt-widget__username">
																<?php echo $fullname;?>
															</a>
															<div class="kt-widget__action">
																<button type="button" class="btn btn-label-brand btn-sm btn-upper" id="edit_usr">Edit</button>&nbsp;
																<button type="button" class="btn <?php echo $activate_color;?> btn-sm btn-upper"><?php echo $activate;?></button>
																<button type="button" class="btn btn-danger btn-sm btn-upper">Block</button>
															</div>
														</div>
														<div class="kt-widget__subhead">
															<a href="#"><i class="flaticon2-new-email"></i><?php echo $email;?></a>
															<a href="#"><i class="flaticon2-phone"></i><?php echo $otp;?></a>
															<a href="#"><i class="flaticon2-world"></i><?php echo $nationality;?></a>
														</div>
														<div class="kt-widget__info">
															<div class="kt-widget__desc">
																<div class="kt-notification-v2">
																	<a href="javascript:void(0)" class="kt-notification-v2__item">
																		<div class="kt-notification-v2__item-icon">
																			<i class="fab fa-google"></i>
																		</div>
																		<div class="kt-notification-v2__itek-wrapper">
																			<div class="kt-notification-v2__item-title">
																				<?php echo $con_google;?>
																			</div>
																		</div>
																	</a>
																	<a href="javascript:void(0)" class="kt-notification-v2__item">
																		<div class="kt-notification-v2__item-icon">
																			<i class="fab fa-linkedin-in"></i>
																		</div>
																		<div class="kt-notification-v2__itek-wrapper">
																			<div class="kt-notification-v2__item-title">
																				<?php echo $con_linkedin;?>
																			</div>
																		</div>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="kt-widget__bottom">
													<div class="kt-widget__item">
														<div class="kt-widget__icon">
															<i class="flaticon-piggy-bank"></i>
														</div>
														<div class="kt-widget__details">
															<span class="kt-widget__title">Earnings</span>
															<span class="kt-widget__value"><span>$</span>249,500</span>
														</div>
													</div>
													<div class="kt-widget__item">
														<div class="kt-widget__icon">
															<i class="flaticon-confetti"></i>
														</div>
														<div class="kt-widget__details">
															<span class="kt-widget__title">Expances</span>
															<span class="kt-widget__value"><span>$</span>164,700</span>
														</div>
													</div>
													<div class="kt-widget__item">
														<div class="kt-widget__icon">
															<i class="flaticon-pie-chart"></i>
														</div>
														<div class="kt-widget__details">
															<span class="kt-widget__title">Net</span>
															<span class="kt-widget__value"><span>$</span>164,700</span>
														</div>
													</div>
													<div class="kt-widget__item">
														<div class="kt-widget__icon">
															<i class="flaticon-file-2"></i>
														</div>
														<div class="kt-widget__details">
															<span class="kt-widget__title">73 Tasks</span>
															<a href="#" class="kt-widget__value kt-font-brand">View</a>
														</div>
													</div>
													<div class="kt-widget__item">
														<div class="kt-widget__icon">
															<i class="flaticon-chat-1"></i>
														</div>
														<div class="kt-widget__details">
															<span class="kt-widget__title">648 Comments</span>
															<a href="#" class="kt-widget__value kt-font-brand">View</a>
														</div>
													</div>
													<div class="kt-widget__item">
														<div class="kt-widget__icon">
															<i class="flaticon-network"></i>
														</div>
														<div class="kt-widget__details">
															<div class="kt-section__content kt-section__content--solid">
																<div class="kt-media-group">
																	<a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
																		<img src="assets/media/users/100_1.jpg" alt="image">
																	</a>
																	<a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Alison Brandy">
																		<img src="assets/media/users/100_10.jpg" alt="image">
																	</a>
																	<a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Selina Cranson">
																		<img src="assets/media/users/100_11.jpg" alt="image">
																	</a>
																	<a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Luke Walls">
																		<img src="assets/media/users/100_2.jpg" alt="image">
																	</a>
																	<a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
																		<img src="assets/media/users/100_3.jpg" alt="image">
																	</a>
																	<a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
																		<span>+3</span>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end:: Widgets/Applications/User/Profile3-->
								</div>
							</div>

							<!--End::Section-->
							<div class="row">
								<div class="col-md-8">
									<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">
															Addresses
														</h3>
													</div>
												</div>
												<div class="kt-portlet__body">

													<!--begin::Section-->
													<div class="kt-section">
														<div class="kt-section__content">
															<table class="table">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Address 1</th>
																		<th>Address 2</th>
																		<th>City</th>
																		<th>State</th>
																		<th>Postal code</th>
																		<th>Country</th>
																		<th>Latitude</th>
																		<th>Longitude</th>
																		<th>IP Address</th>
																		<th>Language</th>
																		<th>Default</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		if ($user->addresses) {
																			foreach ($user->addresses as $address) {
																				echo '<tr>';
																				echo '<th scope="row">'.$address->addressId.'</th>';
																				echo '<td>'.$address->address1.'</td>';
																				echo '<td>'.$address->address2.'</td>';
																				echo '<td>'.$address->city.'</td>';
																				echo '<td>'.$address->state.'</td>';
																				echo '<td>'.$address->postalcode.'</td>';
																				echo '<td>'.$address->country.'</td>';
																				echo '<td>'.$address->latitude.'</td>';
																				echo '<td>'.$address->longitude.'</td>';
																				echo '<td>'.$address->language.'</td>';
																				echo '<td>'.$address->ipaddress.'</td>';
																				echo '<td>'.$address->default_address.'</td>';
																				echo '</tr>';
																			}
																		}else{
																			echo '<tr><td>No address</td></tr>';
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
													<!--end::Section-->
												</div>
												<!--end::Form-->
											</div>
								</div>
								<div class="col-md-4">
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Reachouts
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">
											<!--begin::widget 12-->
											<div class="kt-widget4">
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="fa fa-phone kt-font-info"></i>
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														Phone
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $phone;?></span>
												</div>
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="fab fa-whatsapp kt-font-info"></i>
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														Whats App
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $whatsapp;?></span>
												</div>
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="fab fa-telegram kt-font-info"></i>
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														Telegram
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $telegram;?></span>
												</div>
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="fab fa-facebook-messenger kt-font-info"></i>
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														Messenger
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $messenger;?></span>
												</div>
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="fab fa-linkedin kt-font-info"></i>
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														Linkedin
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $linkedin;?></span>
												</div>
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="fa fa-sms kt-font-info"></i>
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														SMS
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $sms;?></span>
												</div>
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="fab fa-facebook kt-font-info"></i>
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														Facebook
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $facebook;?></span>
												</div>
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<i class="fab fa-instagram kt-font-info"></i>
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														Instagram
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $instagram;?></span>
												</div>
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<img src="<?php echo DIR_ROOT.DIR_ICON.'teams.png'?>" alt="">
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														Teams
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $teams;?></span>
												</div>
												<div class="kt-widget4__item">
													<span class="kt-widget4__icon">
														<img src="<?php echo DIR_ROOT.DIR_ICON.'zoom.ico'?>" alt="">
													</span>
													<a href="javascript:void(0)" class="kt-widget4__title kt-widget4__title--light">
														Zoom
													</a>
													<span class="kt-widget4__number kt-font-info"><?php echo $zoom;?></span>
												</div>
											</div>

											<!--end::Widget 12-->
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__head kt-portlet__head--noborder">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Company
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body kt-portlet__body--fit-y">
											<!--begin::Widget -->
											<div class="kt-widget kt-widget--user-profile-4">
												<div class="kt-widget__head">
													<div class="kt-widget__media">
														<img class="kt-widget__img kt-hidden-" src="<?php echo DIR_ROOT.$companyprofile;?>" alt="image">
													</div>
													<div class="kt-widget__content">
														<div class="kt-widget__section">
															<a href="javascript:void(0)" class="kt-widget__username">
																<?php echo $companyname;?>
															</a>
														</div>
													</div>
												</div>
											</div>

											<!--end::Widget -->
										</div>
									</div>
								</div>
								<div class="col-md-9">
										<div class="kt-portlet">
													<div class="kt-portlet__head">
														<div class="kt-portlet__head-label">
															<h3 class="kt-portlet__head-title">
																Devices
															</h3>
														</div>
													</div>
													<div class="kt-portlet__body">

														<!--begin::Section-->
														<div class="kt-section">
															<div class="kt-section__content">
																<table class="table">
																	<thead>
																		<tr>
																			<th>#</th>
																			<th>Type</th>
																			<th>OS</th>
																			<th>OS version</th>
																			<th>OS platform</th>
																			<th>Browser</th>
																			<th>Browser version</th>
																			<th>Browser engine</th>
																			<th>IP Address</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			if ($user->devices) {
																				foreach ($user->devices as $device) {
																					echo '<tr>';
																					echo '<th scope="row">'.$device->deviceId.'</th>';
																					echo '<td>'.$device->type.'</td>';
																					echo '<td>'.$device->os.'</td>';
																					echo '<td>'.$device->os_version.'</td>';
																					echo '<td>'.$device->os_platform.'</td>';
																					echo '<td>'.$device->browser.'</td>';
																					echo '<td>'.$device->browser_version.'</td>';
																					echo '<td>'.$device->browser_engine.'</td>';
																					echo '<td>'.$device->ipaddress.'</td>';
																					echo '</tr>';
																				}
																			}else{
																				echo '<tr><td>No address</td></tr>';
																			}
																		?>
																	</tbody>
																</table>
															</div>
														</div>
														<!--end::Section-->
													</div>
													<!--end::Form-->
												</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">
															Credit Cards
														</h3>
													</div>
												</div>
												<div class="kt-portlet__body">

													<!--begin::Section-->
													<div class="kt-section">
														<div class="kt-section__content">
															<table class="table">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Card Number</th>
																		<th>Name on Card</th>
																		<th>Card Expiry Date</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		if ($user->credit_cards) {
																			foreach ($user->credit_cards as $credit_card) {
																				echo '<tr>';
																				echo '<th scope="row">'.$credit_card->creditcardId.'</th>';
																				echo '<td>'.$credit_card->card_number.'</td>';
																				echo '<td>'.$credit_card->card_name.'</td>';
																				echo '<td>'.$credit_card->card_expiry.'</td>';
																				echo '</tr>';
																			}
																		}else{
																			echo '<tr><td>No address</td></tr>';
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
													<!--end::Section-->
												</div>
												<!--end::Form-->
											</div>
								</div>
								<div class="col-md-6">
									<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">
															Paypal Accounts
														</h3>
													</div>
												</div>
												<div class="kt-portlet__body">

													<!--begin::Section-->
													<div class="kt-section">
														<div class="kt-section__content">
															<table class="table">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>Email</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																		if ($user->paypals) {
																			foreach ($user->paypals as $paypal) {
																				echo '<tr>';
																				echo '<th scope="row">'.$paypal->paypalId.'</th>';
																				echo '<td>'.$paypal->email.'</td>';
																				echo '</tr>';
																			}
																		}else{
																			echo '<tr><td>No address</td></tr>';
																		}
																	?>
																</tbody>
															</table>
														</div>
													</div>
													<!--end::Section-->
												</div>
												<!--end::Form-->
											</div>
								</div>
							</div>
						</div>

<!-- end:: Content -->
</div>
<?php
include(DIR_VIEW.DIR_CON."footer_admin.php");
?>
<script type="text/javascript">
	$('#edit_usr').on('click', function() {
		location.href = DIR_VIEW+DIR_ADMN+'form_user.php?id='+<?php echo $_GET['id'];?>
	});
</script>
