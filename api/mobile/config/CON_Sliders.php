<?php
/*Start browser session*/
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Sliders.php';
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
$fp = fopen('../json/sliders.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>
