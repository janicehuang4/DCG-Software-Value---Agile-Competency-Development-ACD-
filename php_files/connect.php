<?php

// Get connection to database.
function GetDatabaseConnection()
{
    $databaseConnection = new mysqli("localhost", "root", "dcgagile", "DCGAgile");
	
	if ($databaseConnection->connect_error) {
		die("Connection failed: " . $databaseConnection->connect_error);
	}

    return $databaseConnection;
}

?>
