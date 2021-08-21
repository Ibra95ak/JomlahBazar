<?php
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
/* SESSION THINGS */
session_start();
$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
$usr = json_decode($res_uid->getBody());
$roleId = $usr->roleId;
$userId = $usr->userId;
/* SESSION THINGS */

$res_order_everything = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_functions.php?action=get_received_order_details&orderId='.$_GET['orderId']);
$orderEverything = json_decode($res_order_everything->getBody());
?>


<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="container">
	<div class="row">
		<div class="col-xs-6">
			<div class="invoice-title">
				<h2>Invoice</h2>
				<h3 class="">Order # <?php echo $orderEverything[0]->ordernumber; ?></h3>
			</div>
			<hr>
			<div class="row">
				<div class="col-xs-6">
					<address>
						<strong>Billed To:</strong><br>
						<?php echo $orderEverything[0]->fullname; ?><br>
						<?php echo $orderEverything[0]->address1; ?><br>
						<?php echo $orderEverything[0]->city; ?><br>
						<?php echo $orderEverything[0]->state; ?><br>
						<?php echo $orderEverything[0]->postalcode; ?>, <?php echo $orderEverything[0]->country; ?>
					</address>
				</div>
				<div class="col-xs-6 text-right">
					<address>
						<strong>Shipped To:</strong><br>
						<?php echo $orderEverything[0]->fullname; ?><br>
						<?php echo $orderEverything[0]->address1; ?><br>
						<?php echo $orderEverything[0]->city; ?><br>
						<?php echo $orderEverything[0]->state; ?><br>
						<?php echo $orderEverything[0]->postalcode; ?>, <?php echo $orderEverything[0]->country; ?>
					</address>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<address>
						<strong>Payment Method:</strong><br>
						Cash On Delivery<br>
						<?php echo $orderEverything[0]->email; ?>
					</address>
				</div>
				<div class="col-xs-6 text-right">
					<address>
						<strong>Order Date:</strong><br>
						<?php echo $orderEverything[0]->order_date; ?><br><br>
					</address>
				</div>
			</div>
		</div>

		<div class="col-xs-6">
			<div style="text-align: center; margin-top:50px">
				<?php $link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
				<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $link ?>&choe=UTF-8" title="Scan to download shipment information">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><strong>Order summary</strong></h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<td><strong>Item</strong></td>
									<td class="text-center"><strong>Price</strong></td>
									<td class="text-center"><strong>Quantity</strong></td>
									<td class="text-right"><strong>Totals</strong></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($orderEverything as $order) { ?>
									<tr>
										<td><?php echo $order->name; ?></td>
										<td class="text-center">AED <?php echo $order->item_price; ?></td>
										<td class="text-center"><?php echo $order->item_quantity; ?></td>
										<td class="text-right">AED <?php echo $order->item_price * $order->item_quantity ?></td>
									</tr>
								<?php } ?>

								<tr>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
									<td class="thick-line text-center"><strong>Subtotal</strong></td>
									<td class="thick-line text-right">AED <?php echo $orderEverything[0]->order_total_price; ?></td>
								</tr>
								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>Shipping</strong></td>
									<td class="no-line text-right">AED 0</td>
								</tr>
								<tr>
									<td class="no-line"></td>
									<td class="no-line"></td>
									<td class="no-line text-center"><strong>Total</strong></td>
									<td class="no-line text-right">AED <?php echo $orderEverything[0]->order_total_price; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a class="btn btn-success" onclick="window.print()">Print this order</a>
	<a class="btn btn-warning" onclick="window.close()">Back to manage orders</a>
</div>
