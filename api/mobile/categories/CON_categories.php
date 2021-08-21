<?php
/*fetch Directory variables*/
require_once '../../../model/Base.php';
/*Call Main Categories class*/
require_once '../../../'.DIR_MOD.'Ser_Maincategories.php';
/*Call Categories class*/
require_once '../../../'.DIR_MOD.'Ser_Categories.php';
/*Create Main Categories instance*/
$dbmc = new Ser_Maincategories();
/*Create Categories instance*/
$dbc = new Ser_Categories();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
/*Array of Categories*/
$response['categories']=array();
/*Array of Main Categories*/
$response['maincategories']=array();
/*Arrays of Main Categories*/
$response['categories1']=array();
$response['categories2']=array();
$response['categories3']=array();
$response['categories4']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['maincategoryId'])) $maincategoryId=$_GET['maincategoryId'];
else $maincategoryId=0;
if(isset($_GET['categoryId'])) $categoryId=$_GET['categoryId'];
else $categoryId=0;
/*fetching*/
if ($action=='get-mcat') {
  /*fetch all active Main Categories*/
  $Maincategories = $dbmc->GetallMaincategories();
  if ($Maincategories) {
    foreach ($Maincategories as $Maincategory) {
      array_push($response['maincategories'], $Maincategory);
    }
  }else {
    $response['maincategories'] = NULL;
  }
  echo json_encode($response);
}
if ($action=='get') {
  if($categoryId!=0){
    $categories = $dbc->GetCategoryById($categoryId);
    echo json_encode($categories);
  }else{
    /*get all categories*/
    $categories = $dbc->GetallactiveCategories();
    if ($categories) {
        foreach ($categories as $category) {
            array_push($response['categories'], $category);
        }
    }
    $fp = fopen('../json/categories.json', 'w');
    fwrite($fp, json_encode($response['categories']));
    fclose($fp);
    echo json_encode($response['categories']);
  }

}
if ($action=='get-mcat-cat') {
  if($maincategoryId){
      $categories = $dbmc->GetCategoriesByMaincategoryId($maincategoryId);
      if ($categories) {
        foreach ($categories as $category) {
            array_push($response['categories'], $category);
        }
      }
      echo json_encode($response['categories']);
  }else {
    /*get categories by maincategories*/
    $categories1 = $dbmc->GetCategoriesByMaincategoryIdlim4(1);
    $categories2 = $dbmc->GetCategoriesByMaincategoryIdlim4(2);
    $categories3 = $dbmc->GetCategoriesByMaincategoryIdlim4(3);
    $categories4 = $dbmc->GetCategoriesByMaincategoryIdlim4(4);
    if ($categories1) {
      foreach ($categories1 as $category1) {
          array_push($response['categories1'], $category1);
      }
    }
    if ($categories2) {
      foreach ($categories2 as $category2) {
          array_push($response['categories2'], $category2);
      }
    }
    if ($categories3) {
      foreach ($categories3 as $category3) {
          array_push($response['categories3'], $category3);
      }
    }
    if ($categories4) {
      foreach ($categories4 as $category4) {
          array_push($response['categories4'], $category4);
      }
    }
    echo json_encode($response);
  }
}
if ($action=='post') {
    $target_dir = "../../../assets/media/categories/";
    $target_file = $target_dir . basename($_FILES["icon"]["name"]);
    $icon=substr($target_file, 6);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {
        $response['err']==0;
    } else {
        $response['err']==1;
    }
    $name=$_POST['name'];
    if (isset($_POST['active'])) {
        $active=1;
    } else {
        $active=2;
    }
    if($categoryId!=0){
      if($target_dir==$target_file){
        $icon=$dbc->GetCategoryById($categoryId)['icon'];
      }
      /*edit category info*/
      $category = $dbc->editCategory($categoryId,$name,$icon,$active);
      if($category) $response['err']=0;
      else $response['err']=1;
    }else {
      /*add new category*/
      $category = $dbc->addCategory($name,$icon,$active);
      if($category) $response['err']=0;
      else $response['err']=1;
    }
    echo json_encode($response);
}
/*get categories for dynamic dropdown*/
  if ($action=='get-list') {
    /*get all categories*/
    $categories = $dbc->GetallactiveCategories();
    if ($categories) {
        foreach ($categories as $category) {
          echo '<option value="'.$category['categoryId'].'">'.$category['name'].'</option>';
        }
    }

  }
if ($action=='delete') {
  /*delete category*/
  $category = $dbc->DeleteCategoryById($categoryId);
  if ($category) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
  header("location:".DIR_VIEW.DIR_CAT."dt_categories.php?err=".$response['err']);
}
