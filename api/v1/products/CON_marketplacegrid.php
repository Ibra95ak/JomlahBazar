<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*Create Product Instance*/
$db = new Ser_Products();
/*response array*/
$response['products']=array();
$response['count']=array();
/*initialize sql query*/
if (isset($_GET['gift'])) {
  $query="SELECT products.productId, products.name as product_name, products.min_price, products.total_quantity, products.moq, products.min_discount, brands.brandId, brands.brand_name as brand_name, categories.categoryId,  categories.name AS category_name, products.description, products.ranking, products.active, products.bestseller, products.featured, product_pictures.path, pro_gifts.available_date, pro_gifts.available_time FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN product_pictures ON products.productId = product_pictures.productId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users on supplier_products.supplierId = users.userId INNER JOIN pro_gifts ON pro_gifts.productId = products.productId ";
  $query_count="SELECT COUNT( DISTINCT products.productId) as count FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN product_pictures ON products.productId = product_pictures.productId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users on supplier_products.supplierId = users.userId INNER JOIN pro_gifts ON pro_gifts.productId = products.productId ";
  /*initialize where clause*/
  $where = " WHERE products.active=1 AND product_pictures.featured=1 AND users.active=1 AND pro_gifts.available_date BETWEEN CURRENT_DATE() AND CURRENT_DATE() AND CAST(TIME_FORMAT(pro_gifts.available_time, '%H:%i') AS TIME)<=CAST(TIME_FORMAT(DATE_ADD(NOW(), INTERVAL 4 HOUR), '%H:%i') AS TIME)  ";
  $orderby=" ORDER BY pro_gifts.available_time DESC ";
}else {
  $query="SELECT products.productId, products.name as product_name, products.min_price, products.total_quantity, products.moq, products.min_discount, brands.brandId, brands.brand_name as brand_name, categories.categoryId,  categories.name AS category_name, products.description, products.ranking, products.active, products.bestseller, products.featured, product_pictures.path FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN product_pictures ON products.productId = product_pictures.productId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users on supplier_products.supplierId = users.userId ";
  $query_count="SELECT COUNT( DISTINCT products.productId) as count FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN product_pictures ON products.productId = product_pictures.productId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users on supplier_products.supplierId = users.userId ";
  /*initialize where clause*/
  $where = " WHERE products.active=1 AND product_pictures.featured=1 AND products.total_quantity!=0 AND users.active=1";
  $orderby="";
}
/*initialize order by clause*/
$groupby=" GROUP BY products.productId";
/*Parameters*/
if(isset($_GET['page'])  && $_GET['page']!=NULL) $page=$_GET['page'];
else $page=1;
/*initialize limit clause for pagination*/
$num_rec_per_page=60;/*records per page*/
$start_from = ($page-1) * $num_rec_per_page;/*record to start from*/
$limit=" LIMIT $start_from, $num_rec_per_page";
if (isset($_GET['gift'])) {
  $limit=" LIMIT 1";
}else {
  $limit=" LIMIT $start_from, $num_rec_per_page";
}

