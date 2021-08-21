<?php
session_start();
require_once '../../model/Base.php';/*fetch Directory variables*/
require_once '../../vendor/autoload.php';/*call composer functions*/
$client = new GuzzleHttp\Client();
include("../" . DIR_CON . "header_admin.php");
$res_store = $client->request('GET', DIR_CONT.DIR_ADMN.'CON_stores.php?action=get&storeId=' . $_GET['storeId']);/*fetch user info*/
/*get supplier general info*/
$store = json_decode($res_store->getBody());
$supplier_name = $store->info[0]->fullname;
$company_name = $store->store[0]->companyname;
$company_pic = $store->store[0]->profile_pic;
?>
						<!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<!--Begin::Dashboard 3-->
              <div class="row">
								<div class="col-md-12 store_header">
									<!-- add img here -->
								</div>
                <div class="col-md-8 kt-pl0">
                  <div class="kt-portlet white-bk">
                  								<div class="kt-portlet__body kt-pl0">
																		<div class="row">
																			<div class="col-md-3">
																				<img src="<?php echo DIR_ROOT.$company_pic?>" alt="" class="store_pic">
																				<img src="<?php echo DIR_ROOT.DIR_MED.DIR_STR.'store-header.jpg'?>" alt="" class="store_pic">
																			</div>
																			<div class="col-md-1">
																				<div class="kt-widget__info">
																					<div class="kt-widget__desc">
																				<?php
																				echo '<div class="kt-widget__item flex-fill"><div class="kt-media-group"><div class="kt-widget__action">';
																				echo '<div class="kt-space-10"></div>';
																				if(isset($store->reachouts[0]->facebook) && $store->reachouts[0]->facebook!=null) echo '<a href="https://www.facebook.com/'.$store->reachouts[0]->facebook.'" class="btn btn-icon btn-circle btn-label-dark kt-mb-5" target="_blank"><i class="fab fa-facebook-f"></i></a>';
																				if(isset($store->reachouts[0]->instagram) && $store->reachouts[0]->instagram!=null) echo '<a href="https://www.instagram.com/'.$store->reachouts[0]->instagram.'" class="btn btn-icon btn-circle btn-label-dark kt-mb-5"  target="_blank"><i class="fab fa-instagram"></i></a>';
																					if(isset($store->reachouts[0]->whatsapp) && $store->reachouts[0]->whatsapp!=null) echo '<a href="https://wa.me/'.$store->reachouts[0]->whatsapp.'?text=Im%20interested%20in%20your%20products" class="btn btn-icon btn-circle btn-label-success"  target="_blank"><i class="fab fa-whatsapp contact_icon"></i></a>';
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
                  													<h2 class="kt-font-dark kt-font-bolder store_name"><?php echo $company_name;?></h2>
                  												</div>
																						<div class="kt-section">
																							<div class="row">
																								<div class="col-md-2">
																									<div class="kt-section__info kt-font-bolder">Categories:</div>
																								</div>
																								<div class="col-md-10">
																									<div class="kt-section__content">
																										<?php
																											foreach ($store->categories as $category) {
																												echo '<a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?cat='.$category->categoryId.'" class="btn btn-label-dark">'.$category->name.'</a>&nbsp;';
																											}
																									 ?>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="kt-section">
																							<div class="row">
																								<div class="col-md-2">
																									<div class="kt-section__info kt-font-bolder">Brands:</div>
																								</div>
																								<div class="col-md-10">
																									<div class="kt-section__content">
																										<?php
																											foreach ($store->brands as $brand) {
																												echo '<a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?brnd='.$brand->brandId.'" class="btn btn-label-dark">'.$brand->brand_name.'</a>&nbsp;';
																											}
																									 ?>
																									</div>
																								</div>
																							</div>
																						</div>
                                          <div class="kt-space-10"></div>
                  												<div class="kt-widget__info">
                  													<div class="kt-widget__desc">
                  														<?php
																							echo '<div class="kt-widget__item flex-fill"><div class="row"><div class="col-md-2"><span class="kt-widget__subtitel kt-font-bolder">Contact:</span></div><div class="col-md-10" style="position: relative;top: -15px;"><div class="kt-media-group"><div class="kt-widget__action">';
																						  echo '<div class="kt-space-10"></div>';
																							echo '<a href="mailto:'.$store->info[0]->email.'" class="btn btn-icon btn-circle btn-label-dark kt-mb-5" target="_blank"><i class="flaticon2-black-back-closed-envelope-shape"></i></a>';

																						  if(isset($store->reachouts[0]->phone) && $store->reachouts[0]->phone!=null) echo '<a href="tel:'.$store->reachouts[0]->phone.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="fa fa-phone"></i></a>';
																						  if(isset($store->reachouts[0]->telegram) && $store->reachouts[0]->telegram!=null) echo '<a href="https://t.me/'.$store->reachouts[0]->telegram.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="fab fa-telegram-plane"></i></a>';
																						  if(isset($store->reachouts[0]->messenger) && $store->reachouts[0]->messenger!=null) echo '<a href="https://m.me/'.$store->reachouts[0]->messenger.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="fab fa-facebook-messenger contact_icon"></i></a>';
																						  if(isset($store->reachouts[0]->linkedin) && $store->reachouts[0]->linkedin!=null) echo '<a href="linkedin:'.$store->reachouts[0]->linkedin.'" class="btn btn-icon btn-circle btn-label-dark contact_icon" target="_blank"><i class="fab fa-linkedin"></i></a>';
																						  if(isset($store->reachouts[0]->sms) && $store->reachouts[0]->sms!=null) echo '<a href="sms:'.$store->reachouts[0]->sms.'" class="btn btn-icon btn-circle btn-label-dark" target="_blank"><i class="fa fa-sms contact_icon"></i></a>';
																						  echo '</div></div></div></div></div>';
                                              ?>
																							<div class="kt-space-10"></div>
																							<div class="row">
																								<?php
																									if(isset($store->address[0]->address1) && $store->address[0]->address1!=Null) echo '<div class="col-md-6">Address 1: '.$store->address[0]->address1.'</div>';
																									if(isset($store->address[0]->address2) && $store->address[0]->address2!=Null) echo '<div class="col-md-6">Address 2: '.$store->address[0]->address2.'</div>';
																									if(isset($store->address[0]->city) && $store->address[0]->city!=Null) echo '<div class="col-md-6">City: '.$store->address[0]->city.'</div>';
																									if(isset($store->address[0]->state) && $store->address[0]->state!=Null) echo '<div class="col-md-6">State: '.$store->address[0]->state.'</div>';
																									if(isset($store->address[0]->postalcode)  && $store->address[0]->postalcode!=Null) echo '<div class="col-md-6">Postal code: '.$store->address[0]->postalcode.'</div>';
																									if(isset($store->address[0]->country) && $store->address[0]->country!=Null) echo '<div class="col-md-6">Country: '.$store->address[0]->country.'</div>';
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
									<div class="kt-portlet kt-portlet--tab white-bk">
										<div class="kt-portlet__body kt-pr0">
											<div id="kt_gmap_4" style="height:281px;">
											</div>
										</div>
									</div>
								 </div>
								 <div class="col-md-12 store_header">
 									<!-- add img here -->
 								</div>
                <div class="col-md-8">
									<input type="hidden" name="page" id="page" value="1">
									<input type="hidden" name="pg" id="pg" value="1">
									<div class="row" id="rec-gd"></div>
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
include(DIR_VIEW.DIR_CON."footer.php");
?>
<script>
var demo4 = function() {
  var map = new GMaps({
    div: '#kt_gmap_4',
    lat: 24.7563957,
    lng: 55.2597173,
  });
	map.addMarker({
		lat: <?php echo $store->addresses[0]->latitude;?>,
		lng: <?php echo $store->addresses[0]->longitude;?>,
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
</script>
