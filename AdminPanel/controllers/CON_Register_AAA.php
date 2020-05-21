<?php
/*Get AAA class*/
require_once '../libraries/Ser_AAA.php';
/*Create AAA instance*/
$db = new Ser_AAA();
/*Check if all inputs are not empty*/
if (isset($_POST['aaa_email']) && isset($_POST['aaa_password']) && isset($_POST['aaa_cpassword'])) {
    /*receiving the post params*/
    $aaa_email = $_POST['aaa_email'];
	$aaa_password = $_POST['aaa_password'];
    /*Error flag*/
    $err=-1;
    /*Check if email already exist*/
    if($db->isExist_aaaEmail($aaa_email)) $err=1;
    else{
     /*create a new aaa*/
        $aaa = $db->addAAA($aaa_email,$aaa_password);
        /*
        $aaaId=$aaa['insertId'];
        $activation_code=rawurlencode($aaa['activation_code']); 
        $activation_salt=rawurlencode($aaa['activation_salt']); 
        */
         if ($aaa) {
            /*aaa stored successfully*/
             $err=0;
		 } else {
            /*aaa failed to store*/
             $err=2;
        }   
    }      
} else {
    //required parameters
    $err=3;
}
echo json_encode($err);
?>