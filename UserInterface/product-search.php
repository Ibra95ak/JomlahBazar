<?php 
include('../AdminPanel/libraries/base.php');
include("header.php");
$search_category=$_GET['search_category'];
$search=$_GET['search'];
?>
<!-- Bread Crumbs and Filters and products -->
<div class="container container-fluid">
    <!-- Bread Crumbs -->
    <nav aria-label="breadcrumb" class="bread-boder">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                    <li class="breadcrumb-item">Products</li>
                </ol>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="custom-select2">
                            <select>
                                <option>Default Sorting</option>
                                <option value="A-Z">A to Z</option>
                                <option value="Z-A">Z to A</option>
                                <option value="High to low price">High to low price</option>
                                <option value="Low to high price">Low to high</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="custom-select2">
                            <select>
                                <option value="A-Z">Show 10</option>
                                <option value="Z-A">Show 20</option>
                                <option value="High to low price">Show 30</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </nav>
    <!-- Bread Crumbs -->

    <div class="row">
        <!-- Filters -->
        <?php include('filters.php');?>
        <!-- Filters -->

        <!-- Products Grid -->
        <div class="col-lg-10 col-md-12">
            <div class="row">
                <div class="col-12">
                    <div class="clearfix"></div>
                    <div class="row">
                        <?php
require_once '../AdminPanel/libraries/Ser_Products.php';
$db = new Ser_Products(); 

if($search!=NULL) $products = $db->SearchProducts($search);
else $products = $db->GetProducts();
if($products){
  foreach($products as $product){
    $product_pic = $db->GetProductPicture($product['productId']);
    echo '<div class="col-lg-3 col-md-4 col-sm-6 product-card-col">';
    echo '<div class="product product-card">';
    echo '<a class="product-img" href="single_product.php?productId='.$product['productId'].'"><img src="../AdminPanel/pics/'.$product_pic['path'].'" alt=""></a>';
    echo '<h2><a><span class="product-title">'.$product['name'].'</span></a></h2>';
    echo '<div class="row m-0 list-n">';
    echo '<div class="col-lg-12 p-0">';
    echo '<div class="single-product-price">';
    echo '<span class="a-price" data-a-size="l" data-a-color="base"><span class="price-dollar">$</span><span class="price-digit">'.$product['unitprice'].'</span><span class="price-fraction"></span></span>';
    echo '</div></div></div></div></div>';
}  
}
?>
                        <div class="clearfix"></div>
                        <div class="col text-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-template d-flex justify-content-center float-none">
                                    <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
                                    <li class="page-item"><a href="#" class="page-link active">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>

                        <!--Three-images-->
                        <div id="bestsellers">
                            <div class="container-fluid">
                                <h2 class="wow fadeInDown">Bestsellers</h2>
                                <div class="owl-carousel latest-products owl-theme wow fadeIn">
<?php
require_once '../AdminPanel/libraries/Ser_Products.php';
$db = new Ser_Products();  
$bestsellers = $db->GetBestSellerProducts();
if($bestsellers){
  foreach($bestsellers as $bestseller){
    $bestseller_pic = $db->GetProductPicture($bestseller['productId']);
    echo '<div class="item"><div class="product">';
    echo '<a class="product-img" href="product-details?productId='.$bestseller['productId'].'"><img src="../AdminPanel/pics/'.$bestseller_pic['path'].'" alt="" /></a>';
    echo '<h5 class="product-type">'.$bestseller['brand_name'].'</h5>';
    echo '<h3 class="product-name">'.$bestseller['name'].'</h3>';
    echo '<h3 class="product-price">$'.$bestseller['unitprice'].'</h3>';
    echo '</div></div>';
}  
}
?>
                                </div>
                            </div>
                        </div>
                        <!--Three-images-->

                        <!-- Advertisement -->
                        <div id="deal-of-the-week">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 text-center mb-1">
                                        <div class="carousel slide carousel-fade pointer-event" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <figure class="imghvr-push-right">
                                                        <a href="shop.html"><img src="assets/images/page-img/sale.jpg" class="img-fluid" alt="" width="100%" title=""></a>
                                                        <figcaption>
                                                            <h3>Sale off Up to 30%</h3>
                                                            <p>
                                                                Lorem Ipsum is simply dummy text of the printing and
                                                                typesetting industry Lorem Ipsum is simply dummy text of
                                                                the...
                                                            </p>
                                                        </figcaption>
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Advertisement -->




                        <div class="clearfix"></div>
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



