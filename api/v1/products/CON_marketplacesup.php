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
$query="SELECT supplier_products.supplierId,users.fullname,users.profile_pic,users.roleId,products.productId,usr_roles.role,address.latitude,address.longitude,usr_company.companyname FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users ON users.userId=supplier_products.supplierId INNER JOIN usr_roles ON users.roleId = usr_roles.roleId INNER JOIN usr_company ON users.usercompanyId = usr_company.usercompanyId ";
$query_count="SELECT COUNT( DISTINCT products.productId) as count FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId INNER JOIN users ON users.userId=supplier_products.supplierId INNER JOIN usr_roles ON users.roleId = usr_roles.roleId INNER JOIN usr_company ON users.usercompanyId = usr_company.usercompanyId ";
/*initialize where clause*/
$where = " WHERE products.active=1 ";
/*initialize order by clause*/
$orderby="";
$groupby=" GROUP BY supplier_products.supplierId ";
/*Parameters*/
if(isset($_GET['roleId']) && $_GET['roleId']!=0) $where .= " AND users.roleId = ".$_GET['roleId'];
if(isset($_GET['categoryId'])) $where .= " AND categories.categoryId IN(".$_GET['categoryId'].")";
if(isset($_GET['brandId'])) $where .= " AND brands.brandId IN(".$_GET['brandId'].")";
if(isset($_GET['featured'])) $where.=" AND products.featured=1";
if(isset($_GET['bestseller'])) $where.=" AND products.bestseller=1";
if(isset($_GET['ranking'])) $where .= " AND products.ranking IN(".$_GET['ranking'].")";
if(isset($_GET['usercompanyId'])) $where .= " AND users.usercompanyId IN(".$_GET['usercompanyId'].")";
if(isset($_GET['generalSearch'])) $where .= " AND products.name LIKE '%".$_GET["generalSearch"]."%'";
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
$sql=$query.$where.$groupby.$orderby;
$csql=$query_count.$where;
/*get all products */
$products = $db->GetActiveProducts($sql);
if ($products) {
    foreach ($products as $product) {
      array_push($response['products'],$product);
    }
}
$products_count = $db->countProducts($csql)['count'];
echo json_encode($response);
?>
