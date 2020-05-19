<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Subcategories.php';
$db = new Ser_Subcategories();
$err=-1;

if(isset($_POST['subcategoryId'])) $subcategoryId=$_POST['subcategoryId'];
else $subcategoryId=0;

//get data from form
$categoryId=$_POST['categoryId'];
$name=$_POST['name'];
if(isset($_POST['active'])) $active=1;
else $active=2;
$target_dir = "../../pics/subcategories/";
$target_file = $target_dir . basename($_FILES["icon"]["name"]);
$icon=substr($target_file, 6);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {
    $err=0;
  } else {
    $err=1;
  }
if($subcategoryId>0){
    if($target_file==$target_dir){
        //get old image path
        $icon=$db->GetSubcategoryById($subcategoryId)['icon'];
    }
    //Edit subcategory
    $edit_subcategory=$db->editSubcategory($subcategoryId,$categoryId,$name,$icon,$active);
    if($edit_subcategory) $err=0;
    else $err=1;
}else{
    //add subcategory
     $add_subcategory=$db->addSubcategory($categoryId,$name,$icon,$active);
     if($add_subcategory) $err=0;
     else $err=1;
}
echo json_encode($err);
exit;
?>