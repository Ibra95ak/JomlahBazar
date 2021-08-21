<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
require_once '../../'.DIR_MOD.'IP2Location.php';
use Vectorface\Whip\Whip;
$client = new GuzzleHttp\Client();
/*get client ip address*/
$whip = new Whip();
$clientIPAddress = $whip->getValidIpAddress();
if (isset($_SESSION['userId'])) {
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . rawurlencode($_SESSION['userId']));/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	$roleId = $usr->roleId;
	$userId = $usr->userId;
	$carturl = DIR_CONT . DIR_CAR."cart-update.php?userId=".$userId;
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
	$disabled="";
	$user_country = $_SESSION['country'];
} else {
	include("../" . DIR_CON . "guestheader.php");
	$disabled="disabled";
	$carturl = DIR_VIEW . DIR_CAR."cart-post.php";
	$dbloc = new \IP2Location\Database('../../assets/databases/IP2LOCATION-LITE-DB1.BIN', \IP2Location\Database::FILE_IO);
	$records = $dbloc->lookup($clientIPAddress, \IP2Location\Database::ALL);
	$user_country = $records['countryCode'];
}/*Get page header*/

if (isset($_GET['productId'])) $productId = $_GET['productId'];
else {
	$productId = 0;
}
/*get product general info*/
$res_pro = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_products.php?action=get&productId=' . $productId);
$product = json_decode($res_pro->getBody());
/*get product reviews*/
$res_rev = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_Reviews.php?action=get&productId=' . $productId);
$reviews = json_decode($res_rev->getBody());
/*get product suppliers*/
$res_sup = $client->request('GET', DIR_CONT.DIR_PRO. 'CON_productsuppliers.php?action=get&productId=' . $productId);
$supplier = $res_sup->getBody();
$suppliers = json_decode($supplier);
if(isset($_GET['supplierId'])){
	$selling_price = '';
	$is_carton = '';
	$price2 = '';
	$supplierId = '';
	$companyname =  '';
	$quantity =  '';
	$production_date =  '';
	$exp_date =  '';
	$supplier_country =  '';
	$temperature = '';
	$humidity = '';
	$origin = '';
	$supplier_tax = '';
}else{
	$selling_price = number_format($suppliers->suppliers[0]->selling_price + ($suppliers->suppliers[0]->selling_price*0.05),2);
	if ($suppliers->suppliers[0]->price2) $original_price=$suppliers->suppliers[0]->price2;
	else $original_price=$suppliers->suppliers[0]->price1;
	$is_carton = $suppliers->suppliers[0]->is_carton;
	$price2 = $suppliers->suppliers[0]->price2;
	$supplierId = $suppliers->suppliers[0]->supplierId;
	$companyname =  $suppliers->suppliers[0]->companyname;
	$quantity =  $suppliers->suppliers[0]->quantity;
	$production_date =  $suppliers->suppliers[0]->production_date;
	$exp_date =  $suppliers->suppliers[0]->exp_date;
	$supplier_country =  $suppliers->suppliers[0]->country;
	$temperature = $suppliers->suppliers[0]->temperature;
	$humidity = $suppliers->suppliers[0]->humidity;
	$origin = $suppliers->suppliers[0]->Origin;
	$supplier_tax = $suppliers->suppliers[0]->tax;
	$supplier_discount = $suppliers->suppliers[0]->discount;
}
switch ($is_carton) {
	case '1':
		$sellby = "Carton";
		$moq_type = "Carton";
		$pack = 'Carton QTY';
		$byimg= DIR_ROOT.DIR_ICON."by-box.png";
		break;
	case '2':
		$sellby = "Piece";
		$moq_type = "Pieces";
		$pack = 'Pack QTY';
		$byimg= DIR_ROOT.DIR_ICON."by-piece.png";
		break;
	case '3':
		$sellby = "Pack";
		$moq_type = "Packs";
		$pack = 'Pack QTY';
		$byimg= DIR_ROOT.DIR_ICON."by-piece.png";
		break;
	default:
		$sellby = "Piece";
		$moq_type = "Pieces";
		$pack = 'Pack QTY';
		$byimg= DIR_ROOT.DIR_ICON."by-piece.png";
		break;
}
if ($suppliers->suppliers[0]->range2==0) {
	$pro_range = $suppliers->suppliers[0]->range1;
}else {
	$pro_range = $suppliers->suppliers[0]->range2;
	$price2 = $suppliers->suppliers[0]->price2-($suppliers->suppliers[0]->price2*($suppliers->suppliers[0]->discount/100));
	$p2 = $price2 + ($price2*0.05);
}
$price1 = $suppliers->suppliers[0]->price1-($suppliers->suppliers[0]->price1*($suppliers->suppliers[0]->discount/100));
$p1 = $price1 + ($price1*0.05);
if ($supplier_country=="UAE") {
	$shipping_DI = "Domestic Shipping";
}else {
	$shipping_DI = "International Shipping";
}
$product_Id = $product->products->productId;
$product_name = $product->products->name;
$product_description = $product->products->description;
$product_barcode = $product->products->barcode;
$product_asin = $product->products->asin;
$product_ranking = $product->products->ranking;
$product_bestseller = $product->products->bestseller;
$product_featured = $product->products->featured;
$product_brandId = $product->products->brandId;
$product_brandname = $product->products->brand_name;
$product_maincategoryname = $product->products->maincategory_name;
$product_categoryname = $product->products->category_name;
$product_detailstype = $product->products->detailstype;
$product_totalquantity = $product->productqty->totalquantity;
$product_weight = $product->products->weight;
$product_width = $product->products->width;
$product_length = $product->products->length;
$product_height = $product->products->height;
$jb_fees = $product->products->jb_percentage_fees;
switch ($product_detailstype) {
	case 1:
		$product_size = $product->productdetails->size;
		$product_ingredients = $product->productdetails->ingredients;
		$product_highlights = $product->productdetails->highlights;
		$product_formen_women = $product->productdetails->formen_women;
		$product_count = $product->productdetails->count;
		$product_hairskintypes = $product->productdetails->hair_skintypes;
		break;
	case 2:
		$product_size = $product->productdetails->size;
		$product_color = $product->productdetails->color;
		$product_ingredients = $product->productdetails->ingredients;
		$product_shadename = $product->productdetails->shadename;
		$product_highlights = $product->productdetails->highlights;
		break;
	case 3:
		$product_size = $product->productdetails->size;
		$product_ingredients = $product->productdetails->ingredients;
		$product_highlights = $product->productdetails->highlights;
		$product_packageinformation = $product->productdetails->packageinformation;
		$product_manufacturer = $product->productdetails->manufacturer;
		break;
	case 4:
		$product_size = $product->productdetails->size;
		$product_fragrancefor = $product->productdetails->fragrancefor;
		$product_scenttype = $product->productdetails->scenttype;
		$product_topnotes = $product->productdetails->topnotes;
		break;
	case 5:
		$product_size = $product->productdetails->size;
		$product_setdescription = $product->productdetails->set_description;
		$product_formen_women = $product->productdetails->formen_women;
		break;
	case 6:
		$product_size = $product->productdetails->size;
		$product_fragrancefor = $product->productdetails->fragrancefor;
		$product_scenttype = $product->productdetails->scenttype;
		$product_topnotes = $product->productdetails->topnotes;
		break;

	default:
		$product_size = $product->productdetails->size;
		$product_ingredients = $product->productdetails->ingredients;
		$product_highlights = $product->productdetails->highlights;
		break;
}
/*Full URL*/
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>

