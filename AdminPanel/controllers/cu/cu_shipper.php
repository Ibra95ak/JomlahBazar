<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Shippers.php';
$db = new Ser_Shippers();
$err=-1;

if(isset($_POST['shipperId'])) $shipperId=$_POST['shipperId'];
else $shipperId=0;

//get data from form
$addressId=$_POST['addressId'];
$reachoutId=$_POST['reachoutId'];
$shipperdetailsId=$_POST['shipperdetailsId'];
$active=$_POST['active'];

if($shipperId>0){
    //Edit shipper
    $edit_shipper=$db->editShipper($shipperId,$active);
    if($edit_shipper) $err=0;
    else $err=1;
}else{
    //add shipper
    $add_shipper=$db->addShipper($addressId,$reachoutId,$shipperdetailsId,$active);
    if($add_shipper) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>