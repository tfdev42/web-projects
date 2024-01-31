<?php
// Start the session (if not already started)
session_start();

// Set a secure cookie with HttpOnly flag
function setSecureCookie($name, $value, $expiration = 0) {
    $secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    $httpOnly = true;

    // Set the SameSite attribute to 'Lax' or 'Strict' based on your needs
    $sameSite = 'Lax';

    // Set the domain to your domain (adjust as needed)
    $domain = $_SERVER['SERVER_NAME'];

    // Set the cookie
    setcookie($name, $value, $expiration, '/', $domain, $secure, $httpOnly);
}

// Example usage
$userID = 123;
setSecureCookie('user_id', $userID, time() + 3600); // Expire in 1 hour
