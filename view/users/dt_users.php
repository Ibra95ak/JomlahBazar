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
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_users.php?action=get');/*fetch user info*/
$users=json_decode($res_user->getBody());
$res_cat = $client->request('GET', DIR_CONT.DIR_CAT.'CON_categories.php?action=get');/*fetch all categories*/
/*Fetch JB Categories*/
$categories=json_decode($res_cat->getBody());
$res_brnd = $client->request('GET', DIR_CONT.DIR_BRND.'CON_brands.php?action=get');/*fetch all categories*/
$brands=json_decode($res_brnd->getBody());
$res_roles = $client->request('GET', DIR_JSON.'Read.php?jsonname=roles.json');/*fetch all companies*/
$roles=json_decode($res_roles->getBody());
?>
							<!-- begin:: Content -->
							<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
								<div class="row">
									 <div class="col-md-12 kt-p0">
	 									<img src="<?php echo DIR_ROOT.DIR_MED.DIR_CON?>bussinessworld.png" alt="" style="height: 300px;width: 100%;">
	 								</div>
								</div>
								<div class="row">
								 <div class="col-md-12 store_header"></div>
							 	</div>
								<div class="row safari-row-flex">
								<div class="kt-portlet kt-portlet--mobile">
									<div class="kt-portlet__head kt-portlet__head--lg">
										<div class="kt-portlet__head-label">
											<img src="<?php echo DIR_ROOT.DIR_MED.DIR_CON?>storeslocation.png" alt="" class="kt-mr-45 kt-width-300">
											<img src="<?php echo DIR_ROOT.DIR_MED.DIR_CON?>costumerservice.png" alt="" class="kt-width-200">
										</div>
										<div class="kt-portlet__head-toolbar">
											<div class="kt-portlet__head-wrapper">
												<div class="btn-group btn-group" role="group" aria-label="...">
																<button id="btn-dt" type="button" class="btn btn-secondary"><i class="fa fa-list"></i></button>
																<button id="btn-gd" type="button" class="btn btn-secondary"><i class="fa fa-th"></i></button>
																<button id="btn-map" type="button" class="btn btn-secondary"><i class="fa fa-globe"></i></button>
															</div>
											</div>
										</div>
									</div>
									<div class="kt-portlet__body">

										<!--begin: Search Form -->
										<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10 kt-hidden">
											<div class="row align-items-center">
												<div class="col-xl-8 order-2 order-xl-1">
													<div class="row align-items-center safari-row-flex">

														<div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
															<div class="kt-form__group kt-form__group--inline">
																<div class="kt-form__label">
																	<label>Brand:</label>
																</div>
																<div class="kt-form__control">
																	<select class="form-control bootstrap-select" id="kt_form_brand">
																		<option value="">All</option>
																		<?php
																		foreach ($brands as $brand) {
																				echo '<option value="'.$brand->brandId.'">'.$brand->brand_name.'</option>';
																		}
																		?>
																	</select>
																</div>

															</div>
														</div>
														<div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
															<div class="kt-form__group kt-form__group--inline">
																<div class="kt-form__label">
																	<label>Categoty:</label>
																</div>
																<div class="kt-form__control">
																	<select class="form-control bootstrap-select" id="kt_form_cat">
																		<option value="">All</option>
																		<?php
																		foreach ($categories as $category) {
																				echo '<option value="'.$category->categoryId.'">'.$category->name.'</option>';
																		}
																		?>
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-xl-3 order-1 order-xl-1">
													<div class="alert alert-outline-brand fade show" role="alert">
														<div class="alert-icon"><img src="<?php echo DIR_ROOT.DIR_ICON?>verify.png"></div>
														<div class="alert-text">Show Your Support by verifying your "Bussiness Partners"</div>
													</div>
												</div>
												<div class="col-xl-1 order-1 order-xl-1 kt-align-right">
	                        <a id="btn-adduser" href="form_user.php?userId=0" class="btn btn-default">
	                          <i class="la la-plus"></i> User
	                        </a>
	                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
												</div>
											</div>
										</div>

										<!--end: Search Form -->
									</div>
									<div class="kt-portlet__body kt-portlet__body--fit">
										<div class="row safari-row-flex">
											<div class="col-md-2">

												<!--begin::Portlet-->
												<div class="kt-portlet kt-mr-5">
													<!--begin::Form-->
													<form class="kt-form" id="filter-form">
														<div class="kt-portlet__body ">
															<input type="hidden" name="filter_category" id="filter_category" value="">
															<input type="hidden" name="filter_brand" id="filter_brand" value="">
															<input type="hidden" name="filter_company" id="filter_company" value="">
															<input type="hidden" name="filter_role" id="filter_role" value="">
															<div class="form-group">
																<div class="typeahead">
																	<input class="form-control" name="generalSearch" id="generalSearch" dir="ltr" type="text" placeholder="Seller Company Name" >
																</div>
															</div>
															<div class="form-group">
																<select class="form-control" id="order_by" name="order_by">
			                            <option value="0">Default Sorting</option>
			                            <option value="1">A to Z</option>
			                            <option value="2">Z to A</option>
																</select>
															</div>
															<div class="accordion  accordion-toggle-plus" id="accordionExample4">
																<div class="card">
																	<div class="card-header" id="headingTwo4">
																		<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
																			Categories
																		</div>
																	</div>
																	<div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordionExample4">
																		<div class="card-body">
																			<div class="form-group">
																				<div class="kt-checkbox-list">
																			<?php
																				foreach ($main_categories->data as $mcategory) {
																					echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																					echo '<input type="checkbox" class="checkbox_mcat" data-id="'.$mcategory->maincategoryId.'">'.$mcategory->name." (".$mcategory->count_pro.")";
																					echo '<span></span>';
																					echo '</label>';
			                                    $res_mcats = $client->request('GET', DIR_CONT.DIR_MCAT.'CON_maincategories.php?action=get&maincategoryId='.$mcategory->maincategoryId);/*fetch all categories*/
			                                    $mcategories=json_decode($res_mcats->getBody());
			                                    foreach ($mcategories->categories as $mcat) {
			                                      echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success" style="left:20px;">';
			  																		echo '<input type="checkbox"  onclick="filtercategory()" class="checkbox_cat mcat-'.$mcategory->maincategoryId.'" data-id="'.$mcat->categoryId.'">'.$mcat->name." (".$mcat->count_pro.")";
			  																		echo '<span></span>';
			  																		echo '</label>';
			                                    }
																				}
																			 ?>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="card">
																	<div class="card-header" id="headingOne4">
																		<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
																			 Brands
																		</div>
																	</div>
																	<div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4" style="">
																		<div class="card-body" id="rec-brand">
																			<div class="form-group">
																				<div class="kt-checkbox-list">
																			<?php
																				$count=0;
																				foreach ($brands as $brand) {
																					$count++;
																					if($count<=10){
																						echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																						echo '<input type="checkbox"  onclick="filterbrand()" class="checkbox_brnd" data-id="'.$brand->brandId.'">'.$brand->brand_name." (".$brand->count_pro.")";
																						echo '<span></span>';
																						echo '</label>';
																					}else break;
																				}
																			 ?>
																				<a href="javascript:void(0)" id="showmorebrands" class="kt-font-brand">Show more</a>
																				<div id="morebrands" style="display:none;">
																					<?php
																						$count=0;
																						foreach ($brands as $brand) {
																							$count++;
																							if($count<=10) continue;
																							else{
																								echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																								echo '<input type="checkbox"  onclick="filterbrand()" class="checkbox_brnd" data-id="'.$brand->brandId.'">'.$brand->brand_name." (".$brand->count_pro.")";
																								echo '<span></span>';
																								echo '</label>';
																							}
																						}
																					 ?>
																				 </div>
																				 </div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="card">
																	<div class="card-header" id="headingOne6">
																		<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6">
																			 Roles
																		</div>
																	</div>
																	<div id="collapseOne6" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4" style="">
																		<div class="card-body" id="rec-brand">
																			<div class="form-group">
																				<div class="kt-checkbox-list">
																			<?php
																				$count=0;
																				foreach ($roles->data as $role) {
																					$count++;
																					if($count<=10){
																						echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																						echo '<input type="checkbox"  onclick="filterrole()" class="checkbox_rl" data-id="'.$role->roleId.'">'.$role->role;
																						echo '<span></span>';
																						echo '</label>';
																					}else break;
																				}
																			 ?>
																		 </div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="kt-portlet__foot ">
															<div class="kt-form__actions">
																<button type="button" class="btn btn-warning" id="filter">Filter</button>
																<button type="reset" class="btn btn-secondary" onclick="resetfilter()">Reset</button>
															</div>
														</div>
													</form>

													<!--end::Form-->
												</div>

												<!--end::Portlet-->
											</div>
											<div class="col-md-10">
												<input type="hidden" name="page" id="page" value="1">
												<input type="hidden" name="pg" id="pg" value="1">
												<div class="btn-group btn-group kt-pb-5" role="group" id="map_type" style="display:none;">
													<button type="button" class="btn btn-secondary" id="worldloc">World Wide</button>
													<button type="button" class="btn btn-secondary" id="myloc">Your Location</button>
												</div>

												<div id="kt_gmap_3"></div>
												<!--begin: Datatable -->
													<div class="align-items-center" id="rec-lt" style="display:none"></div>
												<!--end: Datatable -->
												<!--Begin::Section-->
												<div class="row safari-row-flex align-items-center" id="rec-gd"></div>
											</div>
										</div>

										<!--End::Section-->
									</div>
								</div>
							</div>

							<!-- end:: Content -->
					</div>
					<?php
					if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
					else include(DIR_VIEW . DIR_CON . "guest-footer.php");
					?>
<script src="assets/js/pages/crud/metronic-datatable/advanced/data-users.js" type="text/javascript"></script>
<script type="text/javascript">
	var searchtext = getUrlParameter('searchtext');
	$("#generalSearch").val(searchtext);
	$("#generalSearch").focus();
	$("#generalSearch").trigger('change');
</script>
