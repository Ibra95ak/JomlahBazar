<?php
//Get base class
require_once '../../libraries/Base.php';
//Get creditcard class
require_once '../../libraries/Ser_Creditcards.php';
$db = new Ser_Creditcards();
$err=-1;

if(isset($_POST['creditcardId'])) $creditcardId=$_POST['creditcardId'];
else $creditcardId=0;

//get data from form
$productId=$_POST['productId'];
$creditcard_name=$_POST['creditcard_name'];
$pictureId=$_POST['pictureId'];
$active=$_POST['active'];

if($creditcardId>0){
    //Edit creditcard
    $edit_creditcard=$db->editCreditcard($creditcardId,$card_number,$card_expMO,$card_expYR);
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