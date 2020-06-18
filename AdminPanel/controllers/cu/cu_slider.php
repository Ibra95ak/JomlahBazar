<?php
/*Get base class*/
require_once '../../libraries/base.php';
/*Get sliders class*/
require_once '../../libraries/Ser_Sliders.php';
/*create sliders instance*/
$db = new Ser_Sliders();
/*intialize error flag*/
$err=-1;
/*fetch sliderId from post request*/
if(isset($_POST['sliderId'])) $sliderId=$_POST['sliderId'];
else $sliderId=0;
/*fetch data sent by form*/
$header1=$_POST['header1'];
$header2=$_POST['header2'];
$btn_link=$_POST['btn_link'];
$btn_text=$_POST['btn_text'];
/*start::upload image*/
$target_dir = "../../pics/sliders/";/*directory to upload to*/
$target_file = $target_dir . basename($_FILES["path"]["name"]);/*image full path*/
$path=substr($target_file, 6);/*removing '../../'*/
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));/*get image type*/
/*upload image function*/
if (move_uploaded_file($_FILES["path"]["tmp_name"], $target_file)) $err=0;
else $err=1;
/*end::upload image*/
/*activate/deactivate slider*/
if(isset($_POST['active'])) $active=1;
else $active=2;
/*manage slider*/
if($sliderId>0){
    if($target_file==$target_dir){
        /*get old image path*/
        $path=$db->GetSliderById($sliderId)['path'];
    }
    /*Edit slider function*/
    $edit_slider=$db->editSlider($sliderId, $header1, $header2, $path, $btn_link, $btn_text, $active);
    if($edit_slider) $err=0;
    else $err=1;
}else{
    /*add slider function*/
    $add_slider=$db->addSlider($header1, $header2, $path, $btn_link, $btn_text, $active);
    if($add_slider) $err=0;
    else $err=1;
}
echo json_encode($err);
exit;
?>
