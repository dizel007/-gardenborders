<?php

require $mail_path.'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_many_emails($send_email, $thema, $body_Email, $mail_for_send_letter, $mail_pass) {
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->CharSet = 'utf-8';
    $mail->Host = 'ssl://smtp.yandex.ru';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = $mail_for_send_letter;
    $mail->Password = $mail_pass;
    $mail->SMTPSecure = 'tls';
    $mail->setFrom('tender@anmaks.ru', $thema.' Gardenborders');
    $mail->addAddress($send_email);
    $mail->isHTML(true);
    $mail->Subject = $thema;
    $mail->Body = $body_Email;
    
    $mail->send();
    $text = date('Y-m-d H:m:s').' Сообщение отправлено на почту: '.$send_email;
    
} catch (Exception $e) {
    $text = date('Y-m-d H:m:s')." Не получилось отправить сообщение на почту: ".$send_email. "Error: {$mail->ErrorInfo}";
}
return $text;
}



