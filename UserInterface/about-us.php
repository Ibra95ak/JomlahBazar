<?php
include("header.php");
/*Fetch latest products through API*/
$API_aboutus = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Aboutus.php");
$aboutus = json_decode($API_aboutus);
?>
<div class="container">
  <div class="row">
    <div class="about-us">
      <div class="container">
        <div class="our-story">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="our-story_text">
                <h1 class="title orange-underline">About Us</h1>
                <p><?php echo $aboutus[0]->aboutus;?></p>
              </div>
            </div>
            <div class="col-lg-6 col-md-12"> <img src="assets/images/about-img.jpg" class="img-fluid" alt="" title=""> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<div class="counter-section">
  <div class="container">
    <div class="row" id="counter">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="counter">
          <div class="text-center"><img src="assets/images/customer-icon.png" alt="" title="" class="img-fluid"></div>
          <h2 class="counter-value" data-count="10">0</h2>
          <p class="count-text ">Our Customer</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="counter">
          <div class="text-center"><img src="assets/images/customer-icon2.png" alt="" title="" class="img-fluid"></div>
          <h2 class="counter-value" data-count="25">0</h2>
          <p class="count-text ">Happy Clients</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="counter">
          <div class="text-center"><img src="assets/images/customer-icon3.png" alt="" title="" class="img-fluid"></div>
          <h2 class="counter-value" data-count="150">0</h2>
          <p class="count-text ">Project Complete</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="counter">
          <div class="text-center"><img src="assets/images/customer-icon4.png" alt="" title="" class="img-fluid"></div>
          <h2 class="counter-value" data-count="100">0</h2>
          <p class="count-text">Coffee With Clients</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="why-choose">
  <h2>Why Choose Us</h2>
  <div class="clearfix"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="row">
          <div class="col-lg-6 col-md-6 mb-4">
            <div class="icon-detail"><img src="assets/images/dow_icon_1.png" class="img-fluid" alt="">
              <h5>High Quality Service</h5>
              <p>Lorem Ipsum is simply dummy text of the printing</p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 mb-4">
            <div class="icon-detail"><img src="assets/images/dow_icon_2.png" alt="">
              <h5>Flexibility</h5>
              <p>Lorem Ipsum is simply dummy text of the printing</p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 mb-4">
            <div class="icon-detail"><img src="assets/images/dow_icon_3.png" alt="">
              <h5>Reliable Consistent Supply</h5>
              <p>Lorem Ipsum is simply dummy text of the printing</p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 mb-4">
            <div class="icon-detail"><img src="assets/images/dow_icon_4.png" alt="">
              <h5>Customer Planning and Management</h5>
              <p>Lorem Ipsum is simply dummy text of the printing</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div><img src="assets/images/page-img/why-choose.jpg"  title="" alt="" class="img-fluid" ></div>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<?php
include("footer.php");
?>