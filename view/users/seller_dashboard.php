<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if (isset($_SESSION['userId'])) {
    $res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
    $usr = json_decode($res_uid->getBody());
    $roleId = $usr->roleId;
    $userId = $usr->userId;
    switch ($_SESSION['Login_as']) {
  		case 1:
  			include('../' . DIR_CON . "header_buyer.php");
  			break;
  		case 2:
  			include('../' . DIR_CON . "header_supplier.php");
  			break;

  		default:
  			include('../' . DIR_CON . "header_buyer.php");
  			break;
  	}
} else {
    header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
$res_orderstats = $client->request('GET', DIR_CONT . DIR_USR . "CON_sellerstats.php?action=get&userId=".$userId);
$orderstats = json_decode($res_orderstats->getBody());
$count_pending = $orderstats->count_pending->count_ord;
$count_shipped = $orderstats->count_shipped->count_ord;
$count_completed = $orderstats->count_completed->count_ord;
$count_canceled = $orderstats->count_canceled->count_ord;
$count_refunded = $orderstats->count_refunded->count_ord;
$count_sales_daily = $orderstats->count_sales_daily->count_ord;
$count_sales_weekly = $orderstats->count_sales_weekly->count_ord;
$count_sales_monthly = $orderstats->count_sales_monthly->count_ord;
$count_products_inventory = $orderstats->count_products_inventory->count_pro;
$count_products_cart = $orderstats->count_products_cart->count_pro;
$count_products_wishlist = $orderstats->count_products_wishlist->count_pro;
$count_sellers = $orderstats->count_sellers->count_usr;
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->
    <div class="row" style="margin-top: 50px;">
        <div class="col-xl-4">

            <!--begin:: Widgets/Activity-->
            <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Orders
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-widget17">
                        <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #ff5000">
                            <div class="kt-widget17__chart" style="height:240px;">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget17__stats">
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-reply" style="color: #ff5000"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Pending Orders
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_pending;?>
                                    </span>
                                </div>
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-list-1" style="color: #ff5000"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Shipped Orders
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_shipped;?>
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-paperplane" style="color: #ff5000"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Canceled Orders
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_canceled;?>
                                    </span>
                                </div>
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-delete" style="color: #ff5000"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Refunded Orders
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_refunded;?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Activity-->
        </div>


        <div class="col-xl-4">

            <!--begin:: Widgets/Activity-->
            <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Sales
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-widget17">
                        <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #ffa300">
                            <div class="kt-widget17__chart" style="height:240px;">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget17__stats">
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-graphic" style="color: #ffa300"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Daily Sales
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_sales_daily;?>
                                    </span>
                                </div>
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-rocket-1" style="color: #ffa300"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Weekly Sales
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_sales_weekly;?>
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-calendar-7" style="color: #ffa300"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        This Month
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_sales_monthly;?>
                                    </span>
                                </div>
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-graphic-1" style="color: #ffa300"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Total Sales
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_completed;?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Activity-->
        </div>


        <div class="col-xl-4">

            <!--begin:: Widgets/Activity-->
            <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Marketplace
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="kt-widget17">
                        <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #8712db">
                            <div class="kt-widget17__chart" style="height:240px;">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget17__stats">
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-tag" style="color: #8712db"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        My Products
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_products_inventory;?>
                                    </span>
                                </div>
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-shopping-cart" style="color: #8712db"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        My Carts
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_products_cart;?>
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-gift" style="color: #8712db"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        My Wishlists
                                    </span>
                                    <span class="kt-widget17__desc">
                                        <?php echo $count_products_wishlist;?>
                                    </span>
                                </div>
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon-presentation" style="color: #8712db"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Other Sellers
                                    </span>
                                    <span class="kt-widget17__desc">
                                      <?php echo $count_sellers;?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Activity-->
        </div>
    </div>
    <!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
