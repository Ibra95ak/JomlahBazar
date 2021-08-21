<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if(isset($_SESSION['userId'])){
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$userId = $usr->userId;
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
$sellerId = $_GET['sellerId'];
$res_invoice = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_carts.php?action=get-proforminvoice&sellerId='.$sellerId.'&userId='.$userId);/*fetch userId*/
$invoice = json_decode($res_invoice->getBody());
?>
<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

<head>
	<base href="../../">
	<meta charset="utf-8" />
	<title>JomlahBazar</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="google-site-verification" content="jK4Bt2ICskPGXlqQJ7qQQROATHsxinJhOKQf_AztMA8" />
	<!--begin::Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
	<!--end::Fonts -->
	<!--begin::Page Vendors Styles(used by this page) -->
	<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles -->
	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->
	<!--begin::Layout Skins(used by all pages) -->
	<link href="assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/wizard/wizard-2.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/needim/noty/77268c46/lib/noty.css">
	<script type="text/javascript" src="https://cdn.rawgit.com/needim/noty/77268c46/lib/noty.min.js"></script>
	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/brand/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/skins/aside/light.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/support-center/faq-3.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/support-center/feedback.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/pages/support-center/home-1.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<link href="assets/css/pages/invoices/invoice-2.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/magnifier/magnifier.css">
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0VYKEQKQ5Q"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0VYKEQKQ5Q');
</script>
</head>
<!-- end::Head -->
<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading kt-font-dark">
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
	<div class="kt-portlet">
								<div class="kt-portlet__body kt-portlet__body--fit">
									<div class="kt-invoice-2">
										<div class="kt-invoice__head">
											<div class="kt-invoice__container">
												<div class="kt-invoice__brand">
													<h1 class="kt-invoice__title kt-font-md kt-font-bolder btn-width-full text-center">Proforma Order Booking</h1>
												</div>
												<div class="kt-invoice__items">
													<div class="kt-invoice__item">
														<span class="kt-invoice__subtitle">Order Number: <span class="kt-invoice__text kt-font-warning">Will be generated upon order submit.</span></span>
														<span class="kt-invoice__subtitle">Invoice Date: <span class="kt-invoice__text"><?php echo date("M,d Y");?></span></span>
													</div>
													<div class="kt-invoice__item">
														<div class="alert alert-solid-dark alert-bold" role="alert">
															<div class="alert-text">Due Date: <span class="kt-invoice__text kt-font-warning">Will be generated upon order submit.</span></div>
														</div>
													</div>
												</div>
												<div class="kt-invoice__items">
													<div class="kt-invoice__item">
																<h1 class="kt-font-md kt-font-bolder">Seller:</h1><br>
																<span class="kt-mb-15">Name: <?php echo $invoice->seller_company[0]->companyname;?></span>
																<span class="kt-mb-15">Address: <?php echo $invoice->seller_default_address[0]->address1.",".$invoice->seller_default_address[0]->city.",".$invoice->seller_default_address[0]->country;?></span>
																<span class="kt-mb-15">Contact Details: <?php echo $invoice->seller_info[0]->otp;?></span>
																<span class="kt-mb-15">TRN# : <?php echo $invoice->seller_company[0]->trn;?></span>
													</div>
													<div class="kt-invoice__item">
														<h1 class="kt-font-md kt-font-bolder">Buyer:</h1><br>
														<span class="kt-mb-15">Name: <?php echo $invoice->buyer_info[0]->fullname;?></span>
														<span class="kt-mb-15">Invoice for: <?php echo $invoice->buyer_default_address[0]->addresstitle;?></span>
														<span class="kt-mb-15">Address: <?php echo $invoice->buyer_default_address[0]->address1.",".$invoice->buyer_default_address[0]->city.",".$invoice->buyer_default_address[0]->country;?></span>
														<span class="kt-mb-15">Contact Details: <?php echo $invoice->buyer_info[0]->otp;?></span>
														<?php
															if ($invoice->buyer_company) {
																echo '<span class="kt-mb-15">TRN# :'.$invoice->buyer_company[0]->trn.'</span>';
															}else {
																echo '<span class="kt-mb-15">TRN# : NA</span>';
															}
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="kt-invoice__body">
											<div class="kt-invoice__container">
												<div class="table-responsive">
													<table class="table">
														<thead>
															<tr>
																<th>Sr No</th>
																<th>Description / Product details</th>
																<th>Qty</th>
																<th>Price (Incl VAT in AED)</th>
																<th>TOTAL (AED)</th>
																<!-- <th>VAT %</th> -->
																<!-- <th>VAT Amount (AED)</th> -->
																<th>TOTAL (Incl VAT in AED)</th>
															</tr>
														</thead>
														<tbody>
															<?php
																$total_price=0;
																$total_vat=0;
																$total=0;
																$srno = 0;
																foreach ($invoice->buyer_seller_cart as $item) {
																	$srno++;
																	$total_product = $item->quantity*$item->price;
																	//$vat_product = $total_product*0.05;
																	$vat_product = 0;
																	$total_product_vat = $total_product+$vat_product;
																	echo '<tr>';
																	echo '<td>'.$srno.'</td>';
																	echo '<td>'.$item->name.'</td>';
																	echo '<td>'.$item->quantity.'</td>';
																	echo '<td>'.number_format($item->price,2).'</td>';
																	echo '<td>'.number_format($total_product,2).'</td>';
																	//echo '<td>5%</td>';
																	//echo '<td>'.number_format($vat_product,2).'</td>';
																	echo '<td>'.number_format($total_product_vat,2).'</td>';
																	echo '</tr>';
																	$total_price+=$item->quantity*$item->price;
																	$total_vat+=$vat_product;
																	$total+=$total_product_vat;
																}
															?>
														</tbody>
														<tfoot>
															<tr>
																<td class="text-left" colspan=2>Total Due Amount(AED)</td>
																<td></td>
																<td></td>
																<td><?php echo number_format($total_price,2);?></td>
																<!-- <td></td> -->
																<!-- <td><?php //echo number_format($total_vat,2);?></td> -->
																<td style="background-color: #f7f8fa;"><?php echo number_format($total,2);?></td>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
										</div>
										<div class="kt-invoice__actions">
											<div class="kt-invoice__container">
												<button type="button" class="btn btn-warning btn-bold" onclick="window.print();">Print Invoice</button>
											</div>
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
