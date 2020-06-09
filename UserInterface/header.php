<?php
/*Get base class*/
require_once '../AdminPanel/libraries/base.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.ico" />
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
    <!-- Search bar redirection -->
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
    <!-- Search bar redirection -->
</head>

<body>
    <!-- Navigation with search bar-->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top navbar-search-bar">
        <div class="container-fluid">
            <div class="row" style="flex: auto; height: 100%; align-items: center;">
                <div class="col-lg-2">
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/images/logo.png" alt="" title="" class="img-fluid">
                    </a>
                </div>

                <div class="col-lg-5">
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
/*Fetch categories through API*/
$API_categories= file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Categories.php");
$categories = json_decode($API_categories);
if($categories){
    foreach($categories as $category){
        echo '<option value="'.$category->categoryId.'">'.$category->name.'</option>';
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
                <div class="col-lg-3">
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="Dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img src="../AdminPanel/pics/flags/flag-uae.png" style="width: 35px;"> </a>
                                <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="Dropdown1"> <a class="dropdown-item" href="index.html">UAE</a></div>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="Dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hello sigin</a>
                                <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="Dropdown1"> <a class="dropdown-item" href="index.html">Login</a><a class="dropdown-item" href="index.html">Register</a></div>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="dropdown"> <a class="dropdown-toggle link" href="" data-toggle="dropdown"><i class="fa fa-cart-plus" aria-hidden="true"></i><span class="circle-2">5</span></a>
                                <div class="dropdown-menu dropdown-menu2 dropdown-menu-right animate slideIn">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3"><img src="assets/images/fruits/img-1.jpg" alt="" title="" class="img-fluid"></div>
                                            <div class="col-md-9">
                                                <p>1 x Product Name... <span class="price">$ 14.70</span></p>
                                                <a href="" class="close">x</a>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <input type="button" value="Check out" class="btn check-out w-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2"> <a class="link" href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Deliver to<b> UAE</b></a></div>
            </div>
        </div>
    </nav>
    <div class="container-fluid" id="bottom-navbar">
        <div class="row align-items-center" style="padding:0 0 3px 0">
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