<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Reachouts.php';
$db = new Ser_Reachouts();
$err=-1;

if(isset($_POST['reachoutId'])) $reachoutId=$_POST['reachoutId'];
else $reachoutId=0;

//get data from form
$userId=$_POST['userId'];
$phone=$_POST['phone'];
$whatsapp=$_POST['whatsapp'];
$telegram=$_POST['telegram'];
$messenger=$_POST['messenger'];
$skype=$_POST['skype'];
$sms=$_POST['sms'];

if($reachoutId>0){
    //Edit reachout
    $edit_reachout=$db->editReachout($reachoutId,$userId,$phone,$whatsapp,$telegram,$messenger,$skype,$sms);
    if($edit_reachout) $err=0;
    else $err=1;
}else{
    //add reachout
    $add_reachout=$db->addReachout($userId,$phone,$whatsapp,$telegram,$messenger,$skype,$sms);
    if($add_reachout) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>