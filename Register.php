<?php
    $connect = mysqli_connect("mysql7.000webhost.com", "a2956270_root", "Secha11d", "a2956270_Family");
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    function registerUser() {
        global $connect, $name, $email, $username, $password;
        $statement = mysqli_prepare($connect, "INSERT INTO user (name, email, username, password) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($statement, "ssss", $name, $email, $username, $password);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);  
    }

    function usernameAvailable() {
        global $connect, $username;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
        if ($count < 1){
            return true; 
        }else {
            return false; 
        }
    }
    
    $response = array();
    $response["success"] = false;  

     if (usernameAvailable()){
        registerUser();
        $response["success"] = true;  
        $response["name"] = $name;
        $response["email"] = $email;
        $response["username"] = $username;
    }
    
    echo json_encode($response);
?>
