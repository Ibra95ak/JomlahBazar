<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
/*update notification*/
//$res_order_notify = $client->request('GET', DIR_CONT . DIR_ORD . 'CON_notify.php?action=update-notifications&userId='.$userId.'&orderId=' . $_GET['orderId']);
$res_orderdetails = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_functions.php?action=get_received_order_details&orderdetailId=' . $_GET['orderdetailId']);
$orderetails = json_decode($res_orderdetails->getBody());
$delivery_fee = $orderetails->order_payment[0]->shipmentfees;
$jb_fees= $orderetails->order_payment[0]->paymentfees;
$total = $orderetails->order_payment[0]->total_price;
$vat = ($orderetails->orderdetails[0]->totalprice+$delivery_fee+$jb_fees)*0.05;
if($orderetails->order_shipment){
   $shipmentId = $orderetails->order_shipment[0]->shipmentId;
   $shippedby  = $orderetails->order_shipment[0]->shipped_by ;
   $awbpdf = $orderetails->order_shipment[0]->awbpdf;
   if ($shippedby==1) {
     $delivery_fee=0;
   }
}else {
  $shipmentId = 0;
  $shippedby  = 0;
  $awbpdf = "none";
}
$net_value = $orderetails->order_payment[0]->total_price - $jb_fees - ($delivery_fee) - $vat;
?>


<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->


    <div class="kt-portlet" style="margin-top: 50px;">
        <div class="kt-portlet__body kt-portlet__body--fit">
          <div class="row">
              <div class="col-xl-12">

                  <!--begin::Portlet-->
                  <div class="kt-portlet">
                      <div class="kt-portlet__head">
                          <div class="kt-portlet__head-label">
                              <h3 class="kt-portlet__head-title">
                                  Order Content
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
                                              <td class="kt-font-md"><strong>Item</strong></td>
                                              <td class="text-center"><strong>Total Weight</strong></td>
                                              <td class="text-center"><strong>Total Quantity</strong></td>
                                              <td class="text-center"><strong>Total Price</strong></td>
                                          </tr>
                                      </thead>
                                      <tbody>
                                              <tr>
                                                  <td><img src="<?php echo DIR_ROOT.$orderetails->orderdetails[0]->path;?>" width="50px"/><?php echo $orderetails->orderdetails[0]->name; ?></td>
                                                  <td class="text-center"><?php echo $orderetails->orderdetails[0]->totalweight; ?> KG</td>
                                                  <td class="text-center"><?php echo $orderetails->orderdetails[0]->quantity; ?></td>
                                                  <td class="text-center">AED <?php echo $orderetails->orderdetails[0]->totalprice;?></td>
                                              </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>

                          <!--end::Section-->

                      </div>

                      <!--end::Form-->
                  </div>


                  <!--end::Portlet-->
              </div>
          </div>
            <div class="row row-no-padding row-col-separator-xl border-bottom">
                <div class="col-xl-4">
                  <!--begin:: Widgets/Stats2-2 -->
                    <div class="kt-widget1">

                        <div class="kt-widget14__header kt-margin-b-30">
                            <h3 class="kt-widget14__title kt-font-bolder kt-font-lg">
                                Shipped To:
                            </h3>
                            <span class="kt-widget14__desc">
                                The items will be shipped to this address
                            </span>
                            <img id="gmaplocation" src="<?php //echo DIR_ROOT.DIR_MED.DIR_CON;?>gmaplocation.png" alt="" data-toggle="modal" data-target="#kt_modal_buyerloc">
                        </div>

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Fullname</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderetails->user_info[0]->fullname; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Address</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderetails->order_address[0]->address1; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">City, State</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderetails->order_address[0]->city; ?>, <?php echo $orderetails->order_address[0]->state; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Postal code, Country</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderetails->order_address[0]->postalcode; ?>, <?php echo $orderetails->order_address[0]->country; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Shipment Type</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark">
                              <?php
                                switch ($orderetails->order[0]->shipment_type) {
                                  case '1':
                                    $shipmenttype="Door To Door";
                                    break;
                                  case '2':
                                    $shipmenttype="Pickup";
                                    break;
                                  default:
                                    $shipmenttype="Door To Door";
                                    break;
                                }
                                echo $shipmenttype;
                              ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Shipped By</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark">
                              <?php
                                switch ($shippedby) {
                                  case '1':
                                    $shipped_by="Seller";
                                    break;
                                  case '2':
                                    $shipped_by="JB Delivery";
                                    break;
                                  default:
                                    $shipped_by="NA";
                                    break;
                                }
                                echo $shipped_by;
                              ?></span>
                        </div>
                    </div>
                    <!--end:: Widgets/Stats2-2 -->
                </div>
                <div class="col-xl-4">


                    <div class="kt-widget1">


                        <div class="kt-widget14__header kt-margin-b-30">
                            <h3 class="kt-widget14__title kt-font-bolder kt-font-lg">
                                Order details
                            </h3>
                            <span class="kt-widget14__desc">
                                All the details about order and the payment
                            </span>
                        </div>

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Total Collected price</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark">AED <?php echo $orderetails->order_payment[0]->total_price;?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Other Fees</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-raspberry">AED <?php echo $jb_fees;?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Shipment Fees</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-raspberry">AED <?php echo $delivery_fee;?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">VAT</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-raspberry">AED <?php echo $vat;?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Net value</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark">AED <?php echo $net_value;?></span>
                        </div>
                    </div>

                </div>
                <div class="col-xl-4">


                    <!--begin:: Widgets/Stats2-2 -->
                    <div class="kt-widget1">

                        <div class="kt-widget14__header kt-margin-b-30">
                            <h3 class="kt-widget14__title kt-font-bolder kt-font-lg">
                                Payment Method
                            </h3>
                            <span class="kt-widget14__desc">
                                This payment method was used while ordering
                            </span>
                        </div>

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Type</h3>
                            </div>
                            <?php
                              switch ($orderetails->order_payment[0]->payment_type) {
                                case '1':
                                  $payment_type = "Cash on delivery";
                                  break;
                                case '2':
                                  $payment_type = "Online payment";
                                  break;
                                case '3':
                                  $payment_type = "Bank Transfer";
                                  break;
                                case '5':
                                  $payment_type = "Cash on Pickup";
                                  break;
                                default:
                                  $payment_type = "None";
                                  break;
                              }
                            ?>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $payment_type;?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Order date</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderetails->order[0]->order_date; ?></span>
                        </div>

                    </div>

                    <!--end:: Widgets/Stats2-2 -->
                </div>

            </div>

