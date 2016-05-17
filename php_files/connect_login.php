<?php
@ob_start();
include_once 'connect.php';
include_once 'logins.php';

// starts a session for user. 
session_start();
ob_start();
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST')
{
	if(  isset($_POST["user_id"]) && isset($_POST["password"]) )
	{
		//This checks to see if anything was passed into the parameter countryIDs
		//$data = json_decode(file_get_contents("php://input"));
		//file_put_contents("/var/log/php_nonerr.log",var_dump($data));
		$user_id = $_POST["user_id"];
		$password = $_POST["password"];
	}
	else
	{
		echo 'missing user id or password';
	}
}
else
{
	echo 'invalid request';
}

if (login($user_id, $password) == true) {
	// Login successful, redirect the page.
	header('Location : ../Home.html',false,302);
	exit();
} else {
	echo 'user id or password is wrong.';
}


?>