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
            <h2 class="kt-infobox__title kt-font-lg">Seller’s Guide to Shipping and Delivery</h2>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Method of Delivery</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Once a buyer has purchased your product, you will have the choice of how you would want your delivery to be handled. You can either choose to handle the delivery yourself or use JomlahBazar’s Delivery Service.
                <br>NOTE: JomlahBazar’s Delivery Service is not available for international deliveries. Thus, if either the buyer or seller is located outside of the UAE, all deliveries will depend on the agreement between the buyer and the seller.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Own Delivery</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                In choosing to handle your own delivery, you must ensure the following:
                <br>(a)	the promptness of delivery;
                <br>(b)	the condition of the products, insurances, warranties, and any fines or violations;
                <br>(c)	updating JomlahBazar through Our Platforms once shipment has been delivered for Cash-on-Delivery and Cash-on-Pickup orders;
                <br>(d) remitting the Buyer’s payments of JomlahBazar fees for Cash-on-Delivery orders; and
                <br>(e) returns, repairs, and replacements, including the pick-up, shipment, and delivery.

              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">JomlahBazar’s Delivery Service</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                If you choose to make use of JomlahBazar’s Delivery Services wherein we schedule pick-ups and deliveries for you, you must note that:
                <br>(a)	Buyer will shoulder the shipping charges;
                <br>(b)	Your packages will abide by the relevant shipping or courier's rules on packaging, marking, labelling, and any necessary declarations;
                <br>(c)	You will still be liable for the products' conditions, insurances, warranties, and any fines or violations relating to Your shipments;
                <br>(d)	You will indemnify or reimburse Us if We suffer any loss or fines from Your shipments or packages; and
                <br>(e)	You will shoulder the shipping, pick-up, and delivery charges concerning Your product returns, repairs, and replacements.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Tracking Your Shipment</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                If you had your shipment delivered through JomlahBazar, we will provide you with the Tracking Number which you can use to track your shipment by entering it on our Third-Party Shipping Provider’s website (https://emiratespost.ae/Portal/Home?locale=en-us).
                <br>If you choose to ship and deliver your shipments on your own, you must consider whether you and your buyer can track the shipment. It is highly suggested that you ensure to provide tracking. If you do, you can provide the tracking number to buyers who will contact you. Otherwise, you can simply provide buyers with updates.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">COVID-19</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Due to COVID-19, we require sellers to follow the necessary protocols, regulations, and guidelines since we highly prioritize the health and safety of your staff, our customers, and our staff and affiliates.
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
