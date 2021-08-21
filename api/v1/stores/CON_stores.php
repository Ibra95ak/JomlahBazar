<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call products class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
/*Create products instance*/
$db = new Ser_Users();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
/*URL parameters*/
$action=$_GET['action'];
if ($action=='post') {
    $supplierId = $_POST['supplierId'];
    $storeId = $_POST['storeId'];
    $store_pic = "assets/media/companies/" . str_replace(' ', '', $_FILES["store_pic"]["name"]);
    if($store_pic== "assets/media/companies/") $store_pic=$_POST['old_store_pic'];
    $companyname = $_POST['companyname'];
    $trn = $_POST['trn'];
    $brandsId = $_POST['brandsId'];
    $categoriesId = $_POST['categoriesId'];
    $target_dir = "../../../assets/media/companies/";
    $target_file = $target_dir . basename(str_replace(' ', '', $_FILES["store_pic"]["name"]));
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (move_uploaded_file(str_replace(' ', '', $_FILES["store_pic"]["tmp_name"]), $target_file)) {
        $response['err']=0;
    } else {
        $response['err']=1;
    }
    if ($storeId!=0) {
      /*edit store*/
      $stores = $db->EditStore($storeId, $companyname, $trn, $store_pic);
      $response['err']= 0;
    }else {
      /*add store*/
      $stores = $db->AddStore($companyname, $trn, $store_pic);
      $storeId = $stores['insertId'];
      $users = $db->UpdateUsercompanyId($supplierId,$storeId);
      $response['err']= 0;
    }
    if ($brandsId!='') {
      $old_sup_brands = $db->DeleteSupplierbrand($supplierId);
      $brandsId_array = explode(",",$brandsId);
      foreach ($brandsId_array as $brandId) {
        $sup_brands = $db->addSupplierBrand($supplierId,$brandId);
      }
      $response['err']= 0;
    }
    if ($categoriesId!='') {
      $old_sup_categories = $db->DeleteSupplierCategory($supplierId);
      $categoriesId_array = explode(",",$categoriesId);
      foreach ($categoriesId_array as $categoryId) {
        $sup_categories = $db->addSupplierCategory($supplierId,$categoryId);
      }
      $response['err']= 0;
    }
  }
echo json_encode($response);
