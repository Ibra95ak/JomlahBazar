<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
$res_uid = $client->request('GET', DIR_CONT . DIR_ADMN . 'CON_users.php?action=get');
include("../" . DIR_CON . "header_admin.php");
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="kt-portlet">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
				<i class="flaticon-users-1"></i>
				</span>
				<h3 class="kt-portlet__head-title">
				Users <small>(Buyers & Sellers)</small>
				</h3>
			</div>
		</div>
		<div class="kt-portlet__body">
			<div class="row">
				<div class="col-md-3">
					<input type="text" class="form-control" placeholder="Search by Name, Email, Phone or Nationality" id="generalSearch" name="generalSearch">
				</div>
				<div class="col-md-2">
					<select class="form-control bootstrap-select" id="kt_form_type">
						<option value="">All(User type)</option>
						<option value="1">Buyer</option>
						<option value="2">Seller</option>
					</select>
				</div>
				<div class="col-md-2">
					<select class="form-control bootstrap-select" id="kt_form_login">
						<option value="">All(Login)</option>
						<option value="1">Online</option>
						<option value="2">Offline</option>
					</select>
				</div>
				<div class="col-md-2">
					<select class="form-control bootstrap-select" id="kt_form_status">
						<option value="">All(Activated)</option>
						<option value="1">Active</option>
						<option value="2">Inactive</option>
						<option value="3">Blocked</option>
					</select>
				</div>
				<div class="col-md-2">
					<select class="form-control bootstrap-select" id="kt_form_role">
						<option value="">All(Role)</option>
						<option value="1">Manufacturer</option>
						<option value="2">Distributer</option>
						<option value="3">Wholeseller</option>
						<option value="4">Supermarket</option>
					</select>
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-warning" id="filter" name="filter">Search</button>
				</div>
			</div>
			<input type="hidden" name="page" id="page">
			<input type="hidden" name="pg" id="pg">
			<div class="align-items-center" id="rec-lt"></div>
		</div>
	</div>
</div>
<!-- end:: Content -->
</div>
<?php
include(DIR_VIEW.DIR_CON."footer_admin.php");
?>
<script src="assets/js/pages/crud/metronic-datatable/advanced/record-users.js" type="text/javascript"></script>
