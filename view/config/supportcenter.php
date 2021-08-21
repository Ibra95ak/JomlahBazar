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
<!-- end:: Header -->
<div class="kt-content  kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content -->

  <!-- begin:: Hero -->
  <div class="kt-sc" style="background-image: url('<?php echo DIR_ROOT.DIR_MED.DIR_CON;?>holecityinsquare.png')">
    <div class="kt-container ">
      <div class="kt-sc__bottom">
        <h3 class="kt-sc__heading kt-heading kt-heading--center kt-heading--xxl kt-heading--medium kt-font-xl kt-font-warning">
          How can we help?
        </h3>
        <!-- <form class="kt-sc__form">
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24" />
        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
      </g>
    </svg> </span>
  </div>
  <input type="text" class="form-control" placeholder="Ask a question" aria-describedby="basic-addon1">
</div>
</form> -->
</div>
</div>
</div>

<!-- end:: Hero -->
<div class="row safari-row-flex">
  <div class="col-md-6">
    <img src="<?php echo DIR_ROOT.DIR_MED.'bg/jomlahbazar-customer-care.jpg'?>" alt="" style="width: 60%;">
  </div>
  <div class="col-md-6">
    <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-faster">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24"></rect>
                          <path d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z" fill="#000000"></path>
                          <path d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        </g>
                      </svg> </div>
                    <div class="kt-iconbox__desc">
                      <h3 class="kt-iconbox__title">
                        <a class="kt-link" href="#">Customer Support</a>
                      </h3>
                      <div class="kt-iconbox__content">
                        <table>
                          <tr>
                            <td>TEL</td>
                            <td>:+971 4 3477802</td>
                          </tr>
                          <tr>
                            <td>Whatsapp/Mob</td>
                            <td>:+971 4 3477802</td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>:info@jomlahbazar.com</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-faster">
                <div class="kt-portlet__body">
                  <div class="kt-iconbox__body">
                    <div class="kt-iconbox__icon">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24"></rect>
                          <path d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z" fill="#000000"></path>
                          <path d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        </g>
                      </svg> </div>
                    <div class="kt-iconbox__desc">
                      <h3 class="kt-iconbox__title">
                        <a class="kt-link" href="#">Sales Support</a>
                      </h3>
                      <div class="kt-iconbox__content">
                        <table>
                          <tr>
                            <td>TEL</td>
                            <td>:+971 4 3929221</td>
                          </tr>
                          <tr>
                            <td>Whatsapp/Mob</td>
                            <td>:+971 5045277180</td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td>:sales@jomlahbazar.com</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
  </div>
