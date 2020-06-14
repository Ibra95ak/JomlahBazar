<?php 
include('../AdminPanel/libraries/base.php');
include("header.php");
$search_category=$_GET['search_category'];
$search=$_GET['search'];
?>
<div class="container container-fluid">
    <div class="row">
 <?php include("filters.php");?>
        <div class="col-lg-10 col-md-12">
            <div class="row">
                <div class="col-12">
                    <div class="clearfix"></div>
                    <div class="row">
                        <?php
//Get brand class
require_once '../AdminPanel/libraries/Ser_Brands.php';
$db = new Ser_Brands();
require_once '../AdminPanel/libraries/Ser_Pictures.php';
$db1 = new Ser_Pictures();
//get all leads details
if($search!=NULL) $brands = $db->SearchBrand($search);
else $brands = $db->Getbrands();
if($brands){
    foreach($brands as $brand){
    $brand_pic = $db1->GetPictureById($brand['brandId']);  
    echo '<div class="col-lg-3 col-md-4 col-sm-6">';
    echo '<div class="product product-card">';
    echo '<a class="product-img" href="product-details?productId='.$brand['brandId'].'"><img src="../AdminPanel/pics/'.$brand_pic['path'].'" alt=""></a>';
    echo '<h5 class="product-type">'.$brand['name'].' / '.$brand['brand_name'].'</h5>';
    echo '<div class="row m-0 list-n">';
    echo '<div class="col-lg-12 p-0">';
    echo '<div class="product-price">';
    echo '<form class="form-inline">';
    echo '<div class="stepper-widget">';
    echo '<button type="button" class="js-qty-down">-</button>';
    echo '<input type="text" class="js-qty-input" value="1">';
    echo '<button type="button" class="js-qty-up">+</button>';
    echo '<button onClick="window.location.href="cart.html"" class="add2"><i class="fa fa-heart" aria-hidden="true"></i></button>';
    echo '<button onClick="window.location.href="cart.html"" class="add2"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>';
    echo '</div></form></div></div></div></div></div>';
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

<?php 
include("footer.php");
?>