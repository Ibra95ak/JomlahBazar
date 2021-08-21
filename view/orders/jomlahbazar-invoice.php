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
$ordernumber = $_GET['ordernumber'];
$res_invoice = $client->request('GET', DIR_CONT . DIR_ORD . 'CON_Orders.php?action=get-jb-invoice&ordernumber='.$ordernumber);/*fetch userId*/
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
													<h1 class="kt-invoice__title kt-font-md kt-font-bolder btn-width-full text-center">Order Summary</h1>
												</div>
												<div class="kt-invoice__items">
													<div class="kt-invoice__item">
														<span class="kt-invoice__subtitle">Order Number: <span class="kt-invoice__text"><?php echo $ordernumber;?></span></span>
														<span class="kt-invoice__subtitle">Date: <span class="kt-invoice__text"><?php echo date("M,d Y",strtotime($invoice->order_info[0]->order_date));?></span></span>
													</div>
													<div class="kt-invoice__item">
														<div class="alert alert-solid-dark alert-bold" role="alert">
															<div class="alert-text">Due Date: <span class="kt-invoice__text kt-font-dark kt-font-bolder"><?php echo date('M,d Y', strtotime($invoice->order_info[0]->order_date. ' + 3 days'));?></span></div>
														</div>
													</div>
												</div>
												<div class="kt-invoice__items">
													<div class="kt-invoice__item">
																<h1 class="kt-font-md kt-font-bolder"> </h1><br>
																<span class="kt-mb-15 kt-mt-15">Legal Entity Name: JomlahBazar (Pomechain DMCC)</span>
																<span class="kt-mb-15">Address: Office 2903, 29th Floor, BB1, Mazaya Business Avenue, First Al Khail Street, Jumeirah Lakes Towers, Dubai, PO Box 123525, UAE</span>
																<span class="kt-mb-15">Contact Details: 971508501162 / 97143477802</span>
																<span class="kt-mb-15">TRN# : 100520787100003</span>
													</div>
													<div class="kt-invoice__item">
														<h1 class="kt-font-md kt-font-bolder">Buyer:</h1><br>
														<span class="kt-mb-15">Name: <?php echo $invoice->buyer_info[0]->fullname;?></span>
														<span class="kt-mb-15">Address: <?php echo $invoice->order_address[0]->address1.",".$invoice->order_address[0]->city.",".$invoice->order_address[0]->country;?></span>
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
													<?php
														foreach ($invoice->order_info as $seller) {
															echo '<table class="table">';
															echo '<thead>';
															echo '<tr>';
															echo '<th colspan="2">Seller: '.$seller->seller_company[0]->companyname.'</th>';
															echo '<th colspan="6">TRN '.$seller->seller_company[0]->trn.':</th>';
															echo '</tr>';
															echo '<tr>';
															echo '<th>Sr No</th>';
															echo '<th>Description / Product details</th>';
															echo '<th>Qty</th>';
															echo '<th>Price (Incl VAT in AED)</th>';
															echo '<th>TOTAL (Incl VAT in AED)</th>';
															echo '<th>VAT %</th>';
															echo '<th>VAT Amount (AED)</th>';
															echo '<th>TOTAL (Incl VAT in AED)</th>';
															echo '</tr>';
															echo '</thead>';
															echo'<tbody>';
															$total_price=0;
															$total_vat=0;
															$total=0;
															$srno = 0;
															foreach ($seller->orderdetails as $item) {
																$srno++;
																$total_product = number_format($item->totalprice,2);
																//$vat_product = number_format($total_product*0.05,2);
																$vat_product = 0;
																$total_product_vat = $total_product+$vat_product;
																echo '<tr>';
																echo '<td>'.$srno.'</td>';
																echo '<td>'.$item->name.'</td>';
																echo '<td>'.$item->quantity.'</td>';
																echo '<td>'.$total_product/$item->quantity.'</td>';
																echo '<td>'. number_format($total_product,2).'</td>';
																echo '<td>NA</td>';
																echo '<td>NA</td>';
																// echo '<td>'.number_format($vat_product,2).'</td>';
																echo '<td>'.number_format($total_product_vat,2).'</td>';
																echo '</tr>';
																$total_price+=$item->totalprice;
																$total_vat+=$vat_product;
																$total+=$total_product_vat;
																$payment_fees = $item->totalprice;
															}
															if ($invoice->payment_info) {
																$shipment_fees = $invoice->payment_info[0]->shipmentfees;
																$shipment_vat = $shipment_fees*0.05;
																$shipment_total = $shipment_fees + $shipment_vat;
																$payment_fees = $invoice->payment_info[0]->paymentfees;
																$payment_vat = $payment_fees*0.05;
																$payment_total = $payment_fees + $payment_vat;
																$payment_total = round($payment_total,2);
																switch ($invoice->payment_info[0]->status) {
																	case 'Booking Pending':
																	$totalpaid = 0;
																	case 'Pending':
																	$totalpaid = 0;
																	break;
																	default:
																	$totalpaid = $total+$shipment_total+$payment_total;
																	break;
																}
															}else{
																$totalpaid = $total+$shipment_total+$payment_total;
																$shipment_fees = 0;
															}
															$total_vat+=$shipment_vat;
															$total_price+=$shipment_fees;
															$total+=$shipment_total;
															echo '</tbody>';
															echo '<tfoot>';
															echo '<tr>';
															echo '<td class="text-left" colspan=2>Shipment Fees(AED)</td>';
															echo '<td></td>';
															echo '<td></td>';
															echo '<td>'.number_format($shipment_fees,2).'</td>';
															echo '<td></td>';
															echo '<td>'.number_format($shipment_vat,2).'</td>';
															echo '<td style="background-color: #f7f8fa;">'.number_format($shipment_total,2).'</td>';
															echo '</tr>';
															echo '<tr>';
															echo '<td class="text-left" colspan=2>Total Due Amount(AED)</td>';
															echo '<td></td>';
															echo '<td></td>';
															echo '<td>'.number_format($total_price,2).'</td>';
															echo '<td></td>';
															echo '<td>'.number_format($total_vat,2).'</td>';
															echo '<td style="background-color: #f7f8fa;">'.number_format($total,2).'</td>';
															echo '</tr>';
															echo '</tfoot>';
															echo '</table>';
														}
													?>
													<table class="table">
														<th>
															<td></td>
															<td>TOTAL (Incl VAT in AED)</td>
															<td>VAT %</td>
															<td>VAT Amount (AED)</td>
															<td>TOTAL (Incl VAT in AED)</td>
														</th>
														<tr>
															<?php
																$total_shipment_fees = $invoice->payment_info[0]->shipmentfees;
																$total_shipment_vat = $invoice->payment_info[0]->shipmentfees*0.05;
																$total_shipment = $total_shipment_fees+$total_shipment_vat;
															?>
															<td class="text-left" colspan=2>Shipment Fees(AED)</td>
															<td><?php echo number_format($total_shipment_fees,2);?></td>
															<td>5%</td>
															<td><?php echo number_format($total_shipment_vat,2);?></td>
															<td style="background-color: #f7f8fa;"><?php echo number_format($total_shipment,2);?></td>
														</tr>
														<tr>
															<?php
																$total_payment_fees = $invoice->payment_info[0]->paymentfees;
																$total_payment_vat = $invoice->payment_info[0]->paymentfees*0.05;
																$total_payment = $total_payment_fees+$total_payment_vat;
															?>
															<!-- <td class="text-left" colspan=2>Other Fees(AED)</td> -->
															<!-- <td><?php //echo number_format($total_payment_fees,2);?></td> -->
															<!-- <td>5%</td> -->
															<!-- <td><?php //echo number_format($total_payment_vat,2);?></td> -->
															<!-- <td style="background-color: #f7f8fa;"><?php //echo number_format($total_payment,2);?></td> -->
														</tr>
														<tr>
															<?php
																$total_payment_db = $invoice->payment_info[0]->total_price;
																$total_no_vat = number_format($total_payment_db/1.05,2);
																$total_no_fees_shipment = $total_no_vat-$total_shipment_fees-$total_payment_fees;
																$totalbalance = $total_payment_db-$totalpaid;
															?>
															<td class="text-left" colspan=2>Total Due Amount(AED)</td>
															<td><?php echo number_format($total_no_fees_shipment,2);?></td>
															<td>5%</td>
															<td><?php echo number_format($total_no_fees_shipment*0.05,2);?></td>
															<td style="background-color: #f7f8fa;"><?php echo $total_payment_db;?></td>
														</tr>
														<tr>
															<td class="text-left" colspan=2>Total Paid Amount(AED)</td>
															<td></td>
															<td></td>
															<td></td>
															<td style="background-color: #f7f8fa;"><?php echo number_format($totalpaid,2);?></td>
														</tr>
														<tr>
															<td class="text-left" colspan=2>Balance Amount(AED)</td>
															<td></td>
															<td></td>
															<td></td>
															<td style="background-color: #f7f8fa;"><?php echo number_format($totalbalance,2);?></td>
														</tr>
													</table>
												</div>
											</div>
										</div>
										<div class="kt-invoice__actions">
											<div class="kt-invoice__container">
												<button type="button" class="btn btn-warning btn-bold" onclick="window.print();">Print</button>
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
