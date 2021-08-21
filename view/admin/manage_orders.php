<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();

include("../" . DIR_CON . "header_admin.php");

?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage Orders</li>
        </ol>
    </nav>

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    My Orders
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="row">
                <div class="col-md-2">
                    <div class="kt-section">
                        <div class="kt-section__content">
                            <div class="accordion  accordion-toggle-plus" id="accordionExample4">

                                <div class="card">
                                    <div class="card-header" id="headingFour4">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4">
                                            Order Number
                                        </div>
                                    </div>
                                    <div id="collapseFour4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="" id="" placeholder="Enter order number" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingThree4">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                                            Order Date
                                        </div>
                                    </div>
                                    <div id="collapseThree4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4" style="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <label>To</label>
                                                    <input type="date" class="form-control" name="" id="" placeholder="To" value="">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label>From</label>
                                                    <input type="date" class="form-control" name="" id="" placeholder="From" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingSix4">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseSix4" aria-expanded="false" aria-controls="collapseSix4">
                                            Order Price
                                        </div>
                                    </div>
                                    <div id="collapseSix4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <input type="text" class="form-control" name="" id="" placeholder="Minimum Price" value="">
                                                </div>
                                                <div class="col-xl-6">
                                                    <input type="text" class="form-control" name="" id="" placeholder="Maximum Price" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingEight4">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseEight4" aria-expanded="false" aria-controls="collapseEight4">
                                            Order Status
                                        </div>
                                    </div>
                                    <div id="collapseEight4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4" style="">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option>Active</option>
                                                    <option>Shipped</option>
                                                    <option>Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                            </div>

                        </div>
                        <div class="kt-portlet__foot ">
                            <div class="kt-form__actions">
                                <button type="button" class="btn btn-warning" id="filter"><i class="fa fa-search"></i></button>
                                <button type="reset" class="btn btn-secondary"><img src="<?php echo DIR_ROOT.DIR_ICON?>nofilter.png"></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-10">
                    <!--begin::Section-->
                    <div class="kt-section">
                        <div class="kt-section__content">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Number</th>
                                        <th>Order Date</th>
                                        <th>Order Amount</th>
                                        <th>Total VAT (5%)</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>0111202092B501</td>
                                        <td>2020-11-01</td>
                                        <td>AED 234</td>
                                        <td>AED 11.7</td>
                                        <td>AED 245.7</td>
                                        <td>
                                            <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">pending</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=12">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>01112020477213</td>
                                        <td>2020-11-01</td>
                                        <td>AED 299</td>
                                        <td>AED 14.95</td>
                                        <td>AED 313.95</td>
                                        <td>
                                            <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">pending</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=11">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>0111202092B501</td>
                                        <td>2020-11-01</td>
                                        <td>AED 234</td>
                                        <td>AED 11.7</td>
                                        <td>AED 245.7</td>
                                        <td>
                                            <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">pending</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=12">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>01112020477213</td>
                                        <td>2020-11-01</td>
                                        <td>AED 299</td>
                                        <td>AED 14.95</td>
                                        <td>AED 313.95</td>
                                        <td>
                                            <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">pending</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=11">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>0111202092B501</td>
                                        <td>2020-11-01</td>
                                        <td>AED 234</td>
                                        <td>AED 11.7</td>
                                        <td>AED 245.7</td>
                                        <td>
                                            <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">pending</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=12">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>01112020477213</td>
                                        <td>2020-11-01</td>
                                        <td>AED 299</td>
                                        <td>AED 14.95</td>
                                        <td>AED 313.95</td>
                                        <td>
                                            <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">pending</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=11">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!--end::Section-->
                </div>
            </div>
        </div>

        <!--end::Form-->
    </div>
    <!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<?php
include(DIR_VIEW . DIR_CON . "footer_admin.php");
?>