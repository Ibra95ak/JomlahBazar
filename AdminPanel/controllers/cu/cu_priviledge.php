<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Priviledges.php';
$db = new Ser_Priviledges();
$err=-1;

if(isset($_POST['priviledgeId'])) $priviledgeId=$_POST['priviledgeId'];
else $priviledgeId=0;

//get data from form
$name=$_POST['name'];
if(isset($_POST['c'])) $c=1;
else $c=2;
if(isset($_POST['r'])) $r=1;
else $r=2;
if(isset($_POST['u'])) $u=1;
else $u=2;
if(isset($_POST['d'])) $d=1;
else $d=2;
if(isset($_POST['extra'])) $extra=1;
else $extra=2;
if(isset($_POST['active'])) $active=1;
else $active=2;

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