<script>
	function printSlip(id) {
		var id = id;
		var features = 'directories=no,menubar=no,status=no,titlebar=no,toolbar=no,width=800,height=600,top=50,left=100,scrollbars=no';
		var mypopup = window.open(DIR_VIEW+DIR_PRO+'free_shipping.php', 'mypopup', features);
	}
</script>


<div class="kt-subheader kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
									<h3 class="kt-subheader__title">
										Home </h3>
									<span class="kt-subheader__separator kt-hidden"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="<?php echo DIR_ROOT;?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
											<?php echo $product_maincategoryname;?> </a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
											<?php echo $product_categoryname;?> </a>
									</div>
								</div>
								<div class="kt-subheader__toolbar">
									<div class="kt-subheader__wrapper">
										<div class="alert white-bk kt-p0 kt-m0" role="alert">
											<div class="alert-text text-center">
												Share &nbsp;&nbsp;
												<a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?php echo urlencode($url) ?>." target="_blank"><i class="socicon-mail" style="font-size: 17px;     color: black;"></i></a>
												<!-- <a href="javascript:void(0)" target="_blank"><i class="socicon-facebook" style="font-size: 17px;     color: black;"></i></a> -->
												<a href="https://wa.me/?text=<?php echo urlencode($url) ?>" target="_blank"><i class="socicon-whatsapp" style="font-size: 17px; color: black;"></i></a>
												<a href="javascript:void(0)" class="clipboard"><i class="la la-copy" style="font-size: 19px;     color: black;"></i></a> <span id="confirm-copy"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
	<div class="row safari-row-block">
		<div class="col-md-8">
			<div class="kt-portlet white-bk">
				<div class="kt-portlet__body">
					<div class="kt-widget kt-widget--user-profile-3">
						<div class="kt-widget__top row">
							<div id="thumbs" class="owl-carousel owl-theme vnav col-md-1">
								<?php
								foreach ($product->productpics as $pic) {
									echo '<div class="item magnifier-thumb-wrapper"> <img src="' . $pic->path . '" class="kt-mb-5 kt-ml-5 border slidernav thumb"> </div>';
								}
								?>
								<div class="magnifier-preview" id="preview" style="width: 200px; height: 133px"></div>
							</div>
							<div id="pro_img" class="owl-carousel owl-theme col-md-5">
								<?php
								foreach ($product->productpics as $pic) {
									echo '<div class="item"><img src="' . $pic->path . '" style="max-width: 500px;"> </div>';
								}
								?>
							</div>
							<div class="kt-widget__content col-md-6">
								<div class="kt-widget__head">
									<h2 class="kt-font-dark"><?php echo $product_name; ?></h2>
								</div>

								<div class="kt-font-dark">
									By
									<a href="<?php echo DIR_VIEW.DIR_PRO.'marketplace.php?brnd='.$product_brandId;?>" class="kt-link kt-link--brand kt-font-bolder kt-font-md">
										<?php echo $product_brandname; ?>
									</a>
								</div>
								<div class="kt-list-pics kt-list-pics--sm kt-widget19__title">
									<?php
									if ($product_ranking==0) {
										echo '<i class="la la-star-o"></i><i class="la la-star-o"></i><i class="la la-star-o"></i><i class="la la-star-o"></i><i class="la la-star-o"></i>';
									}else {
										$whole = floor($product_ranking);      // 1
										$fraction = $product_ranking - $whole; // .25
											for ($i=0; $i < $whole; $i++) {
												echo '<i class="la la-star"></i>';
											}
											if ($fraction>0) {
												echo '<i class="la la-star-half-o"></i>';
											}
									}
									?>
								</div>
								<hr>
								<div class="row safari-row-block">
									<div class="col-md-12">
										<h3 class="kt-portlet__head-title">Lowest Price Per <?php echo $sellby;?><span class="kt-font-raspberry kt-font-price kt-font-bolder"><?php echo ' AED '.  $selling_price;?></span><?php if ($supplier_discount!=0) echo '<span class="kt-font-dark kt-font-sm kt-font-dark kt-ml-5"><s>AED '.$original_price.'</s></span>';?><span class="kt-font-dark kt-font-sm kt-font-dark"> (VAT included)</span><br><span class="kt-font-raspberry kt-font-md"><span class="kt-font-dark">Sold By </span><a href="<?php echo DIR_VIEW . DIR_STR . 'storedetails.php?userId=' . $supplierId;?>" class="kt-link kt-font-raspberry" style="color:#213fd7">
											<?php echo $companyname.'<span class="kt-font-dark"> Available QTY('.$quantity.')</span>'; ?>
										</a></span></h3>
										<span class="kt-hidden">See on</span>
										<a class="kt-hidden" href="https://www.amazon.com/dp/<?php echo $product_asin; ?>" target="_blank">
											<img src="https://cdn4.iconfinder.com/data/icons/iconsimple-logotypes/512/amazon-64.png" width="20px">
										</a><br>
										<a href="<?php echo DIR_VIEW.DIR_PRO.'productdetails.php?productId='.$productId?>#other_sellers" class="kt-link kt-link--brand kt-font-bolder kt-space-30" ><?php echo 'New (' . count($suppliers->suppliers) . ') from AED ' . $selling_price.' Total QTY('.$product_totalquantity.')'; ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<!--begin::Portlet-->
			<div class="kt-portlet white-bk border">
				<!--begin::Form-->
				<form class="kt-form">
					<div class="kt-portlet__body">
						<div class="kt-space-3"></div>
						<div class="row safari-row-block">
							<div class="col-md-12">
								<h3 class="kt-portlet__head-title"><?php echo $sellby;?> Price: <span class="kt-font-dark kt-font-price kt-font-bolder">AED <?php echo $selling_price; ?></span></h3>
								<!-- <h3 class="kt-portlet__head-title"><?php //echo $sellby;?> Price: <span class="kt-font-dark kt-font-price kt-font-bolder">AED <?php //echo number_format($selling_price,2); ?></span> (For <?php //echo $pro_range?> QTY)</h3> -->
							</div>
						</div>
						<div class="kt-space-3"></div>
						<div>
							<div class="form-group row kt-mb-0">
								<input type="hidden" id="r1" value="<?php echo $suppliers->suppliers[0]->range1; ?>">
								<input type="hidden" id="r2" value="<?php echo $suppliers->suppliers[0]->range2; ?>">
								<input type="hidden" id="p1" value="<?php echo number_format($p1,2, '.', ''); ?>">
								<input type="hidden" id="p2" value="<?php echo number_format($p2,2, '.', ''); ?>">
								<div class="kt-portlet shadow-none">
										<div class="kt-portlet__body kt-p0">
											<!--begin::Accordion-->
											<div class="accordion accordion-light accordion-toggle-plus kt-font-bolder kt-font-raspberry" id="accordionExample3">
												<div class="card kt-m0">
													<div class="card-header" id="headingOne3">
														<div class="card-title kt-p0" data-toggle="collapse" data-target="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
															<h2 class="kt-font-md kt-pl10">Minimum Order Quantity is: <b><?php echo $suppliers->suppliers[0]->range1.' '.$moq_type;?></b></h2>
														</div>
													</div>
													<div id="collapseOne3" class="collapse show" aria-labelledby="headingOne3" data-parent="#accordionExample3" style="">
														<div class="card-body">
															<?php
															echo '<div class="kt-widget kt-widget--project-1"><div class="kt-widget__body kt-pb-0" style="padding: 10px;"><div class="kt-widget__stats row"><div class="kt-widget__item col-md-4 col-4 kt-pl0 kt-pr0">';
															if ($suppliers->suppliers[0]->range2!=0) {
																echo '<div class="kt-widget__label kt-label-size"><span class="btn btn-label-white btn-upper btn-width-full norounded-right kt-font-12 border">'.$suppliers->suppliers[0]->range2.' '.$moq_type.'</span></div><div class="kt-space-3"></div>';
															}
															echo '<div class="kt-widget__label kt-label-size"><span class="btn btn-label-white btn-upper btn-width-full norounded-right kt-font-12 border">' . $suppliers->suppliers[0]->range1.' '.$moq_type.'</span></div><div class="kt-space-3"></div>';
															echo '</div><div class="kt-widget__item col-md-8 col-6 kt-pl0 kt-pr0">';
															if ($suppliers->suppliers[0]->price2!=0) {
																if ($suppliers->suppliers[0]->discount!=0) {
																	$tp21_discount = $suppliers->suppliers[0]->price2*($suppliers->suppliers[0]->discount/100);
																	$tp21 = $suppliers->suppliers[0]->price2-$tp21_discount + (($suppliers->suppliers[0]->price2-$tp21_discount)* 0.05);
																}else {
																	$tp21 = $suppliers->suppliers[0]->price2 + ($suppliers->suppliers[0]->price2 * 0.05);
																}
																echo '<div class="kt-widget__label kt-ml-n5"><span class="btn btn-label-dark-lighter btn-upper btn-width-full kt-font-bolder height-40 arrow_box-left-in">' . number_format($tp21,2) . '</span></div><div class="kt-space-3"></div>';
															}
															if ($suppliers->suppliers[0]->discount!=0) {
																$tp11_discount = $suppliers->suppliers[0]->price1*($suppliers->suppliers[0]->discount/100);
																$tp11 = $suppliers->suppliers[0]->price1-$tp11_discount + (($suppliers->suppliers[0]->price1-$tp11_discount)* 0.05);
															}else {
																$tp11 = $suppliers->suppliers[0]->price1 + ($suppliers->suppliers[0]->price1 * 0.05);
															}
															echo '<div class="kt-widget__label kt-ml-n5"><span class="btn btn-label-dark-lighter btn-upper btn-width-full kt-font-bolder height-40 arrow_box-left-in">' . number_format($tp11,2) . '</span></div><div class="kt-space-3"></div>';
															echo '</div></div></div></div>';
															?>
														</div>
													</div>
												</div>
											</div>
											<!--end::Accordion-->
										</div>
									</div>
							</div>
							<div class="form-group row safari-row-block kt-mb-0">
								<div class="col-md-4 col-12 kt-p0 kt-pl10">
									<input type="hidden" name="range1" id="range1" value="<?php echo $suppliers->suppliers[0]->range1;?>">
									<input type="hidden" name="supplierInventory" id="supplierInventory" value="<?php echo $suppliers->suppliers[0]->quantity;?>">
									<div class="input-group">
										<input type="number" id="quantity" class="form-control quantity-dropdown" aria-describedby="quantityHelp" placeholder="QTY" value="<?php echo $suppliers->suppliers[0]->range1;?>" min="<?php echo $suppliers->suppliers[0]->range1;?>">
									</div>
								</div>
								<div class="col-md-8 col-12 kt-pl0">
									<span for="example-text-input" class="btn btn-label-dark btn-upper arrow_box-left-in norounded-left total_price kt-font-sm" >Total Price: <span class="kt-font-raspberry kt-font-price kt-font-bolder animate__animated" id="total_price" name="total_price"></span><br></span>
									<input type="hidden" name="unit_price" id="unit_price">
								</div>
							</div>
							<div class="kt-space-3"></div>
							<div class="form-group row kt-mb-0">
								<div class="col-md-12 kt-p0 kt-pl10 kt-pr10 rm-phone-pr">
									<span class="btn btn-label-dark-lighter kt-pr0 kt-pt5 kt-pb-0 text-left total_shipment">
										ARRIVES:  <span class="kt-font-dark kt-font-sm kt-font-bolder">1 to 3 days  </span>
										<!-- <span for="example-text-input" class="kt-font-dark kt-font-sm" style="height: 38px;"> UAE estimated shipment: <span class="kt-font-raspberry kt-font-bolder kt-font-price animate__animated" id="shipp"></span><br></span> -->
									</span>
									<span class="btn btn-label-dark-lighter kt-pr0 kt-pt5 kt-pb-0 text-left total_shipment kt-mt5 border-warning" id="shipp_notice" style="display:none;">Shipment will be calculated seperately!</span>
								</div>
							</div>
							<div class="row safari-row-block">
								<div class="col-md-6 kt-mt-5 kt-pr0">
									<div class="kt-form__actions">
										<button type="button" onclick="addToCart()" class="btn btn-yellow btn-width-full" >
											<i class="fa fa-shopping-cart" style="position: absolute;left: 23px;"></i>Add to Cart</button>
									</div>
								</div>
								<div class="col-md-6 kt-mt-5 kt-pr0">
									<div class="kt-form__actions">
										<button type="button" onclick="buyNow()" class="btn btn-warning btn-width-full" style="background-color: #ebb44d;
										border-color: #f8dd5a; color: black">
										<i class="fa fa-shopping-bag" style="position: absolute;left: 23px;"></i>
										Buy Now
										</button>
									</div>
								</div>
							</div>
							<div class="kt-space-3"></div>
							<div class="row safari-row-block">
								<div class="col-md-6 kt-mt-5 kt-pr0">
									<div class="kt-form__actions">
										<?php
										if (isset($_SESSION['userId'])) echo '<button type="button" class="btn btn-secondary btn-width-full" onclick="addToWishList(' . $userId . ',' . $suppliers->suppliers[0]->supplierId . ',' . $product_Id . ')" style="background-color: #e9e5e5; color:black; border-color: #e9e5e5;"><i class="fa fa-heart" style="position: absolute;left: 23px;"></i>Wishlist</button>';
										else echo '<button type="button" class="btn btn-secondary btn-width-full" onclick="login(1,'.$product_Id.','.$suppliers->suppliers[0]->supplierId.',0)" style="background-color: #e9e5e5; color:black; border-color: #e9e5e5;"><i class="fa fa-heart" style="position: absolute;left: 23px;"></i>Wishlist</button>';
										?>
									</div>
								</div>
								<div class="col-md-6 kt-mt-5 kt-pr0">
									<div class="kt-form__actions">
										<?php
										if (isset($_SESSION['userId'])) echo '<button type="button" class="btn btn-secondary btn-width-full" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="For orders of QTY 500+" data-original-title="" title="" onclick="negotiate('.$product_Id.','.$suppliers->suppliers[0]->supplierId.','.$selling_price.')" style="background-color: #d1f89d; color: black; border-color: #d1f89d;"><i class="la la-comments" style="position: absolute;left: 23px;"></i>Negotiate</button>';
										else echo '<button type="button" class="btn btn-secondary btn-width-full" data-container="body" data-toggle="kt-popover" data-placement="bottom" data-content="For orders of QTY 500+" data-original-title="" title=""  onclick="login(2,'.$product_Id.','.$suppliers->suppliers[0]->supplierId.','.$selling_price.')" style="background-color: #d1f89d; color: black; border-color: #d1f89d;"><i class="la la-comments" style="position: absolute;left: 23px;"></i>Negotiate</button>';
										?>
									</div>
								</div>

							</div>
							<div class="kt-space-3"></div>

							<div class="kt-font-dark">
								<i class="fa fa-lock"></i>
								<a href="javascript:void(0)" class="kt-link kt-link--brand">
									Secure transaction
								</a>
								<h3 class="kt-portlet__head-title kt-mt-5">Sold By: <span class="kt-font-raspberry kt-font-md"><a href="<?php echo DIR_VIEW . DIR_STR . 'storedetails.php?userId=' . $suppliers->suppliers[0]->supplierId;?>" class="kt-link kt-font-dark" style="color:#213fd7">
									<?php echo $companyname.' Total QTY('.$suppliers->suppliers[0]->quantity.')'; ?>
								</a></span></h3>
								<h3 class="kt-font-dark kt-mt-5"> <?php echo $shipping_DI;?> <a href="javascript:void(0)" onclick="printSlip()" class="kt-link--brand">Details</a> </h3>
							</div>
						</div>

				</form>
				<form method="POST" id="cartform" action="<?php echo $carturl;?>">
					<input type="hidden" name="pid" id="pid" value="<?php echo $product_Id ?>">
					<input type="hidden" name="pqty" id="pqty">
					<input type="hidden" name="pp" id="pp" value="">
					<input type="hidden" name="sid" id="sid" value="<?php echo $suppliers->suppliers[0]->supplierId; ?>">
					<input type="hidden" name="pname" id="pname" value="<?php echo $product_name ?>">
					<input type="hidden" name="wght" id="wght" value="<?php echo $product_weight ?>">
					<input type="hidden" name="buynow" id="buynow" value="0">
				</form>
				<form method="POST" id="addtowishlist" action="<?php echo DIR_CONT . DIR_CAR . "CON_functions.php?action=add_to_wishlist"; ?> ">
					<input type="hidden" name="userId" id="userId">
					<input type="hidden" name="sellerId" id="sellerId">
					<input type="hidden" name="productId" id="productId">
					<input type="hidden" name="product">
				</form>
			</div>
			<script>
				function addToCart() {
					var sellerId = $('#sid').val();
					var buyerId = <?php echo $userId?>;
					if (sellerId==buyerId) {
						swal.fire({
			        title: 'You can not buy your own products!',
			        timer: 2000,
			        onOpen: function() {
			          swal.showLoading()
			        }
			      })
					}else {
						var range1 = $('#range1').val();
						var quantity_val = parseInt($('#quantity').val());
						var quantity = quantity_val;
						var unitprice = $('#unit_price').val();
						var supplierInventory = parseInt($('#supplierInventory').val());
						if (quantity<range1) {
							alert("Minimum order acquired");
						}else{
							var usertype = <?php if($_SESSION['Login_as']) echo $_SESSION['Login_as'];else echo "0";?>;
							if (usertype==2) {
								$.ajax({
									url: DIR_CONT+DIR_USR+"CON_user_access.php?action=switch-buyer",
									context: document.body
								}).done(function() {
									if (quantity<=supplierInventory) {
										$('#pqty').val(quantity);
										$('#pp').val(unitprice);
										$('#cartform').submit();
									}else {
										alert("No enough Inventory");
									}
								});
							}else {
								if (quantity<=supplierInventory) {
									$('#pqty').val(quantity);
									$('#pp').val(unitprice);
									$('#cartform').submit();
								}else {
									alert("No enough Inventory");
								}
							}
						}
					}
				}

				function buyNow(){
					var sellerId = $('#sid').val();
					var buyerId = <?php echo $userId?>;
					if (sellerId==buyerId) {
						swal.fire({
			        title: 'You can not buy your own products!',
			        timer: 2000,
			        onOpen: function() {
			          swal.showLoading()
			        }
			      })
					}else {
						$('#buynow').val(1);
						this.addToCart();
					}
				}

				function addToWishList(uid, sid, pid) {
					$('#userId').val(uid);
					$('#sellerId').val(sid);
					$('#productId').val(pid);
					var usertype = <?php if($_SESSION['Login_as']) echo $_SESSION['Login_as'];else echo "0";?>;
					if (usertype==2) {
						swal.fire({
							title: 'To complete this action you will be using your buyer account!',
							text: "Do you want to switch to buyer?",
							type: 'warning',
							showCancelButton: true,
							confirmButtonText: 'Yes, switch account!'
						}).then(function(result) {
							if (result.value) {
								$.ajax({
								  url: DIR_CONT+DIR_USR+"CON_user_access.php?action=switch-buyer",
								  context: document.body
								}).done(function() {
									$('#addtowishlist').submit();
								});
							}
						});
					}else {
						$('#addtowishlist').submit();
					}
				}

				currentUrl = window.location.href;
				var split = currentUrl.split('&');
				if(split[1]){
					var message = split[1].split('=');
					if (message[1] == 'addedtowishlist') {
						new Noty({
							type: 'success',
							theme: 'metroui',
							timeout: 3000,
							text: 'Product has been added to wishlist.',
						}).show();
					}else if (message[1] == 'alreadyaddedtowishlist') {
						new Noty({
							type: 'error',
							theme: 'metroui',
							timeout: 3000,
							text: 'Product is already into the wishlist.',
						}).show();
					}
				}
			</script>
			<!--end::Form-->
		</div>
		<!--end::Portlet-->
		</div>
