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
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
	<div class="kt-container ">
							<div class="kt-portlet">
								<div class="kt-portlet__body">
									<div class="kt-infobox">
										<div class="kt-infobox__header">
											<h2 class="kt-infobox__title kt-font-md">Add Products via Bulk Upload:</h2>
										</div>
										<div class="kt-infobox__body">
											<div class="kt-infobox__section">
												<h3 class="kt-infobox__subtitle kt-font-md">Step 1:</h3>
												<div class="kt-infobox__content">
													Please Choose one of the below Categories and click to download Excel file.
													<div class="row safari-row">
														<div class="col-md-3">
															<div class="kt-widget17__stats">
																<div class="kt-widget17__items">
																	<div class="kt-widget17__item /*kt-transparent-70 kt-p10*/ kt-pt5 kt-pr0 kt-pl0 kt-pb-0 rounded shadow box-purple">
																		<h2 class="kt-font-light text-center"><?php echo $main_categories->data[0]->name;?></h2>
																		<div class="row kt-align-center">
																			<a href="<?php echo DIR_ROOT . DIR_MED . 'productlist/grocery.zip' ?>" class="kt-link kt-font-bolder kt-m0 kt-font-light">
																				<span class="kt-widget17__icon"><img src="assets/media/categories/supplychain-jomlahbazar-emarket-wholesale-expo2020-main-category-image-grocery.jpg" alt="" class="btn-width-full"></span>
																			</a>
																	</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="kt-widget17__stats">
																<div class="kt-widget17__items">
																	<div class="kt-widget17__item /*kt-transparent-70 kt-p10*/ kt-pt5 kt-pr0 kt-pl0 kt-pb-0 rounded shadow box-red">
																		<h2 class="kt-font-light text-center"><?php echo $main_categories->data[1]->name;?></h2>
																		<div class="row kt-align-center">
																			<a href="<?php echo DIR_ROOT . DIR_MED . 'productlist/perfume.zip' ?>" class="kt-link kt-font-bolder kt-m0 kt-font-light">
																				<span class="kt-widget17__icon"><img src="assets/media/categories/supplychain-jomlahbazar-emarket-wholesale-expo2020-main-category-image-perfume.jpg" alt="" class="btn-width-full"></span>
																			</a>
																	</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="kt-widget17__stats">
																<div class="kt-widget17__items">
																	<div class="kt-widget17__item /*kt-transparent-70 kt-p10*/ kt-pt5 kt-pr0 kt-pl0 kt-pb-0 rounded shadow box-yellow">
																		<h2 class="kt-font-light text-center"><?php echo $main_categories->data[2]->name;?></h2>
																		<div class="row kt-align-center">
																			<a href="<?php echo DIR_ROOT . DIR_MED . 'productlist/beauty&makeup.zip' ?>" class="kt-link kt-font-bolder kt-m0 kt-font-light">
																				<span class="kt-widget17__icon"><img src="assets/media/categories/supplychain-jomlahbazar-emarket-wholesale-expo2020-main-category-image-beauty-make-up.jpg" alt="" class="btn-width-full"></span>
																			</a>
																	</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-3">
															<div class="kt-widget17__stats">
																<div class="kt-widget17__items">
																	<div class="kt-widget17__item /*kt-transparent-70 kt-p10*/ kt-pt5 kt-pr0 kt-pl0 kt-pb-0 rounded shadow box-orange">
																		<h2 class="kt-font-light text-center"><?php echo $main_categories->data[3]->name;?></h2>
																		<div class="row kt-align-center">
																			<a href="<?php echo DIR_ROOT . DIR_MED . 'productlist/personalcare.zip' ?>" class="kt-link kt-font-bolder kt-m0 kt-font-light">
																				<span class="kt-widget17__icon"><img src="assets/media/categories/supplychain-jomlahbazar-emarket-wholesale-expo2020-main-category-image-personal-care.jpg" alt="" class="btn-width-full"></span>
																			</a>
																	</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="kt-infobox__section">
												<h3 class="kt-infobox__subtitle kt-font-md">Step 2:</h3>
												<div class="kt-infobox__content">
													Fill the Excel file with your products infotmation and aslo create a folder of associate pictures for each product, make sure name of your picture should be product ID.
													Size of each picture should not be low quality or bigger than 350x500 pixel.
												</div>
											</div>
											<div class="kt-infobox__section">
												<h3 class="kt-infobox__subtitle kt-font-md">Step 3:</h3>
												<div class="kt-infobox__content">
												Now you need to submit your Excel file and zip folder of pictures.
												Use <a href="https://wetransfer.com/" class="kt-link">wetransfer</a> to upload all data and send them together to our email address <a href="mailto:info@jomlahbazar.com" class="kt-link ">info@jomlahbazar.com</a>
												</div>
											</div>
										</div>
									</div>
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
