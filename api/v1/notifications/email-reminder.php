<?php
session_start();

require_once '../../../model/Base.php';/*fetch Directory variables*/
require_once '../../../vendor/autoload.php';

require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';
require_once '../../../' . DIR_MOD . 'Ser_Notif.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/*Response Array*/
$response=array();
$response['unseen_users_notify']=array();
$db = new Ser_Notif();
/*get users' unseen notifications*/
$notify = $db->getUnseenNotifications();
if($notify){
  foreach ($notify as $noti) {
    $notification_email=$noti['email'];
    $notification_fullname=urlencode($noti['fullname']);
    $notification_order=$noti['orderId'];
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
        $mails->addAddress($notification_email, $notification_fullname);     // Add a recipient

        // Content
        $mails->isHTML(true);                                  // Set email format to HTML
        $mails->Subject = 'Your Order has been sent.';
        $temp_url= DIR_ROOT."mail/templates/new_order.php?name=$notification_fullname&orderId=$notification_order";
        $msg =file_get_contents($temp_url);
        $mails->Body    = $msg;
        $mails->send();
        $response['err']=0;
    } catch (Exception $e) {
        $response['err']=1;
    }
  }
}
?>
