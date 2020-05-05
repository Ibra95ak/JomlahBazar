<?php
//Get base class
require_once '../../libraries/Base.php';
//Get Testimonial class
require_once '../../libraries/Ser_Testimonials.php';
$db = new Ser_Testimonials();
$err=-1;

if(isset($_POST['testimonialId'])) $testimonialId=$_POST['testimonialId'];
else $testimonialId=0;

//get data from form
$name=$_POST['name'];
$description=$_POST['description'];
$pictureId=$_POST['pictureId'];
$active=$_POST['active'];

if($testimonialId>0){
    //Edit testimonial
    $edit_testimonial=$db->editTestimonial($testimonialId,$name,$description,$pictureId,$active);
    if($edit_testimonial) $err=0;
    else $err=1;
}else{
    //add testimonial
    $add_testimonial=$db->addTestimonial($name,$description,$pictureId,$active);
    if($add_testimonial) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>