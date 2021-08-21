<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*response array*/
$response['products']=array();
$response['count']=array();

/*Parameters*/
if(isset($_GET['page'])  && $_GET['page']!=NULL) $page=$_GET['page'];
else $page=1;
/*initialize limit clause for pagination*/
$num_rec_per_page=24;/*records per page*/
$start_from = ($page-1) * $num_rec_per_page;/*record to start from*/
$limit=" LIMIT $start_from, $num_rec_per_page";
$userId = $_GET['supplierId'];
/*get all products */
$products = $db->GetSupplierProducts($userId,$limit);
$products_count = 200;
$pages=ceil($products_count/$num_rec_per_page);
$ppages=ceil($pages/5);
if(isset($_GET['pg'])) $pg=$_GET['pg'];
else $pg=1;z
$start = ($pg - 1) * 5;
$offset1 = ($_GET['page'] - 1) * $num_rec_per_page + 1;
$offset2 = $_GET['page'] * $num_rec_per_page;
if($offset2>$products_count) $offset2=$products_count;
 if($pg<=1) $pgp=1;
 else $pgp=$pg-1;
if($pg>=$ppages) $pgn=$ppages;
else $pgn=$pg+1;

?>
<!--begin:: Components/Pagination/Default-->
<div class="kt-portlet col-md-12 kt-mb-5">
  <div class="kt-portlet__body kt-padding-2">

    <!--begin: Pagination-->
    <div class="kt-pagination kt-pagination--brand">
      <ul class="kt-pagination__links">
        <li class="kt-pagination__link--first">
          <a href="javascript:void(0)" onclick="page(1)"><i class="fa fa-angle-double-left kt-font-brand"></i></a>
          <li class="kt-pagination__link--next">
            <a href="javascript:void(0)" onclick="ppg(<?php echo $pgp;?>)"><i class="fa fa-angle-left kt-font-brand"></i></a>
          </li>
        </li>
        <?php
        $count=0;
        for($i=$start+1;$i<=$pages;$i++){
          $count++;
          if($count<=5){
            if($page==$i) echo '<li class="kt-pagination__link--active"><a href="javascript:void(0)" onclick="page('.$i.')">'.$i.'</a></li>';
            else echo '<li><a href="javascript:void(0)" onclick="page('.$i.')">'.$i.'</a></li>';
          }
          else echo '';
        }
         ?>
         <li class="kt-pagination__link--prev">
           <a href="javascript:void(0)" onclick="ppg(<?php echo $pgn;?>)"><i class="fa fa-angle-right kt-font-brand"></i></a>
         </li>
        <li class="kt-pagination__link--last">
          <a href="javascript:void(0)" onclick="page(<?php echo $pages;?>)"><i class="fa fa-angle-double-right kt-font-brand"></i></a>
        </li>
      </ul>
      <div class="kt-pagination__toolbar">
        <span class="pagination__desc">
          <?php echo 'Displaying '.$offset1.' - '.$offset2.' of '.$products_count.' records'; ?>
        </span>
      </div>
    </div>

    <!--end: Pagination-->
  </div>
</div>
<!--end:: Components/Pagination/Default-->
<?php
if($products){
    foreach ($products as $product){

  	echo '<div class="col-xl-2 kt-padding-2"><div class="kt-portlet kt-portlet--height-fluid kt-widget19 kt-mb-0">';
  	echo '<div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">';
  	echo '<div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides thumbnail-" style="background-image: url('.$product['path'].');min-height:120px;background-size: contain;background-position: center;">';
    //echo '<div class="kt-list-pics kt-list-pics--sm kt-widget19__title"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i></div>';
  	//echo '<a href="productdetails.php?productId='.$product['productId'].'"><h3 class="kt-widget19__title kt-font-dark">'.$product['product_name'].'</h3></a>';
  	echo '<div class="kt-widget19__shadow-"></div>';
  	if($product['bestseller']==1){
  		echo '<div class="kt-widget19__labels-brand"><a href="javascript:void(0)" class="btn btn-label-light-o2 btn-bold ">BestSeller</a></div>';
  	}
  	if($product['featured']==1){
  		echo '<div class="kt-widget19__labels-warning"><a href="javascript:void(0)" class="btn btn-label-light-o2 btn-bold ">Featured</a></div>';
  	}
  	echo '</div></div>';
  	echo '<div class="kt-portlet__body kt-padding-2"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">';
  	echo '<div class="kt-widget19__info">';
    echo '<a href="'.DIR_VIEW.DIR_PRO.'productdetails.php?productId='.$product['productId'].'"><h3 class="kt-widget19__title kt-font-dark kt-font-sm">'.$product['name'].'</h3></a>';
    //echo '<div class="kt-list-pics kt-list-pics--sm"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i></div>';
  	//echo '<span><a href="marketplace.php?brand='.$product['brand_name'].'" class="kt-widget19__username">'.$product['brand_name'].'</a>,';
  	//echo '<a href="marketplace.php?brand='.$product['category_name'].'" class="kt-widget19__username">'.$product['category_name'].'</a></span>';
  	//echo '<span class="kt-widget19__time"><a href="marketplace.php?brand='.$product['fullname'].'" class="kt-widget19__username">'.$product['fullname'].'</a>, Min order:'.$product['min_order'].'</span>';
  	echo '</div>';
  	echo '<div class="kt-widget19__stats">';
  	//echo '<span class="kt-widget19__number kt-font-warning">$'.$product['price2'].' - $'.$product['price1'].'</span>';
  	echo '<span class="kt-widget19__number kt-font-dark btn-font-lg">AED '.$product['price2'].'</span>';
  	echo '</div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
 ?>
