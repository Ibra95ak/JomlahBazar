<?php
//Get base class
require_once '../../libraries/Base.php';
//Get productdetail class
require_once '../../libraries/Ser_Productdetails.php';
$db = new Ser_Productdetails();
$err=-1;
//delete productdetail
if(isset($_GET['productdetailId'])){
    $del_productdetails = $db->DeleteProductdetailById($_GET['productdetailId']);
}
if($del_productdetails){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_productdetails.php?err=$err");
exit;
?>