<?php
//Get base class
require_once '../libraries/Base.php';
//Get admin class
require_once '../libraries/Ser_Admin.php';
$db = new Ser_Admin();

//get action value
if(isset($_GET['action'])) $action=$_GET['action'];
else $action='';

//delete admin
if($action=='delete' && isset($_GET['adminId'])){
    $del_admins = $db->DeleteAdminById($_GET['adminId']);
}
//results array
$results=array();
//get all leads details
$getAll_admins = $db->GetAdmins();
foreach($getAll_admins as $admin){
    array_push($results,$admin);
}

$fp = fopen('json/admins.json', 'w');
fwrite($fp, json_encode($results));
fclose($fp);
header("Location:".DIR_ROOT.DIR_ADMINP."por_admins.php")
?>