</div>
<div class="row safari-row-block">
	<div class="col-md-8">
		<div class="row safari-row-block">
			<div class="col-md-6">
				<div class="kt-portlet" style="min-height: 380px;">
									<div class="kt-portlet__head">
										<div class="kt-portlet__head-label">
											<h3 class="kt-portlet__head-title">
												Product Information
											</h3>
										</div>
									</div>
									<div class="kt-portlet__body">
										<ul class="nav nav-tabs nav-fill" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" data-toggle="tab" href="#kt_tabs_1_1">Details</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#kt_tabs_1_2">Specifications</a>
											</li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="kt_tabs_1_1" role="tabpanel">
												<table class="table table-bordered">
														<tbody>
															<?php
															echo '<tr><td style="background-color: #e1dfd6;">Brand</td><td>'.$product_brandname.'</td></tr>';
															echo '<tr><td style="background-color: #e1dfd6;">Category</td><td>'.$product_categoryname.'</td></tr>';
															echo '<tr><td style="background-color: #e1dfd6;">'.$pack.'</td><td>'.$suppliers->suppliers[0]->boxquantity.'</td></tr>';
															if (isset($product_manufacturer) && $product_manufacturer!=null) echo '<tr><td style="background-color: #e1dfd6;">Manufacturer</td><td>'.$product_manufacturer.'</td></tr>';
															//if (isset($production_date) && $production_date!=null) echo '<tr><td style="background-color: #e1dfd6;">Production Date</td><td>'.$production_date.'</td></tr>';
															//if (isset($exp_date) && $exp_date!=null) echo '<tr><td style="background-color: #e1dfd6;">Expiry Date</td><td>'.$exp_date.'</td></tr>';
															//if (isset($origin) && $origin!=0) echo '<tr><td style="background-color: #e1dfd6;">Origin</td><td>'.$origin.'</td></tr>';
															if (isset($product_weight) && $product_weight!=0) echo '<tr><td style="background-color: #e1dfd6;">Weight</td><td>'.$product_weight.' KG</td></tr>';
															if (isset($product_width) && $product_width!=0) echo '<tr><td style="background-color: #e1dfd6;">Width</td><td>'.$product_width.'</td></tr>';
															if (isset($product_length) && $product_length!=0) echo '<tr><td style="background-color: #e1dfd6;">Length</td><td>'.$product_length.'</td></tr>';
															if (isset($product_height) && $product_height!=0) echo '<tr><td style="background-color: #e1dfd6;">Height</td><td>'.$product_height.'</td></tr>';
															?>
														</tbody>
													</table>
											</div>
											<div class="tab-pane" id="kt_tabs_1_2" role="tabpanel">
												<table class="table table-bordered">
														<tbody>
															<?php
															if (isset($product_size) && $product_size!=0) echo '<tr><td style="background-color: #e1dfd6;">Size</td><td>'.$product_size.'</td></tr>';
															if (isset($product_setdescription) && $product_setdescription!=null) echo '<tr><td style="background-color: #e1dfd6;">Set Description</td><td>'.$product_setdescription.'</td></tr>';
															if (isset($product_color) && $product_color!=null) echo '<tr><td style="background-color: #e1dfd6;">Color</td><td>'.$product_color.'</td></tr>';
															if (isset($product_shadename) && $product_shadename!=null) echo '<tr><td style="background-color: #e1dfd6;">Shade</td><td>'.$product_shadename.'</td></tr>';
															if (isset($product_formen_women) && $product_formen_women!=null){
																switch ($product_formen_women) {
																	case '1':
																		$formen_women = "WOMEN";
																		break;
																	case '2':
																		$formen_women = "MEN";
																		break;
																	default:
																		$formen_women = "UNISEX";
																		break;
																}
																echo '<tr><td style="background-color: #e1dfd6;">Gender</td><td>'.$formen_women.'</td></tr>';
															}
															if (isset($product_count) && $product_count!=0) echo '<tr><td style="background-color: #e1dfd6;">Count</td><td>'.$product_count.'</td></tr>';
															if (isset($product_hairskintypes) && $product_hairskintypes!=null) echo '<tr><td style="background-color: #e1dfd6;">Hair or skin type</td><td>'.$product_hairskintypes.'</td></tr>';
															if (isset($product_fragrancefor) && $product_fragrancefor!=null){
																switch ($product_fragrancefor) {
																	case '1':
																		$fragrancefor = "WOMEN";
																		break;
																	case '2':
																		$fragrancefor = "MEN";
																		break;
																	default:
																		$fragrancefor = "UNISEX";
																		break;
																}
																echo '<tr><td style="background-color: #e1dfd6;">For</td><td>'.$fragrancefor.'</td></tr>';
															}
															if (isset($product_scenttype) && $product_scenttype!=null) echo '<tr><td style="background-color: #e1dfd6;">Scent Type</td><td>'.$product_scenttype.'</td></tr>';
															if (isset($product_topnotes) && $product_topnotes!=null) echo '<tr><td style="background-color: #e1dfd6;">Top Notes</td><td>'.$product_topnotes.'</td></tr>';
															if (isset($product_packageinformation) && $product_packageinformation!=null) echo '<tr><td style="background-color: #e1dfd6;">Package information</td><td>'.$product_packageinformation.'</td></tr>';
															if (isset($product_manufacturer) && $product_manufacturer!=null) echo '<tr><td style="background-color: #e1dfd6;">Manufacturer</td><td>'.$product_manufacturer.'</td></tr>';
															if (isset($temperature) && $temperature!=0) echo '<tr><td style="background-color: #e1dfd6;">Temperature</td><td>'.$temperature.'</td></tr>';
															if (isset($humidity) && $humidity!=0) echo '<tr><td style="background-color: #e1dfd6;">Humidity</td><td>'.$humidity.'</td></tr>';
															if (isset($product_ingredients) && $product_ingredients!=NULL) echo '<tr><td style="background-color: #e1dfd6;">Ingredients</td><td>'.$product_ingredients.'</td></tr>';
															if (isset($product_highlights) && $product_highlights!=NULL) echo '<tr><td style="background-color: #e1dfd6;">Highlights</td><td>'.$product_highlights.'</td></tr>';
															?>
														</tbody>
													</table>
											</div>
										</div>
									</div>
								</div>
			</div>
			<div class="col-md-6">
				<div class="kt-portlet kt-portlet--tab white-bk" id="suppliers_map">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<a class="btn btn-warning btn-width-full kt-font-dark" onclick="demo4(0)">Show all suppliers</a>
						</div>
					</div>
					<div class="kt-portlet__body">
						<div id="kt_gmap_4" style="height:300px;">
						</div>
					</div>
				</div>
			</div>
		</div>
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<img class="kt-mr-5" src="<?php echo DIR_ROOT.DIR_ICON.'product-review.png'?>" alt="">
							<h3 class="kt-portlet__head-title">
								Add product review
							</h3>
						</div>
					</div>

					<!--begin::Form-->
					<form class="kt-form" id="jbform">
						<div class="kt-portlet__body">
							<div class="form-group">
								<label for="exampleTextarea" class="kt-m0">Your rating</label>
								<div class="star-rating">
									<input type="radio" id="5-stars" name="rating" value="5" <?php echo $disabled?>/>
									<label for="5-stars" class="star">&#9733;</label>
									<input type="radio" id="4-stars" name="rating" value="4" <?php echo $disabled?>/>
									<label for="4-stars" class="star">&#9733;</label>
									<input type="radio" id="3-stars" name="rating" value="3" <?php echo $disabled?>/>
									<label for="3-stars" class="star">&#9733;</label>
									<input type="radio" id="2-stars" name="rating" value="2" <?php echo $disabled?>/>
									<label for="2-stars" class="star">&#9733;</label>
									<input type="radio" id="1-star" name="rating" value="1" <?php echo $disabled?>/>
									<label for="1-star" class="star">&#9733;</label>
								</div>
							</div>
							<div class="form-group form-group-last">
								<label for="exampleTextarea">Your Review</label>
								<textarea class="form-control" id="description" name="description" rows="3" <?php echo $disabled?>></textarea>
							</div>
						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<button type="button" class="btn btn-warning" id="btn_review" <?php echo $disabled?>>Submit</button>
								<button type="reset" class="btn btn-secondary" <?php echo $disabled?>>Cancel</button>
							</div>
						</div>
					</form>
					<!--end::Form-->
				</div>
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Product Reviews
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<?php
				if ($reviews->product_reviews) {
					foreach ($reviews->product_reviews as $review) {
						if ($review->profile_pic!='') {
							$profile_pic = $review->profile_pic;
						}else {
							$profile_pic = "assets/media/users/default.jpg";
						}
						echo '<div class="kt-widget3"><div class="kt-widget3__item"><div class="kt-widget3__header">';
						echo '<div class="kt-widget3__user-img"><img class="kt-widget3__img" src="'.DIR_ROOT.$profile_pic. '" alt=""></div>';
						echo '<div class="kt-widget3__info">';
						echo '<a href="#" class="kt-widget3__username">' . $review->fullname . '</a><br>';
						echo '<span class="kt-widget3__time">' . $review->posted_date . '</span>';
						echo '</div>';
						echo '<span class="kt-widget3__status kt-font-info">';
						for ($i = 0; $i < $review->stars; $i++) {
							echo '<i class="fa fa-star"></i>';
						}
						echo '</span>';
						echo '</div>';
						echo '<div class="kt-widget3__body"><p class="kt-widget3__text">' . $review->description . '</p></div>';
						echo '</div></div>';
					}
				}else echo "No reviews yet!";
				?>
			</div>
		</div>
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">
						Description
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<?php echo $product_description;?>
			</div>
		</div>
	</div>
	<div class="col-md-3">
	<div id="other_sellers" class="kt-portlet kt-portlet--tabs">
		<div class="kt-portlet__head kt-p10">
			<div class="kt-portlet__head-label">
				<h6 class="kt-portlet__head-title kt-font-14">
					Other Sellers on JomlahBazar
				</h6>
			</div>
		</div>
		<div class="kt-portlet__body">
			<div class="kt-widget4">
				<?php
				foreach (array_slice($suppliers->suppliers,1) as $supplier) {
					$data_prc = '';

					if (strlen($supplier->companyname) > 30) $fullname = substr($supplier->companyname, 0, 27) . "...";
					else $fullname = $supplier->companyname;
					if ($supplier->range2!=0) {
						$prices = '<div class="kt-widget kt-widget--project-1"><div class="kt-widget__body"><div class="kt-widget__stats"><div class="kt-widget__item"><span class="kt-widget__date">Range</span><div class="kt-widget__label kt-label-size"><span class="btn btn-label-dark btn-sm  btn-upper btn-width-full"><b>' . $supplier->range1 . '</b></span></div><div class="kt-space-3"></div><div class="kt-widget__label"><span class="btn btn-label-dark btn-sm  btn-upper btn-width-full"><b>' . $supplier->range2 . '</b></span></div><div class="kt-space-3"></div></div><div class="kt-widget__item"><span class="kt-widget__date">Price (AED)</span><div class="kt-widget__label"><span class="btn btn-label-dark btn-sm  btn-upper btn-width-full">' . $supplier->price1 . '</span></div><div class="kt-space-3"></div><div class="kt-widget__label"><span class="btn btn-label-dark btn-sm  btn-upper btn-width-full">' . $supplier->price2 . '</span></div><div class="kt-space-3"></div></div></div></div></div>';
					}else {
						$prices = '<div class="kt-widget kt-widget--project-1"><div class="kt-widget__body"><div class="kt-widget__stats"><div class="kt-widget__item"><span class="kt-widget__date">Range</span><div class="kt-widget__label"><span class="btn btn-label-dark btn-sm  btn-upper btn-width-full"><b>' . $supplier->range1 . '</b></span></div><div class="kt-space-3"></div></div><div class="kt-widget__item"><span class="kt-widget__date">Price (AED)</span><div class="kt-widget__label"><span class="btn btn-label-dark btn-sm  btn-upper btn-width-full">' . $supplier->price1 . '</span></div><div class="kt-space-3"></div></div></div></div></div>';

					}
					$data_prc = "data-content='" . $prices . "'";
					echo '<div class="kt-widget4__item"><div class="kt-widget4__pic kt-widget4__pic--pic">';
					if ($supplier->profile_pic != null) echo '<img src="'.DIR_ROOT. $supplier->profile_pic . '" alt="image">';
					else echo '<img src="'.DIR_MED.'companies/default.jpg" alt="image">';
					echo '</div><div class="kt-widget4__info"><a href="' . DIR_VIEW . DIR_STR . 'storedetails.php?userId=' . $supplier->supplierId . '" class="kt-widget4__username">' . $fullname . '</a><span class="kt-font-raspberry kt-font-md">AED ' . $supplier->selling_price . '</span></div>';
					echo '<div class="kt-list-pics kt-list-pics--sm ">';
					echo '<a href="javascript:void(0)" class="btn btn-icon btn-circle btn-label-success" data-toggle="kt-popover" data-trigger="focus" title="" data-html="true" ' . $data_prc . ' data-original-title="" style="color:black; background-color: #d1f89d; width: 25px; height: 25px">{ }</a>';
					echo '<a href="javascript:void(0)" class="btn btn-icon btn-circle btn-label-danger" style="background-color:#EBB44D; width: 25px; height: 25px"><i class="fa fa-map-marker-alt" style="color:black" onclick="demo4('.$supplier->supplierId.')"></i></a>';
					echo '<a href="javascript:void(0)" class="btn btn-icon btn-circle btn-label-danger" style="background-color:#f8dd5a; width: 25px; height: 25px"><img src="assets/media/icons/cart_black.png" style="color:black; width: 21px;" onclick="addsellerToCart('.$supplier->supplierId.')"/></a>';
					echo '<div class="kt-space-3"></div>' ?>
			</div>
		</div>
	<?php }

	?>
	<form method="POST" id="ocartform" action="<?php echo DIR_VIEW . DIR_CAR ?>cart-post.php">
		<input type="hidden" name="pid" id="opid">
		<input type="hidden" name="pname" id="opname">
		<input type="hidden" name="pp" id="opp">
		<input type="hidden" name="osid" id="osid">
		<input type="hidden" name="pqty" id="opqty">
	</form>
	<script>
		function addToCart1(opid, opname, opp, osid) {
			$('#opid').val(opid);
			$('#opname').val(opname);
			$('#opp').val(opp);
			$('#osid').val(osid);
			$('#opqty').val(opqty);
			$('#opqty').val($('#quantity').val());
			$('#ocartform').submit();
		}
		function addsellerToCart(sid){
			$('#sid').val(sid);
			addToCart()
		}
	</script>
	</div>
