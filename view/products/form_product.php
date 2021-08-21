<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if (isset($_SESSION['userId'])) {
    $res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
    $usr = json_decode($res_uid->getBody());
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
} else {
    header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
/*URL parameters*/
if (isset($_GET['categoryId'])) {
    $categoryId=$_GET['categoryId'];
} else {
    $categoryId=0;
}
/*Fetch JB Main Categories*/
$res_mcat = $client->request('GET', DIR_CONT.DIR_CAT.'CON_categories.php?action=get-mcat');
$maincategories=json_decode($res_mcat->getBody());

$maincategoryId=0;
?>
						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<!--Begin::Dashboard 3-->
              <div class="kt-portlet">
								<div class="kt-portlet__body kt-portlet__body--fit">
									<div class="kt-grid kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="first">
										<div class="kt-grid__item">

											<!--begin: Form Wizard Nav -->
											<div class="kt-wizard-v1__nav">

												<!--doc: Remove "kt-wizard-v1__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
												<div class="kt-wizard-v1__nav-items kt-wizard-v1__nav-items--clickable">
													<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
														<div class="kt-wizard-v1__nav-body">
															<div class="kt-wizard-v1__nav-icon">
																<i class="flaticon-bus-stop"></i>
															</div>
															<div class="kt-wizard-v1__nav-label">
																Product
															</div>
														</div>
													</div>
													<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
														<div class="kt-wizard-v1__nav-body">
															<div class="kt-wizard-v1__nav-icon">
																<i class="flaticon-list"></i>
															</div>
															<div class="kt-wizard-v1__nav-label">
																Product Details
															</div>
														</div>
													</div>
													<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
														<div class="kt-wizard-v1__nav-body">
															<div class="kt-wizard-v1__nav-icon">
																<i class="flaticon-responsive"></i>
															</div>
															<div class="kt-wizard-v1__nav-label">
																Product Images
															</div>
														</div>
													</div>
													<div class="kt-wizard-v1__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
														<div class="kt-wizard-v1__nav-body">
															<div class="kt-wizard-v1__nav-icon">
																<i class="flaticon-truck"></i>
															</div>
															<div class="kt-wizard-v1__nav-label">
																Review
															</div>
														</div>
													</div>
												</div>
											</div>

											<!--end: Form Wizard Nav -->
										</div>
										<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">

                      <img src="<?php echo DIR_MED.DIR_CON."";?>" alt="">
											<!--begin: Form Wizard Form-->
											<form class="kt-form" id="kt_form" novalidate="novalidate">
                        <input type="hidden" name="supplierId" id="supplierId" value="<?php echo $userId;?>">
												<!--begin: Form Wizard Step 1-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
													<div class="kt-heading kt-heading--md">Add Your Product Information</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">
                              <div class="row">
																<div class="col-xl-12">
																	<div class="kt-section__body">
																		<div class="row">
																			<div class="form-group col-lg-12 col-xl-12">
																				<input class="form-control" name="name" id="name"  type="text" placeholder="Product name" value="">
																				<span class="form-text text-muted">* Mandatory-Please Note product's Name should have Brand, category and specific Name,color, size and any number or searchable feature </span>
																			</div>
																		</div>
																		<div class="row">
																			<div class="form-group col-xl-4">
																				<select name="maincategoryId" id="maincategoryId" class="form-control">
																					<option value="">Choose Main Category</option>
                                          <?php
                                          foreach ($maincategories->maincategories as $maincategory) {
                                              if ($maincategory->maincategoryId==$maincategoryId) {
                                                  echo '<option value="'.$maincategory->maincategoryId.'" selected>'.$maincategory->name.'</option>';
                                              } else {
                                                  echo '<option value="'.$maincategory->maincategoryId.'">'.$maincategory->name.'</option>';
                                              }
                                          }
                                          ?>
																				</select>
                                        <span class="form-text text-muted">* Mandatory ; if you cannot find your product category or Sub category, please call seller customercare.</span>
																			</div>
																			<div class="form-group col-xl-4">
																				<select name="categoryId" id="categoryId" class="form-control" >
																					<option value="">Choose Category</option>
																				</select>
                                        <span class="form-text text-muted">* Mandatory</span>
																			</div>
																			<div class="form-group col-xl-4">
																				<select name="brandId" id="brandId" class="form-control" >
																					<option value="">Choose Brand</option>
																				</select>
                                        <span class="form-text text-muted">* Mandatory</span>
																			</div>
																		</div>
																		<div class="form-group row">
                                      <textarea class="form-control" name="description" id="description" rows="3" spellcheck="false" placeholder="Enter product description; this will help buyer find your product based on features."></textarea>
																		</div>
                                    <div class="form-group row">
                                      <div class="col-lg-4 col-xl-4">
																				<input class="form-control" name="asin" id="asin"  type="text" placeholder="Product asin" value="">
																				<span class="form-text text-muted">Please enter product asin,for help search :<a href="https://amazon-asin.com/" class="kt-link" target="_blank">here</a></span>
																			</div>
                                      <div class="col-lg-4 col-xl-4">
																				<input class="form-control" name="barcode" id="barcode" type="text" placeholder="Product barcode" value="">
																				<span class="form-text text-muted">Please enter product barcode.</span>
																			</div>
                                      <div class="col-lg-4 col-xl-4">
																				<input class="form-control" name="coo" id="coo" type="text" placeholder="Product Country Of Origin" value="">
																				<span class="form-text text-muted">Please enter Country Of Origin.</span>
																			</div>
																		</div>
                                    <div class="row">
                                      <div class="form-group col-lg-3 col-xl-3">
																				<input class="form-control" name="weight" id="weight"  type="number" placeholder="Product weight">
																				<span class="form-text text-muted">*Mandatory- Please enter product weight, here you need to consider total weight of product  in addition of box or cover in piece and kg, For example a 100 ml perfume considering the glass is 170 ml which is 0.17 kg .</span>
																			</div>
                                      <div class="form-group col-lg-3 col-xl-3">
																				<input class="form-control" name="width" id="width" type="number" placeholder="Product width">
																				<span class="form-text text-muted">Please enter product width in CM.</span>
																			</div>
                                      <div class="form-group col-lg-3 col-xl-3">
																				<input class="form-control" name="length" id="length" type="number" placeholder="Product length">
																				<span class="form-text text-muted">Please enter product length in CM.</span>
																			</div>
                                      <div class="form-group col-lg-3 col-xl-3">
																				<input class="form-control" name="height" id="height" type="text" placeholder="Product height" value="">
																				<span class="form-text text-muted">Please enter product height in CM.</span>
																			</div>
																		</div>
                                    <div class="form-group row">
                                      <div class="col-lg-3 col-xl-3">
																				<input class="form-control" name="palette" id="palette "  type="number" placeholder="Product palette " value="">
																				<span class="form-text text-muted">Product Pieces per pallet.</span>
																			</div>
                                      <div class="col-lg-3 col-xl-3">
																				<input class="form-control" name="carton" id="carton" type="number" placeholder="Product carton" value="">
																				<span class="form-text text-muted">Product Pieces per carton.</span>
																			</div>
                                      <div class="col-lg-3 col-xl-3">
																				<input class="form-control" name="pack" id="pack" type="number" placeholder="Product pack" value="">
																				<span class="form-text text-muted">Product Pieces per pack.</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!--end: Form Wizard Step 1-->

												<!--begin: Form Wizard Step 2-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Enter the Details of your Product</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">
															<div id="food" style="display:none">
                                <div class="row">
                                  <div class="form-group col-lg-4 col-xl-4">
                                    <input class="form-control" name="food_size" id="food_size"  type="text" placeholder="Size" value="">
                                    <span class="form-text text-muted">Please enter product size , and unit , for example 100ml.</span>
                                  </div>
                                  <div class="form-group col-lg-4 col-xl-4">
                                    <input class="form-control" name="packageinformation" id="packageinformation" type="text" placeholder="Product package information" value="">
                                    <span class="form-text text-muted">Please enter product package information.</span>
                                  </div>
                                  <div class="form-group col-lg-4 col-xl-4">
                                    <input class="form-control" name="manufacturer" id="manufacturer" type="text" placeholder="Product manufacturer" value="">
                                    <span class="form-text text-muted">Please enter Product manufacturer.</span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-lg-6 col-xl-6">
                                    <textarea class="form-control" name="food_ingredients" id="food_ingredients" type="text" placeholder="Product ingredients"></textarea>
                                    <span class="form-text text-muted">Please enter product ingredients.</span>
                                  </div>
                                  <div class="form-group col-lg-6 col-xl-6">
                                    <textarea class="form-control" name="food_highlights" id="food_highlights" type="text" placeholder="Product highlights"></textarea>
                                    <span class="form-text text-muted">Please enter Product highlights.</span>
                                  </div>
                                </div>
                              </div>
															<div id="perfume" style="display:none">
                                <div class="row">
                                  <div class="form-group col-lg-4 col-xl-4">
                                    <input class="form-control" name="perfume_size" id="perfume_size"  type="text" placeholder="Size" value="">
                                    <span class="form-text text-muted">Please enter product size , and unit , for example 100ml.</span>
                                  </div>
                                  <div class="form-group col-lg-4 col-xl-4">
                                    <select class="form-control" name="fragrancefor" id="fragrancefor">
                                      <option value="">For</option>
                                      <option value="1">Women</option>
                                      <option value="2">Men</option>
                                      <option value="3">Both</option>
                                    </select>
                                    <span class="form-text text-muted">Please enter Fragrance gender type.</span>
                                  </div>
                                  <div class="form-group col-lg-4 col-xl-4">
                                    <input class="form-control" name="scenttype" id="scenttype" type="text" placeholder="Product Scent Type" value="">
                                    <span class="form-text text-muted">Please enter Product Scent Type.</span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-lg-6 col-xl-6">
                                    <textarea class="form-control" name="topnotes" id="topnotes" type="text" placeholder="Product topnotes"></textarea>
                                    <span class="form-text text-muted">Please enter product topnotes.</span>
                                  </div>
                                  <div class="form-group col-lg-6 col-xl-6">
                                    <div class="kt-checkbox-inline">
          														<label class="kt-checkbox">
          															<input type="checkbox" id="arabicscents" name="arabicscents" value="1"> Arabic Scents
          															<span></span>
          														</label>
          														<label class="kt-checkbox">
          															<input type="checkbox" id="luxuryperfume" name="luxuryperfume" value="1"> Luxury Perfume
          															<span></span>
          														</label>
          														<label class="kt-checkbox">
          															<input type="checkbox" id="giftset" name="giftset" value="1"> Gift Set
          															<span></span>
          														</label>
          														<label class="kt-checkbox">
          															<input type="checkbox" id="tester" name="tester" value="1"> Tester
          															<span></span>
          														</label>
          													</div>
                                  </div>
                                </div>
                              </div>
															<div id="makeup" style="display:none">
                                <div class="row">
                                  <div class="form-group col-lg-4 col-xl-4">
                                    <input class="form-control" name="makeup_size" id="makeup_size"  type="text" placeholder="Size" value="">
                                    <span class="form-text text-muted">Please enter product size , and unit , for example 100ml.</span>
                                  </div>
                                  <div class="form-group col-lg-4 col-xl-4">
                                    <input class="form-control" name="makeup_color" id="makeup_color" type="text" placeholder="color" value="">
                                    <span class="form-text text-muted">Please enter color.</span>
                                  </div>
                                  <div class="form-group col-lg-4 col-xl-4">
                                    <input class="form-control" name="shadename" id="shadename" type="text" placeholder="Product Shade Name" value="">
                                    <span class="form-text text-muted">Please enter Product Shade Name.</span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-lg-6 col-xl-6">
                                    <textarea class="form-control" name="makeup_ingredients" id="makeup_ingredients" type="text" placeholder="Product ingredients"></textarea>
                                    <span class="form-text text-muted">Please enter product ingredients.</span>
                                  </div>
                                  <div class="form-group col-lg-6 col-xl-6">
                                    <textarea class="form-control" name="makeup_highlights" id="makeup_highlights" type="text" placeholder="Product highlights"></textarea>
                                    <span class="form-text text-muted">Please enter product highlights.</span>
                                  </div>
                                </div>
                              </div>
															<div id="care" style="display:none">
                                <div class="row">
                                  <div class="form-group col-lg-3 col-xl-3">
                                    <input class="form-control" name="care_size" id="care_size"  type="text" placeholder="Size" value="">
                                    <span class="form-text text-muted">*- Mandatory ,Please enter product size , and unit , for example 100ml.</span>
                                  </div>
                                  <div class="form-group col-lg-3 col-xl-3">
                                    <select class="form-control" name="formen_women" id="formen_women">
                                      <option value="">Gender</option>
                                      <option value="1">Women</option>
                                      <option value="2">Men</option>
                                      <option value="3">Both</option>
                                    </select>
                                    <span class="form-text text-muted">Please enter gender type.</span>
                                  </div>
                                  <div class="form-group col-lg-3 col-xl-3">
                                    <input class="form-control" name="count" id="count" type="text" placeholder="Product count" value="">
                                    <span class="form-text text-muted">Please enter Product count.</span>
                                  </div>
                                  <div class="form-group col-lg-3 col-xl-3">
                                    <input class="form-control" name="hair_skintypes" id="hair_skintypes" type="text" placeholder="Product hair skin types" value="">
                                    <span class="form-text text-muted">Please enter Product hair skin types.</span>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="form-group col-lg-6 col-xl-6">
                                    <textarea class="form-control" name="care_ingredients" id="care_ingredients" type="text" placeholder="Product ingredients"></textarea>
                                    <span class="form-text text-muted">Please enter product ingredients.</span>
                                  </div>
                                  <div class="form-group col-lg-6 col-xl-6">
                                    <textarea class="form-control" name="care_highlights" id="care_highlights" type="text" placeholder="Product highlights"></textarea>
                                    <span class="form-text text-muted">Please enter product highlights.</span>
                                  </div>
                                </div>
                              </div>
														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 2-->

												<!--begin: Form Wizard Step 3-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Select Product pictures</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form row">
                              <div class="col-lg-4 col-md-6 col-sm-12">
                                <label class="col-form-label">Product front picture</label>
                                <div class="dropzone dropzone-default" id="kt_dropzone_1">
                                  <div class="dropzone-msg dz-message needsclick">
                                    <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-6 col-sm-12">
                                <label class="col-form-label">Product pictures</label>
        												<div class="dropzone dropzone-default dropzone-brand dz-clickable" id="kt_dropzone_2">
        													<div class="dropzone-msg dz-message needsclick">
        														<h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
        														<span class="dropzone-msg-desc">Upload up to 5 files</span>
        													</div>
        												</div>
        											</div>
                              <input type="hidden" id="featured_path" name="featured_path">
                              <input type="hidden" id="path" name="path">
														</div>
													</div>
												</div>

												<!--end: Form Wizard Step 3-->

												<!--begin: Form Wizard Step 4-->
												<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
													<div class="kt-heading kt-heading--md">Review Product</div>
													<div class="kt-form__section kt-form__section--first">
														<div class="kt-wizard-v1__form">
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
							<!--End::Dashboard 3-->
						</div>

						<!-- end:: Content -->
					</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script src="assets/js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
<script>
/*Main Category change event*/
$("#maincategoryId").change(function(){
  var maincategoryId = $("#maincategoryId").val();
  $.ajax({
    url: DIR_CONT+DIR_CAT+'CON_categories.php?action=get-mcat-cat-dropdown&maincategoryId='+maincategoryId,
    success: function(result){
    document.getElementById("categoryId").innerHTML = "";
    $("#categoryId").html(result);
    $("#categoryId").trigger('change');
    displaydetails(maincategoryId);
  }});
});
$("#categoryId").change(function(){
  var categoryId = $("#categoryId").val();
  $.ajax({
    url: DIR_CONT+DIR_BRND+'CON_brands.php?action=get-category-brands&categoryId='+categoryId,
    success: function(result){
    document.getElementById("brandId").innerHTML = "";
    $("#brandId").html(result);
  }});
});
// single file upload
$('#kt_dropzone_1').dropzone({
    url: DIR_CONT+DIR_CON+"CON_upload_pimg.php?path=products", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 1,
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        document.getElementById('featured_path').value=file.name;
        done();
    },
    removedfile: function(file) {
        $('#featured_path').val('');
         file.previewElement.remove();
    }
});
var paths = '';
$('#kt_dropzone_2').dropzone({
    url: DIR_CONT+DIR_CON+"CON_upload_pimg.php?path=products", // Set the url for your upload script location
    paramName: "file", // The name that will be used to transfer the file
    maxFiles: 5,
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    accept: function(file, done) {
        paths+= file.name+",";
        document.getElementById('path').value=paths.slice(0, -1);
        done();
    },
    removedfile: function(file) {
      file.previewElement.remove();
      document.getElementById('path').value='';
      removepaths=paths.replace(file.name,'');
      removecommaspaths=removepaths.replace(',,',',');
      var firstchar = removecommaspaths.charAt(0);
      if (firstchar==',') paths=removecommaspaths.substring(1);
      else paths=removecommaspaths;
      document.getElementById('path').value=paths.slice(0, -1);
    }
});
function displaydetails(maincategoryId){
  switch (maincategoryId) {
    case '1':
      $('#food').show();
      $('#perfume').hide();
      $('#makeup').hide();
      $('#care').hide();
      break;
    case '2':
    $('#perfume').show();
    $('#food').hide();
    $('#makeup').hide();
    $('#care').hide();
      break;
    case '3':
    $('#makeup').show();
    $('#food').hide();
    $('#perfume').hide();
    $('#care').hide();
      break;
    case '4':
    $('#care').show();
    $('#food').hide();
    $('#perfume').hide();
    $('#makeup').hide();
      break;
    case '5':
    $('#food').show();
    $('#perfume').hide();
    $('#makeup').hide();
    $('#care').hide();
      break;
    default:
    $('#food').hide();
    $('#perfume').hide();
    $('#makeup').hide();
    $('#care').hide();
  }
}
</script>
