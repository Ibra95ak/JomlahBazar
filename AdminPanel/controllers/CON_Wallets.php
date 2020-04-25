<?php
//Get base class
require_once '../libraries/Base.php';
//Get wallet class
require_once '../libraries/Ser_Wallets.php';
$db = new Ser_Wallets();
//results array
$results=array();
//get all leads details
$getAll_wallets = $db->GetWallets();
foreach($getAll_wallets as $wallet){
    array_push($results,$wallet);
}

$fp = fopen('json/wallets.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>