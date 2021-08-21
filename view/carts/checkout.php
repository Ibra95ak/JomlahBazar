<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
require_once '../../' . DIR_MOD . 'Ser_Carts.php';/*call carts class*/
use Vectorface\Whip\Whip;
$client = new GuzzleHttp\Client();
$whip = new Whip();
if (isset($_SESSION['userId'])) {
  $res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
  $usr = json_decode($res_uid->getBody());
  $roleId = $usr->roleId;
  $userId = $usr->userId;
  switch ($_SESSION['Login_as']) {
    case 1:
      include('../' . DIR_CON . "header_buyer.php");
      break;
    case 2:
      include('../' . DIR_CON . "header_supplier.php");
      break;

    default:
      include('../' . DIR_CON . "header_buyer.php");
      break;
  }
} else {
  header("location:" . DIR_VIEW . DIR_USR . "login.php");
}/*Get page header*/
$db = new Ser_Carts();
$res_cart = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_carts.php?action=get&userId=' . $userId);/*fetch userId*/
$cart = json_decode($res_cart->getBody());
$res_addresses = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_functions.php?action=get_all_addresses_by_id&userId=' . $userId);
$addresses = json_decode($res_addresses->getBody());
$res_user = $client->request('GET', DIR_CONT . DIR_USR . 'CON_user_profile.php?action=get&userId=' . $userId);/*fetch user info*/
$user_info = json_decode($res_user->getBody());
if ($user_info->info[0]->email) $email = $user_info->info[0]->email;
else $email = "jb@test.com";
$otp = $user_info->info[0]->otp;
$fullname = explode(" ", $user_info->info[0]->fullname);
if (isset($fullname[0])) $fname = $fullname[0];
else $fname = "NA";
if (isset($fullname[1])) $lname = $fullname[1];
else $lname = "NA";
$res_fees = $client->request('GET', DIR_CONT . DIR_WLT . 'CON_Wallets.php?action=get-payment-fees');/*fetch user info*/
$payment_fees = json_decode($res_fees->getBody());
$res_omanareas = $client->request('GET', DIR_CONT . DIR_ADRS . 'CON_locationsDropdown.php?action=getomanareas');/*fetch user info*/
$omanareas = json_decode($res_omanareas->getBody());
?>

