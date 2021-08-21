<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call brands class*/
require_once '../../../'.DIR_MOD.'Ser_Brands.php';
/*Create brands instance*/
$db = new Ser_Brands();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['brands']=array();
$response['brand']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['brandId'])) $brandId=$_GET['brandId'];
else $brandId=0;
if ($action=='get') {
  if($brandId!=0){
    /*get brand by Id*/
    $brand = $db->Admin_getBrandById($brandId);
    if($brand){
      $response['err']=0;
      array_push($response['brand'],$brand);
    }
  }else{
    /*get all brands*/
    $brands = $db->Admin_getallBrands();
    if($brands){
        foreach($brands as $brand){
          $count_pro = $db->GetBrandProductsCount($brand['brandId'])['count_pro'];
          $brand['count_pro']=$count_pro;
          array_push($response['brands'],$brand);
        }
    }
    $fp = fopen('../json/brands.json', 'w');
    fwrite($fp, json_encode($response['brands']));
    fclose($fp);
  }

}
?>
