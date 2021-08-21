<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if (isset($_SESSION['userId'])) {
  $res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
  $usr = json_decode($res_uid->getBody());
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
  include("../" . DIR_CON . "guestheader.php");
}/*Get page header*/
?>
<!-- begin:: Content -->
<!-- end:: Header -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

  <!-- begin:: Content -->
  <div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <!-- begin:: Section -->
    <div class="kt-container ">
      <div class="kt-portlet">
        <div class="kt-portlet__body">
          <div class="kt-infobox">
            <div class="kt-infobox__body">
              <h1 class="kt-font-lg kt-font-turquoise kt-font-bolder text-center">Online Wholesale Market for UAE & B2B Globally.</h1>
              <div class="kt-infobox__section">
                <div class="kt-infobox__content">
                  <img src="<?php echo DIR_ROOT . DIR_MED . 'bg/helpcenter1.png' ?>" alt="" width="100%">
                </div>
              </div>
              <div class="row safari-row-flex">
                <div class="col-md-6 kt-mt-50">
                  <div class="kt-infobox__section">
                    <div class="kt-infobox__content">
                      <span class="kt-font-dark kt-font-md kt-ml-5">Easy access to sellers and products of the Dubai Bazar Market</span>
                      <div class="kt-m30">
                        <a href="<?php echo DIR_VIEW . DIR_USR . "login.php" ?>" class="btn btn-warning btn-lg btn-wider kt-pt7">Register With Us</a>
                        <a href="<?php echo DIR_VIEW . DIR_PRO . "marketplace.php?ftbs=1" ?>" class="btn btn-light btn-lg btn-wider kt-pt7 mobile-btn-h60">Go to eMarketplace</a>
                      </div>
                      <span class="kt-font-dark kt-font-md kt-ml-5">Transparent, Secure and Simple. No Credit Card Required.</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <img src="<?php echo DIR_ROOT.DIR_MED . DIR_VID . "supplychain.gif"; ?>" alt="" width="100%" height="auto"/>
                </div>
              </div>
              <div class="kt-space-70"></div>
              <div class="kt-infobox__section">
                <h1 class="kt-font-lg kt-font-warning kt-font-bolder kt-font-center kt-mb-20">Why Choose JomlahBazar?</h1>
                <div class="kt-infobox__content alert-dark kt-p10">
                  <h1 class="kt-font-md kt-font-dark kt-font-center kt-font-bolder kt-mb-20">For Buyers</h1>
                  <div class="kt-pricing-1 kt-pricing-1--fixed">
                    <div class="kt-pricing-1__items row safari-row-flex">
                      <div class="kt-pricing-1__item col-lg-3 kt-font-center">
                        <div class="kt-pricing-1__visual kt-mb-10">
                          <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/lowest-prices.png' ?>"  alt="">
                        </div>
                        <h2 class="kt-font-md kt-font-dark">Lowest Prices</h2>
                      </div>
                      <div class="kt-pricing-1__item col-lg-3 kt-font-center">
                        <div class="kt-pricing-1__visual kt-mb-10">
                          <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/wide-selection.png' ?>"  alt="">
                        </div>
                        <h2 class="kt-font-md kt-font-dark">Wide Selection</h2>
                      </div>
                      <div class="kt-pricing-1__item col-lg-3 kt-font-center">
                        <div class="kt-pricing-1__visual kt-mb-10">
                          <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/fast-Delivery.png' ?>" alt="">
                        </div>
                        <h2 class="kt-font-md kt-font-dark">Fast Delivery</h2>
                      </div>
                      <div class="kt-pricing-1__item col-lg-3 kt-font-center">
                        <div class="kt-pricing-1__visual kt-mb-10">
                          <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/connect-sellers.png' ?>"  alt="">
                        </div>
                        <h2 class="kt-font-md kt-font-dark">Connection and Negotiation with Sellers</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="kt-space-70"></div>
              <div class="kt-infobox__section">
                <div class="kt-infobox__content alert-dark kt-p10">
                  <h1 class="kt-font-md kt-font-dark kt-font-center kt-font-bolder kt-mb-20">For Sellers</h1>
                  <div class="kt-pricing-1 kt-pricing-1--fixed">
                    <div class="kt-pricing-1__items row safari-row-flex">
                      <div class="kt-pricing-1__item col-lg-3 kt-font-center">
                        <div class="kt-pricing-1__visual kt-mb-10">
                          <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/free-listing.png' ?>"  alt="">
                        </div>
                        <h2 class="kt-font-md kt-font-dark">Easy Business & Free Listing</h2>
                      </div>
                      <div class="kt-pricing-1__item col-lg-3 kt-font-center">
                        <div class="kt-pricing-1__visual kt-mb-10">
                          <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/peace-mind.png' ?>"  alt="">
                        </div>
                        <h2 class="kt-font-md kt-font-dark">Peace Of Mind</h2>
                      </div>
                      <div class="kt-pricing-1__item col-lg-3 kt-font-center">
                        <div class="kt-pricing-1__visual kt-mb-10">
                          <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/better-visibility.png' ?>"  alt="">
                        </div>
                        <h2 class="kt-font-md kt-font-dark">Better Visibility</h2>
                      </div>
                      <div class="kt-pricing-1__item col-lg-3 kt-font-center">
                        <div class="kt-pricing-1__visual kt-mb-10">
                          <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/connect-buyers.png' ?>"  alt="">
                        </div>
                        <h2 class="kt-font-md kt-font-dark">Connection With Buyers</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="kt-space-90"></div>
              <div class="kt-infobox__section">
                <div class="kt-infobox__content">
                  <div class="row safari-row-flex">
                    <div class="col-md-6" style="text-align: center; margin-top: -80px">
                      <img src="<?php echo DIR_ROOT . DIR_MED . DIR_CON.'uaelocalmarket.png' ?>" alt="" class="height-400" width="100%">
                    </div>
                        <div class="col-md-6">
                          <h3 class="kt-font-lg kt-font-warning kt-font-bolder">Who We Are</h3>
                          <span class="kt-font-dark">JomlahBazar is a wholesale eMarketplace, catering to both Business to Business and individual bulk buyers from inside and outside UAE. We are a digital platform where buyers from different parts of the world can connect and build relationship directly with wholesale sellers, manufacturers and distributors. This platform is where your business can gain access to a more secure and open digital shopping world. <br><br>
                          If you have any questions, please <a href="mailto:info@jomlahbazar.com" class="kt-link">Contact Us</a></span> 
                        </div>
                  </div>
                  <div class="kt-space-10"></div>
                </div>
              </div>


              <div class="kt-infobox__section">
                <div class="row safari-row-flex">
                  <div class="col-md-6">
                    <h3 class="kt-font-lg kt-font-warning kt-font-bolder">JomlahBazar Benefits</h3>
                    <p class="kt-font-md kt-font-dark">Joining JomlahBazar gives sellers access to new markets both in domestic and global trades, and buyers an avenue to expand their business' potential for lowest prices:</p>
                    <div class="kt-sc-faq-3 kt-sc-faq-3--accordion div-center">
                        <div class="accordion accordion-solid accordion-panel accordion-toggle-svg" id="accordionExample8">
    										<div class="card">
    											<div class="card-header" id="headingOne8">
    												<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne8" aria-expanded="false" aria-controls="collapseOne8">
    													Convenient online communication channels for negotiations and trade<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
      												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      													<polygon points="0 0 24 0 24 24 0 24"></polygon>
      													<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
      													<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
      												</g>
      											</svg>
                            </div>
    											</div>
    											<div id="collapseOne8" class="collapse" aria-labelledby="headingOne8" data-parent="#accordionExample8" style="">
    												<div class="card-body">
                              Communication channels for both buyers and sellers are all transparently published and integrated in the website creating an easy transaction.
    												</div>
    											</div>
    										</div>
    										<div class="card">
    											<div class="card-header" id="headingTwo8">
    												<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo8" aria-expanded="false" aria-controls="collapseTwo8">
    													Verification of potential buyers’ and sellers’ identity for client security<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
      												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      													<polygon points="0 0 24 0 24 24 0 24"></polygon>
      													<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
      													<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
      												</g>
      											</svg>
                            </div>
    											</div>
    											<div id="collapseTwo8" class="collapse" aria-labelledby="headingTwo8" data-parent="#accordionExample8" style="">
    												<div class="card-body">
                              to maintain a secure and credible environment for transactions and negotiations , both buyers and sellers has the option to verify and rate each other.
    												</div>
    											</div>
    										</div>
    										<div class="card">
    											<div class="card-header" id="headingThree8">
    												<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree8" aria-expanded="false" aria-controls="collapseThree8">
    													A transparent platform that prioritizes service for all its stakeholders<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
      												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      													<polygon points="0 0 24 0 24 24 0 24"></polygon>
      													<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
      													<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
      												</g>
      											</svg>
                            </div>
    											</div>
    											<div id="collapseThree8" class="collapse" aria-labelledby="headingThree8" data-parent="#accordionExample8">
    												<div class="card-body">
                              JomlahBazar's promise is to cater to all stakeholders, may it be our buyers, sellers or third party partners. This ties up with our vision of being the most preferred e-Marketplace one day.
    												</div>
    											</div>
    										</div>
    										<div class="card">
    											<div class="card-header" id="headingFour8">
    												<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour8" aria-expanded="false" aria-controls="collapseFour8">
    													Access to a variety of sellers with a long history of business in traditional bazaar<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
      												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      													<polygon points="0 0 24 0 24 24 0 24"></polygon>
      													<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
      													<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
      												</g>
      											</svg>
                            </div>
    											</div>
    											<div id="collapseFour8" class="collapse" aria-labelledby="headingFour8" data-parent="#accordionExample8">
    												<div class="card-body">
                              JomlahBazar carefully chooses the sellers to on-board based on tedious selection to ensure that the buyer will get the lowest prices and the best deals from the market.
    												</div>
    											</div>
    										</div>
    										<div class="card">
    											<div class="card-header" id="headingFive8">
    												<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive8" aria-expanded="false" aria-controls="collapseFive8">
    													Provides better options in the B2B market & offers beneficial partnerships <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
      												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
      													<polygon points="0 0 24 0 24 24 0 24"></polygon>
      													<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
      													<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
      												</g>
      											</svg>
                            </div>
    											</div>
    											<div id="collapseFive8" class="collapse" aria-labelledby="headingFive8" data-parent="#accordionExample8">
    												<div class="card-body">
                              Buyers will be connected with wide array of sellers and products and sellers on the other hand are also exposed to over 5,000 SME consumers.
    												</div>
    											</div>
    										</div>
    									</div>
                      <div class="kt-space-10"></div>
                    </div>
                  </div>
                  <div class="col-md-6" style="text-align: center;">
                    <img src="<?php echo DIR_ROOT . DIR_MED . DIR_CON.'internationalmarket.png' ?>" alt="" class="height-400" width="100%">
                  </div>
                </div>
                <div class="kt-space-10"></div>
              </div>

              <div class="row text-center safari-row-flex">
                <div class="col-md-12 kt-font-center">
                  <h2 class="kt-font-lg">As featured in</h2>
                </div>
                <div class="col-md-4">
                      <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/featured1.png' ?>" alt="" class="featured_img">
                </div>
                <div class="col-md-4">
                      <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/zawya-logo-en-social.png' ?>" alt="" class="featured_img">
                </div>
                <div class="col-md-4">
                     <img src="<?php echo DIR_ROOT . DIR_MED . 'icons/featured2.png' ?>" class="featured_img">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end:: Section -->

  </div>

  <!-- end:: Content -->
</div>

<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script type="text/javascript">
  $('.owl-carousel1').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    items: 1
  });
</script>
