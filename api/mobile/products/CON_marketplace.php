<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*Create products instance*/
$db = new Ser_Products();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['products']=array();
$response['cheapestsupplier']=array();
$response['productdetails']=array();
/*URL parameters*/
$action=$_GET['action'];
$query="SELECT products.productId, products.name as product_name, brands.brandId, brands.brand_name as brand_name, categories.categoryId,  categories.name AS category_name, products.description, products.ranking, products.active, products.bestseller, products.featured, product_pictures.path FROM products INNER JOIN brands ON products.brandId = brands.brandId INNER JOIN categories ON products.categoryId = categories.categoryId INNER JOIN product_pictures ON products.productId = product_pictures.productId WHERE products.active=1 AND product_pictures.featured=1";
if(isset($_GET['productId'])) $productId=$_GET['productId'];
else {
  $productId=0;
}
if ($action=='get') {
  if($productId!=0){
    $response['products'] = $db->GetproductById($productId);
    switch ($response['products']['detailstype']) {
      case 1:
        $table_name='productdetail_care';
        break;
      case 2:
        $table_name='productdetail_cosmetics';
        break;
      case 3:
        $table_name='productdetail_grocery';
        break;
      case 4:
        $table_name='productdetail_perfumes';
        break;
      case 5:
        $table_name='productdetail_careappliances';
        break;
      case 6:
        $table_name='productdetail_desktop';
        break;

      default:
        $table_name='productdetail_care';
        break;
    }
    $response['productdetails'] = $db->GetproductdetailById($productId,$table_name);
    $response['productpics'] = $db->GetProductPics($productId);
    $response['cheapestsupplier'] = $db->GetCheapestSupplier($productId);
    $response['err']=0;
    echo json_encode($response);
  }else{
    /*get all products*/
    $products = $db->GetActiveProducts($query);

    if ($products) {
        foreach ($products as $product) {
          $arr_merge=array();
          $cheapestsupplier = $db->GetCheapestSupplier($product['productId']);
          $arr_merge=array_merge($product,(array)$cheapestsupplier);
          array_push($response['products'],$arr_merge);
        }
    }
    $fp = fopen('../json/marketplace.json', 'w');
    fwrite($fp, json_encode($response['products']));
    fclose($fp);
  }
}
if ($action=='post') {

    $brandId=$_POST['brandId'];
    $categoryId=$_POST['categoryId'];
    if(isset($_POST['subcategoryId'])) $subcategoryId=$_POST['subcategoryId'];
    else $subcategoryId=0;
    $name=$_POST['name'];
    $description=$_POST['description'];
    if(isset($_POST['barcode'])) $barcode=$_POST['barcode'];
    else $barcode=NULL;
    if(isset($_POST['asin'])) $asin=$_POST['asin'];
    else $asin=NULL;
    if (isset($_POST['active'])) $active=1;
    else $active=2;
    if(isset($_POST['size1'])) $size=$_POST['size1'];
    elseif(isset($_POST['size2'])) $size=$_POST['size2'];
    else $size=NULL;
    if(isset($_POST['count'])) $count=$_POST['count'];
    else $count=NULL;
    if(isset($_POST['ingredients1'])) $ingredients=$_POST['ingredients1'];
    elseif(isset($_POST['ingredients2'])) $ingredients=$_POST['ingredients2'];
    else $ingredients=NULL;
    if(isset($_POST['highlights1'])) $highlights=$_POST['highlights1'];
    elseif(isset($_POST['highlights2'])) $highlights=$_POST['highlights2'];
    else $highlights=NULL;
    if(isset($_POST['women'])) $formen_women=1;
    elseif(isset($_POST['men'])) $formen_women=2;
    else $formen_women=3;
    if(isset($_POST['hair_skintypes'])) $hair_skintypes=$_POST['hair_skintypes'];
    else $hair_skintypes=NULL;
    if(isset($_POST['path'])) $path='assets/media/products/'.$_POST['path'];
    else $path='assets/media/products/default.jpg';

    if($productId!=0){
      // if($target_dir==$target_file){
      //   $icon=$db->GetproductById($productId)['icon'];
      // }
      /*edit product info*/
      $product = $db->editProduct($productId, $brandId, $categoryId, $subcategoryId, $name, $asin, $barcode, $asin, $ranking, $blockId, $active, $bestseller, $featured);
      if($product) $response['err']=0;
      else $response['err']=1;
    }else {
      /*add new product*/
      $product = $db->addProduct($brandId, $categoryId, $subcategoryId, $name, $description, $barcode, $asin);
      $productdetails = $db->AddProductdetails1($product['insertId'], $size, $count, $ingredients, $highlights, $formen_women, $hair_skintypes);
      $productfeaturedpic = $db->AddFeaturedPic($product['insertId'], $path);
      if($product) $response['err']=0;
      else $response['err']=3;
    }
    echo json_encode($response);
}
if ($action=='delete') {
  /*delete product*/
  $product = $db->DeleteproductById($productId);
  if ($product) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
  header("location:".DIR_VIEW.DIR_PRO."dt_products.php?err=".$response['err']);
}
