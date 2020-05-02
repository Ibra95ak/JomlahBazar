<?php
//Get base class
require_once '../../libraries/Base.php';
//Get adminpriviledge class
require_once '../../libraries/Ser_Adminpriviledges.php';
$db = new Ser_Adminpriviledges();
$err=-1;

if(isset($_POST['adminpriviledgeId'])) $adminpriviledgeId=$_POST['adminpriviledgeId'];
else $adminpriviledgeId=0;

//get data from form
$adminId=$_POST['adminId'];
$priviledgeId=$_POST['priviledgeId'];

if($adminpriviledgeId>0){
    //Edit adminpriviledge
    $edit_adminpriviledge=$db->editAdminpriviledge($adminpriviledgeId,$adminId,$priviledgeId);
    if($edit_adminpriviledge) $err=0;
    else $err=1;
}else{
    //add adminpriviledge
    $add_adminpriviledge=$db->addAdminpriviledge($adminId,$priviledgeId);
    if($add_brand) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>