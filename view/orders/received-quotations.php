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
    $_GET['from'] = date("Y/m/d");
}
if (!isset($_GET['to'])) {
    $_GET['to'] = date("Y/m/d");
}
$res_quotations = $client->request('GET', DIR_CONT . DIR_CAR . "CON_functions.php?action=get_seller_quotations&userId=" . $userId . '&from=' . $_GET['from'] . '&to=' . $_GET['to']);
$quotations = json_decode($res_quotations->getBody());

$quotationsArray = [];
$quotationsArray['pending'] = [];
$quotationsArray['cancelled'] = [];
$quotationsArray['accepted'] = [];
if (is_array($quotations) || is_object($quotations)) {
    foreach ($quotations as $quotation) {
        if ($quotation->qstatus == 1) {
            $quotationsArray['pending'][] = $quotation;
        } elseif ($quotation->qstatus == 4) {
            $quotationsArray['cancelled'][] = $quotation;
        } elseif ($quotation->qstatus == 6) {
            $quotationsArray['accepted'][] = $quotation;
        }
    }
}

?>

<script>
    function changeQty(qty, pid) {
        $('#pid').val(pid);
        $('#pqty').val(qty.value);
        $('#cartupdate').submit();
    }

    currentUrl = window.location.href;
    var split = currentUrl.split('?');
    var message = split[1].split('=');
    if (message[1] == 'success') {
        new Noty({
            type: 'success',
            theme: 'metroui',
            timeout: 2000,
            text: 'Your quotation has been successfully sent to the seller'
        }).show();
    }

    if (message[1] == 'qaccepted') {
        new Noty({
            type: 'success',
            theme: 'metroui',
            timeout: 2000,
            text: 'Quotation has been successfully accepted'
        }).show();
    }

    if (message[1] == 'qcancelled') {
        new Noty({
            type: 'success',
            theme: 'metroui',
            timeout: 2000,
            text: 'Quotation has been successfully cancelled'
        }).show();
    }

    if (message[1] == 'qmodified') {
        new Noty({
            type: 'success',
            theme: 'metroui',
            timeout: 2000,
            text: 'Quotation has been successfully modified with the new price'
        }).show();
    }

    function withdrawQuotation() {
        var confirm = window.confirm('Do you really want to withdraw this quotation');
        if (confirm) {

        }
    }
</script>


