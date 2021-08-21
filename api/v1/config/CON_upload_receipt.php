<?php
/*Start browser session*/
session_start();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['media']=array();
/*URL parameters*/
$action=$_GET['action'];
$target_dir = "../../../assets/media/".$_GET['path']."/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$file=substr($target_file, 6);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $response['err']=0;
    $response['media']=$file;
} else {
    $response['err']=1;
}
echo json_encode($response);