if(isset($_GET['categoryId'])) $where .= " AND categories.categoryId IN(".$_GET['categoryId'].")";
if(isset($_GET['brandId'])) $where .= " AND brands.brandId IN(".$_GET['brandId'].")";
if(isset($_GET['usercompanyId'])){
  $where .= " AND users.usercompanyId IN(".$_GET['usercompanyId'].")";
}
if(isset($_GET['featured']) && isset($_GET['bestseller'])) $where.=" AND (products.featured=1 OR products.bestseller=1)";
else {
  if(isset($_GET['featured'])) $where.=" AND products.featured=1";
  if(isset($_GET['bestseller'])) $where.=" AND products.bestseller=1";
}
if(isset($_GET['discount'])){
  $where.=" AND supplier_products.discount!=0";
}
if(isset($_GET['eid'])){
  $query .= "INNER JOIN pro_events ON products.productId = pro_events.productId ";
  $where.=" AND pro_events.eventId=1";
}
if(isset($_GET['ranking'])) $where .= " AND products.ranking IN(".$_GET['ranking'].")";
if(isset($_GET['generalSearch'])) {
  $keywords= explode(" ",$_GET['generalSearch']);
  foreach ($keywords as $keyword) {
    $keyword = str_replace("'","''",$keyword);
    $where .= " AND products.name LIKE '%".$keyword."%'";
  }
}
if(isset($_GET['fragrancefor'])){
  $query .= "INNER JOIN productdetail_perfumes ON products.productId = productdetail_perfumes.productid ";
  $where .= " AND productdetail_perfumes.fragrancefor =".$_GET['fragrancefor'];
}
if(isset($_GET['arabicscents'])){
  $query .= "INNER JOIN productdetail_perfumes ON products.productId = productdetail_perfumes.productid ";
  $where .= " AND productdetail_perfumes.arabicscents =".$_GET['arabicscents'];
}
if(isset($_GET['luxuryperfume'])){
  $query .= "INNER JOIN productdetail_perfumes ON products.productId = productdetail_perfumes.productid ";
  $where .= " AND productdetail_perfumes.luxuryperfume =".$_GET['luxuryperfume'];
}
if(isset($_GET['tester'])){
  $query .= "INNER JOIN productdetail_perfumes ON products.productId = productdetail_perfumes.productid ";
  $where .= " AND productdetail_perfumes.tester =".$_GET['tester'];
}
if(isset($_GET['giftset'])){
  $query .= "INNER JOIN productdetail_perfumes ON products.productId = productdetail_perfumes.productid ";
  $where .= " AND productdetail_perfumes.giftset =".$_GET['giftset'];
}
if(isset($_GET['order_by'])){
  switch ($_GET['order_by']) {
    case 1:
      $sort='asc';
      $field='product_name';
      break;
    case 2:
      $sort='desc';
      $field='product_name';
      break;
    case 3:
      $sort='desc';
      $field='min_price';
      break;
    case 4:
      $sort='asc';
      $field='min_price';
      break;

    default:
      $sort='desc';
      $field='min_price';
      break;
  }
  if ($orderby=="") {
    $orderby =" ORDER BY ".$field." ".$sort;
  }
}
if(isset($_GET['min_price']) && isset($_GET['max_price'])){
    if($_GET['min_price']==0 and $_GET['max_price']==0) $where.="";
    else{
      $where.=" AND min_price BETWEEN ".$_GET['min_price']." AND ".$_GET['max_price'];
    }
}elseif(isset($_GET['min_price'])){
  if($_GET['min_price']==0) $where.="";
  else{
    $where.=" AND min_price >= ".$_GET['min_price'];
  }
}elseif(isset($_GET['max_price'])){
  if($_GET['max_price']==0) $where.="";
  else{
    $where.=" AND min_price <= ".$_GET['max_price'];
  }
}
/*construct query*/
$sql=$query.$where.$groupby.$orderby.$limit;
$csql=$query_count.$where;
/*get all products */
$products = $db->GetActiveProducts($sql);
if ($products) {
    foreach ($products as $product) {
      array_push($response['products'],$product);
    }
}
$products_count = $db->countProducts($csql)['count'];
$pages=ceil($products_count/$num_rec_per_page);
$ppages=ceil($pages/5);
if(isset($_GET['pg'])) $pg=$_GET['pg'];
else $pg=1;
$start = ($pg - 1) * 5;
$offset1 = ($_GET['page'] - 1) * $num_rec_per_page + 1;
$offset2 = $_GET['page'] * $num_rec_per_page;
if($offset2>$products_count) $offset2=$products_count;
 if($pg<=1) $pgp=1;
 else $pgp=$pg-1;
if($pg>=$ppages) $pgn=$ppages;
else $pgn=$pg+1;
if($page+1>0 && $page+1<=$pages) $next = $page+1;
else $next = $pages;
if($page-1>0 && $page-1<=$pages) $prev = $page-1;
else $prev = 1;
?>
<div class="kt-portlet kt-mb-5">
  <div class="kt-portlet__body kt-padding-2">

    <!--begin: Pagination-->
    <div class="kt-pagination kt-pagination--dark kt-m5" style="margin-bottom: 13px !important;">
      <div class="kt-pagination__toolbar">
      </div>
      <ul class="kt-pagination__links">
        <li class="kt-pagination__link--first">
          <a href="javascript:void(0)" onclick="page(1)"><i class="fa fa-angle-double-left kt-font-dark"></i></a>
          <li class="kt-pagination__link--next">
            <a href="javascript:void(0)" onclick="page(<?php echo $prev;?>)"><i class="fa fa-angle-left kt-font-dark"></i></a>
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
           <a href="javascript:void(0)" onclick="page(<?php echo $next;?>)"><i class="fa fa-angle-right kt-font-dark"></i></a>
         </li>
        <li class="kt-pagination__link--last">
          <a href="javascript:void(0)" onclick="page(<?php echo $pages;?>)"><i class="fa fa-angle-double-right kt-font-dark"></i></a>
        </li>
        <li class="transparent-bg"><span class="pagination__desc kt-font-dark" style="font-size: 10px;margin-left: 10px;">
          <?php echo 'Displaying '.$offset1.' - '.$offset2.' of '.$products_count.' records'; ?>
        </span></li>
      </ul>
    </div>

    <!--end: Pagination-->
  </div>
