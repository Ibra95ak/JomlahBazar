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
$res_order_everything = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_functions.php?action=get_received_order_details&orderId=' . $_GET['orderId']);
$orderEverything = json_decode($res_order_everything->getBody());
$res_delivery_fee = $client->request('GET', DIR_CONT . DIR_CAR . "CON_functions.php?action=get_delivery_options");
$delivery_fee = json_decode($res_delivery_fee->getBody());
$jb_fees=0;
foreach ($orderEverything as $orderdetail) {
  $total_order_price = $orderdetail->item_price * $orderdetail->item_quantity;
  $jb_fees+= $total_order_price*$orderdetail->jb_percentage_fees;
}
$net_value = $orderEverything[0]->order_total_price - $jb_fees - ($delivery_fee->value/2);
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
                                              <td><strong>Item</strong></td>
                                              <td class="text-center"><strong>Price</strong></td>
                                              <td class="text-center"><strong>Quantity</strong></td>
                                              <td class="text-right"><strong>Totals</strong></td>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php foreach ($orderEverything as $order) {
                                          ?>
                                              <tr>
                                                  <td><img src="<?php echo DIR_ROOT.$order->path;?>" width="50px"/><?php echo $order->name; ?></td>
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
                                              <td class="no-line text-right">AED <?php echo $delivery_fee->value/2;?></td>
                                          </tr>
                                          <tr>
                                              <td class="no-line"></td>
                                              <td class="no-line"></td>
                                              <td class="no-line text-center"><strong>Total</strong></td>
                                              <td class="no-line text-right">AED <?php echo $orderEverything[0]->order_total_price+$delivery_fee->value/2; ?></td>
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

                    <!--begin:: Widgets/Stats2-1 -->
                    <div class="kt-widget1">
                        <div class="kt-widget14__header kt-margin-b-30">
                            <h3 class="kt-widget14__title kt-font-bolder kt-font-lg">
                                Billed To:
                            </h3>
                            <span class="kt-widget14__desc">
                                This is the default address of the customer
                            </span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Fullname</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderEverything[0]->fullname; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Address</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderEverything[0]->address1; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">City, State</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderEverything[0]->city; ?>, <?php echo $orderEverything[0]->state; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Postal code, Country</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderEverything[0]->postalcode; ?>, <?php echo $orderEverything[0]->country; ?></span>
                        </div>

                    </div>

                    <!--end:: Widgets/Stats2-1 -->
                </div>
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
                        </div>

                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Fullname</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderEverything[0]->fullname; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Address</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderEverything[0]->address1; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">City, State</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderEverything[0]->city; ?>, <?php echo $orderEverything[0]->state; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Postal code, Country</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderEverything[0]->postalcode; ?>, <?php echo $orderEverything[0]->country; ?></span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Shipment Type</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark">
                              <?php
                                switch ($orderEverything[0]->type) {
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
                                switch ($orderEverything[0]->shipped_by) {
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
                                <h3 class="kt-widget1__title">Name</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark">Cash on delivery</span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Extra fees</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark">AED 0</span>
                        </div>
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Order date</h3>
                            </div>
                            <span class="kt-widget1__number kt-font-dark"><?php echo $orderEverything[0]->order_date; ?></span>
                        </div>

                    </div>

                    <!--end:: Widgets/Stats2-2 -->
                </div>

            </div>

<hr>
            <div class="row">

            <div class="col-xl-6">
</div>
<div class="col-xl-4">
<img src="<?php echo DIR_ROOT.DIR_ICON;?>shipmentdetail.png" alt="" style="width: 350px;">
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
$('#btn-shippedby').click(function(e) {
  e.preventDefault();
  var btn = $(this);
  var form = $(this).closest('form');
  var formdata1 = new FormData($('#jbform')[0]);
  form.validate({
    rules: {
      shipped_by: {
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
    url: DIR_CONT+DIR_ORD+"CON_Orders.php?action=post-shipment&shipmentId=<?php echo $orderEverything[0]->shipmentId; ?>",
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
</script>
