<?php
//Get base class
require_once '../../libraries/Base.php';
//Get priviledge class
require_once '../../libraries/Ser_Priviledges.php';
$db = new Ser_Priviledges();
$err=-1;
//delete priviledge
if(isset($_GET['priviledgeId'])){
    $del_priviledges = $db->DeletePriviledgeById($_GET['priviledgeId']);
}
if($del_priviledges){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_priviledges.php?err=$err");
exit;
?>