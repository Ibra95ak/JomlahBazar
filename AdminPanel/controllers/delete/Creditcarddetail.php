<?php
//Get base class
require_once '../../libraries/Base.php';
//Get admin class
require_once '../../libraries/Ser_Admin.php';
$db = new Ser_Admin();
$err=-1;
//delete admin
if(isset($_GET['adminId'])){
    $del_admins = $db->DeleteAdminById($_GET['adminId']);
}
if($del_admins){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_admins.php?err=$err");
exit;
?>
