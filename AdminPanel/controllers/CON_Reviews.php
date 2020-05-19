<?php
//Get base class
require_once '../libraries/base.php';
//Get review class
require_once '../libraries/Ser_Reviews.php';
$db = new Ser_Reviews();
//results array
$results=array();
//get all leads details
$getAll_reviews = $db->GetReviews();
if($getAll_reviews){
    foreach($getAll_reviews as $review){
        array_push($results,$review);
    }   
}
//fill result in json file
$fp = fopen('json/reviews.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>