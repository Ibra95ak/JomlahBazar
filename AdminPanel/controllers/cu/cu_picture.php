<?php
//Get base class
require_once '../../libraries/Base.php';
//Get picture class
require_once '../../libraries/Ser_Pictures.php';
$db = new Ser_Pictures();
$err=-1;

if(isset($_POST['pictureId'])) $pictureId=$_POST['pictureId'];
else $pictureId=0;

//get data from form
$name=$_POST['name'];
$path=$_POST['path'];
$active=$_POST['active'];

if($pictureId>0){
    //Edit picture
    $edit_picture=$db->editPicture($pictureId,$name,$path,$active);
    if($edit_picture) $err=0;
    else $err=1;
}else{
    //add picture
    $add_picture=$db->addPicture($name,$path,$active);
    if($add_picture) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>