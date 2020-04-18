<?php
//Get base class
require_once '../libraries/Base.php';
//Get login class
require_once '../libraries/DB_Admin.php';
$db = new DB_Admin();
//Check if all inputs are not empty
if (isset($_POST['username']) && isset($_POST['password'])) {
    // receiving the post params
    $username = $_POST['username'];
	$password = $_POST['password'];
    $err=-1;
        // create a new user
        $user = $db->addAdmin($username,$password);
         if ($user) {
            // user stored successfully
             $err=0;
		 } else {
            // user failed to store
             $err=1;
        } 
} else {
    //required parameters
    $err=2;
}
echo json_encode($err);
?>