<!-- Slider for images -->
<div id="partner">
    <div class="container">
        <div class="owl-carousel partner-logo owl-theme">
            <div class="item">
                <img src="assets/images/logo-1.png" alt="" title="" />
            </div>
            <div class="item">
                <img src="assets/images/logo-2.png" alt="" title="" />
            </div>
            <div class="item">
                <img src="assets/images/logo-3.png" alt="" title="" />
            </div>
            <div class="item">
                <img src="assets/images/logo-1.png" alt="" title="" />
            </div>
            <div class="item">
                <img src="assets/images/logo-2.png" alt="" title="" />
            </div>
            <div class="item">
                <img src="assets/images/logo-3.png" alt="" title="" />
            </div>
        </div>
    </div>
</div>
<!-- Slider for images -->

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
<div id="popup-1" class="popup-fcy">
    <div class="row">
        <div class="col-md-6 text-center"> <img src="assets/images/product-img/product-big-1.jpg" alt="" title="" class="img-fluid"> </div>
        <div class="col-md-6">
            <div class="product_meta">
                <p>Availability : <span>not in Stock</span> </p>
                <p>Categories : <span>Vegetable Fruit</span></p>
                <p>Tags : <span>fruit green health organic</span> </p>
            </div>
            <div class="product-dis">
                <h3>Products Name</h3>
                <hr>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen bookwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <div class="row">
                    <div class="col-2 pr-0">
                        <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1" title="Qty" size="4">
                    </div>
                    <div class="col-10">
                        <div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="add_to_cart"><a href="" class="">ADD TO CART</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4 p-0">
                        <hr class="m-0 p-0">
                    </div>
                    <div class="pb-3 pt-3">
                        <div class="left-icon"> <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-1" href="javascript:;"> <i class="fa fa-eye" aria-hidden="true"></i> </a> <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a> </div>
                    </div>
                    <div class="col-md-12 mb-4 p-0">
                        <hr class="m-0 p-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup-2" class="popup-fcy">
    <div class="row">
        <div class="col-md-6 text-center"> <img src="assets/images/product-img/kiwi.jpg" alt="" title="" class="img-fluid"> </div>
        <div class="col-md-6">
            <div class="product_meta">
                <p>Availability : <span>not in Stock</span> </p>
                <p>Categories : <span>Vegetable Fruit</span></p>
                <p>Tags : <span>fruit green health organic</span> </p>
            </div>
            <div class="product-dis">
                <h3>Products Name</h3>
                <hr>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen bookwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <div class="row">
                    <div class="col-2 pr-0">
                        <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1" title="Qty" size="4">
                    </div>
                    <div class="col-10">
                        <div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="add_to_cart"><a href="" class="">ADD TO CART</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4 p-0">
                        <hr class="m-0 p-0">
                    </div>
                    <div class="pb-3 pt-3">
                        <div class="left-icon"> <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-2" href="javascript:;"> <i class="fa fa-eye" aria-hidden="true"></i> </a> <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a> </div>
                    </div>
                    <div class="col-md-12 mb-4 p-0">
                        <hr class="m-0 p-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup-3" class="popup-fcy">
    <div class="row">
        <div class="col-md-6"> <img src="assets/images/product-img/orange.jpg" alt="" title="" class="img-fluid"> </div>
        <div class="col-md-6">
            <div class="product_meta">
                <p>Availability : <span>not in Stock</span> </p>
                <p>Categories : <span>Vegetable Fruit</span></p>
                <p>Tags : <span>fruit green health organic</span> </p>
            </div>
            <div class="product-dis">
                <h3>Products Name</h3>
                <hr>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen bookwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <div class="row">
                    <div class="col-2 pr-0">
                        <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1" title="Qty" size="4">
                    </div>
                    <div class="col-10">
                        <div class="wrap_compare">
                            <div class="row">
                                <div class="col-6">
                                    <div class="add_to_cart"><a href="" class="">ADD TO CART</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <hr class="m-0 p-0">
                    </div>
                    <div class="pb-3 pt-3">
                        <div class="left-icon"> <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-3" href="javascript:;"> <i class="fa fa-eye" aria-hidden="true"></i> </a> <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a> </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <hr class="m-0 p-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup-4" class="popup-fcy">
    <div class="row">
        <div class="col-md-6 text-center"><img src="assets/images/product-img/acai-berry.jpg" alt="" title="" class="img-fluid"></div>
        <div class="col-md-6">
            <div class="product_meta">
                <p>Availability : <span>not in Stock</span> </p>
                <p>Categories : <span>Vegetable Fruit</span></p>
                <p>Tags : <span>fruit green health organic</span> </p>
            </div>
            <div class="product-dis">
                <h3>Products Name</h3>
                <hr>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen bookwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <div class="row">
                    <div class="col-2 pr-0">
                        <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1" title="Qty" size="4">
                    </div>
                    <div class="col-10">
                        <div class="wrap_compare">
                            <div class="row">
                                <div class="col-6">
                                    <div class="add_to_cart"><a href="" class="">ADD TO CART</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <hr class="m-0 p-0">
                    </div>
                    <div class="pb-3 pt-3">
                        <div class="left-icon"> <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-4" href="javascript:;"> <i class="fa fa-eye" aria-hidden="true"></i> </a> <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a> </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <hr class="m-0 p-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup-5" class="popup-fcy">
    <div class="row">
        <div class="col-md-6 text-center"> <img src="assets/images/product-img/maracuja.jpg" alt="" title="" class="img-fluid"> </div>
        <div class="col-md-6">
            <div class="product_meta">
                <p>Availability : <span>not in Stock</span> </p>
                <p>Categories : <span>Vegetable Fruit</span></p>
                <p>Tags : <span>fruit green health organic</span> </p>
            </div>
            <div class="product-dis">
                <h3>Products Name</h3>
                <hr>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen bookwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <div class="row">
                    <div class="col-2 pr-0">
                        <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1" title="Qty" size="4">
                    </div>
                    <div class="col-10">
                        <div class="wrap_compare">
                            <div class="row">
                                <div class="col-6">
                                    <div class="add_to_cart"><a href="" class="">ADD TO CART</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <hr class="m-0 p-0">
                    </div>
                    <div class="pb-3 pt-3">
                        <div class="left-icon"> <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-5" href="javascript:;"> <i class="fa fa-eye" aria-hidden="true"></i> </a> <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a> </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <hr class="m-0 p-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup-6" class="popup-fcy">
    <div class="row">
        <div class="col-md-6 text-center"><img src="assets/images/product-img/cucumber.jpg" alt="" title="" class="img-fluid"></div>
        <div class="col-md-6">
            <div class="product_meta">
                <p>Availability : <span>not in Stock</span> </p>
                <p>Categories : <span>Vegetable Fruit</span></p>
                <p>Tags : <span>fruit green health organic</span> </p>
            </div>
            <div class="product-dis">
                <h3>Products Name</h3>
                <hr>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen bookwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <div class="row">
                    <div class="col-2 pr-0">
                        <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1" title="Qty" size="4">
                    </div>
                    <div class="col-10">
                        <div class="wrap_compare">
                            <div class="row">
                                <div class="col-6">
                                    <div class="add_to_cart"><a href="" class="">ADD TO CART</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <hr class="m-0 p-0">
                    </div>
                    <div class="pb-3 pt-3">
                        <div class="left-icon"> <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-6" href="javascript:;"> <i class="fa fa-eye" aria-hidden="true"></i> </a> <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a> </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <hr class="m-0 p-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup-7" class="popup-fcy">
    <div class="row">
        <div class="col-md-6 text-center"> <img src="assets/images/product-img/mushroom.jpg" alt="" title="" class="img-fluid"> </div>
        <div class="col-md-6">
            <div class="product_meta">
                <p>Availability : <span>not in Stock</span> </p>
                <p>Categories : <span>Vegetable Fruit</span></p>
                <p>Tags : <span>fruit green health organic</span> </p>
            </div>
            <div class="product-dis">
                <h3>Products Name</h3>
                <hr>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen bookwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <div class="row">
                    <div class="col-2 pr-0">
                        <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1" title="Qty" size="4">
                    </div>
                    <div class="col-10">
                        <div class="wrap_compare">
                            <div class="row">
                                <div class="col-6">
                                    <div class="add_to_cart"><a href="" class="">ADD TO CART</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <hr class="m-0 p-0">
                    </div>
                    <div class="pb-3 pt-3">
                        <div class="left-icon"> <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-7" href="javascript:;"> <i class="fa fa-eye" aria-hidden="true"></i> </a> <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a> </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <hr class="m-0 p-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup-8" class="popup-fcy">
    <div class="row">
        <div class="col-md-6"> <img src="assets/images/product-img/persimmon.jpg" alt="" title="" class="img-fluid"> </div>
        <div class="col-md-6">
            <div class="product_meta">
                <p>Availability : <span>not in Stock</span> </p>
                <p>Categories : <span>Vegetable Fruit</span></p>
                <p>Tags : <span>fruit green health organic</span> </p>
            </div>
            <div class="product-dis">
                <h3>Products Name</h3>
                <hr>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book when an unknown printer took a galley of type and scrambled it to make a type specimen bookwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. remaining essentially unchanged. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                <div class="row">
                    <div class="col-2 pr-0">
                        <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1" title="Qty" size="4">
                    </div>
                    <div class="col-10">
                        <div class="wrap_compare">
                            <div class="row">
                                <div class="col-6">
                                    <div class="add_to_cart"><a href="" class="">ADD TO CART</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <hr class="m-0 p-0">
                    </div>
                    <div class="pb-3 pt-3">
                        <div class="left-icon"> <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-8" href="javascript:;"> <i class="fa fa-eye" aria-hidden="true"></i> </a> <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a> </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <hr class="m-0 p-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/ajax.js"></script>
