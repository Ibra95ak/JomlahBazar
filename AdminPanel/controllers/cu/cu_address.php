<?php
//Get base class
require_once '../../libraries/Base.php';
//Get address class
require_once '../../libraries/Ser_Addresses.php';
$db = new Ser_Addresses();
$err=-1;

if(isset($_POST['addressId'])) $addressId=$_POST['addressId'];
else $addressId=0;

//get data from form
$ipaddress=$_POST['ipaddress'];
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$city=$_POST['city'];
$state=$_POST['state'];
$postalcode=$_POST['postalcode'];
$country=$_POST['country'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];

if($addressId>0){
    //Edit address
    $edit_address=$db->editAddress($addressId,$ipaddress,$address1,$address2,$city,$state,$postalcode,$country,$latitude,$longitude);
    if($edit_address) $err=0;
    else $err=1;
}else{
    //add address
    $add_address=$db->addAddress($ipaddress,$address1,$address2,$city,$state,$postalcode,$country,$latitude,$longitude);
    if($add_address) $err=0;
    else $err=2;
}
echo json_encode($err);
//exit;
?>