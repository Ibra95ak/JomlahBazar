<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Stores.php';
$db = new Ser_Stores();
$err=-1;

if(isset($_POST['storeId'])) $storeId=$_POST['storeId'];
else $storeId=0;

//get data from form
$supplierId=$_POST['supplierId'];
$addressId=$_POST['addressId'];
$reachoutId=$_POST['reachoutId'];
$name=$_POST['name'];
$description=$_POST['description'];
$theme=$_POST['theme'];
$blockId=$_POST['blockId'];
$active=$_POST['active'];

if($storeId>0){
    //Edit store
    $edit_store=$db->editStore($storeId,$supplierId,$addressId,$reachoutId,$name,$description,$theme,$blockId,$active);
    if($edit_store) $err=0;
    else $err=1;
}else{
    //add store
    $add_store=$db->addStore($supplierId,$addressId,$reachoutId,$name,$description,$theme,$blockId,$active);
    if($add_store) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>