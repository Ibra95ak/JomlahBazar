<?php
/*get base class*/
include('../AdminPanel/libraries/base.php');
/*get page header*/
include("header.php");
/*initialize filter*/
$filter="";
/* start::create filter*/
if(isset($_GET['page'])) $page=$_GET['page'];
else $page=1;
if(isset($_GET['search_by'])) $filter.="&search_by=".$_GET['search_by'];
if(isset($_GET['filter_category'])) $filter.="&filter_category=".$_GET['filter_category'];
if(isset($_GET['search'])) $filter.="&search=".$_GET['search'];
if(isset($_GET['order_by'])) $filter.="&order_by=".$_GET['order_by'];
if(isset($_GET['min_price'])) $filter.="&min_price=".$_GET['min_price'];
if(isset($_GET['max_price'])) $filter.="&max_price=".$_GET['max_price'];
if(isset($_GET['fp'])) $filter.="&fp=".$_GET['fp'];
if(isset($_GET['bp'])) $filter.="&bp=".$_GET['bp'];
if(isset($_GET['dp'])) $filter.="&dp=".$_GET['dp'];
if(isset($_GET['filter_brand'])) $filter.="&filter_brand=".$_GET['filter_brand'];
if(isset($_GET['filter_rank'])) $filter.="&filter_rank=".$_GET['filter_rank'];
if(isset($_GET['filter_location'])) $filter.="&filter_location=".$_GET['filter_location'];
/* end::create filter*/
/*Fetch  products through API*/
$API_products = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Products.php?".$filter);
$products = json_decode($API_products);
/*Fetch best sellers products through API*/
$API_bestsellers_products= file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_BestSellerProducts.php");
$bestsellers_products = json_decode($API_bestsellers_products);
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
                    <div class="clearfix"></div>
                    <div class="row">
                        <?php
if($products){
  foreach($products->products as $product){
    echo '<div class="col-lg-3 col-md-4 col-sm-6 product-card-col">';
    echo '<div class="product product-card">';
    echo '<div id="carousel-'.$product->productId.'" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
    $i=0;
    foreach ($product->imgs as $img) {
      $i++;
      if($i==1) echo '<div class="carousel-item active"> <a class="product-img" href="single_product.php?productId='.$product->productId.'"><img src="../AdminPanel/pics/'.$img->path.'" alt=""></a> </div>';
      else echo '<div class="carousel-item"> <a class="product-img" href="single_product.php?productId='.$product->productId.'"><img src="../AdminPanel/pics/'.$img->path.'" alt=""></a> </div>';
    }
    echo '</div>';
    if($i!=1)
    echo '<a class="carousel-control-prev" href="#carousel-'.$product->productId.'" role="button" data-slide="prev"> <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> </a> <a class="carousel-control-next" href="#carousel-'.$product->productId.'" role="button" data-slide="next"> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a> ';
echo '</div>';
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


                        <div class="clearfix"></div>

                        <!-- Start - Bestsellers Products -->
                        <div id="bestsellers">
                            <div class="container">
                                <h2 class="wow fadeInDown">Bestsellers</h2>
                                <div class="owl-carousel latest-products owl-theme wow fadeIn">
                                    <?php
                        if($bestsellers_products){
                          foreach($bestsellers_products as $bestseller){
                            echo '<div class="item"><div class="product">';
                            echo '<a class="product-img" href="single_product.php?productId='.$bestseller->productId.'"><img src="../AdminPanel/pics/'.$bestseller->path.'" alt=""></a>';
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
                        <!-- End - Bestsellers Products -->

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
