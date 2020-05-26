<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <!-- Google Fonts -->

  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Organic store</title>

  <!-- main css -->
  <link rel="stylesheet" href="assets/css/main.css" />
  <link rel="stylesheet" href="assets/css/home-1.css" />
  <link rel="stylesheet" href="assets/vendor/revolution/vendor/revslider/css/settings.css" />
  <link rel="stylesheet" href="assets/vendor/revolution/responsiveslides.css" />
  <!-- main css -->

  <!-- custom css -->
  <link rel="stylesheet" href="assets/css/common.css" />
  <!-- custom css -->
</head>

<body>
  <!-- Navigation with search bar-->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top navbar-search-bar">
    <div class="container-fluid">
      <div class="row" style="flex: auto; height: 100%; align-items: center;">
        <div class="col-lg-2">
          <a class="navbar-brand" href="index.html">
            <h5>JomlaBazar</h5>
          </a>
        </div>

        <div class="col-lg-6">
          <div class="row pt-lg-0 pt-2">
            <div class="top-dropdown">
              <div class="all-cate custom-select2">
                <select>
                  <option>All</option>
                  <option>Brand</option>
                  <option>Products</option>
                  <option>Supplier</option>
                  <option>Buyer</option>
                  <option>Location</option>
                </select>
              </div>
            </div>

            <div class="top-dropdown">
              <div class="all-cate custom-select2 sub-menu">
                <select disabled>
                  <option>Sub All</option>
                  <option>Brand</option>
                  <option>Products</option>
                  <option>Supplier</option>
                  <option>Buyer</option>
                  <option>Location</option>
                </select>
              </div>
            </div>

            <div class="col p-lg-0 pt-lg-0 pt-2">
              <div class="input-group filter-by">
                <input type="hidden" name="search_param" value="all" id="search_param" />
                <input type="text" class="form-control" name="x" placeholder="What do you need?" />
                <span class="input-group-btn">
                  <button class="btn btn-default search-bt" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="row no-gutters flex-nowrap justify-content-around">
            <a class="nav-a nav-a-2 nav-tool">
              <span class="nav-line-1">Hello sigin</span>
              <span class="nav-line-2 text-nowrap">Account & lists
                <i class="fa fa-caret-down nav-icon nav-arrow"></i></span>
            </a>

            <a class="nav-a nav-a-2 nav-tool">
              <span class="nav-line-1">Returns</span>
              <span class="nav-line-2 text-nowrap">& Orders </span>
            </a>

            <a class="nav-a nav-a-2 text-center nav-tool">
              <div style="display: flex;">
                <div class="nav-line-2 text-nowrap" style="width: 60%; position: relative; float: left;">
                  <span class="nav-line-1 nav-cart-count font-weight-bold" style="
                        position: absolute;
                        top: 0;
                        left: 43%;
                        color: #f08804;
                        font-size: 16px;
                        width: 19px;
                      ">9</span>
                  <img src="./assets/images/cart.png" />
                </div>

                <div style="
                      width: 40%;
                      right: 8px;
                      position: relative;
                      top: 22px;
                    ">
                  Cart
                </div>
              </div>
            </a>
          </div>
          <!-- <div class="" id="navbarResponsive">
        <div class="rate-price nav-1">
          <ul>
            <li class="dropdown">
              <a class="dropdown-toggle" href="" data-toggle="dropdown">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i
              ></a>
              <div
                class="dropdown-menu dropdown-menu-right animate slideIn"
              >
                <a class="dropdown-item" href="login.html">Login</a>
                <a class="dropdown-item" href="my-account.html"
                  >My Account</a
                >
                <a class="dropdown-item" href="register.html">Register</a>
                <a class="dropdown-item" href="forgot-password.html"
                  >Forgot Password</a
                >
              </div>
            </li>
            <li>
              <a href="wishlist.html"
                ><i class="fa fa-heart-o" aria-hidden="true"></i
                ><span class="circle-2">1</span></a
              >
            </li>
            <li class="dropdown">
              <a
                class="dropdown-toggle link"
                href=""
                data-toggle="dropdown"
                ><i class="fa fa-shopping-bag" aria-hidden="true"></i
                ><span class="circle-2">1</span></a
              >
              <div
                class="dropdown-menu dropdown-menu2 dropdown-menu-right animate slideIn"
              >
                <div class="container">
                  <div class="row">
                    <div class="col-md-3">
                      <img
                        src="./assets/images/fruits/img-1.jpg"
                        alt=""
                        title=""
                        class="img-fluid"
                      />
                    </div>
                    <div class="col-md-9">
                      <p>
                        1 x Product Name...
                        <span class="price">$ 14.70</span>
                      </p>
                      <a href="" class="close">x</a>
                    </div>
                    <div class="col-md-12">
                      <hr />
                    </div>
                    <div class="col-md-3">
                      <img
                        src="./assets/images/fruits/img-2.jpg"
                        alt=""
                        title=""
                        class="img-fluid"
                      />
                    </div>
                    <div class="col-md-9">
                      <p>
                        1 x Product Name...
                        <span class="price">$ 14.70</span>
                      </p>
                      <a href="" class="close">x</a>
                    </div>
                    <div class="col-md-12">
                      <hr />
                    </div>
                    <div class="col-md-3">
                      <img
                        src="assets/images/fruits/img-3.jpg"
                        alt=""
                        title=""
                        class="img-fluid"
                      />
                    </div>
                    <div class="col-md-9">
                      <p>
                        1 x Product Name...
                        <span class="price">$ 14.70</span>
                      </p>
                      <a href="" class="close">x</a>
                    </div>
                    <div class="col-md-12">
                      <hr />
                    </div>
                    <div class="col-md-3">
                      <img
                        src="assets/images/fruits/img-4.jpg"
                        alt=""
                        title=""
                        class="img-fluid"
                      />
                    </div>
                    <div class="col-md-9">
                      <p>
                        1 x Product Name...
                        <span class="price">$ 14.70</span>
                      </p>
                      <a href="" class="close">x</a>
                    </div>
                    <div class="col-md-12">
                      <hr />
                    </div>
                    <div class="col-md-3">
                      <p class="font-15">Tax</p>
                    </div>
                    <div class="col-md-9 text-right">
                      <span class="font-15">$ 2.80</span>
                    </div>
                    <div class="col-md-12">
                      <hr />
                    </div>
                    <div class="col-md-3">
                      <p class="font-15"><strong>Total</strong></p>
                    </div>
                    <div class="col-md-9 text-right">
                      <span class="font-15"
                        ><strong>$ 10.80</strong></span
                      >
                    </div>
                    <div class="col-md-12">
                      <hr />
                    </div>
                    <div class="col-md-12 text-center">
                      <input
                        type="button"
                        value="Check out"
                        class="btn check-out w-100"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div> -->
        </div>
      </div>
    </div>
  </nav>




  <div class="container-fluid" id="bottom-navbar">
    <div class="row align-items-center" style="padding:0 0 3px 0">

      <div class="col-lg-2">
        <div class="row align-items-center deliver-to-uae">
          <div class="col-2"><img src="./assets/images/location.png" /></div>
          <div style="display:inline;" class="col-10">
            <span class="nav-line-1" id="glow-ingress-line1">
              Deliver to
            </span>
            <span class="nav-line-2">
              United Arab Emirates
            </span>
          </div>
        </div>

      </div>

      <div class="col-6">
        <div class="row">
        <a href="#" class="nav-a bottom-nav"> Today's Deals </a>
        <a href="#" class="nav-a bottom-nav"> Customer Service </a>
        <a href="#" class="nav-a bottom-nav"> Gift Cards </a>
        <a href="#" class="nav-a bottom-nav"> Registry </a>
        <a href="#" class="nav-a bottom-nav"> Sell </a></div>

      </div>
    </div>
  </div>
  <!-- Navigation with search bar-->

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
            <h6 class="text-white" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
              data-animation-in="fadeInUp" data-delay-in=".1">
              Extra 50% Off For All Winter Product
            </h6>
            <h2 class="mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
              data-animation-in="fadeInUp" data-delay-in=".4" style="color: white !important;">
              Welcome to<br />
              JomlahBazar
            </h2>
            <a href="" class="btn our-services" data-animation-out="fadeOutRight" data-delay-out="5"
              data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".7">Our Services
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
            <h6 class="text-white" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
              data-animation-in="fadeInUp" data-delay-in=".1">
              Wholesale Products
            </h6>
            <h2 class="mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
              data-animation-in="fadeInUp" data-delay-in=".4" style="color: white !important;">
              Contact With Thousands of Wholesale Dealers
            </h2>
            <a href="contact.html" class="btn our-services" data-animation-out="fadeOutRight" data-delay-out="5"
              data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".7">Search Wholesale Dealers
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
        <div class="item">
          <div class="product">
            <div class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="badge">
                    <div class="text">Sale 10%</div>
                    <a class="product-img" href="single_product.html"><img src="assets/images/730870120156.jpg"
                        alt="" /></a>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="badge">
                    <div class="text">Sale 10%</div>
                    <a class="product-img" href="single_product.html"><img src="assets/images/730870120156.jpg"
                        alt="" />
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">MA VIE</h3>
            <h3 class="product-price">$10.00 <del>$35.00</del></h3>

          </div>
        </div>
        <div class="item">
          <div class="product">
            <div class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="badge">
                    <div class="text">Sale 15%</div>
                    <a class="product-img" href="single_product.html"><img src="assets/images/730870196885.jpg"
                        alt="" /></a>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="badge">
                    <div class="text">Sale 15%</div>
                    <a class="product-img" href="single_product.html"><img src="assets/images/730870196885.jpg"
                        alt="" />
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00 <del>$35.00</del></h3>

          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="featured-products">
    <div class="container">
      <h2 class="wow fadeInDown">Featured Products</h2>
      <div class="owl-carousel latest-products owl-theme wow fadeIn">
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <div class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="badge">
                    <div class="text">Sale 10%</div>
                    <a class="product-img" href="single_product.html"><img src="assets/images/730870120156.jpg"
                        alt="" /></a>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="badge">
                    <div class="text">Sale 10%</div>
                    <a class="product-img" href="single_product.html"><img src="assets/images/730870120156.jpg"
                        alt="" />
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">MA VIE</h3>
            <h3 class="product-price">$10.00 <del>$35.00</del></h3>

          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Three-images-->
  <div class="three-img">
    <div class="container">
      <h2 class="wow fadeInDown">Featured Category</h2>
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 text-center wow fadeIn mb-3">
          <ul class="ch-grid">
            <li>
              <div class="ch-item" style="
                    background: url(assets/images/product/left-img.jpg)
                      no-repeat center top;
                    background-size: 100% 100%;
                  ">
                <div class="ch-info">
                  <div class="img-text">
                    <h3>Fresh Oregano</h3>
                    <p>Oregano</p>
                    <p>Apricots</p>
                    <p>Bananas</p>
                    <p>Cantaloupe</p>
                    <a href="#">view more</a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 text-center wow fadeIn mb-3">
          <ul class="ch-grid">
            <li>
              <div class="ch-item" style="
                    background: url(assets/images/product/center-img.jpg)
                      no-repeat center top;
                    background-size: 100% 100%;
                  ">
                <div class="ch-info">
                  <div class="img-text">
                    <h3>Fresh Apple</h3>
                    <p>Apple</p>
                    <p>Wheatgrass</p>
                    <p>Arrowroot</p>
                    <p>Grapefruit</p>
                    <a href="#">view more</a>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-6 text-center wow fadeIn mb-3">
          <div class="position-relative">
            <ul class="ch-grid">
              <li>
                <div class="ch-item" style="
                      background: url(assets/images/product/right-img.jpg)
                        no-repeat center top;
                      background-size: 100% 100%;
                    ">
                  <div class="ch-info">
                    <div class="img-text">
                      <h3>Mango Shake</h3>
                      <p>Pear</p>
                      <p>Apricots</p>
                      <p>Bananas</p>
                      <p>Cantaloupe</p>
                      <a href="#">view more</a>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Three-images-->
  <div id="bestsellers">
    <div class="container">
      <h2 class="wow fadeInDown">Bestsellers</h2>
      <div class="owl-carousel latest-products owl-theme wow fadeIn">
        <div class="item">
          <div class="product">
            <div class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="badge">
                    <div class="text">Sale 10%</div>
                    <a class="product-img" href="single_product.html"><img src="assets/images/730870120156.jpg"
                        alt="" /></a>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="badge">
                    <div class="text">Sale 10%</div>
                    <a class="product-img" href="single_product.html"><img src="assets/images/730870120156.jpg"
                        alt="" />
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">MA VIE</h3>
            <h3 class="product-price">$10.00 <del>$35.00</del></h3>

          </div>
        </div>

        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/730870196885.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/730870196885.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/730870196885.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
        <div class="item">
          <div class="product">
            <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
            <h5 class="product-type">Perfume</h5>
            <h3 class="product-name">HUGO BOSS</h3>
            <h3 class="product-price">$10.00</h3>
          </div>
        </div>
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
                  <a href="shop.html"><img src="assets/images/page-img/sale.jpg" class="img-fluid" alt=""
                      title="" /></a>
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
              <div class="carousel-item">
                <figure class="imghvr-push-right">
                  <a href="shop.html"><img src="assets/images/page-img/sale3.jpg" class="img-fluid" alt=""
                      title="" /></a>
                  <figcaption>
                    <h3>Bestsellers</h3>
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
                <img src="assets/images/page-img/sale2.jpg" class="img-fluid" alt="" title="" />
              </div>
              <div class="carousel-item">
                <img src="assets/images/page-img/sale4.jpg" class="img-fluid" alt="" title="" />
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
          <div class="item">
            <div class="product">
              <div class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="badge">
                      <div class="text">Sale 10%</div>
                      <a class="product-img" href="single_product.html"><img src="assets/images/730870120156.jpg"
                          alt="" /></a>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="badge">
                      <div class="text">Sale 10%</div>
                      <a class="product-img" href="single_product.html"><img src="assets/images/730870120156.jpg"
                          alt="" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <h5 class="product-type">Perfume</h5>
              <h3 class="product-name">MA VIE</h3>
              <h3 class="product-price">$10.00 <del>$35.00</del></h3>

            </div>
          </div>

          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"><img src="assets/images/730870196885.jpg" alt="" /></a>
              <h5 class="product-type">Perfume</h5>
              <h3 class="product-name">HUGO BOSS</h3>
              <h3 class="product-price">$10.00</h3>
            </div>
          </div>
          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"><img src="assets/images/730870196885.jpg" alt="" /></a>
              <h5 class="product-type">Perfume</h5>
              <h3 class="product-name">HUGO BOSS</h3>
              <h3 class="product-price">$10.00</h3>
            </div>
          </div>
          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"><img src="assets/images/730870196885.jpg" alt="" /></a>
              <h5 class="product-type">Perfume</h5>
              <h3 class="product-name">HUGO BOSS</h3>
              <h3 class="product-price">$10.00</h3>
            </div>
          </div>
          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
              <h5 class="product-type">Perfume</h5>
              <h3 class="product-name">HUGO BOSS</h3>
              <h3 class="product-price">$10.00</h3>
            </div>
          </div>
          <div class="item">
            <div class="product">
              <a class="product-img" href="single_product.html"><img src="assets/images/737052041285.jpg" alt="" /></a>
              <h5 class="product-type">Perfume</h5>
              <h3 class="product-name">HUGO BOSS</h3>
              <h3 class="product-price">$10.00</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
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
  <div id="newsletter">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h4>Join Our Newsletter Now</h4>
          <p class="m-0">
            Get E-mail updates about our latest shop and special offers.
          </p>
        </div>
        <div class="col-md-5">
          <form action="/" method="post" id="subsForm" onSubmit="return ajaxmailsubscribe();">
            <div class="input-group">
              <input type="email" name="subsemail" id="subsemail" class="form-control newsletter"
                placeholder="Enter your mail" />
              <span class="input-group-btn">
                <button class="btn btn-theme" type="button" onClick="return ajaxmailsubscribe();">
                  Subscribe
                </button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <div id="popup-1" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/product-big-1.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div>
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4 p-0">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-1"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4 p-0">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-2" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/kiwi.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div>
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4 p-0">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-2"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4 p-0">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-3" class="popup-fcy">
    <div class="row">
      <div class="col-md-6">
        <img src="assets/images/product-img/orange.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-3"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-4" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/acai-berry.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-4"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-5" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/maracuja.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-5"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-6" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/cucumber.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-6"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-7" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/mushroom.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-7"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-8" class="popup-fcy">
    <div class="row">
      <div class="col-md-6">
        <img src="assets/images/product-img/persimmon.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-8"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-9" class="popup-fcy">
    <div class="row">
      <div class="col-md-6">
        <img src="assets/images/product-img/nectarine.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-9"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-10" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/kiwi.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div>
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4 p-0">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-2"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4 p-0">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-11" class="popup-fcy">
    <div class="row">
      <div class="col-md-6">
        <img src="assets/images/product-img/orange.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-3"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-12" class="popup-fcy">
    <div class="row">
      <div class="col-md-6">
        <img src="assets/images/product-img/orange.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-3"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-13" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/maracuja.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-5"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-14" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/cucumber.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-6"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-15" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/mushroom.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-7"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-16" class="popup-fcy">
    <div class="row">
      <div class="col-md-6">
        <img src="assets/images/product-img/persimmon.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-8"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-17" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/maracuja.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-5"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-18" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/cucumber.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-6"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-19" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/mushroom.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div class="wrap_compare">
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-7"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-20" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/product-big-1.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div>
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4 p-0">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-1"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4 p-0">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="popup-21" class="popup-fcy">
    <div class="row">
      <div class="col-md-6 text-center">
        <img src="assets/images/product-img/kiwi.jpg" alt="" title="" class="img-fluid" />
      </div>
      <div class="col-md-6">
        <div class="product_meta">
          <p>Availability : <span>not in Stock</span></p>
          <p>Categories : <span>Vegetable Fruit</span></p>
          <p>Tags : <span>fruit green health organic</span></p>
        </div>
        <div class="product-dis">
          <h3>Products Name</h3>
          <hr />
          <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard dummy text
            ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it to make a type specimen book when an unknown
            printer took a galley of type and scrambled it to make a type
            specimen bookwhen an unknown printer took a galley of type and
            scrambled it to make a type specimen book. remaining essentially
            unchanged. It has survived not only five centuries, but also the
            leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <div class="row">
            <div class="col-2 pr-0">
              <input type="number" class="input-text qty text" step="1" min="1" max="50" name="quantity" value="1"
                title="Qty" size="4" />
            </div>
            <div class="col-10">
              <div>
                <div class="row">
                  <div class="col-6">
                    <div class="add_to_cart">
                      <a href="" class="">ADD TO CART</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-4 p-0">
              <hr class="m-0 p-0" />
            </div>
            <div class="pb-3 pt-3">
              <div class="left-icon">
                <a class="add-to-compare round-icon-btn" data-fancybox="gallery" data-src="#popup-2"
                  href="javascript:;">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="mr-3"><i class="fa fa-balance-scale" aria-hidden="true"></i></a>
              </div>
            </div>
            <div class="col-md-12 mb-4 p-0">
              <hr class="m-0 p-0" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--bootstrap-->
  <!-- Footer -->
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 address wow fadeInLeft">
        <div class="footer-logo">
          <img src="assets/images/logo.png" alt="" title="" class="img-fluid" />
        </div>
        <p>Address: 123-45 Road 11378 Manchester</p>
        <p>Phone: +12 3456 78901</p>
        <p>
          Email:
          <a href="mailto:info.organicstore@gmail.com">info.organicstore@gmail.com</a>
        </p>
        <ul class="social-2">
          <li>
            <a href="#" title="facebook"><i class="fa fa-facebook"></i></a>
          </li>
          <li>
            <a href="#" title="instagram +"><i class="fa fa-instagram"></i></a>
          </li>
          <li>
            <a href="#" title="twitter"><i class="fa fa-twitter"></i></a>
          </li>
          <li>
            <a href="#" title="Linkedin"><i class="fa fa-pinterest"></i></a>
          </li>
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
        <h3>Quick Link</h3>
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
        <div class="col-md-6 text-white">
          Copyright © 2020 <a href="">Organic Store </a>- All Rights Reserved.
        </div>
        <div class="col-md-6 payment">
          <div class="pull-right">
            <a href=""><img src="assets/images/skrill.png" alt="" title="" /></a>
            <a href=""><img src="assets/images/ob.png" alt="" title="" /></a>
            <a href=""><img src="assets/images/paypal.png" alt="" title="" /></a>
            <a href=""><img src="assets/images/am.png" alt="" title="" /></a>
            <a href=""><img src="assets/images/mr.png" alt="" title="" /></a>
            <a href=""><img src="assets/images/visa.png" alt="" title="" /></a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="assets/vendor/home-banner/jquery.min.js"></script>
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/js/ajax.js"></script>
  <script src="assets/js/formValidation.js"></script>
  <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--bootstrap-->
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
  <!--select-dropdown-->
  <script src="assets/vendor/jquery/custom-select.js"></script>
  <!--select-dropdown-->
  <!--fancybox files -->
  <link rel="stylesheet" href="assets/css/product-hover.css" />
  <link rel="stylesheet" href="assets/vendor/fancy-box/fancybox.min.css" />
  <script src="assets/vendor/fancy-box/jquery.fancybox.min.js"></script>
  <!--fancybox files -->

  <script src="assets/vendor/slick/slick.min.js"></script>
  <script src="assets/vendor/slick/script.js"></script>
  <!--banner js-->
  <!-- <script src="assets/vendor/revolution/vendor/revslider/js/jquery.themepunch.tools.min.js"></script>
    <script src="assets/vendor/revolution/vendor/revslider/js/jquery.themepunch.revolution.min.js"></script>
    <script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="assets/vendor/revolution/vendor/revslider/js/extensions/revolution.extension.slideanims.min.js"></script> -->
  <script src="assets/js/banner.js"></script>
  <!--banner js-->
  <!--scrolltop-->
  <script src="assets/vendor/jquery/scrolltopcontrol.js"></script>
  <script src="assets/vendor/revolution/responsiveslides.min.js"></script>
  <!--scrolltop-->

  <p data-toggle="modal" class="no-margin" data-target="#myModal" id="model2"></p>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog2">
      <div class="modal-content text-center">
        <div class="modal-body modal-body2">
          <button type="button" class="close" data-dismiss="modal">
            &times;
          </button>
          <p><img src="assets/images/success.svg" width="50" /></p>
          <h3 class="modal-title">Thank you</h3>
          <h4 class="thanks mt-2">
            Your submission is recevied and we will contact you soon.
          </h4>
          <a href="https://themeforest.net/item/organic-store-multipurpose-ecommerce-bootstrap-html5-template/23986984"
            target="_blank" class="btn add-to-cart2 d-inline-block font-15 rounded">BUY THIS TEMPLATE NOW</a>
          <a href="index.html" class="back-to-home d-block small mt-2"><i class="fa fa-long-arrow-left"></i> BACK TO
            HOME</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>