<!--begin::Page Custom Styles(used by this page) -->
<link href="assets/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <!--Begin::Dashboard 3-->
  <div class="row safari-row-flex">
    <div class="col-md-9">
      <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
          <div class="row">
            <div class="col-lg-12">
              <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white kt-wizard-v3__nav-items--clickable" id="kt_wizard_v3" data-ktwizard-state="first">
                <div class="kt-grid__item">
                  <!--begin: Form Wizard Nav -->
                  <div class="kt-wizard-v3__nav">
                    <!--doc: Remove "kt-wizard-v3__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                    <div class="kt-wizard-v3__nav-items" style="text-align: center;">
                      <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                        <div class="kt-wizard-v3__nav-body" style="width: 200px;">
                          <div class="kt-wizard-v3__nav-label">
                            <span>1</span> Location Address
                          </div>
                          <div class="kt-wizard-v3__nav-bar" style="height: 2px;"><img id="checkout-s1" class="checkout-cart" src="assets/media/icons/address.png" /></div>
                        </div>
                      </div>
                      <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                        <div class="kt-wizard-v3__nav-body" style="width: 200px;">
                          <div class="kt-wizard-v3__nav-label">
                            <span>2</span> Payment &amp; Shipment
                          </div>
                          <div class="kt-wizard-v3__nav-bar" style="height: 2px;"><img id="checkout-s2" class="checkout-cart" src="assets/media/icons/shipping_company.png" style="display:none;" /></div>
                        </div>
                      </div>
                      <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" data-ktwizard-state="pending">
                        <div class="kt-wizard-v3__nav-body" style="width: 200px;">
                          <div class="kt-wizard-v3__nav-label">
                            <span>3</span> Checkout
                          </div>
                          <div class="kt-wizard-v3__nav-bar" style="height: 2px;"><img id="checkout-s3" class="checkout-cart" src="assets/media/icons/review.png" style="display:none;" /></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!--end: Form Wizard Nav -->
                </div>
                <div class="row kt-mt-75 kt-ml-95 safari-row-flex">
                  <?php
                  $res_suppliers = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_carts.php?action=get-suppliers&userId='.$userId);/*fetch userId*/
                  $suppliers = json_decode($res_suppliers->getBody());
                  $count_suppliers = 0;
                  if($suppliers){
                    foreach ($suppliers as $supplier) {
                      $count_suppliers++;
                      $totalPrice += number_format($supplier->total_seller,2,'.','');
                      $totalWeight += $supplier->total_weight;
                      // echo "string=".$supplier->flag;
                      // $cntry = country($supplier->flag);
                      // $egypt = country('eg');
                      // echo $egypt->getFlag();
                      // echo $cntry->getFlag();
                      echo '<div class="col-xl-2" data-toggle="modal" data-target="#kt_modal_invoice" onclick="showdetails('.$supplier->sellerId.')"><div class="kt-portlet kt-portlet--height-fluid" style="min-height: 100px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__head-label">';
                      echo '<div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media">';
                      if ($supplier->profile_pic) {
                        echo '<a href="javascript:void(0)"><img class="kt-widget__img-sm " src="'.$supplier->profile_pic.'" alt="image"></a>';
                      }else {
                        echo '<a href="javascript:void(0)"><img class="kt-widget__img-sm " src="'.DIR_ROOT.DIR_MED.'companies/default.jpg" alt="image"></a>';
                      }
                      echo '</div><div class="kt-widget__content"><div class="kt-widget__section"> <div class="row safari-row-flex"><div class="col-md-12 kt-p0">';
                      if (strlen($supplier->companyname)>22) {
                        echo '<a href="javascript:void(0)" class="kt-widget__username kt-font-sm kt-p0" data-toggle="modal" data-target="#kt_modal_invoice" onclick="showdetails('.$supplier->sellerId.')">'.substr($supplier->companyname,0,19).'...</a>';
                      }else {
                        echo '<a href="javascript:void(0)" class="kt-widget__username kt-font-sm kt-p0" data-toggle="modal" data-target="#kt_modal_invoice" onclick="showdetails('.$supplier->sellerId.')">'.$supplier->companyname.'</a>';
                      }
                      echo '</div><div class="col-md-12"><a href="javascript:void(0)" class="kt-widget__username kt-font-bolder kt-p0" data-toggle="modal" data-target="#kt_modal_invoice" onclick="showdetails('.$supplier->sellerId.')">AED '.number_format($supplier->total_seller,2).'</a></div></div>';
                      if($supplier->wired==1){
                        echo '<div id="seller-bank-'.$supplier->sellerId.'" style="display:none;" class="kt-mt-20">';
                        echo '<label class="kt-font-md kt-font-bolder">Your payment amount:</label><span class="kt-font-md kt-font-bolder kt-font-raspberry">'.number_format($supplier->total_seller,2).' AED</span><br>';
                        echo '<label class="kt-font-md">Account Name:</label><span class="kt-font-md kt-font-bolder"> '.$supplier->account_name.'</span><br>';
                        echo '<label class="kt-font-md">Account Number:</label><span class="kt-font-md kt-font-bolder"> '.$supplier->account_number.'</span><br>';
                        echo '<label class="kt-font-md">Bank Name:</label><span class="kt-font-md kt-font-bolder"> '.$supplier->bank_name.'</span><br>';
                        echo '<label class="kt-font-md">IBAN:</label><span class="kt-font-md kt-font-bolder"> '.$supplier->iban.'</span><br>';
                        echo '<label class="kt-font-md">Swift Code:</label><span class="kt-font-md kt-font-bolder"> '.$supplier->swift_code.'</span><br>';
                        echo '<label class="kt-font-md">Currency:</label><span class="kt-font-md kt-font-bolder"> '.$supplier->currency.'</span><br>';
                        echo '</div>';
                      }
                      echo '</div>';
                      echo '</div></div></div></div></div></div></div>';
                    }
                    // $pay_total= $totalPrice+($totalPrice*0.05);
                     $pay_total= $totalPrice;
                  }else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
                  ?>
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
                  <!--begin: Form Wizard Form-->
                  <form class="kt-form" id="kt_form" novalidate="novalidate" style="width: 85%;">
                    <div class="row">
                      <div class="col-md-12">
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                          <div class="kt-heading kt-font-md kt-font-bolder">Select a Shipping Address</div>
                          <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                              <div class="row safari-row-flex">

                                <?php
                                if ($addresses) {
                                  foreach ($addresses as $add) {
                                    switch ($add->address_type) {
                                      case '1':
                                        $address_type = "HOME";
                                        break;
                                      case '2':
                                        $address_type = "OFFICE";
                                        break;
                                      case '3':
                                        $address_type = "CARGO";
                                        break;

                                      default:
                                        $address_type = "HOME";
                                        break;
                                    }
                                    $review_address = $add->address1 . '-' . $add->postalcode . '-,' . $add->city . ',' . $add->country;
                                    echo '<div class="col-md-4 kt-mb-15 border kt-p10">';
                                    echo  '<h3 class="kt-font-dark">' . $add->addresstitle . '</h3>';
                                    echo  '<p class="kt-font-dark kt-font-bolder">' . $address_type . '</p>';
                                    echo  '<h3 class="kt-font-dark" style="height:34px;">' . $add->address1 . '</h3>';
                                    echo '<p class="kt-font-dark">' . $add->postalcode . '<br>' . $add->city . '<br>' . $add->country . '</p>';
                                    echo '<div class="address-info">';
                                    echo '<a class="btn btn-success address-delivery btn-width-full" style="background: #f0c14b;border-color: #a88734 #9c7e31 #846a29; color:#111"  data-address="'.$review_address.'" data-id="'.$add->addressId.'">Use this address</a>';
                                    echo '<div style="padding-top: 10px">';
                                    echo '<button type="button" class="btn btn-outline-info btn-width-full kt-mb-10" style="background-color:#e7e9ec; border-color: #ADB1B8 #A2A6AC #8D9096; color:black; padding: 2px 5px 2px 5px; width:81px; margin-right:5px" data-id="' . $add->addressId . '" data-toggle="modal" data-target="#kt_modal_1" onclick="editaddress(' . $add->addressId . ')">Edit</button><br>';
                                    echo '<button type="button" class="btn btn-outline-info btn-width-full" style="background-color:#e7e9ec; border-color: #ADB1B8 #A2A6AC #8D9096; color:black; padding: 2px 5px 2px 5px; width:81px; margin-right:5px" onclick="deleteaddress(' . $add->addressId . ')">Delete</button>';
                                    echo '</div></div></div>';
                                  }
                                }
                                ?>
                              </div>
                              <div class="form-group" style="margin-top: 50px">
                                <button type="button" class="btn btn-bold btn-label-dark btn-sm" data-toggle="modal" data-target="#kt_modal_1" onclick="addaddress()"> Add a new address</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Wizard Step 2-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                          <div class="kt-portlet kt-portlet--mobile" id="domestic_portlet" style="display:none;">
                            <div class="kt-portlet__head">
                              <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title kt-font-md kt-font-bolder">
                                  GCC Market
                                </h3>
                              </div>
                            </div>
                            <div class="kt-portlet__body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="jbmethod">Choose Payment Method</label>
                                      <select class="form-control" id="jbmethod">
                                        <!-- <option value="1" data-fees="<?php //echo $payment_fees[2]->percentage;?>">Cash On Delivery</option> -->
                                        <option value="2" data-fees="<?php echo $payment_fees[0]->percentage;?>">Debit/Credit</option>
                                        <option value="3" data-fees="<?php echo $payment_fees[1]->percentage;?>">Bank Wired Transfer</option>
                                      </select>
                                      <div id="jb-bank" style="display:none;" class="kt-mt-20">
                                        <label class="kt-font-md">Account Name:</label><span class="kt-font-md kt-font-bolder"> Pomechain DMCC</span><br>
                                        <label class="kt-font-md">Account Number:</label><span class="kt-font-md kt-font-bolder"> 11804362920001</span><br>
                                        <label class="kt-font-md">Bank Name:</label><span class="kt-font-md kt-font-bolder"> Abu Dhabi Commercial Bank</span><br>
                                        <label class="kt-font-md">IBAN:</label><span class="kt-font-md kt-font-bolder"> AE430030011804362920001</span><br>
                                        <label class="kt-font-md">Swift Code:</label><span class="kt-font-md kt-font-bolder"> ADCBAEAA</span><br>
                                        <label class="kt-font-md">Currency:</label><span class="kt-font-md kt-font-bolder"> AED</span><br>
                                      </div>
                                  </div>
                                  <div class="kt-space-50"></div>
                                  <div id="onlinepayment" style="display:none;">
                                    <?php
                                    if ($user_info->creditcards) {
                                      foreach ($user_info->creditcards as $creditcard) {
                                        echo '<div class="col-md-6 kt-mb-15 border kt-p10">';
                                        $cardnumber = substr($creditcard->card_number,0,4)."********".substr($creditcard->card_number,-4);
                                        echo  '<h3 class="kt-font-dark">Card number: ' .$cardnumber. '</h3>';
                                        echo '<div class="address-info">';
                                        echo '<a class="btn btn-success creditcards btn-width-full" style="background: #f0c14b;border-color: #a88734 #9c7e31 #846a29; color:#111" data-id="'.$creditcard->creditcardId.'">Continue</a>';
                                        echo '<div style="padding-top: 10px">';
                                        echo '<button type="button" class="btn btn-outline-info btn-width-full kt-mb-10" style="background-color:#e7e9ec; border-color: #ADB1B8 #A2A6AC #8D9096; color:black; padding: 2px 5px 2px 5px; width:81px; margin-right:5px" data-id="' . $creditcard->creditcardId . '" data-toggle="modal" data-target="#kt_modal_6" onclick="editcard(' . $creditcard->creditcardId . ','.$creditcard->walletId.')">Edit</button><br>';
                                        echo '</div></div></div>';
                                      }
                                    }else {
                                      echo '<div class="form-group" style="margin-top: 50px"><button type="button" class="btn btn-bold btn-label-dark btn-sm" data-toggle="modal" data-target="#kt_modal_6" onclick="addcard()"> Add a new card.</button></div>';
                                    }
                                    ?>
                                  </div>
                                </div>
                                <div class="col-md-6 text-center">
                                  <div class="form-group">
                                    <label>Shipment Method</label>
                                    <br><span id="jb_shipment_method" class="kt-font-bolder kt-font-md"></span>
                                  </div>
                                  <div class="form-group">
                                    <img src="<?php echo DIR_ROOT.DIR_MED.DIR_CON."uaelocalmarket.png";?>" alt="" width="200px">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="kt-portlet kt-portlet--mobile" id="international_portlet" style="display:none;">
                            <div class="kt-portlet__head">
                              <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title kt-font-md kt-font-bolder">
                                  B2B International Market
                                </h3>
                              </div>
                            </div>
                            <div class="kt-portlet__body">
                              <div class="form-group">
                                <label>Booking is valid for 1 day, starting when you checkout.</label>
                                <br><span id="int_shipment_method" class="kt-font-bolder kt-font-md"></span>
                                <br><span id="int_shipment_reason" class="kt-font-md"></span>
                              </div>
                              <div class="form-group text-center">
                                <img src="<?php echo DIR_ROOT.DIR_MED.DIR_CON."internationalmarket.png";?>" alt="" width="500px">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                          <div class="kt-heading kt-font-md">Please Review your Booking Details Confirm and Submit.</div>
                          <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__review">
                              <div class="kt-wizard-v3__review-item">
                                <div class="kt-wizard-v3__review-title kt-font-dark">
                                  <span class="kt-font-md" id="note_onlinepayment" style="display:none;">You will be redirected to secure payment transaction.</span>
                                </div>
                                <div class="kt-wizard-v3__review-content">
                                  <span id="spanaddress"></span><br>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--end: Form Wizard Step 5-->

                    <!--begin: Form Actions -->
                    <div class="kt-form__actions">
                      <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                        Previous
                      </button>
                      <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit" style="background-color: #ebb44d; border-color:#ebb44d;" id="payclick">
                        Checkout
                      </button>
                      <button id="custom-next-step" class="btn btn-warning btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                        Next Step
                      </button>
                      <script>
                        function payFirst() {

                          alert('You will be redirected to Network Internation website to pay');
                          //$('#payment_form').submit();

                          $.ajax({
                            type: "POST",
                            url: DIR_ROOT+"network/ngs_post.php",
                            data: {
                              'payment_amount' : '<?php echo $totalprice ?>',
                              'payment_email' : '<?php echo $email ?>',
                              'payment_fname' : '<?php echo $fname ?>',
                              'payment_lname' : '<?php echo $lname ?>',
                              'payment_address' : 'Dubai, DMCC',
                              'payment_city' : 'Dubai',
                              'payment_countrycode' : 'AED',
                            },
                            success: function(data) {
                              console.log(data);

                              data = JSON.parse(data);

                              //window.open(data, '_blank');

                              var features = 'directories=no,menubar=no,status=no,titlebar=no,toolbar=no,width=1200,height=700,top=50,left=150,scrollbars=no,location=yes';
                              var mypopup = window.open(data, 'mypopup', features);
                              //console.log(mypopup);

                              var timer = setInterval(function() {

                                if (mypopup.closed) {
                                  clearInterval(timer);
                                  $('#payclick').click();
                                  //alert('closed');
                                }
                              }, 1000);


                            }
                          });

                        }
                      </script>
                    </div>
                    <!--end: Form Actions -->
                    <input type="hidden" name="hiddenuser" id="hiddenuser" value="<?php echo $userId;?>">
                    <input type="hidden" name="hiddenaddress" id="hiddenaddress">
                    <input type="hidden" name="hiddencreditcardId" id="hiddencreditcardId">
                    <input type="hidden" name="hiddenpayment" id="hiddenpayment" value="">
                    <input type="hidden" name="hiddentotal" id="hiddentotal" value="<?php echo $totalPrice;?>">
                    <input type="hidden" name="order_total_pay_value" id="order_total_pay_value" value="">
                    <input type="hidden" name="order_total_price_value" id="order_total_price_value" value="">
                    <input type="hidden" name="order_otherfees_value" id="order_otherfees_value" value="">
                    <input type="hidden" name="order_shipmentfees_value" id="order_shipmentfees_value" value="">
                    <input type="hidden" name="paymentfees" id="paymentfees" value="">
                  </form>
                  <!--end: Form Wizard Form-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form id="payform" action="https://forwardbazar.com/CUSTOM_CHECKOUT_FORM_KIT/ccavRequestHandler.php" method="post" class="kt-hidden">
        <input type="hidden" name="tid" id="tid" readonly />
        <input type="hidden" name="merchant_id" id="merchant_id" value="43551"/>
        <input type="hidden" name="order_id" id="order_id" value="123654789"/>
        <input type="hidden" name="redirect_url" id="redirect_url" value="https://forwardbazar.com/CUSTOM_CHECKOUT_FORM_KIT/ccavResponseHandler.php"/>
        <input type="hidden" name="cancel_url" id="cancel_url" value="https://forwardbazar.com/CUSTOM_CHECKOUT_FORM_KIT/ccavResponseHandler.php"/>
        <input type="hidden" name="amount" id="amount" value=""/>
        <input type="hidden" name="currency" id="currency" value="AED"/>
        <input type="hidden" name="language" id="language" value="EN"/>
        <input type="hidden" name="billing_name" id="billing_name" value=""/>
        <input type="hidden" name="billing_address" id="billing_address" value=""/>
        <input type="hidden" name="billing_city" id="billing_city" value=""/>
        <input type="hidden" name="billing_state" id="billing_state" value=""/>
        <input type="hidden" name="billing_zip" id="billing_zip" value=""/>
        <input type="hidden" name="billing_country" id="billing_country" value=""/>
        <input type="hidden" name="billing_tel" id="billing_tel" value="<?php echo $otp; ?>"/>
        <input type="hidden" name="billing_email" id="billing_email" value="<?php echo $email; ?>"/>
        <input type="hidden" name="payment_option" id="payment_option" value="OPTCRDC"/>
        <input type="hidden" name="card_type" id="card_type" value="CRDC"/>
        <input type="hidden" name="card_name" id="card_name" value=""/>
        <input type="hidden" id="data_accept" name="data_accept" readonly="readonly" value="N"/>
        <input type="hidden" name="card_number" id="card_number" value="">
        <input type="hidden" name="expiry_month" id="expiry_month" value=""  min="1" max="12">
        <input type="hidden" name="expiry_year" id="expiry_year" value="" max="3000">
        <input type="hidden" name="cvv_number" id="cvv_number" value="">
        <INPUT TYPE="button" value="CheckOut" onclick="payonline()">
    </form>
    <div class="col-lg-3">
      <!--begin:: Widgets/Sales States-->
      <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Cart total
            </h3>
            <a class="kt-ml-15" href="javascript:void(0)"><?php echo $supplier_count;?> SELLER(S)</a>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="kt-widget6">
            <div class="kt-widget6__head">
              <div class="kt-widget6__item">
                <span>Price</span>
                <span id="order_total_price" class="kt-font-bold" style="color: #e5230f;">AED <?php echo $totalPrice  ?></span>
              </div>
              <div class="kt-widget6__item">
                <span>Shipment fees</span>
                <span id="order_shipmentfees" class="kt-font-bold" style="color: #e5230f;">AED 0</span>
              </div>
              <div class="kt-widget6__item kt-hidden">
                <span>Other Fees</span>
                <span id="order_otherfees" class="kt-font-bold" style="color: #e5230f;">AED 0</span>
              </div>
              <div class="kt-widget6__item kt-hidden">
                <span>VAT(5%)</span>
                <span id="order_total_price_vat" class="kt-font-bold" style="color: #e5230f;">AED <?php echo "0.00"; //echo $totalPrice*0.05; ?></span>
              </div>
              <div class="kt-widget6__item">
                <span class="text-left"><b>Note:</b> Applicable charges will change depending on the chosen payment method.</span>
              </div>
            </div>
            <hr>
            <div class="kt-widget6__body">
              <div class="kt-widget6__item">
                <span class="kt-font-bolder">Total Price</span>
                <span id="order_total_pay" class="kt-font-bolder" style="color: #e5230f;">AED <?php echo $pay_total;?></span>
              </div>
              <div class="kt-widget6__item kt-hidden">
                <span class="kt-font-bolder">Total Weight</span>
                <span id="order_total_weight" class="kt-font-bolder" style="color: #e5230f;">KG <?php echo $totalWeight  ?></span>
              </div>
              <i class="fa fa-lock" style="font-size: 2rem; color: black"></i>
              <span style="padding-left: 10px;"><span>
                  <a data-container="body" data-toggle="kt-tooltip" data-placement="bottom" title="" data-original-title="We work hard to protect your security and privacy. Our payment security system encrypts your information during transmission. We don’t share your credit card details with third-party sellers, and we don’t sell your information to others.">
                    Secure transaction
                  </a>
                  <img src="assets/media/icons/ssl_logo.png" width="100px">

            </div>
          </div>
        </div>
      </div>

      <!--end:: Widgets/Sales States-->
    </div>
  </div>
  <!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<!-- Modal -->
