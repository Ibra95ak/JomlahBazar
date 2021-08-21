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
            <h2 class="kt-infobox__title kt-font-lg">Privacy Policy</h2>
          </div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                In JomlahBazar.com, We try Our best to ensure all the information provided concerning Our Platforms are used according to the relevant local and international privacy laws.<br>
                This Privacy Policy will apply to any use of information, including, but not limited to, name, contact details, address, credit card details, and IP address, concerning the services offered through JomlahBazar.com, operated by Pomechain DMCC registered in Dubai Multi Commodities Centre with the license number 768610, located at Mazaya Business Avenue, Office 2903, Building BB1, Jumeirah Lakes Towers, DMCC, Dubai in the United Arab Emirates ("<b>JomlahBazar</b>").<br>
                Please read the following terms and conditions carefully before proceeding with a transaction or interacting with JomlahBazar Platforms. Note that after You register an account as either a Buyer or a Seller, this Privacy Policy and Our Terms and Conditions will bind You with <b>immediate effect</b>.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">1 Definitions </h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                1.1 The following are the terminologies used within this Privacy Policy with specific meanings:
                <br>(a)	"<b>Privacy Policy</b>" refers to the collection and use of Your information within JomlahBazar Platforms according to the following clauses.
                <br>(b)	"<b>Terms and Conditions</b>" or “<b>Agreement</b>” refers to the Agreement governing Your use of JomlahBazar Platforms, which can be found on Buyer’s Terms and Conditions and Seller’s Terms and Conditions.
                <br>(c)	"<b>JomlahBazar</b>," "<b>Us</b>," “<b>Our</b>,” or "<b>We</b>" JomlahBazar.com, operated by Pomechain DMCC registered with the license number 768610, located at Mazaya Business Avenue, Office 2903, Building BB1, Jumeirah Lakes Towers, DMCC, Dubai in the United Arab Emirates.
                <br>(d)	"<b>Buyer</b>" refers to individuals, companies, or legal entities purchasing products on JomlahBazar Platforms.
                <br>(e)	"<b>Seller</b>" means suppliers or manufacturers offering and selling their products to Buyers on JomlahBazar Platforms.
                <br>(f)	"<b>Parties</b>" refers to Buyer and Seller collectively.
                <br>(g)	"<b>User</b>," "<b>You</b>," or “<b>Your</b>” means individuals, companies, or legal entities who can either be Buyers or Sellers using JomlahBazar Platforms.
                <br>(h)	“<b>Affiliates</b>” refers to Pomechain’s directors, employees, sub-contractors, and marketing affiliates.
                <br>(i)	"<b>Platform</b>" refers to JomlahBazar.com, Our mobile application, and any other tools or databases provided by JomlahBazar.
                <br>(j)	"<b>Content</b>" refers to any material You submit, post, or display on JomlahBazar Platforms, including, but not limited to, product prices, descriptions, specifications, comments, reviews, and communications.
                <br>(k)	"<b>Account</b>" refers to Your Seller or Buyer Account.
                <br>(l)	"<b>Third-party Service Providers</b>" such as online payment gateway, shipping, courier, and banking service providers.
                <br>(m)	"<b>Third-party Sites</b>" means Third-party Service Providers' website.
                <br>(n)	"<b>Cookies</b>" means information saved onto Your computer, which tracks Your visits and activities within JomlahBazar Platforms, allowing an enhanced experience in using Our services.
                Capitalized terms will follow the meanings given to them as per Clause 1.1.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">2 Information </h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                The following is a list of all the information We may collect and process from You regarding Your use or interaction with JomlahBazar Platforms:
                <br>2.1 <b>For individuals:</b>
                <br>(a)	Information You provide to verify Your identity and in answering Our online forms, like Your name, location, e-mail address, and contact details;
                <br>(b)	Information required for purchases, like credit card details and delivery information;
                <br>(c)	Information collected from using third-party services offered by JomlahBazar such as payment gateways including bank account and credit or debit card numbers, expiration dates and security codes; and
                <br><br>(d)	Public reviews or comments within JomlahBazar.
                <br>2.2 <b>For companies, legal entities, manufacturers, and suppliers:</b>
                <br>(a)	Information You provide to verify Your identity and in answering Our online forms, like Your company name, address, trade license, owner or manager’s Emirates ID or passport copy, VAT registration certificate, and bank details;
                <br>(b)	Information regarding the products You will sell; and
                <br>(c)	Product listings, including product descriptions and specifications.
                <br>2.3 <b>For all Users:</b>
                <br>(a)	Information regarding purchases or transactions within Our Platforms;
                <br>(b)	Information provided to Us regarding complaints or disputes;
                <br>(c)	Information You provide in filling up surveys;
                <br>(d)	Your activities and interactions within JomlahBazar Platforms;
                <br>(e)	Interactions and communications within JomlahBazar Platforms' comments and reviews sections; and
                <br>(f)	Correspondence in the event You contact Us.
                <br>2.4 We may also collect the following information purely for statistical purposes to further cater and understand what You are most interested in and to enhance Our quality of services:
                <br>(a)	Browser type;
                <br>(b)	Pages viewed;
                <br>(c)	Ads clicked;
                <br>(d)	Number of sessions;
                <br>(e)	IP address;
                <br>(f)	Devices You used to access JomlahBazar's Platforms;
                <br>(g)	Location (only country and city location); and
                <br>(h)	Any other information that may be relevant regarding how We can improve Our services within JomlahBazar Platforms.
                <br>2.5 Cookies. It should be noted that some of the information mentioned in Clause 2.4 may be collected through Cookies, which allows Us to improve Your experience in using JomlahBazar Platforms and Our services.
                <br>2.6 As for Our Mobile Application, You acknowledge that We may ask permission to access Your camera and microphone, which You have the right to allow or deny. If You want to stop giving access, You can change this in Your settings.
                <br>2.7 JomlahBazar uses the services of Google Analytics. To know more about how Google collects, process, and use data whenever you use our Platforms, please visit: <a class="kt-link" href="www.google.com/policies/privacy/partners/">www.google.com/policies/privacy/partners/</a>.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">3 Use of Information</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                3.1 The information mentioned in Clause 2 may be used to enhance Your experience in using JomlahBazar Platforms, such as:
                <br>(a)	setting up Your Account;
                <br>(b)	improving security and due diligence;
                <br>(c)	determining Your eligibility to use Our Platforms;
                <br>(d)	providing information or products that You could be interested in;
                <br>(e)	providing services such as advertising and search results which are based on Your location;
                <br>(f)	providing third party services;
                <br>(g)	facilitation of communication between Buyers and Sellers regarding transactions, settlements, and requests;
                <br>(h)	to provide a more efficient and smooth use of Our Platforms;
                <br>(i)	to notify You regarding any changes in Our services, Terms and Conditions, and Policies; and
                <br>(j)	any other reason necessary for enhancing Your use of Our Platforms.
                <br>3.2 Note that JomlahBazar may also use Your information for additional purposes considered legal under applicable data protection and privacy laws.
                <br>3.3 We mainly use Your personal information to accommodate the services We provide You, such as:
                <br>(a)	processing Your orders;
                <br>(b)	processing Your requests for returns and refunds; and
                <br>(c)	managing Your JomlahBazar Account.
                <br>3.4 In using Your personal information, JomlahBazar aims to personalize services according to Your needs and online browsing behavior, which can affect the marketing communications and online advertising We show You.
                <br>3.5 JomlahBazar may also use Your personal information to communicate to You:
                <br>(a)	any complaints or reviews You have submitted or directed to Us;
                <br>(b)	any promotions or competitions You participate in; and
                <br>(c)	any online surveys or questionnaires We are conducting for market research.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">4 Disclose of Information</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                4.1 Complying with applicable laws and regulations, JomlahBazar will disclose Your information to other Third-party Service Providers or partners working with Us who assist the services We provide to You and abides by this Privacy Policy. These Third-party Service Providers and partners include:
                <br>(a)	Our online payment gateway providers;
                <br>(b)	Our business partners;
                <br>(c)	Our banks;
                <br>(d)	Our supply chain finance partners;
                <br>(e)	logistics partners;
                <br>(f)	customs agents for customs duties purposes;
                <br>(g)	marketing and advertising platforms, like Google, Facebook, Twitter, and Instagram; and
                <br>(h)	analytics service providers assisting Us in enhancing Users' experience.
                <br>4.2 To comply with laws and regulations, as well as to protect JomlahBazar and Your rights, JomlahBazar may also disclose information to government and regulatory authorities, police, and Our professional legal advisers.
                <br>4.3 Regarding any mergers or acquisitions of any part of JomlahBazar, Our assets, including collected information from JomlahBazar Platforms, will be disclosed to a potential or actual buyer.
                <br>4.4 Provided You have consented, JomlahBazar may also disclose Your information to any other person or business.
                <br>4.5 JomlahBazar may also disclose anonymized information to third parties, which will not personally identify You.
                <br>4.6 You understand and agree that JomlahBazar must acquire and disclose such information mentioned above to conduct Our business and provide You with efficient services.
                <br>4.7 By creating an Account and using JomlahBazar Platforms, You consent to collecting, using, and disclosing Your information to Our Affiliates, partners, and Third-party Service Providers.
                <br>4.8 In guaranteeing Your data is safe, all Our Affiliates, partners, and Third-party Service Providers shall be obligated to protect Your information's confidentiality and shall not use them for any other purposes.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">5 Third-Party Sites</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                5.1 In providing third-party services, JomlahBazar may provide access to such services using hyperlinks or other means. You are responsible for reviewing the relevant third party's terms and conditions and privacy policy before submitting their information to their websites. Thus, You agree that JomlahBazar shall not be liable for the privacy and policies of Third-party Sites. You also agree that JomlahBazar's Privacy Policy do not apply to these Third-party Sites.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">6 Storing of Information</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                6.1 JomlahBazar will store the information We collect from You for as long as permitted by applicable laws and regulations and according to this Privacy Policy.
                <br>6.2 Note that JomlahBazar may also transfer or share Your information to Our Third-party Service Providers who may also store Your information to provide a more efficient and smooth service.
                <br>6.3 In agreeing to this Privacy Policy, You permit JomlahBazar to keep Your information and share it with Third-party Service Providers. You also agree that You cannot hold JomlahBazar liable for Third-party Sites' privacy policies as per Clause 5.1.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">7 Security Measures</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                Each product listed in JomlahBazar is sold by their relevant seller, supplier, or manufacturer specified on the product page.
                7.1 Ensuring Your data and information is secured is one of Our biggest priorities. Thus, We keep reasonable technical and physical measures to guarantee that Your data is protected against unauthorized access, disclosure, or destruction. This includes JomlahBazar's use of Google Cloud's services and encrypting Your data.
                <br>7.2 JomlahBazar ensures that only authorized employees, Affiliates, or Third-party Service Providers who will require Your information to conduct transactions and other services within Our Platforms can access Your data.
                <br>7.3 You also agree that You are responsible for maintaining the confidentiality and security of Your data, Account, and password.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">8 General Data Protection Regulation ("GDPR")</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                8.1 In ensuring Your data and information are protected, besides complying with applicable local and international laws and regulations, JomlahBazar also commits to abiding by the GDPR policy on strengthening security and regulation of data protection.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">9 Access to Information</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                9.1 In creating an account in JomlahBazar Platforms, You can access information relating to Your Account, such as:
                <br><b>For Buyers:</b>
                <br>(a)	personal information like name, e-mail, personalized communications, and advertising preferences;
                <br>(b)	recent and previous orders;
                <br>(c)	payment details like Your saved credit card and previously used payment methods; and
                <br>(d)	e-mail notification settings.
                <br><b>For Sellers:</b>
                <br>(a)	company information like trade name, contact details, communications, etc.;
                <br>(b)	all Your transactions; and
                <br>(c)	company bank details.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">10 Amending Account Information and Preferences</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                10.1 If You want to stop receiving marketing e-mail communications from JomlahBazar, You can modify Your communication preferences by selecting the unsubscribe link located below all Our e-mail communications.
                <br>10.2 If You want to disable Cookies from JomlahBazar, You can adjust the settings on Your browser. Note that Cookies allow JomlahBazar to provide You with a personalized and enhanced experience in using Our Platforms. Thus, disabling Cookies may lead to You losing access to certain sections of Our Platforms or from certain services.
                <br>10.3 Note that JomlahBazar will retain a copy of all previous versions of Your information for Our record.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">11 Privacy Policy Amendments</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                11.1 JomlahBazar is entitled to change this Privacy Policy at any time. We may e-mail You about any of the changes. However, We still advise You to check JomlahBazar's Privacy Policy frequently for any recent changes.
                <br>11.2 By continuing to use JomlahBazar's services, You will be deemed to have accepted the changes made in this Privacy Policy, and they will bind You with <b>immediate effect</b> as soon as the updated Privacy Policy is posted on Our Platforms.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">12 Contact Us</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                12.1 If You have any questions or issues to raise regarding Our Privacy Policy, please contact Us at <a class="kt-link" href="mailto:legal@pomechain.com">legal@pomechain.com</a>.
              </div>
            </div>
          </div>
          <div class="kt-space-10"></div>
          <div class="kt-infobox__body">
            <div class="kt-infobox__section">
              <h3 class="kt-infobox__subtitle kt-font-md kt-font-bolder">Closing</h3>
              <div class="kt-infobox__content kt-font-md kt-font-dark">
                JomlahBazar considers the data and information of Our website users to be one of Our critical assets. However, information and data on the internet are not entirely secure. Despite Our efforts to ensure that such data will be protected, We cannot guarantee that the data transmitted to Our website will be fully protected. Thus, it is essential to remind You that any data You submit or share within Our Platforms will be at Your own risk.
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
