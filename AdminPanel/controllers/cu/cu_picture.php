<?php
//Get base class
require_once '../../libraries/base.php';
//Get picture class
require_once '../../libraries/Ser_Pictures.php';
$db = new Ser_Pictures();
$err=-1;

if(isset($_POST['pictureId'])) $pictureId=$_POST['pictureId'];
else $pictureId=0;

//get data from form
$name=$_POST['name'];
$target_dir = "../../pics/";
$target_file = $target_dir . basename($_FILES["path"]["name"]);
$path=substr($target_file, 6);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) {
    $err=0;
  } else {
    $err=1;
  }
if(isset($_POST['active'])) $active=1;
else $active=2;

if($pictureId>0){
    if($target_file==$target_dir){
        //get old image path
        $path=$db->GetPictureById($pictureId)['path'];
    }
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