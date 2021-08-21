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
							<div class="kt-portlet">
								<div class="kt-portlet__body  kt-portlet__body--fit">
									<div class="row row-no-padding row-col-separator-lg">
										<div class="col-md-12 col-lg-6 col-xl-3">
											<!--begin::Total Profit-->
											<div class="kt-widget24">
												<div class="kt-widget24__details">
													<div class="kt-widget24__info">
														<h4 class="kt-widget24__title">
															Total Profit
														</h4>
													</div>
													<span class="kt-widget24__stats kt-font-smokey-blue">
														$18M
													</span>
												</div>
											</div>
											<!--end::Total Profit-->
										</div>
										<div class="col-md-12 col-lg-6 col-xl-3">
											<!--begin::New Feedbacks-->
											<div class="kt-widget24">
												<div class="kt-widget24__details">
													<div class="kt-widget24__info">
														<h4 class="kt-widget24__title">
															My Carts
														</h4>
														<span class="kt-widget24__desc">
															Customer Review
														</span>
													</div>
													<span class="kt-widget24__stats kt-font-warning">
														<i class="fa fa-map-marked-alt"></i>1349
													</span>
												</div>
											</div>
											<!--end::New Feedbacks-->
										</div>
										<div class="col-md-12 col-lg-6 col-xl-3">
											<!--begin::New Orders-->
											<div class="kt-widget24">
												<div class="kt-widget24__details">
													<div class="kt-widget24__info">
														<h4 class="kt-widget24__title">
															My Orders
														</h4>
														<span class="kt-widget24__desc">
															Fresh Order Amount
														</span>
													</div>
													<span class="kt-widget24__stats kt-font-raspberry">
														<i class="fa fa-map-marked-alt"></i>567
													</span>
												</div>
											</div>
											<!--end::New Orders-->
										</div>
										<div class="col-md-12 col-lg-6 col-xl-3">
											<!--begin::New Users-->
											<div class="kt-widget24">
												<div class="kt-widget24__details">
													<div class="kt-widget24__info">
														<h4 class="kt-widget24__title">
															My Quotations
														</h4>
														<span class="kt-widget24__desc">
															Joined New User
														</span>
													</div>
													<span class="kt-widget24__stats kt-font-yashmi">
														276
													</span>
												</div>
											</div>
											<!--end::New Users-->
										</div>
									</div>
								</div>
							</div>
							<div class="row" style="text-align: center;">
								<div class="col-md-12">
									<img src="assets/media/bg/dashboard-bg.png"/>
								</div>
							</div>
							<div class="row kt-hidden">
								<div class="col-lg-12">

									<!--begin::Portlet-->
									<div class="kt-portlet" id="kt_portlet">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon">
													<i class="flaticon-calendar"></i>
												</span>
												<h3 class="kt-portlet__head-title">
													List View
												</h3>
											</div>
											<div class="kt-portlet__head-toolbar">
												<a href="#" class="btn btn-brand btn-elevate">
													<i class="la la-plus"></i>
													Add Event
												</a>
											</div>
										</div>
										<div class="kt-portlet__body">
											<div id="kt_calendar"></div>
										</div>
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
