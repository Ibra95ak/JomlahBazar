<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
$res_cat = $client->request('GET', DIR_JSON.'categories.json');/*fetch all categories*/
$categories=json_decode($res_cat->getBody());
$res_brnd = $client->request('GET', DIR_JSON.'brands.json');/*fetch all categories*/
$brands=json_decode($res_brnd->getBody());
include("../" . DIR_CON . "header_admin.php");
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						Products
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!--begin: Search Form -->
				<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
					<div class="row align-items-center">
						<div class="col-xl-12 order-2 order-xl-1">
							<div class="row align-items-center">
								<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
									<div class="kt-input-icon kt-input-icon--left">
										<input type="text" class="form-control" placeholder="Search..." id="generalSearch">
										<span class="kt-input-icon__icon kt-input-icon__icon--left">
											<span><i class="la la-search"></i></span>
										</span>
									</div>
								</div>
								<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
									<div class="kt-form__group kt-form__group--inline">
										<div class="kt-form__label">
											<label>Category:</label>
										</div>
										<div class="kt-form__control">
											<select class="form-control bootstrap-select" id="kt_form_cats">
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
								<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
									<div class="kt-form__group kt-form__group--inline">
										<div class="kt-form__label">
											<label>Brands:</label>
										</div>
										<div class="kt-form__control">
											<select class="form-control bootstrap-select" id="kt_form_brnds">
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
								<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
									<div class="kt-form__group kt-form__group--inline">
										<div class="kt-form__label">
											<label>Rating:</label>
										</div>
										<div class="kt-form__control">
											<select class="form-control bootstrap-select" id="kt_form_rnk">
												<option value="">All</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row align-items-center kt-mt-10">
						<div class="col-xl-12 order-2 order-xl-1">
							<div class="row align-items-center">
								<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
									<div class="kt-form__group kt-form__group--inline">
										<div class="kt-form__label">
											<label>Status:</label>
										</div>
										<div class="kt-form__control">
											<select class="form-control bootstrap-select" id="kt_form_status">
												<option value="">All</option>
												<option value="1">Active</option>
												<option value="2">Inactive</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
									<div class="kt-form__group kt-form__group--inline">
										<div class="kt-form__label">
											<label>Best Seller:</label>
										</div>
										<div class="kt-form__control">
											<select class="form-control bootstrap-select" id="kt_form_brands">
												<option value="">All</option>
												<option value="1">YES</option>
												<option value="2">NO</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
									<div class="kt-form__group kt-form__group--inline">
										<div class="kt-form__label">
											<label>Limited Offer:</label>
										</div>
										<div class="kt-form__control">
											<select class="form-control bootstrap-select" id="kt_form_ft">
												<option value="">All</option>
												<option value="1">YES</option>
												<option value="2">NO</option>
											</select>
										</div>
									</div>
								</div>
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
										<div class="dropdown">
											<button type="button" class="btn btn-brand btn-sm dropdown-toggle" data-toggle="dropdown">
												Update status
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item" href="#">Pending</a>
												<a class="dropdown-item" href="#">Delivered</a>
												<a class="dropdown-item" href="#">Canceled</a>
											</div>
										</div>
										&nbsp;&nbsp;&nbsp;
										<button class="btn btn-sm btn-danger" type="button" id="kt_datatable_delete_all">Delete All</button>
										&nbsp;&nbsp;&nbsp;
										<button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#kt_modal_fetch_id">Fetch Selected Records</button>
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
				<div class="kt-datatable" id="local_record_selection"></div>

				<!--end: Datatable -->
			</div>
		</div>
	<!--End::Dashboard 3-->
</div>
<!-- end:: Content -->
</div>
<?php
include(DIR_VIEW.DIR_CON."footer_admin.php");
?>
<script src="assets/js/pages/crud/metronic-datatable/advanced/record-products.js" type="text/javascript"></script>
