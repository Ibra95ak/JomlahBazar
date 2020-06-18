<?php
/*get brand class*/
require_once '../../libraries/Ser_Brands.php';
/*create brand instance*/
$db = new Ser_Brands();
/*results array*/
$results['records']=array();
$results['count']=array();
/*initialize sql query*/
$query="SELECT brands.brandId, brands.brand_name, brands.path FROM brands";
$cquery="SELECT COUNT(brands.brandId) AS count FROM brands";
/*initialize where clause*/
$where=" WHERE brands.active=1";
/*initialize order by clause*/
$orderby="";
/*parameters*/
if(isset($_GET['page'])  && $_GET['page']!=NULL) $page=$_GET['page'];
else $page=1;
/*initialize limit clause for pagination*/
$num_rec_per_page=8;/*records per page*/
$start_from = ($page-1) * $num_rec_per_page;/*record to start from*/
$limit=" LIMIT $start_from, $num_rec_per_page";

if(isset($_GET['search'])  && $_GET['search']!=NULL){
  $where.=" AND brands.brand_name LIKE '%".$_GET['search']."%'";
}
if(isset($_GET['order_by'])){
    switch ($_GET['order_by']) {
      case 1:
        $orderby.=" ORDER BY brands.brand_name ASC";
        break;
      case 2:
        $orderby.=" ORDER BY brands.brand_name DESC";
        break;
      default:
        $orderby.="";
    }
}
if(isset($_GET['filter_category']) && $_GET['filter_category']!=0){
  $query.=" INNER JOIN categories ON brands.brandcategoryId=categories.categoryId";
  $cquery.=" INNER JOIN categories ON brands.brandcategoryId=categories.categoryId";
  $where.=" AND categories.categoryId=".$_GET['filter_category'];
}
/*construct query*/
$sql=$query.$where.$limit.$orderby;
$csql=$cquery.$where;
/*get brands*/
$get_brands = $db->searchbrands($sql);
/*get total brand count*/
$count = $db->countbrands($csql);
array_push($results['count'],$count);
if($get_brands){
    foreach($get_brands as $brand){
        array_push($results['records'],$brand);
    }
}
echo json_encode(array($results['count'],$results['records']));
?>
