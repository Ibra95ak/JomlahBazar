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
            include("../" . DIR_CON . "header_buyer.php");
            break;
        case 2:
            include("../" . DIR_CON . "header_supplier.php");
            break;

        default:
            include("../" . DIR_CON . "header_buyer.php");
            break;
    }
} else {
    header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/

if (!isset($_GET['from'])) {
    $from = date("Y-m-d",strtotime("-3 month"));
}else {
  $from = $_GET['from'];
}
if (!isset($_GET['to'])) {
    $to = date("Y-m-d");
}else {
  $to = $_GET['to'];
}
if(isset($_GET['page'])  && $_GET['page']!=NULL) $page=$_GET['page'];
else $page=1;
if(isset($_GET['pg'])) $pg=$_GET['pg'];
else $pg=1;
$res_payments = $client->request('GET', DIR_CONT . DIR_ORD . 'CON_Orders.php?action=seller_payments&userId=' . $userId . '&from=' . $from . '&to=' . $to. '&page=' . $page. '&pg=' . $pg);
$payments = json_decode($res_payments->getBody());

?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Marketplace</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Payments</li>
        </ol>
    </nav>

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    My Payments
                </h3>
            </div>
            <div class="kt-widget__item">
                <label class="kt-font-dark kt-font-bold">Filter Payments</label>
                <input type="text" class="form-control" id="kt_daterangepicker_my_payments" placeholder="Select date ranges" autocomplete="off">
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Number</th>
                                <th>Payment Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                            <?php echo $payments->payments;?>
                    </table>
                </div>
            </div>
            <!--end::Section-->
        </div>

        <!--end::Form-->
    </div>


    <!--End::Dashboard 3-->
</div>

<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
