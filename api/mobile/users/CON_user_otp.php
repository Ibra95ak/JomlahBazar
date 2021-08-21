<?php
/**
  *Download the helper library from https://github.com/twilio/authy-php
  *Update the path below to your autoload.php,
  *see https://getcomposer.org/doc/01-basic-usage.md
  */
require_once '../../../vendor/autoload.php';
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../' . DIR_MOD . 'Ser_Users.php';
require_once '../../../' . DIR_MOD . 'Ser_Devices.php';

require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use Twilio\Rest\Client;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberParseException;

/*Create Users instance*/
$db = new Ser_Users();
/*Create Users instance*/
$dbd = new Ser_Devices();
/*URL parameters*/
$action = $_GET['action'];
/*Response Array*/
$response = array();
/*Start browser session*/
session_start();
/*live*/
$sid = "AC63aa63434d9d2b8ccba8a3cdbc464fe3";
$token = "36a6dd97d365432966da870e9261d02a";
/*test*/

$twilio = new Client($sid, $token);
/*URL parameters*/
$action=$_GET['action'];
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;

if ($action=='login') {
    $phone=$_POST['login_phone'];
    $cc=$_POST['cc'];
    $usertype=$_POST['usertype'];
    /*Check if user already exist*/
    $users=$db->getUserByotp($cc.$phone);
    if ($users) {
        $activeuser=$db->IsActivatedUser($users['userId']);
        if($activeuser['active']==2){
          $response['err']=1;
        }else{
          // correct token
          switch ($usertype) {
            case 2:
              $setusertype=$db->SetSupplier($cc.$phone);
              break;
            case 3:
              $setusertype=$db->SetAffiliate($cc.$phone);
              break;
            default:
              break;
          }
          $ver_phone = "+".$cc.$phone;
          /*live*/
          $verification = $twilio->verify->v2->services("VAd6362776457dc20131278654a2c215e5")
                                             ->verifications
                                             ->create($ver_phone, "sms");
          /*test*/
          $_SESSION['Login_as']=$usertype;
          $response['err']=0;
        }
    } else {
        $response['err']=2;
    }
}
if ($action == 'signup') {
  /*Check for empty inputs*/
  if (isset($_POST['phone'])) {
    /*Receiving form parameters*/
    $users_phone = $_POST['phone'];
    $ver_phone = '+'.$users_phone;
    /*Check if mobile is valid*/
    $check_number = PhoneNumber::parse($ver_phone);
    if ($check_number->isValidNumber()) {
      /*Check if mobile already exist*/
      if ($db->IsExistUser($users_phone)) {
        $response['err'] = 1;
      } else {
        /*live*/
        $verification = $twilio->verify->v2->services("VAd6362776457dc20131278654a2c215e5")
                                           ->verifications
                                           ->create($ver_phone, "sms");
        $response['err'] = 0;
      }
    }else {
      $response['err'] = 4;
    }
  } else {
    /*Missing required parameters*/
    $response['err'] = 3;
  }
}
if ($action=='verify') {
    $token_entered_by_user = $_POST['login_token'];
    $phone = "+".$_POST['otp'];
    $usertype=$_POST['ver_usertype'];
    $users = $db->getUserByotp($_POST['otp']);
    /*live*/
    $verification_check = $twilio->verify->v2->services("VAd6362776457dc20131278654a2c215e5")
                                             ->verificationChecks
                                             ->create($token_entered_by_user, // code
                                                      ["to" => $phone]
                                             );

    switch ($verification_check->status) {
      case 'approved':
        $logged = $db->loggedUser($users['userId']);
        $response['userId']=$users['userId'];
        $response['err']=0;
        break;
      case 'pending':
        $response['err']=3;
        break;
      case 'canceled':
        $response['err']=4;
        break;
      default:
        // code...
        break;
    }
}
if ($action=='verify-signup') {
    $token_entered_by_user = $_POST['token'];
    $phone = "+".$_POST['phone'];
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $user_type=$_POST['usertypesu'];
    switch ($user_type) {
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
    $users = $db->getUserByotp($_POST['phone']);
    /*live*/
    $verification_check = $twilio->verify->v2->services("VAd6362776457dc20131278654a2c215e5")
                                             ->verificationChecks
                                             ->create($token_entered_by_user, // code
                                                      ["to" => $phone]
                                             );
    switch ($verification_check->status) {
      case 'approved':
        $jbidentifier = $db->hashSSHA($email . date("Y-m-d h:i:s"))['encrypted'];
        /*Create new user*/
        $users = $db->AddUser($fullname, $email, $_POST['phone'], $type, $is_buyer, $is_seller, NULL, NULL, NULL, $jbidentifier);
        $usersId=$users['insertId'];
        $activation_code=rawurlencode($users['activation_code']);
        $activation_salt=rawurlencode($users['activation_salt']);
        if ($activation_code!='') {
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
              $response['err']=1;
          }
          /* Send Email */
        }
        if ($users) {
          /*User stored successfully*/
          $logged = $db->loggedUser($usersId);
          $response['err'] = 0;
          $response['userId'] = $usersId;
        } else {
          /*User failed to store*/
          $response['err'] = 2;
        }
        break;
      case 'pending':
       echo "555";
        $response['err']=3;
        break;
      case 'canceled':
       echo "666";
        $response['err']=4;
        break;
      default:
        // code...
        break;
    }
}
if ($action=='resendotp') {
    $ver_phone="+".$_POST['otp'];
          /*live*/
          $verification = $twilio->verify->v2->services("VAd6362776457dc20131278654a2c215e5")
                                             ->verifications
                                             ->create($ver_phone, "sms");
          $_SESSION['Login_as']=$usertype;
          $response['err']=0;
}
echo json_encode($response);
