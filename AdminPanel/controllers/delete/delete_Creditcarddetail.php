<?php
//Get base class
require_once '../../libraries/Base.php';
//Get creditcarddetail class
require_once '../../libraries/Ser_Creditcarddetails.php';
$db = new Ser_Creditcarddetails();
$err=-1;
//delete creditcarddetail
if(isset($_GET['creditcarddetailId'])){
    $del_creditcarddetails = $db->DeleteCreditcarddetailById($_GET['creditcarddetailId']);
}
if($del_creditcarddetails){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_creditcarddetails.php?err=$err");
exit;
?>