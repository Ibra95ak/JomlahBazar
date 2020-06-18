<?php
include("header.php");
$supplierId=$_GET['supplierId'];
$API_reachout = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Supplier_Reachout.php?supplierId=$supplierId");
$reachout = json_decode($API_reachout);
?>
<div class="container mb-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb2">
      <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li class="breadcrumb-item">Supplier</li>
    </ol>
  </nav>
  <div >
    <div class="account-dashboard">
        <div class="row">
        <div class="col-md-12 col-lg-2">
          <!-- Nav tabs -->
          <ul role="tablist" class="nav flex-column dashboard-list">
            <li><a href="#dashboard" data-toggle="tab" class="active">Products</a></li>
            <li> <a href="#orders" data-toggle="tab">Stores</a></li>
            <li><a href="#address" data-toggle="tab">Addresses</a></li>
            <li><a href="#account-details" data-toggle="tab" >Reach Out</a></li>
            <li><a href="login.php">logout</a></li>
          </ul>
        </div>
        <div class="col-md-12 col-lg-10">
          <!-- Tab panes -->
          <div class="tab-content dashboard-content">
            <div class="tab-pane active" id="dashboard">
              <h3>Products </h3>
              <div class="row">
                 <?php
/*Fetch latest products through API*/
$API_products = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Supplier_Products.php?supplierId=$supplierId");
$products = json_decode($API_products);
if($products){
  foreach($products as $product){
    $API_product_img = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_ProductImage.php?productId=".$product->productId);
    $product_img = json_decode($API_product_img);
    echo '<div class="col-lg-3 col-md-4 col-sm-6 product-card-col">';
    echo '<div class="product product-card">';
    foreach($product_img as $img)
    echo '<a class="product-img" href="single_product.php?productId='.$product->productId.'"><img src="../AdminPanel/pics/'.$img[0].'" alt=""></a>';
    echo '<h2><a><span class="product-title">'.$product->name.'</span></a></h2>';
    echo '<div class="row m-0 list-n">';
    echo '<div class="col-lg-12 p-0">';
    echo '<div class="single-product-price">';
    echo '<span class="a-price" data-a-size="l" data-a-color="base"><span class="price-dollar">$</span><span class="price-digit">'.$product->unitprice.'</span><span class="price-fraction"></span></span>';
    echo '</div></div></div></div></div>';
}
}
?>
              </div>
            </div>
            <div class="tab-pane fade" id="orders">
              <h3>Stores</h3>
              <div class="table-responsive">
                <table class="table boder-b">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Description</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
/*Fetch supplier stores through API*/
$API_supplierstores = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Supplier_Stores.php?supplierId=$supplierId");
$supplierstores = json_decode($API_supplierstores);
if($supplierstores){
  foreach($supplierstores as $supplierstore){
      echo '<tr>';
      echo '<td>'.$supplierstore[1].'</td>';
      echo '<td>'.$supplierstore[2].'</td>';
      echo '<td>'.$supplierstore[3].'</td>';
      echo '<td><a href="store-details.php?storeId='.$supplierstore[0].'" class="view">view</a></td>';
      echo '</tr>';
  }
}

?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="address">
              <p>The following addresses will be used on the checkout page by default.</p>
              <h4 class="billing-address">Billing address</h4>
              <div class="row">
<?php
/*Fetch supplier stores through API*/
$API_supplieraddresses = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Supplier_Addresses.php?supplierId=$supplierId");
$supplieraddresses = json_decode($API_supplieraddresses);
if($supplieraddresses){
      echo '<div class="col-md-4"><div class="address-1">';
      echo '<p class="biller-name"><strong>'.$supplieraddresses->city.'</strong></p>';
      echo '<address><small>'.$supplieraddresses->address1.'<br>'.$supplieraddresses->address2.'</small> </address>';
      echo '</div></div>';
}
?>
              </div>

            </div>
            <div class="tab-pane fade" id="account-details">
              <h3>Account details </h3>
              <div class="login m-0">
                <div class="login-form-container">
                  <div class="account-login-form">
                    <a class="dropdown-toggle link" href="tel:00971509692636"><i class="fa fa-phone" aria-hidden="true"></i></a>
                    <a class="dropdown-toggle link" href="https://wa.me/1XXXXXXXXXX?text=I'm%20interested%20in%20your%20products"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    <a class="dropdown-toggle link" href="https://m.me/ibrahim.abokhalil.7" data-toggle="dropdown"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a class="dropdown-toggle link" href="" data-toggle="dropdown"><i class="fa fa-telegram" aria-hidden="true"></i></a>
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


