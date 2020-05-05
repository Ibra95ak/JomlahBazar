<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Paypals.php';
$db = new Ser_Paypals();
$err=-1;

if(isset($_POST['paypalId'])) $paypalId=$_POST['paypalId'];
else $paypalId=0;

//get data from form
$walletId=$_POST['walletId'];
$email=$_POST['email'];

if($paypalId>0){
    //Edit paypal
    $edit_paypal=$db->editPaypal($paypalId,$walletId,$email);
    if($edit_paypal) $err=0;
    else $err=1;
}else{
    // add paypal
    $add_paypal=$db->addPaypal($walletId,$email);
    if($add_paypal) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>