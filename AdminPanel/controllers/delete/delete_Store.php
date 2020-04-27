<?php
//Get base class
require_once '../../libraries/Base.php';
//Get store class
require_once '../../libraries/Ser_Stores.php';
$db = new Ser_Stores();
$err=-1;
//delete store
if(isset($_GET['storeId'])){
    $del_stores = $db->DeleteStoreById($_GET['storeId']);
}
if($del_stores){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_stores.php?err=$err");
exit;
?>