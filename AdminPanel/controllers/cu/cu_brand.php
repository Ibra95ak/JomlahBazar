<?php
/*get base class*/
require_once '../../libraries/base.php';
/*get brand class*/
require_once '../../libraries/Ser_Brands.php';
/*create brand instance*/
$db = new Ser_Brands();
/*initialize error flag*/
$err=-1;
/*get data from form*/
if(isset($_POST['brandId'])) $brandId=$_POST['brandId'];
else $brandId=0;
$brandcategoryId=$_POST['brandcategoryId'];
$brand_name=$_POST['brand_name'];
/*start::upload image*/
$target_dir = "../../pics/brands/";/*directory to upload to*/
$target_file = $target_dir . basename($_FILES["path"]["name"]);/*image full path*/
$path=substr($target_file, 6);/*removing '../../'*/
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));/*get image type*/
/*upload image function*/
if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) $err=0;
else $err=1;
/*end::upload image*/
/*activate/deactivate brand*/
if(isset($_POST['active'])) $active=1;
else $active=2;
/*manage slider*/
if($brandId>0){
  if($target_file==$target_dir){
    /*get old image path*/
    $path=$db->GetBrandById($brandId)['path'];
  }
    /*edit brand*/
    $edit_brand=$db->editBrand($brandId,$brandcategoryId,$brand_name,$path,$active);
    if($edit_brand) $err=0;
    else $err=1;
}else{
    /*add brand*/
    $add_brand=$db->addBrand($brandcategoryId,$brand_name,$path,$active);
    if($add_brand) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>
