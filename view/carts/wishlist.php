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
$res_wishlist = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_functions.php?action=get_wishlist&userId=' . $userId);

$wishlists = json_decode($res_wishlist->getBody());
?>

<script>
    currentUrl = window.location.href;
    var split = currentUrl.split('?');
    var message = split[1].split('=');
    if (message[1] == 'deleted') {
        new Noty({
            type: 'success',
            theme: 'metroui',
            timeout: 3000,
            text: 'Wishlist has been deleted successfully.',
        }).show();
    }
</script>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">




    <div class="row">
        <div class="col-lg-9">


            <div class="kt-portlet__body">

                <!--begin::Widget -->
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <img src="<?php echo DIR_ROOT.DIR_ICON;?>whishlist-ele.png" alt="" style="width: 80px;">
                            </span>
                            <h3 class="kt-portlet__head-title kt-font-lg kt-font-bold">
                                My WishList
                            </h3>
                        </div>
                    </div>



                    <div class="kt-portlet__body kt-portlet__body--fit">


                        <?php
                        if (is_array($wishlists) || is_object($wishlists)) {
                            if ($wishlists != null) {
                                foreach ($wishlists as $item) { ?>

                                    <div class="kt-portlet">



                                        <div class="kt-portlet__body">
                                            <div class="kt-widget kt-widget--user-profile-3">
                                                <div class="kt-widget__top">
                                                    <div class="kt-widget__media kt-hidden-">
                                                        <img src="<?php echo $item->path ?>">
                                                    </div>
                                                    <div class="kt-widget__content">
                                                        <div class="kt-widget__head">
                                                            <a href="<?php echo DIR_VIEW . DIR_PRO ?>productdetails.php?productId=<?php echo $item->productId ?>" class="kt-widget__title"><?php echo $item->name ?></a>

                                                        </div>
                                                        <div class="kt-widget__info">
                                                            <div class="kt-widget__stats d-flex align-items-center flex-fill">
                                                                <div class="kt-widget__item">
                                                                    <div class="kt-widget__label">
                                                                        <?php $deleteLink = DIR_CONT . DIR_CAR . "CON_functions.php?action=delete_wishlist&id=" . $item->id . "&userId=" . $userId  ?>
                                                                        <a href="<?php echo $deleteLink ?>">
                                                                            <button type="button" class="btn btn-sm btn-upper" style="background: #edeff6">Remove from wishlist</button>
                                                                        </a>
                                                                        <button type="button" class="btn btn-sm btn-upper btn-warning" onclick="addToCart(<?php echo $item->productId ?>,'<?php echo $item->name ?>',<?php echo $item->min_price ?>,<?php echo $item->seller_id ?>,<?php echo $item->weight;?>)">Add to Cart</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form method="POST" id="cartform" action="<?php echo DIR_CONT . DIR_CAR.'cart-update.php?userId='.$userId;?>">
                                                          <input type="hidden" name="pid" id="pid">
                                                          <input type="hidden" name="pname" id="pname">
                                                          <input type="hidden" name="pp" id="pp">
                                                          <input type="hidden" name="sid" id="sid">
                                                          <input type="hidden" name="pqty" id="pqty" value="1">
																													<input type="hidden" name="wght" id="wght">
                                                        </form>
                                                        <script>
                                                            function addToCart(pid, pname, pp, sid,wght) {
                                                                $('#pid').val(pid);
                                                                $('#pid').val(pid);
                                                                $('#pname').val(pname);
                                                                $('#pp').val(pp);
                                                                $('#sid').val(sid);
                                                                $('#wght').val(wght);
                                                                $('#cartform').submit();
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php }
                            } else {
                                ?>
                                <div class="alert alert-secondary" role="alert">
                                    <div class="alert-text">Your wishlist is empty!</div>
                                </div>
                        <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-secondary" role="alert">
                                <div class="alert-text">Your wishlist is empty!</div>
                            </div><?php } ?>

                    </div>



                </div>

                <!--End::Portlet-->
            </div>




        </div>

        <div class="col-lg-3">
            <!--begin:: Widgets/Sales States-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title kt-font-lg kt-font-bold">
                            Order Summary
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo officia provident eligendi laboriosam facilis temporibus amet accusamus, sequi, at placeat laborum quae perferendis aliquid atque vel blanditiis sapiente neque aut.
                </div>
            </div>

            <!--end:: Widgets/Sales States-->
        </div>
    </div>



</div>

<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
