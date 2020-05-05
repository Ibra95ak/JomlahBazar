<?php
//Get base class
require_once '../../libraries/Base.php';
//Get brand class
require_once '../../libraries/Ser_Categories.php';
$db = new Ser_Categories();
$err=-1;

if(isset($_POST['categoryId'])) $categoryId=$_POST['categoryId'];
else $categoryId=0;

//get data from form
$name=$_POST['name'];
$icon=$_POST['icon'];
$active=$_POST['active'];
$target_dir = "caticon/";
$target_file = $target_dir . basename($_FILES["icon"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$upload_img=move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file);
if($categoryId>0){
    //Edit Category
    $edit_Category=$db->editCategory($categoryId,$name,$icon,$active);
    if($edit_Category) $err=0;
    else $err=1;
}else{
    //add Category
    $add_Category=$db->addCategory($name,$icon,$active);
    if($add_Category) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>