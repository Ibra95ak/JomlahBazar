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
			break;
		case 2:
			include("../".DIR_CON."header_supplier.php");
			break;

		default:
			include("../".DIR_CON."header_buyer.php");
			break;
	}
	/*Call Users class*/
	require_once '../../'.DIR_MOD.'Ser_Products.php';
	/*Create Product Instance*/
	$db = new Ser_Products();
	$products_count = $db->countProductsBySupplierId($userId)['count_pro'];
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
?>
						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
              <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                  <div class="kt-portlet__head-label">
                    <h2 class="kt-portlet__head-title">
                      Add a product by searching Code, Brand, Name or Category:
                    </h2>
                  </div>
                </div>
                <div class="kt-portlet__body">

                  <!--begin: Search Form -->
                  <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                      <div class="col-xl-4 order-2 order-xl-1">
                        <div class="row align-items-center">
                          <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-input-icon kt-input-icon--left">
                              <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                              <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                <span><i class="la la-search"></i></span>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
											<div class="col-xl-2 order-2 order-xl-1">
												<div class="alert alert-secondary" role="alert">
														<div class="alert-text">Total Products: <?php echo $products_count?></div>
													</div>
											</div>
                    </div>
                  </div>

                  <!--end: Search Form -->
									<!--begin: Selected Rows Group Action Form -->
									<div class="kt-form kt-form--label-align-right kt-margin-t-20 collapse" id="kt_datatable_group_action_form">
										<div class="row align-items-center">
											<div class="col-xl-12">
												<div class="kt-form__group kt-form__group--inline">
													<div class="kt-form__label kt-form__label-no-wrap">
														<label class="kt-font-bold kt-font-danger-">Selected
															<span id="kt_datatable_selected_number">0</span> records:</label>
													</div>
													<div class="kt-form__control">
														<div class="btn-toolbar">
															<button class="btn btn-sm btn-yashmi" type="button" id="kt_modal_fetch_id">Sell these products</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end: Selected Rows Group Action Form -->
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                  <!--begin: Datatable -->
                  <div class="kt-datatable" id="rec-dt"></div>
                  <!--end: Datatable -->
                </div>
								<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">My Product Prices</h5>
												<button id="close-modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
												</button>
											</div>
											<div class="modal-body">
												<form class="kt-form" id="jbform">
													<div class="kt-portlet__body">
														<input type="hidden" class="form-control" id="productId" name="productId">
														<div class="form-group">
														  <div class="row">
														    <div class="col-md-4">
														      <label for="totalquantity" class="form-control-label">Total Quantity:</label>
														      <input type="number" class="form-control" id="totalquantity" name="totalquantity">
														    </div>
														    <div class="col-md-4">
														      <label for="boxquantity" class="form-control-label">Box Quantity:</label>
														      <input type="number" class="form-control" id="boxquantity" name="boxquantity">
														    </div>
																<div class="col-md-4">
														      <label for="is_carton" class="form-control-label">Selling per piece :</label>
														      <select class="form-control" name="is_carton" id="is_carton">
																		<option value="2">Piece</option>
														      </select>
														    </div>
														  </div>
														</div>
														<div class="form-group">
														  <div class="row border border-dark kt-p5">
														    <div class="col-md-6">
														      <label for="range1" class="form-control-label">Range 1:<i class="fa fa-info-circle kt-ml-5" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Is pack of minimum order qty, for example it can be 1,3 or 24."></i></label>
														      <input type="number" class="form-control" id="range1" name="range1">
														    </div>
														    <div class="col-md-6">
														      <label for="price1" class="form-control-label">Price 1:<i class="fa fa-info-circle kt-ml-5" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Is piece price ,it should include 0.5% of seller fee."></i></label>
														      <input type="number" class="form-control" id="price1" name="price1" step="0.01" onchange="CALsellingprice()">
														    </div>
														  </div>
														</div>
														<div class="form-group">
														  <div class="row border border-dark kt-p5">
														    <div class="col-md-6">
														      <label for="range2" class="form-control-label">Range 2:<i class="fa fa-info-circle kt-ml-5" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Is a higher range of Qty for better wholesale price."></i></label>
														      <input type="number" class="form-control" id="range2" name="range2">
														    </div>
														    <div class="col-md-6">
														      <label for="price2" class="form-control-label">Price 2:<i class="fa fa-info-circle kt-ml-5" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Is lower piece price in compare with Price 1 becuase of higher Qty & it should include 0.5% of seller fee."></i></label>
														      <input type="number" class="form-control" id="price2" name="price2" step="0.01" onchange="CALsellingprice()">
														    </div>
														  </div>
														</div>
														<div class="form-group">
														  <div class="row">
																<div class="col-md-6">
														      <label for="tax" class="form-control-label">Tax:<i class="fa fa-info-circle kt-ml-5" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="For example UAE is 5%."></i></label>
														      <input type="number" class="form-control" id="tax" name="tax" step="0.01" min="0" onchange="CALsellingprice()">
														    </div>
																<div class="col-md-6">
														      <label for="discount" class="form-control-label">Discount:<i class="fa fa-info-circle kt-ml-5" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Discount as percentage."></i></label>
														      <input type="number" class="form-control" id="discount" name="discount" step="0.01" min="0" onchange="CALsellingprice()">
														    </div>
														  </div>
														</div>
														<div class="form-group">
														  <div class="row">
																<div class="col-md-6">
														      <label for="sellingprice" class="form-control-label">Calculated Selling Price:<i class="fa fa-info-circle kt-ml-5" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Seller price(including 0.5% fee) + VAT + Discount (if applicable)."></i></label>
														      <input type="number" class="form-control" id="calsellingprice" name="calsellingprice" disabled>
														      <input type="hidden" class="form-control" id="sellingprice" name="sellingprice">
														    </div>
																<div class="col-md-6">
														      <label for="origin" class="form-control-label">Source origin:</label>
														      <input type="text" class="form-control" id="origin" name="origin">
														    </div>
															</div>
														</div>
														<div class="form-group">
														  <div class="row">
														    <div class="col-md-6">
														      <label for="production_date" class="form-control-label">Production Date:</label>
																	<input type="text" class="form-control" name="production_date" id="production_date" readonly="" placeholder="Select date">
														    </div>
														    <div class="col-md-6">
														      <label for="expiry_date" class="form-control-label">Expiry Date:</label>
														      <input type="text" class="form-control" name="expiry_date" id="expiry_date" readonly="" placeholder="Select date">
														    </div>
														  </div>
														</div>
														<div class="form-group">
														  <div class="row">
														    <div class="col-md-6">
														      <label for="temperature" class="form-control-label">Temperature:</label>
														      <input type="text" class="form-control" id="temperature" name="temperature">
														    </div>
														    <div class="col-md-6">
														      <label for="humidity" class="form-control-label">Humidity:</label>
														      <input type="text" class="form-control" id="humidity" name="humidity">
														    </div>
														  </div>
														</div>
														<div class="form-group">
														  <div class="row">
														    <div class="col-md-3">
																	<label class="kt-checkbox kt-checkbox--solid form-control-label kt-mt-40">
																		<input type="checkbox" name="is_domestic" id="is_domestic" value="1"> Export only:
																		<span></span>
																	</label>
														    </div>
														    <div class="col-md-3">
																	<label class="kt-checkbox kt-checkbox--solid form-control-label kt-mt-40">
																		<input type="checkbox" name="is_pickable" id="is_pickable" value="1"> Pickable:
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
										</div>
									</div>
								</div>
              </div>
						</div>
						<!-- end:: Content -->
					</div>

<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script id="page_id" src="assets/js/pages/crud/metronic-datatable/advanced/data-supplierproducts.js?userId=<?php echo $userId;?>" type="text/javascript"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
