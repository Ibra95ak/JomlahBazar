<?php
//Get base class
require_once '../../libraries/base.php';
//Get admin class
require_once '../../libraries/Ser_Admin.php';
$db = new Ser_Admin();
$err=-1;

if(isset($_POST['adminId'])) $adminId=$_POST['adminId'];
else $adminId=0;

//get data from form
$username=$_POST['username'];
$password=$_POST['password'];
if(isset($_POST['active'])) $active=1;
else $active=2;

if($adminId>0){
    //Edit admin
    $edit_admin=$db->editAdmin($adminId,$username,$password,$active);
    if($edit_admin) $err=0;
    else $err=1;
}else{
    //add admin
    $add_admin=$db->addAdmin($username,$password,$active);
    if($add_admin) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>