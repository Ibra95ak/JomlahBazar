<?php
/*get base class*/
require_once '../../libraries/base.php';
/*get slider class*/
require_once '../../libraries/Ser_Sliders.php';
/*create slider instance*/
$db = new Ser_Sliders();
/*initialize error flag*/
$err=-1;
/*delete slider*/
if(isset($_GET['sliderId'])) $del_Sliders = $db->DeleteSliderById($_GET['sliderId']);
if($del_Sliders) $err=0;
else $err=1;
/*redirect to datatable page*/
header("Location:".DIR_ROOT.DIR_ADMINP."por_Sliders.php?err=$err");
exit;
?>
