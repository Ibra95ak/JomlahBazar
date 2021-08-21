<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*call brands class*/
require_once '../../../'.DIR_MOD.'Ser_Brands.php';
/*create brands instance*/
$db = new Ser_Brands();
/*response Array*/
$response=array();
$response['err']=-1;/*Error flag*/
$response['brands']=array();/*array of brands*/
$response['brand']=array();/*array of brands*/
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['categoryId'])) $categoryId=$_GET['categoryId'];
else {
  $categoryId=0;
}
/*fetching*/
if ($action=='get') {
  if($categoryId!=0){
    /*get all brands by category Id*/
    $brands = $db->GetallbrandsByCategoryId($categoryId);
    if ($brands) {
        foreach ($brands as $brand) {
          array_push($response['brand'],$brand);
        }

    echo json_encode($response);
    }
  }else{
    /*get all brands*/
    $brands = $db->Getallbrands();
    if ($brands) {
        foreach ($brands as $brand) {
          array_push($response['brand'],$brand);
        }

    echo json_encode($response);
    }
  }
  }
  /*get brands for dynamic dropdown*/
  if ($action=='get-list') {
    /*get all brands by category Id*/
    $brands = $db->GetallbrandsByCategoryId($categoryId);
    if ($brands) {
        foreach ($brands as $brand) {
          array_push($response['brand'],$brand);
        }

    echo json_encode($response);
    }

  }