</div>
<!--end:: Components/Pagination/Default-->
<div class="row safari-row-flex">
<?php
if($response['products']){
  foreach ($response['products'] as $product){
    if($product['total_quantity'] == 0){
      $totalquantity = "Out of stock";
      $ribboncolor = "secondary";
    }
    else{
      $totalquantity = "Qty ".$product['total_quantity'];
      $ribboncolor = "warning";
    }
    if (!isset($_GET['gift'])) {
      echo '<a href="'.DIR_VIEW.DIR_PRO.'productdetails.php?productId='.$product['productId'].'">';
    	echo '<div class="col-xl-3 kt-padding-2 max-width-20 max-width-50"><div class="kt-portlet kt-portlet--height-fluid kt-widget19 kt-mb-0">';
    	echo '<div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">';
    	echo '<div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides kt-ribbon kt-ribbon--shadow kt-ribbon--right kt-ribbon--'.$ribboncolor.'" style="background-image: url('.$product['path'].');min-height:250px;background-size: contain;background-position: center;">';
    	echo '<div class="kt-widget19__shadow-"></div>';
      if(isset($_GET['eid'])){
    		echo '<div class="kt-widget19__labels-brand" style="margin-bottom: -4px;"><img src="'.DIR_ICON.'ramadanlimitedtimeoffer.png" width="100" style="margin-top: -6px;"/></div>';
    	}
    	if($product['featured']==1){
    		echo '<div class="kt-widget19__labels-warning" style="margin-bottom: -4px;"><img src="'.DIR_ICON.'featured.png" width="100" style="margin-top: -6px;"/></div>';
    	}
      if($product['bestseller']==1){
    		echo '<div class="kt-widget19__labels-brand" style="margin-bottom: -4px;"><img src="'.DIR_ICON.'bestseller.png" width="100" style="margin-top: -6px;"/></div>';
    	}
      if ($product['min_discount']<$product['min_price'] && $product['min_discount']!=0) {
        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 20px; right: -2px;text-align: right;background-color: #e1dfd6;"><h3 class="kt-m0"><s>AED '.number_format($product['min_price']+($product['min_price']*0.05),2).'</s></h3></div>';
        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.$product['min_discount'].'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
      }else {
        echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.number_format($product['min_price']+($product['min_price']*0.05),2).'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
      }
    	echo '</div></div>';
    	echo '<div class="kt-portlet__body kt-padding-2"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">';
    	echo '<div class="kt-widget19__info">';
      echo '<h3 class="kt-widget19__title kt-font-dark kt-font-sm">'.$product['product_name'].'</h3>';
      if ($product['total_quantity']==0) {
        echo '<h3 class="kt-widget19__title kt-font-danger kt-font-md kt-font-bolder">Sold Out</h3>';
      }
    	echo '</div>';
    	echo '<div class="kt-widget19__stats kt-ml-10 kt-mr-10">';
    	echo '<span class="kt-widget19__number kt-font-dark btn-font-lg">MOQ '.$product['moq'].'</span>';
    	echo '</a></div></div></div></div></div></div>';
    }elseif (isset($_GET['gift'])) {
      if ($product['total_quantity']==0) {
        echo '<a href="javascript:void(0)">';
      }else {
        echo '<a href="'.DIR_VIEW.DIR_PRO.'productdetails.php?productId='.$product['productId'].'">';
      }
      	echo '<div class="col-xl-3 kt-padding-2 max-width-20 max-width-50"><div class="kt-portlet kt-portlet--height-fluid kt-widget19 kt-mb-0">';
      	echo '<div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">';
      	echo '<div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides kt-ribbon kt-ribbon--shadow kt-ribbon--right kt-ribbon--'.$ribboncolor.'" style="background-image: url('.$product['path'].');min-height:250px;background-size: contain;background-position: center;">';
      	echo '<div class="kt-widget19__shadow-"></div>';
        if(isset($_GET['eid'])){
      		echo '<div class="kt-widget19__labels-brand" style="margin-bottom: -4px;"><img src="'.DIR_ICON.'ramadanlimitedtimeoffer.png" width="100" style="margin-top: -6px;"/></div>';
      	}
      	if($product['featured']==1){
      		echo '<div class="kt-widget19__labels-warning" style="margin-bottom: -4px;"><img src="'.DIR_ICON.'featured.png" width="100" style="margin-top: -6px;"/></div>';
      	}
        if($product['bestseller']==1){
      		echo '<div class="kt-widget19__labels-brand" style="margin-bottom: -4px;"><img src="'.DIR_ICON.'bestseller.png" width="100" style="margin-top: -6px;"/></div>';
      	}
        if ($product['min_discount']<$product['min_price'] && $product['min_discount']!=0) {
          echo '<div class="kt-ribbon__target kt-padding-2" style="top: 20px; right: -2px;text-align: right;background-color: #e1dfd6;"><h3 class="kt-m0"><s>AED '.number_format($product['min_price']+($product['min_price']*0.05),2).'</s></h3></div>';
          echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.$product['min_discount'].'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
        }else {
          echo '<div class="kt-ribbon__target kt-padding-2" style="top: 0; right: -2px;text-align: right;"><h3 class="kt-m0">AED '.number_format($product['min_price']+($product['min_price']*0.05),2).'<br><span class="kt-font-sm kt-hidden">'.$totalquantity.'</span></h3></div>';
        }
      	echo '</div></div>';
      	echo '<div class="kt-portlet__body kt-padding-2"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">';
      	echo '<div class="kt-widget19__info">';
        echo '<h3 class="kt-widget19__title kt-font-dark kt-font-sm">'.$product['product_name'].'</h3>';
        if ($product['total_quantity']==0) {
          echo '<h3 class="kt-widget19__title kt-font-danger kt-font-md kt-font-bolder">Sold Out</h3>';
        }
      	echo '</div>';
      	echo '<div class="kt-widget19__stats kt-ml-10 kt-mr-10">';
      	echo '<span class="kt-widget19__number kt-font-dark btn-font-lg">MOQ '.$product['moq'].'</span>';
      	echo '</a></div></div></div></div></div></div>';
    }
  }
}else echo '<div class="alert alert-light" role="alert"><div class="alert-text"><span class="kt-font-bolder kt-font-lg">Currently we do not have this product, wait for update and check regularly!😊</span></div></div>';
 ?>
 </div>
 <div class="kt-portlet  kt-mb-5">
   <div class="kt-portlet__body kt-padding-2">
     <!--begin: Pagination-->
     <div class="kt-pagination kt-pagination--dark kt-m5" style="margin-bottom: 13px !important;">
       <div class="kt-pagination__toolbar">
       </div>
       <ul class="kt-pagination__links">
         <li class="kt-pagination__link--first">
           <a href="javascript:void(0)" onclick="page(1)"><i class="fa fa-angle-double-left kt-font-dark"></i></a>
           <li class="kt-pagination__link--next">
             <a href="javascript:void(0)" onclick="page(<?php echo $prev;?>)"><i class="fa fa-angle-left kt-font-dark"></i></a>
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
            <a href="javascript:void(0)" onclick="page(<?php echo $next;?>)"><i class="fa fa-angle-right kt-font-dark"></i></a>
          </li>
         <li class="kt-pagination__link--last">
           <a href="javascript:void(0)" onclick="page(<?php echo $pages;?>)"><i class="fa fa-angle-double-right kt-font-dark"></i></a>
         </li>
         <li class="transparent-bg"><span class="pagination__desc kt-font-dark" style="font-size: 10px;margin-left: 10px;">
           <?php echo 'Displaying '.$offset1.' - '.$offset2.' of '.$products_count.' records'; ?>
         </span></li>
       </ul>
     </div>

     <!--end: Pagination-->
   </div>
 </div>
 <!--end:: Components/Pagination/Default-->