<script src="assets/js/formValidation.js"></script>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<!--wow-->
<script src="assets/vendor/wow/wow.js"></script>
<script src="assets/vendor/wow/page.js"></script>
<!--wow-->

<!--mega-menu-->
<script src="assets/vendor/jquery/mega-menu.js"></script>
<!--mega-menu-->

<!--price_range-->
<link rel="stylesheet" href="assets/vendor/price_range/jquery-ui.css" type="text/css" media="all" />
<script src="assets/vendor/price_range/jquery-ui.min.js"></script>
<script src="assets/vendor/price_range/price_range_script.js"></script>
<link rel="stylesheet" type="text/css" href="assets/vendor/price_range/price_range_style.css" />
<!--price_range-->

<!--stepper-->
<script src="assets/vendor/stepper/jquery.min.js"></script>
<script src="assets/vendor/stepper/jquery-ui.min.js"></script>
<script src="assets/vendor/jquery/stepper.widget.js"></script>
<script src="assets/vendor/jquery/custom-select.js"></script>
<!--stepper-->

<!--fancybox files -->
<link rel="stylesheet" href="assets/css/product-hover.css">
<link rel="stylesheet" href="assets/vendor/fancy-box/fancybox.min.css" />
<script src="assets/vendor/fancy-box/jquery.fancybox.min.js"></script>

