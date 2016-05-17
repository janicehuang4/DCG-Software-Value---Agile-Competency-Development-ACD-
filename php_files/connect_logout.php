<?php
include_once 'logins.php';

session_start();
 
$_SESSION = array();

// get session parameters.
$session = session_get_cookie_params();

// delete cookies.
setcookie(session_name(),'', time() - 42000, 
        $session["path"], $session["domain"], $session["secure"], $session["httponly"]);

// destroy the session.
session_destroy();

header('Location : http://54.173.149.111/Home.html');

?>