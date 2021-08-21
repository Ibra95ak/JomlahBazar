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
/*initialize sql query*/
$query="SELECT supplier_products.productId, products.bestseller, products.featured, product_pictures.path, products.name, supplier_products.selling_price FROM supplier_products INNER JOIN products ON supplier_products.productId = products.productId INNER JOIN product_pictures ON product_pictures.productId = products.productId INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId ";
$query_count="SELECT COUNT( DISTINCT products.productId) as count_pro FROM supplier_products INNER JOIN products ON supplier_products.productId = products.productId INNER JOIN product_pictures ON product_pictures.productId = products.productId INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId ";
/*initialize where clause*/
$where = " WHERE supplier_products.supplierId=".$userId." and product_pictures.featured=1 and products.active=1 AND supplier_products.quantity!=0 ";
/*initialize order by clause*/
$orderby="";
$groupby=" GROUP BY products.productId";
/*Parameters*/
if(isset($_GET['page'])  && $_GET['page']!=NULL) $page=$_GET['page'];
else $page=1;
/*initialize limit clause for pagination*/
$num_rec_per_page=24;/*records per page*/
$start_from = ($page-1) * $num_rec_per_page;/*record to start from*/
$limit=" LIMIT $start_from, $num_rec_per_page";

if(isset($_GET['categoryId'])) $where .= " AND categories.categoryId IN(".$_GET['categoryId'].")";
if(isset($_GET['brandId'])) $where .= " AND brands.brandId IN(".$_GET['brandId'].")";
if(isset($_GET['featured'])) $where.=" AND products.featured=1";
if(isset($_GET['bestseller'])) $where.=" AND products.bestseller=1";
if(isset($_GET['discount'])) $where.=" AND supplier_products.discount!=0";
if(isset($_GET['demandId'])){
  $query.="INNER JOIN pro_demands ON products.productId = pro_demands.productId ";
  $where.=" AND pro_demands.demandId=".$_GET['demandId'];
}
if(isset($_GET['eventId'])){
  $query.="INNER JOIN pro_events ON products.productId = pro_events.productId ";
  $where.=" AND pro_events.eventId=".$_GET['eventId'];
}
if(isset($_GET['ranking'])) $where .= " AND products.ranking IN(".$_GET['ranking'].")";
if(isset($_GET['generalSearch'])) $where .= " AND products.name LIKE '%".$_GET["generalSearch"]."%'";
if(isset($_GET['order_by'])){
  switch ($_GET['order_by']) {
    case 1:
      $sort='asc';
      $field='products.name';
      break;
    case 2:
      $sort='desc';
      $field='products.name';
      break;
    case 3:
      $sort='desc';
      $field='supplier_products.selling_price';
      break;
    case 4:
      $sort='asc';
      $field='supplier_products.selling_price';
      break;

    default:
      $sort='asc';
      $field='supplier_products.selling_price';
      break;
  }
  $orderby =" ORDER BY ".$field." ".$sort;
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
$filter_cities=array();
if(isset($_GET['loc1'])) array_push($filter_cities,'Dubai');
if(isset($_GET['loc2'])) array_push($filter_cities,'Abu Dhabi');
if(isset($_GET['loc3'])) array_push($filter_cities,'Ajman');
if(isset($_GET['loc4'])) array_push($filter_cities,'Fujairah');
if(isset($_GET['loc5'])) array_push($filter_cities,'Ras al Khaimah');
if(isset($_GET['loc6'])) array_push($filter_cities,'Sharjah');
if(isset($_GET['loc7'])) array_push($filter_cities,'Umm al Quwain');
$cities="'".implode("', '", $filter_cities)."'";
if($cities!="''") $where.=" AND address.city IN (".$cities.")";
/*construct query*/
$sql=$query.$where.$groupby.$orderby.$limit;
$csql=$query_count.$where;
/*get all products */
$products = $db->GetSupplierProducts($sql);
$products_count = $db->countSupplierProducts($csql)['count_pro'];
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
<div class="kt-portlet col-md-12 kt-mb-5">
  <div class="kt-portlet__body kt-padding-2">

    <!--begin: Pagination-->
    <div class="kt-pagination kt-pagination--dark kt-m10" style="margin-bottom: 13px !important;">
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
        <li><span class="pagination__desc kt-font-dark" style="font-size: 10px;margin-left: 10px;">
          <?php echo 'Displaying '.$offset1.' - '.$offset2.' of '.$products_count.' records'; ?>
        </span></li>
      </ul>
    </div>

    <!--end: Pagination-->
  </div>
</div>
<!--end:: Components/Pagination/Default-->
<?php
if($products){
    foreach ($products as $product){
      $selling_price = $product['selling_price']+($product['selling_price']*0.05);
      echo '<div class="col-xl-2 kt-padding-2"><div class="kt-portlet kt-portlet--height-fluid kt-widget19 kt-mb-0">';
      echo '<div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">';
      echo '<div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides thumbnail-" style="background-image: url('.$product['path'].');min-height:120px;background-size: contain;background-position: center;">';
      echo '<div class="kt-widget19__shadow-"></div>';
      if($product['bestseller']==1){
        echo '<div class="kt-widget19__labels-brand"><img src="'.DIR_ICON.'bestseller.png" width="100"/></div>';
      }
      if($product['featured']==1){
        echo '<div class="kt-widget19__labels-warning"><img src="'.DIR_ICON.'featured.png" width="100"/></div>';
      }
      echo '</div></div>';
      echo '<div class="kt-portlet__body kt-padding-2"><div class="kt-widget19__wrapper"><div class="kt-widget19__content">';
      echo '<div class="kt-widget19__info">';
      echo '<a href="'.DIR_VIEW.DIR_PRO.'productdetails.php?productId='.$product['productId'].'"><h3 class="kt-widget19__title kt-font-dark kt-font-sm">'.$product['name'].'</h3></a>';
      echo '</div>';
      echo '<div class="kt-widget19__stats">';
      echo '<span class="kt-widget19__number kt-font-dark btn-font-lg">AED '.$selling_price.'</span>';
      echo '</div></div></div></div></div></div>';
      }
      }else echo '<div class="alert alert-light" role="alert"><div class="alert-text"><span class="kt-font-bolder kt-font-lg">No Items Matched!</span><br><span class="kt-font-md kt-font-dark">Try checking again 😊.</span></div></div>';
      ?>
