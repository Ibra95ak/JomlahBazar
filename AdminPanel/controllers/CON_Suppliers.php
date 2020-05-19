<?php
//Get base class
require_once '../libraries/base.php';
//Get supplier class
require_once '../libraries/Ser_Suppliers.php';
$db = new Ser_Suppliers();
//results array
$results=array();
//get all leads details
$getAll_suppliers = $db->GetSuppliers();
if($getAll_suppliers){
    foreach($getAll_suppliers as $supplier){
        array_push($results,$supplier);
    }
}
//fill result in json file
$fp = fopen('json/suppliers.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>