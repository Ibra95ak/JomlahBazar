<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">-->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Jomlah Bazar</title>

    <script src="assets/vendor/home-banner/jquery.min.js"></script>

    <!-- main css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- main css -->

    <link rel="stylesheet" href="assets/css/home-1.css" />
    <link rel="stylesheet" href="assets/vendor/revolution/vendor/revslider/css/settings.css" />
    <link rel="stylesheet" href="assets/vendor/revolution/responsiveslides.css" />


    <!-- main css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- main css -->


    <!-- custom css -->
    <link rel="stylesheet" href="assets/css/common.css" />
    <!-- custom css -->
</head>

<body>
    <!-- Navigation -->
    <div class="top-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-12 top-div top1">
                    <ul>
                        <li>
                            <a href="mailto:info@jomlahbazar.com"><i class="fa fa-envelope"></i>
                                &nbsp;info@jomlahbazar.com</a>
                        </li>
                        <li>|</li>
                        <li>
                            <i class="fa fa-phone" aria-hidden="true"></i> +971 55 123 4567
                        </li>
                    </ul>
                </div>
                <div class="col-lg-7 col-md-6 col-md-12 position-relative">
                    <div class="right-div">
                        <ul>
                            <li>
                                <ul class="social-network">
                                    <li>
                                        <a href="#" class="icoRss" title=""><i class="fa fa-rss"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icoFacebook" title=""><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icoTwitter" title=""><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icoGoogle" title=""><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="icoLinkedin" title=""><i class="fa fa-linkedin"></i></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="top-ul">
                                    <li>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="" data-toggle="dropdown"><img src="./assets/images/flag.jpg" alt="" title="" />
                                                English <i class="fa fa-angle-down"></i></a>
                                            <div class="dropdown-menu flag-css dropdown-menu-right">
                                                <a href="#">English</a>
                                                <a href="#"><span class="flag-icon flag-icon-fr"> </span>French</a>
                                                <a href="#"><span class="flag-icon flag-icon-it"> </span>Italian</a>
                                                <a href="#"><span class="flag-icon flag-icon-ru"> </span>Russian</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle currency" href="" data-toggle="dropdown">
                                                <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown-menu drop1 dropdown-menu-right">
                                                <li class="dropdown-item">
                                                    <a href="#"> US Dollar</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="#"> British Pound</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="login">
                    <h2>Login</h2>

                    <div class="col d-flex justify-content-center flex-column">
                    <h3 class="text-center" ><strong>Social Login</strong></h3>
                    <ul class="social-network3 text-center">
                    <li><a href="#" class="facebook-icon" title=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" class="twitter-icon" title=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" class="google-icon" title=""><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#" class="linkedin-icon" title=""><i class="fa fa-linkedin"></i></a></li>
                  </ul>
                    </div>

                    <div class="vl">
                        <span class="vl-innertext">or</span>
                    </div>

                    <form id="jbform">
                        <div class="form-group">
                            <label for="aaa_email"><strong>Email address *</strong></label>
                            <input type="email" class="form-control" name="aaa_email" id="aaa_email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="aaa_password"><strong>Password *</strong></label>
                            <input type="password" class="form-control" name="aaa_password" id="aaa_password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6 text-right"><a href="register.php">Don't have an account yet?</a></div>
                                <div class="col-6 text-right">Forget your Password</div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="btn_submit">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="clearfix"></div>
    <div id="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h4>Join Our Newsletter Now</h4>
                    <p class="m-0">Get E-mail updates about our latest shop and special offers.</p>
                </div>
                <div class="col-md-5">
                    <form action="/" method="post" id="subsForm" onSubmit="return ajaxmailsubscribe();">
                        <div class="input-group">
                            <input type="email" name="subsemail" id="subsemail" class="form-control newsletter" placeholder="Enter your mail">
                            <span class="input-group-btn">
                                <button class="btn btn-theme" type="button" onClick="return ajaxmailsubscribe();">Subscribe</button>
                            </span> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 address wow fadeInLeft">
                <!--                <p><img src="assets/images/logo.png" alt="" title="" class="img-fluid"></p>-->
                <p>Address: Dubai, UAE</p>
                <p>Phone: +12 3456 78901</p>
                <p>Email: <a href="mailto:info@jomlahbazar.com">info@jomlahbazar.com</a></p>
                <ul class="social-2">
                    <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" title="instagram +"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" title="Linkedin"><i class="fa fa-pinterest"></i></a></li>
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
        </div>
    </div>
    <footer class="py-4 bg-dark">
        <div class="container copy-right">
            <div class="row">
                <div class="col-md-6 text-white"> Copyright © 2020 <a href="">Jomlah Bazar</a>- All Rights Reserved. </div>
                <div class="col-md-6 payment">
                    <div class="pull-right"> <a href=""><img src="assets/images/skrill.png" alt="" title=""></a> <a href=""><img src="assets/images/ob.png" alt="" title=""></a> <a href=""><img src="assets/images/paypal.png" alt="" title=""></a> <a href=""><img src="assets/images/am.png" alt="" title=""></a> <a href=""><img src="assets/images/mr.png" alt="" title=""></a> <a href=""><img src="assets/images/visa.png" alt="" title=""></a> </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/formValidation.js"></script>

    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <!--bootstrap-->
    <script src="assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--bootstrap-->
    <script src="assets/vendor/wow/wow.js"></script>
    <script src="assets/vendor/wow/page.js"></script>
    <!--form submit through ajax-->
    <script>
        $('#btn_submit').click(function(e) {
            e.preventDefault();
            /*validation flag*/
            var err = 0;
            /*Check if inputs are empty*/
            if (isEmpty('Email', document.getElementById('aaa_email').value) || isEmpty('Password', document.getElementById('aaa_password').value)) err = 1;
            /*Validate email format*/
            if (!validateEmail('Email', document.getElementById('aaa_email').value)) err = 1;
            if (err == 0) {
                /*Get input values from form*/
                var formdata = new FormData($('#jbform')[0]);
                /*Send ajax request*/
                $.ajax({
                    type: "POST",
                    url: "http://localhost/JomlahBazar/AdminPanel/controllers/CON_Login_AAA.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    dataType: "json",
                    success: function(data) {
                        switch (data) {
                            case 0:
                                /*Success*/
                                /*similate 2s delay*/
                                setTimeout(function() {
                                    /*Simulate an HTTP redirect:*/
                                    window.location.replace(
                                        "http://localhost/JomlahBazar/UserInterface/search.php"
                                    );
                                }, 2000);
                                break;
                            case 1:
                                /*Error*/
                                /*similate 2s delay*/
                                setTimeout(function() {
                                    alert("Account is not activated yet! please check your email.");
                                }, 2000);
                                break;
                            case 2:
                                /*Error*/
                                /*similate 2s delay*/
                                setTimeout(function() {
                                    alert("Missing required parameters. Please try again.");
                                }, 2000);
                                break;
                            case 3:
                                /*Error*/
                                /*similate 2s delay*/
                                setTimeout(function() {
                                    alert("Missing required parameters. Please try again.");
                                }, 2000);
                                break;
                            default:
                                alert("No case found. Please contact support.");
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>