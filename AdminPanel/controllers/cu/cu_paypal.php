<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Paypals.php';
$db = new Ser_Paypals();
$err=-1;

if(isset($_POST['typeId'])) $typeId=$_POST['typeId'];
else $typeId=0;

//get data from form
$email=$_POST['email'];

if($typeId>0){
    //Edit paypal
    $edit_paypal=$db->editPaypal($typeId,$email);
    if($edit_paypal) $err=0;
    else $err=1;
}else{
    // add paypal
    $add_paypal=$db->addPaypal($email);
    if($add_Paypal) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>