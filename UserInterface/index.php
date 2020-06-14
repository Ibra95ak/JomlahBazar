<?php 
/*Page header*/ 
include('header.php'); 
?>
<div class="clearfix"></div>
<!-- hero slider -->
<section class="hero-section overlay bg-cover position-relative home-2">
    <div class="hero-slider">
        <!-- slider 1 item -->
        <div class="hero-slider-item" style="background:url(../AdminPanel/pics/slider/slider1.jpeg) no-repeat center top;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
            <div class="container banner2">
                <div class="caption-banner">
                    <h6 class="text-white" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">
                        Register now
                    </h6>
                    <h2 class="mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".4" style="color: white !important;">
                        Welcome to<br />
                        JomlahBazar
                    </h2>
                    <a href="login.php" class="btn our-services" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".7">Sign IN
                        <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <!-- slider 2 item -->
        <div class="hero-slider-item" style="background:url(../AdminPanel/pics/slider/slider2.jpeg) no-repeat center top;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
            <div class="container banner2">
                <div class="caption-banner" style="position: relative; z-index: 999; text-align: center;">
                    <h6 class="text-white" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">
                        Wholesale Products
                    </h6>
                    <h2 class="mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".4" style="color: white !important;">
                        Contact With Thousands of Wholesale Dealers
                    </h2>
                    <a href="supplier-search.php" class="btn our-services" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".7">Search Wholesale Dealers
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
<div class="clearfix"></div>
<!-- Start - Latest Products -->
<div class="products-section">
    <div class="container">
        <h2 class="wow fadeInDown">Latest Products</h2>
        <div class="owl-carousel latest-products owl-theme wow fadeIn">
            <?php
/*Fetch latest products through API*/
$API_latest_products = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_LatestProducts.php");
$latest_products = json_decode($API_latest_products); 
if($latest_products){
      foreach($latest_products as $latest_product){
        $API_product_img = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_ProductImage.php?productId=".$latest_product->productId);
        $product_img = json_decode($API_product_img);
        echo '<div class="item"><div class="product">';
        foreach($product_img as $img){
        echo '<a class="product-img" href="single_product.php?productId='.$latest_product->productId.'"><img src="../AdminPanel/pics/'.$img[0].'" alt=""></a>';    
    }
        echo '<h5 class="product-type">'.$latest_product->brand_name.'</h5>';
        echo '<h3 class="product-name">'.$latest_product->name.'</h3>';
        echo '<h3 class="product-price">$'.$latest_product->unitprice.'</h3>';
        echo '</div></div>';
      } 
}
?>
        </div>
    </div>
</div>
<!-- End - Latest Products -->
<div id="featured-products">
    <div class="container">
        <h2 class="wow fadeInDown">Featured Products</h2>
        <div class="owl-carousel latest-products owl-theme wow fadeIn">
            <?php
/*Fetch featured products through API*/
$API_featured_products = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_FeaturedProducts.php");
$featured_products = json_decode($API_featured_products);       
if($featured_products){
  foreach($featured_products as $featured_product){
    echo '<div class="item"><div class="product">';
    $API_product_img = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_ProductImage.php?productId=".$featured_product->productId);
    $product_img = json_decode($API_product_img); 
    foreach($product_img as $img){
        echo '<a class="product-img" href="single_product.php?productId='.$featured_product->productId.'"><img src="../AdminPanel/pics/'.$img[0].'" alt=""></a>';    
    }
    echo '<h5 class="product-type">'.$featured_product->brand_name.'</h5>';
    echo '<h3 class="product-name">'.$featured_product->name.'</h3>';
    echo '<h3 class="product-price">$'.$featured_product->unitprice.'</h3>';
    echo '</div></div>';
}  
}
?>
        </div>
    </div>
</div>
<!--Three-images-->
<div class="three-img">
    <div class="container">
        <h2 class="wow fadeInDown">Featured Category</h2>
        <div class="row justify-content-center">
            <?php
/*Fetch featured categories through API*/
$API_featured_categories = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_FeaturedCategories.php");
$featured_categories = json_decode($API_featured_categories); 
if($featured_categories){
  foreach($featured_categories as $featured_category){
      echo '<div class="col-lg-4 col-md-6 text-center wow fadeIn mb-3"><ul class="ch-grid"><li><div class="ch-item" style="background: url(assets/images/product/left-img.jpg) no-repeat center top;background-size: 100% 100%;"><div class="ch-info"><div class="img-text">';
      echo '<h3>'.$featured_category->name.'</h3>';
      /*Fetch subcategories */
      $API_featured_subcategories = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_FeaturedSubCategories.php?categoryId=".$featured_category->categoryId);
      $featured_subcategories = json_decode($API_featured_subcategories); 
      if($featured_subcategories){
          foreach($featured_subcategories as $featured_subcategory){
              echo '<p>'.$featured_subcategory[2].'</p>';
          }
      }
    echo ' <a href="#">view more</a>';
    echo '</div></div></div></li></ul></div>';
}  
}
?>
        </div>
    </div>
</div>
<!--Three-images-->
<div id="bestsellers">
    <div class="container">
        <h2 class="wow fadeInDown">Bestsellers</h2>
        <div class="owl-carousel latest-products owl-theme wow fadeIn">
            <?php