<div class="clearfix"></div>
<div id="newsletter">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h4>Join Our Newsletter Now</h4>
        <p class="m-0">Get E-mail updates about our latest shop and special offers.</p>
      </div>
      <div class="col-md-5">
        <form action="/" method="post" id="subsForm" onSubmit="return ajaxmailsubscribe();">
        <div class="input-group">
          <input type="email" name="subsemail" id="subsemail" class="form-control newsletter" placeholder="Enter your mail">
          <span class="input-group-btn">
          <button class="btn btn-theme" type="button" onClick="return ajaxmailsubscribe();">Subscribe</button>
          </span> </div>
          </form>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<div class="container py-5">
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 address wow fadeInLeft">
      <a class="" href="index.html">
        <h5>JomlaBazar</h5>
      </a>
      <p>Address: 123-45 Road 11378 Manchester</p>
      <p>Phone: +12 3456 78901</p>
      <p>Email: <a href="mailto:info.jomlabazare@gmail.com">info.jomlabazar@gmail.com</a></p>
      <ul class="social-2">
        <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#" title="instagram +"><i class="fa fa-instagram"></i></a></li>
        <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#" title="Linkedin"><i class="fa fa-pinterest"></i></a></li>
      </ul>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 footer-link wow fadeInLeft">
      <h3>Information</h3>
      <ul>
        <li><a href="about-us.html">About Us</a></li>
        <li><a href="faq.html">FAQ</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="shop.html">Shop</a></li>
      </ul>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 footer-link wow fadeInLeft">
      <h3>My Account</h3>
      <ul>
        <li><a href="my-account.html">My Account</a></li>
        <li><a href="login.html">login</a></li>
        <li><a href="wishlist.html">Wishlist</a></li>
        <li><a href="register.html">Register</a></li>
      </ul>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6 footer-link wow fadeInLeft">
      <h3>Quick Shop</h3>
      <ul>
        <li><a href="cart.html">Cart</a></li>
        <li><a href="wishlist.html">Wishlist</a></li>
        <li><a href="comingsoon.html">Coming Soon</a></li>
        <li><a href="404.html">404</a></li>
      </ul>
    </div>
  </div>
</div>
<footer class="py-4 bg-dark">
  <div class="container copy-right">
    <div class="row">
      <div class="col-md-6 text-white"> Copyright © 2020 <a href="">JomlaBazar </a>- All Rights Reserved. </div>
      <div class="col-md-6 payment">
        <div class="pull-right"> <a href=""><img src="assets/images/skrill.png" alt="" title=""></a> <a href=""><img src="assets/images/ob.png" alt="" title=""></a> <a href=""><img src="assets/images/paypal.png" alt="" title=""></a> <a href=""><img src="assets/images/am.png" alt="" title=""></a> <a href=""><img src="assets/images/mr.png" alt="" title=""></a> <a href=""><img src="assets/images/visa.png" alt="" title=""></a> </div>
      </div>
    </div>
  </div>
</footer>
<!-- Footer -->


<p data-toggle="modal" class="no-margin" data-target="#myModal" id="model2"></p>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content text-center">
      <div class="modal-body modal-body2">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p><img src="assets/images/success.svg" width="50"></p>
        <h3 class="modal-title">Thank you</h3>
        <h4 class="thanks mt-2">Your submission is recevied and we will contact you soon.</h4>
        <a href="https://themeforest.net/item/organic-store-multipurpose-ecommerce-bootstrap-html5-template/23986984" target="_blank" class="btn add-to-cart2 d-inline-block font-15 rounded">BUY THIS TEMPLATE NOW</a> <a href="index.html" class="back-to-home d-block small mt-2"><i class="fa fa-long-arrow-left"></i> BACK TO HOME</a> </div>
    </div>
  </div>
</div>

<script src="assets/js/ajax.js"></script>
<script src="assets/js/formValidation.js"></script>
<script src="assets/vendor/jquery/custom-select.js"></script>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<!--bootstrap-->
<script src="assets/vendor/bootstrap/js/popper.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--bootstrap-->
<script src="assets/vendor/wow/wow.js"></script>
<script src="assets/vendor/wow/page.js"></script>
</body>
</html>
