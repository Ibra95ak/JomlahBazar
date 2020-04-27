<?php
//Get base class
require_once '../../libraries/Base.php';
//Get testimonial class
require_once '../../libraries/Ser_Testimonials.php';
$db = new Ser_Testimonials();
$err=-1;
//delete testimonial
if(isset($_GET['testimonialId'])){
    $del_testimonials = $db->DeleteTestimonialById($_GET['testimonialId']);
}
if($del_testimonials){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_testimonials.php?err=$err");
exit;
?>