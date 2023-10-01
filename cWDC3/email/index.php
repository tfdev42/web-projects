<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $to = "test@email.com";
    $subject = "Trying email function in PHP";
    $message = "padammTssss";
    $headers = 'From: email@example.com' . "\r\n" .
    'Reply-To: email@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    if(mail($to, $subject, $message, $headers)){
        echo "Think it went through.";
    } else echo "Could not be sent.";

?>