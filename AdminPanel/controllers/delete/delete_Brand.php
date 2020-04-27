<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Brands.php';
$db = new Ser_Brands();
$err=-1;
//delete brand
if(isset($_GET['brandId'])){
    $del_brands = $db->DeleteBrandById($_GET['brandId']);
}
if($del_brands){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_brands.php?err=$err");
exit;
?>