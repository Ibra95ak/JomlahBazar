<?php
//Get base class
require_once '../libraries/Base.php';
//Get supplier class
require_once '../libraries/Ser_Suppliers.php';
$db = new Ser_Suppliers();
//results array
$results=array();
//get all leads details
$getAll_suppliers = $db->GetSuppliers();
foreach($getAll_suppliers as $supplier){
    array_push($results,$supplier);
}

$fp = fopen('json/suppliers.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>