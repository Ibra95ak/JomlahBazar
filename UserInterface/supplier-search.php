<?php 
include('../AdminPanel/libraries/base.php');
include("header.php");
$search_category=$_GET['search_category'];
$search=$_GET['search'];
?>
    <div class="container container-fluid">
      <nav aria-label="breadcrumb" class="bread-boder">
        <div class="row">
          <div class="col-lg-8 col-md-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.html"
                  ><i class="fa fa-home" aria-hidden="true"></i> Home</a
                >
              </li>
              <li class="breadcrumb-item">Suppliers</li>
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
      <div class="row">
<?php include("filters.php");?>
          <div class="col-lg-10 col-md-12">
          <div class="row">
            <div class="col-12">
              <div class="clearfix"></div>

              <div class="row">
<?php
require_once '../AdminPanel/libraries/Ser_Suppliers.php';
$db = new Ser_Suppliers();
if($search!=NULL) $suppliers = $db->SearchSuppliers($search);
else $suppliers = $db->Getsuppliers(); 

if($suppliers){
  foreach($suppliers as $supplier){
      echo '<div class="col-lg-12 col-md-12">';
      echo '<div class="supplier-card">';
      echo '<div class="row flex-lg-row flex-md-row flex-sm-row flex-column">';
      echo '<div class="col-lg-4 col-md-4 col-sm-4 col-12">';
      echo '<a class="product-img" href="supplier-details.php?supplierId='.$supplier['supplierId'].'"><img src="assets/images/product-img/product-img-1.jpg" alt="" /></a>';
      echo '</div>';
      echo '<div class="col-lg-8 col-md-8 col-sm-8 col-12 supplier-card-details">';
      echo '<h5 class="supplier-card-title text-left">'.$supplier['email'].'</h5>';
      echo '<div class="row m-0">';
      echo '<div class="col-lg-12 p-0">';
      echo '<span class="fa fa-star-o checked " data-rating="1"></span><span class="fa fa-star-o" data-rating="2"></span><span class="fa fa-star-o" data-rating="3"></span><span class="fa fa-star-o" data-rating="4"></span><span class="fa fa-star-o" data-rating="5"></span><input type="hidden" name="whatever1" class="rating-value" value="2.56">';
      echo '<h5 class="product-price">'.$supplier['name'].'</h5>';
      echo '<span class="">'.$supplier['type'].'</span>';
      echo '</div></div>';
      echo '<div class=""><button data-toggle="tooltip" data-placement="top" title="Contact Supplier" class="add-to-compare contact-supplier-btn" data-fancybox="gallery" data-src="#popup-1"><i class="fa fa-contact" aria-hidden="true"></i>Contact Supplier</button></div></div></div></div></div>';
      echo '';
      echo '';
  }
}
?>


                <div class="clearfix"></div>
                <div class="col text-center">
                  <nav aria-label="Page navigation example">
                    <ul
                      class="pagination pagination-template d-flex justify-content-center float-none"
                    >
                      <li class="page-item">
                        <a href="#" class="page-link">
                          <i class="fa fa-angle-left"></i
                        ></a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link active">1</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">2</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">3</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">
                          <i class="fa fa-angle-right"></i
                        ></a>
                      </li>
                    </ul>
                  </nav>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>

    <!--Three-images-->
    <div id="bestsellers">
      <div class="container">
        <h2 class="wow fadeInDown">Bestsellers</h2>
        <div class="owl-carousel latest-products owl-theme wow fadeIn">
          <div class="item">
            <div class="product">
              <div id="carousel-2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="badge">
                      <div class="text">Sale 14%</div>
                      <a class="product-img" href="single_product.html"
                        ><img
                          src="./assets/images/product-img/product-img-1.jpg"
                          alt=""
                        />
                      </a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="badge">
                      <div class="text">Sale 14%</div>
                      <a class="product-img" href="single_product.html"
                        ><img
                          src="./assets/images/product-img/product-img-2.jpg"
                          alt=""
                      /></a>
                    </div>
                  </div>
                </div>
                <a
                  class="carousel-control-prev"
                  href="#carousel-2"
                  role="button"
                  data-slide="prev"
                >
                  <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                </a>
                <a
                  class="carousel-control-next"
                  href="#carousel-2"
                  role="button"
                  data-slide="next"
                >
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
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Quick view"
                  class="add-to-compare round-icon-btn"
                  data-fancybox="gallery"
                  data-src="#popup-11"
                >
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Wishlist"
                  class="add-to-wishlist round-icon-btn"
                  onClick="window.location.href='wishlist.html'"
                >
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Add To Cart"
                  onClick="window.location.href='cart.html'"
                  class="add-to-cart round-icon-btn"
                >
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"
                ><img src="./assets/images/fruits/img-3.jpg" alt=""
              /></a>
              <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
              <a class="fa fa-star"></a> <a class="fa fa-star"></a>
              <a class="fa fa-star"></a>
              <h5 class="product-type">DRIED FRUITS</h5>
              <h3 class="product-name">Fresh Walnut</h3>
              <h3 class="product-price">$14.00</h3>
              <div class="product-select">
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Quick view"
                  class="add-to-compare round-icon-btn"
                  data-fancybox="gallery"
                  data-src="#popup-12"
                >
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Add To Cart"
                  onClick="window.location.href='cart.html'"
                  class="add-to-cart round-icon-btn"
                >
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Wishlist"
                  class="add-to-wishlist round-icon-btn"
                  onClick="window.location.href='wishlist.html'"
                >
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"
                ><img src="./assets/images/fruits/img-4.jpg" alt=""
              /></a>
              <a class="fa fa-star fa-star-half-full checked"></a>
              <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
              <a class="fa fa-star"></a> <a class="fa fa-star"></a>
              <h5 class="product-type">Fruits</h5>
              <h3 class="product-name">Black Cherries</h3>
              <h3 class="product-price">$14.00</h3>
              <div class="product-select">
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Quick view"
                  class="add-to-compare round-icon-btn"
                  data-fancybox="gallery"
                  data-src="#popup-13"
                >
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Add To Cart"
                  onClick="window.location.href='cart.html'"
                  class="add-to-cart round-icon-btn"
                >
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Wishlist"
                  class="add-to-wishlist round-icon-btn"
                  onClick="window.location.href='wishlist.html'"
                >
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"
                ><img src="./assets/images/fruits/img-5.jpg" alt=""
              /></a>
              <a class="fa fa-star checked"></a>
              <a class="fa fa-star checked"></a>
              <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
              <a class="fa fa-star"></a>
              <h5 class="product-type">Juice</h5>
              <h3 class="product-name">Strawberry Juices</h3>
              <h3 class="product-price">$14.00</h3>
              <div class="product-select">
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Quick view"
                  class="add-to-compare round-icon-btn"
                  data-fancybox="gallery"
                  data-src="#popup-14"
                >
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Add To Cart"
                  onClick="window.location.href='cart.html'"
                  class="add-to-cart round-icon-btn"
                >
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Wishlist"
                  class="add-to-wishlist round-icon-btn"
                  onClick="window.location.href='wishlist.html'"
                >
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"
                ><img src="./assets/images/fruits/img-1.jpg" alt=""
              /></a>
              <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
              <a class="fa fa-star"></a> <a class="fa fa-star"></a>
              <a class="fa fa-star"></a>
              <h5 class="product-type">DRIED FRUITS</h5>
              <h3 class="product-name">Fresh Walnut</h3>
              <h3 class="product-price">$14.00</h3>
              <div class="product-select">
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Quick view"
                  class="add-to-compare round-icon-btn"
                  data-fancybox="gallery"
                  data-src="#popup-15"
                >
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Add To Cart"
                  onClick="window.location.href='cart.html'"
                  class="add-to-cart round-icon-btn"
                >
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Wishlist"
                  class="add-to-wishlist round-icon-btn"
                  onClick="window.location.href='wishlist.html'"
                >
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"
                ><img src="./assets/images/fruits/img-4.jpg" alt=""
              /></a>
              <a class="fa fa-star fa-star-half-full checked"></a>
              <a class="fa fa-star checked"></a> <a class="fa fa-star"></a>
              <a class="fa fa-star"></a> <a class="fa fa-star"></a>
              <h5 class="product-type">Fruits</h5>
              <h3 class="product-name">Black Cherries</h3>
              <h3 class="product-price">$14.00</h3>
              <div class="product-select">
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Quick view"
                  class="add-to-compare round-icon-btn"
                  data-fancybox="gallery"
                  data-src="#popup-13"
                >
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Add To Cart"
                  onClick="window.location.href='cart.html'"
                  class="add-to-cart round-icon-btn"
                >
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </button>
                <button
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Wishlist"
                  class="add-to-wishlist round-icon-btn"
                  onClick="window.location.href='wishlist.html'"
                >
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
<?php 
include("footer.php");
?>