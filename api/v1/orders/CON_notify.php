<?php
session_start();
require_once '../../../model/Base.php';/*fetch Directory variables*/
/*Call Users class*/
require_once '../../../' . DIR_MOD . 'Ser_Notif.php';
require_once '../../../' . DIR_MOD . 'Ser_Orders.php';
require_once '../../../' . DIR_MOD . 'Ser_Users.php';

require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


$db = new Ser_Notif();
$dbo = new Ser_Orders();
$dbu = new Ser_Users();

//response array
$response = array();
/*Error flag*/
$response['err'] = -1;
$response['notifications'] = array();
$action = $_GET['action'];
if (isset($_GET['userId'])) $sellerId = $_GET['userId'];
else $sellerId = 0;
if (isset($_GET['orderId'])) $orderId = $_GET['orderId'];
else $orderId = 0;
if ($action == 'update-notifications') {
  /*update seller notification*/
  $notify = $db->notificationseen($sellerId,$orderId);
  /*send notify to buyer*/
  $order = $dbo->GetOrderUserId($orderId);
  $notify_buyer = $db->AddUserNotification($order['userId'], $orderId, 2);
  $user_info = $dbu->getUserById($order['userId']);
  $notification_email=$user_info['email'];
  $notification_fullname=$user_info['fullname'];
  $mail = new PHPMailer(true);
  try {
      //Server settings
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
      $mail->Password   = 'Notify@pomechain20';                               // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

      //Recipients
      $mail->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
      $mail->addAddress($notification_email, $notification_fullname);     // Add a recipient

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Your Order has been opened by seller.';
      $temp_url= DIR_ROOT."mail/templates/new_order.php?name=$notification_fullname&orderId=$orderId";
      $msg ="order seen by seller";
      $mail->Body    = $msg;
      $mail->send();
      $response['err']=0;
  } catch (Exception $e) {
      $response['err']=1;
  }
  echo json_encode($orders);
}
