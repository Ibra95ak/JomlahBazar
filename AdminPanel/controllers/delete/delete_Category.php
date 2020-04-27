<?php
//Get base class
require_once '../../libraries/Base.php';
//Get category class
require_once '../../libraries/Ser_Categories.php';
$db = new Ser_Categories();
$err=-1;
//delete category
if(isset($_GET['categoryId'])){
    $del_categories = $db->DeleteCategoryById($_GET['categoryId']);
}
if($del_categories){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_categories.php?err=$err");
exit;
?>