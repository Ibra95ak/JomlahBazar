<?php 
include("header.php");
/*Parameters*/
$productId = $_GET['productId'];
/*Fetch product by Id through API*/
$API_product = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Product.php?productId=".$productId);
$product = json_decode($API_product);
/*Fetch product details by Id through API*/
$API_product_details = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Product_Details.php?productId=".$productId);
$product_details = json_decode($API_product_details);
/*Fetch supplier by Id through API*/
$API_supplier = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Supplier.php?supplierId=".$product[3]);
$supplier = json_decode($API_supplier);
/*Fetch category by Id through API*/
$API_category = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Category.php?categoryId=".$product[1]);
$category = json_decode($API_category);
/*Fetch brand by Id through API*/
$API_brand = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Brand.php?brandId=".$product[12]);
$brand = json_decode($API_brand);
?>
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb2 breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li class="breadcrumb-item">Product details</li>
    </ol>
  </nav>
  <div class="clearfix"></div>
</div>

<div class="inner-page">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-lg-6"> <a href="wishlist.html" class="wish-list"><i class="fa fa-heart" aria-hidden="true"></i></a>
        <div id="sync1" class="owl-carousel owl-theme">
<?php
$API_product_img = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_ProductImage.php?productId=".$productId);
$product_img = json_decode($API_product_img);
            foreach($product_img as $img){
                echo '<div class="item easyzoom easyzoom--overlay"> <a href="../AdminPanel/pics/'.$img[0].'"> <img src="../AdminPanel/pics/'.$img[0].'" alt="" title="" /> </a> </div>';
            }
?>
          
        </div>
        <div id="sync2" class="owl-carousel owl-theme">
<?php
            foreach($product_img as $img){
                echo '<div class="item"><img src="../AdminPanel/pics/'.$img[0].'" alt="" title=""></div>';
            }
?>   
        </div>
      </div>
      <div class="col-lg-6  product-text">
        <div class="row">
          <div class="col-md-10 col-sm-10 col-10">
            <h3><?php echo $product[6];?></h3>
