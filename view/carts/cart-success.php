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
	include("../".DIR_CON."guestheader.php");
	$userId = 0;
}/*Get page header*/
$res_item = $client->request('GET', DIR_CONT . DIR_CAR . 'CON_carts.php?action=get-cart-item&cartId=' . $_GET['cartId']);
$item = json_decode($res_item->getBody());
use Anam\Phpcart\Cart;
$cart = new Cart;
if ($cart->totalQuantity()!=0) {
	$quantity = $cart->totalQuantity();
	$price = $cart->getTotal();
	$product_cart_info = $cart->get($_GET['product_id']);
	$path = $product_cart_info->path;
	$maincategoryId = '';
}else {
	$quantity = $item->cart_item[0]->quantity;
	$price = $item->cart_item[0]->price;
	$path = $item->cart_item[0]->path;
	$maincategoryId = $item->cart_item[0]->maincategory;
}
/*Fetch featured products through API*/
$res_fp = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_FeaturedProducts.php');
$limitedoffer_products = json_decode($res_fp->getBody());
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="min-height:600px;">
    <!--Begin::Dashboard 3-->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-secondary fade show row" role="alert" style="border: solid 1px #ccc; background-color:#F3F3F3; font-size: 17px">
                <div class="alert-icon">
									<i class="flaticon2-check-mark kt-mr-5" style="color:#099700"></i>
									<a href="<?php echo DIR_VIEW . DIR_PRO.'productdetails.php?productId='.$item->cart_item[0]->productId;?>"><img src="<?php echo $path ?>" style="width: 59px;border: solid 1px;"></a>
									<span style="color:#099700; font-weight: bold; margin:10px">Added to Cart</span>
								</div>
                <div class="alert-text">
                    <span><b>Cart subtotal</b> (<?php echo $quantity; ?>)item(s)</span>
                    <span style="color:#B12704"><?php echo ": AED " . $quantity*$price; ?></span>
                    <a class="btn btn-shopping" href="<?php echo DIR_VIEW.DIR_PRO."marketplace.php?mcat=".$maincategoryId;  ?>">
                    <img src="assets/media/icons/continue_shopping.png" width="28px">
                    Continue Shopping</a>
                </div>
                <div class="alert-close">
                    <a href="<?php echo DIR_VIEW . DIR_CAR ?>cart.php" type="button" class="btn btn-brand" style="background-color:#e7e9ec; border-color: #ADB1B8 #A2A6AC #8D9096; color:black">
                    <img src="assets/media/icons/cart_black.png" width="24px">
                    Cart</a> &nbsp;
										<?php
											if ($userId!=0) {
												echo '<a href="'.DIR_VIEW.DIR_CAR.'checkout.php" type="button" class="btn btn-warning"><img src="assets/media/icons/shop.png" width="28px">Proceed to buy ('.$quantity.' item(s))</a>';
											}else {
												echo '<a href="javascript:void(0)" type="button" class="btn btn-warning" onclick="login(3,0,0,0)"><img src="assets/media/icons/shop.png" width="28px">Proceed to buy ('.$quantity.' item(s))</a>';
											}
										 ?>

                </div>
            </div>
        </div>
    </div>
		<div class="row">
			<h2 class="kt-font-md kt-font-bolder">Limited Offer Products <span class="kt-font-14"><a href="<?php echo DIR_VIEW.DIR_PRO."marketplace.php?ft=1";?>" class="kt-link kt-font-bolder">View All</a><span></h2>
			</div>
			<div class="row">
			<div class="owl-carousel owl-carousel3 owl-theme" style="z-index: 0;">
				<?php
				foreach ($limitedoffer_products as $limitedoffer_product) {
					echo '<div class="item"><div class="kt-portlet kt-portlet--height-fluid kt-widget19"><div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill"><div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 150px; background-image: url(' . $limitedoffer_product->path . ');min-height: 250px;background-size: contain;background-position: center;"></div></div>';
					echo '<div class="kt-portlet__body height-55"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">
	  <div class="kt-widget19__info"><a href="'.DIR_VIEW.DIR_PRO.'productdetails.php?productId='.$limitedoffer_product->productId.'" class="kt-widget19__username">' . $limitedoffer_product->name . '</a></div>
	  </div></div></div></div></div>';
				}
				?>
			</div>
		</div>
		<!--End::Dashboard 3-->
</div>
<script>
    new Noty({
        type: 'success',
        theme: 'metroui',
        timeout: 1000,
        text: 'Product has been successfully added.',
    }).show();
</script>
<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script type="text/javascript">
$('.owl-carousel3').owlCarousel({
	margin: 10,
	responsiveClass:true,
	responsive:{
			0:{
					items:2,
			},
			600:{
					items:3,
			},
			1000:{
					items:7,
					loop:false
			}
	}
});
</script>
