<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$subject = 'Kontaktformular-Anfrage'; // Default subject

$name = $_POST['name'];
$email_to = $_POST['email']; 
$phone = $_POST['phone'];
$message = $_POST['message'];

/* $email = 'freddielogin@gmail.com'; 
$name = 'Raju';
$phone = '7854567890';
$message = 'This is a test message from the contact form.'; */   

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'dontgiveupfreddie@gmail.com';
    $mail->Password   = 'sdjwjfebviulmzyf'; // App password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('info@ravithareinigung.ch', 'Kontaktanfrage Ravitha');
    $mail->addAddress('freddielogin@gmail.com'); // receive mail here
    $mail->addReplyTo($email_to, $name);

    $template = file_get_contents("email_template.html");
    $template = str_replace(
        ['{{name}}', '{{email}}', '{{phone}}', '{{message}}'],
        [$name, $email_to, $phone, $message],
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
