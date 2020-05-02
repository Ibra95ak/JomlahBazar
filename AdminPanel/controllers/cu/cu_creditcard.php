<?php
//Get base class
require_once '../../libraries/Base.php';
//Get Creditcard class
require_once '../../libraries/Ser_Creditcards.php';
$db = new Ser_Creditcards();
$err=-1;

if(isset($_POST['typeId'])) $typeId=$_POST['typeId'];
else $typeId=0;

//get data from form
$card_number=$_POST['card_number'];
$card_expMO=$_POST['card_expMO'];
$card_expYR=$_POST['card_expYR'];
$creditcarddetailId=$_POST['creditcarddetailId'];

if($typeId>0){
    //Edit creditcard
    $edit_creditcard=$db->editCreditcard($typeId,$card_number,$card_expMO,$card_expYR,$creditcarddetailId);
    if($edit_creditcard) $err=0;
    else $err=1;
}else{
    //add creditcard
    $add_creditcard=$db->addCreditcard($card_number,$card_expMO,$card_expYR,$creditcarddetailId);
    if($add_Creditcard) $err=0;
    else $err=1;
}
echo json_encode($err);
alert($err);
exit;
?>