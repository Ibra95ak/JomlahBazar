<?php
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
include("../" . DIR_CON . "header_admin.php");
$client = new GuzzleHttp\Client();
$res_user = $client->request('GET',DIR_CONT.DIR_ADMN.'CON_users.php?action=get&userId='.$_GET['id']);
$user = json_decode($res_user->getBody());
if($user->info){
	$userId=$user->info[0]->userId;
	$fullname=$user->info[0]->fullname;
	$email=$user->info[0]->email;
	$otp=$user->info[0]->otp;
	$nationality=$user->info[0]->Nationality;
	$encrypted_password=$user->info[0]->encrypted_password;
	$salt=$user->info[0]->salt;
	$activation_code=$user->info[0]->activation_code;
	$activation_salt=$user->info[0]->activation_salt;
	$active=$user->info[0]->active;
	$profile_pic=$user->info[0]->profile_pic;
	$roleId=$user->info[0]->roleId;
	$is_buyer=$user->info[0]->is_buyer;
	$is_seller=$user->info[0]->is_seller;
	$is_affiliate=$user->info[0]->is_affiliate;
	$reachoutId=$user->info[0]->reachoutId;
	$googlesub=$user->info[0]->googlesub;
	$linkedinidentifier=$user->info[0]->linkedinidentifier;
	$authyId=$user->info[0]->authyId;
	$jbidentifier=$user->info[0]->jbidentifier;
	$login=$user->info[0]->login;
}else{
	$userId='';
	$fullname='';
	$email='';
	$otp='';
	$nationality='';
	$encrypted_password='';
	$salt='';
	$activation_code='';
	$activation_salt='';
	$active='';
	$profile_pic='';
	$roleId='';
	$is_buyer='';
	$is_seller='';
	$is_affiliate='';
	$reachoutId='';
	$googlesub='';
	$linkedinidentifier='';
	$authyId='';
	$jbidentifier='';
	$login='';
}
if ($user->reachouts) {
	$reachoutId=$user->reachouts[0]->reachoutId;
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
	$reachoutId='';
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
	$usercompanyId=$user->company[0]->usercompanyId;
	$userId=$user->company[0]->userId;
	$companyname=$user->company[0]->companyname;
	$company_profile_pic=$user->company[0]->profile_pic;
}else{
	$usercompanyId='';
	$userId='';
	$companyname='';
	$company_profile_pic='';
}
$res_roles = $client->request('GET', DIR_JSON.'Read.php?jsonname=roles.json');/*fetch all companies*/
$roles=json_decode($res_roles->getBody());
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="first">

								<!--begin: Form Wizard Nav -->
								<div class="kt-wizard-v4__nav">

									<!--doc: Remove "kt-wizard-v4__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
									<div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable">
										<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
											<div class="kt-wizard-v4__nav-body">
												<div class="kt-wizard-v4__nav-number">
													1
												</div>
												<div class="kt-wizard-v4__nav-label">
													<div class="kt-wizard-v4__nav-label-title">
														Account
													</div>
												</div>
											</div>
										</div>
										<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
											<div class="kt-wizard-v4__nav-body">
												<div class="kt-wizard-v4__nav-number">
													2
												</div>
												<div class="kt-wizard-v4__nav-label">
													<div class="kt-wizard-v4__nav-label-title">
														Address
													</div>
												</div>
											</div>
										</div>
										<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
											<div class="kt-wizard-v4__nav-body">
												<div class="kt-wizard-v4__nav-number">
													3
												</div>
												<div class="kt-wizard-v4__nav-label">
													<div class="kt-wizard-v4__nav-label-title">
														Reachouts
													</div>
												</div>
											</div>
										</div>
										<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
											<div class="kt-wizard-v4__nav-body">
												<div class="kt-wizard-v4__nav-number">
													4
												</div>
												<div class="kt-wizard-v4__nav-label">
													<div class="kt-wizard-v4__nav-label-title">
														Make Payment
													</div>
												</div>
											</div>
										</div>
										<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
											<div class="kt-wizard-v4__nav-body">
												<div class="kt-wizard-v4__nav-number">
													5
												</div>
												<div class="kt-wizard-v4__nav-label">
													<div class="kt-wizard-v4__nav-label-title">
														Company Profile
													</div>
												</div>
											</div>
										</div>
										<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
											<div class="kt-wizard-v4__nav-body">
												<div class="kt-wizard-v4__nav-number">
													6
												</div>
												<div class="kt-wizard-v4__nav-label">
													<div class="kt-wizard-v4__nav-label-title">
														Devices
													</div>
												</div>
											</div>
										</div>
										<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
											<div class="kt-wizard-v4__nav-body">
												<div class="kt-wizard-v4__nav-number">
													7
												</div>
												<div class="kt-wizard-v4__nav-label">
													<div class="kt-wizard-v4__nav-label-title">
														Completed
													</div>
													<div class="kt-wizard-v4__nav-label-desc">
														Review and Submit
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<!--end: Form Wizard Nav -->
								<div class="kt-portlet">
									<div class="kt-portlet__body kt-portlet__body--fit">
										<div class="kt-grid">
											<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

												<!--begin: Form Wizard Form-->
												<form class="kt-form kt-pt0" id="kt_form" novalidate="novalidate" enctype="multipart/form-data">
													<input type="hidden" name="userId" id="userId" value="<?php echo $userId?>">
													<!--begin: Form Wizard Step 1-->
													<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
														<div class="kt-heading kt-heading--md">Account Details</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v4__form">
																<div class="form-group">
																		<div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_3">
																			<div class="kt-avatar__holder" style="background-image: url(<?php echo DIR_ROOT.$profile_pic;?>)"></div>
																			<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
																				<i class="fa fa-pen"></i>
																				<input type="file" name="profile_pic" id="profile_pic">
																			</label>
																			<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
																				<i class="fa fa-times"></i>
																			</span>
																		</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Full Name</label>
																			<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" value="<?php echo $fullname?>">
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Phone</label>
																			<input type="tel" class="form-control" name="otp" id="otp" placeholder="phone" value="<?php echo $otp;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Email</label>
																			<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email?>">
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Nationality</label>
																			<input type="text" class="form-control" name="nationality" id="nationality" placeholder="Nationality" value="<?php echo $nationality;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Encrypted Password</label>
																			<input type="text" class="form-control" name="encrypted_password" id="encrypted_password" placeholder="Encrypted Password" value="<?php echo $encrypted_password?>">
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Salt</label>
																			<input type="text" class="form-control" name="salt" id="salt" placeholder="Salt" value="<?php echo $salt;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-4">
																		<div class="form-group">
																			<label>Activation Code</label>
																			<input type="text" class="form-control" name="activation_code" id="activation_code" placeholder="Activation Code" value="<?php echo $activation_code?>">
																		</div>
																	</div>
																	<div class="col-xl-4">
																		<div class="form-group">
																			<label>Activation Salt</label>
																			<input type="text" class="form-control" name="activation_salt" id="activation_salt" placeholder="Salt" value="<?php echo $activation_salt;?>">
																		</div>
																	</div>
																	<div class="col-xl-4">
																		<div class="form-group">
																			<input type="hidden" class="form-control" name="active" id="active" placeholder="Active" value="<?php echo $active;?>">
																			<label>User Status</label>
																			<button type="button" class="form-control btn btn-success" id="toggle_status">Active</button>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>Role</label>
																			<select class="form-control" name="roleId" id="roleId">
																				<option value="">Select Role</option>
