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
	include("../".DIR_CON."guestheader.php");
}/*Get page header*/
if (isset($_GET['maincategoryId']) && $_GET['maincategoryId']!=0) {
	$res_cat = $client->request('GET',DIR_CONT.DIR_CAT.'CON_categories.php?action=get-mcat-cat&maincategoryId='.$_GET['maincategoryId']);
	$categories=json_decode($res_cat->getBody());
}else {
	$res_cat = $client->request('GET', DIR_JSON.'Read.php?jsonname=categories.json');/*fetch all categories*/
	$categories=json_decode($res_cat->getBody());
	$categories=$categories->data;
}


?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<!--Begin::Dashboard 3-->
	<div class="row safari-row-flex">
	<?php
		if ($_GET['maincategoryId']!=2) {
			foreach ($categories as $category) {
				echo '<div class="col-xl-3"><a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?cat='.$category->categoryId.'" class="kt-widget__username"><div class="kt-portlet kt-portlet--height-fluid" style="height: 215px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img" src="'.DIR_ROOT.$category->icon.'" alt="image"><div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-hidden">'.substr($category->name,0,2).'</div></div><div class="kt-widget__content"><div class="kt-widget__section text-center kt-mt-5"><span class="kt-font-dark kt-font-title">'.$category->name.'</span></div></div></div></div></div></div></a></div>';
			}
		}else {
			foreach ($categories as $category) {
				switch ($category->name) {
					case 'Perfume For Women':
						$feature_name = 'ff';
						$feature_value = 1;
						break;
					case 'Perfume For Men':
					$feature_name = 'ff';
					$feature_value = 2;
						break;
					case 'Arabic Scents':
						$feature_name = 'as';
						$feature_value = 1;
						break;
					case 'Luxury Perfume':
						$feature_name = 'lx';
						$feature_value = 1;
						break;
					case 'Tester':
						$feature_name = 'ts';
						$feature_value = 1;
						break;
					case 'Giftset':
						$feature_name = 'gt';
						$feature_value = 1;
						break;

					default:
						$feature_name = 'ts';
						$feature_value = 1;
						break;
				}
				echo '<div class="col-xl-3"><a href="'.DIR_VIEW.DIR_PRO.'marketplace.php?'.$feature_name.'='.$feature_value.'" class="kt-widget__username"><div class="kt-portlet kt-portlet--height-fluid" style="height: 215px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img" src="'.DIR_ROOT.$category->icon.'" alt="image"><div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-hidden">'.substr($category->name,0,2).'</div></div><div class="kt-widget__content"><div class="kt-widget__section text-center kt-mt-5"><span class="kt-font-dark kt-font-title">'.$category->name.'</span></div></div></div></div></div></div></a></div>';
			}
		}
	?>
	<!--End::Dashboard 3-->
</div>
<!-- end:: Content -->
</div>
<?php
if (isset($_SESSION['userId'])) include(DIR_VIEW . DIR_CON . "footer.php");
else include(DIR_VIEW . DIR_CON . "guest-footer.php");
?>
