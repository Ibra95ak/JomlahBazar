<?php
/*allow access*/
header("Access-Control-Allow-Origin: *");
/*get sliders class*/
require_once '../../libraries/Ser_Sliders.php';
/*create slider instance*/
$db = new Ser_Sliders();
/*results array*/
$results=array();
/*get sliders details*/
$get_sliders = $db->GetSliders();
if($get_sliders){
    foreach($get_sliders as $slider){
        array_push($results,$slider);
    }
}
echo json_encode($results);
?>