<div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Manage a credit or debit card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="kt-form" id="jbform-cc">
          <input type="hidden" id="wallettype" name="wallettype" class="form-control" value="1">
          <input type="hidden" id="ccwalletId" name="ccwalletId" class="form-control" value="">
          <input type="hidden" id="creditcardId" name="creditcardId" class="form-control">
          <div class="kt-portlet__body">
            <div class="form-group">
              <select class="form-control" id="temp_payment_option" name="temp_payment_option">
                <option value="1" <?php if($card_type==1) echo "selected";else echo "";?>>Credit Card.</option>
                <option value="2"<?php if($card_type==2) echo "selected";else echo "";?>>Debit Card.</option>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control" id="temp_card_name" name="temp_card_name">
                <option value="Visa" <?php if($card_name=="Visa") echo "selected";else echo "";?>>Visa</option>
                <option value="MasterCard" <?php if($card_name=="MasterCard") echo "selected";else echo "";?>>MasterCard</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" name="temp_card_holdername" id="temp_card_holdername" class="form-control" placeholder="Card Holder Name" value="<?php echo $card_holdername;?>" onchange="document.getElementById('billing_name').value=this.value;">
            </div>
            <div class="form-group">
              <input type="number" name="temp_card_number" id="temp_card_number" class="form-control" placeholder="Card Number" value="<?php echo $card_number;?>" onchange="document.getElementById('card_number').value=this.value;">
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <input type="number" name="temp_expiry_month" id="temp_expiry_month" class="form-control" placeholder="Exp. Month" min="1" max="12" value="<?php echo $card_expirymonth;?>" onchange="document.getElementById('expiry_month').value=this.value;">
                </div>
                <div class="col-md-6">
                  <input type="number" name="temp_expiry_year" id="temp_expiry_year" class="form-control" placeholder="Exp. Year" max="3000" value="<?php echo $card_expiryyear;?>" onchange="document.getElementById('expiry_year').value=this.value;">
                </div>
              </div>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btn_submit-cc" name="btn_submit-cc" type="submit" class="btn btn-primary">Save My card</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--begin::Modal-->
