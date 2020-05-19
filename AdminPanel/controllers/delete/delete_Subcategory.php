<?php
//Get base class
require_once '../../libraries/base.php';
//Get subcategory class
require_once '../../libraries/Ser_Subcategories.php';
$db = new Ser_Subcategories();
$err=-1;
//delete subcategory
if(isset($_GET['subcategoryId'])){
    $del_subcategories = $db->DeleteSubcategoryById($_GET['subcategoryId']);
}
if($del_subcategories){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_subcategories.php?err=$err");
exit;
?>