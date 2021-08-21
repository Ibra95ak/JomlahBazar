<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if(isset($_SESSION['userId'])){
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$roleId = $usr->roleId;
	$userId = $usr->userId;
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
if (!isset($_GET['from'])) {
    $_GET['from'] = date("Y/m/d");
}
if (!isset($_GET['to'])) {
    $_GET['to'] = date("Y/m/d");
}
$res_orders = $client->request('GET', DIR_CONT . DIR_ORD . 'CON_Orders.php?action=seller_orders&userId=' . $userId . '&from=' . $_GET['from'] . '&to=' . $_GET['to']);
$orders = json_decode($res_orders->getBody());
?>
<style>
    .kt-widget.kt-widget--user-profile-3 .kt-widget__bottom .kt-widget__item .kt-widget__details .kt-widget__value {
        font-size: 12px;
    }
</style>

<script>
    currentUrl = window.location.href;
    var split = currentUrl.split('?');
    var message = split[1].split('=');
    if (message[0] == 'success') {
        new Noty({
            type: 'success',
            theme: 'metroui',
            timeout: 3000,
            text: 'Your order has been submitted.',
        }).show();
    }


    function reorder(pid, pqty, pp, sid, pname) {
        $('#pid').val(pid);
        $('#pqty').val(pqty);
        $('#pp').val(pp);
        $('#sid').val(sid);
        $('#pname').val(pname);
        $('#cartform').submit();
    }

    function printSlip(id) {
        var id = id;
        var features = 'directories=no,menubar=no,status=no,titlebar=no,toolbar=no,width=1200,height=700,top=50,left=150,scrollbars=no';
        var mypopup = window.open(DIR_VIEW+DIR_ORD+'print_slip.php?orderId=' + id, 'mypopup', features);
    }

    function refund() {
        var ask = window.confirm('Do you really want to refund this order?');
        if (ask) {
            alert('Your order has been successfully refunded');
        } else {
            alert('No worries, your order is safe');
        }
    }
</script>

<form method="POST" id="cartform" action="<?php echo DIR_VIEW . DIR_CAR . "cart-post.php"; ?>">
    <input type="hidden" name="pid" id="pid">
    <input type="hidden" name="pqty" id="pqty">
    <input type="hidden" name="pp" id="pp">
    <input type="hidden" name="sid" id="sid">
    <input type="hidden" name="pname" id="pname">
</form>

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="background-color: #f5f5f5;">
    <!--Begin::Dashboard 3-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Marketplace</a></li>
            <li class="breadcrumb-item"><a href="#">Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Received Orders</li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-lg-9">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">My Received Orders</h3>
                    </div>
                    <div class="kt-widget__item">
                        <label class="kt-font-dark kt-font-bold">Search Date <span class="kt-font-sm">Sample: 22/09/2020 - 29/10/2020</span></label>
                        <input type="text" class="form-control" id="kt_daterangepicker_1" placeholder="Select date ranges" autocomplete="off">
                    </div>
                    <!-- <script>

                        function breakDate(date) {
                            var split = date.split('-');
                            var from = split[0].trim();
                            var to = split[1].trim();
                            currentUrl = 'https://jomlahbazar.com/view/orders/b2c-received-orders.php';
                            console.log(currentUrl + '?from=' + from + '&to=' + to);
                            var url = currentUrl + '?from=' + from + '&to=' + to;
                            window.open(url,"_self")
                        }
                    </script> -->
                </div>
                <div class="kt-portlet__body" style="background-color: #f6f6f6;" id="rec-dt">
									<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
										<?php
										$i=0;
										if ($orders) {
											foreach ($orders as $order) {
												$order_status = $order->order_statusId;
												$shippedby = $order->shipped_by;
												$shipmentId = $order->shipmentId;
												$awbpdf = $order->awbpdf;
												$tracking_number = $order->tracking_number;
												$shipment_type = $order->shipment_type;
												$i++;
												switch ($order->payment_type) {
													case 1:
														$status = "Not PAID - ".$order->payment_status;
														break;
													case 2:
														$status = "Credit Card - ".$order->payment_status;
														break;
													case 3:
														$status = "Bank Transfer - ".$order->payment_status;
														break;
													case 5:
														$status = "Not PAID - ".$order->payment_status;
														break;
													default:
														$status = "Not PAID - Pending";
														break;
												}
												switch ($shippedby) {
													case 1:
														$shipper = "SELLER";
														break;
													case 2:
														$shipper = "JOMLAHBAZAR";
														break;
													case 3:
														$shipper = "Buyer Pickup";
														break;
													default:
														$shipper = "NONE";
														break;
												}
												if ($i==1) {
													echo '<div class="card"><div class="card-header" id="headingOne'.$i.'"><div class="card-title row" data-toggle="collapse" data-target="#collapseOne'.$i.'" aria-expanded="true" aria-controls="collapseOne'.$i.'">';
												}else {
													echo '<div class="card"><div class="card-header" id="headingOne'.$i.'"><div class="card-title collapsed row" data-toggle="collapse" data-target="#collapseOne'.$i.'" aria-expanded="false" aria-controls="collapseOne'.$i.'">';
												}
												echo '<div class="col-md-1"><label>Order placed</label><br><span>'.$order->order_date.'</span></div>';
												echo '<div class="col-md-1"><label>Total</label><br><span>'.$order->payment_total.'</span></div>';
												echo '<div class="col-md-2"><label>Order # </label><br><span>'.$order->ordernumber.'</span></div>';
												echo '<div class="col-md-2"><label>Buyer</label><br><span data-toggle="modal" data-target="#kt_modal_bmap" onclick="maporder('.$order->latitude.','.$order->longitude.')">'.$order->fullname.'</span></div>';
												echo '<div class="col-md-2"><label>Payment Status </label><br><span>'.$status.'</span></div>';
												echo '<div class="col-md-1"><label>Shipped By </label><br><span>'.$shipper.'</span></div>';
												if($tracking_number!='') {
													echo '<div class="col-md-2"><label>Tracking Number </label><br><span>'.$tracking_number.'</span></div>';
												}
												echo '</div></div>';
												if ($i==1) {
													echo '<div id="collapseOne'.$i.'" class="collapse show" aria-labelledby="headingOne'.$i.'" data-parent="#accordionExample6" style=""><div class="card-body">';
												}else {
													echo '<div id="collapseOne'.$i.'" class="collapse" aria-labelledby="headingOne'.$i.'" data-parent="#accordionExample6" style=""><div class="card-body">';
												}
												$res_order_details = $client->request('GET', DIR_CONT . DIR_ORD . 'CON_Orders.php?action=get_order_details&orderId=' . $order->orderId);
												$orderDetails = json_decode($res_order_details->getBody());
												$orderDetails = $orderDetails->orders;

												$shipped = $order->shipmentId;
												$today = strtotime(date('Y-m-d'));
												$order_date = $order->order_date;
												$order_date = strtotime($order_date);
												$refund_end_date = strtotime("+7 day", $order_date);
												foreach ($orderDetails as $orderDetail) {
													echo '<div class="row kt-mb-10">';
													echo '<div class="col-md-2"><img src="'.DIR_ROOT.$orderDetail->path.'" alt="" style="width: 110px; height: 94px"></div>';
													echo '<div class="col-md-3">';
													echo '<span>Status: '.$orderDetail->status.'</span>';
													echo '</div>';
													echo '<div class="col-md-2">';
													echo '<button type="button" onclick="orderdetails('.$orderDetail->orderdetailId.')" class="btn btn-warning btn-sm btn-upper btn-width-full">Order Details</button><br>';
													if($shipped!='1' && $orderDetail->statusId!=4 && $orderDetail->statusId!=5) echo '<button type="button" class="btn btn-light btn-sm btn-upper kt-mt-5 btn-width-full" onclick="cancelorder('.$orderDetail->orderdetailId.')">Cancel</button><br>';
													echo '</div>';
													echo '</div>';
												}
												echo '<div class="row">';
												echo '<div class="col-md-4">';
												if ($shipment_type==1 && $shippedby!=2 && $order->payment_type!=5 && $order_status!=4 && $order_status!=6 && $order_status!=5) {
													echo '<button type="button"  data-toggle="modal" data-target="#kt_modal_ship" onclick="shiporder('.$order->orderId.','.$shipmentId.')" class="btn btn-warning btn-sm btn-upper btn-width-full">Ship Order</button><br>';
												}
												if($awbpdf!='') {
													echo '<button type="button" class="btn btn-primary printawb" data-id="'.$awbpdf.'" data-tracking="'.$tracking_number.'"><i class="fa fa-print"></i> Print AWB</button>';
												}
												echo '</div>';
												echo '<div class="col-md-4">';
												if ($shipped!=0 &&$order_status!=6 && $order_status!=4 && $order_status!=5) {
													echo '<button type="button" onclick="completeorder('.$order->orderId.')" class="btn btn-warning btn-sm btn-upper btn-width-full">Mark as completed</button><br>';
												}
												echo '</div>';
												echo '</div>';
												echo '</div></div></div>';
											}
										}else {
											echo '<div class="alert alert-light" role="alert"><div class="alert-text"><span class="kt-font-bolder kt-font-md">You do not have any orders yet!</span></div></div>';
										}

										?>
																			</div>
																			<!--end::Accordion-->
																	</div>
															</div>
															<!--end::Portlet-->
													</div>
											</div>
											<!--End::Dashboard 3-->
										</div>
                </div>
                <div class="kt-portlet__body" id="rec-gd" style="background-color: #f6f6f6;display:none;"></div>
                <div class="kt-portlet__body" style="background-color: #f6f6f6;display:none;" id="rec-map">
                    <ul class="nav nav-tabs  nav-tabs-line" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tabs_3_1" role="tab" aria-selected="true" data-id="1">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tabs_3_2" role="tab" aria-selected="false" data-id="2">Unshipped</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tabs_3_3" role="tab" aria-selected="false" data-id="3">Cancelled</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tabs_3_4" role="tab" aria-selected="false" data-id="4">Shipped</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_tabs_3_1" role="tabpanel">
                            <div id="kt_gmap_1" style="height: 500px; position: relative; overflow: hidden;"></div>
                        </div>
                        <div class="tab-pane-" id="kt_tabs_3_2" role="tabpanel">
                            <div id="kt_gmap_2"></div>
                        </div>
                        <div class="tab-pane" id="kt_tabs_3_3" role="tabpanel">
                            <div id="kt_gmap_3"></div>
                        </div>
                        <div class="tab-pane" id="kt_tabs_3_4" role="tabpanel">
                            <div id="kt_gmap_4"></div>
                        </div>
                    </div>
                </div>
            </div>
						<!--end::Portlet-->
        </div>



    </div>
    <!--End::Dashboard 3-->
</div>
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_ship" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Shipment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="jbform">
          <input type="hidden" name="shipment_orderId" id="shipment_orderId" value="">
          <input type="hidden" name="userId" id="userId" value="<?php echo $userId;?>">
					<input type="hidden" name="shipmentId" id="shipmentId" value="">
          <div class="form-group">
            <label for="shipped_by" class="form-control-label">Shipment Type:</label>
						<select name="shipped_by" id="shipped_by" class="form-control">
								<option value="">Select shipping option</option>
								<option value="1">I will deliver the package myself</option>
								<option value="2">I will schedule for pickup</option>
						</select>
          </div>
					<div id="shipment-msg" class="form-group" style="display:none;">
						<span>The moment you choose the shipment company and click on submit, you can not choose other options, because the shipment is on the process.</span>
					</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" id="btn-shippedby">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--end::Modal-->
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_bmap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buyer Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="orderlatitude" id="orderlatitude" value="">
        <input type="hidden" name="orderlongitude" id="orderlongitude" value="">
				<div id="kt_gmap_address"></div>
    </div>
  </div>
</div>
<!--end::Modal-->
<!-- end:: Content -->
</div>


<div class="loader" id="wait">
	<img src="<?php echo DIR_ROOT.DIR_MED.DIR_CON;?>loader-jb.gif" alt="">
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script type="text/javascript">
    var searchGrid = function() {
        // var selected_roleId = $('#kt_form_status').val().toLowerCase();
        // var selected_status = $('#kt_form_type').val().toLowerCase();
        // var generalSearch = $('#generalSearch').val();
        var url = "https://jomlahbazar.com/api/v1/orders/CON_ordersreceivedgrid.php?action=get";
        // if(selected_roleId) url+="&roleId="+selected_roleId;
        // if(selected_status) url+="&login="+selected_status;
        // if(generalSearch) url+="&generalSearch="+generalSearch;
        $.ajax({
            url: url,
            success: function(result) {
                document.getElementById("rec-gd").innerHTML = "";
                $("#rec-gd").html(result);
            }
        });
    };
		searchGrid();
    $("#kt_wrapper").on('click', '.nav-link', function() {
        $("#kt_gmap_1").attr("style", "width: 0px; height: 0px; position: relative; overflow: hidden;");
        $("#kt_gmap_2").attr("style", "width: 0px; height: 0px; position: relative; overflow: hidden;");
        $("#kt_gmap_3").attr("style", "width: 0px; height: 0px; position: relative; overflow: hidden;");
        $("#kt_gmap_4").attr("style", "width: 0px; height: 0px; position: relative; overflow: hidden;");
        var mapId = $(this).data("id");
        var mapname = "#kt_gmap_" + mapId;
        $(mapname).attr("style", "height: 500px; position: relative; overflow: hidden;");
    });
		var orderaddress = function() {
			var orderlatitude = $('#orderlatitude').val();
      var orderlongitude = $('#orderlongitude').val();
			var map = new GMaps({
				div: '#kt_gmap_address',
				lat: orderlatitude,
				lng: orderlongitude
			});
			map.addMarker({
				lat: orderlatitude,
				lng: orderlongitude
			});
			map.setZoom(13);
		}
</script>

<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<script src="assets/js/pages/components/calendar/list-view.js" type="text/javascript"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
<script type="text/javascript">
    function productreview(pid) {
        location.href = "<?php echo DIR_VIEW.DIR_PRO;?>productdetails.php?productId=" + pid + "#suppliers_map";
    }
		function orderdetails(orderdetailId) {
			window. location. href = DIR_VIEW+DIR_ORD+'received_orders_detail.php?orderdetailId='+orderdetailId;
		}
		function shiporder(oid,shpid) {
      $('#shipment_orderId').val(oid);
      $('#shipmentId').val(shpid);
    }
		function maporder(lat,long) {
      $('#orderlatitude').val(lat);
      $('#orderlongitude').val(long);
    }
		$('#btn-shippedby').click(function(e) {
		  var shipped_by = $('#shipped_by').val();
		  var shipmentId = $('#shipmentId').val();
		  var orderId = $('#shipment_orderId').val();
		  e.preventDefault();
		  var btn = $(this);
		  var formdata1 = new FormData($('#jbform')[0]);
		  btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
		  $.ajax({
		    type: "POST",
		    url: DIR_CONT+DIR_ORD+"CON_Orders.php?action=post-shipment",
		    cache: false,
		    contentType: false,
		    processData: false,
		    data: formdata1,
		    dataType: "json",
		    success: function(data) {
		      switch (data['err']) {
		        case 0:
		        if (shipped_by==2) {
		          CreateBooking(orderId);
		        }else {
		          // similate 2s delay
		          setTimeout(function() {
		            btn.removeClass(
		              'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
		            ).attr('disabled', false);
		            //Simulate an HTTP redirect:
		            window.location.reload();
		          }, 3000);
		        }
		          break;
		        case 1:
		          // similate 2s delay
		          setTimeout(function() {
		            btn.removeClass(
		              'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
		            ).attr('disabled', false);
		            showErrorMsg(form, 'danger',
		              'Incorrect username or password. Please try again.');
		          }, 2000);
		          break;
		        case 2:
		          // similate 2s delay
		          setTimeout(function() {
		            btn.removeClass(
		              'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
		            ).attr('disabled', false);
		            showErrorMsg(form, 'danger',
		              'Missing required parameters. Please try again.');
		          }, 2000);
		          break;
		        default:
		      }
		    }
		  });
		});
		$('#shipped_by').change(function(e) {
		  var shipped_by = $('#shipped_by').val();
		  if (shipped_by==2) {
		    $('#shipment-msg').show();
		  }else {
		    $('#shipment-msg').hide();
		  }
		});
		/*emiratespost book a shipment*/
		function CreateBooking(oid) {
		  $.ajax({
		    url: DIR_ROOT+DIR_API + "emiratespost/createbookingtest.php",
		    // url: DIR_ROOT+DIR_API + "aramex/aramex.php",
		    type: "get", //send it through post method
		    data: {
		      orderId: oid,
		    },
		    beforeSend: function() {$("#wait").css("display", "block");},
		    success: function(response) {
		      window.open(DIR_ROOT+DIR_API+'emiratespost/awbpdf/'+response, '_blank');
		      // window.open(response, '_blank');
		      setTimeout(function() {window.location.reload();},2000);
		      $("#wait").css("display", "none");
		    },
		    error: function(xhr) {
		      console.log("err");
		    }
		  });
		}
		$("#kt_wrapper").on('click','.printawb', function() {
			var btn = $(this);
			var awb = $(this).data("id");
			var tracking_number = $(this).data("tracking");
			btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
			if (awb!=tracking_number){
				window.open(DIR_ROOT+DIR_API+"emiratespost/awbpdf/"+awb);
				// window.open(awb);
				btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
			}else{
				$.ajax({
				  method: "POST",
				  url: DIR_ROOT+DIR_API+"asyadexpress/asyad.php?action=printlabel",
					data: { awb: awb }
				}).done(function( msg ) {
					btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
				  window.open(msg);
				  });
			}
		});
		function cancelorder(odid) {
			$.ajax({
        url: DIR_CONT+DIR_ORD+"CON_Orders.php?action=cancel_product_order&orderdetailId="+odid+"&sellerId=<?php echo $userId;?>",
        success: function(result){
          location.reload();
        }
      });
		}
		$('#kt_modal_bmap').on('shown.bs.modal', function () {
			$("#kt_gmap_address").attr("style", "height: 300px; position: relative; overflow: hidden;");
		  orderaddress();
		});
		function completeorder(orderId) {
			$.ajax({
        url: DIR_CONT+DIR_ORD+"CON_Orders.php?action=complete_order&orderId="+orderId,
        success: function(result){
          location.reload();
        }
      });
		}
</script>
