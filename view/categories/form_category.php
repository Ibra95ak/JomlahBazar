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
			break;
		case 2:
			include("../".DIR_CON."header_supplier.php");
			break;

		default:
			include("../".DIR_CON."header_buyer.php");
			break;
	}
}else{
	include("../".DIR_CON."header_buyer.php");
}/*Get page header*/
/*URL parameters*/
if (isset($_GET['categoryId'])) {
	$categoryId = $_GET['categoryId'];
} else {
	$categoryId = 0;
}
/*Fetch JB category*/
if ($categoryId != 0) {
	$res_cat = $client->request('GET', DIR_CONT.DIR_CAT.'CON_categories.php?action=get&categoryId=' . $categoryId); /*fetch all categories*/
	$category = json_decode($res_cat->getBody());
	$name = $category->name;
	$icon = $category->icon;
	$active = $category->active;
} else {
	$name = '';
	$icon = '../../assets/media/users/default.jpg';
	$active = '2';
}
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
	<div class="row">
		<div class="col-lg-6">
			<!--begin::Portlet-->
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Manage category
						</h3>
					</div>
				</div>
				<!--begin::Form-->
				<form class="kt-form" id="jbform">
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">category Logo</label>
								<div class="col-lg-9 col-xl-6">
									<div class="kt-avatar kt-avatar--outline" id="kt_user_add_avatar">
										<div class="kt-avatar__holder" style="background-image: url(<?php echo '../../'.$icon; ?>)"></div>
										<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
											<i class="fa fa-pen"></i>
											<input type="file" name="icon" id="icon">
										</label>
										<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
											<i class="fa fa-times"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter category name" name="name" id="name" value="<?php echo $name; ?>">
								<span class="form-text text-muted">Please enter your category name.</span>
							</div>
							<div class="form-group">
								<div class="kt-checkbox-list">
									<label class="kt-checkbox">
										<input type="checkbox" name="active" id="active" <?php if ($active == 1) echo "checked"; ?>> Activate
										<span></span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<button type="submit" class="btn btn-warning" id="btn_submit">Submit For Approval</button>
							<button type="reset" class="btn btn-secondary">Cancel</button>
						</div>
					</div>
				</form>

				<!--end::Form-->
			</div>

			<!--end::Portlet-->
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
				name: {
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
			url: DIR_CONT+"CON_categories.php?action=post&categoryId=<?php echo $categoryId; ?>",
			cache: false,
			contentType: false,
			processData: false,
			data: formdata1,
			dataType: "json",
			success: function(data) {
				console.log(data['err']);
				switch (data['err']) {
					case 0:
						// similate 2s delay
						setTimeout(function() {
							btn.removeClass(
								'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
							).attr('disabled', false);
							// Simulate an HTTP redirect:
							window.location.replace(
								DIR_VIEW+DIR_CAT+"dt_categories.php"
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
