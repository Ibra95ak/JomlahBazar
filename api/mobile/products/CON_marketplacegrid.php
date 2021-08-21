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
$query="SELECT products.productId, products.name as product_name, products.min_price, products.total_quantity, products.moq, brands.brandId, brands.brand_name as brand_name, categories.categoryId,  categories.name AS category_name, products.description, products.ranking, products.active, products.bestseller, products.featured, product_pictures.path FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN product_pictures ON products.productId = product_pictures.productId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users on supplier_products.supplierId = users.userId ";
$query_count="SELECT COUNT( DISTINCT products.productId) as count FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN product_pictures ON products.productId = product_pictures.productId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users on supplier_products.supplierId = users.userId ";
/*initialize where clause*/
$where = " WHERE products.active=1 AND product_pictures.featured=1 AND products.total_quantity!=0 AND users.active=1";
/*initialize order by clause*/
$orderby="";
$groupby=" GROUP BY products.productId";
/*Parameters*/
if(isset($_GET['page'])  && $_GET['page']!=NULL) $page=$_GET['page'];
else $page=1;
/*initialize limit clause for pagination*/
$num_rec_per_page=60;/*records per page*/
$start_from = ($page-1) * $num_rec_per_page;/*record to start from*/
$limit=" LIMIT $start_from, $num_rec_per_page";

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
 if(isset($_GET['demandId'])){
  $query.="INNER JOIN pro_demands ON products.productId = pro_demands.productId ";
  $where.=" AND pro_demands.demandId=".$_GET['demandId'];
}
if(isset($_GET['eventId'])){
  $query.="INNER JOIN pro_events ON products.productId = pro_events.productId ";
  $where.=" AND pro_events.eventId=".$_GET['eventId'];
}
if(isset($_GET['ranking'])) $where .= " AND products.ranking IN(".$_GET['ranking'].")";
if(isset($_GET['generalSearch'])) {
  $keywords= explode(" ",$_GET['generalSearch']);
  foreach ($keywords as $keyword) {
    $where .= " AND products.name LIKE '%".$keyword."%'";
  }
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
// $filter_cities=array();
// if(isset($_GET['loc1'])) array_push($filter_cities,'Dubai');
// if(isset($_GET['loc2'])) array_push($filter_cities,'Abu Dhabi');
// if(isset($_GET['loc3'])) array_push($filter_cities,'Ajman');
// if(isset($_GET['loc4'])) array_push($filter_cities,'Fujairah');
// if(isset($_GET['loc5'])) array_push($filter_cities,'Ras al Khaimah');
// if(isset($_GET['loc6'])) array_push($filter_cities,'Sharjah');
// if(isset($_GET['loc7'])) array_push($filter_cities,'Umm al Quwain');
// $cities="'".implode("', '", $filter_cities)."'";
// if($cities!="''") $where.=" AND address.city IN (".$cities.")";
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
echo json_encode($response);
?>
