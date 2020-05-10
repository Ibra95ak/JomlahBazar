<?php
//Get admin class
require_once '../libraries/Ser_Admin.php';
$db = new Ser_Admin();
//start session
session_start();
$err=-1;
//Check if inputs are empty before submission
if ((isset($_POST['username']) && isset($_POST['password']))) {
    //Get input values
    $username = $_POST['username'];
    $password = $_POST['password'];	
    // get the admin by username and password
    $admin = $db->getAdminByUsernameAndPassword($username, $password);	
    
    if ($admin != false) {
        // admin is found
        
        //Check if admin is activated
        if($admin['active']==1){
            $err=0;
            //set user as logged in
            $logged = $db->loggedAdmin($admin['adminId']);
            $_SESSION['adminId']=$admin['adminId'];
        } 
        else $err=1;
    } else {
        // admin is not found with the credentials
        $err=2;
    }	
} else {
    // required post params is missing
    $err=3;
}
echo json_encode($err);
?>