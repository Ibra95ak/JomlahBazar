<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if(isset($_SESSION['userId'])){
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$roleId = $usr->roleId;
	$userId = $usr->userId;
	switch ($_SESSION['Login_as']) {
		case 1:
			include("../".DIR_CON."header_buyer.php");
			break;
		case 2:
			include("../".DIR_CON."header_supplier.php");
			break;

		default:
			include("../".DIR_CON."header_buyer.php");
			break;
	}
}else{
	header("location:".DIR_VIEW.DIR_USR."login.php");
}/*Get page header*/
$res_quotation = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_functions.php?action=get_buyer_quotation_by_id&userId='.$userId.'&qid=' . $_GET['quotationId']);
$quotation = json_decode($res_quotation->getBody());
$res_negotiations = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_functions.php?action=get_negotiations_of_quotation&qid=' . $quotation->quotationId);
$negotiations = json_decode($res_negotiations->getBody());
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<style>
    .form-control[readonly] {
        background-color: #ede9e9;
    }
</style>

<script>
    function acceptQuotation(nid) {
        var accept = confirm('Do you really want to accept the Quotation?');
        if (accept) {
            $('#negotiationId').val(nid);
            $('#status').val(6);
            $('#quotation_status_form').submit();
        }
    }

    function cancelQuotation(nid) {
        var cancel = confirm('Do you really want to cancel the Quotation?');
        if (cancel) {
            $('#negotiationId').val(nid);
            $('#status').val(4);
            $('#quotation_status_form').submit();
        }
    }
</script>

<form method="POST" action="<?php echo DIR_CONT . DIR_CAR . "CON_functions.php?action=change_quotation_status_by_buyer" ?>" id="quotation_status_form">
    <input type="hidden" name="negotiationId" id="negotiationId">
    <input type="hidden" name="status" id="status">
</form>

<form method="POST" action="<?php echo DIR_CONT . DIR_CAR . "CON_functions.php?action=modify_quotation_by_buyer" ?>" id="modified_quotation_form">
    <input type="hidden" name="qid" id="qid" value="<?php echo $quotation->quotationId ?>">
    <input type="hidden" name="mfquantity" id="mfquantity">
    <input type="hidden" name="mfofferedprice" id="mfofferedprice">
    <input type="hidden" name="mffinalprice" id="mffinalprice">
</form>
<script>
    function mquantityfunc(nid) {
        var mquantity = $('#mquantity'+nid).val();
        var mprice = $('#mprice'+nid).val();
        var aprice = (mquantity * mprice);
        $('#mactualprice'+nid).val(aprice);
    }

    function sendMyOffer(nid) {
        var mfinalprice = $('#mfinalprice'+nid).val();
        if(mfinalprice == ''){
            alert('Please enter your price first');
        }else{
            var mquantity = $('#mquantity'+nid).val();
            var mofferedprice = $('#mofferedprice'+nid).val();
            var mfinalprice = $('#mfinalprice'+nid).val();

            $('#mfquantity').val(mquantity);
            $('#mfofferedprice').val(mofferedprice);
            $('#mffinalprice').val(mfinalprice);
            //console.log('Quantity is ' + mquantity + ' , Offered price is ' + mofferedprice + ' , Final price is ' + mfinalprice);
            $('#modified_quotation_form').submit();
        }
    }
</script>


