<?php
//Get base class
require_once '../libraries/Base.php';
//Get wishlist class
require_once '../libraries/Ser_Wishlists.php';
$db = new Ser_Wishlists();
//results array
$results=array();
//get all leads details
$getAll_wishlists = $db->GetWishlists();
foreach($getAll_wishlists as $wishlist){
    array_push($results,$wishlist);
}

$fp = fopen('json/wishlists.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>