<hr>
            <div class="row">


<div class="col-xl-3">
<img src="<?php echo DIR_ROOT.DIR_ICON;?>shipmentdetail.png" alt="" style="width: 350px;">
</div>
</div>
</div>
</div>
    <!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<div class="modal fade" id="kt_modal_buyerloc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <div id="kt_gmap_buyer" style="height:300px;display:block;">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script type="text/javascript">
$('#btn-shippedby').click(function(e) {
  var orderId = getUrlParameter("orderId");
  var shipped_by = $('#shipped_by').val();
  var shipmentId = $('#shipmentId').val();
  var orderdetailId = $('#orderdetailId').val();
  e.preventDefault();
  var btn = $(this);
  var form = $(this).closest('form');
  var formdata1 = new FormData($('#jbform')[0]);
  form.validate({
    rules: {
      shipped_by: {
        required: true
      },
      shipmentId: {
        required: true
      }
    }
  });
  if (!form.valid()) {
    return;
  }
  btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
  $.ajax({
    type: "POST",
    url: DIR_CONT+DIR_ORD+"CON_Orders.php?action=post-shipment&shipmentId="+shipmentId,
    cache: false,
    contentType: false,
    processData: false,
    data: formdata1,
    dataType: "json",
    success: function(data) {
      switch (data['err']) {
        case 0:
        if (shipped_by==2) {
          CreateBooking(orderdetailId);
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
function CreateBooking(odid) {
  $.ajax({
    url: DIR_ROOT+DIR_API + "emiratespost/createbookingtest.php",
    type: "get", //send it through post method
    data: {
      orderdetailsId: odid,
    },
    beforeSend: function() {$("#wait").css("display", "block");},
    success: function(response) {
      window.open(DIR_ROOT+DIR_API+'emiratespost/awbpdf/'+response, '_blank');
      setTimeout(function() {window.location.reload();},1000);
      $("#wait").css("display", "none");
    },
    error: function(xhr) {
      console.log("err");
    }
  });
}
function printawb(awb) {
  window.open(DIR_ROOT+DIR_API+"emiratespost/awbpdf/"+awb);
}
function showlocation() {
  var map = new GMaps({
    div: '#kt_gmap_buyer',
    lat: 25.2048,
    lng: 55.2708,
  });
  var url = DIR_CONT+DIR_USR+"CON_buyer_profile.php?action=get-default-address&userId=<?php echo $userId?>";
  $.get(url, function(data, status) {
    var users = JSON.parse(data);
    users.forEach((item, i) => {
      map.addMarker({
        lat: item.latitude,
        lng: item.longitude,
        title: item.fullname,
        icon: DIR_ROOT+DIR_ICON+"marker-orange.png",
        infoWindow: {
          content: '<span style="color:#000">' + item.fullname + '</span>'
        }
      });
    });
  });
  map.setZoom(7);
}
$('#kt_modal_buyerloc').on('shown.bs.modal', function (e) {
  showlocation();
})
</script>
