<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Brands.php';
/*create brands instance*/
$db = new Ser_Brands();
/*response Array*/
$response=array();
$response['err']=-1;/*error flag*/
$response['brands']=array();/*array of brands*/
$response['brandcategories']=array();/*array of brand's categories*/
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['brandId'])) $brandId=$_GET['brandId'];
else {
  $brandId=0;
}
/*fetching*/
if ($action=='get') {
  if($brandId!=0){
    $response['brands'] = $db->GetBrandById($brandId);/*fetching brand info*/
    $response['brandcategories'] = $db->GetBrandCategories($brandId);/*fetching brand categories*/
    echo json_encode($response);/*data returned*/
  }else {
    $brands = $db->GetActivebrands();/*get all brands*/
    $fp = fopen('../json/brands.json', 'w');/*open(create if not exist) json file*/
    fwrite($fp, json_encode($brands));/*save data in json file*/
    fclose($fp);/*close json file*/
  }
}
/*managing*/
if ($action=='post') {
    /*fetching form data*/
    $brand_categoriesId=explode(",",$_POST['brand_categoriesId']);
    /*start -- image upload*/
    $target_dir = "../../../assets/media/brands/";/*upload directory*/
    $target_file = $target_dir . basename($_FILES["path"]["name"]);
    $path=substr($target_file, 9);/*path to save in database*/
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) {
        $response['err']==0;/*successfull upload*/
    } else {
        $response['err']==1;/*failed to upload image*/
    }
    /*end -- image upload*/
    $brand_name=$_POST['brand_name'];
    if (isset($_POST['active'])) {
        $active=1;
    } else {
        $active=2;
    }
    if($brandId!=0){
      if($target_dir==$target_file){/*no new upload*/
        $path=$db->GetBrandById($brandId)['path'];/*fetching brand image path*/
      }
      $brand = $db->editBrand($brandId,$brand_name,$path,$active);/*edit brand info*/
      $del = $db->DeleteBrandCategories($brandId);/*delete all brand categories*/
      /*add all new brand categories*/
      foreach ($brand_categoriesId as $brand_categoryId) {
        $add = $db->addBrandCategory($brandId,$brand_categoryId);
      }
      if($brand) $response['err']=0;/*successfull fetch*/
      else $response['err']=2;/*failed to edit brand due to database error*/
    }else {
      $brand = $db->addBrand($brand_name,$path,$active);/*add new brand*/
      /*add all new brand categories*/
      foreach ($brand_categoriesId as $brand_categoryId) {
        $add = $db->addBrandCategory($brand['insertId'],$brand_categoryId);
      }
      if($brand) $response['err']=0;/*successfull add*/
      else $response['err']=3;/*failed to add brand due to database error*/
    }
    echo json_encode($response);
}
/*deletion*/
if ($action=='delete') {
  $brand = $db->DeleteBrandById($brandId);/*delete brand*/
  $del = $db->DeleteBrandCategories($brandId);/*delete brand categories*/
  /*delete brand image*/
  if ($brand) {
      $response['err']=0;/*successfull deletion*/
  } else {
      $response['err']=4;/*failed to delete*/
  }
  header("location:".DIR_VIEW.DIR_USR."dt_brands.php?err=".$response['err']);
}
