<?php
//Get base class
require_once '../../libraries/Base.php';
//Get picture class
require_once '../../libraries/Ser_Pictures.php';
$db = new Ser_Pictures();
$err=-1;
//delete picture
if(isset($_GET['pictureId'])){
    $del_pictures = $db->DeletePictureById($_GET['pictureId']);
}
if($del_pictures){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_pictures.php?err=$err");
exit;
?>