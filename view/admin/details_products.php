<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
include("../" . DIR_CON . "header_admin.php");
if (isset($_GET['productId'])) $productId = $_GET['productId'];
else {
	$productId = 0;
}
/*get product general info*/
$res_pro = $client->request('GET', DIR_CONT . DIR_ADMN . 'CON_products.php?action=get&productId=' . $productId);
$product = json_decode($res_pro->getBody());
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
$product_categoryname = $product->products->category_name;
$product_detailstype = $product->products->detailstype;
$product_totalquantity = $product->productqty->totalquantity;
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
		$product_weight = $product->productdetails->weight;
		$product_ingredients = $product->productdetails->ingredients;
		$product_shadename = $product->productdetails->shadename;
		$product_highlights = $product->productdetails->highlights;
		break;
	case 3:
		$product_size = $product->productdetails->size;
		$product_weight = $product->productdetails->weight;
		$product_ingredients = $product->productdetails->ingredients;
		$product_highlights = $product->productdetails->highlights;
		$product_shippingweight = $product->productdetails->shippingweight;
		$product_packageinformation = $product->productdetails->packageinformation;
		$product_countyoforigin = $product->productdetails->countyoforigin;
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
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
	<div class="row">
		<div class="col-md-9">
			<div class="kt-portlet white-bk">
				<div class="kt-portlet__body">
					<div class="kt-widget kt-widget--user-profile-3">
						<div class="kt-widget__top">
							<div class="owl-carousel owl-theme owl-one" style="width:300px;">
								<?php
								foreach ($product->productpics as $pic) {
									$dot = "<button class='kt-hidden'><i></i><img src='" . $pic->path . "' alt='' class='img-fluid'/></button>";
									echo '<div class="item" data-dot="' . $dot . '"> <img src="' . $pic->path . '" style="width: 300px;"> </div>';
								}
								?>
							</div>
							<div class="kt-widget__content">
								<div class="kt-widget__head">
									<h2 class="kt-font-dark"><?php echo $product_name; ?></h2>
								</div>

								<div class="kt-font-dark">
									By
									<a href="<?php echo DIR_VIEW.DIR_PRO.'marketplace.php?brnd='.$product_brandId;?>" class="kt-link kt-link--brand kt-font-bolder kt-font-lg" style="color:#213fd7">
										<?php echo $product_brandname; ?>
									</a>
								</div>
								<div class="kt-list-pics kt-list-pics--sm kt-widget19__title"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i></div>
								<?php echo '<span class="product_description_text kt-font-dark">' . $product_description . '</span>'; ?>
								<hr>
								<div class="row">
									<div class="col-md-8">
										<span class="kt-hidden">See on</span>
										<a class="kt-hidden" href="https://www.amazon.com/dp/<?php echo $product_asin; ?>" target="_blank">
											<img src="https://cdn4.iconfinder.com/data/icons/iconsimple-logotypes/512/amazon-64.png" width="20px">
										</a><br>
										<span class="kt-font-dark">All prices exclude VAT.</span>
										<div class="kt-widget__info">
											<div class="kt-widget__desc">
												<?php
												echo 'Brand: <span class="product_description_text kt-font-dark">' . $product_brandname . '</span><br>';
												echo 'Category: <span class="product_description_text kt-font-dark">' . $product_categoryname . '</span><br>';
												if (isset($product_size)) echo 'Size: <span class="product_description_text kt-font-dark">' . $product_size . '</span><br>';
												if (isset($product_setdescription)) echo 'Set description: <span class="product_description_text kt-font-dark">' . $product_setdescription . '</span><br>';
												if (isset($product_color)) echo 'Color: <span class="product_description_text kt-font-dark"' . $product_color . '</span><br>';
												if (isset($product_weight)) echo 'Weight: <span class="product_description_text kt-font-dark">' . $product_weight . '</span><br>';
												if (isset($product_shadename)) echo 'Shade: <span class="product_description_text kt-font-dark">' . $product_shadename . '</span><br>';
												if (isset($product_formen_women)) echo 'Gender: <span class="product_description_text kt-font-dark">' . $product_formen_women . '</span><br>';
												if (isset($product_count)) echo 'Count: <span class="product_description_text kt-font-dark">' . $product_count . '</span><br>';
												if (isset($product_hairskintypes)) echo 'Hair or skin type: <span class="product_description_text kt-font-dark">' . $product_hairskintypes . '</span><br>';
												if (isset($product_fragrancefor)) echo 'For: <span class="product_description_text kt-font-dark">' . $product_fragrancefor . '</span><br>';
												if (isset($product_scenttype)) echo 'Scent type: <span class=" product_description_text kt-font-dark">' . $product_scenttype . '</span><br>';
												if (isset($product_topnotes)) echo 'Top notes: <span class="product_description_text kt-font-dark">' . $product_topnotes . '</span><br>';

												if (isset($product_shippingweight)) echo 'Shipping Weight: <span class="product_description_text kt-font-dark">' . $product_shippingweight . '</span><br>';
												if (isset($product_packageinformation)) echo 'Package information: <span class="product_description_text kt-font-dark">' . $product_packageinformation . '</span><br>';
												if (isset($product_countyoforigin)) echo 'County of origin: <span class="product_description_text kt-font-dark">' . $product_countyoforigin . '</span><br>';
												if (isset($product_manufacturer)) echo 'Manufacturer: <span class="product_description_text kt-font-dark">' . $product_manufacturer . '</span><br>';
												?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php
											if (isset($product_ingredients)) echo 'Ingredients: <span class="product_description_text kt-font-dark">' . $product_ingredients . '</span><br>';
											if (isset($product_highlights)) echo 'Highlights: <span class="product_description_text kt-font-dark">' . $product_highlights . '</span><br>';
										?>
									</div>
								</div>
								<div class="kt-space-3"></div>
							</div>
						</div>
					</div>
				</div>
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
					if ($product->product_reviews) {
						foreach ($product->product_reviews as $review) {
							echo '<div class="kt-widget3"><div class="kt-widget3__item"><div class="kt-widget3__header">';
							echo '<div class="kt-widget3__user-img"><img class="kt-widget3__img" src="'.DIR_ROOT.$review->profile_pic . '" alt=""></div>';
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
			<div class="kt-portlet">
				<div class="kt-portlet__head">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">
							Product Suppliers
						</h3>
					</div>
				</div>
				<div class="kt-portlet__body">

					<!--begin::Section-->
					<div class="kt-section">
						<div class="kt-section__content">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Box Quantity</th>
										<th>Unit Price</th>
										<th>Range 1</th>
										<th>Price 1</th>
										<th>Range 2</th>
										<th>Price 2</th>
										<th>Range 3</th>
										<th>Price 3</th>
										<th>Production Date</th>
										<th>Expiry Date</th>
										<th>Temperature</th>
										<th>Humidity</th>
										<th>origin</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if ($product->suppliers) {
											foreach ($product->suppliers as $supplier) {
												echo '<tr>';
												echo '<th scope="row">'.$supplier->supplierproductId.'</th>';
												echo '<th scope="row">'.$supplier->fullname.'</th>';
												echo '<td>'.$supplier->boxquantity.'</td>';
												echo '<td>'.$supplier->quantity.'</td>';
												echo '<td>'.$supplier->unitprice.'</td>';
												echo '<td>'.$supplier->range1.'</td>';
												echo '<td>'.$supplier->price1.'</td>';
												echo '<td>'.$supplier->range2.'</td>';
												echo '<td>'.$supplier->price2.'</td>';
												echo '<td>'.$supplier->range3.'</td>';
												echo '<td>'.$supplier->price2.'</td>';
												echo '<td>'.$supplier->production_date.'</td>';
												echo '<td>'.$supplier->exp_date.'</td>';
												echo '<td>'.$supplier->temperature.'</td>';
												echo '<td>'.$supplier->humidity.'</td>';
												echo '<td>'.$supplier->origin.'</td>';
												echo '</tr>';
											}
										}else{
											echo '<tr><td>No address</td></tr>';
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<!--end::Section-->
				</div>
			</div>
		</div>
		<!--end::Portlet-->
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
include("../" . DIR_CON . "footer.php");
?>
<script>
	$(document).ready(function() {
		$(".owl-one").owlCarousel({
			items: 1,
			margin: 65,
			dotsData: true,
		});
		$('.owl-dot').click(function() {
			$(".owl-one").trigger('to.owl.carousel', [$(this).index(), 300]);
		});
		demo4(0);
	});
</script>