<div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manage Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <!--begin::Form-->
        <form class="kt-form" id="jbform">
          <input type="hidden" name="userId" id="userId" value="<?php echo $userId ?>">
          <input type="hidden" name="addressId" id="addressId" value="">
          <div class="kt-portlet__body">
            <div class="kt-section kt-section--first kt-m0">
              <div class="row safari-row-flex">
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="addresstitle" id="addresstitle" placeholder="Invoice For name" value="">
                    <span class="form-text text-muted">Please enter the name you want to use in the invoice.</span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <select class="form-control" name="address_type" id="address_type">
                      <option value="1">Home</option>
                      <option value="2">Office</option>
                      <option value="3">Cargo</option>
                    </select>
                    <span class="form-text text-muted">Please enter your Address.</span>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full name" value="<?php echo $user_info->info[0]->fullname; ?>">
                    <span class="form-text text-muted">Please enter your Fullname.</span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>">
                    <span class="form-text text-muted">Please enter your Email.</span>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="address1" id="address1" placeholder="Address Line 1" value="" maxlength="35">
                    <span class="form-text text-muted">Please enter your Address.</span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="address2" id="address2" placeholder="Address Line 2" value="" maxlength="35">
                    <span class="form-text text-muted">Please enter your Address.</span>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="postalcode" id="postalcode" placeholder="Postalcode" value="">
                    <span class="form-text text-muted">Please enter your Postalcode.</span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <input type="text" class="form-control" name="city" id="city" placeholder="City" value="">
                    <span class="form-text text-muted">Please enter your City.</span>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-6">
                  <div class="form-group">
                    <select name="country" id="country" class="form-control">
                      <option value="">Select</option>
                      <option value="AF">Afghanistan</option>
                      <option value="AX">Åland Islands</option>
                      <option value="AL">Albania</option>
                      <option value="DZ">Algeria</option>
                      <option value="AS">American Samoa</option>
                      <option value="AD">Andorra</option>
                      <option value="AO">Angola</option>
                      <option value="AI">Anguilla</option>
                      <option value="AQ">Antarctica</option>
                      <option value="AG">Antigua and Barbuda</option>
                      <option value="AR">Argentina</option>
                      <option value="AM">Armenia</option>
                      <option value="AW">Aruba</option>
                      <option value="AU" selected="">Australia</option>
                      <option value="AT">Austria</option>
                      <option value="AZ">Azerbaijan</option>
                      <option value="BS">Bahamas</option>
                      <option value="BH">Bahrain</option>
                      <option value="BD">Bangladesh</option>
                      <option value="BB">Barbados</option>
                      <option value="BY">Belarus</option>
                      <option value="BE">Belgium</option>
                      <option value="BZ">Belize</option>
                      <option value="BJ">Benin</option>
                      <option value="BM">Bermuda</option>
                      <option value="BT">Bhutan</option>
                      <option value="BO">Bolivia, Plurinational State of</option>
                      <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                      <option value="BA">Bosnia and Herzegovina</option>
                      <option value="BW">Botswana</option>
                      <option value="BV">Bouvet Island</option>
                      <option value="BR">Brazil</option>
                      <option value="IO">British Indian Ocean Territory</option>
                      <option value="BN">Brunei Darussalam</option>
                      <option value="BG">Bulgaria</option>
                      <option value="BF">Burkina Faso</option>
                      <option value="BI">Burundi</option>
                      <option value="KH">Cambodia</option>
                      <option value="CM">Cameroon</option>
                      <option value="CA">Canada</option>
                      <option value="CV">Cape Verde</option>
                      <option value="KY">Cayman Islands</option>
                      <option value="CF">Central African Republic</option>
                      <option value="TD">Chad</option>
                      <option value="CL">Chile</option>
                      <option value="CN">China</option>
                      <option value="CX">Christmas Island</option>
                      <option value="CC">Cocos (Keeling) Islands</option>
                      <option value="CO">Colombia</option>
                      <option value="KM">Comoros</option>
                      <option value="CG">Congo</option>
                      <option value="CD">Congo, the Democratic Republic of the</option>
                      <option value="CK">Cook Islands</option>
                      <option value="CR">Costa Rica</option>
                      <option value="CI">Côte d'Ivoire</option>
                      <option value="HR">Croatia</option>
                      <option value="CU">Cuba</option>
                      <option value="CW">Curaçao</option>
                      <option value="CY">Cyprus</option>
                      <option value="CZ">Czech Republic</option>
                      <option value="DK">Denmark</option>
                      <option value="DJ">Djibouti</option>
                      <option value="DM">Dominica</option>
                      <option value="DO">Dominican Republic</option>
                      <option value="EC">Ecuador</option>
                      <option value="EG">Egypt</option>
                      <option value="SV">El Salvador</option>
                      <option value="GQ">Equatorial Guinea</option>
                      <option value="ER">Eritrea</option>
                      <option value="EE">Estonia</option>
                      <option value="ET">Ethiopia</option>
                      <option value="FK">Falkland Islands (Malvinas)</option>
                      <option value="FO">Faroe Islands</option>
                      <option value="FJ">Fiji</option>
                      <option value="FI">Finland</option>
                      <option value="FR">France</option>
                      <option value="GF">French Guiana</option>
                      <option value="PF">French Polynesia</option>
                      <option value="TF">French Southern Territories</option>
                      <option value="GA">Gabon</option>
                      <option value="GM">Gambia</option>
                      <option value="GE">Georgia</option>
                      <option value="DE">Germany</option>
                      <option value="GH">Ghana</option>
                      <option value="GI">Gibraltar</option>
                      <option value="GR">Greece</option>
                      <option value="GL">Greenland</option>
                      <option value="GD">Grenada</option>
                      <option value="GP">Guadeloupe</option>
                      <option value="GU">Guam</option>
                      <option value="GT">Guatemala</option>
                      <option value="GG">Guernsey</option>
                      <option value="GN">Guinea</option>
                      <option value="GW">Guinea-Bissau</option>
                      <option value="GY">Guyana</option>
                      <option value="HT">Haiti</option>
                      <option value="HM">Heard Island and McDonald Islands</option>
                      <option value="VA">Holy See (Vatican City State)</option>
                      <option value="HN">Honduras</option>
                      <option value="HK">Hong Kong</option>
                      <option value="HU">Hungary</option>
                      <option value="IS">Iceland</option>
                      <option value="IN">India</option>
                      <option value="ID">Indonesia</option>
                      <option value="IR">Iran, Islamic Republic of</option>
                      <option value="IQ">Iraq</option>
                      <option value="IE">Ireland</option>
                      <option value="IM">Isle of Man</option>
                      <option value="IL">Israel</option>
                      <option value="IT">Italy</option>
                      <option value="JM">Jamaica</option>
                      <option value="JP">Japan</option>
                      <option value="JE">Jersey</option>
                      <option value="JO">Jordan</option>
                      <option value="KZ">Kazakhstan</option>
                      <option value="KE">Kenya</option>
                      <option value="KI">Kiribati</option>
                      <option value="KP">Korea, Democratic People's Republic of</option>
                      <option value="KR">Korea, Republic of</option>
                      <option value="KW">Kuwait</option>
                      <option value="KG">Kyrgyzstan</option>
                      <option value="LA">Lao People's Democratic Republic</option>
                      <option value="LV">Latvia</option>
                      <option value="LB">Lebanon</option>
                      <option value="LS">Lesotho</option>
                      <option value="LR">Liberia</option>
                      <option value="LY">Libya</option>
                      <option value="LI">Liechtenstein</option>
                      <option value="LT">Lithuania</option>
                      <option value="LU">Luxembourg</option>
                      <option value="MO">Macao</option>
                      <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                      <option value="MG">Madagascar</option>
                      <option value="MW">Malawi</option>
                      <option value="MY">Malaysia</option>
                      <option value="MV">Maldives</option>
                      <option value="ML">Mali</option>
                      <option value="MT">Malta</option>
                      <option value="MH">Marshall Islands</option>
                      <option value="MQ">Martinique</option>
                      <option value="MR">Mauritania</option>
                      <option value="MU">Mauritius</option>
                      <option value="YT">Mayotte</option>
                      <option value="MX">Mexico</option>
                      <option value="FM">Micronesia, Federated States of</option>
                      <option value="MD">Moldova, Republic of</option>
                      <option value="MC">Monaco</option>
                      <option value="MN">Mongolia</option>
                      <option value="ME">Montenegro</option>
                      <option value="MS">Montserrat</option>
                      <option value="MA">Morocco</option>
                      <option value="MZ">Mozambique</option>
                      <option value="MM">Myanmar</option>
                      <option value="NA">Namibia</option>
                      <option value="NR">Nauru</option>
                      <option value="NP">Nepal</option>
                      <option value="NL">Netherlands</option>
                      <option value="NC">New Caledonia</option>
                      <option value="NZ">New Zealand</option>
                      <option value="NI">Nicaragua</option>
                      <option value="NE">Niger</option>
                      <option value="NG">Nigeria</option>
                      <option value="NU">Niue</option>
                      <option value="NF">Norfolk Island</option>
                      <option value="MP">Northern Mariana Islands</option>
                      <option value="NO">Norway</option>
                      <option value="OM">Oman</option>
                      <option value="PK">Pakistan</option>
                      <option value="PW">Palau</option>
                      <option value="PS">Palestinian Territory, Occupied</option>
                      <option value="PA">Panama</option>
                      <option value="PG">Papua New Guinea</option>
                      <option value="PY">Paraguay</option>
                      <option value="PE">Peru</option>
                      <option value="PH">Philippines</option>
                      <option value="PN">Pitcairn</option>
                      <option value="PL">Poland</option>
                      <option value="PT">Portugal</option>
                      <option value="PR">Puerto Rico</option>
                      <option value="QA">Qatar</option>
                      <option value="RE">Réunion</option>
                      <option value="RO">Romania</option>
                      <option value="RU">Russian Federation</option>
                      <option value="RW">Rwanda</option>
                      <option value="BL">Saint Barthélemy</option>
                      <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                      <option value="KN">Saint Kitts and Nevis</option>
                      <option value="LC">Saint Lucia</option>
                      <option value="MF">Saint Martin (French part)</option>
                      <option value="PM">Saint Pierre and Miquelon</option>
                      <option value="VC">Saint Vincent and the Grenadines</option>
                      <option value="WS">Samoa</option>
                      <option value="SM">San Marino</option>
                      <option value="ST">Sao Tome and Principe</option>
                      <option value="SA">Saudi Arabia</option>
                      <option value="SN">Senegal</option>
                      <option value="RS">Serbia</option>
                      <option value="SC">Seychelles</option>
                      <option value="SL">Sierra Leone</option>
                      <option value="SG">Singapore</option>
                      <option value="SX">Sint Maarten (Dutch part)</option>
                      <option value="SK">Slovakia</option>
                      <option value="SI">Slovenia</option>
                      <option value="SB">Solomon Islands</option>
                      <option value="SO">Somalia</option>
                      <option value="ZA">South Africa</option>
                      <option value="GS">South Georgia and the South Sandwich Islands</option>
                      <option value="SS">South Sudan</option>
                      <option value="ES">Spain</option>
                      <option value="LK">Sri Lanka</option>
                      <option value="SD">Sudan</option>
                      <option value="SR">Suriname</option>
                      <option value="SJ">Svalbard and Jan Mayen</option>
                      <option value="SZ">Swaziland</option>
                      <option value="SE">Sweden</option>
                      <option value="CH">Switzerland</option>
                      <option value="SY">Syrian Arab Republic</option>
                      <option value="TW">Taiwan, Province of China</option>
                      <option value="TJ">Tajikistan</option>
                      <option value="TZ">Tanzania, United Republic of</option>
                      <option value="TH">Thailand</option>
                      <option value="TL">Timor-Leste</option>
                      <option value="TG">Togo</option>
                      <option value="TK">Tokelau</option>
                      <option value="TO">Tonga</option>
                      <option value="TT">Trinidad and Tobago</option>
                      <option value="TN">Tunisia</option>
                      <option value="TR">Turkey</option>
                      <option value="TM">Turkmenistan</option>
                      <option value="TC">Turks and Caicos Islands</option>
                      <option value="TV">Tuvalu</option>
                      <option value="UG">Uganda</option>
                      <option value="UA">Ukraine</option>
                      <option value="AE">United Arab Emirates</option>
                      <option value="GB">United Kingdom</option>
                      <option value="US">United States</option>
                      <option value="UM">United States Minor Outlying Islands</option>
                      <option value="UY">Uruguay</option>
                      <option value="UZ">Uzbekistan</option>
                      <option value="VU">Vanuatu</option>
                      <option value="VE">Venezuela, Bolivarian Republic of</option>
                      <option value="VN">Viet Nam</option>
                      <option value="VG">Virgin Islands, British</option>
                      <option value="VI">Virgin Islands, U.S.</option>
                      <option value="WF">Wallis and Futuna</option>
                      <option value="EH">Western Sahara</option>
                      <option value="YE">Yemen</option>
                      <option value="ZM">Zambia</option>
                      <option value="ZW">Zimbabwe</option>
                    </select>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <select name="state" id="state" class="form-control" style="display:none;">
                      <option value="">Choose Area</option>
                      <?php
                        foreach ($omanareas->states as $area) {
                          echo '<option value="'.$area->area.'">'.$area->area.'</option>';
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-5">
                  <div class="form-group">
                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="">
                    <span class="form-text text-muted">Please enter latitude.</span>
                  </div>
                </div>
                <div class="col-xl-5">
                  <div class="form-group">
                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="">
                    <span class="form-text text-muted">Please enter longitude.</span>
                  </div>
                </div>
                <div class="col-xl-2">
                  <div class="form-group">
                    <button type="button" class="btn btn-brand btn-icon"><i class="fa fa-tag" onclick="getLocation()"></i></button>
                    <span class="form-text text-muted">Get current location.</span>
                  </div>
                </div>
                <div class="col-xl-6 kt-hidden">
                  <div class="form-group">
                    <input type="text" class="form-control" name="ipaddress" id="ipaddress" placeholder="Ip address" value="" readonly>
                    <span class="form-text text-muted">Your logged in Ipaddress.</span>
                  </div>
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-xl-6 kt-hidden">
                  <div class="form-group">
                    <input type="text" class="form-control" name="language" id="language" placeholder="language" value="english">
                    <span class="form-text text-muted">Please enter your Language.</span>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="form-group">
                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success kt-font-dark">
                      <input type="checkbox" id="default" name="default" > Default Address
                      <span></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning" id="btn_submit">Submit</button>
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
        <!--end::Form-->
      </div>
    </div>
  </div>
  </div>
  <!--end::Modal-->
  <!--begin::Modal-->
  <div class="modal fade" id="kt_modal_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cart of Seller</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body" id="cart_supplier">
        </div>
        <div class="modal-footer">
          <input type="hidden" name="sellerId" id="sellerId">
          <button type="button" class="btn btn-warning" id="invoice">Summary</button>
        </div>
      </div>
    </div>
    </div>
    <!--end::Modal-->
    <!--begin::Modal-->
    <div class="modal fade" id="kt_modal_cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
          </div>
          <div class="modal-body">
            <iframe src="<?php echo DIR_VIEW.DIR_CAR.'cart.php';?>" width="100%" height="550px"></iframe>
          </div>
        </div>
      </div>
    </div>
    <!--end::Modal-->
    <!--begin::Modal-->
    <div class="modal fade" id="kt_modal_cvv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Online Payment Authentication</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">CVV:</label>
                <input type="number" name="temp_cvv_number" id="temp_cvv_number" class="form-control" value="" placeholder="CVV"  onchange="document.getElementById('cvv_number').value=this.value;">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="submit_cvv">Continue</button>
          </div>
        </div>
      </div>
    </div>
    <!--end::Modal-->
  <?php
  if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
  else include(DIR_VIEW . DIR_CON . "guest-footer.php");
  ?>
  <!--begin::Page Scripts(used by this page) -->
  <script src="assets/js/pages/custom/wizard/wizard-3.js" type="text/javascript"></script>
  <script>
  $(document).ready(function(){
    disable_COD();
    var d = new Date();
    var n = d.getFullYear();
    var expyear = document.getElementById("expiry_year");
    var texpyear = document.getElementById("temp_expiry_year");
    expyear.setAttribute("min", n);
    texpyear.setAttribute("min", n);
  });
    $("#kt_wrapper").on('click','.address-delivery', function() {
      var selected_address = $(this).data("address");
      var selected_addressId = $(this).data("id");
      $('#hiddenaddress').val(selected_addressId);
      $.ajax({
        url: DIR_CONT + DIR_ADRS + "CON_addresses.php",
        type: "get", //send it through get method
        data: {
          action: "get",
          addressId: selected_addressId,
          userId: <?php echo $userId; ?>
        },
        success: function(response) {
          var useraddress = JSON.parse(response);
          $('#billing_address').val(useraddress['useraddress'][0].address1);
          $('#billing_zip').val(useraddress['useraddress'][0].postalcode);
          $('#billing_state').val(useraddress['useraddress'][0].state);
          $('#billing_city').val(useraddress['useraddress'][0].city);
          $('#billing_country').val(useraddress['useraddress'][0].country);

        },
        error: function(xhr) {
          console.log("err");
        }
      });
      $("#custom-next-step").click();
    });
    $("#kt_wrapper").on('click','.creditcards', function() {
      var selected_creditcardId = $(this).data("id");
      $('#hiddencreditcardId').val(selected_creditcardId);
      $.ajax({
        url: DIR_CONT + DIR_WLT + "CON_Wallets.php?action=get_creditcard",
        type: "get", //send it through get method
        data: {
          action: "get",
          creditcardId: selected_creditcardId,
          userId: <?php echo $userId; ?>
        },
        success: function(response) {
          var usercard = JSON.parse(response);
          var payment_option = "OPTCRDC";
          if (usercard.card_type==1) {
            payment_option = "OPTCRDC";
          }else if (usercard.card_type==2) {
            payment_option = "OPTDBCRD";
          }else {
            payment_option = "OPTCRDC";
          }
          $('#payment_option').val(payment_option);
          $('#card_number').val(usercard.card_number);
          $('#card_name').val(usercard.card_name);
          $('#expiry_month').val(usercard.card_expirymonth);
          $('#expiry_year').val(usercard.card_expiryyear);
          $('#billing_name').val(usercard.card_holdername);
          $('#kt_modal_cvv').modal('show');
        },
        error: function(xhr) {
          console.log("err");
        }
      });
    });
  </script>
  <script>
  /*payment*/
  window.onload = function() {
    var d = new Date().getTime();
    document.getElementById("tid").value = d;
  };
  function payonline() {
    $('#payform').submit();
    // $.ajax({
    //   url: "https://forwardbazar.com/CUSTOM_CHECKOUT_FORM_KIT_PHP/CUSTOM_CHECKOUT_FORM_KIT/ccavRequestHandler.php",
    //   type: "post",
    //   data: {
    //     tid: $('#tid').val(),
    //     merchant_id: $('#merchant_id').val(),
    //     redirect_url: $('#redirect_url').val(),
    //     cancel_url: $('#cancel_url').val(),
    //     amount: $('#amount').val(),
    //     currency: $('#currency').val(),
    //     language: $('#language').val(),
    //     payment_option: $('#payment_option').val(),
    //     card_type: $('#card_type').val(),
    //     card_name: $('#card_name').val(),
    //     data_accept: $('#data_accept').val(),
    //     card_number: $('#card_number').val(),
    //     expiry_month: $('#expiry_month').val(),
    //     expiry_year: $('#expiry_year').val(),
    //     cvv_number: $('#cvv_number').val(),
    //     issuing_bank: $('#issuing_bank').val(),
    //   },
    //   success: function(response) {
    //     console.log("done");
    //   },
    //   error: function(xhr) {
    //     console.log("err");
    //   }
    // });
  }
  /*payment*/
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }
    function showPosition(position) {
      document.getElementById('latitude').value = position.coords.latitude;
      document.getElementById('longitude').value = position.coords.longitude;
    }
    $('#btn_submit').click(function(e) {
      e.preventDefault();
      var btn = $(this);
      var form = $(this).closest('form');
      var formdata1 = new FormData($('#jbform')[0]);
      form.validate({
        rules: {
          address1: {
            required: true
          },
          postalcode: {
            required: true
          },
          city: {
            required: true,
          },
          country: {
            required: true,
          },
          fullname: {
            required: true,
          },
          email: {
            required: true,
          }
        }
      });

      if (!form.valid()) {
        return;
      }
      btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
      $.ajax({
        type: "POST",
        url: DIR_CONT + DIR_USR + "CON_seller_profile.php?action=post-address-checkout",
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
    function editaddress(addressId) {
      $('#addressId').val(addressId);
      $.ajax({
        url: DIR_CONT + DIR_ADRS + "CON_addresses.php",
        type: "get", //send it through get method
        data: {
          action: "get",
          addressId: addressId,
          userId: <?php echo $userId; ?>
        },
        success: function(response) {
          var useraddress = JSON.parse(response);
          $('#addressId').val(useraddress['useraddress'][0].addressId);
          $('#addresstitle').val(useraddress['useraddress'][0].addresstitle);
          $('#address_type').val(useraddress['useraddress'][0].address_type);
          $('#address1').val(useraddress['useraddress'][0].address1);
          $('#address2').val(useraddress['useraddress'][0].address2);
          $('#postalcode').val(useraddress['useraddress'][0].postalcode);
          $('#state').val(useraddress['useraddress'][0].state);
          $('#city').val(useraddress['useraddress'][0].city);
          $('#country').val(useraddress['useraddress'][0].country);
          $('#latitude').val(useraddress['useraddress'][0].latitude);
          $('#longitude').val(useraddress['useraddress'][0].longitude);
          $('#ipaddress').val(useraddress['useraddress'][0].ipaddress);
          $('#language').val(useraddress['useraddress'][0].language);
          if ($("#country").val()=="OM") {
            $("#state").show();
          }else{
            $("#state").val("");
            $("#state").hide();
          }
        },
        error: function(xhr) {
          console.log("err");
        }
      });
    }
    function deleteaddress(addressId) {
      location.href = DIR_CONT + DIR_ADRS + "CON_addresses.php?action=delete-checkout&addressId=" + addressId + "&userId=" + <?php echo $userId; ?>;
    }
    function addaddress() {
      document.getElementById("jbform").reset();
    }
    function addcard() {
      document.getElementById("jbform-cc").reset();
    }
    function setWalletId(id) {
      $('#hiddenpayment').val(id);
      $('#hiddencreditcardId').val('');
      $('#hiddenwalletId').val('');
      switch (id) {
        case 1:
          //$('#jbmethod').trigger('change');
          break;
        case 2:
          $('#order_otherfees').text("AED 0");
          $('#order_otherfees_value').val(0);
          break;
        case 3:
          $('#order_otherfees').text("AED 0");
          $('#order_otherfees_value').val(0);
          break;
        case 4:
          $('#order_otherfees').text("AED 0");
          $('#order_otherfees_value').val(0);
          break;
        default:
          $('#order_otherfees').text("AED 0");
          $('#order_otherfees_value').val(0);
      }
    }
    function submitcard(id, ccid) {
      $("#custom-next-step").click();
      $('#hiddenwalletId').val(id);
      $('#hiddencreditcardId').val(ccid);
    }
    function editcard(ccid,wid) {
      $('#creditcardId').val(ccid);
      $('#ccwalletId').val(wid);
      $.ajax({
        url: DIR_CONT + DIR_WLT + "CON_Wallets.php?action=get_creditcard",
        type: "get", //send it through get method
        data: {
          action: "get",
          creditcardId: ccid,
          userId: <?php echo $userId; ?>
        },
        success: function(response) {
          var usercard = JSON.parse(response);
          $('#temp_walletId').val(usercard.walletId);
          $('#temp_payment_option').val(usercard.card_type);
          $('#temp_card_number').val(usercard.card_number);
          $('#temp_card_name').val(usercard.card_name);
          $('#temp_card_holdername').val(usercard.card_holdername);
          $('#temp_expiry_month').val(usercard.card_expirymonth);
          $('#temp_expiry_year').val(usercard.card_expiryyear);
        },
        error: function(xhr) {
          console.log("err");
        }
      });
    }
    $('#btn_submit-cc').click(function(e) {
      e.preventDefault();
      var btn = $(this);
      var form = $(this).closest('form');
      var formdata1 = new FormData($('#jbform-cc')[0]);
      btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
      $.ajax({
        type: "POST",
        url: DIR_CONT + DIR_WLT + "CON_Wallets.php?action=post-cc&userId=<?php echo $userId ?>",
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
                // Simulate an HTTP redirect:
                 window.location.reload();
              }, 2000);
              break;
            case 1:
            console.log("111");
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
    function updateQty(qty, pid ,r1, r2, p1, p2) {
        $('#pid').val(pid);
        var range1 = parseInt(r1);
        var range2 = parseInt(r2);
        var price1 = parseInt(p1);
        var price2 = parseInt(p2);
        var quantity =qty.value;
        if (quantity >= range1 && quantity < range2) {
          $('#pp').val(price1);
        } else if (quantity >= range2) {
          $('#pp').val(price2);
        }
        if (quantity>=range1) {
          $('#pqty').val(qty.value);
          $.ajax({
            type: "POST",
            url: DIR_CONT+DIR_CAR+"cart-update.php?userId=<?php echo $userId?>",
            data: {
              'pid' : pid,
              'pp' : $('#pp').val(),
              'pqty' : qty.value,
            },
            success: function(data) {
              location.reload();
            }
          });
        }
    }
    function updateshipmenttype(userId,type) {
      $.ajax({
        url: DIR_CONT + DIR_CAR + "CON_carts.php?action=update-product-shipment",
        type: "post", //send it through get method
        data: {
          userId: userId,
          shipment_type: type,
        },
        success: function(response) {
          console.log("succ");
        },
        error: function(xhr) {
          console.log("err");
        }
      });
    }
    function updatepaymenttype(userId,type) {
      $.ajax({
        url: DIR_CONT + DIR_CAR + "CON_carts.php?action=update-product-payment",
        type: "post", //send it through get method
        data: {
          userId: userId,
          payment_type: type,
        },
        success: function(response) {
          console.log("succ");
        },
        error: function(xhr) {
          console.log("err");
        }
      });
    }
    function getrate(useraddressId) {
      var div_id = "#order_shipmentfees";
      $.ajax({
        url: DIR_CONT + DIR_ORD + "CON_Orders.php",
        type: "get", //send it through get method
        data: {
          action: "get-rate",
          useraddressId: useraddressId
        },
        success: function(response) {
          var shippingrate = JSON.parse(response);
          switch (shippingrate['err']) {
            case 0:
              //$(div_id).html("AED "+shippingrate['rate']);
              //$('#order_shipmentfees_value').val(shippingrate['rate']);
              /*free shipment*/
              $(div_id).html("AED 0");
              $('#order_shipmentfees_value').val(0);
              /*free shipment*/
              $("#jb_shipment_method").text("Door to door.");
              $("#domestic_portlet").show();
              $("#international_portlet").hide();
              updateshipmenttype(<?php echo $userId;?>,1);
              break;
            case 1:
              $(div_id).html("Shipment is not included!");
              $('#order_shipmentfees_value').val(0);
              $("#int_shipment_method").text("Payment & Shipment is not included in our service now, please coordinate with seller.");
              $("#int_shipment_reason").text("Reason: We support shipments inside UAE and to OMAN only.");
              $("#international_portlet").show();
              $("#domestic_portlet").hide();
              updateshipmenttype(<?php echo $userId;?>,4);
              updatepaymenttype(<?php echo $userId; ?>,4);
              break;
            case 2:
              $(div_id).html("Shipment is not included!");
              $('#order_shipmentfees_value').val(0);
              $("#int_shipment_method").text("Payment & Shipment is not included in our service now, please coordinate with seller.");
              $("#int_shipment_reason").text("Reason: We support shipments until 30 KG of weight.");
              $("#international_portlet").show();
              $("#domestic_portlet").hide();
              updateshipmenttype(<?php echo $userId;?>,4);
              updatepaymenttype(<?php echo $userId; ?>,4);
              break;
            default:
            $(div_id).html("Shipment is not included!");
            $('#order_shipmentfees_value').val(0);
            $("#jb_shipment_method").text("Payment & Shipment is not included in our service now, please coordinate with seller.");
            $("#international_portlet").show();
            $("#domestic_portlet").hide();
            updateshipmenttype(<?php echo $userId;?>,4);
            updatepaymenttype(<?php echo $userId; ?>,4);
          }
          totalpay();
          // if(shippingrate['buyer_country']!="AE"){
          //   $('#jbmethod option[value="5"]').remove();
          // }else if(!$("#jbmethod option[value='5']").length > 0){
          //   $("#jbmethod").append('<option value="5" data-fees="0">Cash On Pickup</option>');
          // }
        },
        error: function(xhr) {
          console.log("err");
        }
      });
    }
    function showdetails(sellerId) {
      $.ajax({
        url: DIR_CONT + DIR_CAR + "CON_carts.php",
        type: "get", //send it through get method
        data: {
          action: "get-usercart-seller",
          sellerId: sellerId,
          userId: <?php echo $userId; ?>
        },
        success: function(response) {
          $('#cart_supplier').html(response);
          $('#sellerId').val(sellerId);
        },
        error: function(xhr) {
          console.log("err");
        }
      });
    }
    $("#invoice").click(function(){
      var sellerId= $('#sellerId').val();
      window.open(DIR_VIEW+DIR_ORD+"seller-proformainvoice.php?sellerId="+sellerId);
    });
    $("#jbmethod").change(function(){

      var pay_method = $('#jbmethod').val();
      var count_suppliers = <?php echo $count_suppliers;?>;
      updatepaymenttype(<?php echo $userId; ?>,pay_method);
      var total = $('#hiddentotal').val();
      // var otherfees = $(this).find(':selected').data('fees')*total;
      var otherfees = 0;
      // if (pay_method==1){
      //   var codfees = 2*count_suppliers;
      //   otherfees=otherfees+codfees;
      // }
      if (pay_method==5){
        updateshipmenttype(<?php echo $userId; ?>,3);
        $("#jb_shipment_method").text("Buyer Pickup.");
        $("#order_shipmentfees").text("AED 0");
        $("#order_shipmentfees_value").val(0);
      }else {
        getrate($('#hiddenaddress').val());
      }
      if (pay_method==3) {
        $("#jb-bank").show();
      }else {
        $("#jb-bank").hide();
      }
      if (pay_method==2) {
        $("#onlinepayment").show();
        $("#note_onlinepayment").show();
      }else {
        $("#onlinepayment").hide();
        $("#note_onlinepayment").hide();
      }
      $('#order_otherfees').text("AED "+otherfees.toFixed(2));
      $('#order_otherfees_value').val(otherfees.toFixed(2));
      $('#paymentfees').val($(this).find(':selected').data('fees'));
      totalpay();
    });
    function disable_COD(){
      var total = $('#hiddentotal').val();
      if(total>3000){
        $('#jbmethod option[value="1"]').remove();
        $('#jbmethod').val(2);
      }
    }
    function totalpay() {
      var total = $('#hiddentotal').val();
      //var shipment = $('#order_shipmentfees_value').val();
      /*free shipment*/
      var shipment = 0;
      /*free shipment*/
      var otherfees = $('#order_otherfees_value').val();
      var total_pay = parseFloat(total)+parseFloat(shipment)+parseFloat(otherfees);
      //var total_vat = total_pay*0.05;
      var total_vat = 0.00;
      var total_pay_vat = total_pay+total_vat;
      $('#order_total_pay_value').val(total_pay_vat.toFixed(2));
      $('#amount').val(total_pay_vat.toFixed(2));
      $('#order_total_pay').text("AED "+total_pay_vat.toFixed(2));
      $('#order_total_price_vat').text("AED "+total_vat.toFixed(2));
    }
    function ispickable(){
      $.ajax({
        url: DIR_CONT + DIR_CAR + "CON_carts.php",
        type: "get", //send it through get method
        data: {
          action: "get-pickable",
          userId: <?php echo $userId; ?>
        },
        success: function(response) {
          if(response==1) $('#jbmethod option[value="5"]').remove();
        },
        error: function(xhr) {
          console.log("err");
        }
      });
    }
    $("#country").change(function(){
      if(this.value=="OM") $("#state").show();
      else{
        $("#state").hide();
        $("#state").val("");
      }
    });
    $("#temp_payment_option").change(function(){
      if ($("#temp_payment_option").val()==1) {
        $("#payment_option").val("OPTCRDC");
      }
      if ($("#temp_payment_option").val()==2) {
        $("#payment_option").val("OPTDBCRD");
      }
    });
    $("#temp_card_name").change(function(){
      var card_name = $("#temp_card_name").val();
        $("#card_name").val(card_name);
    });
    $("#submit_cvv").click(function(){
      $("#custom-next-step").click();
      $('#kt_modal_cvv').modal('hide');
    });
  </script>