<!--scrolltop-->
<script src="assets/vendor/jquery/scrolltopcontrol.js"></script>
<!--scrolltop-->

<!--bootstrap-->
<script src="assets/vendor/bootstrap/js/popper.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--bootstrap-->
<script src="assets/js/ajax.js"></script>
<script src="assets/js/formValidation.js"></script>
<!--owlcarousel-->
<script src="assets/owlcarousel/owl.carousel.js"></script>
<!--owlcarousel-->
<!--script-->
<script src="assets/vendor/jquery/home-1.js"></script>
<!--script-->
<!-- animation-->
<script src="assets/vendor/wow/wow.js"></script>
<script src="assets/vendor/wow/page.js"></script>
<!-- animation-->
<!--fancybox files -->
<link rel="stylesheet" href="assets/css/product-hover.css" />
<link rel="stylesheet" href="assets/vendor/fancy-box/fancybox.min.css" />
<script src="assets/vendor/fancy-box/jquery.fancybox.min.js"></script>
<!--fancybox files -->
<!--banner js-->
<script src="assets/vendor/revolution/vendor/revslider/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/vendor/revolution/vendor/revslider/js/jquery.themepunch.revolution.min.js"></script>
<script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.actions.min.js"></script>
<script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="assets/js/banner.js"></script>
<!--banner js-->
<!--scrolltop-->
<script src="assets/vendor/revolution/responsiveslides.min.js"></script>


<p data-toggle="modal" class="no-margin" data-target="#myModal" id="model2"></p>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog2">
        <div class="modal-content text-center">
            <div class="modal-body modal-body2">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <p><img src="assets/images/success.svg" width="50"></p>
                <h3 class="modal-title">Thank you</h3>
                <h4 class="thanks mt-2">Your submission is recevied and we will contact you soon.</h4>
                <a href="https://themeforest.net/item/organic-store-multipurpose-ecommerce-bootstrap-html5-template/23986984" target="_blank" class="btn add-to-cart2 d-inline-block font-15 rounded">BUY THIS TEMPLATE NOW</a> <a href="index.html" class="back-to-home d-block small mt-2"><i class="fa fa-long-arrow-left"></i> BACK TO HOME</a>
            </div>
        </div>
    </div>
</div>


</body>

</html>