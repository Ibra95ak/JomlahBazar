<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call categories class*/
require_once '../../../'.DIR_MOD.'Ser_Categories.php';
/*Create categories instance*/
$db = new Ser_Categories();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['categories']=array();
$response['category']=array();
/*URL parameters*/
$action=$_GET['action'];
if(isset($_GET['categoryId'])) $categoryId=$_GET['categoryId'];
else $categoryId=0;
if ($action=='get') {
  if($categoryId!=0){
    /*get category by Id*/
    $category = $db->Admin_getCategoryById($categoryId);
    if($category){
      $response['err']=0;
      array_push($response['category'],$category);
    }
  }else{
    /*get all categories*/
    $categories = $db->Admin_getallCategories();
    if($categories){
        foreach($categories as $category){
          array_push($response['categories'],$category);
        }
    }
    $fp = fopen('../json/categories.json', 'w');
    fwrite($fp, json_encode($response['categories']));
    fclose($fp);
  }

}
?>
