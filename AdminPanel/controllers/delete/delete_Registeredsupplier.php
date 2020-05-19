<?php
//Get base class
require_once '../../libraries/base.php';
//Get registeredsupplier class
require_once '../../libraries/Ser_Registeredsuppliers.php';
$db = new Ser_Registeredsuppliers();
$err=-1;
//delete registeredsupplier
if(isset($_GET['registeredsupplierId'])){
    $del_registeredsuppliers = $db->DeleteRegisteredsupplierById($_GET['registeredsupplierId']);
}
if($del_registeredsuppliers){
    $err=0; 
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_registeredsuppliers.php?err=$err");
exit;
?>