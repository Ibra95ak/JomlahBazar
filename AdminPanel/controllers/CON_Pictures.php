<?php
//Get base class
require_once '../libraries/base.php';
//Get picture class
require_once '../libraries/Ser_Pictures.php';
$db = new Ser_Pictures();
//results array
$results=array();
//get all leads details
$getAll_pictures = $db->GetPictures();
foreach($getAll_pictures as $picture){
    array_push($results,$picture);
}

$fp = fopen('json/pictures.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>