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
            <h2 class="kt-infobox__title kt-font-lg">Sellers' Guide for Returns and Refunds, Repairs and Replacements</h2>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Returns</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Products can be returned within seven (7) days from when buyers received the order, provided they satisfy the eligibility requirements for returns as per our <a href="<?php echo DIR_VIEW.DIR_CON;?>Returns.php" class="kt-link">Return and Refund Policy</a> and subject to the seller’s approval.
                <br>NOTE: If the buyer or seller is located outside the UAE, JomlahBazar’s policies will not apply since all contractual terms and agreement, including payment, shipping, and return and refunds, will be based on the buyer and seller’s agreement.
                <br>The following is an overview of how the return and refund process works:
                <p class="text-center"><img src="<?php echo DIR_MED.DIR_CON;?>sellerguide1.jpg" alt="" width="50%"></p>
                If the buyer contacts JomlahBazar or initiates a request online, the reason for the return must be provided. This request will then be forwarded to the seller. Once the request has been approved, an email notification will be sent to both buyer and seller.
                <br>Once the request has been approved, the seller will then be responsible for arranging the product's pick-up from the buyer’s and location and delivery back to their warehouse or address. Note, sellers will shoulder all the expenses of pick-up and delivery in relation to returns, repairs, and replacements.
                <br>Once the item has been returned to the relevant seller, we will process the refund, which can be expected within seven to fourteen (7 – 14) business days. It should also be noted that sometimes sellers can permit or allow buyers to keep the product.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Repairs and Replacements</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                If a buyer receives a defective product or the wrong item, buyers can go through the same process by raising a request through their Account or contacting our Customer Care. Note that repairs and replacements depend on the product’s category and whether a warranty is available.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Cancellation</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                If a buyer wants to cancel an order before shipment, they can do so by going through their orders in their account. Once the order's status has changed, an email notification will be sent to the buyer and seller.
                <br>NOTE: If a buyer still wants to cancel an order that has already been shipped, they will be advised to request a return either through their account or contacting JomlahBazar.
                <p class="text-center"><img src="<?php echo DIR_MED.DIR_CON;?>sellerguide2.jpg" alt="" width="50%"></p>
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">COVID-19</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Due to COVID-19, we will require sellers to follow the necessary protocols, regulations, and guidelines since we highly prioritize the health and safety of your staff, our customers, and our staff and affiliates.
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
