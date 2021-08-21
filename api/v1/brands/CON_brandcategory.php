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
/*get brands for dynamic dropdown*/
  if ($action=='get-list') {
    /*get all brands*/
    $brands = $db->Getallbrands();
    if ($brands) {
        foreach ($brands as $brand) {
          echo '<option value="'.$brand['brandId'].'">'.$brand['brand_name'].'</option>';
        }
    }

  }
