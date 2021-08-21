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

$res_product = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_products.php?action=get&productId=' . $_GET['productId']);
$product = json_decode($res_product->getBody());
?>

<script>
    function calculateActualPrice(price) {
        var price_per_piece = $('#price-per-piece').val();
        var price = price.value;
        $('#actual-price').val(price_per_piece * price);
    }

    function calculateUnitPrice(price){
        $('#offered_unit_price').html(price.value/500);
    }
</script>

<style>

.form-control[readonly] {
    background-color: #ede9e9;
}

</style>

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->
    <div class="row">
        <div class="col-lg-8 offset-lg-2">

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
                                            <img src="<?php echo $product->productpics[0]->path ?>">
                                        </div>
                                        <div class="kt-widget__content">
                                            <div class="kt-widget__head">
                                                <a href="<?php echo DIR_VIEW.DIR_PRO;?>productdetails.php?productId=1250" class="kt-widget__title"><?php echo $product->products->name ?></a>
                                                <div class="kt-widget__action">
                                                    <span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED <?php echo $_GET['price'] ?> </span>

                                                </div>
                                            </div>
                                            <div class="kt-widget__info">
                                                <div class="kt-widget__stats d-flex align-items-center flex-fill">
                                                    <div class="kt-widget__item">
                                                        <div class="kt-widget__label">
                                                            <span class="btn btn-label-dark btn-sm btn-bold btn-upper">AED<?php echo $_GET['price'] ?>/pcs </span>
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
        <div class="col-lg-8 offset-lg-2">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Negotiation
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form kt-form--label-right" method="POST" action="<?php echo DIR_CONT.DIR_CAR."CON_functions.php?action=submit_quotation"?>">
                    <input type="hidden" name="userId" value="<?php echo $userId ?>">
                    <input type="hidden" name="sellerId" value="<?php echo $_GET['sellerId']; ?>">
                    <input type="hidden" name="productId" value="<?php echo $product->products->productId ?>">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Price per piece</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary" type="button">AED</button>
                                    </div>
                                    <input type="text" class="form-control" value="<?php echo $_GET['price'] ?>" id="price-per-piece" placeholder="" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Required quantity</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary" type="button">Pcs</button>
                                    </div>
                                    <input type="number" class="form-control" name="quantity" value="500" onchange="calculateActualPrice(this)" placeholder="" required min="500">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>Actual price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-secondary" type="button">AED</button>
                                </div>
                                <input type="number" class="form-control" id="actual-price" value="<?php echo $_GET['price']*500 ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>My offered price (<span id="offered_unit_price"><?php echo $_GET['price']*500/500 ?></Span> AED/per piece)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-secondary" type="button">AED</button>
                                </div>
                                <input type="number" name="offered_price" value="<?php echo $_GET['price']*500 ?>" class="form-control" onchange="calculateUnitPrice(this)" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>Required by when</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-secondary" type="button">
                                        <i class="flaticon-calendar-with-a-clock-time-tools"></i>
                                    </button>
                                </div>
                                <input type="date" name="required_by" class="form-control" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>Additional Comment</label>
                            <div class="input-group">
                                <textarea class="form-control" name="comment" rows="4" placeholder="Enter any comment if have (optional)"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-success">Send My Quotation</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
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
