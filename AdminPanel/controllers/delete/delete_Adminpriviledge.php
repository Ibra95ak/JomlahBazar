<?php
//Get base class
require_once '../../libraries/Base.php';
//Get adminpriviledge class
require_once '../../libraries/Ser_Adminpriviledges.php';
$db = new Ser_Adminpriviledges();
$err=-1;
//delete Adminpriviledges
if(isset($_GET['adminpriviledgeId'])){
    $del_adminpriviledges = $db->DeleteAdminpriviledgeById($_GET['adminpriviledgeId']);
}
if($del_adminpriviledges){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_adminpriviledge.php?err=$err");
exit;
?>