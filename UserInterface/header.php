<?php
/*Get base class*/
require_once '../AdminPanel/libraries/base.php';
/*Search bar parameters*/
if(isset($_GET['search_by'])) $search_by=$_GET['search_by'];
/*Geolocation from IP address*/
$ip ="91.74.36.249";
$access_key = 'b2371fd9df5c66211f9d821177c6b601';
/*Initialize CURL:*/
$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
/*Store the data:*/
$json = curl_exec($ch);
curl_close($ch);
/*Decode JSON response:*/
$api_result = json_decode($json, true);
/*Fetch the "country_code" object*/
$location=$api_result['country_code'];
/*Fetch cart products count through API*/
$API_cart_count = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Count_Cart.php?userId=1");
$cart_count = json_decode($API_cart_count); 
/*Fetch wishlist products count through API*/
$API_wishlist_count = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Count_Wishlist.php?userId=1");
$wishlist_count = json_decode($API_wishlist_count); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/logo.ico" />
    <title>JB</title>
    <!-- main css -->
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/home-1.css" />
    <link rel="stylesheet" href="assets/vendor/revolution/vendor/revslider/css/settings.css" />
    <link rel="stylesheet" href="assets/vendor/revolution/responsiveslides.css" />
    <!-- main css -->
    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/common.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="assets/vendor/detail-page/style.css">
    <link rel="stylesheet" href="assets/vendor/jquery/easyzoom.css">
    <!-- Search bar redirection -->
    <script>
        function searchjb() {
            var search_by = document.getElementById('search_by').value;
            var search = document.getElementById('search').value;
            switch (search_by) {
                case "1":
                    window.location.href = "brand-search.php?search_by=" + search_by + "&search=" + search;
                    break;
                case "2":
                    window.location = "product-search.php?search_by=" + search_by + "&search=" + search;
                    break;
                case "3":
                    window.location = "supplier-search.php?search_by=" + search_by + "&search=" + search;
                    break;
                case "4":
                    window.location = "buyer-search.php?search_by=" + search_by + "&search=" + search;
                    break;
                case "5":
                    window.location = "location-search.php?search_by=" + search_by + "&search=" + search;
                    break;
                default:
                    window.location = "search.php?search_by=" + search_by +  "&search=" + search;
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
                                    <option value="0" <?php if(isset($search_by) && $search_by==0) echo "selected"; else echo ""; ?>>All</option>
                                    <option value="1" <?php if(isset($search_by) && $search_by==1) echo "selected"; else echo ""; ?>>Brand</option>
                                    <option value="2" <?php if(isset($search_by) && $search_by==2) echo "selected"; else echo ""; ?>>Products</option>
                                    <option value="3" <?php if(isset($search_by) && $search_by==3) echo "selected"; else echo ""; ?>>Supplier</option>
                                    <option value="4" <?php if(isset($search_by) && $search_by==4) echo "selected"; else echo ""; ?>>Buyer</option>
                                    <option value="5" <?php if(isset($search_by) && $search_by==5) echo "selected"; else echo ""; ?>>Location</option>
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
                                <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="Dropdown1"> <a class="dropdown-item" href="login.php">Login</a><a class="dropdown-item" href="register.php">Register</a></div>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="dropdown"> <a class="dropdown-toggle link" href="" data-toggle="dropdown"><i class="fa fa-cart-plus" aria-hidden="true"></i><span class="circle-2"><?php echo $cart_count[0]->countc;?></span></a>
                                <div class="dropdown-menu dropdown-menu2 dropdown-menu-right animate slideIn">
                                    <div class="container">
                                        <div class="row">
<?php
/*Fetch latest products through API*/
$API_cart = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_Cart.php?userId=1");
$cart = json_decode($API_cart);  
if($cart){
    foreach($cart as $product){
        echo '<div class="col-md-3">';
        $API_product_img = file_get_contents(DIR_ROOT.DIR_ADMINP.DIR_CON.DIR_CLI."CON_ProductImage.php?productId=".$product->productId);
        $product_img = json_decode($API_product_img);
        foreach($product_img as $img){
            echo '<img src="../AdminPanel/pics/'.$img[0].'" alt="" title="" class="img-fluid">';
        }
        echo '</div>';
        echo '<div class="col-md-9"><p>'.$product->name.' <span class="price">$ '.$product->unitprice.'</span></p><a href="" class="close">x</a></div>';
    }
}
?>
<div class="col-md-12"><hr></div>
                                            <div class="col-md-12 text-center">
                                                <input type="button" value="Check cart" class="btn check-out w-100" onclick="window.location.href='cart.php'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="dropdown"> <a class="link" href="wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i><span class="circle-2"><?php echo $wishlist_count[0]->countw;?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2"> <a class="navbar" href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Deliver to<b> <?php echo $location;?></b></a></div>
            </div>
        </div>
    </nav>
    <div class="container-fluid" id="bottom-navbar">
        <div class="row align-items-center" style="padding:0 0 3px 0">
            <div class="col-6">
                <div class="row">
                    <a href="about-us.php" class="nav-a bottom-nav"> About Us </a>
                    <a href="#" class="nav-a bottom-nav"> Customer Service </a>
                    <a href="#" class="nav-a bottom-nav"> Gift Cards </a>
                    <a href="#" class="nav-a bottom-nav"> Registry </a>
                    <a href="#" class="nav-a bottom-nav"> Sell </a></div>

            </div>
        </div>
    </div>

    <!-- Navigation with search bar-->