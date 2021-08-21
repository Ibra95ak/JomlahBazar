<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if (isset($_SESSION['userId'])) {
    $res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
    $usr = json_decode($res_uid->getBody());
    $roleId = $usr->roleId;
    $userId = $usr->userId;
    switch ($_SESSION['Login_as']) {
        case 1:
            include("../" . DIR_CON . "header_buyer.php");
            break;
        case 2:
            include("../" . DIR_CON . "header_supplier.php");
            break;

        default:
            include("../" . DIR_CON . "header_buyer.php");
            break;
    }
} else {
    header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
if (!isset($_GET['from'])) {
    $from = date("Y-m-d");
}else {
  $from = $_GET['from'];
}
if (!isset($_GET['to'])) {
    $to = date("Y-m-d");
}else {
  $to = $_GET['to'];
}
$res_orders = $client->request('GET', DIR_CONT . DIR_ORD . 'CON_Orders.php?action=get_orders&userId=' . $userId . '&from=' . $from . '&to=' . $to);
$orders = json_decode($res_orders->getBody());
$res_reasons = $client->request('GET', DIR_CONT . DIR_ORD . 'CON_Orderdetails.php?action=get_refund_reasons');
$reasons = json_decode($res_reasons->getBody());
// filtering orders on the basis of all, open and cancel
?>
<style>
    .kt-widget.kt-widget--user-profile-3 .kt-widget__bottom .kt-widget__item .kt-widget__details .kt-widget__value {
        font-size: 12px;
    }
</style>

<script>
    currentUrl = window.location.href;
    var split = currentUrl.split('&');
    var message = split[2].split('=');
    if (message[1] == 'ordersuccess') {
        new Noty({
            type: 'success',
            theme: 'metroui',
            timeout: 3000,
            text: 'Your order has been submitted.',
        }).show();
    }

    if (message[1] == 'cancelled') {
        new Noty({
            type: 'warning',
            theme: 'metroui',
            timeout: 3000,
            text: 'Your order has been cancelled.',
        }).show();
    }

    if (message[1] == 'refunded') {
        new Noty({
            type: 'warning',
            theme: 'metroui',
            timeout: 3000,
            text: 'Your order has been refunded.',
        }).show();
    }
    function printSlip(id) {
        var id = id;
        var features = 'directories=no,menubar=no,status=no,titlebar=no,toolbar=no,width=1200,height=700,top=50,left=150,scrollbars=no';
        var mypopup = window.open(DIR_VIEW+DIR_ORD+'print_slip.php?orderId=' + id, 'mypopup', features);
    }
</script>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="background-color: #f5f5f5;">
    <!--Begin::Dashboard 3-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Marketplace</a></li>
            <li class="breadcrumb-item"><a href="#">Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Orders</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-9">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            My Orders
                        </h3>
                    </div>
                    <div class="kt-widget__item">
                        <label class="kt-font-dark kt-font-bold">Filter Orders</label>
                        <input type="text" class="form-control" id="kt_daterangepicker_my_orders" placeholder="Select date ranges" autocomplete="off">
                    </div>
                </div>

                <div class="kt-portlet__body" style="background-color: #FFFFFF;">
                      <!--begin::Accordion-->
                      <div id="kt_gmap_3"></div>
                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                      <?php
                        $i=0;
                        if ($orders->orders) {
                          foreach ($orders->orders as $order) {
                            $i++;
                            $handling = $order->handling;
                            $shipped = $order->shipmentId;
                            $paid = $order->paymentId;
                            $ordernumber = $order->ordernumber;
                            $orderId = $order->orderId;
                            $order_status = $order->statusId;
                            switch ($handling) {
                              case '1':
                                $invoice_of = "orderinvoicejb('".$ordernumber."')";
                                $invoice_icon = '<img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-icon.png" alt="" width="25px">';
                                $invoice_margin = 'kt-mb-1';
                                $order_name = 'Shipped to:';
                                $order_name_value = $username;
                                $orderlatitude = $order->orderlatitude;
                                $orderlongitude = $order->orderlongitude;
                                break;
                              case '2':
                                $invoice_of = "orderinvoiceseller(".$orderId.")";
                                $invoice_icon = "";
                                $invoice_margin = 'kt-mt-20';
                                $order_name = 'Seller:';
                                $order_name_value = $order->companyname;
                                $orderlatitude = $order->sellerlatitude;
                                $orderlongitude = $order->sellerlongitude;
                                break;
                              default:
                                $invoice_of = "orderinvoicejb('".$ordernumber."')";
                                $invoice_icon = '<img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-icon.png" alt="" width="25px">';
                                $invoice_margin = 'kt-mb-1';
                                $order_name = 'Shipped to:';
                                $order_name_value = $username;
                                $orderlatitude = $order->orderlatitude;
                                $orderlongitude = $order->orderlongitude;
                                break;
                            }
                            if($paid!=0){
                              switch ($order->payment_type) {
                                case '1':
                                  $status = $order->pay_status;
                                  break;
                                case '2':
                                  $status = $order->pay_status;
                                  break;
                                case '3':
                                  if ($order->pay_status=="Pending") {
                                    $status = 'Not PAID- <a class="kt-link kt-link--state kt-link--danger" data-toggle="modal" data-target="#kt_modal_pay" onclick="payorder('.$paid.')"> Upload Payment Receipt</a>';
                                  }else {
                                    $status = $order->pay_status;
                                  }
                                  break;
                                case '4':
                                  if ($order->pay_status=="Pending") {
                                    $status = 'Not PAID- <a class="kt-link kt-link--state kt-link--danger" data-toggle="modal" data-target="#kt_modal_pay" onclick="payorder('.$paid.')"> Upload Payment Receipt</a>';
                                  }else {
                                    $status = $order->pay_status;
                                  }
                                  break;
                                default:
                                  if ($order->pay_status=="Pending") {
                                    $status = 'Not PAID- <a class="kt-link kt-link--state kt-link--danger" data-toggle="modal" data-target="#kt_modal_pay" onclick="payorder('.$paid.')"> Upload Payment Receipt</a>';
                                  }else {
                                    $status = $order->pay_status;
                                  }
                                  break;
                              }
                            }else{
                              $status = 'Not PAID- <a class="kt-link kt-link--state kt-link--danger" data-toggle="modal" data-target="#kt_modal_pay" onclick="payorder('.$paid.')"> Upload Payment Receipt</a>';
                            }
                            if ($order->receipt && $order->pay_status!='Completed') {
                              $status = 'Not PAID- <a class="kt-link kt-link--state kt-link--success" data-toggle="modal" data-target="#kt_modal_pay" onclick="payorder('.$paid.')"> Payment Receipt Uploaded</a>';
                            }
                            if ($i==1) {
                              echo '<div class="card '.$invoice_margin.'"><div class="card-header" id="headingOne'.$i.'"><div class="card-title row" data-toggle="collapse" data-target="#collapseOne'.$i.'" aria-expanded="true" aria-controls="collapseOne'.$i.'">';
                            }else {
                              echo '<div class="card '.$invoice_margin.'"><div class="card-header" id="headingOne'.$i.'"><div class="card-title collapsed row" data-toggle="collapse" data-target="#collapseOne'.$i.'" aria-expanded="false" aria-controls="collapseOne'.$i.'">';
                            }
                            echo '<div class="col-md-1"><label>Order placed</label><br><span>'.$order->order_date.'</span></div>';
                            echo '<div class="col-md-1"><label>Total</label><br><span>'.$order->total_price.'</span></div>';
                            echo '<div class="col-md-2"><label>Order # </label><br><span>'.$order->ordernumber.'</span></div>';
                            echo '<div class="col-md-2"><label>'.$order_name.'</label><br><span data-toggle="modal" data-target="#kt_modal_smap" onclick="maporder('.$orderlatitude.','.$orderlongitude.')"><i class="flaticon-placeholder-2 kt-font-dark kt-font-md kt-mr-5"></i>'.$order_name_value.'</span></div>';
                            echo '<div class="col-md-2"><label>Payment Status </label><br><span>'.$status.'</span></div>';
                            if($order->tracking_number!='') {
                              $res_shipment = $client->request('GET', DIR_ROOT . DIR_API . 'emiratespost/trackingtest.php?trackingId='.$order->tracking_number);
                              $shipment_status = json_decode($res_shipment->getBody());
                              echo '<div class="col-md-2"><label>Tracking Number </label><br><span>'.$order->tracking_number.'</span></div>';
                              echo '<div class="col-md-2"><label>Shipment Status </label><br><span>'.$shipment_status->status_en.'</span></div>';
                            }
                            if ($shipped==0 && $order_status==4) {
                              echo '<div class="col-md-2"><label>Shipment Status </label><br><span>Canceled</span></div>';
                            }elseif ($shipped==0 && $order_status==8) {
                              echo '<div class="col-md-2"><label>Shipment Status </label><br><span><a class="kt-link kt-link--state kt-link--danger" data-toggle="modal" data-target="#kt_modal_ship" onclick="shiporder('.$orderId.')"> Upload Shipment Receipt</a></span></div>';
                            }else {
                              switch ($order->shipment_status) {
                                case '1':
                                  $ship_status = "Pending";
                                  break;
                                case '2':
                                  $ship_status = "Opened";
                                  break;
                                case '3':
                                  $ship_status = "Shipped";
                                  break;
                                case '4':
                                  $ship_status = "Canceled";
                                  break;
                                case '5':
                                  $ship_status = "Requested Refund";
                                  break;
                                case '6':
                                  $ship_status = "Completed";
                                  break;
                                case '7':
                                  $ship_status = "Closed";
                                  break;
                                case '8':
                                  $ship_status = "Booked";
                                  break;
                                default:
                                  $ship_status = "Pending";
                                  break;
                              }
                              echo '<div class="col-md-2"><label>Shipment Status </label><br><span>'.$ship_status.'</span></div>';
                            }
                            if (!strcmp($order->pay_status,"Declined") || $order_status!=4) {
                              echo '<div class="col-md-2"><button type="button" class="btn btn-warning btn-sm btn-upper kt-mt-5 btn-width-full" onclick="'.$invoice_of.'">'.$invoice_icon.'Summary</button></div>';
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
                            $today = strtotime(date('Y-m-d'));
                            if ($shipped!=0) {
                              $ship_date = $order->shipment_date;
                              $ship_date = strtotime($ship_date);
                              $refund_end_date = strtotime("+7 day", $ship_date);
                            }else {
                              $refund_end_date = $today;
                            }
                            foreach ($orderDetails as $orderDetail) {
                              echo '<div class="row kt-mb-10 safari-row-flex">';
                              echo '<div class="col-md-2"><img src="'.DIR_ROOT.$orderDetail->path.'" alt="" style="width: 110px; height: 94px"></div>';
                              echo '<div class="col-md-3"><span class="kt-pl5">'.$orderDetail->name.'</span><br><span class="btn btn-label-brand btn-sm btn-bold btn-upper btn-width-full">'.$orderDetail->totalprice . ' AED</span><br><button type="button" onclick="buyagain('.$orderDetail->productId.','.$orderDetail->quantity.','.$orderDetail->totalprice.','.$orderDetail->sellerId.')" class="btn btn-warning btn-sm btn-upper kt-mt-5 kt-font-bolder btn-width-full">Buy it again</button></div>';
                              echo '<div class="col-md-3">';
                              echo '<span>Status: '.$orderDetail->status.'</span>';
                              echo '</div>';
                              echo '<div class="col-md-4">';
                              echo '<button type="button" class="btn btn-warning btn-sm btn-upper btn-width-full" onclick="sellerreview('.$orderDetail->sellerId.')">Leave seller feedback</button><br>';
                              echo '<button type="button" class="btn btn-warning btn-sm btn-upper kt-mt-5 btn-width-full" onclick="productreview('.$orderDetail->productId.')">Write a product review</button><br>';
                              if($shipped==0 && $orderDetail->statusId!=4 && $orderDetail->statusId!=5) echo '<button type="button" class="btn btn-light btn-sm btn-upper kt-mt-5 btn-width-full" onclick="cancelorder('.$orderDetail->orderdetailId.')">Cancel</button><br>';
                              if(($shipped!=0 || ($orderDetail->statusId==4 && $order->payment_type!=1 && $order->payment_type!=5)) && $refund_end_date>=$today && $orderDetail->statusId!=5) echo '<button type="button" class="btn btn-light btn-sm btn-upper kt-mt-5 btn-width-full" data-toggle="modal" data-target="#kt_modal_refund" onclick="refundorder('.$orderDetail->orderdetailId.')">Refund</button><br>';
                              echo '</div>';
                              echo '</div>';
                              echo '<div class="row">';
                              echo '<div class="col-md-4">';
                              if ($order->payment_type==5 && $orderDetail->statusId!=4) {
                                echo '<button type="button" onclick="completeorder('.$order->orderId.')" class="btn btn-warning btn-sm btn-upper btn-width-full">Mark as completed</button><br>';
                              }
                              echo '</div></div>';
                            }
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
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_refund" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Refund</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="jbform">
          <input type="hidden" name="refund_orderdetailId" id="refund_orderdetailId" value="">
          <input type="hidden" name="userId" id="userId" value="<?php echo $userId;?>">
          <div class="form-group">
            <label for="reason" class="form-control-label">Refund Reason:</label>
            <select class="form-control" name="reason" id="reason">
              <option value="0">Select Reason</option>
              <?php
                foreach ($reasons->reasons as $reason) {
                  echo '<option value="'.$reason->reasonId.'">'.$reason->description.'</option>';
                }
              ?>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn_refund">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--end::Modal-->
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="jbformpay">
          <div class="form-group">
            <label for="reason" class="form-control-label">Upload Receipt:</label>
            <div class="dropzone dropzone-default" id="kt_dropzone_1">
              <div class="dropzone-msg dz-message needsclick">
                <h3 class="dropzone-msg-title">Drop files here or click to upload your Receipt.</h3>
              </div>
            </div>
            <input type="hidden" name="payment_receipt" id="payment_receipt" value="">
            <input type="hidden" name="paymentId" id="paymentId" value="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn_pay">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--end::Modal-->
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_ship" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Shipment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="jbformship">
          <div class="form-group">
            <label for="reason" class="form-control-label">Upload Receipt:</label>
            <div class="dropzone dropzone-default" id="kt_dropzone_2">
              <div class="dropzone-msg dz-message needsclick">
                <h3 class="dropzone-msg-title">Drop files here or click to upload your Receipt.</h3>
              </div>
            </div>
            <input type="hidden" name="shipment_receipt" id="shipment_receipt" value="">
            <input type="hidden" name="ship_orderId" id="ship_orderId" value="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btn_ship">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--end::Modal-->
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_smap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seller Address</h5>
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
<div class="loader" id="wait" style="display:none">
  <img src="<?php echo DIR_ROOT.DIR_MED.DIR_CON;?>loader-jb.gif" alt="">
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<script src="assets/js/pages/components/calendar/list-view.js" type="text/javascript"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
<script type="text/javascript">
    function productreview(pid) {
        location.href = "<?php echo DIR_VIEW.DIR_PRO;?>productdetails.php?productId=" + pid + "#suppliers_map";
    }
    function sellerreview(sid) {
        location.href = "<?php echo DIR_VIEW.DIR_STR;?>storedetails.php?userId=" + sid;
    }
    function cancelorder(odid) {
      $.ajax({
        url: DIR_CONT+DIR_ORD+"CON_Orders.php?action=cancel_product_order&orderdetailId="+odid+"&userId=<?php echo $userId;?>",
        beforeSend: function() {$("#wait").css("display", "block");},
        success: function(result){
          location.reload();
          $("#wait").css("display", "none");
        }
      });
    }
    function refundorder(odid) {
      $('#refund_orderdetailId').val(odid);
    }
    $('#btn_refund').click(function(e) {
      e.preventDefault();
      var btn = $(this);
      var formdata1 = new FormData($('#jbform')[0]);
      btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
      $.ajax({
        type: "POST",
        url: DIR_CONT+DIR_ORD+"CON_Orders.php?action=refund_product_order",
        cache: false,
        contentType: false,
        processData: false,
        data: formdata1,
        dataType: "json",
        success: function(data) {
          switch (data['err']) {
            case 0:
              // similate 2s delay
              setTimeout(function() {
                btn.removeClass(
                  'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                ).attr('disabled', false);
                //Simulate an HTTP redirect:
                window.open("https://wa.me/971508501162?text=Hi%2C%20I%20need%20help%20with%20a%20refund.");
                window.location.reload();
              }, 2000);
              break;
            case 1:
              // similate 2s delay
              setTimeout(function() {
                btn.removeClass(
                  'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                ).attr('disabled', false);
                //Simulate an HTTP redirect:
                window.location.reload();
              }, 2000);
              break;
            default:
          }
        }
      });
    });
    function payorder(pid) {
      $('#paymentId').val(pid);
    }
    function shiporder(oid) {
      $('#ship_orderId').val(oid);
    }
    function orderinvoiceseller(oid) {
      window.open(DIR_VIEW+DIR_ORD+"seller-invoice.php?orderId="+oid);
    }
    function orderinvoicejb(ordnb) {
      window.open(DIR_VIEW+DIR_ORD+"jomlahbazar-invoice.php?ordernumber="+ordnb);
    }
    $('#btn_pay').click(function(e) {
      e.preventDefault();
      var btn = $(this);
      var formdata1 = new FormData($('#jbformpay')[0]);
      btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
      $.ajax({
        type: "POST",
        url: DIR_CONT+DIR_ORD+"CON_Orders.php?action=pay_receipt",
        cache: false,
        contentType: false,
        processData: false,
        data: formdata1,
        dataType: "json",
        success: function(data) {
          switch (data['err']) {
            case 0:
              // similate 2s delay
              setTimeout(function() {
                btn.removeClass(
                  'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                ).attr('disabled', false);
                //Simulate an HTTP redirect:
                window.location.reload();
              }, 2000);
              break;
            case 1:
              // similate 2s delay
              setTimeout(function() {
                btn.removeClass(
                  'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                ).attr('disabled', false);
                //Simulate an HTTP redirect:
                window.location.reload();
              }, 2000);
              break;
            default:
          }
        }
      });
    });
    $('#btn_ship').click(function(e) {
      e.preventDefault();
      var btn = $(this);
      var formdata1 = new FormData($('#jbformship')[0]);
      btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
      $.ajax({
        type: "POST",
        url: DIR_CONT+DIR_ORD+"CON_Orders.php?action=ship_receipt",
        cache: false,
        contentType: false,
        processData: false,
        data: formdata1,
        dataType: "json",
        success: function(data) {
          switch (data['err']) {
            case 0:
              // similate 2s delay
              setTimeout(function() {
                btn.removeClass(
                  'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                ).attr('disabled', false);
                //Simulate an HTTP redirect:
                window.location.reload();
              }, 2000);
              break;
            case 1:
              // similate 2s delay
              setTimeout(function() {
                btn.removeClass(
                  'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
                ).attr('disabled', false);
                //Simulate an HTTP redirect:
                window.location.reload();
              }, 2000);
              break;
            default:
          }
        }
      });
    });
    function buyagain(pid,qty,tp,sid) {
      $.ajax({
        type: "POST",
        url: DIR_CONT+DIR_CAR+"CON_carts.php?action=buyagain&userId=<?php echo $userId?>",
        beforeSend: function() {$("#wait").css("display", "block");},
        data: {
        "productId": pid,
        "quantity": qty,
        "totalprice": tp,
        "sellerId": sid
        },
        dataType: "json",
        success: function(data) {
          switch (data['err']) {
            case 0:
              // similate 2s delay
              setTimeout(function() {
                //Simulate an HTTP redirect:
                window.location.href = DIR_VIEW+DIR_CAR+"cart.php";
                $("#wait").css("display", "none");
              }, 2000);
              break;
            case 1:
              // similate 2s delay
              setTimeout(function() {
                //Simulate an HTTP redirect:
                window.location.reload();
                $("#wait").css("display", "none");
              }, 2000);
              break;
            default:
          }
        }
      });
    }
    function maporder(lat,long) {
      $('#orderlatitude').val(lat);
      $('#orderlongitude').val(long);
    }
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
    // single file upload
    $('#kt_dropzone_1').dropzone({
        url: DIR_CONT+DIR_CON+"CON_upload_receipt.php?path=payments", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 1, // MB
        addRemoveLinks: true,
        accept: function(file, done) {
            document.getElementById('payment_receipt').value=file.name;
            done();
        },
        removedfile: function(file) {
             $('#payment_receipt').val('');
             file.previewElement.remove();
        }
    });
    $('#kt_dropzone_2').dropzone({
        url: DIR_CONT+DIR_CON+"CON_upload_receipt.php?path=shipments", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 1, // MB
        addRemoveLinks: true,
        accept: function(file, done) {
            document.getElementById('shipment_receipt').value=file.name;
            done();
        },
        removedfile: function(file) {
             $('#shipment_receipt').val('');
             file.previewElement.remove();
        }
    });
    $('#kt_modal_smap').on('shown.bs.modal', function () {
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
