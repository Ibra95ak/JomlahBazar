<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
  *Download the helper library from https://github.com/twilio/authy-php
  *Update the path below to your autoload.php,
  *see https://getcomposer.org/doc/01-basic-usage.md
  */
require_once '../../../vendor/autoload.php';
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../' . DIR_MOD . 'Ser_Users.php';
require_once '../../../' . DIR_MOD . 'Ser_Addresses.php';
require_once '../../../' . DIR_MOD . 'Ser_Devices.php';
require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\DeviceParserAbstract;
use Vectorface\Whip\Whip;
use Twilio\Rest\Client;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberParseException;
$userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
$dd = new DeviceDetector($userAgent);
$dd->parse();
/*get current user device info*/
if ($dd->isBot()) {
  // handle bots,spiders,crawlers,...
  $botInfo = $dd->getBot();
} else {
  $device_type = $dd->getDeviceName();
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
$dba = new Ser_Addresses();
/*Create Users instance*/
$dbd = new Ser_Devices();
/*URL parameters*/
$action = $_GET['action'];
/*Response Array*/
$response = array();
$response['adrs'] = -1;
$response['cmp'] = -1;
$response['ro'] = -1;
/*Start browser session*/
ini_set('session.gc_maxlifetime', 1800);
session_set_cookie_params(1800);
session_start();
/*live*/
//$sid = "MGb76adc438be72ec2d0c3a28aa6d85c2d";
$sid = "AC63aa63434d9d2b8ccba8a3cdbc464fe3";
$token = "36a6dd97d365432966da870e9261d02a";
/*test*/
// $sid = "AC12ae364f17ea0c720d3ada44d9086d0d";
// $token = "b8712dcdc1cdc77ea1a4d727e147808f";
$twilio = new Client($sid, $token);
/*URL parameters*/
$action=$_GET['action'];
/*Response Array*/
$response=array();
/*Error flag*/
$response['err']=-1;
$response['userId']=0;

if ($action=='login') {
    $phone=$_POST['login_phone'];
    $cc=$_POST['cc'];
    $country=$_POST['iso2'];
    /*Check if user already exist*/
    $users=$db->getUserByotp($cc.$phone);
    if ($users) {
        $activeuser=$db->IsActivatedUser($users['userId']);
        if($activeuser['active']==2){
          $response['err']=1;
        }else{
          $ver_phone = "+".$cc.$phone;
          /*live*/
          $verification = $twilio->verify->v2->services("VAd6362776457dc20131278654a2c215e5")
                                             ->verifications
                                             ->create($ver_phone, "sms",["locale" => "en"]);
          /*test*/
          // $verification = $twilio->verify->v2->services("VA23794cea4601acdcc19692df63e3dc08")
          //                                    ->verifications
          //                                    ->create($ver_phone, "sms");
          $_SESSION['country']=$country;
          $response['err']=0;
        }
    } else {
        $response['err']=2;
    }
}
if ($action == 'signup') {
  /*Check for empty inputs*/
  if (isset($_POST['fullname']) && isset($_POST['login_phone_signup'])) {
    /*Receiving form parameters*/
    $users_phone = $_POST['otp_signup'];
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
                                           ->create($ver_phone, "sms",["locale" => "en"]);
        //print_r($verification);
        /*test*/
        // $verification = $twilio->verify->v2->services("VA23794cea4601acdcc19692df63e3dc08")
        //                                    ->verifications
        //                                    ->create($ver_phone, "sms");
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
    $users = $db->getUserByotp($_POST['otp']);
    $usertype=1;
    /*live*/
    $verification_check = $twilio->verify->v2->services("VAd6362776457dc20131278654a2c215e5")
                                             ->verificationChecks
                                             ->create($token_entered_by_user, // code
                                                      ["to" => $phone]
                                             );
    /*test*/
    // $verification_check = $twilio->verify->v2->services("VA23794cea4601acdcc19692df63e3dc08")
    //                                          ->verificationChecks
    //                                          ->create($token_entered_by_user, // code
    //                                                   ["to" => $phone]
    //                                          );
    switch ($verification_check->status) {
      case 'approved':
        $logged = $db->loggedUser($users['userId']);
        $_SESSION['userId']=$users['jbidentifier'];
        $_SESSION['Login_as']=$usertype;
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
    $token_entered_by_user = $_POST['signup_token'];
    $phone = "+".$_POST['otp_versignup'];
    $fullname=$_POST['signup_fullname'];
    $email=$_POST['signup_email'];
    $usertype=$_POST['signup_usertypesu'];
    switch ($usertype) {
      case '1':
        $type = 0;
        $is_buyer = 1;
        $is_seller = 2;
        break;
      case '2':
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
    $users = $db->getUserByotp($_POST['otp_versignup']);
    /*live*/
    $verification_check = $twilio->verify->v2->services("VAd6362776457dc20131278654a2c215e5")
                                             ->verificationChecks
                                             ->create($token_entered_by_user, // code
                                                      ["to" => $phone]
                                             );
    /*test*/
    // $verification_check = $twilio->verify->v2->services("VA23794cea4601acdcc19692df63e3dc08")
    //                                          ->verificationChecks
    //                                          ->create($token_entered_by_user, // code
    //                                                   ["to" => $phone]
    //                                          );
    switch ($verification_check->status) {
      case 'approved':
        $jbidentifier = $db->hashSSHA($email . date("Y-m-d h:i:s"))['encrypted'];
        /*Create new user*/
        $users = $db->AddUser($fullname, $email, $_POST['otp_versignup'], $type, $is_buyer, $is_seller, NULL, NULL, NULL, $jbidentifier);
        /*Create trusted device*/
        $devices = $dbd->AddUserDevice($users['insertId'], $device_type, $os, $os_version, $os_platform, $browser, $browser_version, $engine, $clientIPAddress);
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
              $mails->addAddress($email, $fullname);     // Add a recipient

              // Content
              $mails->isHTML(true);                                  // Set email format to HTML
              $mails->Subject = 'Activate Your Account';
              if ($usertype==1) {
                $msg = '<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Welcome to Jomlahbazar</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Hi '.$fullname.',</p><p>Congratulations! You are now an official buyer on JomlahBazar. You may now update your profile on jomlahBazar.com. Your profile is your digital hub for your fellow buyers and sellers so we encourage that you maximize your information in your profile. You may add your company’s social media, all your existing business messaging platform, and all other information you can share.</p><p>Once you are settled, you may now start exploring the marketplace. You may search by products/services, by location, or by profile. We are excited to start this journey with you!</p><p>Happy buying!</p><p>Thanks & best regards</p></td></tr><tr><td style="padding:20px 30px;margin:0;text-align:center;"><p><a href="'.DIR_CONT.DIR_USR.'CON_user_access.php?action=activate&userId='.$usersId.'&activation_code='.$activation_code.'&activation_salt='.$activation_salt.'" style="background:#fbaa00;color:#FFF;padding:10px;text-decoration:none;">Verify Email</a></p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
              }else {
                $msg = '<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Welcome to Jomlahbazar</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Hi '.$fullname.',</p><p>Congratulations! You are now an official seller on JomlahBazar. You may now update your profile on jomlahBazar.com. Your profile is your digital hub for your fellow buyers and sellers so we encourage that you maximize your information in your profile. You may add your company’s social media, all your existing business messaging platform, and all other information you can share.</p><p>Once you are settled, you may now start exploring the marketplace. You may search by products/services, by location, or by profile. We are excited to start this journey with you!</p><p>Happy buying!</p><p>Thanks & best regards</p></td></tr><tr><td style="padding:20px 30px;margin:0;text-align:center;"><p><a href="'.DIR_CONT.DIR_USR.'CON_user_access.php?action=activate&userId='.$usersId.'&activation_code='.$activation_code.'&activation_salt='.$activation_salt.'" style="background:#fbaa00;color:#FFF;padding:10px;text-decoration:none;">Verify Email</a></p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
              }
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
          $_SESSION['userId']=$jbidentifier;
          $_SESSION['Login_as']=$usertype;
          $response['err'] = 0;
        } else {
          /*User failed to store*/
          $response['err'] = 2;
        }
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
if ($action=='resendotp') {
    $ver_phone="+".$_POST['otp'];
          /*live*/
          $verification = $twilio->verify->v2->services("VAd6362776457dc20131278654a2c215e5")
                                             ->verifications
                                             ->create($ver_phone, "sms");
          /*test*/
    // $verification = $twilio->verify->v2->services("VA23794cea4601acdcc19692df63e3dc08")
    //                                          ->verifications
    //                                          ->create($ver_phone, "sms");
          $response['err']=0;
}
if ($action=='resendemail') {
    $reg_lgn=$_POST['reg_lgn'];
    if ($reg_lgn==2) {
          $phone = "+".$_POST['otp_versignup'];
          $fullname=$_POST['signup_fullname'];
          $email=$_POST['signup_email'];
          $usertype=$_POST['signup_usertypesu'];
          switch ($usertype) {
            case '1':
              $type = 0;
              $is_buyer = 1;
              $is_seller = 2;
              break;
            case '2':
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
          $jbidentifier = $db->hashSSHA($email . date("Y-m-d h:i:s"))['encrypted'];
          /*Create new user*/
          $users = $db->AddUser($fullname, $email, $_POST['otp_versignup'], $type, $is_buyer, $is_seller, NULL, NULL, NULL, $jbidentifier);
          /*Create trusted device*/
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
                $mails->addAddress($email, $fullname);     // Add a recipient

                // Content
                $mails->isHTML(true);                                  // Set email format to HTML
                $mails->Subject = 'Register to JomlahBazar';
                if ($usertype==1) {
                  $msg = '<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Welcome to Jomlahbazar</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Hi '.$fullname.',</p><p>Congratulations! You are now an official buyer on JomlahBazar. You may now update your profile on jomlahBazar.com. Your profile is your digital hub for your fellow buyers and sellers so we encourage that you maximize your information in your profile. You may add your company’s social media, all your existing business messaging platform, and all other information you can share.</p><p>Once you are settled, you may now start exploring the marketplace. You may search by products/services, by location, or by profile. We are excited to start this journey with you!</p><p>Happy buying!</p><p>Thanks & best regards</p></td></tr><tr><td style="padding:20px 30px;margin:0;text-align:center;"><p><a href="'.DIR_CONT.DIR_USR.'CON_user_access.php?action=activate&userId='.$usersId.'&activation_code='.$activation_code.'&activation_salt='.$activation_salt.'" style="background:#fbaa00;color:#FFF;padding:10px;text-decoration:none;">Verify Email</a></p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
                }else {
                  $msg = '<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;"> Welcome to Jomlahbazar</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Hi '.$fullname.',</p><p>Congratulations! You are now an official seller on JomlahBazar. You may now update your profile on jomlahBazar.com. Your profile is your digital hub for your fellow buyers and sellers so we encourage that you maximize your information in your profile. You may add your company’s social media, all your existing business messaging platform, and all other information you can share.</p><p>Once you are settled, you may now start exploring the marketplace. You may search by products/services, by location, or by profile. We are excited to start this journey with you!</p><p>Happy buying!</p><p>Thanks & best regards</p></td></tr><tr><td style="padding:20px 30px;margin:0;text-align:center;"><p><a href="'.DIR_CONT.DIR_USR.'CON_user_access.php?action=activate&userId='.$usersId.'&activation_code='.$activation_code.'&activation_salt='.$activation_salt.'" style="background:#fbaa00;color:#FFF;padding:10px;text-decoration:none;">Verify Email</a></p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
                }
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
            $_SESSION['userId']=$jbidentifier;
            $_SESSION['Login_as']=$usertype;
            $response['err'] = 0;
          } else {
            /*User failed to store*/
            $response['err'] = 2;
          }
    }else {
      $ver_phone=$_POST['otp'];
      $users = $db->getUserByotp($ver_phone);
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
          $mails->addAddress($users['email'], $users['fullname']);     // Add a recipient

          // Content
          $mails->isHTML(true);                                  // Set email format to HTML
          $mails->Subject = 'Jomlahbazar Login';
          $msg = '<table style="background:#EEE;padding:40px;border:1px solid #DDD;margin:0 auto;font-family:calibri;"><tr><td><table style="background:#FFF;width:100%;border:1px solid #CCC;padding:0;margin:0;border-collapse:collapse;max-width:100%;width:550px;border-radius:10px;"><tr><td style="padding:10px 30px;text-align:center;margin:0"><p> <a href="'.DIR_ROOT.'"> <img src="'.DIR_ROOT.DIR_MED.DIR_LOGO.'jb-logo-sm-black.png" width="100"> </a></p></td></tr><tr><td style="padding:10px 30px;margin:0;font-size:2.5em;color:#4A7BA5;text-align:center;">Login to Jomlahbazar</td></tr><tr><td style="padding:10px 30px;margin:0;text-align:left;"><p>Hi '.$users['fullname'].',</p><p>Please click on the link below to approve you login request.</p><p></p><p>Thanks & best regards</p></td></tr><tr><td style="padding:20px 30px;margin:0;text-align:center;"><p><a href="'.DIR_CONT.DIR_USR.'CON_user_access.php?action=login&jbidentifier='.$users['jbidentifier'].'" style="background:#fbaa00;color:#FFF;padding:10px;text-decoration:none;">Confirm Login.</a></p></td></tr><tr><td style="padding:10px 30px;margin:0;background:#555;color:#FFF;border-top:1px solid #CCC;"><p style="margin: 50px 0;text-align: center;"> <a style="display: inline-block;padding-right: 10px;" href="https://www.facebook.com/JomlahBazarPage/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'facebook.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.instagram.com/jomlahbazar/"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'instagram.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.linkedin.com/showcase/jomlahbazar"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'linkedin.png" width="25"/></a> <a style="display: inline-block;padding-right: 10px;" href="https://www.youtube.com/channel/UC6yAF6ATHlGn_npDA5jH7-g"><img src="'.DIR_ROOT.DIR_MED.DIR_CON.'youtube.png" width="25"/></a></p></td></tr></table></td></tr></table>';
          $mails->Body    = $msg;
          $mails->send();
          $response['err']=0;
      } catch (Exception $e) {
          $response['err']=1;
      }
      /* Send Email */
    }
    $response['err']=0;
}
echo json_encode($response);
