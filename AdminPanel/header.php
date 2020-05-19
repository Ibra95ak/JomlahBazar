<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>Jomlah Bazar | Admin Panel</title>
    <meta name="description" content="Page with empty content">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <!-- begin:: Page -->

    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="index.html">
                <img alt="Logo" src="assets/media/logos/logo-light.png" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left"
                id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                    class="flaticon-more"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <!-- begin:: Aside -->

            <!-- Uncomment this to display the close button of the panel
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
-->
            <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
                id="kt_aside">

                <!-- begin:: Aside -->
                <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                    <div class="kt-aside__brand-logo">
                        <h4>ADMIN PANEL</h4>
                        <!-- <a href="index.html">
                            <img alt="Logo" src="assets/media/logos/logo-light.png" />
                        </a> -->
                    </div>
                    <div class="kt-aside__brand-tools">
                        <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                        <path
                                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                                    </g>
                                </svg></span>
                            <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                        <path
                                            d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                                    </g>
                                </svg></span>
                        </button>

                        <!--
			<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
			-->
                    </div>
                </div>

                <!-- end:: Aside -->

                <!-- begin:: Aside Menu -->
                <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
                        data-ktmenu-dropdown-timeout="500">
                        <ul class="kt-menu__nav ">
                            <li class="kt-menu__item " aria-haspopup="true"><a href="dashboard.php"
                                    class="kt-menu__link "><i class="kt-menu__link-icon flaticon-home"></i><span
                                        class="kt-menu__link-text">Dashboard</span></a></li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">USERS</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">USERS</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_buyers.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">Buyers</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_suppliers.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">Suppliers</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_registeredsuppliers.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">Registered-suppliers</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_shippers.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">shippers</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_shipperdetails.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">Shipper-details</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_admins.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">admins</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">PRODUCTS</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">PRODUCTS</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_products.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Products</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_productdetails.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">Product Details </span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">CREDITCARD</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">CREDITCARD</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_creditcard.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Creditcard</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_creditcarddetails.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Creditcard-Details</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">PRIVILEDGES</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">PRIVILEDGES</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_priviledges.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Priviledges</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_adminpriviledge.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">Admin Priviledges</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">FAQ'S</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">FAQ'S</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_faqs.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All faq's</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">PAYPAL</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">PAYPAL</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_paypals.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Paypal</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">PICTURES</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">PICTURES</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_pictures.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Pictures</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">DISCOUNT TYPES</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span class="kt-menu__link-text">DISCOUNT
                                                    TYPES</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_discounttypes.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Discount types</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">ADDRESS</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">ADDRESSES</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_addresses.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Addresses</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">BRANDS</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span class="kt-menu__link-text">
                                                    BRANDS</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_brands.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Brands</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">CATEGORIES</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">CATEGORIES</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_categories.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Categories</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_subcategories.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Sub-Categories</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">SUBSCRIPTION-PLAN</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">SUBSCRIPTION-PLAN</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_subscriptionplans.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Subscription-plans</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">INVENTORY</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">INVENTORY</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_inventories.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Inventories</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">CART</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">CART</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_carts.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Carts</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">TESTIMONIALS</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">TESTIMONIALS</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_testimonials.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Testimonials</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">ORDERS</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">ORDERS</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_orders.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Orders</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_orderdetails.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">Order Details</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">STORES</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">STORES</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_stores.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Stores</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">REVIEWS</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">REVIEWS</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_reviews.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Reviews</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">REACHOUTS</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">REACHOUTS</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_reachouts.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Reachouts</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">WISHLISTS</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">WISHLISTS</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_wishlists.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Wishlists</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                data-ktmenu-submenu-toggle="hover"><a href="javascript:;"
                                    class="kt-menu__link kt-menu__toggle"><i
                                        class="kt-menu__link-icon flaticon-web"></i><span
                                        class="kt-menu__link-text">WALLET</span><i
                                        class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                    <ul class="kt-menu__subnav">
                                        <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span
                                                class="kt-menu__link"><span
                                                    class="kt-menu__link-text">WALLET</span></span></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_wallets.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Wallet</span></a></li>
                                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"
                                            data-ktmenu-submenu-toggle="hover"><a href="por_wallettype.php"
                                                class="kt-menu__link kt-menu__toggle"><i
                                                    class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span
                                                    class="kt-menu__link-text">All Wallet types</span></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- end:: Aside Menu -->
            </div>

            <!-- end:: Aside -->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">


                    <!-- begin:: Header Topbar -->
                    <div class="kt-header__topbar">
                        <!--begin: User Bar -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                                <div class="kt-header__topbar-user">
                                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                                    <span class="kt-header__topbar-username kt-hidden-mobile">Admin</span>
                                    <img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

                                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                    <span
                                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">A</span>
                                </div>
                            </div>
                            <div
                                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                                <!--begin: Head -->
                                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                                    style="background-image: url(assets/media/misc/bg-1.jpg)">
                                    <div class="kt-user-card__avatar">
                                        <img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

                                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                        <span
                                            class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>
                                    </div>
                                    <div class="kt-user-card__name">
                                        Sean Stone
                                    </div>
                                    <div class="kt-user-card__badge">
                                        <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                                    </div>
                                </div>

                                <!--end: Head -->

                                <!--begin: Navigation -->
                                <div class="kt-notification">
                                    <a href="custom/apps/user/profile-1/personal-information.html"
                                        class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                My Profile
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Account settings and more
                                            </div>
                                        </div>
                                    </a>
                                    <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-mail kt-font-warning"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                My Messages
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Inbox and tasks
                                            </div>
                                        </div>
                                    </a>
                                    <a href="custom/apps/user/profile-2.html" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-rocket-1 kt-font-danger"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                My Activities
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Logs and notifications
                                            </div>
                                        </div>
                                    </a>
                                    <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-hourglass kt-font-brand"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                My Tasks
                                            </div>
                                            <div class="kt-notification__item-time">
                                                latest tasks and projects
                                            </div>
                                        </div>
                                    </a>
                                    <a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-cardiogram kt-font-warning"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Billing
                                            </div>
                                            <div class="kt-notification__item-time">
                                                billing &amp; statements <span
                                                    class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2
                                                    pending</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="index.php?logout=true" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                        <a href="index.php?logout=true" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>
                                    </div>
                                </div>

                                <!--end: Navigation -->
                            </div>
                        </div>

                        <!--end: User Bar -->
                    </div>

                    <!-- end:: Header Topbar -->
                </div>

                <!-- end:: Header -->
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content"
                    style="padding-top: 0px;">
