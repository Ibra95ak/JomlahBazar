<?php
//Get base class
require_once '../../libraries/Base.php';
//Get reachout class
require_once '../../libraries/Ser_Reachouts.php';
$db = new Ser_Reachouts();
$err=-1;
//delete reachout
if(isset($_GET['reachoutId'])){
    $del_reachouts = $db->DeleteReachoutById($_GET['reachoutId']);
}
if($del_reachouts){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_reachouts.php?err=$err");
exit;
?>