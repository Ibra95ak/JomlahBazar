<?php
//Get base class
require_once '../../libraries/Base.php';
//Get aaa class
require_once '../../libraries/Ser_AAA.php';
$db = new Ser_AAA();
$err=-1;
//delete aaa
if(isset($_GET['aaaId'])){
    $del_aaa = $db->DeleteAAAById($_GET['aaaId']);
}
if($del_aaa){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_aaa.php?err=$err");
exit;
?>