<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../' . DIR_MOD . 'Ser_Users.php';
require_once '../../../' . DIR_MOD . 'Ser_Devices.php';
require_once '../../../vendor/autoload.php';

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
$dd = new DeviceDetector($userAgent);
$dd->parse();
/*get current user device info*/
if ($dd->isBot()) {
  // handle bots,spiders,crawlers,...
  $botInfo = $dd->getBot();
} else {
  $type = $dd->getDeviceName();
  $clientInfo = $dd->getClient(); // holds information about browser, feed reader, media player, ...
  $browser = $clientInfo['name'];
  $browser_version = $clientInfo['version'];
  $engine = $clientInfo['engine'];
  $osInfo = $dd->getOs();
  $os = $osInfo['name'];
  $os_version = $osInfo['version'];
  $os_platform = $osInfo['platform'];
}
/*get client ip address*/
$whip = new Whip();
$clientIPAddress = $whip->getValidIpAddress();

/*Create Users instance*/
$db = new Ser_Users();
/*Create Users instance*/
$dbd = new Ser_Devices();
/*URL parameters*/
$action = $_GET['action'];
/*Response Array*/
$response = array();
/*Error flag*/
$response['err'] = -1;
/*Start browser session*/
session_start();
if ($action == 'signin') {
  /*Check for empty inputs*/
  if ((isset($_POST['login_email']) && isset($_POST['password']))) {
    /*Receiving form parameters*/
    $email = $_POST['login_email'];
    $password = $_POST['password'];
    /*Get user data*/
    $users = $db->getUserByEmailAndPassword($email, $password);
    if ($users != NULL) { /*User found*/
      /*Check if user is activated*/
      if ($users['activation_code'] == 1 && $users['activation_salt'] == 1) {
        $response['err'] = 0;
        $response['userId'] = $users['userId'];
        /*Set user as logged in*/
        $logged = $db->loggedUser($users['userId']);
        $_SESSION['userId'] = $users['userId'];
      } else {
        /*User is not activated*/
        $response['err'] = 1;
      }
    } else {
      /*User is not found with the credentials*/
      $response['err'] = 2;
    }
  } else {
    /*Required post params is missing*/
    $response['err'] = 3;
  }
}
if ($action == 'g-signin') {
  /*Get $id_token via HTTPS POST.*/
  $id_token = $_GET['idtoken'];
  $CLIENT_ID = '301552150059-pu3l9ca3mon5qhjreksj12nflqtd41ie.apps.googleusercontent.com';
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
    if ($user_iss == 'accounts.google.com' || $user_iss == 'https://accounts.google.com') $response['err'] = 0;
    else $response['err'] = 4;
    if ($user_aud == $CLIENT_ID) $response['err'] = 0;
    else $response['err'] = 4;
    if ($user_exp > time()) $response['err'] = 0;
    else $response['err'] = 4;
    if ($user_email_verified == 1) $response['err'] = 0;
    else $response['err'] = 4;
    /*Check if user already exist*/
    $users = $db->getUserBygoogle($user_sub);
    if ($users != null) {
      /*Login*/
      $logged = $db->loggedUser($users['userId']);
      $_SESSION['userId'] = $users['userId'];
      $response['err'] = 0;
    } else {
      /*Register*/
      $jbidentifier = $db->hashSSHA($user_email . date("Y-m-d h:i:s"))['encrypted'];
      /*Create new user*/
      $users = $db->AddUser($user_name, $users_email, NULL, 0, 1, 2, NULL, NULL, NULL, $jbidentifier);
      /*Create trusted device*/
      $devices = $dbd->AddUserDevice($users['insertId'], $type, $os, $os_version, $os_platform, $browser, $browser_version, $engine, $clientIPAddress);
      $logged = $db->loggedUser($users['userId']);
      $_SESSION['userId'] = $users['userId'];
      $response['err'] = 0;
    }
  } else {
    /*Invalid ID token*/
    $response['err'] = 4;
  }
}
if ($action == 'l-signin') {
  require_once 'linkedin_config.php';
  try {
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();
    $identifier = $userProfile->identifier;
    $photoURL = $userProfile->photoURL;
    $displayName = $userProfile->displayName;
    $emailVerified = $userProfile->emailVerified;
    $phone = $userProfile->phone;
    /*Check if user already exist*/
    $users = $db->getUserBylinkedin($identifier);
    if ($users) {
      /*Login*/
      $logged = $db->loggedUser($users['userId']);
      $_SESSION['userId'] = $users['userId'];
      $response['err'] = 0;
      header("location:" . DIR_VIEW . DIR_USR . "dashboard.php");
    } else {
      /*Register*/
      $jbidentifier = $db->hashSSHA($emailVerified . date("Y-m-d h:i:s"))['encrypted'];
      /*Create new user*/
      $users = $db->AddUser($displayName, $emailVerified, $phone, 0, 1, 2, $identifier, NULL, NULL, $jbidentifier);
      /*Create trusted device*/
      $devices = $dbd->AddUserDevice($users['insertId'], $type, $os, $os_version, $os_platform, $browser, $browser_version, $engine, $clientIPAddress);
      $logged = $db->loggedUser($users['userId']);
      $_SESSION['userId'] = $users['userId'];
      $response['err'] = 0;
      header("location:" . DIR_VIEW . DIR_USR . "dashboard.php");
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}
if ($action == 'activate'){
  $userId = $_GET['userId'];
  $activation_code = $_GET['activation_code'];
  $activation_salt = $_GET['activation_salt'];
  /*Activate new user account*/
  $users = $db->ActivateUserAccount($userId,$activation_code,$activation_salt);
  if ($users) {
    $response['err'] = 0;
  }else {
    $response['err'] = 4;
  }
  header("location:".DIR_VIEW.DIR_USR."login.php?err=".$response['err']);
  exit;
}
if ($action == 'switch-buyer') {
  $_SESSION['Login_as']=1;
}
if ($action == 'switch-seller') {
  $_SESSION['Login_as']=2;
}
if ($action == 'login') {
  $jbidentifier=$_GET['jbidentifier'];
  $users = $db->getUserByJBID($jbidentifier);
  $logged = $db->loggedUser($users['userId']);
  $_SESSION['userId']=$users['jbidentifier'];
  if ($users['is_buyer']==1) $usertype = 1;
  else $usertype = 2;
  $_SESSION['Login_as']=$usertype;
  header("Location:".DIR_ROOT);
  exit;
}
echo json_encode($response);
