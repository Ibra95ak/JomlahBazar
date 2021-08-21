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
	include("../".DIR_CON."guestheader.php");
}/*Get page header*/

$res_rev = $client->request('GET', DIR_CONT . DIR_PRO . 'CON_Reviews.php?action=get&supplierId=' . $_GET['userId']);
$reviews = json_decode($res_rev->getBody());
$res_user = $client->request('GET', DIR_CONT.DIR_USR.'CON_buyer_profile.php?action=get&userId=' . $_GET['userId']);/*fetch user info*/
/*get supplier general info*/
$supplier = json_decode($res_user->getBody());
$supplier_name = $supplier->info[0]->fullname;
$supplier_role = $supplier->role[0]->role;
$company_name = $supplier->company[0]->companyname;
$company_pic = $supplier->company[0]->profile_pic;
if($company_pic=="") $company_pic=DIR_MED."companies/default.jpg";
$total_verified = $supplier->verified[0]->total_verified;
/*Full URL*/
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
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
											Store </a>
									</div>
								</div>
							</div>
						</div>
						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<!--Begin::Dashboard 3-->
              <div class="row safari-row-block">
								<div class="col-md-12 store_header">
									<!-- add img here -->
								</div>
							</div>
							<div class="row safari-row-block">
                <div class="col-md-8 kt-pl0">
                  <div class="kt-portlet white-bk">
                  								<div class="kt-portlet__body kt-pl0">
																		<div class="row safari-row-block">
																			<div class="col-md-3">
																				<img src="<?php echo DIR_ROOT.$company_pic?>" alt="" class="store_pic">
																			</div>
																			<div class="col-md-1">
																				<div class="kt-widget__info">
																					<div class="kt-widget__desc">
																				<?php
																				echo '<div class="kt-widget__item flex-fill"><div class="kt-media-group"><div class="kt-widget__action">';
																				echo '<div class="kt-space-10"></div>';
																				if(isset($supplier->reachout[0]->facebook) && $supplier->reachout[0]->facebook!=null) echo '<a href="https://www.facebook.com/'.$supplier->reachout[0]->facebook.'" class="btn btn-icon btn-circle btn-label-dark kt-mb-5" target="_blank"><i class="fab fa-facebook-f"></i></a>';
																				else echo '<a href="javascript:void(0)" class="btn btn-icon btn-circle btn-label-dark kt-mb-5"><i class="fab fa-facebook-f"></i></a>';
																				if(isset($supplier->reachout[0]->instagram) && $supplier->reachout[0]->instagram!=null) echo '<a href="https://www.instagram.com/'.$supplier->reachout[0]->instagram.'" class="btn btn-icon btn-circle btn-label-dark kt-mb-5"  target="_blank"><i class="fab fa-instagram"></i></a>';
																				else echo '<a href="javascript:void(0)" class="btn btn-icon btn-circle btn-label-dark kt-mb-5"><i class="fab fa-instagram"></i></a>';
																				if(isset($supplier->reachout[0]->whatsapp) && $supplier->reachout[0]->whatsapp!=null) echo '<a href="https://wa.me/'.$supplier->reachout[0]->whatsapp.'?text=Im%20interested%20in%20your%20products" class="btn btn-icon btn-circle btn-label-success"  target="_blank"><i class="fab fa-whatsapp contact_icon"></i></a>';
																				else echo '<a href="javascript:void(0)" class="btn btn-icon btn-circle btn-label-dark"><i class="fab fa-whatsapp contact_icon"></i></a>';
																				echo '</div></div></div>';
																				?>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-8">
																		<div class="kt-widget kt-widget--user-profile-3">
                  										<div class="kt-widget__top">
                  											<div class="kt-widget__content kt-pl0">
                  												<div class="kt-widget__head">
                  													<h2 class="kt-font-dark kt-font-bolder store_name"><?php echo $company_name;?>  <span class="kt-font-md"><?php echo $supplier_role;?></span></h2>

																						<div class="kt-portlet__head-toolbar">
																							Verified:<?php echo $total_verified;?> <img src="<?php echo DIR_ICON."check.png"?>" alt="" width="25px">
																						</div>
                  												</div>
																						<div class="kt-section">
																							<div class="row safari-row-block">
																								<div class="col-md-2">
																									<div class="kt-section__info kt-font-bolder">Categories:</div>
																								</div>
																								<div class="col-md-10">
																									<div class="kt-section__content">
																										<?php
																											if ($supplier->categories) {
																												foreach ($supplier->categories as $category) {
																													echo '<a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?cat='.$category->categoryId.'" class="btn">'.$category->name.'</a>&nbsp;';
																												}
																											}else {
																												echo '<a href="javascript:void(0)" class="btn">No Categories!</a>&nbsp;';
																											}
																									 ?>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="kt-section">
																							<div class="row safari-row-block">
																								<div class="col-md-2">
																									<div class="kt-section__info kt-font-bolder">Brands:</div>
																								</div>
																								<div class="col-md-10">
																									<div class="kt-section__content">
																										<?php
																											if ($supplier->brands) {
																												$countb=0;
																												foreach ($supplier->brands as $brand) {
																													$countb++;
																													if($countb<=10){
																													echo '<a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?brnd='.$brand->brandId.'" class="btn">'.$brand->brand_name.'</a>&nbsp;';
																												}else break;
																												}

																									 ?>
																									 <div class="kt-widget4__item" id="showmorebrnddiv">
											 															<a id="showmorebrnd" href="javascript:void()" class="btn btn-sm btn-secondary btn-bold">View All</a>
											 														</div>
								 																	<div id="morebrnds" style="display:none;">
																										<?php
																											$countb=0;
																											foreach ($supplier->brands as $brand) {
																												$countb++;
																												if($countb<=10) continue;
																												else{
																													echo '<a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?brnd='.$brand->brandId.'" class="btn">'.$brand->brand_name.'</a>&nbsp;';
																												}
																											}
																											echo "</div>";
																										}else {
																												echo '<a href="javascript:void(0)" class="btn">No Brands!</a>&nbsp;';
																										}
																										 ?>
																									</div>
																								</div>
																							</div>
																						</div>
                                          <div class="kt-space-10"></div>
                  												<div class="kt-section">
                  													<div class="kt-widget__desc">
                  														<?php
																							echo '<div class="kt-widget__item flex-fill"><div class="row safari-row-block"><div class="col-md-2"><span class="kt-widget__subtitel kt-font-bolder">Contact:</span></div><div class="col-md-10" style="position: relative;top: -15px;"><div class="kt-media-group"><div class="kt-widget__action">';
																						  echo '<div class="kt-space-10"></div>';
																							echo '<a href="mailto:'.$supplier->info[0]->email.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="flaticon2-black-back-closed-envelope-shape"></i></a>';

																						  if(isset($supplier->reachout[0]->phone) && $supplier->reachout[0]->phone!=null) echo '<a href="tel:'.$supplier->reachout[0]->phone.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="fa fa-phone"></i></a>';
																						  if(isset($supplier->reachout[0]->telegram) && $supplier->reachout[0]->telegram!=null) echo '<a href="https://t.me/'.$supplier->reachout[0]->telegram.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="fab fa-telegram-plane"></i></a>';
																						  if(isset($supplier->reachout[0]->messenger) && $supplier->reachout[0]->messenger!=null) echo '<a href="https://m.me/'.$supplier->reachout[0]->messenger.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="fab fa-facebook-messenger contact_icon"></i></a>';
																						  if(isset($supplier->reachout[0]->linkedin) && $supplier->reachout[0]->linkedin!=null) echo '<a href="linkedin:'.$supplier->reachout[0]->linkedin.'" class="btn btn-icon btn-circle btn-label-dark contact_icon" target="_blank"><i class="fab fa-linkedin"></i></a>';
																						  if(isset($supplier->reachout[0]->sms) && $supplier->reachout[0]->sms!=null) echo '<a href="sms:'.$supplier->reachout[0]->sms.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="fa fa-sms contact_icon"></i></a>';
																						  echo '</div></div></div></div></div>';
                                              ?>
																							<div class="kt-space-10"></div>
																							<div class="row safari-row-flex">
																								<?php
																									if(isset($supplier->address[0]->address1) && $supplier->address[0]->address1!=Null) echo '<div class="col-md-6">Address 1: '.$supplier->address[0]->address1.'</div>';
																									if(isset($supplier->address[0]->address2) && $supplier->address[0]->address2!=Null) echo '<div class="col-md-6">Address 2: '.$supplier->address[0]->address2.'</div>';
																									if(isset($supplier->address[0]->city) && $supplier->address[0]->city!=Null) echo '<div class="col-md-6">City: '.$supplier->address[0]->city.'</div>';
																									if(isset($supplier->address[0]->state) && $supplier->address[0]->state!=Null) echo '<div class="col-md-6">State: '.$supplier->address[0]->state.'</div>';
																									if(isset($supplier->address[0]->postalcode)  && $supplier->address[0]->postalcode!=Null) echo '<div class="col-md-6">Postal code: '.$supplier->address[0]->postalcode.'</div>';
																									if(isset($supplier->address[0]->country) && $supplier->address[0]->country!=Null) echo '<div class="col-md-6">Country: '.$supplier->address[0]->country.'</div>';
																								?>
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
                <div class="col-md-4 kt-pr0">
									<div class="alert alert-secondary white-bk kt-p0 kt-m0" role="alert">
										<div class="alert-text" style="text-align:center">
											Share
											<a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?php echo urlencode($url)?>." class="kt-font-dark"><i class="socicon-mail"></i></a>
											<a href="https://wa.me/?text=<?php echo urlencode($url)?>" class="kt-font-dark"><i class="socicon-whatsapp" target="_blank"></i></a>
										</div>
									</div>
									<div class="kt-portlet kt-portlet--tab white-bk">
										<div class="kt-portlet__body kt-pr0">
											<div id="kt_gmap_4" style="height:281px;">
											</div>
										</div>
									</div>
								 </div>
							 </div>
							 <div class="row safari-row-block">
								 <div class="col-md-12 store_header">
 									<!-- add img here -->
 								</div>
							</div>
							<div class="row safari-row-block">
								<div class="col-md-2 kt-p0">

									<!--begin::Portlet-->
									<div class="kt-portlet kt-mr-5 sticky-left">
										<!--begin::Form-->
										<form class="kt-form">
											<div class="kt-portlet__body ">
												<input type="hidden" name="filter_category" id="filter_category" value="">
												<input type="hidden" name="filter_supplier" id="filter_supplier" value="">
												<input type="hidden" name="filter_brand" id="filter_brand" value="">
												<input type="hidden" name="filter_ranking" id="filter_ranking" value="">
                        <input type="hidden" name="filter_demand" id="filter_demand" value="">
                        <input type="hidden" name="filter_event" id="filter_event" value="">
												<div class="form-group">
													<div class="typeahead">
														<input class="form-control" id="generalSearch" dir="ltr" type="text" placeholder="Product name" >
													</div>
												</div>
												<div class="form-group">
													<select class="form-control" id="order_by" name="order_by">
                            <option value="0">Default Sorting</option>
                            <option value="1">A to Z</option>
                            <option value="2">Z to A</option>
                            <option value="3">High to low price</option>
                            <option value="4">Low to high</option>
													</select>
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
																Categories
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
		                                      echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success" style="left:20px;">';
		  																		echo '<input type="checkbox"  onclick="filtercategory()" class="checkbox_cat mcat-'.$mcategory->maincategoryId.'" data-id="'.$mcat->categoryId.'">'.$mcat->name;
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
													<div class="card">
														<div class="card-header" id="headingOne4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
																 Brands
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
																						echo '<input type="checkbox"  onclick="filterbrand()" class="checkbox_brnd" data-id="'.$brand->brandId.'">'.$brand->brand_name." (".$brand->count_pro.")";
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
																Price
															</div>
														</div>
														<div id="collapseThree4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="row safari-row-block">
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
																							<input type="text" class="form-control" name="min_price" id="min_price" placeholder="Minimum Price" value="">
																					</div>
																					<div class="col-xl-6">
																							<input type="text" class="form-control" name="max_price" id="max_price" placeholder="Maximum Price" value="">
																					</div>
																				</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" id="headingSix4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseSix4" aria-expanded="false" aria-controls="collapseSix4">
																Reviews
															</div>
														</div>
														<div id="collapseSix4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="form-group">
																	<div class="kt-checkbox-list">
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="star1" name="star1" onclick="filterranking()" class="checkbox_rnk" data-id="1"> 1 start
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
												</div>
											</div>
											<div class="kt-portlet__foot ">
												<div class="kt-form__actions">
													<button type="button" class="btn btn-warning" id="filter">Filter</button>
													<button type="reset" class="btn btn-secondary">Reset</button>
												</div>
											</div>
										</form>

										<!--end::Form-->
									</div>

									<!--end::Portlet-->
								</div>
                <div class="col-md-8">
									<input type="hidden" name="page" id="page" value="1">
									<input type="hidden" name="pg" id="pg" value="1">
									<div class="row safari-row-flex" id="rec-gd"></div>
									<?php
									if (isset($userId)) {
									?>
										<div class="kt-portlet" id="supplier_review">
											<div class="kt-portlet__head">
												<div class="kt-portlet__head-label">
													<h3 class="kt-portlet__head-title">
														Add Supplier Review
													</h3>
												</div>
											</div>

											<!--begin::Form-->
											<form class="kt-form" id="jbform">
												<div class="kt-portlet__body">
													<div class="form-group">
														<label for="exampleTextarea" class="kt-m0">Your rating</label>
														<div class="star-rating">
															<input type="radio" id="5-stars" name="rating" value="5" />
															<label for="5-stars" class="star">&#9733;</label>
															<input type="radio" id="4-stars" name="rating" value="4" />
															<label for="4-stars" class="star">&#9733;</label>
															<input type="radio" id="3-stars" name="rating" value="3" />
															<label for="3-stars" class="star">&#9733;</label>
															<input type="radio" id="2-stars" name="rating" value="2" />
															<label for="2-stars" class="star">&#9733;</label>
															<input type="radio" id="1-star" name="rating" value="1" />
															<label for="1-star" class="star">&#9733;</label>
														</div>
													</div>
													<div class="form-group form-group-last">
														<label for="exampleTextarea">Your Review</label>
														<textarea class="form-control" id="description" name="description" rows="3"></textarea>
													</div>
												</div>
												<div class="kt-portlet__foot">
													<div class="kt-form__actions">
														<button type="button" class="btn btn-warning" id="btn_review">Submit</button>
														<button type="reset" class="btn btn-secondary">Cancel</button>
													</div>
												</div>
											</form>

											<!--end::Form-->
										</div>
									<?php } ?>
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
											if ($reviews->user_reviews) {
												foreach ($reviews->user_reviews as $review) {
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
								</div>
                <div class="col-md-2">
									<!--begin::Portlet-->
									<div class="kt-portlet white-bk">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title kt-font-dark">
													Relative Suppliers
												</h3>
											</div>
										</div>
										<div class="kt-portlet__body">
											<div class="tab-content">
												<div class="tab-pane active" id="kt_widget4_tab1_content">
													<div class="kt-widget4">
														<?php
															for($i=0;$i<9;$i++) {
																if($i>=sizeof($supplier->suppliers)) break;
																else{
																	echo '<div class="kt-widget4__item">';
																	echo '<div class="kt-widget4__pic kt-widget4__pic--pic"><img src="'.$supplier->suppliers[$i]->profile_pic.'" alt=""></div>';
																	echo '<div class="kt-widget4__info"><a href="#" class="kt-widget4__username">'.$supplier->suppliers[$i]->companyname.'</a></div>';
																	echo '<a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$supplier->suppliers[$i]->userId.'" class="btn btn-sm btn-label-dark btn-bold">View</a>';
																	echo '</div>';
																}
															}
														?>
														<div class="kt-widget4__item" id="showmorediv">
															<a id="showmore" href="javascript:void()" class="btn btn-sm btn-secondary btn-bold">View All</a>
														</div>
														<div id="moresuppliers" style="display:none;padding-top: 1rem;">
															<?php
																if(sizeof($supplier->suppliers)>9){
																	for($i=9;$i<sizeof($supplier->suppliers);$i++) {
																		echo '<div class="kt-widget4__item">';
																		echo '<div class="kt-widget4__pic kt-widget4__pic--pic"><img src="'.$supplier->suppliers[$i]->profile_pic.'" alt=""></div>';
																		echo '<div class="kt-widget4__info"><a href="#" class="kt-widget4__username">'.$supplier->suppliers[$i]->fullname.'</a></div>';
																		echo '<a href="'.DIR_VIEW.DIR_STR.'storedetails.php?userId='.$supplier->suppliers[$i]->userId.'" class="btn btn-sm btn-label-warning btn-bold">View</a>';
																		echo '</div>';
																	}
																}
															?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--end::Portlet-->
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
<script id="page_id" src="assets/js/pages/crud/metronic-datatable/advanced/data-supplierproductsgrid.js?userId=<?php echo $_GET['userId'];?>" type="text/javascript"></script>
<script>
var demo4 = function() {
  var map = new GMaps({
    div: '#kt_gmap_4',
    lat: <?php echo $supplier->address[0]->latitude;?>,
    lng: <?php echo $supplier->address[0]->longitude;?>,
  });
	map.addMarker({
		lat: <?php echo $supplier->address[0]->latitude;?>,
		lng: <?php echo $supplier->address[0]->longitude;?>,
		title: '<?php echo $supplier_name;?>',
		icon: DIR_ICON+"marker-orange.png",
		infoWindow: {
			content: '<span style="color:#000"><?php echo $supplier_name;?></span>'
		}
	});
  map.setZoom(7);
}
$(document).ready(function(){
  $(".owl-one").owlCarousel({
		items:1,
	});
  $(".owl-two").owlCarousel({
    items:1,
  });
  demo4();
});
$('#showmore').on('click', function() {
	$('#showmorediv').hide();
	$('#moresuppliers').show();
});
$('#showmorebrnd').on('click', function() {
	$('#showmorebrnddiv').hide();
	$('#morebrnds').show();
});
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
		url: DIR_CONT+DIR_PRO+"CON_Reviews.php?action=post-supplier&supplierId=<?php echo $_GET['userId'] ?>&userId=<?php echo $userId?>",
		cache: false,
		contentType: false,
		processData: false,
		data: formdata1,
		dataType: "json",
		success: function(data) {
			switch (data['err']) {
				case 0:
					// similate 2s delay
					setTimeout(function() {
						btn.removeClass(
							'kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light'
						).attr('disabled', false);
						//Simulate an HTTP redirect:
						location.reload();
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
</script>
