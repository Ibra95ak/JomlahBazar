<?php
/*call testimonials class*/
require_once '../../libraries/Ser_Testimonials.php';
/*create testimonial instance*/
$db = new Ser_Testimonials();
/*results array*/
$results=array();
/*fetch testimonials*/
$testimonials = $db->GetLatesttestimonials();
if($testimonials){
    foreach($testimonials as $testimonial){
        array_push($results,$testimonial);
    }
}
echo json_encode($results);
?>
