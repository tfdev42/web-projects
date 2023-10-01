<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    $emailTo = "tamas.fazekas.hu@gmail.com";
    $subject = "Trying email function in PHP";
    $body = "padammTssss";
    $header = "From: homelab@homelab.lab";

    if(mail($emailTo, $subject, $body, $header)){
        echo "Think it went through.";
    } else echo "Could not be sent.";

?>