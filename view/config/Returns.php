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
            <h2 class="kt-infobox__title kt-font-lg">JomlahBazar Return and Refund Policy</h2>
          </div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Products can be returned <b>within seven (7) days</b> from when you received the order, provided they satisfy the eligibility requirements for returns as per our Policy and acquires seller approval. Once successfully granted, the refund shall be processed <b>within seven to fourteen (7 – 14) days.</b><br>
                <b>NOTE:</b> JomlahBazar’s Return and Refund Policy only applies if <b>both buyers and sellers are located inside the UAE</b>. Return and refunds will be subject to the buyer and seller’s own contractual terms and agreement if <b>either the buyer or seller is located outside the UAE</b>.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Refundable Products</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Refunds will depend on the type of product and the reason for the return. If you received a damaged product, the wrong product, or a product that is different from its description or picture, it would be refundable if it:
                <ul>
                  <li>Is new and unused;</li>
                  <li>Is in its original untouched packaging;</li>
                  <li>Includes all tags or factory seals (if any);</li>
                  <li>Has not been resized, damaged, or altered by buyer; and</li>
                  <li>Is returned with all original documentation (if any) (e.g., certificate of authenticity).</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Non-Refundable Products</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                The following is a list of non-refundable products:
                <ul>
                  <li>Used products;</li>
                  <li>Products not in their original condition;</li>
                  <li>Products with altered or misplaced serial numbers;</li>
                  <li>Products without their original documentation;</li>
                  <li>Products identified as hazardous or flammable; and</li>
                  <li>Products belonging to JomlahBazar categories such as <b>grocery, beauty and makeup, and personal care.</b></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Refund</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Damaged, defective, or incorrect item
                <br><b>If your purchase is damaged or if you received the wrong product or a product different to its description or image</b>, you can request to return the item through your Account on JomlahBazar or by contacting our Customer Care. If your request were granted, <b>you would be refunded the full product amount, excluding shipping charges.</b>
                <br>You can also request for repairs and replacements through your Account or by contacting our Customer Care. Note that repairs and replacements may depend on the product category and the availability of a warranty.
                <br>Cancelled Order
                <br>To cancel orders, you must do so <b>before</b> shipping. If the order has been shipped already, you will have to wait for the delivery and request a refund. You shall be refunded the full product amount, <b>excluding shipping charges.</b>
                <br>Summary
                <table class="table table-bordered">
                  <tr>
                    <th>Reason for return</th>
                    <th>Resolution</th>
                    <th>How</th>
                  </tr>
                  <tr>
                    <td class="kt-font-bolder" rowspan="3">Product is damaged/defective</td>
                    <td>Refund excluding shipping</td>
                    <td rowspan="3">
                      (a)	Contact JomlahBazar/ Initiate request on JomlahBazar
                    </td>
                  </tr>
                  <tr>
                    <td>Repair</td>
                  </tr>
                  <tr>
                    <td>Replacement</td>
                  </tr>
                  <tr>
                    <td class="kt-font-bolder" rowspan="2">Received wrong/different product</td>
                    <td>Full refund</td>
                    <td  rowspan="2">
                      (a)	Contact JomlahBazar/ Initiate request on JomlahBazar
                    </td>
                  </tr>
                  <tr>
                    <td>Replacement</td>
                  </tr>
                  <tr>
                    <td class="kt-font-bolder">Cancelled Order</td>
                    <td>Full refund</td>
                    <td>(a)	Cancel order <b>before</b> shipment</td>
                  </tr>
                </table>
                <br><b>NOTE:</b> Sellers may permit or allow buyers to keep the product.
                <br><b>Refunds will be processed within seven to fourteen (7 – 14) business days</b> and will be put into your JB wallet as credit. If you want the refund to be processed back to your credit/debit card or account, you can contact JomlahBazar’s Customer Care to initiate a request.
                <br>COVID-19
                <br>In picking-up returns and delivering orders, repairs, and replacements, we assure you that all our affiliates follow the necessary protocols, regulations, and guidelines since we highly prioritize the health and safety of our customers, staff, and affiliates.
                <br><b>For sellers</b>, please read our Seller’s <a class="kt-link" href="<?php echo DIR_VIEW.DIR_CON;?>guidesellerreturns.php">Guide to Returns and Refunds</a>.
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
