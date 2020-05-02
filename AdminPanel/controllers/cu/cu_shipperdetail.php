<?php
//Get base class
require_once '../../libraries/Base.php';
//Get shipperdetail class
require_once '../../libraries/Ser_Shipperdetails.php';
$db = new Ser_Shipperdetails();
$err=-1;

if(isset($_POST['shipperdetailId'])) $shipperdetailId=$_POST['shipperdetailId'];
else $shipperdetailId=0;

//get data from form
$name=$_POST['name'];
$description=$_POST['description'];

if($shipperdetailId>0){
    //Edit shipperdetail
    $edit_shipperdetail=$db->editShipperdetail($shipperdetailId,$name,$description);
    if($edit_shipperdetail) $err=0;
    else $err=1;
}else{
    //add shipperdetail
    $add_shipperdetail=$db->addShipperdetail($name,$description);
    if($add_shipperdetail) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>