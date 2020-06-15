<?php
include('../AdminPanel/libraries/base.php');
include("header.php");
?>
<div class="container">
  <div class="row">
    <div class="col-12 col-xl-8 mb-4">
      <div class="table-responsive cart-table table-borderless">
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">Product</th>
              <th class="text-center">&nbsp;</th>
              <th class="text-center">Price</th>
              <th class="text-center">Quantity</th>
              <th>Total</th>
              <th> </th>
            </tr>
          </thead>
          <tbody>
<?php
/*Fetch latest products through API*/
$API_cart = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Cart.php?userId=1");
$cart = json_decode($API_cart);
if($cart){
  $totalprice=0;
    foreach($cart as $product){
        echo '<tr>';
        echo '<td align="left"><input  type="checkbox"></td>';
        $API_product_img = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_ProductImage.php?productId=".$product->productId);
        $product_img = json_decode($API_product_img);
        foreach($product_img as $img){
            echo '<td class="product-thumbnail"><a href=""><img  width="100" src="../AdminPanel/pics/'.$img[0].'" class="" alt=""></a></td>';
        }
        echo '<td><a href="single_product.php?productId='.$product->productId.'">'.$product->name.'</a></td>';
        echo '<td class="text-center">'.$product->unitprice.'</td>';
        echo '<td class="product-quantity" data-title="Quantity"><div class="input-group">';
        echo '<span class="input-group-btn"><button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quantity"> <i class="fa fa-minus"></i> </button></span>';
        echo '<input type="text" name="quantity" class="form-control input-number" value="'.$product->quantity.'" min="0" max="10">';
        echo '<span class="input-group-btn"><button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quantity"> <i class="fa fa-plus"></i> </button></span>';
        echo '</div></td>';
        echo '<td>'.$product->unitprice*$product->quantity.'</td>';
        echo '<td><a href="#" onclick="deletecart('.$product->cartId.')"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
        echo '</tr>';
        $totalprice+=$product->unitprice*$product->quantity;
    }
}
?>
         </tbody>
        </table>
      </div>
    </div>
    <div class="col-12 col-xl-4 mb-5">
      <div class="cart_totals">
        <div class="table-responsive">
          <table cellspacing="0" class="table table-borderless mb-0">
            <tbody>
              <tr class="cart-subtotal">
                <td>Subtotal</td>
                <td class="text-right">$20.00</td>
              </tr>
              <tr class="shipping">
                <td colspan="2" align="left" class="mb-0 pb-0"><h5 class="m-0 p-0">Shipping</h5></td>
              </tr>
              <tr>
                <td class="flat-rate"><h5>Flat rate:</h5></td>
                <td class="text-right amount">$20.00</td>
              </tr>
              <tr class="order-total">
                <td><h5>Total</h5></td>
                <td align="right">$<?php echo $totalprice;?></td>
              </tr>
            </tbody>
          </table>
          <a href="checkout.html" class="btn cart w-100"> Proceed to checkout</a> </div>
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
      <p><img src="assets/images/logo.png" alt="" title="" class="img-fluid"></p>
      <p>Address: 123-45 Road 11378 Manchester</p>
      <p>Phone: +12 3456 78901</p>
      <p>Email: <a href="mailto:info.organicstore@gmail.com">info.organicstore@gmail.com</a></p>
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
        <li><a href="contact.html">Contact</a></li>
        <li><a href="login.html">Login</a></li>
        <li><a href="register.html">Register</a></li>
      </ul>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 footer-link wow fadeInLeft">
      <h3>My Account</h3>
      <ul>
        <li><a href="my-account.html">My Account</a></li>
        <li><a href="single_product.html">Contact</a></li>
        <li><a href="cart.html">Shopping Cart</a></li>
        <li><a href="shop.html">Shop</a></li>
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
      <div class="col-md-6 text-white"> Copyright © 2020 <a href="">Organic Store </a>- All Rights Reserved. </div>
      <div class="col-md-6 payment">
        <div class="pull-right"> <a href=""><img src="assets/images/skrill.png" alt="" title=""></a> <a href=""><img src="assets/images/ob.png" alt="" title=""></a> <a href=""><img src="assets/images/paypal.png" alt="" title=""></a> <a href=""><img src="assets/images/am.png" alt="" title=""></a> <a href=""><img src="assets/images/mr.png" alt="" title=""></a> <a href=""><img src="assets/images/visa.png" alt="" title=""></a> </div>
      </div>
    </div>
  </div>
</footer>


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

<script src="assets/vendor/jquery/jquery.min.js"></script>
<!--bootstrap-->
<script src="assets/vendor/bootstrap/js/popper.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--bootstrap-->
<script src="assets/vendor/wow/wow.js"></script>
<script src="assets/vendor/wow/page.js"></script>
<script src="assets/vendor/jquery/number-plsu-min.js" type="text/javascript"></script>
<script src="assets/vendor/jquery/custom-select.js"></script>
<script>
function deletecart(cartId){
  $.ajax({
        type: "GET",
        url: "http://localhost/JomlahBazar/AdminPanel/controllers/client/CON_Delete_Cart.php?cartId="+cartId,
        dataType: "json",
        success: function(data) {
            switch(data) {
              case 0:
               alert("Product is Removed from Cart.");
                break;
              case 1:
                alert("Error deleting.");
                break;
              default:
                alert("Error");
            }
            location.reload();
        }
    });
}
</script>
</body>
</html>
