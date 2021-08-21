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
			include("../".DIR_CON."header_buyer.php");
			$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_buyer_profile.php?action=get&userId=' . $userId);/*fetch user info*/
			break;
	}
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
$user = json_decode($res_user->getBody());
if ($user->info) {
    $userId = $user->info[0]->userId;
    $fullname = $user->info[0]->fullname;
    $email = $user->info[0]->email;
    $full_otp = explode("-",$user->info[0]->otp);
    $iso2 = $full_otp[0];
		$cc = isset($full_otp[1]);
    $otp = isset($full_otp[2]);
    $roleId = $user->info[0]->roleId;
} else {
    $userId = 0;
    $fullname = '';
    $email = '';
		$full_otp = '';
    $iso2 = '';
		$cc = '';
    $otp = '';
    $roleId = '';
}
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
													Marketing Profile
												</h3>
											</div>
										</div>
										<!--begin::Form-->
										<form class="kt-form" id="jbform">
											<div class="kt-portlet__body">
												<div class="kt-section kt-section--first kt-m0">
                          <input type="hidden" class="form-control" name="userId" id="userId" value="<?php echo $userId;?>">
																<div class="form-group">
																	<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" value="<?php echo $fullname;?>">
																	<span class="form-text text-muted">Please enter your fullname name.</span>
																</div>
																<div class="form-group">
																	<input type="hidden" name="cc" id="cc" value="971">
																	<input type="hidden" name="iso2" id="iso2" value="<?php echo $iso2;?>">
																	<input type="text" class="form-control" name="otp" id="otp" placeholder="Phone" value="<?php echo $otp;?>">
																	<span class="form-text text-muted">Please enter your Registered Mobile (0097155xxxxxxx)</span>
																	<script src="assets/plugins/intl-tel-input/build/js/intlTelInput.js"></script>
							                    <script>
							                      var input = document.querySelector("#otp");
							                      var iti = window.intlTelInput(input, {
							                        initialCountry: "ae",
							                        placeholderNumberType: "MOBILE",
																			separateDialCode: true
							                      });
																		var iso2 = document.getElementById('iso2').value;
																		if(iso2!=''){
																			iti.setCountry(iso2);
																		}
																		input.addEventListener("countrychange", function() {
																			var countryData = iti.getSelectedCountryData();
																			$('#cc').val(countryData.iso2+"-"+countryData.dialCode);
																		});
							                    </script>
																</div>
																<div class="form-group">
																	<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email;?>">
																	<span class="form-text text-muted">Please enter your email address.</span>
																</div>
                              </div>
											</div>
											<div class="kt-portlet__foot">
												<div class="kt-form__actions">
													<button type="submit" class="btn btn-warning" id="btn_submit">Submit</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
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
<script>

$('#btn_submit').click(function(e) {
    e.preventDefault();
    var btn = $(this);
    var form = $(this).closest('form');
    var formdata1 = new FormData($('#jbform')[0]);
    form.validate({
        rules: {
            fullname: {
                required: true
            },otp: {
                required: true
            },email: {
                required: true,
								email: true
            },
        }
    });

    if (!form.valid()) {
        return;
    }
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
        type: "POST",
        url: DIR_CONT+DIR_USR+"CON_seller_profile.php?action=post-account",
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
                        window.location.replace(
                            DIR_VIEW+DIR_BRND+"dt_brands.php"
                        );
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
</script>