</div>
<img src="assets/media/bg/happy-family.jpeg" width="200px">
</div>
</div>
</div>
</div>
<!--End::Dashboard 3-->
</div>
<!-- end:: Content -->
</div>
</div>
</div>

<!--end:: Widgets/New Users-->
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
<script type="text/javascript" src="assets/plugins/magnifier/Event.js"></script>
<script type="text/javascript" src="assets/plugins/magnifier/Magnifier.js"></script>
<script type="text/javascript">
var evt = new Event(),
    m = new Magnifier(evt);
</script>
<script type="text/javascript">
$(document).ready(function() {
	totalprice();
  var pro_img = $("#pro_img");
  var thumbs = $("#thumbs");
  var syncedSecondary = true;
  pro_img
    .owlCarousel({
		items:1,
    slideSpeed: 2000,
    nav: false,
    autoplay: false,
    loop: true,
    responsiveRefreshRate: 200,
		responsive:{
				0:{
						items:1,
						dots: true
				},
				600:{
						items:1,
						dots: true
				},
				1000:{
						items:1,
						dots: false
				}
		},
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    nav: false,
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 4,
    responsiveRefreshRate: 100,
		responsive:{
				0:{
						items:1,
						dots: true
				},
				600:{
						items:1,
						dots: true
				},
				1000:{
						items:10,
						loop:false
				}
		}
  })
    .on("changed.owl.carousel", syncPosition2);
		$('.slidernav').on('mouseover',function(e){
		    $(this).click();
		})
  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    console.log(onscreen)
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();
    console.log(end);
    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      pro_img.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    pro_img.data("owl.carousel").to(number, 300, true);
  });
});
</script>
<script>
	var demo4 = function(supplierId) {
		var map = new GMaps({
			div: '#kt_gmap_4',
			lat: 24.7563957,
			lng: 55.2597173,
		});
		var username = "";
		var url = DIR_CONT+DIR_PRO+"CON_productsuppliers.php?action=getloc&productId=<?php echo $productId; ?>&userId=" + supplierId;
		$.get(url, function(data, status) {
			var loc = JSON.parse(data);
			var location = loc['location'];
			if (supplierId != 0) {
				username = location[0]['companyname'];
				map.addMarker({
					lat: location[0]['latitude'],
					lng: location[0]['longitude'],
					title: location[0]['companyname'],
					infoWindow: {
						content: '<span style="color:#000">' + username + '</span>'
					}
				});
			} else {
				location.forEach((item, i) => {
					username = item['companyname'];
					map.addMarker({
						lat: item['latitude'],
						lng: item['longitude'],
						title: item['companyname'],
						infoWindow: {
							content: '<span style="color:#000">' + username + '</span>'
						}
					});
				});
			}
		});
		map.setZoom(7);
		if (supplierId != 0) location.hash = '#suppliers_map';
	}
	$(document).ready(function() {
		demo4(0);
	});
	$("#quantity").change(function() {
		totalprice()
	});

	function totalprice() {
		var p1 = $("#p1").val();
		var p2 = $("#p2").val();
		var r1 = $("#r1").val();
		var r2 = $("#r2").val();
		var qty = $("#quantity").val();
		var mtpy = p1;
		if (r2!=0) {
			if (qty >= parseInt(r1) && qty < parseInt(r2)) {
				mtpy = p1;
			} else if (qty >= parseInt(r2)) {
				mtpy = p2;
			}
		}else {
			mtpy = p1;
		}

		var total = qty * mtpy;
		var rounded_total=Math.round((total + Number.EPSILON) * 100) / 100
		$("#total_price").html("AED " + rounded_total);
		$("#unit_price").val(mtpy);
	}
	$('#btn_review').click(function(e) {
		e.preventDefault();
		var btn = $(this);
		var form = $(this).closest('form');
		var formdata1 = new FormData($('#jbform')[0]);
		form.validate({
			rules: {
				ranking: {
					required: true
				}
			}
		});

		if (!form.valid()) {
			return;
		}
		btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
		$.ajax({
			type: "POST",
			url: DIR_CONT+DIR_PRO+"CON_Reviews.php?action=post&productId=<?php echo $productId ?>&userId=<?php echo $userId?>",
			cache: false,
			contentType: false,
			processData: false,
			data: formdata1,
			dataType: "json",
			success: function(data) {
				switch (data['err']) {
					case 0:
						//similate 2s delay
						setTimeout(function() {
							btn.removeClass(
								'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
							).attr('disabled', false);
							//Simulate an HTTP redirect:
							window.location.reload();
						}, 2000);
						break;
					case 1:
						// similate 2s delay
						setTimeout(function() {
							btn.removeClass(
								'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
							).attr('disabled', false);
							showErrorMsg(form, 'danger',
								'Incorrect username or password. Please try again.');
						}, 2000);
						break;
					case 2:
						// similate 2s delay
						setTimeout(function() {
							btn.removeClass(
								'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
							).attr('disabled', false);
							showErrorMsg(form, 'danger',
								'Missing required parameters. Please try again.');
						}, 2000);
						break;
					default:
				}
			}
		});
	});
	var $temp = $("<input>");
