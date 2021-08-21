<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
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
						Bank Transfers
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
										<input type="text" class="form-control" placeholder="Search by order number..." id="generalSearch">
										<span class="kt-input-icon__icon kt-input-icon__icon--left">
											<span><i class="la la-search"></i></span>
										</span>
									</div>
								</div>
								<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
									<div class="kt-form__group kt-form__group--inline">
										<div class="kt-form__label">
											<label>Status:</label>
										</div>
										<div class="kt-form__control">
											<select class="form-control bootstrap-select" id="kt_form_status">
												<option value="">All</option>
												<option value="Pending">Pending</option>
												<option value="Completed">Completed</option>
												<option value="Declined">Declined</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end: Search Form -->
			</div>
			<div class="kt-portlet__body kt-portlet__body--fit">

				<!--begin: Datatable -->
				<div class="kt-datatable" id="local_record_selection"></div>

				<!--end: Datatable -->
			</div>
		</div>
	<!--End::Dashboard 3-->
</div>
<!--begin::Modal-->
							<div class="modal fade" id="kt_modal_thumbnail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Receipt</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<input type="hidden" name="receipt" id="receipt" value="">
											<img src="" alt="" name="receipt_thumb" id="receipt_thumb" width="100%">
										</div>
									</div>
								</div>
							</div>

							<!--end::Modal-->
<!-- end:: Content -->
</div>
<?php
include(DIR_VIEW.DIR_CON."footer_admin.php");
?>
<script src="assets/js/pages/crud/metronic-datatable/advanced/record-banktransfers.js" type="text/javascript"></script>
