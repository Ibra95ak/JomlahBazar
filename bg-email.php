<?php
session_start();

require_once 'model/Base.php';/*fetch Directory variables*/
require_once 'vendor/autoload.php';
require_once 'mail/mail.php';

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'jomlahbazar@jomlahbazar.com';                     // SMTP username
    $mail->Password   = 'Notify@pomechain20';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('jomlahbazar@jomlahbazar.com', 'Jomlahbazar');
    $mail->addAddress('ibrahim.aboukhalil@pomechain.com', "Ibra");     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Automatic email';
    $msg ="this is an automatic email fron server";
    $mail->Body    = $msg;
    $mail->send();
    $response['err']=0;
} catch (Exception $e) {
    $response['err']=1;
}
?>
