<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call products class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*Create products instance*/
$db = new Ser_Products();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['products']=array();
$response['count']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['supplierId'])) $supplierId=$_GET['supplierId'];
else {
  $supplierId=0;
}
if ($action=="get") {
  /*initialize sql query*/
  $query="SELECT supplier_products.productId, products.bestseller, products.featured, product_pictures.path, products.name, supplier_products.selling_price FROM supplier_products INNER JOIN products ON supplier_products.productId = products.productId INNER JOIN product_pictures ON product_pictures.productId = products.productId INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId ";
  $query_count="SELECT COUNT( DISTINCT products.productId) as count_pro FROM supplier_products INNER JOIN products ON supplier_products.productId = products.productId INNER JOIN product_pictures ON product_pictures.productId = products.productId INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId ";
  /*initialize where clause*/
  $where = " WHERE supplier_products.supplierId=".$supplierId." and product_pictures.featured=1";
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
  $products = $db->GetSupplierProducts($sql);
  $products_count = $db->countSupplierProducts($csql)['count_pro'];
  $response['err']=0;
  array_push($response['products'],$products);
  echo json_encode($response);

}

if ($action=='get_inventory') {
  if($supplierId!=0){
    $response['products'] = $db->GetProductsBySupplierId($supplierId);
    echo json_encode($response);
  }else{
    $response['err']=1;
  }
}
?>