<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->
    <div class="row">
        <div class="col-lg-10 offset-lg-1">

            <div class="kt-portlet__body">

                <!--begin::Widget -->
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand flaticon2-quotation-mark"></i>
                            </span>
                            <h3 class="kt-portlet__head-title kt-font-lg kt-font-bold">
                                Product Quotation
                            </h3>
                        </div>
                    </div>



                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-portlet">
                            <div class="kt-portlet__body">
                                <div class="kt-widget kt-widget--user-profile-3">
                                    <div class="kt-widget__top">
                                        <div class="kt-widget__media kt-hidden-">
                                            <img src="<?php echo $quotation->path ?>">
                                        </div>
                                        <div class="kt-widget__content">
                                            <div class="kt-widget__head">
                                                <a href="<?php echo DIR_VIEW.DIR_PRO.'productdetails.php?productId='.$quotation->product_id;?>" class="kt-widget__title"><?php echo $quotation->name ?></a>
                                                <div class="kt-widget__action">
                                                    <span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED <?php echo $quotation->min_price ?> </span>

                                                </div>
                                            </div>
                                            <div class="kt-widget__info">
                                                <div class="kt-widget__stats d-flex align-items-center flex-fill">
                                                    <div class="kt-widget__item">
                                                        <div class="kt-widget__label">
                                                            <span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED<?php echo $quotation->min_price ?>/pcs </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>



                </div>

                <!--End::Portlet-->
            </div>



        </div>

    </div>

    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="kt-portlet">

                <?php if ($quotation->statusId == 2) { ?>
                    <div class="alert alert-warning" role="alert">
                        <div class="alert-text"><strong>Status:</strong> No action has been taken on the quotation!</div>
                    </div>
                <?php } elseif ($quotation->statusId == 6) { ?>
                    <div class="alert alert-success" role="alert">
                        <div class="alert-text"><strong>Status:</strong> Quotation has been accepted!</div>
                    </div>
                <?php } elseif ($quotation->statusId == 4) { ?>
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-text"><strong>Status:</strong> Quotation has been cancelled!</div>
                    </div>
                <?php } ?>

                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Negotiation
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin::Section-->
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Quantity</th>
                                            <th>Actual Price</th>
                                            <th>Buyer Price</th>
                                            <th>Seller Price</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Comment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalNegotiations = count($negotiations);
                                        $i = 1;
                                        foreach ($negotiations as $negotiation) {
                                            $i++;
																						switch ($negotiation->nstatus) {
	                                            case '1':
	                                              $nstatus = 'Pending';
	                                              break;
	                                            case '2':
	                                              $nstatus = 'Opened';
	                                              break;
	                                            case '3':
	                                              $nstatus = 'Shipped';
	                                              break;
	                                            case '4':
	                                              $nstatus = 'Canceled';
	                                              break;
	                                            case '5':
	                                              $nstatus = 'Refunded';
	                                              break;
	                                            case '6':
	                                              $nstatus = 'Completed 	';
	                                              break;
	                                            case '7':
	                                              $nstatus = 'Closed';
	                                              break;
	                                            default:
	                                              $nstatus = 'Pending';
	                                              break;
	                                          }
																						?>
                                            <tr>
                                                <td><?php echo $negotiation->quantity ?></td>
                                                <td><?php echo $quotation->min_price * $negotiation->quantity ?></td>
                                                <td><?php echo $negotiation->buyer_price ?></td>
                                                <td><?php echo ($negotiation->seller_price == '' ? '---' : $negotiation->seller_price) ?></td>
                                                <td><?php echo $negotiation->date ?></td>
                                                <td><?php echo $nstatus ?></td>
                                                <td><?php echo ($negotiation->comment == '' ? '---' : $negotiation->comment) ?></td>
                                                <td>
                                                    <div class="btn-group btn-group" role="group">
                                                        <button class="btn btn-success btn-sm" <?php echo ((($negotiation->last_modified_by == 'buyer') || $negotiation->nstatus == 7 || $negotiation->nstatus == 4 || $totalNegotiations >= $i) ? 'disabled' : '') ?> onclick="acceptQuotation(<?php echo $negotiation->negotiationId; ?>)">Accept</button>
                                                        <button type="button" class="btn btn-danger btn-sm" <?php echo (($negotiation->last_modified_by == 'buyer' || $negotiation->nstatus == 7 || $negotiation->nstatus == 4 || $totalNegotiations >= $i) ? 'disabled' : '') ?> onclick="cancelQuotation(<?php echo $negotiation->nid; ?>)">Cancel</button>
                                                        <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#myModal<?php echo $negotiation->nid  ?>" <?php echo (($negotiation->last_modified_by == 'buyer' || $negotiation->nstatus == 7 || $negotiation->nstatus == 4 || $totalNegotiations >= $i) ? 'disabled' : '') ?>>Modify</button>
                                                    </div>
                                                    <div id="myModal<?php echo $negotiation->nid  ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog modal-md">

                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Modify</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <table class="table">
                                                                                <tr>
                                                                                    <th>Price per piece</th>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-prepend">
                                                                                                <button class="btn btn-secondary" type="button">AED</button>
                                                                                            </div>
                                                                                            <input type="number" class="form-control" id="mprice<?php echo $negotiation->nid; ?>" value="<?php echo $quotation->min_price ?>" readonly>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Required quantity</th>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-prepend">
                                                                                                <button class="btn btn-secondary" type="button">Pcs</button>
                                                                                            </div>
                                                                                            <input type="number" class="form-control" id="mquantity<?php echo $negotiation->nid; ?>" onclick="mquantityfunc(<?php echo $negotiation->nid; ?>)" value="<?php echo $negotiation->quantity ?>">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Actual price</th>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-prepend">
                                                                                                <button class="btn btn-secondary" type="button">AED</button>
                                                                                            </div>
                                                                                            <input type="number" class="form-control" id="mactualprice<?php echo $negotiation->nid; ?>" value="<?php echo $quotation->min_price * $negotiation->quantity ?>" readonly>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Offered price</th>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-prepend">
                                                                                                <button class="btn btn-secondary" type="button">AED</button>
                                                                                            </div>
                                                                                            <input type="text" class="form-control" id="mofferedprice<?php echo $negotiation->nid; ?>" value="<?php echo $negotiation->buyer_price ?>" readonly>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>My Final Price</th>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-prepend">
                                                                                                <button class="btn btn-secondary" type="button">AED</button>
                                                                                            </div>
                                                                                            <input type="text" class="form-control" id="mfinalprice<?php echo $negotiation->nid; ?>">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <button type="button" class="btn btn-success" onclick="sendMyOffer(<?php echo $negotiation->nid; ?>)">Send My Offer</button>
                                                                                    </td>
                                                                                </tr>

                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--end::Section-->

                    </div>

                    <!--end::Form-->
                </div>



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
