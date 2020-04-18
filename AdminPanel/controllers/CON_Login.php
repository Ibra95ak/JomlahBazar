<?php
//Get base class
require_once '../libraries/Base.php';
//Get login class
require_once '../libraries/DB_Admin.php';
$db = new DB_Admin();
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
        // save adminId in sessions for security reasons
        $_SESSION['adminId']=$admin["adminId"];
        $err=0;
    } else {
        // admin is not found with the credentials
        $err=1;
    }	
} else {
    // required post params is missing
    $err=2;
}
echo json_encode($err);
?>