<?php
/*Get brand class*/
require_once '../../libraries/Ser_Addresses.php';
/*Create brand Instance*/
$db = new Ser_Addresses();
/*results array*/
$results=array();
/*get brand details*/
$get_addresses = $db->Getaddresses();
if($get_addresses){
    foreach($get_addresses as $address){
        array_push($results,$address);
    }
}
echo json_encode($results);
?>