</div>
<!-- begin:: Section -->
<div class="row safari-row-flex">
  <div class="col-lg-6">
    <div class="kt-portlet kt-portlet--height-fluid kt-sc-2">
      <div class="kt-portlet__body">
        <div class="kt-infobox">
          <div class="kt-infobox__header">
            <h2 class="kt-infobox__title kt-font-md">Sellers FAQ</h2>
          </div>
          <div class="kt-infobox__body">

            <!--begin::Accordion-->
            <div class="accordion accordion-light accordion--no-bg accordion-svg-icon" id="seller-accordionExample1">
              <div class="card">
                <div class="card-header" id="seller-headingOne1">
                  <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#seller-collapseOne1" aria-expanded="false" aria-controls="seller-collapseOne1">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      </g>
                    </svg> Introduction
                  </div>
                </div>
                <div id="seller-collapseOne1" class="collapse" aria-labelledby="seller-headingOne1" data-parent="#seller-accordionExample1" style="">
                  <div class="card-body kt-font-md kt-font-dark">
                    <div class="accordion accordion-light accordion-toggle-plus" id="seller-accordionExample2">
                      <div class="card">
                        <div class="card-header" id="seller-headingTwo1">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseTwo1" aria-expanded="false" aria-controls="seller-collapseTwo1">
                            1.	How can I contact the Customer Help Centre?
                          </div>
                        </div>
                        <div id="seller-collapseTwo1" class="collapse" aria-labelledby="seller-headingTwo1" data-parent="#seller-accordionExample2" style="">
                          <div class="card-body">
                            If you have any inquiries, you can contact us via email at <a href="mailto:info@jomlahbazar.com" class="kt-link">info@jomlahbazar.com</a> or by calling our Customer Care through one of our provided contact details or live chat.
                            <br>If your inquiry is legal-related, you can contact us via email at <a href="mailto:legal@jomlahbazar.com" class="kt-link">legal@jomlahbazar.com</a>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingTwo2">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseTwo2" aria-expanded="false" aria-controls="seller-collapseTwo2">
                            2.	What is JomlahBazar?
                          </div>
                        </div>
                        <div id="seller-collapseTwo2" class="collapse" aria-labelledby="seller-headingTwo2" data-parent="#seller-accordionExample2">
                          <div class="card-body">
                            JomlahBazar is an E-Marketplace platform for wholesale Sellers and Buyers. It is a platform where regional and global brands and companies connect to the right consumers.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingTwo3">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseTwo3" aria-expanded="false" aria-controls="seller-collapseTwo3">
                            3.	What services does JomlahBazar offer?
                          </div>
                        </div>
                        <div id="seller-collapseTwo3" class="collapse" aria-labelledby="seller-headingTwo3" data-parent="#seller-accordionExample2">
                          <div class="card-body">
                            Our services to you include providing:
                            <br>(a)	a Platform where You can buy wholesale products;
                            <br>(b)	an Account where You can display and modify Your personal or company information; and
                            <br>(c)	Payment gateway and shipping and delivery services as provided by Our Third-Party Service Providers.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingTwo4">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseTwo4" aria-expanded="false" aria-controls="seller-collapseTwo4">
                            4.	How can I start selling on JomlahBazar?
                          </div>
                        </div>
                        <div id="seller-collapseTwo4" class="collapse" aria-labelledby="seller-headingTwo4" data-parent="#accordionExample2">
                          <div class="card-body">
                            Steps:
                            <br>1.	Register an account as a Seller by emailing us at sales@jomlahbazar.com. As part of our onboarding process, the following documents will be required from you:
                            <br>(a)	Trade license;
                            <br>(b)	any document proving the purchase of products, such as invoices, distribution authorization letter, permit or certificate from the manufacturer;
                            <br>(c)	Emirates ID or Passport Copy of Owner, manager, or individual registering on your company's behalf;
                            <br>(d)	VAT registration certificate; and
                            <br>(e)	bank details in a signed and stamped company letterhead such as:
                            <ul>
                              <li>Company's legal name;</li>
                              <li>Bank account number;</li>
                              <li>IBAN;</li>
                              <li>Swift code; and</li>
                              <li>Bank branch.</li>
                            </ul>
                            <br>2.	Once you have submitted the necessary documents, you must upload your price listings, product images, descriptions, and any other necessary information in relation to your company and products.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingTwo5">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseTwo5" aria-expanded="false" aria-controls="seller-collapseTwo5">
                            5.	Why should I create an account?
                          </div>
                        </div>
                        <div id="seller-collapseTwo5" class="collapse" aria-labelledby="seller-headingTwo5" data-parent="#seller-accordionExample2">
                          <div class="card-body">
                            To make use of JomlahBazar’s platforms and its features, creating an account would be necessary. It is the only way you can start selling within our Platforms.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingTwo6">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseTwo6" aria-expanded="false" aria-controls="seller-collapseTwo6">
                            6.	What product categories are on JomlahBazar?
                          </div>
                        </div>
                        <div id="seller-collapseTwo6" class="collapse" aria-labelledby="seller-headingTwo6" data-parent="#accordionExample2">
                          <div class="card-body">
                            Currently, we have groceries, perfumes, beauty and makeup, and personal care. We are certainly looking into expanding our product categories to cater to all your product needs.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingTwo7">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseTwo7" aria-expanded="false" aria-controls="seller-collapseTwo7">
                            7.	What are my responsibilities as a Seller?
                          </div>
                        </div>
                        <div id="seller-collapseTwo7" class="collapse" aria-labelledby="seller-headingTwo7" data-parent="#accordionExample2">
                          <div class="card-body">
                            To know your responsibilities as a Seller, please read the <a href="<?php echo DIR_VIEW.DIR_CON?>Conditions_of_use.php" class="kt-link">Terms and Conditions</a> or your Seller’s Agreement.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="card">
                <div class="card-header" id="seller-headingOne8">
                  <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#seller-collapseOne8" aria-expanded="false" aria-controls="seller-collapseOne8">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      </g>
                    </svg> Managing Your Account
                  </div>
                </div>
                <div id="seller-collapseOne8" class="collapse" aria-labelledby="seller-headingOne8" data-parent="#seller-accordionExample1" style="">
                  <div class="card-body kt-font-md kt-font-dark">
                    <div class="accordion accordion-light accordion-toggle-plus" id="seller-accordionExample3">
                      <div class="card">
                        <div class="card-header" id="seller-seller-headingThree1">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseThree1" aria-expanded="false" aria-controls="seller-collapseThree1">
                            1.	How can I change my account details?
                          </div>
                        </div>
                        <div id="seller-collapseThree1" class="collapse" aria-labelledby="seller-headingThree1" data-parent="#accordionExample3" style="">
                          <div class="card-body">
                            If you want to change your account details, such as your username, email address, contact number, or password, you can log onto your account and select "Personal Account," where you can edit your details.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingThree2">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseThree2" aria-expanded="false" aria-controls="seller-collapseThree2">
                            2.	How can I change my e-mail preferences?
                          </div>
                        </div>
                        <div id="seller-collapseThree2" class="collapse" aria-labelledby="seller-headingThree2" data-parent="#seller-accordionExample3">
                          <div class="card-body">
                            If you want to receive any promotional emails or notifications from JomlahBazar, you can log onto your account, go to the "Personal Account" section, and to the email alerts and messages section.
                            <br>If you do not want to receive any promotional emails or notifications from us, you can click the "unsubscribe" button located under our emails or manually turn off JomlahBazar notifications in your account or phone settings.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingThree3">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseThree3" aria-expanded="false" aria-controls="seller-collapseThree3">
                            3.	What do I do if my account has been hacked?
                          </div>
                        </div>
                        <div id="seller-collapseThree3" class="collapse" aria-labelledby="seller-headingThree3" data-parent="#seller-accordionExample3">
                          <div class="card-body">
                            If your account has been compromised, contact us via e-mail at <a href="mailto:info@jomlahbazar.com" class="kt-link">info@jomlahbazar.com</a> or call our Customer Care through one of our provided contact numbers or live chat.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingThree4">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseThree4" aria-expanded="false" aria-controls="seller-collapseThree4">
                            4.	How do I report any issues or Intellectual Property infringement?
                          </div>
                        </div>
                        <div id="seller-collapseThree4" class="collapse" aria-labelledby="seller-headingThree4" data-parent="#seller-accordionExample3">
                          <div class="card-body">
                            If you have any issues or matters relating to intellectual property infringement, contact us via e-mail at <a href="mailto:legal@jomlahbazar.com" class="kt-link">legal@jomlahbazar.com</a> or call our Customer Care through one of our provided contact numbers or live chat.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingThree5">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseThree5" aria-expanded="false" aria-controls="seller-collapseThree5">
                            5.	How is my information protected?
                          </div>
                        </div>
                        <div id="seller-collapseThree5" class="collapse" aria-labelledby="seller-headingThree5" data-parent="#seller-accordionExample3">
                          <div class="card-body">
                            To know more about how we handle your data and ensure its privacy and protection, read our <a href="<?php echo DIR_VIEW.DIR_CON;?>privacypolicy.php" class="kt-link">Privacy Policy</a>.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingThree6">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseThree6" aria-expanded="false" aria-controls="seller-collapseThree6">
                            6.	I want to delete my account.
                          </div>
                        </div>
                        <div id="seller-collapseThree6" class="collapse" aria-labelledby="seller-headingThree6" data-parent="#seller-accordionExample3">
                          <div class="card-body">
                            If you want to deactivate your account, you will have to send an email to <a href="mailto:legal@jomlahbazar.com" class="kt-link">legal@jomlahbazar.com</a> with a thirty (30) day notice before your account is deactivated.
                            <br>Note that once you deactivate your account, you will lose access to the following:
                            <br>•	Your JomlahBazar account, including all your posts, comments, communications within our website, and your account history (i.e. order history).
                            <br>If you want to use JomlahBazar's services again, you will have to create a new account.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="seller-headingOne12">
                  <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#seller-collapseOne12" aria-expanded="false" aria-controls="seller-collapseOne12">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      </g>
                    </svg> Verification
                  </div>
                </div>
                <div id="seller-collapseOne12" class="collapse" aria-labelledby="seller-headingOne12" data-parent="#seller-accordionExample1" style="">
                  <div class="card-body kt-font-md kt-font-dark">
                    <div class="accordion accordion-light accordion-toggle-plus" id="seller-accordionExample7">
                      <div class="card">
                        <div class="card-header" id="seller-seller-headingseven12">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseseven12" aria-expanded="false" aria-controls="seller-collapseseven12">
                            1.	What is a Verification Badge? And How Do I Get Verified?
                          </div>
                        </div>
                        <div id="seller-collapseseven12" class="collapse" aria-labelledby="seller-headingseven12" data-parent="#seller-accordionExample7" style="">
                          <div class="card-body">
                            A Verification Badge signifies that a Seller has submitted the following documents to prove that they are a valid operating company:
                            <ul>
                              <li>Valid trade license</li>
                              <li>Bank details and statements</li>
                              <li>VAT registration certificate</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="seller-headingOne9">
                  <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#seller-collapseOne9" aria-expanded="false" aria-controls="seller-collapseOne9">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      </g>
                    </svg>Selling on JomlahBazar
                  </div>
                </div>
                <div id="seller-collapseOne9" class="collapse" aria-labelledby="seller-headingOne9" data-parent="#seller-accordionExample1" style="">
                  <div class="card-body kt-font-md kt-font-dark">
                    <div class="accordion accordion-light accordion-toggle-plus" id="seller-accordionExample5">
                      <div class="card">
                        <div class="card-header" id="seller-headingFive1">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive1" aria-expanded="false" aria-controls="seller-collapseFive1">
                            1.	How do I manage inventory?
                          </div>
                        </div>
                        <div id="seller-collapseFive1" class="collapse" aria-labelledby="seller-headingFive1" data-parent="#seller-accordionExample5" style="">
                          <div class="card-body">
                            For adding or listing products, sellers may do it in three ways:
                            <br>a. Adding products from scratch
                            <br>Go to “Add Product” and manually fill out the fields needed per product.
                            <br>b. Choosing products from the JomlahBazar listed products
                            <br>Sellers may select products from the existing list of products on the website. In this way, other product details are already populated, and sellers only have to add the quantity and price in the inventory that they have.
                            <br>c. Bulk Upload
                            <br>Go to “Bulk Upload” and follow the instructions. Download the excel template, fill it out and send to <a href="mailto:info@pomechain.com" class="kt-link">info@pomechain.com</a>.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive2">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive2" aria-expanded="false" aria-controls="seller-collapseFive2">
                            2.	How do I receive orders?
                          </div>
                        </div>
                        <div id="seller-collapseFive2" class="collapse" aria-labelledby="seller-headingFive2" data-parent="#seller-accordionExample5">
                          <div class="card-body">
                            You will be notified via email for every order that your store received. You can also check your “<b>My Orders</b>” tab. Once you receive an order, you may either accept, reject, or modify the order.
                            <br>If you accept an order, both the seller and the buyer will receive a confirmation email for the order. If you reject an order, the order will be cancelled, and the buyer will be refunded if necessary.
                            <br>If you modify the order, the buyer will receive an email giving them a choice to accept or reject the modification. If the buyer accepts the modification, both the buyer and the seller shall receive a confirmation email. If the buyer rejects the modification, the order will be cancelled, and the buyer will be refunded if necessary.

                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive3">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive3" aria-expanded="false" aria-controls="seller-collapseFive3">
                            3.	When will I receive my payment?
                          </div>
                        </div>
                        <div id="seller-collapseFive3" class="collapse" aria-labelledby="seller-headingFive3" data-parent="#seller-accordionExample5">
                          <div class="card-body">
                            As per the Seller’s Agreement, JomlahBazar’s settlement period is twenty-two (22) days.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive4">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive4" aria-expanded="false" aria-controls="seller-collapseFive4">
                            4.	How will my orders be delivered by JomlahBazar?
                          </div>
                        </div>
                        <div id="seller-collapseFive4" class="collapse" aria-labelledby="seller-headingFive4" data-parent="#seller-accordionExample5">
                          <div class="card-body">
                            <br>In the email notification of the order made by one of your buyers that you will receive, you must confirm if the stock is ready and if you are ready to ship. The shipping options are either:
                            <br>1.) You deliver the package yourself; or
                            <br>2.) You schedule for pick-up (JomlahBazar’s Delivery Service) *
                            <br>You may either handle the delivery yourself or have our partner shipping company pick up the package from your registered pick-up location and deliver the same to the buyer.
                            <br>* NOTE: If both buyers and sellers are located inside the UAE, sellers may choose to handle the delivery themselves or use JomlahBazar’s Delivery Service. If either the buyer or seller is located outside of the UAE, all deliveries will depend on the agreement between the buyer and the seller.
                            <br>For more information on our shipping and delivery, please read the <a href="<?php echo DIR_VIEW.DIR_CON;?>sellerguidedelivery.php" class="kt-link">Seller’s Guide to Shipping and Delivery</a>.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive10">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive10" aria-expanded="false" aria-controls="seller-collapseFive10">
                            5.	Do I provide invoice?
                          </div>
                        </div>
                        <div id="seller-collapseFive10" class="collapse" aria-labelledby="seller-headingFive10" data-parent="#seller-accordionExample5">
                          <div class="card-body">
                            Yes. As per your Seller’s Agreement, sellers must provide tax invoices to buyers upon request.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive11">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive11" aria-expanded="false" aria-controls="seller-collapseFive11">
                            6.	What if I handle my own delivery?
                          </div>
                        </div>
                        <div id="seller-collapseFive11" class="collapse" aria-labelledby="seller-headingFive11" data-parent="#seller-accordionExample5">
                          <div class="card-body">
                            If the seller handles his own delivery, all sellers are responsible of updating JomlahBazar through our system whether the package has already been delivered.
                            <br>Additionally, for Cash-on-Delivery (COD) orders, sellers must also remit buyers’ payments of JomlahBazar fees to us which we will claim upon invoicing our commission from the seller.
                            <br>NOTE: If seller fails to update JomlahBazar with COD and COP orders, both buyer and seller will be notified.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive5">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive5" aria-expanded="false" aria-controls="seller-collapseFive5">
                            7.	How can I track an order?
                          </div>
                        </div>
                        <div id="seller-collapseFive5" class="collapse" aria-labelledby="seller-headingFive5" data-parent="#seller-accordionExample5">
                          <div class="card-body">
                            For JomlahBazar deliveries, you can track your shipment using the Tracking Number provided once your order has been confirmed and entering it on our Third-Party Shipping Provider's website (https://emiratespost.ae/Portal/Home?locale=en-us).
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive7">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive7" aria-expanded="false" aria-controls="seller-collapseFive7">
                            7.	How long does it take to have my order delivered?
                          </div>
                        </div>
                        <div id="seller-collapseFive7" class="collapse" aria-labelledby="seller-headingFive7" data-parent="#seller-accordionExample6">
                          <div class="card-body">
                            For JomlahBazar deliveries, the estimated delivery time for your package will be one to three (1 – 3) days. For deliveries handled specifically by Sellers, estimated delivery time cannot be guaranteed as it will depend on the Seller, and their performance can vary.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive8">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive8" aria-expanded="false" aria-controls="seller-collapseFive8">
                            8.	 Does JomlahBazar deliver outside UAE?
                          </div>
                        </div>
                        <div id="seller-collapseFive8" class="collapse" aria-labelledby="seller-headingFive8" data-parent="#seller-accordionExample6">
                          <div class="card-body">
                            Currently, JomlahBazar's Delivery Service is only available within the UAE. International shipping and delivery will solely depend on the buyer and seller's agreement.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive9">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive9" aria-expanded="false" aria-controls="seller-collapseFive9">
                            9.	How long does it take to have my order delivered?
                          </div>
                        </div>
                        <div id="seller-collapseFive9" class="collapse" aria-labelledby="seller-headingFive9" data-parent="#seller-accordionExample6">
                          <div class="card-body">
                            For JomlahBazar deliveries, the estimated delivery time for your package will be one to three (1 – 3) days. For deliveries handled specifically by sellers, estimated delivery time cannot be guaranteed as it will depend on the seller, and their performance can vary.
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive12">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive12" aria-expanded="false" aria-controls="seller-collapseFive12">
                            10.	There are delays with my delivery.
                          </div>
                        </div>
                        <div id="seller-collapseFive12" class="collapse" aria-labelledby="seller-headingFive12" data-parent="#seller-accordionExample6">
                          <div class="card-body">
                            If there are any delays with JomlahBazar deliveries, you can contact us through our provided contact details or contact our Third-Party Shipping Provider directly (https://emiratespost.ae/Portal/Info?locale=en-us&pageid=117).
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="seller-headingFive13">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseFive13" aria-expanded="false" aria-controls="seller-collapseFive13">
                            11.	My order got cancelled. Why?
                          </div>
                        </div>
                        <div id="seller-collapseFive13" class="collapse" aria-labelledby="seller-headingFive13" data-parent="#seller-accordionExample6">
                          <div class="card-body">
                            Packages may sometimes be returned to us for the following reasons:
                            <ul>
                              <li>Wrong or incomplete address: if the address is not accurate or updated.</li>
                              <li>Failed delivery attempts: if you could not accept the delivery for all attempts.</li>
                              <li>Refused by recipient: if you reject the package.</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="seller-headingOne10">
                  <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#seller-collapseOne10" aria-expanded="false" aria-controls="seller-collapseOne10">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                        <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      </g>
                    </svg> Returns and Refunds
                  </div>
                </div>
                <div id="seller-collapseOne10" class="collapse" aria-labelledby="seller-headingOne10" data-parent="#seller-accordionExample1" style="">
                  <div class="card-body kt-font-md kt-font-dark">
                    <div class="accordion accordion-light accordion-toggle-plus" id="seller-accordionExample6">
                      <div class="card">
                        <div class="card-header" id="seller-headingsix1">
                          <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapsesix1" aria-expanded="false" aria-controls="seller-collapsesix1">
                            1.	Can Buyers return their purchase?
                          </div>
                        </div>
                        <div id="seller-collapsesix1" class="collapse" aria-labelledby="seller-headingsix1" data-parent="#seller-accordionExample6" style="">
                          <div class="card-body">
                            Yes. Products can be returned within seven (7) days from when you received the order, provided they satisfy the eligibility requirements within our Return and Refund Policy, and the Seller approves. To know more, please visit our <a href="<?php echo DIR_VIEW.DIR_CON;?>Returns.php" class="kt-link">Return and Refund Policy</a> and the <a href="<?php echo DIR_VIEW.DIR_CON;?>sellerguidereturns.php" class="kt-link">Seller’s Guide to Returns and Refunds, Repairs, and Cancellations</a>.
                            <br>NOTE: JomlahBazar's Return and Refund Policy only applies if both the buyer and seller are located inside the UAE. Return and refunds will be subject to the buyer and seller's contractual terms and agreement if either the buyer or the seller is located outside the UAE.
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="seller-headingsix2">
                            <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapsesix2" aria-expanded="false" aria-controls="seller-collapsesix2">
                              2.	How can Buyers initiate a return?
                            </div>
                          </div>
                          <div id="seller-collapsesix2" class="collapse" aria-labelledby="seller-headingsix2" data-parent="#seller-accordionExample6">
                            <div class="card-body">
                              Returns can be initiated by initiating a request through the buyer’s account, or contacting Customer Care through one of our provided contact details or live chat. Once the return is received, refunds will be processed within seven to fourteen (7 - 14) business days.
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header" id="seller-headingsix3">
                            <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapsesix3" aria-expanded="false" aria-controls="seller-collapsesix3">
                              3.	What can Buyers return?
                            </div>
                          </div>
                          <div id="seller-collapsesix3" class="collapse" aria-labelledby="seller-headingsix3" data-parent="#seller-accordionExample6">
                            <div class="card-body">
                              As per JomlahBazar's Return and Refund Policy, Buyers can only return their purchase if the item:
                              <ul>
                                <li>is new and unused;</li>
                                <li>is in their original untouched packaging;</li>
                                <li>includes all tag or factory seals (if any);</li>
                                <li>has not been resized, damaged, or altered by the Buyer;</li>
                                <li>is returned with all original documentation (if any) (e.g., certificate of authenticity); and</li>
                                <li>does not belong to the listed non-refundable products and categories within our Return and Refund Policy.</li>
                              </ul>
                            </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="seller-headingsix4">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapsesix4" aria-expanded="false" aria-controls="seller-collapsesix4">
                                4.	How will the refund be processed?
                              </div>
                            </div>
                            <div id="seller-collapsesix4" class="collapse" aria-labelledby="seller-headingsix4" data-parent="#seller-accordionExample6">
                              <div class="card-body">
                                If a purchase is damaged, defective, or if the Buyer received the wrong product or a product different to its description or image, JomlahBazar will offer a refund of the total product amount, excluding shipping. If Buyer cancelled their order before shipping, they will be refunded immediately.
                                <br>Once the return is received, refunds will be processed within seven to fourteen (7 - 14) business days.
                                <br>NOTE: Refunds will be automatically processed and will be put into the buyer’s JB Wallet as credit.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="seller-headingsix5">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapsesix5" aria-expanded="false" aria-controls="seller-collapsesix5">
                                5.	Does JomlahBazar provide replacements, exchanges, and repairs?
                              </div>
                            </div>
                            <div id="seller-collapsesix5" class="collapse" aria-labelledby="seller-headingsix5" data-parent="#seller-accordionExample6">
                              <div class="card-body">
                                Buyers can also request for repairs and replacements through their Account or by contacting our Customer Care. Note that repairs and replacements may depend on the product category and the availability of a warranty.
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="seller-headingOne11">
                      <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#seller-collapseOne11" aria-expanded="false" aria-controls="seller-collapseOne11">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                          </g>
                        </svg> COVID-19
                      </div>
                    </div>
                    <div id="seller-collapseOne11" class="collapse" aria-labelledby="seller-headingOne11" data-parent="#seller-accordionExample1" style="">
                      <div class="card-body kt-font-md kt-font-dark">
                        <div class="accordion accordion-light accordion-toggle-plus" id="seller-accordionExample7">
                          <div class="card">
                            <div class="card-header" id="seller-seller-headingseven1">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseseven1" aria-expanded="false" aria-controls="seller-collapseseven1">
                                1.	Is JomlahBazar accepting orders?
                              </div>
                            </div>
                            <div id="seller-collapseseven1" class="collapse" aria-labelledby="seller-headingseven1" data-parent="#seller-accordionExample7" style="">
                              <div class="card-body">
                                Yes. We ensure you that deliveries are conducted in the safest manner by maintaining social distancing.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="seller-headingseven3">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#seller-collapseseven3" aria-expanded="false" aria-controls="seller-collapseseven3">
                                2.	Is JomlahBazar enforcing any protocols relating to COVID-19?
                              </div>
                            </div>
                            <div id="seller-collapseseven3" class="collapse" aria-labelledby="seller-headingseven3" data-parent="#seller-accordionExample7">
                              <div class="card-body">
                                We assure you that all our affiliates follow the necessary protocols, regulations, and guidelines when shipping, delivering, or dealing with your packages since we highly prioritize the health and safety of our customers and our affiliates. We thank you for your coordination!
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--end::Accordion-->
              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="col-lg-6">
        <div class="kt-portlet kt-portlet--height-fluid kt-sc-2">
          <div class="kt-portlet__body">
            <div class="kt-infobox kt-infobox--success">
              <div class="kt-infobox__header">
                <h2 class="kt-infobox__title  kt-font-md">Buyers FAQ</h2>
              </div>
              <div class="kt-infobox__body">

                <!--begin::Accordion-->
                <div class="accordion accordion-light accordion--no-bg accordion-svg-icon" id="accordionExample1">
                  <div class="card">
                    <div class="card-header" id="headingOne1">
                      <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                          </g>
                        </svg> Introduction
                      </div>
                    </div>
                    <div id="collapseOne1" class="collapse" aria-labelledby="headingOne1" data-parent="#accordionExample1" style="">
                      <div class="card-body kt-font-md kt-font-dark">
                        <div class="accordion accordion-light accordion-toggle-plus" id="accordionExample2">
                          <div class="card">
                            <div class="card-header" id="headingTwo1">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                                1. How can I contact the Customer Help Centre?
                              </div>
                            </div>
                            <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordionExample2" style="">
                              <div class="card-body">
                                If you have any inquiries, you can contact us via email at  <a href="mailto:info@jomlahbazar.com" class="kt-link">info@jomlahbazar.com</a> or by calling our Customer Care through one of our provided contact details or live chat.
                                If your inquiry is legal-related, you can contact us via email at  <a href="mailto:legal@jomlahbazar.com" class="kt-link">legal@jomlahbazar.com</a>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingTwo2">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                2.	What is JomlahBazar?
                              </div>
                            </div>
                            <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo2" data-parent="#accordionExample2">
                              <div class="card-body">
                                JomlahBazar is an E-Marketplace platform for wholesale sellers and buyers. It is a platform where regional and global brands and companies connect to the right consumers.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingTwo3">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo3" aria-expanded="false" aria-controls="collapseTwo3">
                                3.	What services does JomlahBazar offer?
                              </div>
                            </div>
                            <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo3" data-parent="#accordionExample2">
                              <div class="card-body">
                                Our services to you include providing:
                                <br>(a)	a Platform where You can buy wholesale products;
                                <br>(b)	an Account where You can display and modify Your personal or company information; and
                                <br>(c)	Payment gateway and shipping and delivery services as provided by Our Third-Party Service Providers.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingTwo4">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
                                4.	How can I start buying on JomlahBazar?
                              </div>
                            </div>
                            <div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo4" data-parent="#accordionExample2">
                              <div class="card-body">
                                Steps:
                                <br>1.	Register an account as a Buyer by entering your name, email address, and mobile number.
                                <br>2.	Enter the correct One-Time Password (OTP) sent to your mobile number.
                                <br>3.	Check your email to verify your account.
                                <br>4.	Once you have registered an account and uploaded necessary documents, you can start browsing our platform for any wholesale products you may be interested in.
                                <br>5.	After adding your selected products to your cart, you will be directed to the checkout page, where you can choose your preferred shipment and payment method.
                                <br>6.	Once you have entered your bank details and proceeded with the purchase, you should receive a confirmation email after the Seller has accepted your order.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingTwo5">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo5">
                                5.	What product categories are on JomlahBazar?
                              </div>
                            </div>
                            <div id="collapseTwo5" class="collapse" aria-labelledby="headingTwo5" data-parent="#accordionExample2">
                              <div class="card-body">
                                Currently, we have groceries, perfumes, beauty and makeup, and personal care. We are currently looking into expanding our product categories to cater to all your product needs.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingTwo6">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6" aria-expanded="false" aria-controls="collapseTwo6">
                                6.	Are the products listed on JomlahBazar genuine/authentic?
                              </div>
                            </div>
                            <div id="collapseTwo6" class="collapse" aria-labelledby="headingTwo6" data-parent="#accordionExample2">
                              <div class="card-body">
                                As part of our Terms and Conditions, we ensure that Sellers have the proper authorization to sell their products and that they are genuine and of high quality.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingTwo7">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo7" aria-expanded="false" aria-controls="collapseTwo7">
                                7.	What are my responsibilities as a Buyer?
                              </div>
                            </div>
                            <div id="collapseTwo7" class="collapse" aria-labelledby="headingTwo7" data-parent="#accordionExample2">
                              <div class="card-body">
                                To know your responsibilities as a Buyer, please read the <a href="<?php echo DIR_VIEW.DIR_CON;?>Conditions_of_use.php" class="kt-link">Terms and Conditions.</a>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingTwo8">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo8" aria-expanded="false" aria-controls="collapseTwo8">
                                8. Why should I create an account?
                              </div>
                            </div>
                            <div id="collapseTwo8" class="collapse" aria-labelledby="headingTwo8" data-parent="#accordionExample2">
                              <div class="card-body">
                                To make use of JomlahBazar's platforms and its features, creating an account would be necessary. It is the only way you can start buying within our Platforms.
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingOne2">
                      <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#collapseOne2" aria-expanded="false" aria-controls="collapseOne2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                          </g>
                        </svg> Managing Your Account
                      </div>
                    </div>
                    <div id="collapseOne2" class="collapse" aria-labelledby="headingOne2" data-parent="#accordionExample1" style="">
                      <div class="card-body kt-font-md kt-font-dark">
                        <div class="accordion accordion-light accordion-toggle-plus" id="accordionExample3">
                          <div class="card">
                            <div class="card-header" id="headingThree2">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">
                                1.	I have not received my email verification.
                              </div>
                            </div>
                            <div id="collapseThree2" class="collapse" aria-labelledby="headingThree2" data-parent="#accordionExample3">
                              <div class="card-body">
                                Make sure to check your spam folder just in case. If you still cannot activate or verify your account, you can email us at <a class="kt-link" href="mailto:info@jomlahbazar.com " class="kt-link">info@jomlahbazar.com </a> or contact our Customer Care through one of our provided contact numbers or live chat.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree3">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                2.	How can I change my account details?
                              </div>
                            </div>
                            <div id="collapseThree3" class="collapse" aria-labelledby="headingThree3" data-parent="#accordionExample3">
                              <div class="card-body">
                                If you want to change your account details, such as your username, email address, contact number, or password, you can log onto your account and select "Personal Account," where you can edit your details.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree4">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                                3.	How can I change my email preferences?
                              </div>
                            </div>
                            <div id="collapseThree4" class="collapse" aria-labelledby="headingThree4" data-parent="#accordionExample3">
                              <div class="card-body">
                                If you want to receive any promotional emails or notifications from JomlahBazar, you can log onto your account, go to the "Personal Account" section, and to the email alerts and messages section.
                                <br>If you do not want to receive any promotional emails or notifications from us, you can click the "unsubscribe" button located under our emails or manually turn off JomlahBazar notifications in your account or phone settings.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree5">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree5" aria-expanded="false" aria-controls="collapseThree5">
                                4.	How can I access my purchase history?
                              </div>
                            </div>
                            <div id="collapseThree5" class="collapse" aria-labelledby="headingThree5" data-parent="#accordionExample3">
                              <div class="card-body">
                                Your purchase history can be accessed by logging onto your account and clicking "Orders". This page will give you a record of all your current, previous, and cancelled orders.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree6">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false" aria-controls="collapseThree6">
                                5.	What do I do if my account has been hacked?
                              </div>
                            </div>
                            <div id="collapseThree6" class="collapse" aria-labelledby="headingThree6" data-parent="#accordionExample3">
                              <div class="card-body">
                                If your account has been compromised, contact us via email at <a href="mailto:info@jomlahbazar.com " class="kt-link">info@jomlahbazar.com </a> or call our Customer Care through one of our provided contact numbers or live chat.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree10">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree10" aria-expanded="false" aria-controls="collapseThree10">
                                6.	How do I report any issues or Intellectual Property infringement?
                              </div>
                            </div>
                            <div id="collapseThree10" class="collapse" aria-labelledby="headingThree10" data-parent="#accordionExample3">
                              <div class="card-body">
                                If you have any issues or matters relating to intellectual property infringement, contact us via email at <a href="mailto:legal@jomlahbazar.com." class="kt-link">legal@jomlahbazar.com. </a> or call our Customer Care through one of our provided contact numbers or live chat.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree7">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree7" aria-expanded="false" aria-controls="collapseThree7">
                                7.	How is my information protected?
                              </div>
                            </div>
                            <div id="collapseThree7" class="collapse" aria-labelledby="headingThree7" data-parent="#accordionExample3">
                              <div class="card-body">
                                To know more about how we handle your data and ensure its privacy and protection, read our <a href="<?php echo DIR_VIEW.DIR_CON;?>privacypolicy.php" class="kt-link">Privacy Policy. </a>.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree8">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree8" aria-expanded="false" aria-controls="collapseThree8">
                                8.	I want to delete my account.
                              </div>
                            </div>
                            <div id="collapseThree8" class="collapse" aria-labelledby="headingThree8" data-parent="#accordionExample3">
                              <div class="card-body">
                                If you want to deactivate your account, you will have to send an email to <a href="mailto:info@jomlahbazar.com" class="kt-link">  info@jomlahbazar.com  </a> or call Customer Care through one of our provided contact details or our live chat.
                                <br>Note that once you deactivate your account, you will lose access to the following:
                                <ul>
                                  <li>Your JomlahBazar account, including all your posts, comments, communications within our website, and your account history (i.e., purchase history).</li>
                                  <li>Returns or refunds.</li>
                                  <li>Any remaining vouchers, gift cards, or credit balance.</li>
                                </ul>
                                If you want to use JomlahBazar's services again, you will have to create a new account.
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingOne3">
                      <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="false" aria-controls="collapseOne3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                          </g>
                        </svg> Verification
                      </div>
                    </div>
                    <div id="collapseOne3" class="collapse" aria-labelledby="headingOne3" data-parent="#accordionExample1" style="">
                      <div class="card-body kt-font-md kt-font-dark">
                        <div class="accordion accordion-light accordion-toggle-plus" id="accordionExample4">
                          <div class="card">
                            <div class="card-header" id="headingFour1">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour1" aria-expanded="false" aria-controls="collapseFour1">
                                1.	What is a Verification Badge?
                              </div>
                            </div>
                            <div id="collapseFour1" class="collapse" aria-labelledby="headingFour1" data-parent="#accordionExample4" style="">
                              <div class="card-body">
                                A Verification Badge signifies that a seller has submitted the following documents to prove that they are a valid operating company:
                                <ul>
                                  <li>Valid trade license</li>
                                  <li>Bank details and statements</li>
                                  <li>VAT registration certificate</li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingOne4">
                      <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                            <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                          </g>
                        </svg>Ordering on JomlahBazar
                      </div>
                    </div>
                    <div id="collapseOne4" class="collapse" aria-labelledby="headingOne4" data-parent="#accordionExample1" style="">
                      <div class="card-body kt-font-md kt-font-dark">
                        <div class="accordion accordion-light accordion-toggle-plus" id="accordionExample5">
                          <div class="card">
                            <div class="card-header" id="headingFive1">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive1" aria-expanded="false" aria-controls="collapseFive1">
                                1.	How can I place an order?
                              </div>
                            </div>
                            <div id="collapseFive1" class="collapse" aria-labelledby="headingFive1" data-parent="#accordionExample5" style="">
                              <div class="card-body">
                                To place an order, choose any products you are interested in purchasing and select add to cart. Once you have finished browsing for products, go to your cart, which can be accessed by clicking the upper right cart button.
                                <br>This will redirect you to your cart, from where you will be given the different payment and shipping and delivery methods. After you have completed the order, you should receive a confirmation email once the Seller has accepted your order.
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingFive2">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive2" aria-expanded="false" aria-controls="collapseFive2">
                                2.	How do I pay for my order?
                              </div>
                            </div>
                            <div id="collapseFive2" class="collapse" aria-labelledby="headingFive2" data-parent="#accordionExample5">
                              <div class="card-body">
                                You can choose to either pay through JomlahBazar or directly to the Seller. <b>For payments through JomlahBazar, additional charges may apply depending on the payment method you select.</b>
                                <br>•	Paying through JomlahBazar *
                                <br>-	Credit/Debit Card (only available for UAE and GCC cards)
                                <br>-	Bank Transfer (bank transfer receipt must be uploaded on JomlahBazar)
                                <br>-	Cash-on-Delivery (COD) (only available in the UAE)
                                <br>- Cash-on-Pickup (COP) (only available in the UAE and will depend on seller)
                                <br>- JB Wallet
                                <br>•	Paying Seller directly:
                                <br>-	Will depend on the Buyer and Seller's agreement
                                </div>
                              </div>
                            </div>
                          <div class="card">
                            <div class="card-header" id="headingFive16">
                              <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive16" aria-expanded="false" aria-controls="collapseFive16">
                                3.	How do I upload the bank transfer receipt?
                              </div>
                            </div>
                            <div id="collapseFive16" class="collapse" aria-labelledby="headingFive16" data-parent="#accordionExample5">
                              <div class="card-body">
                                You can upload the bank transfer receipt by going to the specific order through your account. Once you have placed the order, you will have twenty-four (24) hours to upload the receipt. If you fail to upload the receipt on time, your order will be cancelled.
                                <br>If you upload the wrong bank receipt, we will reject the bank receipt uploaded and specify the reason and you will have another chance to upload the correct document within eight (8) hours. If you fail to upload the correct bank receipt after several attempts, we will cancel your order.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive3">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive3" aria-expanded="false" aria-controls="collapseFive3">
                                  4.	From whom will I receive my invoice?
                                </div>
                              </div>
                              <div id="collapseFive3" class="collapse" aria-labelledby="headingFive3" data-parent="#accordionExample5">
                                <div class="card-body">
                                  All tax invoices are provided by the respective sellers and upon the buyer’s request.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive4">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive4" aria-expanded="false" aria-controls="collapseFive4">
                                  5.	When do I receive my order confirmation email?
                                </div>
                              </div>
                              <div id="collapseFive4" class="collapse" aria-labelledby="headingFive4" data-parent="#accordionExample5">
                                <div class="card-body">
                                  You will receive the confirmation email for your order once the Seller accepts your order.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive5">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive5" aria-expanded="false" aria-controls="collapseFive5">
                                  6.	Seller modified my order.
                                </div>
                              </div>
                              <div id="collapseFive5" class="collapse" aria-labelledby="headingFive5" data-parent="#accordionExample5">
                                <div class="card-body">
                                  If a Seller modifies your order, you should receive an email giving you a choice to accept or reject your order's modification.
                                  <br>If you accept, the order shall be confirmed, and the Seller will receive a confirmation email. If you reject your order's modification, the order will be cancelled, and you will be refunded if necessary.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive6">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive6" aria-expanded="false" aria-controls="collapseFive6">
                                  7.	Can I make changes to my order?
                                </div>
                              </div>
                              <div id="collapseFive6" class="collapse" aria-labelledby="headingFive6" data-parent="#accordionExample5">
                                <div class="card-body">
                                  Yes, provided you have not completed the payment process yet. However, once you complete the payment process, the order cannot be changed or amended.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive7">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive7" aria-expanded="false" aria-controls="collapseFive7">
                                  8.	Can I cancel my order?
                                </div>
                              </div>
                              <div id="collapseFive7" class="collapse" aria-labelledby="headingFive7" data-parent="#accordionExample5">
                                <div class="card-body">
                                  Yes. However, you will not be able to cancel your order if it has already been shipped. If this is the case, you will have to request a return and refund instead, which you can raise through your account or by contacting our Customer Care through our provided contact details.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive8">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive8" aria-expanded="false" aria-controls="collapseFive8">
                                  9.	How will my orders be delivered?
                                </div>
                              </div>
                              <div id="collapseFive8" class="collapse" aria-labelledby="headingFive8" data-parent="#accordionExample5">
                                <div class="card-body">
                                  If both buyers and sellers are located inside the UAE, sellers may choose to deliver their own products or make use of JomlahBazar’s Delivery Services. If either the buyer or seller is located outside of the UAE, all deliveries will depend on the agreement between the buyer and the seller.
                                  <br>To know more about shipping and delivery, please click <a href="<?php echo DIR_VIEW.DIR_CON;?>delivery.php" class="kt link">here</a>.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive9">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive9" aria-expanded="false" aria-controls="collapseFive9">
                                  10.	Does JomlahBazar deliver outside UAE?
                                </div>
                              </div>
                              <div id="collapseFive9" class="collapse" aria-labelledby="headingFive9" data-parent="#accordionExample5">
                                <div class="card-body">
                                  Currently, JomlahBazar's Delivery Service is only available within the UAE. If either the buyer or seller is located outside of the UAE, all deliveries will depend on the agreement between the buyer and the seller.
                                  <br>However, JomlahBazar is working on improving our services. Thus, we are looking into expanding and reaching out to more international customers.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive10">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive10" aria-expanded="false" aria-controls="collapseFive10">
                                  11.	How can I track my order?
                                </div>
                              </div>
                              <div id="collapseFive10" class="collapse" aria-labelledby="headingFive10" data-parent="#accordionExample5">
                                <div class="card-body">
                                  For JomlahBazar deliveries, you can track your shipment using the Tracking Number provided once your order has been confirmed and entering it on our Third-Party Shipping Provider's website (https://emiratespost.ae/Portal/Home?locale=en-us).
                                  <br>For deliveries handled specifically by sellers, if you want to track your delivery, you can contact the Seller directly, who may either provide you with a tracking number and the specific courier company or provide you with updates.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive11">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive11" aria-expanded="false" aria-controls="collapseFive11">
                                  12.	My tracking information is not available.
                                </div>
                              </div>
                              <div id="collapseFive11" class="collapse" aria-labelledby="headingFive11" data-parent="#accordionExample5">
                                <div class="card-body">
                                  If your tracking information is not available, the Seller chose to handle the delivery themselves. It is advised that you contact the Seller directly, who may either provide you with a tracking number and the specific courier company or provide you with updates.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive12">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive12" aria-expanded="false" aria-controls="collapseFive12">
                                  13.	How long does it take to have my order delivered?
                                </div>
                              </div>
                              <div id="collapseFive12" class="collapse" aria-labelledby="headingFive12" data-parent="#accordionExample5">
                                <div class="card-body">
                                  For JomlahBazar deliveries, the estimated delivery time for your package will be one to three (1 – 3) days. For deliveries handled specifically by Sellers, estimated delivery time cannot be guaranteed as it will depend on the Seller, and their performance can vary.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive13">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive13" aria-expanded="false" aria-controls="collapseFive13">
                                  14.	There are delays with my delivery.
                                </div>
                              </div>
                              <div id="collapseFive13" class="collapse" aria-labelledby="headingFive13" data-parent="#accordionExample5">
                                <div class="card-body">
                                  If there are any delays with JomlahBazar deliveries, you can contact us through our provided contact details or contact our Third-Party Shipping Provider directly (https://emiratespost.ae/Portal/Info?locale=en-us&pageid=117).
                                  <br>As for deliveries handled by the Seller, you can directly contact the Seller whose contact details are provided on our platforms.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive14">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive14" aria-expanded="false" aria-controls="collapseFive14">
                                  15.	My order got cancelled. Why?
                                </div>
                              </div>
                              <div id="collapseFive14" class="collapse" aria-labelledby="headingFive14" data-parent="#accordionExample5">
                                <div class="card-body">
                                  Packages may sometimes be returned to us for the following reasons:
                                  <ul>
                                    <li>Wrong or incomplete address: if the address is not accurate or updated.</li>
                                    <li>Failed delivery attempts: if you could not accept the delivery for all attempts.</li>
                                    <li>Refused by recipient: if you reject the package.</li>
                                    <li>Damaged in transit: if the package/address label was damaged while it was out for shipping.</li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive15">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive15" aria-expanded="false" aria-controls="collapseFive15">
                                  16.	I keep receiving notifications about my order being incomplete.
                                </div>
                              </div>
                              <div id="collapseFive15" class="collapse" aria-labelledby="headingFive15" data-parent="#accordionExample5">
                                <div class="card-body">
                                  For COD and COP orders, sellers are required to update JomlahBazar once payment has been received and delivery was successful. If you receive notifications about your order being incomplete, it is likely that the seller may have not updated JomlahBazar yet.
                                  <br>If you have any more questions regarding this matter, you can contact us via email at <a href="mailto:info@jomlahbazar.com" class="kt-link">info@jomlahbazar.com</a> or by calling our Customer Care through one of our provided contact details or live chat.
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingFive17">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive17" aria-expanded="false" aria-controls="collapseFive17">
                                  17.	How can I order a previous purchase again?
                                </div>
                              </div>
                              <div id="collapseFive17" class="collapse" aria-labelledby="headingFive17" data-parent="#accordionExample5">
                                <div class="card-body">
                                  If you want to purchase a previous order again, you can go on your account and select "Orders." In this section, you will have access to your purchase history, and you can select "Buy Again" for the specific order.
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingOne5">
                        <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#collapseOne5" aria-expanded="false" aria-controls="collapseOne5">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24"></polygon>
                              <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                              <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                            </g>
                          </svg> Returns and Refunds
                        </div>
                      </div>
                      <div id="collapseOne5" class="collapse" aria-labelledby="headingOne5" data-parent="#accordionExample1" style="">
                        <div class="card-body kt-font-md kt-font-dark">
                          <div class="accordion accordion-light accordion-toggle-plus" id="accordionExample6">
                            <div class="card">
                              <div class="card-header" id="headingsix1">
                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapsesix1" aria-expanded="false" aria-controls="collapsesix1">
                                  1.	Can I return my purchase?
                                </div>
                              </div>
                              <div id="collapsesix1" class="collapse" aria-labelledby="headingsix1" data-parent="#accordionExample6" style="">
                                <div class="card-body">
                                  Yes, you can. Products can be returned within seven (7) days from when you received the order, provided they satisfy the eligibility requirements within our Return and Refund Policy, and the Seller approves. To know more, please visit our <a href="<?php echo DIR_VIEW.DIR_CON;?>privacypolicy.php" class="kt-link">Return and Refund Policy.</a>.
                                  <br>NOTE: JomlahBazar's Return and Refund Policy only applies if both the buyer and seller are located inside the UAE. Return and refunds will be subject to the buyer and seller's contractual terms and agreement if either the buyer or seller is located outside the UAE.
                                  </div>
                                </div>
                              </div>
                              <div class="card">
                                <div class="card-header" id="headingsix2">
                                  <div class="card-title collapsed" data-toggle="collapse" data-target="#collapsesix2" aria-expanded="false" aria-controls="collapsesix2">
                                    2.	How can I initiate a return?
                                  </div>
                                </div>
                                <div id="collapsesix2" class="collapse" aria-labelledby="headingsix2" data-parent="#accordionExample6">
                                  <div class="card-body">
                                    Returns can be initiated by initiating a request through your account or contacting Customer Care through one of our provided contact details or live chat. Once the return is received, refunds will be processed within seven to fourteen (7 - 14) business days.
                                  </div>
                                </div>
                              </div>
                              <div class="card">
                                <div class="card-header" id="headingsix3">
                                  <div class="card-title collapsed" data-toggle="collapse" data-target="#collapsesix3" aria-expanded="false" aria-controls="collapsesix3">
                                    3.	What can I return?
                                  </div>
                                </div>
                                <div id="collapsesix3" class="collapse" aria-labelledby="headingsix3" data-parent="#accordionExample6">
                                  <div class="card-body">
                                    As per JomlahBazar's Return and Refund Policy, you can only return your purchase if the item:
                                    <ul>
                                      <li>is new and unused;</li>
                                      <li>is in their original untouched packaging;</li>
                                      <li>includes all tag or factory seals (if any);</li>
                                      <li>has not been resized, damaged, or altered by the Buyer;</li>
                                      <li>is returned with all original documentation (if any) (e.g., certificate of authenticity); and</li>
                                      <li>does not belong to the listed non-refundable products and categories within our Return and Refund Policy.</li>
                                    </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-header" id="headingsix4">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapsesix4" aria-expanded="false" aria-controls="collapsesix4">
                                      4.	How will I be refunded?
                                    </div>
                                  </div>
                                  <div id="collapsesix4" class="collapse" aria-labelledby="headingsix4" data-parent="#accordionExample6">
                                    <div class="card-body">
                                      If your purchase is damaged, defective, or if you received the wrong product or a product different to its description or image, JomlahBazar will offer a refund of the total product amount, excluding shipping. If you have cancelled your order before shipping, you will be refunded immediately.
                                      <br>Once the return is received, refunds will be processed within seven to fourteen (7 – 14) business days and will be put into your JB wallet as credit. If you want the refund to be processed back to your credit/debit card or account, you can contact JomlahBazar's Customer Care to initiate a request.
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="card-header" id="headingsix5">
                                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapsesix5" aria-expanded="false" aria-controls="collapsesix5">
                                        5.	Does JomlahBazar provide repairs and replacements?
                                      </div>
                                    </div>
                                    <div id="collapsesix5" class="collapse" aria-labelledby="headingsix5" data-parent="#accordionExample6">
                                      <div class="card-body">
                                        Buyers can also request for repairs and replacements through their Account or by contacting our Customer Care. Note that repairs and replacements may depend on the product category and the availability of a warranty.
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingOne6">
                              <div class="card-title collapsed kt-font-md" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                    <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                                  </g>
                                </svg> COVID-19
                              </div>
                            </div>
                            <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample1" style="">
                              <div class="card-body kt-font-md kt-font-dark">
                                <div class="accordion accordion-light accordion-toggle-plus" id="accordionExample7">
                                  <div class="card">
                                    <div class="card-header" id="headingseven1">
                                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseseven1" aria-expanded="false" aria-controls="collapseseven1">
                                        1.	Is JomlahBazar accepting orders?
                                      </div>
                                    </div>
                                    <div id="collapseseven1" class="collapse" aria-labelledby="headingseven1" data-parent="#accordionExample7" style="">
                                      <div class="card-body">
                                        Yes. We ensure that deliveries are conducted in the safest manner by maintaining social distancing.
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card">
                                    <div class="card-header" id="headingseven2">
                                      <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseseven2" aria-expanded="false" aria-controls="collapseseven2">
                                        2.	Is JomlahBazar enforcing any protocols relating to COVID-19?
                                      </div>
                                    </div>
                                    <div id="collapseseven2" class="collapse" aria-labelledby="headingseven2" data-parent="#accordionExample7">
                                      <div class="card-body">
                                        We assure you that all our affiliates follow the necessary protocols, regulations, and guidelines when shipping, delivering, or dealing with your packages since we prioritize the health and safety of our customers and our affiliates. We thank you for your coordination!
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--end::Accordion-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:: Section -->
<!-- end:: Content -->
</div>

<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
