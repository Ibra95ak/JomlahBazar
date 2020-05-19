<?php
//Get base class
require_once '../libraries/base.php';
//Get faq class
require_once '../libraries/Ser_Faqs.php';
$db = new Ser_Faqs();
//results array
$results=array();
//get all leads details
$getAll_faqs = $db->GetFaqs();
if($getAll_faqs){
    foreach($getAll_faqs as $faq){
        array_push($results,$faq);
    }   
}
//fill result in json file
$fp = fopen('json/faqs.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>