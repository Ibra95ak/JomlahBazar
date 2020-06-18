<?php
/*Get base class*/
require_once '../libraries/base.php';
/*Get sliders class*/
require_once '../libraries/Ser_Sliders.php';
/*create sliders instance*/
$db = new Ser_Sliders();
/*results array*/
$results=array();
/*get all sliders details*/
$getAll_sliders = $db->GetSliders();
if($getAll_sliders){
  foreach($getAll_sliders as $slider){
    array_push($results,$slider);
  }
}else $results=NULL;
/*save data as json file*/
$fp = fopen('json/sliders.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>
