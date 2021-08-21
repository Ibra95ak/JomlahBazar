<?php
/*URL parameters*/
if (isset($_GET['subcategoryId'])) {
    $subcategoryId=$_GET['subcategoryId'];
} else {
    $subcategoryId=0;
}
if (isset($_GET['categoryId'])) {
    $categoryId=$_GET['categoryId'];
} else {
    $categoryId=0;
}
/*Fetch JB Categories*/
$categories=json_decode(file_get_contents(DIR_JSON."Read.php?jsonname=categories.json"));
/*Fetch JB Roles*/
if($subcategoryId!=0){
	$subcategory=json_decode(file_get_contents(DIR_CONT."CON_subcategories.php?action=get&subcategoryId=".$subcategoryId));
	$categoryId=$subcategory->categoryId;
	$name=$subcategory->name;
	$icon=$subcategory->icon;
	$active=$subcategory->active;
}else{
	$name='';
	$icon='assets/media/users/default.jpg';
	$active='2';
}

/*Get page header*/
include("header.php");
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
																				Manage subcategory
																			</h3>
																		</div>
																	</div>
																	<!--begin::Form-->
																	<form class="kt-form" id="jbform">
																		<div class="kt-portlet__body">
																			<div class="kt-section kt-section--first">
																				<div class="form-group row">
																				<label class="col-xl-3 col-lg-3 col-form-label">subcategory Logo</label>
																				<div class="col-lg-9 col-xl-6">
																					<div class="kt-avatar kt-avatar--outline" id="kt_user_add_avatar">
																						<div class="kt-avatar__holder" style="background-image: url(<?php echo $icon;?>)"></div>
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
																				<select class="form-control" name="categoryId" id="categoryId" required>
																					<option>Choose your Category</option>
																					<?php
				foreach ($categories->data as $category) {
					if ($category->categoryId==$categoryId) {
							echo '<option value="'.$category->categoryId.'" selected>'.$category->name.'</option>';
					} else {
							echo '<option value="'.$category->categoryId.'">'.$category->name.'</option>';
					}
				}
				?>
																				</select>
																				<span class="form-text text-muted">Please select your Category.</span>
																			</div>
																				<div class="form-group">
																					<input type="text" class="form-control" placeholder="Enter subcategory name" name="name" id="name" value="<?php echo $name;?>">
																					<span class="form-text text-muted">Please enter your subcategory name.</span>
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
																				<button type="submit" class="btn btn-primary" id="btn_submit">Submit</button>
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
        url: DIR_CONT+"CON_subcategories.php?action=post&subcategoryId=<?php echo $subcategoryId;?>",
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
                            DIR_VIEW+DIR_SCAT+"dt_subcategories.php"
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
