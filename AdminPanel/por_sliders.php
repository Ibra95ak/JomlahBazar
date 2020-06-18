<?php
/*get base variables*/
include('libraries/base.php');
/*start user session*/
session_start();
/*check logged is admin*/
if(isset($_SESSION['adminId'])){
    /*get admin class*/
    require_once 'libraries/Ser_Admin.php';
    /*create admin istance*/
    $db = new Ser_Admin();
    /*check if admin is logged in(security checkup)*/
    $checklogin= $db->islogin($_SESSION['adminId']);
}else{
    /*redirect to error page*/
    header("location:".DIR_ROOT.DIR_ADMINP."error.php");
}
if($checklogin){
/*get page header*/
include('header.php');
/*get sliders controller*/
require(DIR_ROOT.DIR_ADMINP.DIR_CON.'CON_Sliders.php');
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Sliders Datatable
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        &nbsp;
                        <button type="button" class="btn btn-brand btn-icon-sm" id="add">
                            <i class="flaticon2-plus"></i> Add New
                        </button>
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
                                        <input type="text" class="form-control" placeholder="Search..."
                                            id="generalSearch">
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
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                            <a href="#" class="btn btn-default kt-hidden">
                                <i class="la la-cart-plus"></i> New Slider
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
            <!--begin: Datatable -->
            <div class="kt-datatable" id="auto_column_hide"></div>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<!-- end:: Content -->
<?php
/*get page footer*/
include("footer.php");
?>
<!-- create & populate datatable -->
<script src="assets/js/pages/crud/metronic-datatable/advanced/row-details-sliders.js" type="text/javascript"></script>
<script>
/*redirect to add page*/
$('#add').click(function(e) {
    window.location = "<?php echo DIR_ROOT.DIR_ADMINP."form_sliders.php?sliderId=0";?>";
});
</script>
</body>
<!-- end::Body -->
</html>
<?php
/*end login if clause*/
}else{
    /*redirect to error page*/
    header("location:".DIR_ROOT.DIR_ADMINP."error.php");
}
?>