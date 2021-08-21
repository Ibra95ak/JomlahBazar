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
            <li class="breadcrumb-item active" aria-current="page">Manage Inventory</li>
        </ol>
    </nav>

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    My Inventory
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
                                            Product name
                                        </div>
                                    </div>
                                    <div id="collapseFour4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="" id="" placeholder="Enter name" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingThree4">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                                            Inventory Stock
                                        </div>
                                    </div>
                                    <div id="collapseThree4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4" style="">
                                        <div class="card-body">
                                            <input type="number" class="form-control" name="" id="" placeholder="min number" value="">
                                            <input type="number" class="form-control" name="" id="" placeholder="max number" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingEight4">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseEight4" aria-expanded="false" aria-controls="collapseEight4">
                                            Sellers
                                        </div>
                                    </div>
                                    <div id="collapseEight4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4" style="">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="1">Behak<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="2">Shabnam<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="3">adrei<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="11">Madad Ali<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="12">Prakash<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="13">Haneef<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="14">Rajesh Pattabhi<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="15">Tamer El-Amoor<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="16">Muzzafar Abdul Kadar Shaikh<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filtersupplier()" class="checkbox_sup" data-id="17">Ibra-Pomechain<span></span></label><a href="javascript:void(0)" id="showmore" class="kt-font-brand">Show more</a>; <div id="moresuppliers" style="display:none;">
                                                    </div>
                                                </div>
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
                                        <th>Product Name</th>
                                        <th>Inventory</th>
                                        <th>Added At</th>
                                        <th>Belongs To</th>
                                        <th>Business</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Perfume</td>
                                        <td>2000</td>
                                        <td>2020-14-05</td>
                                        <td>Ibrahim</td>
                                        <td>Cosmetics</td>
                                        <td>
                                            <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">active</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=11">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Perfume</td>
                                        <td>2000</td>
                                        <td>2020-14-05</td>
                                        <td>Ibrahim</td>
                                        <td>Cosmetics</td>
                                        <td>
                                            <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">active</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=11">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Perfume</td>
                                        <td>2000</td>
                                        <td>2020-14-05</td>
                                        <td>Ibrahim</td>
                                        <td>Cosmetics</td>
                                        <td>
                                            <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">active</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=11">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Perfume</td>
                                        <td>2000</td>
                                        <td>2020-14-05</td>
                                        <td>Ibrahim</td>
                                        <td>Cosmetics</td>
                                        <td>
                                            <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">active</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=11">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Perfume</td>
                                        <td>2000</td>
                                        <td>2020-14-05</td>
                                        <td>Ibrahim</td>
                                        <td>Cosmetics</td>
                                        <td>
                                            <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">active</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=11">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th scope="row">6</th>
                                        <td>Perfume</td>
                                        <td>2000</td>
                                        <td>2020-14-05</td>
                                        <td>Ibrahim</td>
                                        <td>Cosmetics</td>
                                        <td>
                                            <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">active</span>
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