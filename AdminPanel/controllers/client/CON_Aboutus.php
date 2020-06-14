<?php
/*Get brand class*/
require_once '../../libraries/Ser_Settings.php';
/*Create brand Instance*/
$db = new Ser_Settings();
/*results array*/
$results=array();
/*get brand details*/
$get_settings = $db->GetSettings();
if($get_settings){
    foreach($get_settings as $setting){
        array_push($results,$setting);
    }
}
echo json_encode($results);
?>