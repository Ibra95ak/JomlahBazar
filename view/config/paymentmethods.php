<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if (isset($_SESSION['userId'])) {
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
} else {
    include("../".DIR_CON."guestheader.php");
}/*Get page header*/
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--begin::Portlet-->
    <div class="kt-portlet__body">
        <div class="kt-infobox">
          <div class="text-center">
            <img src="assets/media/logos/jomlabazar.png" class="top-logo" alt="jomlabazar logo">
          </div>
          <div class="kt-infobox__header">
            <h2 class="kt-infobox__title kt-font-lg">Payment Methods</h2>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                In JomlahBazar, we want to offer as many choices as we can for our customers. You can choose to either pay through JomlahBazar or directly to the Seller. For payments through JomlahBazar, additional charges may apply depending on the payment method you select.
                <br>•	Paying through JomlahBazar
                <br>-	Credit/Debit Card (only available for UAE and GCC cards)
                <br>-	Bank Transfer
                <br>-	Cash-on-Delivery (COD) (only available in the UAE)
                <br>-	Cash-on-Pickup (COP) (only available in the UAE and will depend on Seller)
                <br>-	JB Wallet
                <br>•	Paying Seller directly
                <br>-	Will depend on the buyer and seller’s agreement
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Credit and Debit Cards</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                When you pay with a credit or debit card, it is always required for you to enter your credit or debit card details, including your Card Verification Value (CVV). We accept both credit and debit cards from Visa and MasterCard.
                <br>Note that you will be charged immediately as soon as you place your order. This charge will always be the full order amount regardless of whether the products are sold by different sellers and split into separate shipments plus any additional charges.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Bank Transfer</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                <b>If you use bank transfer</b>, you shall pay to Pomechain DMCC (also known as JomlahBazar), whose bank account details will be provided. For the order to go through, buyers must upload the bank transfer receipt on JomlahBazar within a given time. If you have uploaded the wrong bank receipt, you will be given another chance to upload the correct document within a given time. The buyer should receive a confirmation email once JomlahBazar has verified your bank details and the seller has accepted the order.
                <br><b>Note</b>, that we may cancel your order after you made severable failed attempts of uploading the bank receipt.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Cash-on-Delivery (COD)</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                JomlahBazar also accepts COD payments. Note, this payment mode is only available for orders under 3000 AED and only within the UAE.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">JB Wallet</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                JomlahBazar also accepts any payments made via your JB Wallet, an electronic wallet connected to your account, which receives credit we have refunded you.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Cash-on-Pickup (COP)</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Along with COD, JomlahBazar also offers Cash-on-Pickup where a buyer can choose to pay upon picking up the product from the seller’s location. Note, the availability of this payment mode depends on the seller’s preferences.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Paying the Seller directly</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                If you choose to pay the seller directly, the payment method will depend on your agreement with the seller. Regardless of what payment method was agreed on, a proof of payment must still be uploaded by the buyer on JomlahBazar.
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end::Portlet-->
  </div>
  <?php
  if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
  else include(DIR_VIEW . DIR_CON . "guest-footer.php");
  ?>
