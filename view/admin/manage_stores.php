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
            <li class="breadcrumb-item active" aria-current="page">Manage Stores</li>
        </ol>
    </nav>

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    My Stores
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
                                    <div class="card-header" id="headingSix4">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseSix4" aria-expanded="false" aria-controls="collapseSix4">
                                            Store Name
                                        </div>
                                    </div>
                                    <div id="collapseSix4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="" id="" placeholder="Name" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingOne4">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                            Brands
                                        </div>
                                    </div>
                                    <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4" style="">
                                        <div class="card-body" id="rec-brand">
                                            <div class="form-group">
                                                <div class="kt-checkbox-list"><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="228">7up<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="229">Ahmad Tea<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="440">al ain<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="230">Al Douri<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="256">Al Douri<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="257">Al Safi<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="259">ALAMEED<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="260">AliCafe<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="231">Alokozay<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="591">alpin<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="261">Alpro<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="592">aquafina<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="593">arwa<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="232">Best Coffee<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="269">Best Coffee<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="275">Bonjorno<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="278">BRU<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="279">Café Abi Nasr<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="282">Chikko<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="233">Coca-Cola<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="284">Cocomi<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="285">Coffee mate<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="234">Coffee Planet<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="286">Coffee Planet<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="235">Davidoff<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="288">Davidoff<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="594">emirates<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="236">Evian<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="237">Fanta<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="595">fiji<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="314">Koita<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="320">L'OR<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="315">Lacnor<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="317">Lavazza<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="238">Lipton<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="321">Lord caffe<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="325">Maatouk<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="239">Maatouk<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="240">Mai Dubai<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="241">Mirinda<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="332">Mondo<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="333">Mood Espresso<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="242">Mountain Dew<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="243">Nescafe<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="337">Nescafe<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="338">Nescafe Dolce Gusto<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="244">Nestle<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="596">nestle pure life<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="245">Ocean Spray<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="246">Pepsi<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="597">perrier<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="247">Pocari Sweat<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="248">Pokka<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="407">puck<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="348">Rainbow<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="249">Red Bull<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="250">Regalo Espresso<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="354">Safio<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="598">san pellegrino<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="251">Schweppes<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="355">Segafredo<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="357">STARBUCKS<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="359">TAYLORS OF HARROGATE<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="252">Twinings<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="599">volvic<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="253">VOSS<span></span></label><label class="kt-checkbox kt-checkbox--tick kt-checkbox--success"><input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="363">WESTERN CUP<span></span></label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingEight4">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseEight4" aria-expanded="false" aria-controls="collapseEight4">
                                            Store Status
                                        </div>
                                    </div>
                                    <div id="collapseEight4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4" style="">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option>Active</option>
                                                    <option>Disabled</option>
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
                                        <th>Store Name</th>
                                        <th>Store Category</th>
                                        <th>Total Products</th>
                                        <th>Total Orders</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Cosmetics Store</td>
                                        <td>Cosmetics</td>
                                        <td>10</td>
                                        <td>150</td>
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
                                        <td>Cosmetics Store</td>
                                        <td>Cosmetics</td>
                                        <td>10</td>
                                        <td>150</td>
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
                                        <th scope="row">3</th>
                                        <td>Cosmetics Store</td>
                                        <td>Cosmetics</td>
                                        <td>10</td>
                                        <td>150</td>
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
                                        <td>Cosmetics Store</td>
                                        <td>Cosmetics</td>
                                        <td>10</td>
                                        <td>150</td>
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
                                        <th scope="row">5</th>
                                        <td>Cosmetics Store</td>
                                        <td>Cosmetics</td>
                                        <td>10</td>
                                        <td>150</td>
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
                                        <td>Cosmetics Store</td>
                                        <td>Cosmetics</td>
                                        <td>10</td>
                                        <td>150</td>
                                        <td>
                                            <span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill">pending</span>
                                        </td>
                                        <td>
                                            <a href="view/orders/my-payments-detail.php?id=12">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>


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