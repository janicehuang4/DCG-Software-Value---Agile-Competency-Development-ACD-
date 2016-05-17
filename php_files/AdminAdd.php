<?php

include_once 'connect.php';
include_once 'DCG_addDB.php';

// connects to the database and adds data to the database.

function AdminAdd($user_id, $email, $password, $last_name, $first_name, $current_role, $user_type, $manager_name, $pay_grade, $image, $organization_id,
					$past_roles, $assessment_records) {

	// Get connection to database
	$conn = GetDatabaseConnection();
	
	// hash the password.				
	$password = hash('sha256', $password);

	$id = time();
	
	// Add data to User table.
	$sql = "INSERT INTO User (user_id, email, password, last_name, first_name, current_role, user_type, manager_name, pay_grade, image, organization_id)
	VALUES ('$user_id', '$email', '$password', '$last_name', '$first_name', '$current_role', '$user_type', '$manager_name', '$pay_grade', '$image', '$organization_id')";

	file_put_contents("/var/log/php_nonerr.log",$sql);
	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
		file_put_contents("/var/log/php_nonerr.log","record success 1");
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$sql = "INSERT INTO Past_Roles (id, role_1, role_2, role_3, role_4, role_5, user_id)
	VALUES ('$id','$past_roles[0]', '$past_roles[1]', '$past_roles[2]', '$past_roles[3]', '$past_roles[4]', '$user_id')";
	

	file_put_contents("/var/log/php_nonerr.log",$sql);

	// check if the data has been added.
	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
		file_put_contents("/var/log/php_nonerr.log","record success 2");
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$sql = "INSERT INTO Individual_Assessment_Records (id, name_1, result_1, name_2, result_2, name_3, result_3, user_id)
	VALUES ('$id', '$assessment_records[0]', '$assessment_records[1]', '$assessment_records[2]', '$assessment_records[3]', '$assessment_records[4]', '$assessment_records[5]', '$user_id')";
	
	
	// check if the data has been added.
	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
    	file_put_contents("/var/log/php_nonerr.log","record success 3");
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();       
}

function AdminUpdate($user_id, $email, $password, $last_name, $first_name, $current_role, $user_type, $manager_name, $pay_grade, $image, $organization_id,
					$past_roles, $assessment_records) {

	// Get connection to database
	$conn = GetDatabaseConnection();
	
	// hash the password.				
	$password = hash('sha256', $password);
	
	// Update data into User table.
	$sql = "UPDATE User 
			SET email = '$email', password = '$password', last_name = '$last_name', first_name = '$first_name', current_role = '$current_role',
				user_type = '$user_type', manager_name = '$manager_name', pay_grade = '$pay_grade', image = '$image'
			WHERE user_id = '$user_id' ";

	file_put_contents("/var/log/php_nonerr.log",$sql);
	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
		file_put_contents("/var/log/php_nonerr.log","record success 4");
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$sql = "UPDATE Past_Roles 
			SET role_1 = '$past_roles[0]', role_2 = '$past_roles[1]', role_3 = '$past_roles[2]', role_4 = '$past_roles[3]', role_5 = '$past_roles[4]'
			WHERE user_id = '$user_id' ";
	
	file_put_contents("/var/log/php_nonerr.log",$sql);
	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
		file_put_contents("/var/log/php_nonerr.log","record success 5");
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "UPDATE Individual_Assessment_Records 
			SET name_1 = '$assessment_records[0]', result_1 = '$assessment_records[1]', name_2 = '$assessment_records[2]', 
				result_2 = '$assessment_records[3]', name_3 ='$assessment_records[4]', result_3 = '$assessment_records[5]'
			WHERE user_id = '$user_id' ";

	file_put_contents("/var/log/php_nonerr.log",$sql);
	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
		file_put_contents("/var/log/php_nonerr.log","record success 6");
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$conn->close();       
}


function AdminDelete($user_id) {

	// Get connection to database
	$conn = GetDatabaseConnection();
	
	
	// Delete data from tables.

	$sql = "DELETE FROM Individual_Assessment_Records
			WHERE user_id = '$user_id' ";

	file_put_contents("/var/log/php_nonerr.log",$sql);
	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
		file_put_contents("/var/log/php_nonerr.log","record success 7");
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "DELETE FROM Past_Roles 
			WHERE user_id = '$user_id' ";

	file_put_contents("/var/log/php_nonerr.log",$sql);
	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
		file_put_contents("/var/log/php_nonerr.log","record success 8");
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "DELETE FROM User 
			WHERE user_id = '$user_id' ";

	file_put_contents("/var/log/php_nonerr.log",$sql);
	if ($conn->query($sql) === TRUE) {
    	echo "New record created successfully";
		file_put_contents("/var/log/php_nonerr.log","record success 9");
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$conn->close();       
}
?>
