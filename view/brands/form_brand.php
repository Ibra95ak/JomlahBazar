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
$res_cat = $client->request('GET', DIR_JSON.'Read.php?jsonname=categories.json');/*fetch all categories*/
$categories=json_decode($res_cat->getBody());
/*URL parameters*/
if (isset($_GET['brandId'])) {
    $brandId=$_GET['brandId'];
} else {
    $brandId=0;
}
$allbrandscategories = array();
foreach($categories->data as $category) {
	array_push($allbrandscategories,array('value' => $category->name, 'id' => $category->categoryId));
}
/*Fetch JB brand*/
if($brandId!=0){
  $res_brnd = $client->request('GET', DIR_CONT.DIR_BRND.'CON_brands.php?action=get&brandId='.$brandId);/*fetch all categories*/
	$brand=json_decode($res_brnd->getBody());
  print_r($brand);
	$brand_name=$brand->brands->brand_name;
	$path=$brand->brands->path;
	$active=$brand->brands->active;
	$brandcategories=json_encode($brand->brandcategories);
}else{
	$brand_name='';
	$path='../../assets/media/brands/default.jpg';
	$active='2';
	$brandcategories='';
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
																				Manage BRAND
																			</h3>
																		</div>
																	</div>
																	<!--begin::Form-->
																	<form class="kt-form" id="jbform">
																		<div class="kt-portlet__body">
																			<div class="kt-section kt-section--first">
																				<div class="form-group row">
																				<label class="col-xl-3 col-lg-3 col-form-label">Brand Logo</label>
																				<div class="col-lg-9 col-xl-6">
																					<div class="kt-avatar kt-avatar--outline" id="kt_user_add_avatar">
																						<div class="kt-avatar__holder" style="background-image: url(<?php echo '../../'.$path;?>)"></div>
																						<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
																							<i class="fa fa-pen"></i>
																							<input type="file" name="path" id="path">
																						</label>
																						<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
																							<i class="fa fa-times"></i>
																						</span>
																					</div>
																				</div>
																			</div>
																				<div class="form-group">
																					<input type="text" class="form-control" placeholder="Enter brand name" name="brand_name" id="brand_name" value="<?php echo $brand_name;?>">
																					<span class="form-text text-muted">Please enter your brand name.</span>
																				</div>
																				<div class="form-group">
																					<input type="hidden" id="brand_categoriesId" name="brand_categoriesId" >
																					<input id="kt_tagify_2" placeholder='type...' value='' data-blacklist=''>
																					<span class="form-text text-muted">Choose brand categories.</span>
																				</div>
																				<div class="form-group">
																					<div class="kt-checkbox-list">
																						<label class="kt-checkbox">
																							<input type="checkbox" name="active" id="active" <?php if($active==1) echo "checked";?>> Activate
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
    console.log(form);
    var formdata1 = new FormData($('#jbform')[0]);
    console.log(formdata1);
    form.validate({
        rules: {
            brand_name: {
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
        url: DIR_CONT+DIR_BRND+"CON_brands.php?action=post&brandId=<?php echo $brandId?>",
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
<script>
var input = document.getElementById('kt_tagify_2');
var tagify = new Tagify(input, {
		enforceWhitelist: true,
		whitelist: <?php print_r(json_encode($allbrandscategories));?>
});
tagify
  .on('add', e => getdata(tagify.value))
  .on('remove', e => getdata(tagify.value))
tagify.addTags(<?php echo $brandcategories;?>);
function getdata(data){
	var brand_categoriesId = document.getElementById('brand_categoriesId');
	var categoryId = "";
	data.forEach((item, i) => {
		if(i==0) categoryId+=item['id'];
		else categoryId+=","+item['id'];
	});
	brand_categoriesId.value=categoryId;
}
</script>
