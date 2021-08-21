<?php
/*fetch Directory variables*/
require_once '../../../model/Base.php';
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Brands.php';
/*create brands instance*/
$db = new Ser_Brands();
/*response Array*/
$response=array();
/*error flag*/
$response['err']=-1;
/*array of brands*/
$response['brands']=array();
/*array of brand's categories*/
$response['brandcategories']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['brandId'])) $brandId=$_GET['brandId'];
else $brandId=0;
if(isset($_GET['categoryId'])) $categoryId=$_GET['categoryId'];
else $categoryId=0;
/*fetching*/
if ($action=='get') {
  if($brandId!=0){
    /*fetching brand info*/
    $response['brands'] = $db->GetBrandById($brandId);
    /*fetching brand categories*/
    $response['brandcategories'] = $db->GetBrandCategories($brandId);
    /*data returned*/
    echo json_encode($response);
  }else {
    /*fetching all brands*/
    $brands = $db->GetActivebrands();
    if ($brands) {
        foreach ($brands as $brand) {
            $count_pro = $db->GetBrandProductsCount($brand['brandId'])['count_pro'];
            $brand['count_pro']=$count_pro;
            array_push($response['brands'], $brand);
        }
    }
    echo json_encode($response['brands']);
  }
}
/*fetch brands for dropdowns*/
if ($action=='get-category-brands') {
  /*fetching all brands*/
  $brands = $db->GetallbrandsByCategoryId($categoryId);
  $dropdown='<option value="0">Choose Brand</option>';
  if ($brands!=0) {
    foreach ($brands as $brand) {
        if ($brand['brandId']==$brandId) {
            $dropdown.='<option value="'.$brand['brandId'].'" selected>'.$brand['brand_name'].'</option>';
        } else {
            $dropdown.='<option value="'.$brand['brandId'].'">'.$brand['brand_name'].'</option>';
        }
    }
  }
  echo $dropdown;
}
/*fetching all brand categories*/
if ($action=='get-brand-categories') {
  if($categoryId!=0){
    /*get all brands by category Id*/
    $brands = $db->GetallbrandsByCategoryId($categoryId);
    if ($brands) {
      echo '<div class="form-group"><div class="kt-checkbox-list">';
        foreach ($brands as $brand) {
          echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
          echo '<input type="checkbox"  onclick="filterbrand()" class="checkbox_brnd" data-id="'.$brand['brandId'].'">'.$brand['brand_name'];
          echo '<span></span>';
          echo '</label>';
        }
        echo '</div></div>';
    }
  }else{
    /*get all brands*/
    $brands = $db->Getallbrands();
    if ($brands) {
      echo '<div class="form-group"><div class="kt-checkbox-list">';
        foreach ($brands as $brand) {
          echo '<div class="form-group"><div class="kt-checkbox-list">';
              echo '<label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">';
              echo '<input type="checkbox" onclick="filterbrand()" class="checkbox_brnd" data-id="'.$brand['brandId'].'">'.$brand['brand_name'];
              echo '<span></span>';
              echo '</label>';
        }
        echo '</div></div>';
    }
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
