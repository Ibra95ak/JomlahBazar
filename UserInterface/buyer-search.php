<?php
include('../AdminPanel/libraries/base.php');
include("header.php");
$filter="";
if(isset($_GET['search_by'])) $filter.="&search_by=".$_GET['search_by'];
if(isset($_GET['filter_category'])) $filter.="&filter_category=".$_GET['filter_category'];
if(isset($_GET['search'])) $filter.="&search=".$_GET['search'];
if(isset($_GET['order_by'])) $filter.="&order_by=".$_GET['order_by'];
if(isset($_GET['filter_brand'])) $filter.="&filter_brand=".$_GET['filter_brand'];
if(isset($_GET['filter_rank'])) $filter.="&filter_rank=".$_GET['filter_rank'];
if(isset($_GET['filter_location'])) $filter.="&filter_location=".$_GET['filter_location'];
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
$API_buyers = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Buyers.php?".$filter);
$buyers = json_decode($API_buyers);
if($buyers){
    foreach($buyers as $buyer){
    echo '<div class="col-lg-3 col-md-4 col-sm-6">';
    echo '<div class="product product-card">';
    echo '<a class="product-img" href="buyer-details?userId='.$buyer->userId.'"><img src="../AdminPanel/pics/products/product.jpg" alt=""></a>';
    echo '<h5 class="product-type">'.$buyer->first_name.' / '.$buyer->last_name.'</h5>';
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
                        <div id="bestsellers">
                            <div class="container-fluid">
                                <h2 class="wow fadeInDown">Bestsellers</h2>
                                <div class="owl-carousel latest-products owl-theme wow fadeIn">
                                    <div class="item">
                                        <div class="product">
                                            <div id="carousel-2" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div class="badge">
                                                            <div class="text">Sale 14%</div>
                                                            <a class="product-img" href="single_product.html"><img src="./assets/images/product-img/product-img-1.jpg" alt="" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="badge">
                                                            <div class="text">Sale 14%</div>
                                                            <a class="product-img" href="single_product.html"><img src="./assets/images/product-img/product-img-2.jpg" alt="" /></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                                    <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                                                </a>
                                                <a class="carousel-control-next" href="#carousel-2" role="button" data-slide="next">
                                                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <a class="fa fa-star-half-full checked"></a>
                                            <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
                                            <a class="fa fa-star"></a> <a class="fa fa-star"></a>
                                            <h5 class="product-type">Fruits</h5>
                                            <h3 class="product-name">Strawberry</h3>
                                            <h3 class="product-price">$14.00 <del>$35.00</del></h3>
                                            <div class="product-select">
                                                <button data-toggle="tooltip" data-placement="top" title="Quick view" class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-11">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist round-icon-btn" onClick="window.location.href='wishlist.html'">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Add To Cart" onClick="window.location.href='cart.html'" class="add-to-cart round-icon-btn">
                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product">
                                            <a class="product-img" href="single_product.html"><img src="./assets/images/fruits/img-3.jpg" alt="" /></a>
                                            <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
                                            <a class="fa fa-star"></a> <a class="fa fa-star"></a>
                                            <a class="fa fa-star"></a>
                                            <h5 class="product-type">DRIED FRUITS</h5>
                                            <h3 class="product-name">Fresh Walnut</h3>
                                            <h3 class="product-price">$14.00</h3>
                                            <div class="product-select">
                                                <button data-toggle="tooltip" data-placement="top" title="Quick view" class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-12">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Add To Cart" onClick="window.location.href='cart.html'" class="add-to-cart round-icon-btn">
                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist round-icon-btn" onClick="window.location.href='wishlist.html'">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product">
                                            <a class="product-img" href="single_product.html"><img src="./assets/images/fruits/img-4.jpg" alt="" /></a>
                                            <a class="fa fa-star fa-star-half-full checked"></a>
                                            <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
                                            <a class="fa fa-star"></a> <a class="fa fa-star"></a>
                                            <h5 class="product-type">Fruits</h5>
                                            <h3 class="product-name">Black Cherries</h3>
                                            <h3 class="product-price">$14.00</h3>
                                            <div class="product-select">
                                                <button data-toggle="tooltip" data-placement="top" title="Quick view" class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-13">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Add To Cart" onClick="window.location.href='cart.html'" class="add-to-cart round-icon-btn">
                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist round-icon-btn" onClick="window.location.href='wishlist.html'">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product">
                                            <a class="product-img" href="single_product.html"><img src="./assets/images/fruits/img-5.jpg" alt="" /></a>
                                            <a class="fa fa-star checked"></a>
                                            <a class="fa fa-star checked"></a>
                                            <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
                                            <a class="fa fa-star"></a>
                                            <h5 class="product-type">Juice</h5>
                                            <h3 class="product-name">Strawberry Juices</h3>
                                            <h3 class="product-price">$14.00</h3>
                                            <div class="product-select">
                                                <button data-toggle="tooltip" data-placement="top" title="Quick view" class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-14">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Add To Cart" onClick="window.location.href='cart.html'" class="add-to-cart round-icon-btn">
                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist round-icon-btn" onClick="window.location.href='wishlist.html'">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product">
                                            <a class="product-img" href="single_product.html"><img src="./assets/images/fruits/img-1.jpg" alt="" /></a>
                                            <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
                                            <a class="fa fa-star"></a> <a class="fa fa-star"></a>
                                            <a class="fa fa-star"></a>
                                            <h5 class="product-type">DRIED FRUITS</h5>
                                            <h3 class="product-name">Fresh Walnut</h3>
                                            <h3 class="product-price">$14.00</h3>
                                            <div class="product-select">
                                                <button data-toggle="tooltip" data-placement="top" title="Quick view" class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-15">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Add To Cart" onClick="window.location.href='cart.html'" class="add-to-cart round-icon-btn">
                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist round-icon-btn" onClick="window.location.href='wishlist.html'">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="product">
                                            <a class="product-img" href="single_product.html"><img src="./assets/images/fruits/img-4.jpg" alt="" /></a>
                                            <a class="fa fa-star fa-star-half-full checked"></a>
                                            <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
                                            <a class="fa fa-star"></a> <a class="fa fa-star"></a>
                                            <h5 class="product-type">Fruits</h5>
                                            <h3 class="product-name">Black Cherries</h3>
                                            <h3 class="product-price">$14.00</h3>
                                            <div class="product-select">
                                                <button data-toggle="tooltip" data-placement="top" title="Quick view" class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-13">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Add To Cart" onClick="window.location.href='cart.html'" class="add-to-cart round-icon-btn">
                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                </button>
                                                <button data-toggle="tooltip" data-placement="top" title="Wishlist" class="add-to-wishlist round-icon-btn" onClick="window.location.href='wishlist.html'">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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
