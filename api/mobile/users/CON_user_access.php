<?php
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../'.DIR_MOD.'Ser_Users.php';
require_once '../../../'.DIR_MOD.'Ser_Devices.php';
require_once '../../../vendor/autoload.php';
require_once '../../../mail/mail.php';

require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\DeviceParserAbstract;
use Vectorface\Whip\Whip;
$userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse

/*Create Users instance*/
$db = new Ser_Users();
/*Create Users instance*/
$dbd = new Ser_Devices();
/*URL parameters*/
$action=$_GET['action'];
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
/*Start browser session*/
if ($action == 'signup') {
  /*Check for empty inputs*/
  if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['phone'])) {
    /*Receiving form parameters*/
    $users_fullname = $_POST['fullname'];
    $users_email = $_POST['email'];
    $users_phone = $_POST['phone'];
    $users_type = $_POST['usertypesu'];
    switch ($users_type) {
      case 1:
        $type = 0;
        $is_buyer = 1;
        $is_seller = 2;
        break;
      case 2:
        $type = 3;
        $is_buyer = 1;
        $is_seller = 1;
        break;

      default:
        $type = 0;
        $is_buyer = 1;
        $is_seller = 2;
        break;
    }
    /*Check if email already exist*/
    if ($db->IsExistUser($users_email, $users_phone)) {
      $response['err'] = 1;
    } else {
      $jbidentifier = $db->hashSSHA($users_email . date("Y-m-d h:i:s"))['encrypted'];
      /*Create new user*/
      $users = $db->AddUser($users_fullname, $users_email, $users_phone, $type, $is_buyer, $is_seller, NULL, NULL, NULL, $jbidentifier);
      /*Create trusted device*/
      $devices = $dbd->AddUserDevice($users['insertId'], $type, $os, $os_version, $os_platform, $browser, $browser_version, $engine, $clientIPAddress);
      $usersId=$users['insertId'];
      $activation_code=rawurlencode($users['activation_code']);
      $activation_salt=rawurlencode($users['activation_salt']);
      /* Send Email seller*/
      $mails = new PHPMailer(true);
      try {
          //Server settings
          //$mails->SMTPDebug = SMTP::DEBUG_SERVER;
          $mails->isSMTP();                                            // Send using SMTP
          $mails->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
          $mails->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mails->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
          $mails->Password   = 'Notify@pomechain20';                               // SMTP password
          $mails->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
          $mails->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

          //Recipients
          $mails->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
          $mails->addAddress($users_email, $users_fullname);     // Add a recipient

          // Content
          $mails->isHTML(true);                                  // Set email format to HTML
          $mails->Subject = 'Activate Your Account';
          $msg ='<h3>Click <a href="'.DIR_CONT.DIR_USR.'CON_user_access.php?action=activate&userId='.$usersId.'&activation_code='.$activation_code.'&activation_salt='.$activation_salt.'">here</a> to activate your account.</h3>';
          $mails->Body    = $msg;
          $mails->send();
          $response['err']=0;
      } catch (Exception $e) {
        echo "4444";
          $response['err']=2;
      }

      /* Send Email */

      if ($users) {
        /*User stored successfully*/
        $response['err'] = 0;
      } else {
        /*User failed to store*/
        $response['err'] = 3;
      }
    }
  } else {
    /*Missing required parameters*/
    $response['err'] = 3;
  }
}
if ($action=='signin') {
    /*Check for empty inputs*/
    if ((isset($_POST['login_email']) && isset($_POST['password']))) {
        /*Receiving form parameters*/
        $email = $_POST['login_email'];
        $password = $_POST['password'];
        /*Get user data*/
        $users = $db->getUserByEmailAndPassword($email, $password);
        if ($users != NULL) { /*User found*/
            /*Check if user is activated*/
            if ($users['activation_code']==1 && $users['activation_salt']==1) {
                $response['err']=0;
                $response['userId']=$users['userId'];
                /*Set user as logged in*/
                $logged = $db->loggedUser($users['userId']);
                $_SESSION['userId']=$users['userId'];
            } else {
              /*User is not activated*/
                $response['err']=1;
            }
        } else {
            /*User is not found with the credentials*/
            $response['err']=2;
        }
    } else {
        /*Required post params is missing*/
        $response['err']=3;
    }
}
if ($action=='g-signin') {
    /*Get $id_token via HTTPS POST.*/
    $id_token=$_GET['idtoken'];
    $CLIENT_ID='301552150059-pu3l9ca3mon5qhjreksj12nflqtd41ie.apps.googleusercontent.com';
    $client = new Google_Client(['client_id' => $CLIENT_ID]);  /*Specify the CLIENT_ID of the app that accesses the backend*/
    $payload = $client->verifyIdToken($id_token);/*Verifies the JWT signature*/
    if ($payload) {
        $user_iss = $payload['iss'];
        $user_sub = $payload['sub'];
        $user_aud = $payload['aud'];
        $user_exp = $payload['exp'];
        $user_email_verified = $payload['email_verified'];
        $user_name = $payload['name'];
        $user_email = $payload['email'];
        $user_picture = $payload['picture'];
        if($user_iss=='accounts.google.com' || $user_iss=='https://accounts.google.com') $response['err']=0;
        else $response['err']=4;
        if($user_aud==$CLIENT_ID) $response['err']=0;
        else $response['err']=4;
        if($user_exp > time()) $response['err']=0;
        else $response['err']=4;
        if($user_email_verified==1) $response['err']=0;
        else $response['err']=4;
        /*Check if user already exist*/
        $users=$db->getUserBygoogle($user_sub);
        if($users != null){
          /*Login*/
          $logged = $db->loggedUser($users['userId']);
          $_SESSION['userId']=$users['userId'];
          $response['err']=0;
        }else{
          /*Register*/
          /*Create new user*/
          $users = $db->AddUser($user_name, $user_email, NULL, $user_sub, NULL, NULL);
          /*Create trusted device*/
          $devices = $dbd->AddUserDevice($users['insertId'], $type, $os, $os_version, $os_platform, $browser, $browser_version, $engine, $clientIPAddress);
          $logged = $db->loggedUser($users['userId']);
          $_SESSION['userId']=$users['userId'];
          $response['err']=0;
        }

    } else {
        /*Invalid ID token*/
        $response['err']=4;
    }
}
if ($action=='l-signin') {
  require_once 'linkedin_config.php';
  try {
      $adapter->authenticate();
      $userProfile = $adapter->getUserProfile();
      $identifier=$userProfile->identifier;
      $photoURL=$userProfile->photoURL;
      $displayName=$userProfile->displayName;
      $emailVerified=$userProfile->emailVerified;
      $phone=$userProfile->phone;
      /*Check if user already exist*/
      $users=$db->getUserBylinkedin($identifier);
      if($users){
        /*Login*/
        $logged = $db->loggedUser($users['userId']);
        $_SESSION['userId']=$users['userId'];
        $response['err']=0;
        header("location:".DIR_VIEW.DIR_USR."dashboard.php");
      }else{
        /*Register*/
        /*Create new user*/
        $users = $db->AddUser($displayName, $emailVerified, $phone, NULL, $identifier, NULL);
        /*Create trusted device*/
        $devices = $dbd->AddUserDevice($users['insertId'], $type, $os, $os_version, $os_platform, $browser, $browser_version, $engine, $clientIPAddress);
        $logged = $db->loggedUser($users['userId']);
        $_SESSION['userId']=$users['userId'];
        $response['err']=0;
        header("location:".DIR_VIEW.DIR_USR."dashboard.php");
      }
  }
  catch( Exception $e ){
      echo $e->getMessage() ;
  }
}
echo json_encode($response);
