<?php
//Get base class
require_once '../../libraries/base.php';
//Get reachouts class
require_once '../../libraries/Ser_Reachouts.php';
$db = new Ser_Reachouts();
//results array
$results=array();
//get all leads details
$get_reachouts = $db->GetReachoutByaaaId($_GET['aaaId']);
echo json_encode($get_reachouts);
?>
