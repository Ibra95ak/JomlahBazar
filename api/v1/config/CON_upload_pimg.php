<?php
/*Start browser session*/
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Products.php';
/*Create products instance*/
$db = new Ser_Products();
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['media']=array();
/*URL parameters*/
$action=$_GET['action'];
$target_dir = "../../../assets/media/".$_GET['path']."/";
$target_file = $target_dir . basename(str_replace(' ', '', $_FILES["file"]["name"]));
$file=substr($target_file, 6);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $response['err']=0;
    $response['media']=$file;
} else {
    $response['err']=1;
}
echo json_encode($response);
