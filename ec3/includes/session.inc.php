<?php

// Start a secure session
function startSecureSession() {
    $secure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    $httpOnly = true;

    // Set the SameSite attribute to 'Lax' or 'Strict' based on your needs
    $sameSite = 'Lax';

    // Start the session with secure settings
    session_set_cookie_params(0, '/', $_SERVER['SERVER_NAME'], $secure, $httpOnly);
    session_name('SecureSession'); // Choose a custom session name
    session_start();

    // Regenerate the session ID to help prevent session fixation attacks
    session_regenerate_id(true);
}

// Example usage
startSecureSession();

// Now you can use $_SESSION as usual
$_SESSION['user_id'] = 123;