<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
if (isset($_SESSION['userId'])) {
    $res_uid = $client->request('GET', DIR_CONT . DIR_USR . 'CON_sessions.php?action=get&jbidentifier=' . $_SESSION['userId']);/*fetch userId*/
    $usr = json_decode($res_uid->getBody());
    $roleId = $usr->roleId;
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
} else {
    include("../".DIR_CON."guestheader.php");
}/*Get page header*/
$client = new GuzzleHttp\Client();

$res_mcat = $client->request('GET', DIR_CONT . DIR_MCAT . 'CON_maincategories.php?action=get&maincategoryId=0');/*fetch all categories*/
$main_categories=json_decode($res_mcat->getBody());
$res_brnd = $client->request('GET', DIR_CONT.DIR_BRND.'CON_brands.php?action=get');/*fetch all categories*/
$brands=json_decode($res_brnd->getBody());
$res_sellers = $client->request('GET', DIR_CONT.DIR_USR.'CON_Suppliers.php?action=get');/*fetch all categories*/
$sellers=json_decode($res_sellers->getBody());

?>
<div class="kt-subheader kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
									<h3 class="kt-subheader__title">
										Home </h3>
									<span class="kt-subheader__separator kt-hidden"></span>
									<div class="kt-subheader__breadcrumbs">
										<a href="<?php echo DIR_ROOT;?>" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="javascript:void();" class="kt-subheader__breadcrumbs-link">
											Marketplace </a>
									</div>
								</div>
							</div>
              <div class="form-group orderby-mobile">
                    <select class="form-control kt-p0" style="height: calc(0.5em + 1.3rem + 2px) !important;font-size: 10px;font-weight: 900;" id="order_by" name="order_by">
                      <option value="0">Default Sorting</option>
                      <option value="1">A to Z</option>
                      <option value="2">Z to A</option>
                      <option value="3">High to low price</option>
                      <option value="4">Low to high</option>
                    </select>
              </div>
						</div>
						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<!--Begin::Dashboard 3-->
              <button type="button" class="btn btn-light kt-p0 btn-width-full" id="controller-mobile">Filter Brands, Categories, Sellers...</button>
							<div class="row safari-row-block">
								<div class="col-md-2 kt-p0" id="controller">

									<!--begin::Portlet-->
									<div class="kt-portlet kt-mr-5 sticky-left">
										<!--begin::Form-->
										<form class="kt-form" id="form_filter">
											<div class="kt-portlet__body " style="overflow-y: scroll;max-height: 500px;">
												<input type="hidden" name="generalSearch" id="generalSearch" value="<?php echo $searchtext;?>">
												<input type="hidden" name="filter_order" id="filter_order" value="3">
												<input type="hidden" name="filter_category" id="filter_category" value="">
												<input type="hidden" name="filter_supplier" id="filter_supplier" value="">
												<input type="hidden" name="filter_brand" id="filter_brand" value="">
												<input type="hidden" name="filter_ranking" id="filter_ranking" value="">
                        <input type="hidden" name="filter_demand" id="filter_demand" value="">
                        <input type="hidden" name="filter_event" id="filter_event" value="">
                        <input type="hidden" name="filter_role" id="filter_role" value="">
                        <input type="hidden" name="filter_fragrancefor" id="filter_fragrancefor" value="">
                        <input type="hidden" name="filter_arabicscents" id="filter_arabicscents" value="">
                        <input type="hidden" name="filter_luxuryperfume" id="filter_luxuryperfume" value="">
                        <input type="hidden" name="filter_tester" id="filter_tester" value="">
                        <input type="hidden" name="filter_giftset" id="filter_giftset" value="">
												<div class="form-group kt-hidden">
													<div class="typeahead">
														<input class="form-control" id="generalSearch" dir="ltr" type="hidden" placeholder="Product name" >
													</div>
												</div>
                        <div class="form-group">
                          <div class="kt-checkbox-list">
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success kt-font-bolder">
                              <input type="checkbox" id="featured" name="featured"> Limited offers
                              <span></span>
                            </label>
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success kt-font-bolder">
                              <input type="checkbox" id="bestseller" name="bestseller"> Best Sellers
                              <span></span>
                            </label>
                            <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success kt-font-bolder">
                              <input type="checkbox" id="discount" name="discount"> Discount
                              <span></span>
                            </label>
                          </div>
												</div>
												<div class="accordion  accordion-toggle-plus" id="accordionExample4">
													<div class="card">
														<div class="card-header" id="headingTwo4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
																Categories <a class="clear-filter" href="javascript:void(0)" onclick="clearfilter_categories()" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Clear Filter"><i class="la la-times"></i></a>
															</div>
														</div>
														<div id="collapseTwo4" class="collapse" aria-labelledby="headingTwo1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="form-group">
																	<div class="kt-checkbox-list">
																<?php
																	foreach ($main_categories as $mcategory) {
																		echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																		echo '<input type="checkbox" class="checkbox_mcat" data-id="'.$mcategory->maincategoryId.'">'.$mcategory->name;
																		echo '<span></span>';
																		echo '</label>';
                                    $res_mcats = $client->request('GET', DIR_CONT.DIR_MCAT.'CON_maincategories.php?action=get&maincategoryId='.$mcategory->maincategoryId);/*fetch all categories*/
                                    $mcategories=json_decode($res_mcats->getBody());
                                    foreach ($mcategories->categories as $mcat) {
                                      if ($mcat->count_pro!=0) {
                                        if ($mcategory->maincategoryId!=2) {
                                          echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success" style="left:20px;">';
      																		echo '<input type="checkbox"  onclick="filtercategory()" class="checkbox_cat mcat-'.$mcategory->maincategoryId.'" data-id="'.$mcat->categoryId.'">'.$mcat->name;
      																		echo '<span></span>';
      																		echo '</label>';
                                        }else {
                                          switch ($mcat->name) {
                  													case 'Perfume For Women':
                  														$feature_func = 'setff(this,1)';
                  														break;
                  													case 'Perfume For Men':
                                              $feature_func = 'setff(this,2)';
                  														break;
                  													case 'Arabic Scents':
                  														$feature_func = 'setas(this)';
                  														break;
                  													case 'Luxury Perfume':
                  														$feature_func = 'setlx(this)';
                  														break;
                  													case 'Tester':
                  														$feature_func = 'setts(this)';
                  														break;
                  													case 'Giftset':
                  														$feature_func = 'setgt(this)';
                  														break;

                  													default:
                  														$feature_func = 'setts(this)';
                  														break;
                  												}
                                          echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success" style="left:20px;">';
      																		echo '<input type="checkbox"  onclick="'.$feature_func.'" class="checkbox_cat mcat-'.$mcategory->maincategoryId.'" data-id="'.$mcat->categoryId.'">'.$mcat->name;
      																		echo '<span></span>';
      																		echo '</label>';
                                        }
                                      }

                                    }
																	}
																 ?>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" id="headingOne4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
																 Brands<a class="clear-filter" href="javascript:void(0)" onclick="clearfilter_brands()" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Clear Filter"><i class="la la-times"></i></a>
															</div>
														</div>
														<div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4" style="">
															<div class="card-body" id="rec-brand">
																<div class="form-group">
																	<div class="kt-checkbox-list">
																<?php
																	$count=0;
																	foreach ($brands as $brand) {
                                    if ($brand->count_pro!=0) {
                                      $count++;
  																		if($count<=10){
  																			echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
  																			echo '<input type="checkbox"  onclick="filterbrand()" class="checkbox_brnd" data-id="'.$brand->brandId.'">'.$brand->brand_name;
  																			echo '<span></span>';
  																			echo '</label>';
  																		}else break;
                                    }
																	}
																 ?>
																	<a href="javascript:void(0)" id="showmore" class="kt-font-brand">Show more</a>
																	<div id="morebrands" style="display:none;">
																		<?php
																			$count=0;
																			foreach ($brands as $brand) {
                                        if ($brand->count_pro!=0) {
                                          $count++;
  																				if($count<=10) continue;
  																				else{
  																					echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
  																					echo '<input type="checkbox"  onclick="filterbrand()" class="checkbox_brnd" data-id="'.$brand->brandId.'">'.$brand->brand_name;
  																					echo '<span></span>';
  																					echo '</label>';
  																				}
                                        }
																			}
																		 ?>
																	 </div>
																	 </div>
																</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" id="headingThree4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
																Price<a class="clear-filter" href="javascript:void(0)" onclick="clearfilter_prices()" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Clear Filter"><i class="la la-times"></i></a>
															</div>
														</div>
														<div id="collapseThree4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="row">
																	<ul class="kt-nav kt-p0">
        										<li class="kt-nav__item kt-nav__item">
        											<a href="javascript:void(0)" class="kt-nav__link" onclick="filterprice(1)">
        												<span class="kt-nav__link-text">Up to 25 AED</span>
        											</a>
        										</li>
        										<li class="kt-nav__item kt-nav__item">
        											<a href="javascript:void(0)" class="kt-nav__link" onclick="filterprice(2)">
        												<span class="kt-nav__link-text">50 to 150 AED</span>
        											</a>
        										</li>
        										<li class="kt-nav__item kt-nav__item">
        											<a href="javascript:void(0)" class="kt-nav__link" onclick="filterprice(3)">
        												<span class="kt-nav__link-text">150 to 350 AED</span>
        											</a>
        										</li>
        										<li class="kt-nav__item kt-nav__item">
        											<a href="javascript:void(0)" class="kt-nav__link" onclick="filterprice(4)">
        												<span class="kt-nav__link-text">350 to 700 AED</span>
        											</a>
        										</li>
        										<li class="kt-nav__item kt-nav__item">
        											<a href="javascript:void(0)" class="kt-nav__link" onclick="filterprice(5)">
        												<span class="kt-nav__link-text">700 AED & Above</span>
        											</a>
        										</li>
        									</ul>
																					<div class="col-xl-6">
																							<input type="text" class="form-control" name="min_price" id="min_price" placeholder="MIN" value="">
																					</div>
																					<div class="col-xl-6">
																							<input type="text" class="form-control" name="max_price" id="max_price" placeholder="MAX" value="">
																					</div>
																				</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" id="headingSix4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseSix4" aria-expanded="false" aria-controls="collapseSix4">
																Reviews<a class="clear-filter" href="javascript:void(0)" onclick="clearfilter_reviews()" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Clear Filter"><i class="la la-times"></i></a>
															</div>
														</div>
														<div id="collapseSix4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="form-group">
																	<div class="kt-checkbox-list">
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="star1" name="star1" onclick="filterranking()" class="checkbox_rnk" data-id="1"> 1 star
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="star2" name="star2" onclick="filterranking()" class="checkbox_rnk" data-id="2"> 2 stars
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="star3" name="star3" onclick="filterranking()" class="checkbox_rnk" data-id="3"> 3 stars
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="star4" name="star4" onclick="filterranking()" class="checkbox_rnk" data-id="4"> 4 stars
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="star5" name="star5" onclick="filterranking()" class="checkbox_rnk" data-id="5"> 5 stars
																			<span></span>
																		</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
                          <div class="card">
														<div class="card-header" id="headingEight4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseEight4" aria-expanded="false" aria-controls="collapseEight4">
																Sellers<a class="clear-filter" href="javascript:void(0)" onclick="clearfilter_suppliers()" data-container="body" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Clear Filter"><i class="la la-times"></i></a>
															</div>
														</div>
														<div id="collapseEight4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="form-group">
                                  <div class="kt-checkbox-list">
																<?php
																	$count=0;
																	foreach ($sellers->suppliers as $seller) {
																		$count++;
																		if($count<=10){
																			echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																			echo '<input type="checkbox"  onclick="filtersupplier()" class="checkbox_sup" data-id="'.$seller->usercompanyId.'">'.$seller->companyname ;
																			echo '<span></span>';
																			echo '</label>';
																		}else break;
																	}
                                  if(sizeof($sellers->suppliers)>=10) echo '<a href="javascript:void(0)" id="showmoresuppliers" class="kt-font-brand">Show more</a>';
																 ?>
																	<div id="moresuppliers" style="display:none;">
																		<?php
																			$count=0;
																			foreach ($sellers->suppliers as $seller) {
																				$count++;
																				if($count<=10) continue;
																				else{
																					echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																					echo '<input type="checkbox"  onclick="filtersupplier()" class="checkbox_sup" data-id="'.$seller->usercompanyId.'">'.$seller->companyname ;
																					echo '<span></span>';
																					echo '</label>';
																				}
																			}
																		 ?>
																	 </div>
																	 </div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="kt-portlet__foot ">
												<div class="kt-form__actions">
													<button type="reset" class="btn btn-secondary" onclick="resetfilter()"><i class="la la-times"></i></button>
                          <button type="button" class="btn btn-light" id="filter" ><i class="la la-search"></i></button>
												</div>
											</div>
										</form>

										<!--end::Form-->
									</div>

									<!--end::Portlet-->
								</div>
								<div class="col-md-10">
									<input type="hidden" name="page" id="page" value="1">
									<input type="hidden" name="pg" id="pg" value="1">
									<div id="rec-gd"></div>
                  <div class="row">
                    <div class="col-md-6">
                      <div id="kt_gmap_sloc" style="height: 100%; position: relative; overflow: hidden;" class="rounded"></div>
                    </div>
                    <div class="col-md-6">
                      <img src="<?php echo DIR_ROOT.DIR_MED.DIR_CON?>holecityinsquare.png" alt="" style="width: 100%;">
                    </div>

								</div>
							</div>
							<!--End::Dashboard 3-->
						</div>

						<!-- end:: Content -->
					</div>
          <div class="loader" id="wait" style="display:block">
            <img src="<?php echo DIR_ROOT.DIR_MED.DIR_CON;?>loader-jb.gif" alt="">
          </div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
<script src="assets/js/pages/crud/metronic-datatable/advanced/data-marketplace.js" type="text/javascript"></script>
<script src="assets/js/pages/custom/user/index.js" type="text/javascript"></script>
