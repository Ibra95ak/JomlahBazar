<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('session.cookie_secure', 'On');
ini_set('session.cookie_httponly', 1 );
session_start();
require_once 'model/Base.php';/*fetch Directory variables*/
require_once 'vendor/autoload.php';
$client = new GuzzleHttp\Client();
if (isset($_SESSION['userId'])) {
	$res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
	$usr = json_decode($res_uid->getBody());
	switch ($_SESSION['Login_as']) {
		case 1:
			include(DIR_VW . DIR_CON . "header_buyer-index.php");
			break;
		case 2:
			include(DIR_VW . DIR_CON . "header_supplier-index.php");
			break;
		default:
			include(DIR_VW . DIR_CON . "header_buyer-index.php");
			break;
	}
	$current_location = 'lb';
} else {
	$res_ip = $client->request('GET', DIR_CONT . DIR_USR . 'CON_user_IPlocation.php');/*fetch userId*/
	$ip_info = json_decode($res_ip->getBody());
	$current_location=$ip_info->countryCode;
	$current_location = 'GB';
	include(DIR_VW . DIR_CON . "guestheader-index.php");
}/*Get page header*/
$res_cat = $client->request('GET',DIR_CONT.DIR_CAT.'CON_categories.php?action=get-mcat-cat');/*fetch all categories*/
$categories = json_decode($res_cat->getBody());
/*Fetch EID products through API*/
// $res_eid = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_EidProducts.php');
// $eid_products = json_decode($res_eid->getBody());
/*Fetch latest products through API*/
$res_lp = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_LatestProducts.php');
$latest_products = json_decode($res_lp->getBody());
/*Fetch limited offer products through API*/
$res_bs = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_BestSellerProducts.php');
$bestseller_products = json_decode($res_bs->getBody());
/*Fetch featured products through API*/
$res_fp = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_FeaturedProducts.php');
$limitedoffer_products = json_decode($res_fp->getBody());
/*Fetch featured products through API*/
$res_99 = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_Lessthan99Products.php');
$less99_products = json_decode($res_99->getBody());
/*Fetch country states*/
$res_cs = $client->request('GET', DIR_CONT . DIR_ADRS . 'CON_locationsDropdown.php?action=getstates&iso=' . $current_location);
$states = json_decode($res_cs->getBody());
$res_events_demands = $client->request('GET', DIR_CONT . DIR_USR . 'CON_index.php?action=get');
$events_demands = json_decode($res_events_demands->getBody());
$totalquantity=0;
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
	<!--begin:: Widgets/Activity-->
	<div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid">
		<div class="kt-portlet__body kt-portlet__body--fit">
			<div class="kt-widget17">
				<div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides">
					<div class="kt-widget17__chart slider-height">
						<div class="owl-carousel owl-carousel1 owl-theme" style="z-index: 0;">
							<div class="item">
								<picture>
									<source media="(max-width:650px)" srcset="assets/media/sliders/Jomlahbazar-wholsale-emarket-summer-slider.webp">
								  <img src="assets/media/sliders/Jomlahbazar-wholsale-emarket-summer-slider.webp" class="top-slider" alt="New and trending in beauty and perfume">
								</picture>
							</div>
							<div class="item">
								<picture>
									<source media="(max-width:650px)" srcset="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-perfume-phone.webp">
								  <img src="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-perfume.webp" class="top-slider" alt="New and trending in beauty and perfume">
								</picture>
							</div>
							<div class="item">
								<picture>
									<source media="(max-width:650px)" srcset="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-bazar-phone.webp">
								  <img src="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-bazar.webp" class="top-slider" alt="Great selection and lowest prices">
								</picture>
							</div>
							<div class="item">
								<picture>
									<source media="(max-width:650px)" srcset="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-cosmetics-phone.webp">
								  <img src="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-cosmetics.webp" class="top-slider" alt="Cosmetic and skin care wholesale prices">
								</picture>
							</div>
							<div class="item">
								<picture>
									<source media="(max-width:650px)" srcset="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-food-phone.webp">
									<img src="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-food.webp" class="top-slider" alt="wholesale food and beverages">
								</picture>
							</div>
							<div class="item">
								<picture>
									<source media="(max-width:650px)" srcset="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-products-phone.webp">
								  <img src="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-products.webp" class="top-slider" alt="wholesale products">
								</picture>
							</div>
							<div class="item">
								<picture>
									<source media="(max-width:650px)" srcset="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-makeup-phone.webp">
									<img src="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-makeup.webp" class="top-slider" alt="wholesale makeup">
								</picture>
							</div>
							<div class="item">
								<picture>
									<source media="(max-width:650px)" srcset="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-haircare-phone.webp">
								  <img src="assets/media/sliders/supplychain-jomlahbazar-emarket-wholesale-expo2020-slider-haircare.webp" class="top-slider" alt="Hair care wholesale">
								</picture>
							</div>
						</div>
					</div>
				</div>
				<div class="row safari-row">
					<div class="col-md-3">
						<div class="kt-widget17__stats">
							<div class="kt-widget17__items">
								<a href="<?php echo DIR_VIEW . DIR_CAT . 'categories.php?maincategoryId=1' ?>" class="kt-link kt-font-bolder kt-m0 kt-font-light">
								<div class="kt-widget17__item /*kt-transparent-70 kt-p10*/ kt-pt5 kt-pr0 kt-pl0 kt-pb-0 rounded shadow box-purple">
									<h2 class="kt-font-light text-center kt-font-bolder"><?php echo $main_categories[0]->name;?></h2>
									<div class="row kt-align-center">
											<span class="kt-widget17__icon"><img src="assets/media/categories/supplychain-jomlahbazar-emarket-wholesale-expo2020-main-category-image-grocery.webp" alt="" class="btn-width-full"></span>
								</div>
								</div>
							</a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="kt-widget17__stats">
							<div class="kt-widget17__items">
								<a href="<?php echo DIR_VIEW . DIR_CAT . 'categories.php?maincategoryId=2' ?>" class="kt-link kt-font-bolder kt-m0 kt-font-light">
								<div class="kt-widget17__item /*kt-transparent-70 kt-p10*/ kt-pt5 kt-pr0 kt-pl0 kt-pb-0 rounded shadow box-red">
									<h2 class="kt-font-light text-center kt-font-bolder"><?php echo $main_categories[1]->name;?></h2>
									<div class="row kt-align-center">
											<span class="kt-widget17__icon"><img src="assets/media/categories/supplychain-jomlahbazar-emarket-wholesale-expo2020-main-category-image-perfume.webp" alt="" class="btn-width-full"></span>
								</div>
								</div>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="kt-widget17__stats">
							<div class="kt-widget17__items">
								<a href="<?php echo DIR_VIEW . DIR_CAT . 'categories.php?maincategoryId=3' ?>" class="kt-link kt-font-bolder kt-m0 kt-font-light">
								<div class="kt-widget17__item /*kt-transparent-70 kt-p10*/ kt-pt5 kt-pr0 kt-pl0 kt-pb-0 rounded shadow box-yellow">
									<h2 class="kt-font-light text-center kt-font-bolder"><?php echo $main_categories[2]->name;?></h2>
									<div class="row kt-align-center">
											<span class="kt-widget17__icon"><img src="assets/media/categories/supplychain-jomlahbazar-emarket-wholesale-expo2020-main-category-image-beauty-make-up.webp" alt="" class="btn-width-full"></span>
								</div>
								</div>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="kt-widget17__stats">
							<div class="kt-widget17__items">
								<a href="<?php echo DIR_VIEW . DIR_CAT . 'categories.php?maincategoryId=4' ?>" class="kt-link kt-font-bolder kt-m0 kt-font-light">
								<div class="kt-widget17__item /*kt-transparent-70 kt-p10*/ kt-pt5 kt-pr0 kt-pl0 kt-pb-0 rounded shadow box-orange">
									<h2 class="kt-font-light text-center kt-font-bolder"><?php echo $main_categories[3]->name;?></h2>
									<div class="row kt-align-center">
											<span class="kt-widget17__icon"><img src="assets/media/categories/supplychain-jomlahbazar-emarket-wholesale-expo2020-main-category-image-personal-care.webp" alt="" class="btn-width-full"></span>
								</div>
								</div>
								</a>
							</div>
						</div>
					</div>
					<!-- <div class="col-md-3 max-width-20 max-width-100">
						<div class="kt-widget17__stats">
							<div class="kt-widget17__items">
								<a href="<?php //echo DIR_VIEW.DIR_PRO.'marketplace.php?gf=1';?>" class="kt-link kt-font-bolder kt-m0 kt-font-light">
								<div class="kt-widget17__item /*kt-transparent-70 kt-p10*/ kt-pt5 kt-pr0 kt-pl0 kt-pb-0 rounded shadow box-blue">
									<h2 class="kt-font-light text-center kt-font-bolder">EID Gifts</h2>
									<div class="row kt-align-center">
											<span class="kt-widget17__icon"><img src="assets/media/icons/shop.png" alt="" class="btn-width-full"></span>
								</div>
								</div>
								</a>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>

	<!--end:: Widgets/Activity-->
	<hr>
	<!-- <div class="row kt-mt-50">
		<h2 class="kt-font-md kt-font-bolder">EID Sale Products <span class="kt-font-14"><a href="<?php //echo DIR_VIEW.DIR_PRO."marketplace.php?eid=1" ; ?>" class="kt-link kt-font-bolder">View All</a><span></h2>
	</div>
	<div class="row">
		<div class="owl-carousel owl-carousel3 owl-theme" style="z-index: 0;">
			<?php
			/*
			foreach ($eid_products as $eid_product) {
				echo '<a href="'.DIR_ROOT.DIR_VW.DIR_PRO.'productdetails.php?productId='.$eid_product->productId.'" class="kt-widget19__username"><div class="item"><div class="kt-portlet kt-portlet--height-fluid kt-widget19 rounded"><div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill"><div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides kt-ribbon kt-ribbon--shadow kt-ribbon--right kt-ribbon--warning" style="min-height: 100px; background-image: url(' . $eid_product->path . ');min-height: 150px;background-size: contain;background-position: center;"><div class="kt-widget19__shadow-"></div><div class="kt-widget19__labels-brand" style="margin-bottom: -4px;"><img src="'.DIR_ICON.'ramadanlimitedtimeoffer.png" width="100" style="width: 100px;"/></div>';
				if ($eid_product->min_discount<$eid_product->min_price && $eid_product->min_discount!=0) {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 20px; right: -2px;text-align: right;background-color: #e1dfd6;"><h3 class="kt-m0"><s>AED '.number_format($eid_product->min_price,2).'</s></h3></div>';
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.$eid_product->min_discount.'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }else {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.number_format($eid_product->min_price,2).'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }
				echo '</div></div>';
				if (strlen($eid_product->name)>45) $pro_name = substr($eid_product->name,0,42)."...";
				else $pro_name = $eid_product->name;
				echo '<div class="kt-portlet__body height-55"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">
  <div class="kt-widget19__info">' . $pro_name . '</div>
  </div></div></div></div></div></a>';
}*/
			?>
		</div>
	</div> -->
	<div class="row">
		<h2 class="kt-font-md kt-font-bolder">Latest Products <span class="kt-font-14"><a href="<?php echo DIR_VIEW.DIR_PRO."marketplace.php?lp=1" ; ?>" class="kt-link kt-font-bolder">View All</a><span></h2>
	</div>
	<div class="row">
		<div class="owl-carousel owl-carousel3 owl-theme" style="z-index: 0;">
			<?php
			foreach ($latest_products as $latest_product) {
				echo '<a href="'.DIR_ROOT.DIR_VW.DIR_PRO.'productdetails.php?productId='.$latest_product->productId.'" class="kt-widget19__username"><div class="item"><div class="kt-portlet kt-portlet--height-fluid kt-widget19 rounded"><div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill"><div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides kt-ribbon kt-ribbon--shadow kt-ribbon--right kt-ribbon--warning" style="min-height: 100px; background-image: url(' . $latest_product->path . ');min-height: 150px;background-size: contain;background-position: center;">';
				if ($latest_product->min_discount<$latest_product->min_price && $latest_product->min_discount!=0) {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 20px; right: -2px;text-align: right;background-color: #e1dfd6;"><h3 class="kt-m0"><s>AED '.number_format($latest_product->min_price,2).'</s></h3></div>';
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.$latest_product->min_discount.'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }else {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.number_format($latest_product->min_price,2).'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }
				echo '</div></div>';
				if (strlen($latest_product->name)>45) $pro_name = substr($latest_product->name,0,42)."...";
				else $pro_name = $latest_product->name;
				echo '<div class="kt-portlet__body height-55"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">
  <div class="kt-widget19__info">' . $pro_name . '</div>
  </div></div></div></div></div></a>';
			}
			?>
		</div>
	</div>
	<div class="row">
		<h2 class="kt-font-md kt-font-bolder">Best Seller Products <span class="kt-font-14"><a href="<?php echo DIR_VIEW.DIR_PRO."marketplace.php?bs=1";?>" class="kt-link kt-font-bolder">View All</a><span></h2>
		</div>
		<div class="row">
		<div class="owl-carousel owl-carousel3 owl-theme" style="z-index: 0;">
			<?php
			foreach ($bestseller_products as $bestseller_product) {
				echo '<a href="'.DIR_ROOT.DIR_VW.DIR_PRO.'productdetails.php?productId='.$bestseller_product->productId.'" class="kt-widget19__username"><div class="item"><div class="kt-portlet kt-portlet--height-fluid kt-widget19 rounded"><div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill"><div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides kt-ribbon kt-ribbon--shadow kt-ribbon--right kt-ribbon--warning" style="min-height: 100px; background-image: url(' . $bestseller_product->path . ');min-height: 150px;background-size: contain;background-position: center;"><div class="kt-widget19__labels-brand" style="margin-bottom: -4px;"><img src="'.DIR_ICON.'bestseller.webp" width="100" style="width: 100px;"/></div>';
				if ($bestseller_product->min_discount<$bestseller_product->min_price && $bestseller_product->min_discount!=0) {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 20px; right: -2px;text-align: right;background-color: #e1dfd6;"><h3 class="kt-m0"><s>AED '.number_format($bestseller_product->min_price,2).'</s></h3></div>';
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.$bestseller_product->min_discount.'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }else {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.number_format($bestseller_product->min_price,2).'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }
				echo '</div></div>';
				if (strlen($bestseller_product->name)>45) $pro_name = substr($bestseller_product->name,0,42)."...";
				else $pro_name = $bestseller_product->name;
				echo '<div class="kt-portlet__body height-55"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">
  <div class="kt-widget19__info">' . $pro_name . '</div>
  </div></div></div></div></div></a>';
			}
			?>
		</div>
	</div>
	<div class="row">
		<h2 class="kt-font-md kt-font-bolder">Limited Offer Products <span class="kt-font-14"><a href="<?php echo DIR_VIEW.DIR_PRO."marketplace.php?ft=1";?>" class="kt-link kt-font-bolder">View All</a><span></h2>
		</div>
		<div class="row">
			<div class="owl-carousel owl-carousel3 owl-theme" style="z-index: 0;">
			<?php
			foreach ($limitedoffer_products as $limitedoffer_product) {
				echo '<a href="'.DIR_ROOT.DIR_VW.DIR_PRO.'productdetails.php?productId='.$limitedoffer_product->productId.'" class="kt-widget19__username"><div class="item"><div class="kt-portlet kt-portlet--height-fluid kt-widget19 rounded"><div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill"><div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides kt-ribbon kt-ribbon--shadow kt-ribbon--right kt-ribbon--warning" style="min-height: 100px; background-image: url(' . $limitedoffer_product->path . ');min-height: 150px;background-size: contain;background-position: center;"><div class="kt-widget19__labels-warning" style="margin-bottom: -4px;"><img src="'.DIR_ICON.'featured.webp" width="100" style="width: 100px;"/></div>';
				if ($limitedoffer_product->min_discount<$limitedoffer_product->min_price && $limitedoffer_product->min_discount!=0) {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 20px; right: -2px;text-align: right;background-color: #e1dfd6;"><h3 class="kt-m0"><s>AED '.number_format($limitedoffer_product->min_price,2).'</s></h3></div>';
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.$limitedoffer_product->min_discount.'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }else {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.number_format($limitedoffer_product->min_price,2).'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }
				echo '</div></div>';
				if (strlen($limitedoffer_product->name)>45) $pro_name = substr($limitedoffer_product->name,0,42)."...";
				else $pro_name = $limitedoffer_product->name;
				echo '<div class="kt-portlet__body height-55"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">
  <div class="kt-widget19__info">' . $pro_name . '</div>
  </div></div></div></div></div></a>';
			}
			?>
		</div>
	</div>
	<div class="row">
		<h2 class="kt-font-md kt-font-bolder">Less than 99 AED Products <span class="kt-font-14"><a href="<?php echo DIR_VIEW.DIR_PRO."marketplace.php?maxp=99";?>" class="kt-link kt-font-bolder">View All</a><span></h2>
		</div>
		<div class="row">
			<div class="owl-carousel owl-carousel3 owl-theme" style="z-index: 0;">
			<?php
			foreach ($less99_products as $less99_product) {
				echo '<a href="'.DIR_ROOT.DIR_VW.DIR_PRO.'productdetails.php?productId='.$less99_product->productId.'" class="kt-widget19__username"><div class="item"><div class="kt-portlet kt-portlet--height-fluid kt-widget19 rounded"><div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill"><div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides kt-ribbon kt-ribbon--shadow kt-ribbon--right kt-ribbon--warning" style="min-height: 100px; background-image: url(' . $less99_product->path . ');min-height: 150px;background-size: contain;background-position: center;">';
				if ($less99_product->min_discount<$less99_product->min_price && $less99_product->min_discount!=0) {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 20px; right: -2px;text-align: right;background-color: #e1dfd6;"><h3 class="kt-m0"><s>AED '.number_format($less99_product->min_price,2).'</s></h3></div>';
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.$less99_product->min_discount.'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }else {
	        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.number_format($less99_product->min_price,2).'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
	      }
				echo '</div></div>';
				if (strlen($less99_product->name)>45) $pro_name = substr($less99_product->name,0,42)."...";
				else $pro_name = $less99_product->name;
				echo '<div class="kt-portlet__body height-55"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">
  <div class="kt-widget19__info">' . $pro_name . '</div>
  </div></div></div></div></div></a>';
			}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12" style="text-align:center;">
			<div class="owl-carousel owl-carousel4 owl-theme" style="z-index: 0;">
				<div class="item"><a href="<?php echo DIR_VW.DIR_USR."dt_users.php";?>"><img src="assets/media/ads/supplychain-jomlahbazar-emarket-wholesale-expo2020-ad-1.webp" alt="" style="width:100%;height:300px;margin-bottom: 0px;" class="rounded" title="Business World"></a></div>
				<div class="item"><a href="<?php echo DIR_VW.DIR_USR."dt_users.php";?>"><img src="assets/media/ads/supplychain-jomlahbazar-emarket-wholesale-expo2020-ad-2.webp" alt="" style="width:100%;height:300px;margin-bottom: 0px;" class="rounded" title="Business World"></a></div>
				<div class="item"><a href="<?php echo DIR_VW.DIR_USR."dt_users.php";?>"><img src="assets/media/ads/supplychain-jomlahbazar-emarket-wholesale-expo2020-ad-3.webp" alt="" style="width:100%;height:300px;margin-bottom: 0px;" class="rounded" title="Business World"></a></div>
				<div class="item"><a href="<?php echo DIR_VW.DIR_USR."dt_users.php";?>"><img src="assets/media/ads/supplychain-jomlahbazar-emarket-wholesale-expo2020-ad-4.webp" alt="" style="width:100%;height:300px;margin-bottom: 0px;" class="rounded" title="Business World"></a></div>
				<div class="item"><a href="<?php echo DIR_VW.DIR_USR."dt_users.php";?>"><img src="assets/media/ads/supplychain-jomlahbazar-emarket-wholesale-expo2020-ad-5.webp" alt="" style="width:100%;height:300px;margin-bottom: 0px;" class="rounded" title="Business World"></a></div>
				<div class="item"><a href="<?php echo DIR_VW.DIR_USR."dt_users.php";?>"><img src="assets/media/ads/supplychain-jomlahbazar-emarket-wholesale-expo2020-ad-6.webp" alt="" style="width:100%;height:300px;margin-bottom: 0px;" class="rounded" title="Business World"></a></div>
			</div>
		</div>
	</div>
	<!-- Modal -->
							<div class="modal fade" id="kt_modal_seller" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Seller Profile</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											</button>
										</div>
										<div class="modal-body">
											<p>Please complete your seller profile to get access to more features.</p>
											<p class="text-center">
												<button id="btn-cmp" type="button" class="btn btn-outline-warning kt-mb-5 btn-width-full" onclick="location.href='<?php echo DIR_VIEW.DIR_USR?>form_userstore.php'"> Company Profile</button><br>
												<button id="btn-adrs" type="button" class="btn btn-outline-warning kt-mb-5 btn-width-full" onclick="location.href='<?php echo DIR_VIEW.DIR_USR?>form_useraddress.php'"> Addresses</button><br>
												<button id="btn-ro" type="button" class="btn btn-outline-warning kt-mb-5 btn-width-full" onclick="location.href='<?php echo DIR_VIEW.DIR_USR?>form_user.php'"> Reachouts</button><br>
											</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">SKIP</button>
										</div>
									</div>
								</div>
							</div>
							<!--begin::Modal-->
	<!--End::Dashboard 3-->
