<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Priviledges.php';
$db = new Ser_Priviledges();
$err=-1;

if(isset($_POST['priviledgeId'])) $priviledgeId=$_POST['priviledgeId'];
else $priviledgeId=0;

//get data from form
$name=$_POST['name'];
$c=$_POST['c'];
$r=$_POST['r'];
$u=$_POST['u'];
$d=$_POST['d'];
$extra=$_POST['extra'];
$active=$_POST['active'];

if($priviledgeId>0){
    //Edit priviledge
    $edit_priviledge=$db->editPriviledge($priviledgeId,$name,$c,$r,$u,$d,$extra,$active);
    if($edit_priviledge) $err=0;
    else $err=1;
}else{
    //add priviledge
    $add_priviledge=$db->addPriviledge($name,$c,$r,$u,$d,$extra,$active);
    if($add_priviledge) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>