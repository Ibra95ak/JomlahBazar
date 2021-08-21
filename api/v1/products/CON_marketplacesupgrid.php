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
$query="SELECT supplier_products.supplierId,users.fullname,users.profile_pic,users.roleId,products.productId,usr_roles.role FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users ON users.userId=supplier_products.supplierId INNER JOIN usr_roles ON users.roleId = usr_roles.roleId ";
$query_count="SELECT COUNT( DISTINCT products.productId) as count FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users ON users.userId=supplier_products.supplierId INNER JOIN usr_roles ON users.roleId = usr_roles.roleId ";
/*initialize where clause*/
$where = " WHERE products.active=1 ";
/*initialize order by clause*/
$orderby="";
$groupby=" GROUP BY supplier_products.supplierId ";
/*Parameters*/
if(isset($_GET['page'])  && $_GET['page']!=NULL) $page=$_GET['page'];
else $page=1;
/*initialize limit clause for pagination*/
$num_rec_per_page=24;/*records per page*/
$start_from = ($page-1) * $num_rec_per_page;/*record to start from*/
$limit=" LIMIT $start_from, $num_rec_per_page";

if(isset($_GET['roleId']) && $_GET['roleId']!=0) $where .= " AND users.roleId = ".$_GET['roleId'];
if(isset($_GET['categoryId'])) $where .= " AND categories.categoryId IN(".$_GET['categoryId'].")";
if(isset($_GET['brandId'])) $where .= " AND brands.brandId IN(".$_GET['brandId'].")";
if(isset($_GET['featured'])) $where.=" AND products.featured=1";
if(isset($_GET['bestseller'])) $where.=" AND products.bestseller=1";
if(isset($_GET['ranking'])) $where .= " AND products.ranking IN(".$_GET['ranking'].")";
if(isset($_GET['generalSearch'])) $where .= " AND users.fullname LIKE '%".$_GET["generalSearch"]."%'";
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
      $sort='asc';
      $field='min_price';
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
if(isset($_GET['min_discount']) && isset($_GET['max_discount'])){
    if($_GET['min_discount']==0 and $_GET['max_discount']==0) $where.="";
    else{
      $where.=" AND min_discount BETWEEN ".$_GET['min_discount']." AND ".$_GET['max_discount'];
    }
}elseif(isset($_GET['min_discount'])){
  if($_GET['min_discount']==0) $where.="";
  else{
    $where.=" AND min_discount >= ".$_GET['min_discount'];
  }
}elseif(isset($_GET['max_discount'])){
  if($_GET['max_discount']==0) $where.="";
  else{
    $where.=" AND min_discount <= ".$_GET['max_discount'];
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
<!--begin:: Components/Pagination/Default-->
<div class="kt-portlet col-md-12 kt-mb-5">
  <div class="kt-portlet__body kt-padding-2">

    <!--begin: Pagination-->
    <div class="kt-pagination kt-pagination--brand">
      <ul class="kt-pagination__links">
        <li class="kt-pagination__link--first">
          <a href="javascript:void(0)" onclick="page(1)"><i class="fa fa-angle-double-left kt-font-brand"></i></a>
          <li class="kt-pagination__link--next">
            <a href="javascript:void(0)" onclick="page(<?php echo $prev;?>)"><i class="fa fa-angle-left kt-font-brand"></i></a>
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
           <a href="javascript:void(0)" onclick="page(<?php echo $next;?>)"><i class="fa fa-angle-right kt-font-brand"></i></a>
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
if($response['products']){
  foreach ($response['products'] as $product){
  	echo '<div class="col-xl-2"><div class="kt-portlet kt-portlet--height-fluid" style="height: 140px;padding: 10px 0;margin-bottom: 5px;"><div class="kt-portlet__body kt-portlet__body--fit-y"><div class="kt-widget kt-widget--user-profile-4"><div class="kt-widget__head"><div class="kt-widget__media"> <img class="kt-widget__img" src="'.$product['profile_pic'].'" alt="image"><div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-hidden">'.substr($product['fullname'],0,2).'</div></div><div class="kt-widget__content"><div class="kt-widget__section"> <div class="row"><div class="col-md-6"><a href="storedetails.php?userId='.$product['supplierId'].'" class="kt-widget__username">'.$product['fullname'].'</a></div><div class="col-md-6"><a href="javascript:void();" class="kt-widget__username kt-font-bolder" onclick="filterrole('.$product['roleId'].')">'.$product['role'].'</a></div></div></div></div></div></div></div></div></div>';
  }
}else echo '<div class="alert alert-dark" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">No records found!</div></div>';
 ?>