</div>
<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script type="text/javascript">
$( document ).ready(function() {
		var is_buyer = $("#usertype").is(":checked");
		if (!is_buyer) {
			$.ajax({
				url: DIR_CONT+DIR_USR+'CON_seller_profile.php?action=checkprofile&userId='+<?php echo $userId?>,
				success: function(result){
					var response = JSON.parse(result);
					if (response.is_seller== 1 && response.err==1) {
						if (response.cmp==2) $("#btn-cmp").show();
						else $("#btn-cmp").hide();
						if (response.adrs==2) $("#btn-adrs").show();
						else $("#btn-adrs").hide();
						if (response.ro==2) $("#btn-ro").show();
						else $("#btn-ro").hide();
						$('#kt_modal_seller').modal('show');
					}
			}});
		}
});

	$('.owl-carousel1').owlCarousel({
		loop: true,
		margin: 0,
		nav: true,
		dots: false,
		autoplay: true,
		autoplayTimeout: 3000,
		autoplayHoverPause: true,
		items: 1,
		navText: ["<i class='la la-angle-left'></i>","<i class='la la-angle-right'></i>"]
	});
	$('.owl-carousel2').owlCarousel({
		margin: 10,
		items: 7
	});
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
	$('.owl-carousel4').owlCarousel({
			loop:true,
			margin:10,
			nav:false,
			dots:false,
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:true,
			responsiveClass:true,
	    responsive:{
	        0:{
	            items:1,
	        },
	        600:{
	            items:2,
	        },
	        1000:{
	            items:4,
	            loop:false
	        }
	    }
	});
	$("#btn-regsel,#btn-regsel_mobile").click(function() {
		$.ajax({
			url: DIR_CONT+DIR_USR+'CON_seller_profile.php?action=reg-seller&userId='+<?php echo $userId?>,
			success: function(result){
				var response = JSON.parse(result);
				switch (response.err) {
					case 0:
						switchtoseller();
						break;
					default:
						alert("ERROR!");
				}
		}});
	});
</script>
