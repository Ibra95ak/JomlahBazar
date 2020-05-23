<?php
/*Get AAA class*/
require_once '../libraries/Ser_AAA.php';
/*Create AAA instance*/
$db = new Ser_AAA();
/*start session*/
session_start();
/*flag for errors*/
$err=-1;
/*Check if inputs are empty before submission*/
if ((isset($_POST['aaa_email']) && isset($_POST['aaa_password']))) {
    /*Get input values*/
    $aaa_email = $_POST['aaa_email'];
    $aaa_password = $_POST['aaa_password'];	
    /*get user by email and password*/
    $aaa_user = $db->getAAAByEmailAndPassword($aaa_email, $aaa_password);	
    
    if ($aaa_user != false) {
        /*aaa data is found*/
        /*Check if admin is activated*/
        if($aaa_user['activation_code']==1){
            $err=0;
            /*set user as logged in*/
            $logged = $db->loggedAAA($aaa_user['aaaId']);
            $_SESSION['aaaId']=$aaa_user['aaaId'];
        } 
        else $err=1;
    } else {
        /*aaa is not found with the credentials*/
        $err=2;
    }	
} else {
    /*required post params is missing*/
    $err=3;
}
echo json_encode($err);
?>