<?php
for($i=0;$i<$product[11];$i++) echo '<img src="assets/images/star.png" alt="" title="">';         
?>
            </div>
          <div class="col-md-2 col-sm-2 text-right col-2">
            <div class="price-css"> <!--<span>$<?php //echo $product[9];?></span>-->
              <div class="clearfix"></div>
              $<?php echo $product[9];?> </div>
          </div>
          <div class="col-md-12">
            <div class="mt-3">
              <p><?php echo $product_details[1];?></p>
              <div class="mt-3 text-2">
                <p><span>Availability</span>: &nbsp;&nbsp;<img src="assets/images/available.png" alt="" title="" > In Stock</p>
                <p><span>Supplier</span>: <?php echo $supplier[4];?></p>
                <p><span>Category</span>: <?php echo $category[1];?></p>
                <p><span>Brand</span>: <?php echo $brand[2];?></p>
              </div>
              <div class="quality">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <div class="input-group">
                      <h4>Quantity :</h4>
                      <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]"> <i class="fa fa-minus"></i> </button>
                      </span>
                      <input type="text" name="quant[1]" class="input-number" value="1" min="1" max="10">
                      <span class="input-group-btn">
                      <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]"><i class="fa fa-plus"></i> </button>
                      </span> </div>
                  </div>
                  <div class="col-md-6 col-sm-6"> <a class="btn add-to-cart2" href="cart.html">Add To Cart</a> </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="share">
                <h3 class="pull-left">Share : &nbsp; &nbsp;</h3>
                <div class="pull-left">
                  <ul class="social-network3">
                    <li><a href="#" class="facebook-icon" title=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="twitter-icon" title=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="google-icon" title=""><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#" class="linkedin-icon" title=""><i class="fa fa-linkedin"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row categories">
                <div class="clearfix"></div>
                <div class="list-3 row">
                  <div class="col-lg-4"><img src="assets/images/shield.png" alt=""> 10 days return</div>
                  <div class="col-lg-4"><img src="assets/images/shipping.png" alt=""> Quick Delivery</div>
                  <div class="col-lg-4"><img src="assets/images/transfer.png" alt=""> 35% Cashback</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"> </div>
      <div class="col-md-12">
        <div id="tabs" class="description">
          <div>
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist"> <a class="active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Description</a>&nbsp;|&nbsp;<a class="" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Additional information</a>&nbsp;|&nbsp;<a class="" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Reviews</a> </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active text-1" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <p class="p1"><?php echo $product_details[1];?></p>
                <!-- snippet location product_description -->
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table class="table">
                  <tbody>
                    <tr>
                      <th><div align="left">Size</div></th>
                      <td><?php echo $product_details[2];?></td>
                    </tr>
                      <tr>
                      <th><div align="left">Color</div></th>
                      <td><?php echo $product_details[3];?></td>
                    </tr>
                      <tr>
                      <th><div align="left">Weight</div></th>
                      <td><?php echo $product_details[4];?></td>
                    </tr>
                    <tr>
                      <th><div align="left">Barcode</div></th>
                      <td><?php echo $product_details[5];?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row m-0 text-center-m">
                      <div class="col-lg-2 col-md-3 col-sm-2 text-center mb-3"><img src="assets/images/review1.jpg" alt="" title="" class="radius image-boder img-fluid"></div>
                      <div class="col-lg-10 col-md-9 col-sm-10">
                        <h2 class="font-15 mt-10">Daryl Michaels <span class="font-13 text-themecolor">Product: Mobile Phone</span></h2>
                        <span class="fa fa-star checked font-13"></span> <span class="fa fa-star checked font-13"></span> <span class="fa fa-star checked font-13"></span> <span class="fa fa-star font-13"></span> <span class="fa fa-star font-13"></span> &nbsp;<span class="red">1 Min ago </span>
                        <div class="mt-1">
                          <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-12">
                        <hr>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-lg-2 col-md-3 col-sm-2 text-center"><img src="assets/images/review2.jpg" alt="" title="" class="radius image-boder img-fluid"></div>
                      <div class="col-lg-10 col-md-9 col-sm-10">
                        <h2 class="font-15 mt-10">Daryl Michaels <span class="font-13 text-themecolor">Product: Mobile Phone</span></h2>
                        <span class="fa fa-star checked font-13"></span> <span class="fa fa-star checked font-13"></span> <span class="fa fa-star checked font-13"></span> <span class="fa fa-star font-13"></span> <span class="fa fa-star font-13"></span> <span class="red">&nbsp;1 Min ago </span>
                        <div class="mt-1">
                          <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h4>Write Your Review</h4>
                    <p class="mb-3">Your email address will not be published.</p>
                    <form class="review-form">
                      <div class="form-group">
                        <input class="form-control" type="text" placeholder="Your Name">
                      </div>
                      <div class="form-group">
                        <input class="form-control" type="email" placeholder="Email Address">
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" rows="5" placeholder="Your review"></textarea>
                      </div>
                      <div class="form-group">
                        <div class="input-rating"> <strong>Your Rating:</strong>
                          <div class="stars">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5"></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4"></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3"></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2"></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1"></label>
                          </div>
                        </div>
                        <button class="btn add-to-cart3">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="related">
        <div class="col-md-12">
          <h2 class="icon-css">Related Products</h2>
          <div class="owl-carousel latest-products owl-theme wow fadeIn">
            <div class="item">
              <div class="product">
                <a class="product-img" href="single_product.html"
                  ><img src="assets/images/737052041285.jpg" alt=""
                /></a>
                <h5 class="product-type">Perfume</h5>
                <h3 class="product-name">HUGO BOSS</h3>
                <h3 class="product-price">$10.00</h3>
              </div>
            </div>
            <div class="item">
              <div class="product">
                <a class="product-img" href="single_product.html"
                  ><img src="assets/images/737052041285.jpg" alt=""
                /></a>
                <h5 class="product-type">Perfume</h5>
                <h3 class="product-name">HUGO BOSS</h3>
                <h3 class="product-price">$10.00</h3>
              </div>
            </div>
            <div class="item">
              <div class="sale-flag-side"> <span class="sale-text">Sale</span> </div>
              <div class="product"><a class="product-img" href=""><img src="assets/images/730870120156.jpg" alt=""></a>
                <h5 class="product-type">Spices</h5>
                <h3 class="product-name">Ingredients</h3>
                <h3 class="product-price">$14.00 <del>$35.00</del></h3>
              </div>
            </div>
            <div class="item">
              <div class="product">
                <a class="product-img" href="single_product.html"
                  ><img src="assets/images/737052041285.jpg" alt=""
                /></a>
                <h5 class="product-type">Perfume</h5>
                <h3 class="product-name">HUGO BOSS</h3>
                <h3 class="product-price">$10.00</h3>
              </div>
            </div>
            <div class="item">
              <div class="product">
                <a class="product-img" href="single_product.html"
                  ><img src="assets/images/737052041285.jpg" alt=""
                /></a>
                <h5 class="product-type">Perfume</h5>
                <h3 class="product-name">HUGO BOSS</h3>
                <h3 class="product-price">$10.00</h3>
              </div>
            </div>
            <div class="item">
              <div class="product">
                <a class="product-img" href="single_product.html"
                  ><img src="assets/images/737052041285.jpg" alt=""
                /></a>
                <h5 class="product-type">Perfume</h5>
                <h3 class="product-name">HUGO BOSS</h3>
                <h3 class="product-price">$10.00</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include('footer.php');
?>