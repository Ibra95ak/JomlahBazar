<?php
//Get base class
require_once '../libraries/base.php';
//Get registeredsupplier class
require_once '../libraries/Ser_Registeredsuppliers.php';
$db = new Ser_Registeredsuppliers();
//results array
$results=array();
//get all leads details
$getAll_registeredsuppliers = $db->GetRegisteredsuppliers();
if($getAll_registeredsuppliers){
    foreach($getAll_registeredsuppliers as $registeredsupplier){
        array_push($results,$registeredsupplier);
    }
}
//fill result in json file
$fp = fopen('json/registeredsuppliers.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>