<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Marketplace</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Quotations</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Received Quotations</li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-lg-9">

            <div class="kt-portlet__body">

                <!--begin::Widget -->
                <div class="kt-portlet kt-portlet--mobile">

                    <div class="kt-portlet kt-portlet--tabs">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-brand flaticon2-quotation-mark"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">My Received Quotations</h3>
                            </div>
                            <div class="kt-widget__item">
                                <label class="kt-font-dark kt-font-bold">Search Date <span class="kt-font-sm">Sample: 22/09/2020 - 29/10/2020</span></label>
                                <input type="text" class="form-control" id="kt_daterangepicker_received_quotations" placeholder="Select date ranges" autocomplete="off">
                            </div>
                        </div>
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-right" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_4_tab_content" role="tab" aria-selected="true">
                                            All Quotations
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_1_tab_content" role="tab" aria-selected="false">
                                            Pending Quotations
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_tab_content" role="tab" aria-selected="false">
                                            Cancelled Quotations
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_3_tab_content" role="tab" aria-selected="false">
                                            Accepted Quotations
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="tab-content">



                                <div class="tab-pane active" id="kt_portlet_base_demo_4_tab_content" role="tabpanel">

                                    <!-- Pending Quotations -->
                                    <?php if (is_array($quotations) || is_object($quotations)) {
                                        foreach ($quotations as $quotation) {
                                          switch ($quotation->qstatus) {
                                            case '1':
                                              $qstatus = 'Pending';
                                              break;
                                            case '2':
                                              $qstatus = 'Opened';
                                              break;
                                            case '3':
                                              $qstatus = 'Shipped';
                                              break;
                                            case '4':
                                              $qstatus = 'Canceled';
                                              break;
                                            case '5':
                                              $qstatus = 'Refunded';
                                              break;
                                            case '6':
                                              $qstatus = 'Completed 	';
                                              break;
                                            case '7':
                                              $qstatus = 'Closed';
                                              break;
                                            default:
                                              $qstatus = 'Pending';
                                              break;
                                          }
                                          ?>
                                            <div class="kt-portlet">

                                                <div class="kt-portlet__body">
                                                    <div class="kt-widget kt-widget--user-profile-3">
                                                        <div class="kt-widget__top">
                                                            <div class="kt-widget__media kt-hidden-">
                                                                <img src="<?php echo $quotation->path ?>" style="width: 110px; height:94px">
                                                            </div>
                                                            <div class="kt-widget__content">
                                                                <div class="kt-widget__head">
                                                                    <a href="<?php echo DIR_VIEW.DIR_PRO;?>productdetails.php?productId=<?php echo $quotation->productId ?>" class="kt-widget__title"><?php echo $quotation->name ?></a>
                                                                </div>
                                                                <div class="kt-widget__info">
                                                                    <div class="kt-widget__stats d-flex align-items-center flex-fill">
                                                                        <div class="kt-widget__item">
                                                                            <div class="kt-widget__label">
                                                                                <span class="btn btn-label-dark btn-sm btn-bold btn-upper" onclick=""><b>Status:</b> <?php echo $qstatus ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-widget__item">
                                                                            <div class="kt-widget__label">
                                                                                <span class="btn btn-label-dark btn-sm btn-bold btn-upper"><b>Required by:</b> <?php echo $quotation->required_by ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-widget__item">
                                                                            <div class="kt-widget__label">
                                                                                <span class="btn btn-label-dark btn-sm btn-bold btn-upper" onclick="">
                                                                                    <a href="view/orders/received-quotations-detail.php?quotationId=<?php echo $quotation->quotationId?>">
                                                                                        Detail Page
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                    <?php }
                                    } else {
                                        echo "<h2>No quotations</h2>";
                                    } ?>



                                </div>



                                <div class="tab-pane" id="kt_portlet_base_demo_1_tab_content" role="tabpanel">

                                    <!-- Pending Quotations -->
                                    <?php if (is_array($quotationsArray['pending']) || is_object($quotationsArray['pending'])) {
                                        foreach ($quotationsArray['pending'] as $quotation) { ?>
                                            <div class="kt-portlet">

                                                <div class="kt-portlet__body">
                                                    <div class="kt-widget kt-widget--user-profile-3">
                                                        <div class="kt-widget__top">
                                                            <div class="kt-widget__media kt-hidden-">
                                                                <img src="<?php echo $quotation->path ?>" style="width: 110px; height:94px">
                                                            </div>
                                                            <div class="kt-widget__content">
                                                                <div class="kt-widget__head">
                                                                    <a href="<?php echo DIR_VIEW.DIR_PRO;?>productdetails.php?productId=<?php echo $quotation->productId ?>" class="kt-widget__title"><?php echo $quotation->name ?></a>
                                                                </div>
                                                                <div class="kt-widget__info">
                                                                    <div class="kt-widget__stats d-flex align-items-center flex-fill">
                                                                        <div class="kt-widget__item">
                                                                            <div class="kt-widget__label">
                                                                                <span class="btn btn-label-dark btn-sm btn-bold btn-upper" onclick=""><b>Status:</b> <?php echo $qstatus ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-widget__item">
                                                                            <div class="kt-widget__label">
                                                                                <span class="btn btn-label-dark btn-sm btn-bold btn-upper" onclick="">
                                                                                    <a href="view/orders/received-quotations-detail.php?quotationId=<?php echo $quotation->quotationId?>">
                                                                                        Detail Page
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                    <?php }
                                    } else {
                                        echo "<h2>No quotations</h2>";
                                    } ?>



                                </div>
                                <div class="tab-pane" id="kt_portlet_base_demo_2_tab_content" role="tabpanel">


                                    <!-- Cancelled Quotations -->
                                    <?php if (is_array($quotationsArray['cancelled']) || is_object($quotationsArray['cancelled'])) {
                                        foreach ($quotationsArray['cancelled'] as $quotation) { ?>
                                            <div class="kt-portlet">

                                                <div class="kt-portlet__body">
                                                    <div class="kt-widget kt-widget--user-profile-3">
                                                        <div class="kt-widget__top">
                                                            <div class="kt-widget__media kt-hidden-">
                                                                <img src="<?php echo $quotation->path ?>" style="width: 110px; height:94px">
                                                            </div>
                                                            <div class="kt-widget__content">
                                                                <div class="kt-widget__head">
                                                                    <a href="<?php echo DIR_VIEW.DIR_PRO;?>productdetails.php?productId=<?php echo $quotation->productId ?>" class="kt-widget__title"><?php echo $quotation->name ?></a>
                                                                </div>
                                                                <div class="kt-widget__info">
                                                                    <div class="kt-widget__stats d-flex align-items-center flex-fill">
                                                                        <div class="kt-widget__item">
                                                                            <div class="kt-widget__label">
                                                                                <span class="btn btn-label-dark btn-sm btn-bold btn-upper" onclick=""><b>Status:</b> <?php echo $qstatus ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-widget__item">
                                                                            <div class="kt-widget__label">
                                                                                <span class="btn btn-label-dark btn-sm btn-bold btn-upper" onclick="">
                                                                                    <a href="view/orders/received-quotations-detail.php?quotationId=<?php echo $quotation->quotationId?>">
                                                                                        Detail Page
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                    <?php }
                                    } else {
                                        echo "<h2>No quotations</h2>";
                                    } ?>


                                </div>
                                <div class="tab-pane" id="kt_portlet_base_demo_3_tab_content" role="tabpanel">


                                    <!-- Accepted Quotations -->
                                    <?php if (is_array($quotationsArray['accepted']) || is_object($quotationsArray['accepted'])) {
                                        foreach ($quotationsArray['accepted'] as $quotation) { ?>
                                            <div class="kt-portlet">

                                                <div class="kt-portlet__body">
                                                    <div class="kt-widget kt-widget--user-profile-3">
                                                        <div class="kt-widget__top">
                                                            <div class="kt-widget__media kt-hidden-">
                                                                <img src="<?php echo $quotation->path ?>" style="width: 110px; height:94px">
                                                            </div>
                                                            <div class="kt-widget__content">
                                                                <div class="kt-widget__head">
                                                                    <a href="<?php echo DIR_VIEW.DIR_PRO;?>productdetails.php?productId=<?php echo $quotation->productId ?>" class="kt-widget__title"><?php echo $quotation->name ?></a>
                                                                </div>
                                                                <div class="kt-widget__info">
                                                                    <div class="kt-widget__stats d-flex align-items-center flex-fill">
                                                                        <div class="kt-widget__item">
                                                                            <div class="kt-widget__label">
                                                                                <span class="btn btn-label-dark btn-sm btn-bold btn-upper" onclick=""><b>Status:</b> <?php echo $qstatus ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-widget__item">
                                                                            <div class="kt-widget__label">
                                                                                <span class="btn btn-label-dark btn-sm btn-bold btn-upper" onclick="">
                                                                                    <a href="view/orders/received-quotations-detail.php?quotationId=<?php echo $quotation->quotationId?>">
                                                                                        Detail Page
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                    <?php }
                                    } else {
                                        echo "<h2>No quotations</h2>";
                                    } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                <!--End::Portlet-->
            </div>
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
<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<script src="assets/js/pages/components/calendar/list-view.js" type="text/javascript"></script>
<script src="assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>
