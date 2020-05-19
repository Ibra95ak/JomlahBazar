<?php
//Get base class
require_once '../libraries/base.php';
//Get wallet class
require_once '../libraries/Ser_Wallets.php';
$db = new Ser_Wallets();
//results array
$results=array();
//get all leads details
$getAll_wallets = $db->GetWallets();
if($getAll_wallets){
    foreach($getAll_wallets as $wallet){
        array_push($results,$wallet);
    }    
}
//fill result in json file
$fp = fopen('json/wallets.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
?>