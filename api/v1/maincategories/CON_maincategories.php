<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Maincategories.php';
require_once '../../../'.DIR_MOD.'Ser_Categories.php';
/*Create Maincategories instance*/
$db = new Ser_Maincategories();
$dbc = new Ser_Categories();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['Maincategories']=array();
$response['categories']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['maincategoryId'])) $maincategoryId=$_GET['maincategoryId'];
else {
  $maincategoryId=0;
}
if ($action=='get') {
  if($maincategoryId!=0){
    $Maincategories = $db->GetCategoriesByMaincategoryId($maincategoryId);
    if ($Maincategories) {
        foreach ($Maincategories as $Maincategory) {
            $count_pro = $dbc->GetCategoryProductsCount($Maincategory['categoryId'])['count_pro'];
            $Maincategory['count_pro']=$count_pro;
            array_push($response['categories'], $Maincategory);
        }
    }
    echo json_encode($response);
  }else{
    /*get all Maincategories*/
    $Maincategories = $db->GetallMaincategories();
    if ($Maincategories) {
        foreach ($Maincategories as $Maincategory) {
            $count_pro = $db->GetMaincategoryProductsCount($Maincategory['maincategoryId'])['count_pro'];
            $Maincategory['count_pro']=$count_pro;
            array_push($response['Maincategories'], $Maincategory);
        }
    }
    echo json_encode($response['Maincategories']);
  }

}
if ($action=='post') {
    $target_dir = "../../../assets/media/Maincategories/";
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
    if($maincategoryId!=0){
      if($target_dir==$target_file){
        $icon=$db->GetmaincategoryById($maincategoryId)['icon'];
      }
      /*edit maincategory info*/
      $maincategory = $db->editmaincategory($maincategoryId,$name,$icon,$active);
      if($maincategory) $response['err']=0;
      else $response['err']=1;
    }else {
      /*add new maincategory*/
      $maincategory = $db->addmaincategory($name,$icon,$active);
      if($maincategory) $response['err']=0;
      else $response['err']=1;
    }
    echo json_encode($response);
}
if ($action=='delete') {
  /*delete maincategory*/
  $maincategory = $db->DeletemaincategoryById($maincategoryId);
  if ($maincategory) {
      $response['err']=0;
  } else {
      $response['err']=1;
  }
  header("location:".DIR_VIEW.DIR_CAT."dt_Maincategories.php?err=".$response['err']);
}
