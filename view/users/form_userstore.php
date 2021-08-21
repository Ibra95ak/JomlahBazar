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
			include('../' . DIR_CON . "header_buyer.php");
			break;
		case 2:
			include('../' . DIR_CON . "header_supplier.php");
			break;

		default:
			include('../' . DIR_CON . "header_buyer.php");
			break;
	}
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_buyer_profile.php?action=get&userId=' . $userId);/*fetch user info*/
$user = json_decode($res_user->getBody());
$res_cat = $client->request('GET', DIR_CONT.DIR_CAT.'CON_categories.php?action=get');/*fetch all categories*/
/*Fetch JB Categories*/
$categories=json_decode($res_cat->getBody());
$res_brnd = $client->request('GET', DIR_CONT.DIR_BRND.'CON_brands.php?action=get');/*fetch all categories*/
$brands=json_decode($res_brnd->getBody());
if ($user->company) {
    $storeId=$user->company[0]->usercompanyId;
    $companyname=$user->company[0]->companyname;
    $profile_pic=$user->company[0]->profile_pic;
    $trn=$user->company[0]->trn;
} else {
		$storeId=0;
    $companyname='';
    $profile_pic='assets/media/companies/default.png';
		$trn='';
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
  <div class="row">
    <div class="col-md-6">
      <div class="kt-portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Company Profile
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form" id="jbform">
											<div class="kt-portlet__body">
												<div class="kt-section kt-section--first">
                          <input type="hidden" id="supplierId" name="supplierId" value="<?php echo $userId;?>">
                          <input type="hidden" id="categoriesId" name="categoriesId" >
													<input type="hidden" id="brandsId" name="brandsId" >
													<input type="hidden" id="storeId" name="storeId" value="<?php echo $storeId;?>">
													<div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">Store Logo</label>
													<div class="col-lg-9 col-xl-6">
														<div class="kt-avatar kt-avatar--outline" id="kt_user_add_avatar">
															<div class="kt-avatar__holder" style="background-image: url(<?php echo $profile_pic;?>)"></div>
															<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
																<i class="fa fa-pen"></i>
																<input type="file" name="store_pic" id="store_pic">
																<input type="hidden" name="old_store_pic" id="old_store_pic" value="<?php echo $profile_pic;?>">
															</label>
															<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
																<i class="fa fa-times"></i>
															</span>
														</div>
													</div>
												</div>
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Enter store name" name="companyname" id="companyname" value="<?php echo $companyname;?>">
														<span class="form-text text-muted">Please enter your store name.</span>
													</div>
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Enter TRN no." name="trn" id="trn" value="<?php echo $trn;?>">
														<span class="form-text text-muted">Please enter your TRN no.</span>
													</div>
													<div class="form-group">
																<select id="kt_form_cat" class="form-control kt-selectpicker" multiple data-live-search="true">
																</select>
														<span class="form-text text-muted">Choose store categories.</span>
													</div>
													<div class="form-group">
																<select id="kt_form_brnd" class="form-control kt-selectpicker" multiple data-live-search="true">
																	<?php
																		foreach ($brands as $brand) {
																			echo '<option value="'.$brands->brandId.'">'.$brands->brand_name.'</option>';
																		}
																	?>
																</select>
														<span class="form-text text-muted">Choose store brands.</span>
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
<script type="text/javascript">
$(document).ready(function(){
	$.ajax({url: DIR_CONT+DIR_BRND+"CON_brandcategory.php?action=get-list", success: function(result){
		$('#kt_form_brnd').html(result).selectpicker('refresh');
		$('#kt_form_brnd').selectpicker('val', <?php echo json_encode($sel_brands)?>);
 }});
	$.ajax({url: DIR_CONT+DIR_CAT+"CON_categories.php?action=get-list", success: function(result){
		$('#kt_form_cat').html(result).selectpicker('refresh');
		$('#kt_form_cat').selectpicker('val', <?php echo json_encode($sel_categories)?>);
 }});
});
$('#kt_form_cat,#kt_form_brnd').selectpicker();
$('#kt_form_cat').on('change', function() {
	$('#categoriesId').val($('#kt_form_cat').val());
});
$('#kt_form_brnd').on('change', function() {
	$('#brandsId').val($('#kt_form_brnd').val());
});
$('#btn_submit').click(function(e) {
    e.preventDefault();
    var form = $(this).closest('form');
		var btn = $(this);
    var formdata1 = new FormData($('#jbform')[0]);
		if($('#store_pic').prop('files').length > 0)
    {
        file =$('#store_pic').prop('files')[0];
        formdata1.append("store_picture", file);
    }else {
			file ="";
			formdata1.append("store_picture", file);
    }
    form.validate({
        rules: {
						companyname: {
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
        url: DIR_CONT+DIR_STR+"CON_stores.php?action=post",
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
										//Simulate an HTTP redirect:
										window.location.replace(
												DIR_VIEW+DIR_USR+"form_userstore.php"
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
                            'Incorrect Product data. Please try again.');
                    }, 2000);
                    break;
                default:
								// similate 2s delay
								setTimeout(function() {
										//Simulate an HTTP redirect:
										window.location.replace(
												DIR_VIEW+DIR_USR+"form_userstore.php"
										);
								}, 2000);
            }
        }
    });
});
</script>
