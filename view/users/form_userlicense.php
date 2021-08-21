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
if ($user->license) {
    $license = $user->license[0]->license;
    $vat = $user->license[0]->vat;
} else {
    $license = '';
    $vat = '';
}
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
  <div class="row safari-row-flex">
		<div class="col-md-8">
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
													<div class="form-group row safari-row-flex">
														<div class="col-lg-1 col-sm-12">
															<label class="col-form-label">License</label>
														</div>
														<div class="col-lg-6 col-sm-12">
															<div class="dropzone dropzone-default" id="kt_dropzone_1">
																<div class="dropzone-msg dz-message needsclick">
																	<h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
																</div>
															</div>
														</div>
														<input type="hidden" id="path_license" name="path_license">
													</div>
													<div class="form-group row safari-row-flex">
														<div class="col-lg-1 col-sm-12">
															<label class="col-form-label">VAT</label>
														</div>
														<div class="col-lg-6 col-sm-12">
															<div class="dropzone dropzone-default" id="kt_dropzone_2">
																<div class="dropzone-msg dz-message needsclick">
																	<h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
																</div>
															</div>
														</div>
														<input type="hidden" id="path_vat" name="path_vat">
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
		<div class="col-md-4">
			<?php
				if ($license) {
					echo '<div class="kt-portlet"><div class="kt-portlet__head kt-portlet__head--noborder"><div class="kt-portlet__head-label">';
					echo '<h3 class="kt-portlet__head-title">My license</h3>';
					echo '</div></div>';
					echo '<div class="kt-portlet__body"><div class="kt-widget__files"><div class="kt-widget__media"><a href="'.DIR_ROOT.$license.'"><img class="kt-widget__img kt-hidden-" src="'.DIR_ROOT.DIR_ICON.'licensing.png" alt="image"/></a></div></div></div></div>';
				}
				if ($vat) {
					echo '<div class="kt-portlet"><div class="kt-portlet__head kt-portlet__head--noborder"><div class="kt-portlet__head-label">';
					echo '<h3 class="kt-portlet__head-title">My VAT</h3>';
					echo '</div></div>';
					echo '<div class="kt-portlet__body"><div class="kt-widget__files"><div class="kt-widget__media"><a href="'.DIR_ROOT.$vat.'"><img class="kt-widget__img kt-hidden-" src="'.DIR_ROOT.DIR_ICON.'tax.png" alt="image"/></a></div></div></div></div>';
				}
			?>
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
            path_license: {
                required: true
            }
        }
    });

    if (!form.valid()) {
        return;
    }
    btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
    $.ajax({
        type: "POST",
        url: DIR_CONT+DIR_USR+"CON_seller_profile.php?action=post-license",
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
// single file upload
$('#kt_dropzone_1').dropzone({
    url: DIR_CONT+DIR_CON+"CON_upload.php?path=licenses", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    maxFilesize: 5, // MB
    addRemoveLinks: true,
		acceptedFiles: ".pdf",
    accept: function(file, done) {
        document.getElementById('path_license').value=file.name;
        done();
    }
});
// single file upload
$('#kt_dropzone_2').dropzone({
    url: DIR_CONT+DIR_CON+"CON_upload.php?path=licenses", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    maxFilesize: 5, // MB
    addRemoveLinks: true,
		acceptedFiles: ".pdf",
    accept: function(file, done) {
        document.getElementById('path_vat').value=file.name;
        done();
    }
});
</script>