<?php
foreach ($roles->data as $role) {
	echo '<option value="'.$role->roleId.'">'.$role->role.'</option>';
}
?>
																			</select>
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>Buyer</label>
																			<input type="hidden" class="form-control" name="is_buyer" id="is_buyer" placeholder="Buyer" value="<?php echo $is_buyer;?>">
																			<button type="button" class="form-control btn btn-success" id="toggle_buyer">Active</button>
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>Seller</label>
																			<input type="hidden" class="form-control" name="is_seller" id="is_seller" placeholder="Seller" value="<?php echo $is_seller;?>">
																			<button type="button" class="form-control btn btn-success" id="toggle_seller">Active</button>
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>Affiliate</label>
																			<input type="hidden" class="form-control" name="is_affiliate" id="is_affiliate" placeholder="Affiliate" value="<?php echo $is_affiliate;?>">
																			<button type="button" class="form-control btn btn-success" id="toggle_affiliate">Active</button>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>Logged In</label><br>
																			<span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
																				<label>
																					<input type="checkbox" name="toggle_login" id="toggle_login">
																					<input type="hidden" name="login" id="login" value="<?php echo $login;?>">
																					<span></span>
																				</label>
																			</span>
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>Google Profile</label>
																			<input type="text" class="form-control" name="googlesub" id="googlesub" placeholder="Google Profile" value="<?php echo $googlesub;?>">
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>LinkedIn Profile</label>
																			<input type="text" class="form-control" name="linkedinidentifier" id="linkedinidentifier" placeholder="LinkedIn Profile" value="<?php echo $linkedinidentifier;?>">
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>OTP Id</label>
																			<input type="text" class="form-control" name="authyId" id="authyId" placeholder="OTP Id" value="<?php echo $authyId;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-4">
																		<div class="form-group">
																			<label>JB Id</label>
																			<input type="text" class="form-control" name="jbidentifier" id="jbidentifier" placeholder="JB Id" value="<?php echo $jbidentifier;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<button type="button" class="btn btn-warning" id="submit_info">Submit</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--end: Form Wizard Step 1-->

													<!--begin: Form Wizard Step 2-->
													<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Setup Your Address</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v4__form">
																<div class="kt-portlet">
																	<div class="kt-portlet__head">
																		<div class="kt-portlet__head-label">
																			<h3 class="kt-portlet__head-title">
																				Addresses
																			</h3>
																		</div>
																	</div>
																	<div class="kt-portlet__body">
																		<div class="kt-section kt-section--first">
																			<table class="table table-light">
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
																						<th>Actions</th>
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
																								echo '<td><div class="btn-group" role="group" aria-label="First group">
																	<button type="button" class="btn btn-warning" onclick="editaddress('.$address->addressId.')"><i class="la la-edit"></i></button>
																	<button type="button" class="btn btn-danger" onclick="deleteaddress(' . $address->addressId . ')"><i class="la la-trash"></i></button>
																	</div></td>';
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
																</div>
																<div class="row">
																	<input type="hidden" name="addressId" id="addressId">
									                <div class="col-xl-6">
									                  <div class="form-group">
																			<label>Address 1</label>
									                    <input type="text" class="form-control" name="address1" id="address1" placeholder="Address Line 1">
									                  </div>
									                </div>
									                <div class="col-xl-6">
									                  <div class="form-group">
																			<label>Address 2</label>
									                    <input type="text" class="form-control" name="address2" id="address2" placeholder="Address Line 2">
									                  </div>
									                </div>
									              </div>
									              <div class="row">
									                <div class="col-xl-6">
									                  <div class="form-group">
																			<label>Pestal Code</label>
									                    <input type="text" class="form-control" name="postalcode" id="postalcode" placeholder="Postalcode">
									                  </div>
									                </div>
									                <div class="col-xl-6">
									                  <div class="form-group">
																			<label>City</label>
									                    <input type="text" class="form-control" name="city" id="city" placeholder="City">
									                  </div>
									                </div>
									              </div>
									              <div class="row">
									                <div class="col-xl-6">
									                  <div class="form-group">
																			<label>State</label>
									                    <input type="text" class="form-control" name="state" id="state" placeholder="State">
									                  </div>
									                </div>
									                <div class="col-xl-6">
									                  <div class="form-group">
																			<label>Country</label>
									                    <select name="country" id="country" class="form-control">
									                      <option value="">Select</option>
									                      <option value="AF">Afghanistan</option>
									                      <option value="AX">Åland Islands</option>
									                      <option value="AL">Albania</option>
									                      <option value="DZ">Algeria</option>
									                      <option value="AS">American Samoa</option>
									                      <option value="AD">Andorra</option>
									                      <option value="AO">Angola</option>
									                      <option value="AI">Anguilla</option>
									                      <option value="AQ">Antarctica</option>
									                      <option value="AG">Antigua and Barbuda</option>
									                      <option value="AR">Argentina</option>
									                      <option value="AM">Armenia</option>
									                      <option value="AW">Aruba</option>
									                      <option value="AU" selected="">Australia</option>
									                      <option value="AT">Austria</option>
									                      <option value="AZ">Azerbaijan</option>
									                      <option value="BS">Bahamas</option>
									                      <option value="BH">Bahrain</option>
									                      <option value="BD">Bangladesh</option>
									                      <option value="BB">Barbados</option>
									                      <option value="BY">Belarus</option>
									                      <option value="BE">Belgium</option>
									                      <option value="BZ">Belize</option>
									                      <option value="BJ">Benin</option>
									                      <option value="BM">Bermuda</option>
									                      <option value="BT">Bhutan</option>
									                      <option value="BO">Bolivia, Plurinational State of</option>
									                      <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
									                      <option value="BA">Bosnia and Herzegovina</option>
									                      <option value="BW">Botswana</option>
									                      <option value="BV">Bouvet Island</option>
									                      <option value="BR">Brazil</option>
									                      <option value="IO">British Indian Ocean Territory</option>
									                      <option value="BN">Brunei Darussalam</option>
									                      <option value="BG">Bulgaria</option>
									                      <option value="BF">Burkina Faso</option>
									                      <option value="BI">Burundi</option>
									                      <option value="KH">Cambodia</option>
									                      <option value="CM">Cameroon</option>
									                      <option value="CA">Canada</option>
									                      <option value="CV">Cape Verde</option>
									                      <option value="KY">Cayman Islands</option>
									                      <option value="CF">Central African Republic</option>
									                      <option value="TD">Chad</option>
									                      <option value="CL">Chile</option>
									                      <option value="CN">China</option>
									                      <option value="CX">Christmas Island</option>
									                      <option value="CC">Cocos (Keeling) Islands</option>
									                      <option value="CO">Colombia</option>
									                      <option value="KM">Comoros</option>
									                      <option value="CG">Congo</option>
									                      <option value="CD">Congo, the Democratic Republic of the</option>
									                      <option value="CK">Cook Islands</option>
									                      <option value="CR">Costa Rica</option>
									                      <option value="CI">Côte d'Ivoire</option>
									                      <option value="HR">Croatia</option>
									                      <option value="CU">Cuba</option>
									                      <option value="CW">Curaçao</option>
									                      <option value="CY">Cyprus</option>
									                      <option value="CZ">Czech Republic</option>
									                      <option value="DK">Denmark</option>
									                      <option value="DJ">Djibouti</option>
									                      <option value="DM">Dominica</option>
									                      <option value="DO">Dominican Republic</option>
									                      <option value="EC">Ecuador</option>
									                      <option value="EG">Egypt</option>
									                      <option value="SV">El Salvador</option>
									                      <option value="GQ">Equatorial Guinea</option>
									                      <option value="ER">Eritrea</option>
									                      <option value="EE">Estonia</option>
									                      <option value="ET">Ethiopia</option>
									                      <option value="FK">Falkland Islands (Malvinas)</option>
									                      <option value="FO">Faroe Islands</option>
									                      <option value="FJ">Fiji</option>
									                      <option value="FI">Finland</option>
									                      <option value="FR">France</option>
									                      <option value="GF">French Guiana</option>
									                      <option value="PF">French Polynesia</option>
									                      <option value="TF">French Southern Territories</option>
									                      <option value="GA">Gabon</option>
									                      <option value="GM">Gambia</option>
									                      <option value="GE">Georgia</option>
									                      <option value="DE">Germany</option>
									                      <option value="GH">Ghana</option>
									                      <option value="GI">Gibraltar</option>
									                      <option value="GR">Greece</option>
									                      <option value="GL">Greenland</option>
									                      <option value="GD">Grenada</option>
									                      <option value="GP">Guadeloupe</option>
									                      <option value="GU">Guam</option>
									                      <option value="GT">Guatemala</option>
									                      <option value="GG">Guernsey</option>
									                      <option value="GN">Guinea</option>
									                      <option value="GW">Guinea-Bissau</option>
									                      <option value="GY">Guyana</option>
									                      <option value="HT">Haiti</option>
									                      <option value="HM">Heard Island and McDonald Islands</option>
									                      <option value="VA">Holy See (Vatican City State)</option>
									                      <option value="HN">Honduras</option>
									                      <option value="HK">Hong Kong</option>
									                      <option value="HU">Hungary</option>
									                      <option value="IS">Iceland</option>
									                      <option value="IN">India</option>
									                      <option value="ID">Indonesia</option>
									                      <option value="IR">Iran, Islamic Republic of</option>
									                      <option value="IQ">Iraq</option>
									                      <option value="IE">Ireland</option>
									                      <option value="IM">Isle of Man</option>
									                      <option value="IL">Israel</option>
									                      <option value="IT">Italy</option>
									                      <option value="JM">Jamaica</option>
									                      <option value="JP">Japan</option>
									                      <option value="JE">Jersey</option>
									                      <option value="JO">Jordan</option>
									                      <option value="KZ">Kazakhstan</option>
									                      <option value="KE">Kenya</option>
									                      <option value="KI">Kiribati</option>
									                      <option value="KP">Korea, Democratic People's Republic of</option>
									                      <option value="KR">Korea, Republic of</option>
									                      <option value="KW">Kuwait</option>
									                      <option value="KG">Kyrgyzstan</option>
									                      <option value="LA">Lao People's Democratic Republic</option>
									                      <option value="LV">Latvia</option>
									                      <option value="LB">Lebanon</option>
									                      <option value="LS">Lesotho</option>
									                      <option value="LR">Liberia</option>
									                      <option value="LY">Libya</option>
									                      <option value="LI">Liechtenstein</option>
									                      <option value="LT">Lithuania</option>
									                      <option value="LU">Luxembourg</option>
									                      <option value="MO">Macao</option>
									                      <option value="MK">Macedonia, the former Yugoslav Republic of</option>
									                      <option value="MG">Madagascar</option>
									                      <option value="MW">Malawi</option>
									                      <option value="MY">Malaysia</option>
									                      <option value="MV">Maldives</option>
									                      <option value="ML">Mali</option>
									                      <option value="MT">Malta</option>
									                      <option value="MH">Marshall Islands</option>
									                      <option value="MQ">Martinique</option>
									                      <option value="MR">Mauritania</option>
									                      <option value="MU">Mauritius</option>
									                      <option value="YT">Mayotte</option>
									                      <option value="MX">Mexico</option>
									                      <option value="FM">Micronesia, Federated States of</option>
									                      <option value="MD">Moldova, Republic of</option>
									                      <option value="MC">Monaco</option>
									                      <option value="MN">Mongolia</option>
									                      <option value="ME">Montenegro</option>
									                      <option value="MS">Montserrat</option>
									                      <option value="MA">Morocco</option>
									                      <option value="MZ">Mozambique</option>
									                      <option value="MM">Myanmar</option>
									                      <option value="NA">Namibia</option>
									                      <option value="NR">Nauru</option>
									                      <option value="NP">Nepal</option>
									                      <option value="NL">Netherlands</option>
									                      <option value="NC">New Caledonia</option>
									                      <option value="NZ">New Zealand</option>
									                      <option value="NI">Nicaragua</option>
									                      <option value="NE">Niger</option>
									                      <option value="NG">Nigeria</option>
									                      <option value="NU">Niue</option>
									                      <option value="NF">Norfolk Island</option>
									                      <option value="MP">Northern Mariana Islands</option>
									                      <option value="NO">Norway</option>
									                      <option value="OM">Oman</option>
									                      <option value="PK">Pakistan</option>
									                      <option value="PW">Palau</option>
									                      <option value="PS">Palestinian Territory, Occupied</option>
									                      <option value="PA">Panama</option>
									                      <option value="PG">Papua New Guinea</option>
									                      <option value="PY">Paraguay</option>
									                      <option value="PE">Peru</option>
									                      <option value="PH">Philippines</option>
									                      <option value="PN">Pitcairn</option>
									                      <option value="PL">Poland</option>
									                      <option value="PT">Portugal</option>
									                      <option value="PR">Puerto Rico</option>
									                      <option value="QA">Qatar</option>
									                      <option value="RE">Réunion</option>
									                      <option value="RO">Romania</option>
									                      <option value="RU">Russian Federation</option>
									                      <option value="RW">Rwanda</option>
									                      <option value="BL">Saint Barthélemy</option>
									                      <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
									                      <option value="KN">Saint Kitts and Nevis</option>
									                      <option value="LC">Saint Lucia</option>
									                      <option value="MF">Saint Martin (French part)</option>
									                      <option value="PM">Saint Pierre and Miquelon</option>
									                      <option value="VC">Saint Vincent and the Grenadines</option>
									                      <option value="WS">Samoa</option>
									                      <option value="SM">San Marino</option>
									                      <option value="ST">Sao Tome and Principe</option>
									                      <option value="SA">Saudi Arabia</option>
									                      <option value="SN">Senegal</option>
									                      <option value="RS">Serbia</option>
									                      <option value="SC">Seychelles</option>
									                      <option value="SL">Sierra Leone</option>
									                      <option value="SG">Singapore</option>
									                      <option value="SX">Sint Maarten (Dutch part)</option>
									                      <option value="SK">Slovakia</option>
									                      <option value="SI">Slovenia</option>
									                      <option value="SB">Solomon Islands</option>
									                      <option value="SO">Somalia</option>
									                      <option value="ZA">South Africa</option>
									                      <option value="GS">South Georgia and the South Sandwich Islands</option>
									                      <option value="SS">South Sudan</option>
									                      <option value="ES">Spain</option>
									                      <option value="LK">Sri Lanka</option>
									                      <option value="SD">Sudan</option>
									                      <option value="SR">Suriname</option>
									                      <option value="SJ">Svalbard and Jan Mayen</option>
									                      <option value="SZ">Swaziland</option>
									                      <option value="SE">Sweden</option>
									                      <option value="CH">Switzerland</option>
									                      <option value="SY">Syrian Arab Republic</option>
									                      <option value="TW">Taiwan, Province of China</option>
									                      <option value="TJ">Tajikistan</option>
									                      <option value="TZ">Tanzania, United Republic of</option>
									                      <option value="TH">Thailand</option>
									                      <option value="TL">Timor-Leste</option>
									                      <option value="TG">Togo</option>
									                      <option value="TK">Tokelau</option>
									                      <option value="TO">Tonga</option>
									                      <option value="TT">Trinidad and Tobago</option>
									                      <option value="TN">Tunisia</option>
									                      <option value="TR">Turkey</option>
									                      <option value="TM">Turkmenistan</option>
									                      <option value="TC">Turks and Caicos Islands</option>
									                      <option value="TV">Tuvalu</option>
									                      <option value="UG">Uganda</option>
									                      <option value="UA">Ukraine</option>
									                      <option value="AE">United Arab Emirates</option>
									                      <option value="GB">United Kingdom</option>
									                      <option value="US">United States</option>
									                      <option value="UM">United States Minor Outlying Islands</option>
									                      <option value="UY">Uruguay</option>
									                      <option value="UZ">Uzbekistan</option>
									                      <option value="VU">Vanuatu</option>
									                      <option value="VE">Venezuela, Bolivarian Republic of</option>
									                      <option value="VN">Viet Nam</option>
									                      <option value="VG">Virgin Islands, British</option>
									                      <option value="VI">Virgin Islands, U.S.</option>
									                      <option value="WF">Wallis and Futuna</option>
									                      <option value="EH">Western Sahara</option>
									                      <option value="YE">Yemen</option>
									                      <option value="ZM">Zambia</option>
									                      <option value="ZW">Zimbabwe</option>
									                    </select>
									                  </div>
									                </div>
									              </div>
									              <div class="row">
									                <div class="col-xl-5">
									                  <div class="form-group">
																			<label>Latitude</label>
									                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude">
									                  </div>
									                </div>
									                <div class="col-xl-5">
									                  <div class="form-group">
																			<label>Longitude</label>
									                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude">
									                  </div>
									                </div>
									                <div class="col-xl-2">
									                  <div class="form-group">
									                    <button type="button" class="btn btn-brand btn-icon"><i class="fa fa-tag" onclick="getLocation()"></i></button>
									                    <span class="form-text text-muted">Get current location.</span>
									                  </div>
									                </div>
									                <div class="col-xl-6 kt-hidden">
									                  <div class="form-group">
									                    <input type="hidden" class="form-control" name="ipaddress" id="ipaddress" placeholder="Ip address">
									                  </div>
									                </div>
									              </div>
									              <div class="row">
									                <div class="col-xl-6 kt-hidden">
									                  <div class="form-group">
									                    <input type="hidden" class="form-control" name="language" id="language" placeholder="language">
									                  </div>
									                </div>
									                <div class="col-xl-6">
									                  <div class="form-group">
									                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
									                      <input type="checkbox" id="default_address" name="default_address"> Default Address
									                      <span></span>
									                    </label>
									                  </div>
									                </div>
									              </div>
																<div class="row">
																	<div class="col-md-12">
																		<button type="button" class="btn btn-warning" id="submit_address">Submit</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--end: Form Wizard Step 2-->

													<!--begin: Form Wizard Step 3-->
													<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Reachouts</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v4__form">
																<div class="row">
																	<input type="hidden" name="reachoutId" value="<?php echo $reachoutId;?>">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Phone</label>
																			<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone;?>">
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Whats App</label>
																			<input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Whats App" value="<?php echo $whatsapp;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Telegram</label>
																			<input type="text" class="form-control" name="telegram" id="telegram" placeholder="Telegram" value="<?php echo $telegram;?>">
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Messenger</label>
																			<input type="text" class="form-control" name="messenger" id="messenger" placeholder="Messenger" value="<?php echo $messenger;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Linkedin</label>
																			<input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin" value="<?php echo $linkedin;?>">
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>SMS</label>
																			<input type="text" class="form-control" name="sms" id="sms" placeholder="SMS" value="<?php echo $sms;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Facebook</label>
																			<input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook" value="<?php echo $facebook;?>">
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Instagram</label>
																			<input type="text" class="form-control" name="instagram" id="instagram" placeholder="Instagram" value="<?php echo $instagram;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Teams</label>
																			<input type="text" class="form-control" name="teams" id="teams" placeholder="Teams" value="<?php echo $teams;?>">
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Zoom</label>
																			<input type="text" class="form-control" name="zoom" id="zoom" placeholder="Zoom" value="<?php echo $zoom;?>">
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<button type="button" class="btn btn-warning" id="submit_reachout">Submit</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--end: Form Wizard Step 3-->

													<!--begin: Form Wizard Step 4-->
													<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Enter your Payment Details</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v4__form">
																<div class="row">
																	<div class="col-md-7">
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
																								<table class="table table-light">
																									<thead>
																										<tr>
																											<th>#</th>
																											<th>Card Number</th>
																											<th>Name on Card</th>
																											<th>Card Expiry Date</th>
																											<th>Action</th>
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
																													echo '<td><div class="btn-group" role="group" aria-label="First group">
																						<button type="button" class="btn btn-warning" onclick="editcard('.$credit_card->creditcardId.')"><i class="la la-edit"></i></button>
																						<button type="button" class="btn btn-danger" onclick="deletecard(' . $credit_card->creditcardId . ')"><i class="la la-trash"></i></button>
																						</div></td>';
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
																	<div class="col-md-5">
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
																								<table class="table table-light">
																									<thead>
																										<tr>
																											<th>#</th>
																											<th>Email</th>
																											<th>Action</th>
																										</tr>
																									</thead>
																									<tbody>
																										<?php
																											if ($user->paypals) {
																												foreach ($user->paypals as $paypal) {
																													echo '<tr>';
																													echo '<th scope="row">'.$paypal->paypalId.'</th>';
																													echo '<td>'.$paypal->email.'</td>';
																													echo '<td><div class="btn-group" role="group" aria-label="First group">
																						<button type="button" class="btn btn-warning" onclick="editpaypal('.$paypal->paypalId.')"><i class="la la-edit"></i></button>
																						<button type="button" class="btn btn-danger" onclick="deletepaypal(' . $paypal->paypalId . ')"><i class="la la-trash"></i></button>
																						</div></td>';
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
																	<input type="hidden" name="walletId" id="walletId">
																	<input type="hidden" name="creditcardId" id="creditcardId">
																	<input type="hidden" name="paypalId" id="paypalId">
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>Name on Card</label>
																			<input type="text" class="form-control" name="card_name" id="card_name" placeholder="Card Name">
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>Card Number</label>
																			<input type="text" class="form-control" name="card_number" id="card_number" placeholder="Card Number">
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<div class="form-group">
																			<label>Card Expiry Month</label>
																			<input type="number" class="form-control" name="card_expiry" id="card_expiry" placeholder="Card Expiry Month">
																			<span class="form-text text-muted">Please enter your Card Expiry Month.</span>
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<label></label><br>
																		<button type="button" class="form-control btn btn-warning" id="submit_card">Submit</button>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-4">
																		<div class="form-group">
																			<label>Paypal Email</label>
																			<input type="text" class="form-control" name="paypal_email" id="paypal_email" placeholder="Paypal Email">
																		</div>
																	</div>
																	<div class="col-xl-3">
																		<label></label><br>
																		<button type="button" class="form-control btn btn-warning" id="submit_paypal">Submit</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--end: Form Wizard Step 4-->

													<!--begin: Form Wizard Step 5-->
													<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
														<div class="kt-heading kt-heading--md">Enter your Company Details</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v4__form">
																<div class="form-group">
																		<div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_3">
																			<div class="kt-avatar__holder" style="background-image: url(<?php echo DIR_ROOT.$company_profile_pic;?>)"></div>
																			<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
																				<i class="fa fa-pen"></i>
																				<input type="file" name="profile_avatar">
																			</label>
																			<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
																				<i class="fa fa-times"></i>
																			</span>
																		</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Company Name</label>
																			<input type="text" class="form-control" name="companyname" id="companyname" placeholder="Company Name" value="<?php echo $companyname?>">
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--end: Form Wizard Step 5-->

													<!--begin: Form Wizard Step 6-->
													<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Setup Your Devices</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v4__form">
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
																						<table class="table table-light">
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
																									<th>Action</th>
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
																											echo '<td><div class="btn-group" role="group" aria-label="First group">
																				<button type="button" class="btn btn-danger" onclick="deletedevice(' . $device->deviceId . ')"><i class="la la-trash"></i></button>
																				</div></td>';
																											echo '</tr>';
																										}
																									}else{
																										echo '<tr><td>No Devices</td></tr>';
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
													<!--end: Form Wizard Step 6-->
													<!--begin: Form Wizard Step 7-->
													<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Review your Details and Submit</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v4__review">
																<div class="kt-wizard-v4__review-item">
																	<div class="kt-wizard-v4__review-title">
																		Your Account Details
																	</div>
																	<div class="kt-wizard-v4__review-content">
																		John Wick<br>
																		Phone: +61412345678<br>
																		Email: johnwick@reeves.com
																	</div>
																</div>
																<div class="kt-wizard-v4__review-item">
																	<div class="kt-wizard-v4__review-title">
																		Your Address Details
																	</div>
																	<div class="kt-wizard-v4__review-content">
																		Address Line 1<br>
																		Address Line 2<br>
																		Melbourne 3000, VIC, Australia
																	</div>
																</div>
																<div class="kt-wizard-v4__review-item">
																	<div class="kt-wizard-v4__review-title">
																		Payment Details
																	</div>
																	<div class="kt-wizard-v4__review-content">
																		Card Number: xxxx xxxx xxxx 1111<br>
																		Card Name: John Wick<br>
																		Card Expiry: 01/21
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--end: Form Wizard Step 4-->

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
	<!-- end:: Content -->
</div>
<!-- end:: Page -->
<?php
include(DIR_VIEW.DIR_CON."footer.php");
?>
<!--begin::Page Scripts(used by this page) -->
<script src="assets/js/pages/custom/wizard/wizard-4.js" type="text/javascript"></script>
<script src="assets/js/pages/crud/file-upload/ktavatar.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
	  var login = $('#login').val();
	  var active = $('#active').val();
		var btnsts = $('#toggle_status');
	  var is_buyer = $('#is_buyer').val();
		var btnb = $('#toggle_buyer');
	  var is_seller = $('#is_seller').val();
		var btns = $('#toggle_seller');
	  var is_affiliate = $('#is_affiliate').val();
		var btna = $('#toggle_affiliate');
		if (login==1) {
			$('#toggle_login').prop("checked",true);
		}else {
			$('#toggle_login').prop("checked",false);
		}
		if (active==1) {
			btnsts.html("Active");
			btnsts.removeClass("btn-dark");
			btnsts.addClass("btn-success");
		}else {
			btnsts.html("Inactive");
			btnsts.removeClass("btn-success");
			btnsts.addClass("btn-dark");
		}
		if (is_buyer==1) {
			btnb.html("Active");
			btnb.removeClass("btn-dark");
			btnb.addClass("btn-success");
		}else {
			btnb.html("Inactive");
			btnb.removeClass("btn-success");
			btnb.addClass("btn-dark");
		}
		if (is_seller==1) {
			btns.html("Active");
			btns.removeClass("btn-dark");
			btns.addClass("btn-success");
		}else {
			btns.html("Inactive");
			btns.removeClass("btn-success");
			btns.addClass("btn-dark");
		}
		if (is_affiliate==1) {
			btna.html("Active");
			btna.removeClass("btn-dark");
			btna.addClass("btn-success");
		}else {
			btna.html("Inactive");
			btna.removeClass("btn-success");
			btna.addClass("btn-dark");
		}
	});
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
	function editaddress(addressId) {
    $('#addressId').val(addressId);
		$.ajax({
			url: "<?php echo DIR_CONT . DIR_ADRS . 'CON_addresses.php?action=get&userId='.$userId.'&addressId='?>"+addressId,
			success: function(result){
				var address = JSON.parse(result);
				$('#userId').val(address['useraddress'][0].userId);
				$('#ipaddress').val(address['useraddress'][0].ipaddress);
				$('#address1').val(address['useraddress'][0].address1);
				$('#address2').val(address['useraddress'][0].address2);
				$('#city').val(address['useraddress'][0].city);
				$('#state').val(address['useraddress'][0].state);
				$('#postalcode').val(address['useraddress'][0].postalcode);
				$('#country').val(address['useraddress'][0].country);
				$('#latitude').val(address['useraddress'][0].latitude);
				$('#longitude').val(address['useraddress'][0].longitude);
				$('#language').val(address['useraddress'][0].language);
				console.log(address['useraddress'][0].default_address);
				if(address['useraddress'][0].default_address=='1') $('#default_address').prop("checked",true);
				else $('#default_address').prop("checked",false);
	 }});
  }
	function editcard(creditcardId) {
    $('#creditcardId').val(creditcardId);
		$.ajax({
			url: "<?php echo DIR_CONT . DIR_WLT . 'CON_Wallets.php?action=get&userId='.$userId.'&creditcardId='?>"+creditcardId,
			success: function(result){
				var wallet = JSON.parse(result);
				$('#walletId').val(wallet.walletId);
				$('#creditcardId').val(wallet.creditcardId);
				$('#card_number').val(wallet.card_number);
				$('#card_name').val(wallet.card_name);
				$('#card_expiry').val(wallet.card_expiry);
	 }});
  }
	function editpaypal(paypalId) {
    $('#paypalId').val(paypalId);
		$.ajax({
			url: "<?php echo DIR_CONT . DIR_WLT . 'CON_Wallets.php?action=get&userId='.$userId.'&paypalId='?>"+paypalId,
			success: function(result){
				var wallet = JSON.parse(result);
				$('#walletId').val(wallet.walletId);
				$('#paypalId').val(wallet.paypalId);
				$('#paypal_email').val(wallet.email);
	 }});
  }
	function deletedevice(deviceId) {
		$.ajax({
			url: "<?php echo DIR_CONT . DIR_USR . 'CON_userdevices.php?action=delete-admin&userId='.$userId.'&deviceId='?>"+deviceId,
			success: function(result){
				//location.reload();
	 }});
	}
	function deleteaddress(addressId) {
		$.ajax({
			url: "<?php echo DIR_CONT . DIR_ADRS . 'CON_addresses.php?action=delete-admin&userId='.$userId.'&addressId='?>"+addressId,
			success: function(result){
				location.reload();
	 }});
	}
	function deletewallet(walletId) {
		$.ajax({
			url: "<?php echo DIR_CONT . DIR_WLT . 'CON_Wallets.php?action=delete&walletId=';?>"+walletId,
			success: function(result){
				location.reload();
	 }});
	}
	$('#submit_address').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#kt_form')[0]);
    form.validate({
      rules: {
        address1: {
          required: true
        },
        postalcode: {
          required: true
        },
        city: {
          required: true,
        },
        country: {
          required: true,
        }
      }
    });

    if (!form.valid()) {
      return;
    }
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
      type: "POST",
      url: DIR_CONT+DIR_ADMN+"CON_users.php?action=post-address",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata1,
      dataType: "json",
      success: function(data) {
        location.reload();
      }
    });
  });
	$('#submit_info').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#kt_form')[0]);
		if($('#profile_pic').prop('files').length > 0)
    {
        file =$('#profile_pic').prop('files')[0];
        formdata1.append("profile_pic", file);
    }else {
			file ="<?php echo $profile_pic;?>";
			formdata1.append("profile_pic", file);
    }
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
      type: "POST",
      url: DIR_CONT+DIR_ADMN+"CON_users.php?action=post-account",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata1,
      dataType: "json",
      success: function(data) {
        switch (data['err']) {
          case 0:
            // similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              //Simulate an HTTP redirect:
              window.location.reload();
            }, 2000);
            break;
          case 1:
            // similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              showErrorMsg(form, 'danger',
                'Incorrect username or password. Please try again.');
            }, 2000);
            break;
          case 2:
            // similate 2s delay
            setTimeout(function() {
              btn.removeClass(
                'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
              ).attr('disabled', false);
              showErrorMsg(form, 'danger',
                'Missing required parameters. Please try again.');
            }, 2000);
            break;
          default:
        }
      }
    });
  });
	$('#submit_reachout').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#kt_form')[0]);
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
      type: "POST",
      url: DIR_CONT+DIR_ADMN+"CON_users.php?action=post-socials",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata1,
      dataType: "json",
      success: function(data) {
        location.reload();
      }
    });
  });
	$('#submit_card').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#kt_form')[0]);
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
      type: "POST",
      url: DIR_CONT+DIR_ADMN+"CON_users.php?action=post-card",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata1,
      dataType: "json",
      success: function(data) {
        location.reload();
      }
    });
  });
	$('#submit_paypal').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#kt_form')[0]);
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
      type: "POST",
      url: DIR_CONT+DIR_ADMN+"CON_users.php?action=post-paypal",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata1,
      dataType: "json",
      success: function(data) {
        location.reload();
      }
    });
  });
	$('#toggle_status').click(function(e) {
		var btn = $(this);
		var active = $('#active').val();
		switch (active) {
			case '1':
				$('#active').val(2);
				btn.html("Inactive");
				btn.removeClass("btn-success");
				btn.addClass("btn-dark");
				break;
			case '2':
				$('#active').val(1);
				btn.html("Active");
				btn.removeClass("btn-dark");
				btn.addClass("btn-success");
				break;
			default:
				$('#active').val(1);
				btn.html("Active");
				btn.removeClass("btn-dark");
				btn.addClass("btn-success");
		}
	});
	$('#toggle_buyer').click(function(e) {
		var btn = $(this);
		var is_buyer = $('#is_buyer').val();
		switch (is_buyer) {
			case '1':
				$('#is_buyer').val(2);
				btn.html("Inactive");
				btn.removeClass("btn-success");
				btn.addClass("btn-dark");
				break;
			case '2':
				$('#is_buyer').val(1);
				btn.html("Active");
				btn.removeClass("btn-dark");
				btn.addClass("btn-success");
				break;
			default:
				$('#is_buyer').val(1);
				btn.html("Active");
				btn.removeClass("btn-dark");
				btn.addClass("btn-success");
		}
	});
	$('#toggle_seller').click(function(e) {
		var btn = $(this);
		var is_seller = $('#is_seller').val();
		switch (is_seller) {
			case '1':
				$('#is_seller').val(2);
				btn.html("Inctive");
				btn.removeClass("btn-success");
				btn.addClass("btn-dark");
				break;
			case '2':
				$('#is_seller').val(1);
				btn.html("Active");
				btn.removeClass("btn-dark");
				btn.addClass("btn-success");
				break;
			default:
				$('#is_seller').val(1);
				btn.html("Active");
				btn.removeClass("btn-dark");
				btn.addClass("btn-success");
		}
	});
	$('#toggle_affiliate').click(function(e) {
		var btn = $(this);
		var is_affiliate = $('#is_affiliate').val();
		switch (is_affiliate) {
			case '1':
				$('#is_affiliate').val(2);
				btn.html("Inactive");
				btn.removeClass("btn-success");
				btn.addClass("btn-dark");
				break;
			case '2':
				$('#is_affiliate').val(1);
				btn.html("Active");
				btn.removeClass("btn-dark");
				btn.addClass("btn-success");
				break;
			default:
				$('#is_affiliate').val(1);
				btn.html("Active");
				btn.removeClass("btn-dark");
				btn.addClass("btn-success");
		}
	});
	$('#toggle_login').click(function(e) {
		var login = $('#login').val();
		switch (login) {
			case '1':
				$('#login').val(2);
				break;
			case '2':
				$('#login').val(1);
				break;
			default:
				$('#login').val(1);
		}
	});
</script>
