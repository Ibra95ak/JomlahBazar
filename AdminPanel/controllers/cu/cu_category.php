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
if(isset($_POST['active'])) $active=1;
else $active=2;
$target_dir = "../../pics/categories/";
$target_file = $target_dir . basename($_FILES["icon"]["name"]);
$icon=substr($target_file, 6);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {
    $err=0;
  } else {
    $err=1;
  }
if($categoryId>0){
    if($target_file==$target_dir){
        //get old image path
        $icon=$db->GetCategoryById($categoryId)['icon'];
    }
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