<?php
    $connect = mysqli_connect("mysql7.000webhost.com", "a2956270_root", "Secha11d", "a2956270_Family");
    
    $username = $_POST["username"];
    $addNewFriend = $_POST["addNewFriend"];

    

    function addFriend() {
        global $connect, $addNewFriend, $username;
        $statement = mysqli_prepare($connect, "INSERT INTO friendship (host, friend) VALUES (?, ?)");
    	mysqli_stmt_bind_param($statement, "ss", $username, $addNewFriend);
    	mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);  
    }

        function isAlreadyFriend() {
        global $connect, $addNewFriend, $username;
        $statement = mysqli_prepare($connect, "SELECT * FROM friendship WHERE host = ? and friend = ?"); 
        mysqli_stmt_bind_param($statement, "ss", $username , $addNewFriend);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
        if ($count == 0){
            return true; 
        }else {
            return false; 
        }
    }

        function isValidUser() {
        global $connect, $addNewFriend, $username;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $addNewFriend);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 
        if ($count == 1){
            return true; 
        }else {
            return false; 
        }
    }
    
    $response = array();
    $response["success"] = false;  

     if (isValidUser()){
        if(isAlreadyFriend())
        {
        addFriend();
        $response["success"] = true; 
        } 
    }
    
    echo json_encode($response);
?>