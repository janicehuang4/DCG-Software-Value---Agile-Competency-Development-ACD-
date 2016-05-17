<?php

include_once 'connect.php';

function login($user_id, $password) {

    $conn = GetDatabaseConnection();

    // fetch user_id and password.
    $sql = "SELECT user_id, password, user_type
            FROM User
            where user_id = $user_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {

        while($row = $result->fetch_assoc()) {
            $db_id = $row["user_id"];
            $db_password = $row["password"];
            $db_user_type = $row["user_type"];
        }
		
        // check if the user id and password is correct.
        // set them to be session variables.
        if ($db_password === $password) {

            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            //$db_id = preg_replace("/[^0-9]+/", "", $db_id);
            $_SESSION['user_id'] = $db_id;
            $_SESSION['login_string'] = hash('sha256', $db_password . $user_browser);
            $_SESSION['user_type'] = $db_user_type;
                    
			$conn->close();		
            return true;
        } 
        else {

            return false;
        }
                
    } 
    else {
        return false;
    }
        
}

?>
