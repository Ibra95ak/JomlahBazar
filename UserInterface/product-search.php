<?php 
include('../AdminPanel/libraries/base.php');
include("header.php");
$search_category=$_GET['search_category'];
$search=$_GET['search'];
?>
<!-- Bread Crumbs and Filters and products -->
<div class="container container-fluid">
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

<?php include("footer.php");?>