<?php
//Get base class
require_once '../../libraries/base.php';
//Get Testimonial class
require_once '../../libraries/Ser_Testimonials.php';
$db = new Ser_Testimonials();
$err=-1;

if(isset($_POST['testimonialId'])) $testimonialId=$_POST['testimonialId'];
else $testimonialId=0;
//get data from form
$name=$_POST['name'];
$description=$_POST['description'];
$target_dir = "../../pics/testimonials/";
$target_file = $target_dir . basename($_FILES["path"]["name"]);
$path=substr($target_file, 6);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) $err=0;
else $err=1;
if(isset($_POST['active'])) $active=1;
else $active=2;

if($testimonialId>0){
  if($target_file==$target_dir){
      //get old image path
      $path=$db->GetTestimonialById($testimonialId)['path'];
  }
    //Edit testimonial
    $edit_testimonial=$db->editTestimonial($testimonialId,$name,$description,$path,$active);
    if($edit_testimonial) $err=0;
    else $err=1;
}else{
    //add testimonial
    $add_testimonial=$db->addTestimonial($name,$description,$path,$active);
    if($add_testimonial) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>
