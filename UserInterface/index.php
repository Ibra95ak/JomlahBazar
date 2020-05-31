<?php 
include('header.php');
?>
<div class="clearfix"></div>

<!-- hero slider -->
<section class="hero-section overlay bg-cover position-relative home-2">
    <div class="hero-slider">
        <!-- slider 1 item -->
        <div class="hero-slider-item" style="
            background: url(https://wallpapersmug.com/download/1280x1024/0b0bc4/buildings-cityscape-city-lights.jpg) no-repeat center top;;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
          ">
            <div class="container banner2">
                <div class="caption-banner">
                    <h6 class="text-white" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">
                        Register now
                    </h6>
                    <h2 class="mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".4" style="color: white !important;">
                        Welcome to<br />
                        JomlahBazar
                    </h2>
                    <a href="login.php" class="btn our-services" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".7">Our Services
                        <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <!-- slider 2 item -->
        <div class="hero-slider-item" style="
            background: url(https://mobirise.com/extensions/storem4/assets/images/2.jpg)
              no-repeat center top;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
          ">
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
<!-- Page Content -->
<div class="products-section">
    <div class="container">
        <h2 class="wow fadeInDown">Latest Products</h2>
        <div class="owl-carousel latest-products owl-theme wow fadeIn">
            <?php
require_once '../AdminPanel/libraries/Ser_Products.php';
$db = new Ser_Products();  
$latest_products = $db->GetLatestProducts();
if($latest_products){
  foreach($latest_products as $latest_product){
    $latest_pic = $db->GetProductPicture($latest_product['productId']);
    echo '<div class="item"><div class="product">';
    echo '<a class="product-img" href="product-details?productId='.$latest_product['productId'].'"><img src="../AdminPanel/pics/'.$latest_pic['path'].'" alt="" /></a>';
    echo '<h5 class="product-type">'.$latest_product['brand_name'].'</h5>';
    echo '<h3 class="product-name">'.$latest_product['name'].'</h3>';
    echo '<h3 class="product-price">$'.$latest_product['unitprice'].'</h3>';
    echo '</div></div>';
}  
}
?>
        </div>
    </div>
</div>
<div id="featured-products">
    <div class="container">
        <h2 class="wow fadeInDown">Featured Products</h2>
        <div class="owl-carousel latest-products owl-theme wow fadeIn">
            <?php
$featured_products = $db->GetFeaturedProducts();
if($featured_products){
  foreach($featured_products as $featured_product){
    $featured_pic = $db->GetProductPicture($featured_product['productId']);
    echo '<div class="item"><div class="product">';
    echo '<a class="product-img" href="product-details?productId='.$featured_product['productId'].'"><img src="../AdminPanel/pics/'.$featured_pic['path'].'" alt="" /></a>';
    echo '<h5 class="product-type">'.$featured_product['brand_name'].'</h5>';
    echo '<h3 class="product-name">'.$featured_product['name'].'</h3>';
    echo '<h3 class="product-price">$'.$featured_product['unitprice'].'</h3>';
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
require_once '../AdminPanel/libraries/Ser_Categories.php';
$db1 = new Ser_Categories(); 
require_once '../AdminPanel/libraries/Ser_Subcategories.php';
$db2 = new Ser_Subcategories();  
$categories = $db1->GetCategories();
if($categories){
  foreach($categories as $category){
      echo '<div class="col-lg-4 col-md-6 text-center wow fadeIn mb-3"><ul class="ch-grid"><li><div class="ch-item" style="background: url(assets/images/product/left-img.jpg) no-repeat center top;background-size: 100% 100%;"><div class="ch-info"><div class="img-text">';
      echo '<h3>'.$category['name'].'</h3>';
    $subcategories = $db2->GetSubcategoryByCategoryId($category['categoryId']);
      if($subcategories){
          foreach($subcategories as $subcategory){
              echo '<p>'.$subcategory[2].'</p>';
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
?> </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<<?php 
include('footer.php');
?>