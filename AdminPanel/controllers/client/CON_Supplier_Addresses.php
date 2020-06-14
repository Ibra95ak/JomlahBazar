<?php
/*Get address class*/
require_once '../../libraries/Ser_Addresses.php';
$db = new Ser_Addresses();
/*results array*/
$results=array();
/*Parameters*/
$supplierId=$_GET['supplierId'];
/*get all leads details*/
$get_supplieraddresses = $db->GetAddressBySupplierId($supplierId);
echo json_encode($get_supplieraddresses);
?>