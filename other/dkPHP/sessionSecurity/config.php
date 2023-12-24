<?php
// could be set in the xamp&lamp php folder > php.ini file
ini_set('session.use_only_cookies', 1);

// only use session ID that has actually been created on server
ini_set('session.use_strict_mode', 1);

// cookie lifetime 
session_set_cookie_params([
    'lifetime' => 1800, //30 min in sec
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

// session_regenerate_id(true); // RE-Generates the current ID

// if 'last_regeneration' is not created, this is the first time the page is opened
if ( ! isset($_SESSION['last_regeneration'])) {

    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();

    // anytime other in the future the 'else' statement is ran
} else {

    $interval = 60 * 30; // 60sec * ...

    if (time() - $_SESSION['last_regeneration'] >= $interval){

        // regenerate session ID
        session_regenerate_id(true);

        // update last session regeneration timestamp
        $_SESSION['last_regeneration'] = time();
    }

}
