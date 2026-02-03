<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$subject = 'Vielen Dank für Ihre Anmeldung'; // Default subject

$email_to = $_POST['email'];

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'dontgiveupfreddie@gmail.com';
    $mail->Password   = 'sdjwjfebviulmzyf'; // App password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('info@ravithareinigung.ch', 'Jetzt abonnieren Ravitha');
    $mail->addAddress('freddielogin@gmail.com'); // receive mail here
    $mail->addReplyTo($email_to, '');

    $template = file_get_contents("newsletter_template.html");
    $template = str_replace(
        ['{{email}}'],
        [$email_to],
        $template
    );

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body  = $template;

    $mail->send();
    echo "Nachricht erfolgreich gesendet!";
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}

?>
