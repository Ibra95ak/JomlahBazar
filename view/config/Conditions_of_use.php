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
            <h2 class="kt-infobox__title kt-font-lg">Terms and Conditions</h2>
          </div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Welcome to JomlahBazar.com! The following are the Terms and Conditions that will bind You and Your access to JomlahBazar.com, operated by Pomechain DMCC, a free zone company registered in Dubai Multi Commodities Centre with the license number DMCC-768610, located at Office 2903, Building BB1, Mazaya Business Avenue, Jumeirah Lakes Towers, DMCC, Dubai, United Arab Emirates (“<b>JomlahBazar</b>, "<b>Us</b>," “<b>Our</b>,” or "<b>We</b>").<br>
                By accepting this Agreement, You agree that this Agreement, Our <a class="kt-link" href="<?php echo DIR_VIEW.DIR_CON;?>privacypolicy.php">Privacy Policy</a>, and the JomlahBazar policies and guides posted on Our Platforms will bind You with <b>immediate effect</b>. If You disagree with the following Terms and Conditions, You will have to stop using or accessing JomlahBazar's Platforms.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">1 Definitions </h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                1.1 The following are the terminologies used within this Agreement with specific meanings:
                <br>(a)	"<b>Account</b>" refers to Your Account, which can either be Your Seller’s or Buyer’s Account.
                <br>(b)	“<b>Affiliates</b>” refers to Pomechain DMCC, it’s owners, directors, employees, sub-contractors, and marketing affiliates.
                <br>(c)	"<b>Agreement</b>" or "<b>Terms and Conditions</b>" refers to the following terms and conditions relating to Your obligations and use of JomlahBazar's Platforms.
                <br>(d)	“<b>User</b>,” “<b>You</b>,” or “<b>Your</b>” refers to individuals, companies, or legal entities using our JomlahBazar Platforms, who can either be buyers or sellers.
                <br>(e)	"<b>Content</b>" refers to any material You submit, post, or display on JomlahBazar Platforms, including, but not limited to, company or personal information, product descriptions, comments, reviews, and communications.
                <br>(f)	"<b>JomlahBazar Delivery Service</b>" refers to the delivery service offered by JomlahBazar, where We pick-up and deliver a seller’s shipments to buyers by using Our Third-party Service Provider.
                <br>(g)	"<b>Platforms</b>" refers to JomlahBazar.com and Our mobile application and other tools or databases provided by JomlahBazar.
                <br>(h)	"<b>Privacy Policy</b>" refers to the collection and use of Your information within Our Platforms and can be specifically found <a class="kt-link" href="<?php echo DIR_VIEW.DIR_CON;?>privacypolicy.php">here</a>.
                <br>(i)	“<b>Seller’s Agreement</b>” refers to the signed agreement between JomlahBazar and each seller which specifies the seller’s obligations in selling products on Our Platforms.
                <br>(j)	“<b>Third-Party Service Providers</b>” refers to JomlahBazar’s third-party shipping and delivery service provider.
                <br>Capitalized terms will follow the meanings given to them as per Clause 1.1.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">2 Registration and Eligibility </h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                2.1 You guarantee and agree that:
                <br><b>For individuals:</b>
                <br>(a)	You have full power and authority to enter into this Agreement;
                <br>(b)	You are of legal age in Your country of residence to purchase products;
                <br>(c)	You have an address for the delivery of products;
                <br>(d)	You can provide the necessary bank details for payment; and
                <br>(e)	You will comply with the following Terms and Conditions, Our policies, and all applicable laws and regulations.
                <br><b>For businesses, legal entities, and companies:</b>
                <br>(a)	You have full power and authority to enter into this Agreement;
                <br>(b)	You are legally registered in Your jurisdiction;
                <br>(c)	You have the proper rights to trade within Our Platforms;
                <br>(d)	You have an address for the delivery of products;
                <br>(e)	You are not subject to any trade restrictions or sanctions of any country, international organization, or jurisdiction; and
                <br>(f)	You will comply with the following Terms and Conditions, Our policies, the Seller’s Agreement (for sellers), and all applicable laws and regulations.
                <br>2.2 You agree that the following requirements and documentation will be requested from You to register on Our Platforms and use Our services:
                <br><b>For individuals:</b>
                <br>(a)	Full name;
                <br>(b)	Email address; and
                <br>(c)	Phone number.
                <br><b>For manufacturers, suppliers, and companies:</b>
                <br>(a)	Trade license;
                <br>(b)	any document proving the purchase of products, such as invoices, distribution authorization letter, permit or certificate from the manufacturer;
                <br>(c)	Emirates ID or Passport Copy of <b>Owner</b>, <b>manager</b>, or <b>individual registering on your company's behalf</b>;
                <br>(d)	VAT registration certificate; and
                <br>(e)	bank details in a signed and stamped company letterhead such as:
                <ul>
                  <li>Company's legal name;</li>
                  <li>Bank account number;</li>
                  <li>IBAN;</li>
                  <li>Swift code; and</li>
                  <li>Bank branch.</li>
                </ul>
                2.3 If You do not fit the criteria or fail to provide such information stated in Clauses <b>2.1 and 2.2</b>, JomlahBazar reserves the right to reject Your registration.
                <br>2.4 After successfully registering, You will be bound by this Agreement and any other policies as posted on Our Platforms and shall continue to be so for an indefinite period until Your Account has been suspended or terminated.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">3 JomlahBazar Services</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                3.1 Our services to You include providing:
                <br>(a)	a <b>Platform</b> where You can buy or sell wholesale products;
                <br>(b)	an <b>Account</b> where You can display and modify Your personal or company information; and
                <br>(c)	<b>Payment gateway</b> and <b>shipping and delivery services</b> as provided by Our third-party service providers.

                <br>3.2 You agree that JomlahBazar has the right to upgrade, limit, or suspend their Platforms or any other related functionalities or applications at any time, either temporarily or permanently, without any notice and shall not be liable to You for doing so.
                <br>3.3 We are also obligated to suspend or terminate any Account liable for violating or suspected of violating any of the Terms and Conditions stated in this Agreement and JomlahBazar’s policies.
                <br>3.4 <b>JomlahBazar provides Our services on an "as is" basis.</b> We try Our best to ensure We provide top quality services. However, despite Our efforts, We cannot fully guarantee that Our services will be error-free. You agree that JomlahBazar will not be liable for any delays or losses resulting from Our services' errors, such as failure to settle, complete, and process any transactions.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">4 Your Obligations</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                4.1 You ensure that:
                <br>(a)	You will be responsible for the security and confidentiality of Your Account and its password;
                <br>(b)	You will be accountable for all of the activities conducted under Your Account;
                <br>(c)	if there were a security breach or a suspected security breach of Your Account, You would notify Us immediately; and
                <br>(d)	upon request, You will provide Us with additional information regarding Your eligibility and use of Our services.
                <br>4.2 You also agree that:
                <br>(a)	We can have Your information in Our database, and You permit JomlahBazar and Our Affiliates to use or share such information as per JomlahBazar's <a class="kt-link" href="<?php echo DIR_VIEW.DIR_CON;?>privacypolicy.php">Privacy Policy</a>;
                <br>(b)	the information and documentation You provide will be legitimate, accurate, and complete, and that You will maintain and update such information and documentation to be accurate and complete;
                <br>(c)	You have all the necessary rights, licenses, permits, and certifications for all the Content You will submit, post, or display on JomlahBazar Platforms; and
                <br>(d)	any Content You provide does not violate any trademarks, copyrights, patents, industrial designs, trade secrets, or any third-party rights.
                <br>4.3 You further agree that all the Content You post or display on JomlahBazar.com will:
                <br>(a)	be legitimate, accurate and complete, and does not violate any relevant laws or regulations;
                <br>(b)	not be defamatory, threatening, obscene, offensive, explicit, or unacceptable;
                <br>(c)	follow Islamic law, principles, morals, ethics, and traditions;
                <br>(d)	not threaten national security;
                <br>(e)	not be counterfeit or stolen;
                <br>(f)	not promote any activities that could be threatening or could violate any applicable laws or regulations; and
                <br>(g)	not link any website either directly or indirectly, including content that violates any applicable laws or regulations.
                <br>4.4 With regards to reviews or comments on products or sellers, You expressly agree that:
                <br>(a)	they will be genuine and unbiased feedback;
                <br>(b)	they will not be misleading or manipulative;
                <br>(c)	they will be accurate and related to the specific product or seller; and
                <br>(d)	they will not be spam.
                <br>4.5 JomlahBazar can also remove Your comments or reviews on Our Platforms if:
                <br>(a)	You have some financial interest or monetary reward from leaving reviews about the product, either direct or indirect;
                <br>(b)	You have a close personal relationship with the relevant seller;
                <br>(c)	You are the actual manufacturer or seller of the product;
                <br>(d)	You are a competitor leaving negative reviews; and
                <br>(e)	You leave reviews or comments in exchange for the same.
                <br>4.6 You agree that if You post comments or reviews on Our Platforms, You also permit Us to use Your username in connection to Your comment or review.
                <br>4.7 Additionally, You agree that:
                <br>(a)	You will only conduct activities allowed to You by this Terms and Conditions, Your Seller’s Agreement (for sellers), Our policies, and any other applicable laws or regulations and will not violate the same;
                <br>(b)	You will conduct transactions and communicate with JomlahBazar users honestly and legitimately;
                <br>(c)	You will provide any data relating to transactions undertaken in Our Platforms upon request;
                <br>(d)	You will not interfere with other users’ rights to use JomlahBazar's services;
                <br>(e)	You will not engage in any fraudulent activities within Our Platforms, including, but not limited to, manipulating feedback in any way, spamming, phishing, or circulating computer viruses;
                <br>(f)	You will not illegally use other users' information or disclose them to any third party unless required or requested by JomlahBazar;
                <br>(g)	You will not attempt to gain unauthorized access to parts of Our Platforms or other users' account by hacking, password "mining," or by any other illegitimate means;
                <br>(h)	You will not engage in any activities that would make JomlahBazar liable; and
                <br>(i)	You will not evade any technical measures provided by JomlahBazar for their services.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">5 Third-party Sites and Services</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                5.1 JomlahBazar shall not be liable for any of the content of third-party sites provided by hyperlinks or other means. The relevant third-party site shall have their terms and conditions that You shall review.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">6 Information Accuracy, Warranties, and Representation</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                6.1 In JomlahBazar, We do Our best to ensure the information on Our Platforms is accurate. However, there may still be inaccuracies, out-of-date, or incomplete information, and We do not warrant such inaccuracies or materials provided through Our Platforms. Thus, You agree that JomlahBazar or Our Affiliates cannot be held liable in such situations.
                <br>6.2 Product descriptions, specifications, and prices may be changed any time without notice. We also try Our best to guarantee that colors would accurately be displayed for product images, but this would still depend on Your computer or equipment. We cannot ensure that it will precisely depict the color.
                <br>6.3 All products included in Our Platforms do not guarantee or warrant that such products are available. JomlahBazar reserves the right to discontinue any product at any time without notice.
                <br>6.4 Sellers are responsible for their product listings and all other information or content they provide. Whether it was expressed or implied, JomlahBazar will not be liable for any inaccuracies, warranties, representations, or conditions regarding their products' quality, legality, safety, or that Our services will be error-free or will be provided in a well-timed and proper manner.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">7 Terms of Sale</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Each product listed in JomlahBazar is sold by their relevant seller, supplier, or manufacturer specified on the product page.<br>
                <br>7.1 Domestic and International Buyers
                <br>7.1.1 If the buyer and seller is inside the UAE, all JomlahBazar terms and conditions and policies will apply, including Our Return and Refund Policy.
                <br>7.1.2 If the buyer or seller is outside the UAE, all contractual terms and agreement, including payment, shipping, and any returns or refunds, shall be determined by the buyer and the seller. JomlahBazar will only be responsible for booking the order with the seller.
                <br>7.2 Acceptance of Order
                <br>7.2.1 An order will be deemed accepted once both the buyer and seller receives an e-mail confirmation.
                <br>7.3 Payment
                <br>7.3.1 If the buyer and seller is inside the UAE, available payment methods will include credit and debit card payment, bank transfer, Cash-on-Delivery (COD), and Cash-on-Pickup (COP). Note that depending on the payment method You use, additional charges may apply. If You want to know more about Our payment methods, visit Our <a class="kt-link" href="<?php echo DIR_VIEW.DIR_CON;?>paymentmethods.php">Payment Methods page</a>.
                <br>7.3.2 If You place an order and decide on paying with Your credit or debit card, You agree and permit Our third-party payment gateway provider to process Your credit or debit card details for Your order amount. Thus, You will also have to abide by the payment gateway provider’s terms and conditions.
                <br>7.3.3 If You pay through bank transfer, You are responsible for uploading the bank transfer receipt on JomlahBazar. The order shall be considered confirmed once You receive a confirmation email from JomlahBazar.
                <br>7.3.4 If the buyer or seller is outside the UAE, the available payment methods shall be determined by the relevant seller and will be made directly to them. A proof of payment shall then be uploaded by the buyer on Our Platform.
                <br>7.4 Cancellation of Order
                <br>7.4.1 Buyers can cancel orders prior to its shipment and will be refunded. However, once the order has been shipped and is out for delivery, You can either refuse the delivery or issue a return by contacting JomlahBazar or issuing a request through Your account.
                <br>7.5 Invoicing
                <br>7.5.1 Sellers must provide Buyers with tax invoices upon their request.
                <br>7.6 Delivery or Shipment of Order
                <br>7.6.1 To know more about Our Shipping and Delivery, read Our <a class="kt-link" href="<?php echo DIR_VIEW.DIR_CON;?>delivery.php">Shipping and Delivery</a>.
                <br>7.6.2 <b>If both the buyer and the seller is located inside the UAE, shipping and delivery may be handled by JomlahBazar or solely by the seller:</b>
                <br><b>For shipments by JomlahBazar:</b>
                <br>(a) Estimated shipping time is one to three (1 – 3) days;
                <br>(b) If there are any delays, You can contact Us or Our Third-Party Service Provider;
                <br>(c) If Your order has not been delivered after several attempts, Your order will be cancelled; and
                <br>(d) We are entitled to cancel Your order if You fail to verify Your identity upon request.
                <br><b>For shipments by the seller:</b>
                <br>(a) Estimated shipping times may vary;
                <br>(b) JomlahBazar shall not be liable for any delays; and
                <br>(c) If there are any delays, You can directly contact the seller, whose contact details can be found in their seller’s account.
                <br>7.6.3 If the buyer or the seller is outside the UAE, shipping and delivery will depend on the buyer and seller’s agreement.
                <br>7.6.4 Title of ownership over the product will pass over to You as soon as You have successfully paid for the product, and it has been delivered to You.
                <br>7.7 Warranty
                <br>7.7.1 All products listed on JomlahBazar's Platforms are solely covered by the seller's warranty, if any. All information relating to warranties will be included in the relevant product’s description and subject to the seller's policy.
                <br>7.7.2 You agree that JomlahBazar will not be liable for any representations stated in the warranty. The seller shall be solely responsible for such warranties.
                <br>7.7.3 If You have any issues regarding warranties, You should raise the matter to the seller whose contact details are available on Our Platforms.
                <br>7.8 Returns, Repairs, and Replacements
                <br>7.8.1 To know more about returns, repairs, and replacements, please read Our <a class="kt-link" href="<?php echo DIR_VIEW.DIR_CON;?>Returns.php">Return and Refund Policy</a>.
                <br>7.8.2 Buyers are entitled to returns within seven (7) days from their order's delivery date. All requests for returns must abide by Our Return and Refund policy and is subject to the seller's approval. Repairs or replacements are solely subject to the seller’s approval.
                <br>7.8.3 Note that Our Return and Refund Policy will not apply if either the buyer or seller is located outside of the UAE as this would be subject to the agreement between the buyer and the seller.
                <br>7.8.4 Returns will be refunded in credits stored in Your JB Wallet. Note that this does not erase the purchase amount from your credit card. If You want the funds to be refunded directly to Your bank account or credit card, kindly contact Us through Our provided contact numbers or live chat.
                <br>7.8.5 Returns can be initiated by opening a return request through Your account or contacting Us through live chat, e-mail, social media, or through one of Our provided contact numbers.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">8 Duration of the Agreement and Termination</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                8.1 This Agreement shall become binding once You have accepted this Agreement and shall continue to be binding until either JomlahBazar or You have terminated the Agreement.
                <br>8.2 JomlahBazar has the right to terminate or suspend this Agreement and Your Account for any reason, especially if You have or have been suspected of violating this Agreement, Your Seller’s Agreement (for sellers), or Our policies. <b>Buyers</b> may also terminate this Agreement for any reason. However, <b>sellers</b> must provide a notice within thirty (30) days.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">9 Breach of Agreement and Liabilities</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                9.1 <b>JomlahBazar is only considered as the intermediating platform for Buyers and Sellers</b>. Thus, You agree that JomlahBazar and Our Affiliates shall not be held liable for any unforeseen, consequential, or minor losses, claims, or legal costs resulting directly or indirectly from:
                <br>(a)	sellers’ products and shipments;
                <br>(b)	any of Your violations of this Agreement or any of JomlahBazar’s policies as posted on Our Platforms;
                <br>(c)	the Content and other information You provide in using JomlahBazar Platforms and any inaccuracies of such;
                <br>(d)	any errors or bugs in JomlahBazar's services;
                <br>(e)	any damage or virus You obtain by accessing or using JomlahBazar Platforms;
                <br>(f)	the actions of third parties using Our Platforms;
                <br>(g)	JomlahBazar suspending Your use of Our services; or
                <br>(h)	the changes We make to this Agreement.
                <br>9.2 You also agree to indemnify JomlahBazar for any fines, claims, or losses We incur concerning Your violation of this Agreement or Our policies, including, but not limited to, loss of profits or savings, business interruption, or loss of information.
                <br>9.3 Nothing in this Agreement or Our policies shall limit or exclude liability for fraud, misrepresentation, death or personal injury caused by negligence, or any other liability that cannot be limited or excluded as per applicable laws and regulations.
                <br>9.4 JomlahBazar and Our Affiliates will not be liable for any unforeseen, consequential, or minor damages or losses resulting from Your use of JomlahBazar Platforms.
                <br>9.5 Subject to Clause 9.3, if the clauses above are not enforceable, JomlahBazar's total liability to You shall be limited to AED 100.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">10 Intellectual Property</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                10.1 All of JomlahBazar’s trademarks and copyrights are owned by Pomechain DMCC. Both local and international intellectual property laws protect Our logos, website, and content. None of Our trademarks or copyrights can be used for any reason without Our prior written consent.
                10.2 You grant JomlahBazar a license over the intellectual property rights You use concerning Our services. You also allow Us to sublicense such intellectual property rights to Our Affiliates provided We do not alter any of Your trademarks and use them only in providing Our services.
                10.3 All other trademarks appearing on JomlahBazar Platforms are owned by their respective owners regardless of being affiliated or not with JomlahBazar. All other rights are reserved.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">11 Data Protection </h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                11.1 We try Our best to ensure that Your information is secured and protected. To know more about how We handle Your information, please see Our <a href="<?php echo DIR_VIEW.DIR_CON;?>privacypolicy.php">Privacy Policy</a>.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">12 General Clauses</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                12.1 <b>Entirety of Agreement:</b> This Agreement represents the whole agreement between buyers and JomlahBazar regarding the use of Our Platforms. In addition to the Seller’s Agreement (for sellers), this Agreement and the policies posted on Our Platforms will also be binding on sellers.
                <br>12.2 <b>Amendments and Acceptance:</b> Only JomlahBazar can modify this Agreement and Our policies. You will be notified of any changes. By continuing to use JomlahBazar's services, You will be deemed to have accepted the changes made in this Agreement or any of the policies on Our Platforms, and they will bind You with <b>immediate effect</b>.
                <br>12.3 <b>Relationship:</b> This Agreement does not create any agency, partnership, employment, franchise relationship, or joint venture between You and JomlahBazar.
                <br>12.4 <b>Third Parties:</b> An individual who is not a party to this Agreement shall not be entitled to claim the enforcement of this Agreement's terms.
                <br>12.5 <b>Severability:</b> If there were any invalid clauses, they would be severed, and the rest of the Agreement shall still be valid and enforceable.
                <br>12.6 <b>Force Majeure:</b> You and JomlahBazar shall not be held liable for any failure to fulfil any obligation under this Agreement if the failure results from a circumstance beyond either party's control, such as war, natural calamities, or pandemics.
                <br>12.7 <b>Waiver:</b> If JomlahBazar waives their right against You for any breaches under this Agreement, JomlahBazar does not waive their rights to enforce actions against You in the future so long as this Agreement is binding.
                <br>12.8 <b>Assignment:</b> You are not entitled to assign this Agreement to any other person or entity without JomlahBazar's written consent. On the other hand, JomlahBazar has the right to transfer this Agreement to any person or entity.
                <br>12.9 <b>Compliance:</b> Both You and JomlahBazar shall comply with all applicable laws and regulations that each must follow in pursuance of this Agreement.
                <br>12.10 <b>Assisting Law Enforcements:</b> If there are any suspected criminal or civil wrongdoings, JomlahBazar is entitled to cooperate fully with the relevant government authorities. We can disclose Your information, such as Your identity, contact details, and Your transactions and activities conducted in JomlahBazar Platforms, and shall not be liable to any damages or losses for doing so.
                <br>12.11 <b>Contact:</b> If You have any further inquiries, You can contact Us via e-mail at <a class="kt-link" href="mailto:info@jomlahbazar.com">info@jomlahbazar.com</a> or by calling Us through Our provided contact numbers. If You have any legal complaints or issues You would like to raise, e-mail Us through <a class="kt-link" href="mailto:legal@pomechain.com">legal@pomechain.com</a>.
                <br>12.12 <b>Dispute Resolution:</b> Any dispute arising out of or in connection with this contract, including any question regarding its existence, validity, or termination, shall be referred to and finally resolved by arbitration under the <b>Arbitration Rules of the DIFC – LCIA Arbitration Centre</b>, which Rules are deemed to be incorporated by reference into this clause. The number of arbitrators shall be one. The seat, or legal place, of arbitration shall be Dubai International Financial Centre ("<b>DIFC</b>"). The language to be used in the arbitration shall be English.
                <br>12.13 <b>Legal Notices:</b> All legal notices and demands to JomlahBazar must be sent via e-mail to <a class="kt-link" href="mailto:legal@pomechain.com">legal@pomechain.com</a>. Note that any notice given by e-mail shall be considered as received twenty-four (24) hours after the time of transmission.

                <br>12.14: <b>Jurisdiction:</b> The laws and regulations applicable to this Agreement shall be that of the United Arab Emirates. In the case of a dispute or claim arising out of this Agreement or in connection with it, please refer to Clause 12.12.
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
