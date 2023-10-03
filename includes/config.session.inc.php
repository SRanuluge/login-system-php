<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true,
]);

session_start();
// session id is regenerated every 5 minutes
$interval = 60 * 5;
if (isset($_SESSION['user_id'])) {
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id_loggedin();
    } else {
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id_loggedin();
        };
    };
} else {
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id();
    } else {
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id();
        };
    };
}


function regenerate_session_id_loggedin()
{
    // Call session_create_id() while session is active to 
    // make sure collision free.
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    $userId = $_SESSION['user_id'];
    $userName = $_SESSION['user_username'];
    $newSessionId = session_create_id('myprefix-');
    $sessionId = $newSessionId . "-" . $userId;
    // Finish session
    session_commit();
    // Make sure to accept user defined session ID
    // NOTE: You must enable use_strict_mode for normal operations.
    ini_set('session.use_strict_mode', 0);
    // Set new custom session ID
    session_id($sessionId);
    // Start with custom session ID
    session_start();
    $_SESSION['last_regeneration'] = time();
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_username'] = $userName;
}
function regenerate_session_id()
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
