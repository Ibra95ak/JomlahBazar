<?php
//Get base class
require_once '../../libraries/base.php';
//Get registeredsupplier class
require_once '../../libraries/Ser_Registeredsuppliers.php';
$db = new Ser_Registeredsuppliers();
$err=-1;

if(isset($_POST['registeredsupplierId'])) $registeredsupplierId=$_POST['registeredsupplierId'];
else $registeredsupplierId=0;

//get data from form
$registered_name=$_POST['registered_name'];
$creditcardId=$_POST['creditcardId'];

if($registeredsupplierId>0){
    //Edit registeredsupplier
    $edit_registeredsupplier=$db->editRegisteredsupplier($registeredsupplierId,$registered_name,$creditcardId);
    if($edit_registeredsupplier) $err=0;
    else $err=1;
}else{
    //add registeredsupplier
    $add_registeredsupplier=$db->addRegisteredsupplier($registered_name,$creditcardId);
    if($add_registeredsupplier) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>