var $url = $(location).attr('href');

$('.clipboard').on('click', function() {
  $("body").append($temp);
  $temp.val($url).select();
  document.execCommand("copy");
  $temp.remove();
  $("#confirm-copy").text("URL copied!");
	setTimeout(function(){ $("#confirm-copy").text(""); }, 3000);
});
$('#quantity').on('change', function() {
	var range1 = $('#range1').val();
	var quantity_val = $('#quantity').val();
	var totalqty = range1*quantity_val;
	const element1 = document.querySelector('#total_price');
	element1.style.setProperty('--animate-duration', '1s');
  animateCSS('#total_price', 'fadeInUp');
});
function negotiate(productId,sellerId,price) {
	var buyerId = <?php echo $userId?>;
	if (sellerId==buyerId) {
		swal.fire({
			title: 'You can not buy your own products!',
			timer: 2000,
			onOpen: function() {
				swal.showLoading()
			}
		})
	}else {
		var usertype = <?php if($_SESSION['Login_as']) echo $_SESSION['Login_as'];else echo "0";?>;
		if (usertype==2) {
			swal.fire({
				title: 'To complete this action you will be using your buyer account!',
				text: "Do you want to switch to buyer?",
				type: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, switch account!'
			}).then(function(result) {
				if (result.value) {
					$.ajax({
						url: DIR_CONT+DIR_USR+"CON_user_access.php?action=switch-buyer",
						context: document.body
					}).done(function() {
						location.href="view/orders/quotation.php?productId="+productId+"&sellerId="+sellerId+"&price="+price;
					});
				}
			});
		}else {
			location.href="view/orders/quotation.php?productId="+productId+"&sellerId="+sellerId+"&price="+price;
		}
	}
}

</script>
