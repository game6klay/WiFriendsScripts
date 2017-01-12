<?php
    $connect = mysqli_connect("mysql7.000webhost.com", "a2956270_root", "Secha11d", "a2956270_Family");
    
    $wname = $_POST["wname"];
    $wpass = $_POST["wpass"];
    $username = $_POST["username"];

    

    function registerNetwork() {
        global $connect, $wname, $wpass, $username;
        $statement = mysqli_prepare($connect, "INSERT INTO network (wname, wpass, username) VALUES (?, ?, ?)");
    	mysqli_stmt_bind_param($statement, "sss", $wname, $wpass, $username);
    	mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);  
    }

        function isRegistered() {
        global $connect, $username;
        $statement = mysqli_prepare($connect, "SELECT * FROM network WHERE username = ?"); 
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

     if (isRegistered()){
        registerNetwork();
        $response["success"] = true;  
    }
    
    echo json_encode($response);
?>