<?php

include("guestheader.php");
?>
						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<!--Begin::Dashboard 3-->
							<div class="alert alert-solid-brand alert-bold" role="alert">
								<div class="alert-text" id="timer"></div>
								<div class="tick" data-value="1234" data-did-init="setupFlip">
								  <!-- Hide visual content from screenreaders with `aria-hidden` -->
								  <div data-repeat="true" >
								    <span data-view="flip"></span>
								  </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">

									<!--begin::Portlet-->
									<div class="kt-portlet white-bk">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													Filter Controls
												</h3>
											</div>
										</div>

										<!--begin::Form-->
										<form class="kt-form">
											<div class="kt-portlet__body white-bk">
												<input type="hidden" name="filter_category" id="filter_category" value="">
												<input type="hidden" name="filter_brand" id="filter_brand" value="">
												<input type="hidden" name="filter_ranking" id="filter_ranking" value="">
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
												<div class="accordion  accordion-toggle-arrow" id="accordionExample4">
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
																	foreach ($categories->data as $category) {
																		echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																		echo '<input type="checkbox"  onclick="filtercategory()" class="checkbox_cat" data-id="'.$category->categoryId.'">'.$category->name;
																		echo '<span></span>';
																		echo '</label>';
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
																	foreach ($brands->data as $brand) {
																		$count++;
																		if($count<=10){
																			echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																			echo '<input type="checkbox"  onclick="filterbrand()" class="checkbox_brnd" data-id="'.$brand->brandId.'">'.$brand->brand_name;
																			echo '<span></span>';
																			echo '</label>';
																		}else break;
																	}
																 ?>
																	<a href="javascript:void(0)" id="showmore" class="kt-font-brand">Show more</a>
																	<div id="morebrands" style="display:none;">
																		<?php
																			$count=0;
																			foreach ($brands->data as $brand) {
																				$count++;
																				if($count<=10) continue;
																				else{
																					echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
																					echo '<input type="checkbox"  onclick="filterbrand()" class="checkbox_cat" data-id="'.$brand->brandId.'">'.$brand->brand_name;
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
													<div class="card">
														<div class="card-header" id="headingThree4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
																Price
															</div>
														</div>
														<div id="collapseThree4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="row">
																					<div class="col-xl-6">
																						<div class="form-group">
																							<input type="text" class="form-control" name="min_price" id="min_price" placeholder="Minimum Price" value="">
																						</div>
																					</div>
																					<div class="col-xl-6">
																						<div class="form-group">
																							<input type="text" class="form-control" name="max_price" id="max_price" placeholder="Maximum Price" value="">
																						</div>
																					</div>
																				</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" id="headingFour4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4">
																Discount
															</div>
														</div>
														<div id="collapseFour4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="row">
																					<div class="col-xl-6">
																						<div class="form-group">
																							<input type="text" class="form-control" name="min_discount" id="min_discount" placeholder="Minimum Discount" value="">
																						</div>
																					</div>
																					<div class="col-xl-6">
																						<div class="form-group">
																							<input type="text" class="form-control" name="max_discount" id="max_discount" placeholder="Maximum Discount" value="">
																						</div>
																					</div>
																				</div>
															</div>
														</div>
													</div>
													<div class="card">
														<div class="card-header" id="headingFive4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFive4" aria-expanded="false" aria-controls="collapseFive4">
																Popular Picks
															</div>
														</div>
														<div id="collapseFive4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="form-group">
																	<div class="kt-checkbox-list">
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="featured" name="featured"> Limited offers
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="bestseller" name="bestseller"> Bestsellers
																			<span></span>
																		</label>
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
													<div class="card">
														<div class="card-header" id="headingSeven4">
															<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseSeven4" aria-expanded="false" aria-controls="collapseSeven4">
																location
															</div>
														</div>
														<div id="collapseSeven4" class="collapse" aria-labelledby="headingThree1" data-parent="#accordionExample4">
															<div class="card-body">
																<div class="form-group">
																	<div class="kt-checkbox-list">
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="loc1" name="loc1"> Dubai
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="loc2" name="loc2"> Abu Dhabi
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="loc3" name="loc3"> Ajman
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="loc4" name="loc4"> Fujairah
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="loc5" name="loc5"> Ras al Khaimah
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="loc6" name="loc6"> Sharjah
																			<span></span>
																		</label>
																		<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
																			<input type="checkbox" id="loc7" name="loc7"> Umm al Quwain
																			<span></span>
																		</label>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="kt-portlet__foot white-bk">
												<div class="kt-form__actions">
													<button type="reset" class="btn btn-primary">Reset</button>
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
									<div class="row" id="rec-gd"></div>
								</div>
							</div>
							<!--End::Dashboard 3-->
						</div>

						<!-- end:: Content -->
					</div>
<?php
include("footer.php");
?>
<script src="assets/js/pages/crud/metronic-datatable/advanced/data-marketplace.js" type="text/javascript"></script>
<script type="text/javascript">
var states =  <?php print_r(json_encode($productsnames->data))?>;
		var demo1 = function() {
				var substringMatcher = function(strs) {
						return function findMatches(q, cb) {
								var matches, substringRegex;

								// an array that will be populated with substring matches
								matches = [];

								// regex used to determine if a string contains the substring `q`
								substrRegex = new RegExp(q, 'i');

								// iterate through the pool of strings and for any string that
								// contains the substring `q`, add it to the `matches` array
								$.each(strs, function(i, str) {
										if (substrRegex.test(str)) {
												matches.push(str);
										}
								});

								cb(matches);
						};
				};

				$('#generalSearch').typeahead({
						hint: true,
						highlight: true,
						minLength: 1
				}, {
						name: 'states',
						source: substringMatcher(states)
				});
		}
demo1();
</script>
<!-- Display the countdown timer in an element -->
<!-- <script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("timer").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "EXPIRED";
  }
}, 1000);
</script> -->
<script>
function setupFlip(tick) {

    Tick.helper.interval(function() {

        tick.value++;

        // Set `aria-label` attribute which screenreaders will read instead of HTML content
        tick.root.setAttribute('aria-label', tick.value);

    }, 1000);

}
</script>
