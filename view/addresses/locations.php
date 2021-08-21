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
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
	<div class="kt-portlet kt-portlet--mobile">
		<div class="kt-portlet__body">

			<!--begin: Search Form -->
			<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
				<div class="row align-items-center">
					<div class="col-xl-8 order-2 order-xl-1">
						<div class="row align-items-center">
							<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
								<div class="kt-input-icon kt-input-icon--left">
									<input type="text" class="form-control" placeholder="Search..." id="generalSearch">
									<span class="kt-input-icon__icon kt-input-icon__icon--left">
										<span><i class="la la-search"></i></span>
									</span>
								</div>
							</div>
							<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
								<div class="kt-form__group kt-form__group--inline">
									<div class="kt-form__label">
										<label>Status:</label>
									</div>
									<div class="kt-form__control">
										<select class="form-control" id="kt_form_status">
											<option value="">All</option>
											<option value="1">Active</option>
											<option value="2">Inactive</option>
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
			<div class="row">
				<div class="col-xl-6">
					<!--begin:: Widgets/New Users-->
					<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
										<div class="kt-portlet__body">
											<div class="tab-content">
												<div class="tab-pane active" id="kt_widget4_tab1_content">
													<div class="kt-widget4">
														<div class="kt-widget4__item">
															<div class="row">
																<div class="col-lg-12">
																	<label class="kt-option">
																		<span class="kt-option__control">
																			<span class="kt-radio">
																				<input type="radio" name="m_option_1" value="1" checked="">
																				<span></span>
																			</span>
																		</span>
																		<span class="kt-option__label">
																			<span class="kt-option__head">
																				<span class="kt-option__title">
																					Standart Delevery
																				</span>
																				<span class="kt-option__focus">
																					Free
																				</span>
																			</span>
																			<span class="kt-option__body">
																				Estimated 14-20 Day Shipping
																				(&nbsp;Duties end taxes may be due
																				upon delivery&nbsp;)
																			</span>
																		</span>
																	</label>
																</div>
																<div class="col-lg-12">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		<input type="radio" name="m_option_1" value="1">
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			Fast Delevery
																		</span>
																		<span class="kt-option__focus">
																			$&nbsp;8.00
																		</span>
																	</span>
																	<span class="kt-option__body">
																		Estimated 2-5 Day Shipping
																		(&nbsp;Duties end taxes may be due
																		upon delivery&nbsp;)
																	</span>
																</span>
															</label>
														</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
					<!--end:: Widgets/New Users-->
				</div>
				<div class="col-xl-6">
					<div id="kt_gmap_sloc" style="height: 500px; position: relative; overflow: hidden;"></div>
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
<script type="text/javascript">
$(document).ready(function(){
  demosloc();
});
var demosloc = function() {
	var map = new GMaps({
		div: '#kt_gmap_sloc',
		lat: 24.7563957,
		lng: 55.2597173,
	});
	map.setZoom(5);
}
</script>
