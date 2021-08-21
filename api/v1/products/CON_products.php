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
$response['product_pricing']=array();
$response['products_name']=array();
$response['productdetails']=array();
$response['productpics']=array();
$response['productqty']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['productId'])) $productId=$_GET['productId'];
else {
  $productId=0;
}
if(isset($_GET['supplierId'])) $supplierId=$_GET['supplierId'];
else {
  $supplierId=0;
}
if ($action=='get') {
  if($productId!=0){
    $response['products'] = $db->GetproductById($productId);
    switch ($response['products']['maincategoryId']) {
      case 1:
        $table_name='productdetail_grocery';
        break;
      case 2:
        $table_name='productdetail_perfumes';
        break;
      case 3:
        $table_name='productdetail_cosmetics';
        break;
      case 4:
        $table_name='productdetail_care';
        break;
      case 5:
        $table_name='productdetail_grocery';
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
    $response['productqty'] = $db->GetProductTotalQty($productId);
    $response['err']=0;
    echo json_encode($response);
  }else{
    /*get all products*/
    $products = $db->GetAllProducts();

    if ($products) {
        foreach ($products as $product) {
            array_push($response['products'], $product);
        }
    }
    $fp = fopen('../json/products.json', 'w');
    fwrite($fp, json_encode($response['products']));
    fclose($fp);
    echo json_encode($response['products']);
  }
}
if ($action=='get-names') {
  $products_name = $db->getActiveProductNames();
  if ($products_name) {
      foreach ($products_name as $product_name) {
          array_push($response['products_name'], $product_name);
      }
  }
  echo json_encode($response);
}
if ($action=='get-suppro') {
  $response['product_pricing']= $db->GetSupplierProductPrice($productId,$supplierId);
  echo json_encode($response);
}
if ($action=='post') {
  $supplierId=$_POST['supplierId'];
  $name=$_POST['name'];
  $maincategoryId=$_POST['maincategoryId'];
  $categoryId=$_POST['categoryId'];
  $subcategoryId=0;
  $brandId=$_POST['brandId'];
  $description=$_POST['description'];
  if(isset($_POST['asin'])) $asin=$_POST['asin'];
  else $asin=NULL;
  if(isset($_POST['barcode'])) $barcode=$_POST['barcode'];
  else $barcode=NULL;
  if(isset($_POST['coo'])) $countryoforigin=$_POST['coo'];
  else $countryoforigin=NULL;
  $weight=$_POST['weight'];
  $width=$_POST['width'];
  $length=$_POST['length'];
  $height=$_POST['height'];
  $palette=$_POST['palette'];
  $carton=$_POST['carton'];
  $pack=$_POST['pack'];
  $piece=$_POST['piece'];
  $featured_path="assets/media/products/".str_replace(' ', '', $_POST['featured_path']);
  $paths=explode(",",str_replace(' ', '', $_POST['path']));
    if($productId!=0){
      /*edit product info*/
      $product = $db->editProduct($productId, $brandId, $categoryId, $subcategoryId, $name, $asin, $barcode, $asin, $ranking, $blockId, $active, $bestseller, $featured);
      if($product) $response['err']=0;
      else $response['err']=1;
    }else{
      /*add new product*/
      $product = $db->addProduct($maincategoryId, $brandId, $categoryId, $subcategoryId, $name, $description, $barcode, $asin, $countryoforigin, $weight, $width, $length, $height, $palette, $carton, $pack, $piece);
      $productId = $product['insertId'];
      $product_fimg = $db->AddProductPic($productId, $featured_path, 1);
      if ($_POST['path'] && $_POST['path']!='') {
        foreach ($paths as $path) {
          $db->AddProductPic($productId, "assets/media/products/".$path, 2);
        }
      }
      switch ($maincategoryId) {
        case '1':
        case '5':
          $size = $_POST['food_size'];
          $ingredients = $_POST['food_ingredients'];
          $highlights = $_POST['food_highlights'];
          $packageinformation = $_POST['packageinformation'];
          $manufacturer = $_POST['manufacturer'];
          $product = $db->AddProductdetailsFood($productId, $size, $ingredients, $highlights, $packageinformation, $manufacturer);
          break;
        case '2':
        $size = $_POST['perfume_size'];
        $fragrancefor = $_POST['fragrancefor'];
        $scenttype = $_POST['scenttype'];
        $topnotes = $_POST['topnotes'];
        if (isset($_POST['arabicscents'])) $arabicscents=1;
        else $arabicscents=2;
        if (isset($_POST['luxuryperfume'])) $luxuryperfume=1;
        else $luxuryperfume=2;
        if (isset($_POST['giftset'])) $giftset=1;
        else $giftset=2;
        if (isset($_POST['tester'])) $tester=1;
        else $tester=2;
        $product = $db->AddProductdetailsPerfume($productId, $size, $fragrancefor, $scenttype, $topnotes, $arabicscents, $luxuryperfume, $giftset, $tester);
          break;
        case '3':
        $size = $_POST['makeup_size'];
        $color = $_POST['makeup_color'];
        $ingredients = $_POST['makeup_ingredients'];
        $shadename = $_POST['shadename'];
        $highlights = $_POST['makeup_highlights'];
        $product = $db->AddProductdetailsCosmetics($productId, $size, $color, $ingredients, $shadename, $highlights);
          break;
        case '4':
        $size = $_POST['care_size'];
        $ingredients = $_POST['care_ingredients'];
        $highlights = $_POST['care_highlights'];
        if (isset($_POST['formen_women'])) $formen_women=1;
        else $formen_women=2;
        $count = $_POST['count'];
        $hair_skintypes = $_POST['hair_skintypes'];
        $product = $db->AddProductdetailsCare($productId, $size, $ingredients, $highlights, $formen_women, $count, $hair_skintypes);
          break;
        default:
          // code...
          break;
      }
      if($product) $response['err']=0;
      else $response['err']=3;
    }
    $db->AddSupplierProduct($productId, $supplierId, 0 , 0, 2, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, "UAE", 0, 1, 2);
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
if ($action=='set-minprice') {
  /*get all products */
  $productIds = $db->GetAllProductIds();
  if ($productIds) {
      foreach ($productIds as $productId) {
        $cheapestsupplier = $db->GetCheapestSupplier($productId['productId']);
        if ($cheapestsupplier) {
          $update_price = $db->editProductminprice($productId['productId'],$cheapestsupplier['selling_price']);
        }
      }
  }
}
if ($action=='set-tqty') {
  /*get all products */
  $productIds = $db->GetAllProductIds();
  if ($productIds) {
      foreach ($productIds as $productId) {
        $totalquantity = $db->GetProductTotalQty($productId['productId']);
        $update_quantity = $db->editProductQuantity($productId['productId'],$totalquantity['totalquantity']);
      }
  }
}
if ($action=='set-moq') {
  /*get all products */
  $productIds = $db->GetAllProductIds();
  if ($productIds) {
      foreach ($productIds as $productId) {
        $lowestmoq = $db->GetLowestMOQ($productId['productId']);
        $update_moq = $db->editProductMOQ($productId['productId'],$lowestmoq['moq']);
      }
  }
}
if ($action=='set-maxdiscount') {
  /*get all products */
  $productIds = $db->GetAllProductIds();
  if ($productIds) {
      foreach ($productIds as $productId) {
        $highestdiscount = $db->GetHighestDiscount($productId['productId']);
        $update_discount = $db->editProductDiscount($productId['productId'],$highestdiscount['discount']);
      }
  }
}
