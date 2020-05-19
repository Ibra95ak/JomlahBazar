<?php
//Get base class
require_once '../../libraries/base.php';
//Get faq class
require_once '../../libraries/Ser_Faqs.php';
$db = new Ser_Faqs();
$err=-1;

if(isset($_POST['faqId'])) $faqId=$_POST['faqId'];
else $faqId=0;

//get data from form
$question=$_POST['question'];
$answer=$_POST['answer'];
$position=$_POST['position'];
$active=$_POST['active'];

if($faqId>0){
    //Edit faq
    $edit_faq=$db->editFaq($faqId,$question,$answer,$position,$active);
    if($edit_faq) $err=0;
    else $err=1;
}else{
    //add faq
    $add_faq=$db->addFaq($question,$answer,$position,$active);
    if($add_faq) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>