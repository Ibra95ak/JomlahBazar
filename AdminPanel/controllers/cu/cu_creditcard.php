<?php
//Get base class
require_once '../../libraries/Base.php';
//Get Creditcard class
require_once '../../libraries/Ser_Creditcards.php';
$db = new Ser_Creditcards();
$err=-1;

if(isset($_POST['creditcardId'])) $creditcardId=$_POST['creditcardId'];
else $creditcardId=0;

//get data from form
$card_number=$_POST['card_number'];
$card_expMO=$_POST['card_expMO'];
$card_expYR=$_POST['card_expYR'];
$creditcarddetailId=$_POST['creditcarddetailId'];

if($creditcardId>0){
    //Edit creditcard
    $edit_creditcard=$db->editCreditcard($creditcardId,$card_number,$card_expMO,$card_expYR,$creditcarddetailId);
    if($edit_creditcard) $err=0;
    else $err=1;
}else{
    //add creditcard
    $add_creditcard=$db->addCreditcard($card_number,$card_expMO,$card_expYR,$creditcarddetailId);
    if($add_creditcard) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>