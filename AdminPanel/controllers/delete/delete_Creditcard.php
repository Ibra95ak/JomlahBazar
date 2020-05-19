<?php
//Get base class
require_once '../../libraries/base.php';
//Get creditcard class
require_once '../../libraries/Ser_Creditcards.php';
$db = new Ser_Creditcards();
$err=-1;
//delete creditcard
if(isset($_GET['creditcardId'])){
    $del_creditcards = $db->DeleteCreditcardById($_GET['creditcardId']);
}
if($del_creditcards){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_creditcard.php?err=$err");
exit;
?>