<?php
//Get base class
require_once '../libraries/base.php';
//Get testimonial class
require_once '../libraries/Ser_Testimonials.php';
$db = new Ser_Testimonials();
//results array
$results=array();
//get all leads details
$getAll_testimonials = $db->GetTestimonials();
if($getAll_testimonials){
    foreach($getAll_testimonials as $testimonial){
        array_push($results,$testimonial);
    }
}
//fill result in json file
$fp = fopen('json/testimonials.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>