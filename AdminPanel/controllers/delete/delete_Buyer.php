<?php
//Get base class
require_once '../../libraries/base.php';
//Get buyer class
require_once '../../libraries/Ser_Buyers.php';
$db = new Ser_Buyers();
$err=-1;
//delete buyers
if(isset($_GET['userId'])){
    $del_buyers = $db->DeleteBuyerById($_GET['userId']);
}
if($del_buyers){
    $err=0; 
    echo($err);
}else{
    $err=1;
}
header("Location:".DIR_ROOT.DIR_ADMINP."por_buyers.php?err=$err");
exit;
?>