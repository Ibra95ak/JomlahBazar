<?php
//Get base class
require_once '../libraries/Base.php';
//Get testimonial class
require_once '../libraries/Ser_Testimonials.php';
$db = new Ser_Testimonials();
//results array
$results=array();
//get all leads details
$getAll_testimonials = $db->GetTestimonials();
foreach($getAll_testimonials as $testimonial){
    array_push($results,$testimonial);
}

$fp = fopen('json/testimonials.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>