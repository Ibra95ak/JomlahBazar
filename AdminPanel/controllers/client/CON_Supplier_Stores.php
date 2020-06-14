<?php
/*Get store class*/
require_once '../../libraries/Ser_Stores.php';
$db = new Ser_Stores();
/*results array*/
$results=array();
/*Parameters*/
$supplierId=$_GET['supplierId'];
/*get all supplier stores*/
$get_supplierstores = $db->GetStoreBySupplierId($supplierId);
if($get_supplierstores){
    foreach($get_supplierstores as $store){
        array_push($results,$store);
    }
}
echo json_encode($results);
?>