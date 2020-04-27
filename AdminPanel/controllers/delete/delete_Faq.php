<?php
//Get base class
require_once '../../libraries/Base.php';
//Get faq class
require_once '../../libraries/Ser_Faqs.php';
$db = new Ser_Faqs();
$err=-1;
//delete Faq
if(isset($_GET['faqId'])){
    $del_faqs = $db->DeleteFaqById($_GET['faqId']);
}
if($del_faqs){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_faqs.php?err=$err");
exit;
?>