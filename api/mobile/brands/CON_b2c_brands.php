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
$query="SELECT products.productId, products.name as product_name, brands.brandId, brands.brand_name as brand_name, categories.categoryId,  categories.name AS category_name, products.description, products.ranking, products.active, products.bestseller, products.featured, product_pictures.path FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN product_pictures ON products.productId = product_pictures.productId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId ";
$query_count="SELECT COUNT(products.productId) as count FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN product_pictures ON products.productId = product_pictures.productId INNER JOIN supplier_products ON supplier_products.productId = products.productId INNER JOIN address on address.userId = supplier_products.supplierId ";
/*initialize where clause*/
$where = " WHERE products.active=1 AND product_pictures.featured=1";
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
if(isset($_GET['ranking'])) $where .= " AND products.ranking IN(".$_GET['ranking'].")";
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
$sql=$query.$where.$groupby.$orderby.$limit;
$csql=$query_count.$where;
/*get all products */
$products = $db->GetActiveProducts($sql);
if ($products) {
    foreach ($products as $product) {
      $arr_merge=array();
      $cheapestsupplier = $db->GetCheapestSupplier($product['productId']);
      $arr_merge=array_merge($product,$cheapestsupplier);
      array_push($response['products'],$arr_merge);
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
?>
<div class="col-lg-10 col-md-12">
    <div class="row">
      <div class="col-12 text-center">
          <nav aria-label="Page navigation example">
              <ul class="pagination pagination-template d-flex justify-content-center float-none">
                  <li class="page-item"><a href="javascript:void(0)" onclick="page(1)" class="page-link"> <i class="fa fa-angle-double-left"></i></a></li>
                  <li class="page-item"><a href="javascript:void(0)" onclick="ppg(<?php echo $pgp;?>)" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
                  <?php
                  $count=0;
                  for($i=$start+1;$i<=$pages;$i++){
                    $count++;
                    if($count<=5){
                      if($page==$i) echo '<li class="page-item"><a href="javascript:void(0)" onclick="page('.$i.')" class="page-link active">'.$i.'</a></li>';
                      else echo '<li class="page-item"><a href="javascript:void(0)" onclick="page('.$i.')" class="page-link">'.$i.'</a></li>';
                    }
                    else echo '';
                  }
                   ?>
                  <li class="page-item"><a href="javascript:void(0)" onclick="ppg(<?php echo $pgn;?>)" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
                  <li class="page-item"><a href="javascript:void(0)" onclick="page(<?php echo $pages;?>)" class="page-link"> <i class="fa fa-angle-double-right"></i></a></li>
              </ul>
          </nav>
      </div>
        <div class="col-12">
            <div class="clearfix"></div>
            <div class="row">
                <?php
if($response['products']){
foreach($response['products'] as $product){
echo '<div class="col-lg-3 col-md-4 col-sm-6 product-card-col">';
echo '<div class="product product-card">';
echo '<a class="product-img" href="single_product.php?productId='.$product['productId'].'"><img src="../'.$product['path'].'" alt=""></a>';
echo '<h2><a><span class="product-title">'.$product['product_name'].'</span></a></h2>';
echo '<div class="row m-0 list-n">';
echo '<div class="col-lg-12 p-0">';
echo '<div class="single-product-price">';
echo '<span class="a-price" data-a-size="l" data-a-color="base"><span class="price-dollar">$</span><span class="price-digit">'.$product['price2'].'</span><span class="price-fraction"></span></span>';
echo '</div></div></div></div></div>';
}
}
?>
</div>
