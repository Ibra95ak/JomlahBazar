<?php
//Get base class
require_once '../../libraries/Base.php';
//Get discounttype class
require_once '../../libraries/Ser_Discounttypes.php';
$db = new Ser_Discounttypes();
$err=-1;

if(isset($_POST['discounttypeId'])) $discounttypeId=$_POST['discounttypeId'];
else $discounttypeId=0;

//get data from form
$type=$_POST['type'];
$active=$_POST['active'];

if($discounttypeId>0){
    //Edit discounttype
    $edit_discounttype=$db->editDiscounttype($discounttypeId,$type,$active);
    if($edit_discounttype) $err=0;
    else $err=1;
}else{
    //add discounttype
    $add_discounttype=$db->addDiscounttype($type,$active);
    if($add_discounttype) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>