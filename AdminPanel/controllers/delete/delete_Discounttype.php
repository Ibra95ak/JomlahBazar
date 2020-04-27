<?php
//Get base class
require_once '../../libraries/Base.php';
//Get discounttype class
require_once '../../libraries/Ser_Discounttypes.php';
$db = new Ser_Discounttypes();
$err=-1;
//delete discounttype
if(isset($_GET['discounttypeId'])){
    $del_discounttypes = $db->DeleteDiscounttypeById($_GET['discounttypeId']);
}
if($del_discounttypes){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_discounttypes.php?err=$err");
exit;
?>