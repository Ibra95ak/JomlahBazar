<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Shippers.php';
$db = new Ser_Shippers();
$err=-1;

if(isset($_POST['shipperId'])) $shipperId=$_POST['shipperId'];
else $shipperId=0;

//get data from form
$aaaId=$_POST['aaaId'];
$addressId=$_POST['addressId'];
$reachoutId=$_POST['reachoutId'];
$shipperdetailsId=$_POST['shipperdetailsId'];
if(isset($_POST['active'])) $active=1;
else $active=2;

if($shipperId>0){
    //Edit shipper
    $edit_shipper=$db->editShipper($shipperId,$aaaId,$addressId,$reachoutId,$shipperdetailsId,$active);
    if($edit_shipper) $err=0;
    else $err=1;
}else{
    //add shipper
    $add_shipper=$db->addShipper($aaaId,$addressId,$reachoutId,$shipperdetailsId,$active);
    if($add_shipper) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>