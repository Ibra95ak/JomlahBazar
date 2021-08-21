<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
include("../" . DIR_CON . "header_admin.php");
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
                            Order
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
                                        15 New Paskages
                                    </span>
                                </div>
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-list-1" style="color: #ff5000"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Unshipped Orders
                                    </span>
                                    <span class="kt-widget17__desc">
                                        72 New Items
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget17__items">
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-paperplane" style="color: #ff5000"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Shipped Orders
                                    </span>
                                    <span class="kt-widget17__desc">
                                        72 Support Cases
                                    </span>
                                </div>
                                <div class="kt-widget17__item">
                                    <span class="kt-widget17__icon">
                                        <i class="flaticon2-delete" style="color: #ff5000"></i>
                                    </span>
                                    <span class="kt-widget17__subtitle">
                                        Cancelled Orders
                                    </span>
                                    <span class="kt-widget17__desc">
                                        34 Upgraded Boxes
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
                                        15 New Paskages
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
                                        72 New Items
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
                                        72 Support Cases
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
                                        34 Upgraded Boxes
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
                                        15 New Paskages
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
                                        72 New Items
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
                                        72 Support Cases
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
                                        34 Upgraded Boxes
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


    <div class="row">
        <div class="col-md-12">
            <canvas id="myChart" width="100%" height="30px"></canvas>
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                '#ff5000',
                                '#ffa300',
                                '#8712db',
                                '#ffa300',
                                '#ff5000',
                                '#8712db'
                            ],
                            borderColor: [
                                '#ff5000',
                                '#ffa300',
                                '#8712db',
                                '#ffa300',
                                '#ff5000',
                                '#8712db'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>
    </div>

    <!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<?php
include(DIR_VIEW . DIR_CON . "footer_admin.php");
?>
