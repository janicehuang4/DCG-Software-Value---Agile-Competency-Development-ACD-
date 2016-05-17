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

	
	for( $i = 0; $i <= (5 - count($data->one->past_roles)); $i++)
	{
		array_push($data->one->past_roles, NULL);
	}
	
	
	
	for( $i = 0; $i <= (6 - count($data->one->assessment_records)); $i++)
	{
		array_push($data->one->assessment_records, NULL);
	}
	
	
	AdminUpdate($data->one->user_id, $data->one->email, $data->one->password, $data->one->last_name, $data->one->first_name, $data->one->current_role, $data->one->user_type, $data->one->manager_name,
		$data->one->pay_grade, $data->one->image, $data->one->organization_id, $data->one->past_roles,$data->one->assessment_records);
}

?>
