<?php
//Get base class
require_once '../../libraries/base.php';
//Get brand class
require_once '../../libraries/Ser_Settings.php';
$db = new Ser_Settings();
$err=-1;

if(isset($_POST['settingsId'])) $settingsId=$_POST['settingsId'];
else $settingsId=0;

//get data from form
$aboutus=$_POST['aboutus'];

if($settingsId>0){
    //Edit aboutus
    $edit_aboutus=$db->editAboutus($aboutus);
    if($edit_aboutus) $err=0;
    else $err=1;
}else{
    // add aboutus
    $add_aboutus=$db->addAboutus($aboutus);
    if($add_aboutus) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>