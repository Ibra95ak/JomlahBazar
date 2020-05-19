<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Creditcarddetails.php';
$db = new Ser_Creditcarddetails();
$err=-1;

if(isset($_POST['creditcarddetailId'])) $creditcarddetailId=$_POST['creditcarddetailId'];
else $creditcarddetailId=0;

//get data from form
$type=$_POST['type'];
if(isset($_POST['active'])) $active=1;
else $active=2;

if($creditcarddetailId>0){
    //Edit creditcarddetail
    $edit_creditcarddetail=$db->editCreditcarddetail($creditcarddetailId,$type,$active);
    if($edit_creditcarddetail) $err=0;
    else $err=1;
}else{
    //add Creditcarddetail
    $add_creditcarddetail=$db->addCreditcarddetail($type,$active);
    if($add_creditcarddetail) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>