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
            <h2 class="kt-infobox__title kt-font-lg">Shipping and Delivery</h2>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Delivery or Shipment of Order</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                The cost of delivery and the estimated date of delivery will be displayed to you on checkout. Know that JomlahBazar works hard alongside couriers and shipping companies to provide you with the best delivery experience.
                <br>JomlahBazar may ask for any form of identification card to verify your identity. <b>If we fail to verify your identity, we have the right to cancel your order.</b>
                <br><b>NOTE:</b> If both the buyer and seller are located <b>inside</b> the UAE, sellers may choose to deliver their own products or make use of JomlahBazar’s Delivery Services. If the buyer or seller is located <b>outside</b> of the UAE, all deliveries will depend on the agreement between the buyer and the seller.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Calculation of Delivery Costs</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                The total delivery cost includes the fees per delivery plus fees per item/kg. Per item means the quantity of each product, whereas per kg is the whole package's actual weight or volume.
                <br>NOTE: If you purchase products from different sellers, you will be charged separate delivery fees since they will be coming from different locations.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Estimated Delivery Time</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                For JomlahBazar deliveries, the estimated delivery time for your package will be one to three (1 – 3) days. Furthermore, you can track your shipment by using the Tracking Number provided once your order has been confirmed and entering it on our Third-Party Shipping Provider’s website (https://emiratespost.ae/Portal/Home?locale=en-us).
                <br>For deliveries handled specifically by sellers, estimated delivery time cannot be guaranteed as it will depend on the seller, and their performance can vary. If you want to track your delivery, you can contact the seller directly who may either provide you with a tracking number and the specific courier company or simply provide you with updates.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Delivery Delays</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                If there are any delays with JomlahBazar deliveries, you can contact us through our provided contact details or contact our Third-Party Shipping Provider directly (https://emiratespost.ae/Portal/Info?locale=en-us&pageid=117).
                <br>As for deliveries handled by the seller, you can directly contact the seller whose contact details are provided on our platforms.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Shipping Addresses</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                The following information must be provided accurately and adequately.
                <ul>
                  <li>Full name</li>
                  <li>Contact number: avoid using spaces or dashes.</li>
                  <li>Refused by recipient: if you reject the package.</li>
                  <li>Building/villa name or number, floor, apartment</li>
                  <li>City and Area</li>
                  <li>Nearest landmark: this can be a mall, hotel, etc.</li>
                </ul>
                <br>NOTE: Avoid using non-English characters and entering shipping and delivery instructions in any of the fields provided for your contact and address details.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Returned Shipments</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Packages may sometimes be returned to us for the following reasons:
                <ul>
                  <li>	Wrong or incomplete address: if the address is not accurate or updated.</li>
                  <li>Failed delivery attempts: if you could not accept the delivery for all attempts.</li>
                  <li>Street address: consider searching your address online to have an idea of the street you are located in.</li>
                  <li>Damaged in transit: if the package/address label was damaged while it was out for shipping.</li>
                </ul>
                <br>NOTE: If after several attempts of delivering a package has failed, the package will be returned to us and we will cancel the order and issue a refund.
                <br>For Sellers, please read our <a href="<?php echo DIR_VIEW.DIR_CON;?>sellerguidedelivery.php" class="kt-link">Seller’s Guide to Shipping and Delivery</a>.
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
