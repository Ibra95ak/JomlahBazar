<?php
include('libraries/base.php');
session_start();
if(isset($_SESSION['adminId'])){
    //Get admin class
    require_once 'libraries/Ser_Admin.php';
    $db = new Ser_Admin();
    $checklogin= $db->islogin($_SESSION['adminId']);  
}else{
    //redirect to error page
    header("location:".DIR_ROOT.DIR_ADMINP."error.php");
}
if($checklogin){
include('header.php');
?>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
Content goes here... 
</div>
<!-- end:: Content -->
<?php 
include("footer.php");
//end login if clause
}else{
    //redirect to error page
    header("location:".DIR_ROOT.DIR_ADMINP."error.php");
}
?>
