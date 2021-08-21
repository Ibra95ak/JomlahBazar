<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if(isset($_SESSION['userId'])){
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$roleId = $usr->roleId;
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
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
?>
						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
              <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                  <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                      JB Brands
                    </h3>
                  </div>
                  <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                      <div class="btn-group btn-group" role="group" aria-label="...">
                              <button id="btn-dt" type="button" class="btn btn-secondary"><i class="fa fa-list"></i></button>
                              <button id="btn-gd" type="button" class="btn btn-secondary"><i class="fa fa-th"></i></button>
                            </div>
                    </div>
                  </div>
                </div>
                <div class="kt-portlet__body">

                  <!--begin: Search Form -->
                  <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                      <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                          <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-input-icon kt-input-icon--left">
                              <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                              <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                <span><i class="la la-search"></i></span>
                              </span>
                            </div>
                          </div>
                          <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group--inline">
                              <div class="kt-form__label">
                                <label>Status:</label>
                              </div>
                              <div class="kt-form__control">
                                <select class="form-control bootstrap-select" id="kt_form_status">
                                  <option value="">All</option>
                                  <option value="1">Active</option>
                                  <option value="2">Inactive</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                        <a id="btn-adduser" href="<?php echo DIR_VIEW.DIR_BRND."form_brand.php?brandId=0";?>" class="btn btn-default">
                          <i class="la la-plus"></i> New Brand
                        </a>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                      </div>
                    </div>
                  </div>

                  <!--end: Search Form -->
                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                  <!--begin: Datatable -->
                  <div class="kt-datatable" id="rec-dt"></div>
                  <!--end: Datatable -->
                  <!--Begin::Section-->
                  <div class="row align-items-center" id="rec-gd" style="display:none"></div>
                  <!--End::Section-->
                </div>
              </div>
						</div>
						<!-- end:: Content -->
					</div>

<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script src="assets/js/pages/crud/metronic-datatable/advanced/data-brands.js" type="text/javascript"></script>
