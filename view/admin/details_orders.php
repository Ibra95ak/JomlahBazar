<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
$res_order = $client->request('GET',DIR_CONT.DIR_ADMN.'CON_orders.php?action=get&orderId='.$_GET['id']);
$order = json_decode($res_order->getBody());
include("../" . DIR_CON . "header_admin.php");
if ($order->order) {
	$ordernumber=$order->order[0]->ordernumber;
	$order_date=$order->order[0]->order_date;
	$total_quantity=$order->order[0]->total_quantity;
	$total_price=$order->order[0]->total_price;
	$statusId=$order->order[0]->statusId;
}else {
	$ordernumber='';
	$order_date='';
	$total_quantity='';
	$total_price='';
	$statusId='';
}
if ($order->buyer) {
	$buyer_profile_pic=$order->buyer[0]->profile_pic;
	$buyer_fullname=$order->buyer[0]->fullname;
}else {
	$buyer_profile_pic='';
	$buyer_fullname='';
}
if ($order->buyer_address) {
	$address1=$order->buyer_address[0]->address1;
	$city=$order->buyer_address[0]->city;
	$state=$order->buyer_address[0]->state;
	$postalcode=$order->buyer_address[0]->postalcode;
	$country=$order->buyer_address[0]->city;
}else {
	$address1='';
	$city='';
	$state='';
	$postalcode='';
	$country='';
}
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
		<div class="row">
			<div class="col-xl-4">
									<!--begin:: Portlet-->
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fit">
											<!--begin::Widget -->
											<div class="kt-widget kt-widget--project-1">
												<div class="kt-widget__head d-flex">
													<h2>Order</h2>
													<div class="kt-widget__label">
														<div class="kt-widget__info kt-padding-0 kt-margin-l-15">
															<a href="javascript:void(0)" class="kt-widget__title">
																<?php echo $ordernumber;?>
															</a>
														</div>
													</div>
												</div>
												<div class="kt-widget__body">
													<span class="kt-widget__text kt-margin-t-0 kt-padding-t-5">
														Total Price: <?php echo $total_price;?><br>
														Total Quantity: <?php echo $total_quantity;?><br>
														Status: <?php echo $statusId;?>
													</span>
													<div class="kt-widget__stats kt-margin-t-20">
														<div class="kt-widget__item d-flex align-items-center kt-margin-r-30">
															<span class="kt-widget__date kt-padding-0 kt-margin-r-10">
																Order Date
															</span>
															<div class="kt-widget__label">
																<span class="btn btn-label-brand btn-sm btn-bold btn-upper"><?php echo $order_date;?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--end::Widget -->
										</div>
									</div>
									<!--end:: Portlet-->
								</div>
			<div class="col-xl-4">
									<!--begin:: Portlet-->
									<div class="kt-portlet kt-portlet--height-fluid">
										<div class="kt-portlet__body kt-portlet__body--fit">
											<!--begin::Widget -->
											<div class="kt-widget kt-widget--project-1">
												<div class="kt-widget__head d-flex">
													<h2>Buyer</h2>
													<div class="kt-widget__label">
														<div class="kt-widget__media kt-widget__media--m">
															<span class="kt-media kt-media--md kt-media--circle kt-hidden-">
																<img src="<?php echo DIR_ROOT.$buyer_profile_pic?>" alt="image">
															</span>
														</div>
														<div class="kt-widget__info kt-padding-0 kt-margin-l-15">
															<a href="javascript:void(0)" class="kt-widget__title">
																<?php echo $buyer_fullname;?>
															</a>
														</div>
													</div>
												</div>
												<div class="kt-widget__body">
													<span class="kt-widget__text kt-margin-t-0 kt-padding-t-5">
														Address: <?php echo $address1."/".$city."/".$state."/".$postalcode."/".$country;?>
													</span>
												</div>
											</div>
											<!--end::Widget -->
										</div>
									</div>
									<!--end:: Portlet-->
								</div>
			<div class="col-xl-4">
				<!--begin:: Widgets/Support Tickets -->
				<div class="kt-portlet kt-portlet--height-fluid">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								Sellers
							</h3>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div class="kt-widget3">
							<?php
							if ($order->products_sellers) {
								foreach ($order->products_sellers as $detail) {
							 		echo '<div class="kt-widget3__item"><div class="kt-widget3__header">';
							 		echo '<div class="kt-widget3__user-img"><img class="kt-widget3__img" src="'.DIR_ROOT.$detail->profile_pic.'" alt=""></div>';
							 		echo '<div class="kt-widget3__info"><a href="javascript:void(0)" class="kt-widget3__username">'.$detail->fullname.'</a></div>';
							 		echo '<span class="kt-widget3__status kt-font-info"></span></div></div>';
								}
							}

							?>
						</div>
					</div>
				</div>
				<!--end:: Widgets/Support Tickets -->
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="kt-portlet">
							<div class="kt-portlet__head">
								<div class="kt-portlet__head-label">
									<h3 class="kt-portlet__head-title">
										Order Details
									</h3>
								</div>
							</div>
							<div class="kt-portlet__body">
								<!--begin::Section-->
								<div class="kt-section">
									<div class="kt-section__content">
										<table class="table">
											<thead>
												<tr>
													<th>#</th>
													<th>Product Name</th>
													<th>Seller</th>
													<th>Quantity</th>
													<th>Total Price</th>
													<th>Shipper</th>
													<th>Shipped Date</th>
													<th>Tracking Number</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if ($order->products_sellers) {
														foreach ($order->products_sellers as $detail) {
															echo '<tr>';
															echo '<th scope="row">'.$detail->orderdetailId.'</th>';
															echo '<td>'.$detail->name.'</td>';
															echo '<td>'.$detail->fullname.'</td>';
															echo '<td>'.$detail->quantity.'</td>';
															echo '<td>'.$detail->totalprice.'</td>';
															echo '<td>'.$detail->shipmentId.'</td>';
															echo '<td>'.$detail->ship_date.'</td>';
															echo '<td>'.$detail->tracking_number.'</td>';
															echo '<td>'.$detail->statusId.'</td>';
															echo '</tr>';
														}
													}else{
														echo '<tr><td>No Orders</td></tr>';
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<!--end::Section-->
							</div>
							<!--end::Form-->
						</div>
			</div>
		</div>
	<!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<?php
include(DIR_VIEW.DIR_CON."footer.php");
?>
