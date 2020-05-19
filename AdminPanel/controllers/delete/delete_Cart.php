<?php
//Get base class
require_once '../../libraries/base.php';
//Get cart class
require_once '../../libraries/Ser_Carts.php';
$db = new Ser_Carts();
$err=-1;
//delete cart
if(isset($_GET['cartId'])){
    $del_carts = $db->DeleteCartById($_GET['cartId']);
}
if($del_carts){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_carts.php?err=$err");
exit;
?>