/*Fetch best sellers products through API*/
$API_bestsellers_products= file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_BestSellerProducts.php");
$bestsellers_products = json_decode($API_bestsellers_products);
if($bestsellers_products){
  foreach($bestsellers_products as $bestseller){
    $API_product_img = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_ProductImage.php?productId=".$bestseller->productId);
    $product_img = json_decode($API_product_img); 
    echo '<div class="item"><div class="product">';
    foreach($product_img as $img){
        echo '<a class="product-img" href="single_product.php?productId='.$bestseller->productId.'"><img src="../AdminPanel/pics/'.$img[0].'" alt=""></a>';    
    }
    echo '<h5 class="product-type">'.$bestseller->brand_name.'</h5>';
    echo '<h3 class="product-name">'.$bestseller->name.'</h3>';
    echo '<h3 class="product-price">$'.$bestseller->unitprice.'</h3>';
    echo '</div></div>';
}  
}
?>
        </div>
    </div>
</div>
<div id="deal-of-the-week">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center mb-1">
                <div class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <figure class="imghvr-push-right">
                                <a href="shop.html"><img src="assets/images/page-img/sale.jpg" class="img-fluid" alt="" title="" /></a>
                                <figcaption>
                                    <h3>Advertisement 1</h3>
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
            <div class="col-md-6 text-center mb-1">
                <div class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <figure class="imghvr-push-right">
                                <a href="shop.html"><img src="assets/images/page-img/sale.jpg" class="img-fluid" alt="" title="" /></a>
                                <figcaption>
                                    <h3>Advertisement 2</h3>
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
            <div class="clearfix"></div>
            <h2 class="text-center wow fadeInDown">Deal Of The Week</h2>
            <div class="clearfix"></div>
        </div>
        <div>
            <div class="owl-carousel latest-products owl-theme wow fadeIn">
            <?php
/*Fetch best sellers products through API*/
$API_DOW= file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_DealOfWeek.php");
$DOW = json_decode($API_DOW);
if($DOW){
  foreach($DOW as $DOWproduct){
    $API_product_img = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_ProductImage.php?productId=".$DOWproduct->productId);
    $product_img = json_decode($API_product_img); 
    echo '<div class="item"><div class="product">';
    foreach($product_img as $img){
        echo '<a class="product-img" href="single_product.php?productId='.$DOWproduct->productId.'"><img src="../AdminPanel/pics/'.$img[0].'" alt=""></a>';    
    }
    echo '<h5 class="product-type">'.$DOWproduct->brand_name.'</h5>';
    echo '<h3 class="product-name">'.$DOWproduct->name.'</h3>';
    echo '<h3 class="product-price">$'.$DOWproduct->unitprice.'</h3>';
    echo '</div></div>';
}  
}
?>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="testimonial-area client-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 offset-lg-3 offset-xl-3">
                <div class="section-title section-title-cap text-center">
                    <div class="section-icon section1-icon"> <img src="assets/images/icon/icon6.png" alt=""> </div>
                    <h1>Client’s Words</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="client-active owl-carousel testimonial owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="width: 1600px; transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s;">
                        <div class="owl-item active" style="width: 320px;">
                            <div class="col-xl-12">
                                <div class="client-wrapper text-center">
                                    <div class="client-text">
                                        <div class="text-center"> <img src="assets/images/clint-images.jpg" alt="" title="" class="rounded-circle"> </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua. Uts enim ad minim veniam quis see nostrudexercitatiac.</p>
                                        <h4>Johnny J. Stewart</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item active" style="width: 320px;">
                            <div class="col-xl-12">
                                <div class="client-wrapper text-center">
                                    <div class="client-text">
                                        <div class="text-center"> <img src="assets/images/clint-images-2.jpg" alt="" title="" class="rounded-circle"> </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua. Uts enim ad minim veniam quis see nostrudexercitatiac.</p>
                                        <h4>Dr.Frank Harisk</h4>
                                        <span>Founder</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item active" style="width: 320px;">
                            <div class="col-xl-12">
                                <div class="client-wrapper text-center">
                                    <div class="client-text">
                                        <div class="text-center"> <img src="assets/images/clint-images-3.jpg" alt="" title="" class="rounded-circle"> </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua. Uts enim ad minim veniam quis see nostrudexercitatiac.</p>
                                        <h4>Dr.Frank Harisk</h4>
                                        <span>Founder</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item" style="width: 320px;">
                            <div class="col-xl-12">
                                <div class="client-wrapper text-center">
                                    <div class="client-text">
                                        <div class="text-center"> <img src="assets/images/clint-images-2.jpg" alt="" title="" class="rounded-circle"> </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua. Uts enim ad minim veniam quis see nostrudexercitatiac.</p>
                                        <h4>Dr.Frank Harisk</h4>
                                        <span>Founder</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-item" style="width: 320px;">
                            <div class="col-xl-12">
                                <div class="client-wrapper text-center">
                                    <div class="client-text">
                                        <div class="text-center"> <img src="assets/images/clint-images.jpg" alt="" title="" class="rounded-circle"> </div>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua. Uts enim ad minim veniam quis see nostrudexercitatiac.</p>
                                        <h4>Johnny J. Stewart</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous"><i class="fa fa-angle-left"></i></span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next"><i class="fa fa-angle-right"></i></span></button></div>
                <div class="owl-dots"><button role="button" class="owl-dot active"><span></span></button><button role="button" class="owl-dot"><span></span></button></div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<?php 
include('footer.php');
?>