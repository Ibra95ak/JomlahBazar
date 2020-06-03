<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />-->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <!-- Google Fonts -->
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Jomlah Bazar</title>
    <!-- main css -->
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/home-1.css" />
    <link rel="stylesheet" href="assets/vendor/revolution/vendor/revslider/css/settings.css" />
    <link rel="stylesheet" href="assets/vendor/revolution/responsiveslides.css" />
    <!-- main css -->
    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/common.css" />
    <!-- custom css -->
    <script>
        function searchjb() {
            var search_by = document.getElementById('search_by').value;
            var search_category = document.getElementById('search_category').value;
            var search = document.getElementById('search').value;
            switch (search_by) {
                case "1":
                    window.location.href = "brand-search.php?search_category=" + search_category + "&search=" + search;
                    break;
                case "2":
                    window.location = "product-search.php?search_category=" + search_category + "&search=" + search;
                    break;
                case "3":
                    window.location = "supplier-search.php?search_category=" + search_category + "&search=" + search;
                    break;
                case "4":
                    window.location = "buyer-search.php?search_category=" + search_category + "&search=" + search;
                    break;
                case "5":
                    window.location = "location-search.php?search_category=" + search_category + "&search=" + search;
                    break;
                default:
                    window.location = "search.php?search_category=" + search_category + "&search=" + search;
            }
        }
    </script>
</head>

<body>
    <!-- Navigation with search bar-->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top navbar-search-bar">
        <div class="container-fluid">
            <div class="row" style="flex: auto; height: 100%; align-items: center;">
                <div class="col-lg-2">
                    <a class="navbar-brand" href="index.php">
                        <h5>JomlaBazar</h5>
                    </a>
                </div>

                <div class="col-lg-6">
                    <div class="row pt-lg-0 pt-2">
                        <div class="top-dropdown">
                            <div class="all-cate custom-select2">
                                <select id="search_by" name="search_by">
                                    <option value="0">All</option>
                                    <option value="1">Brand</option>
                                    <option value="2">Products</option>
                                    <option value="3">Supplier</option>
                                    <option value="4">Buyer</option>
                                    <option value="5">Location</option>
                                </select>
                            </div>
                        </div>

                        <div class="top-dropdown">
                            <div class="all-cate custom-select2 sub-menu">
                                <select id="search_category" name="search_category">
                                    <option value="0">All</option>
                                    <?php
 require_once '../AdminPanel/libraries/Ser_Categories.php';
$db = new Ser_Categories();  
$categories = $db->GetCategories();
if($categories){
    foreach($categories as $category){
        echo '<option value="'.$category['categoryId'].'">'.$category['name'].'</option>';
    }
}                        
?>
                                </select>
                            </div>
                        </div>

                        <div class="col p-lg-0 pt-lg-0 pt-2">
                            <div class="input-group filter-by">
                                <input type="text" class="form-control" name="search" id="search" placeholder="What do you need?" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default search-bt" type="button" onclick="searchjb()">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="row no-gutters flex-nowrap justify-content-around">
                        <a href="#" class="language-toggle nav-a nav-a-2 nav-tool dropdown-toggle d-flex justify-content-center" style="color: white; padding: 5px;">
                            <span class="nav-line-2 text-nowrap"><img src="./assets/images/us-flag.jpg" width="24px" height="13px" />
                                <i class="fa fa-caret-down"></i>
                            </span>
                            <div class="language-dropdown dropdown dropdown-menu animate slideIn">
                                <a class="dropdown-item dropdown-text " href="#">English - EN</a>
                                <a class="dropdown-item dropdown-text" href="#">Espanol - ES</a>
                                <a class="dropdown-item dropdown-text" href="#">Deutsch - DE</a>
                                <a class="dropdown-item dropdown-text" href="#">العربية - AR</a>
                            </div>
                        </a>
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