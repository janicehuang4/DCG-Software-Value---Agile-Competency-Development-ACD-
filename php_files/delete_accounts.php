<?php
include_once 'connect.php';
include_once 'AdminAdd.php';

// Check post request and snatize all data before creating accounts. 
//Checks if this is running from a request
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST')
{
	//This checks to see if anything was passed into the parameter countryIDs
	
	$data = json_decode(file_get_contents("php://input"));
	file_put_contents("/var/log/php_nonerr.log",var_dump($data));
	
}
else
{
	echo 'invalid request';
}


if(is_null($data)){
	echo 'data variable null';
}
else{

	AdminDelete($data->one->user_id);
}

?>
