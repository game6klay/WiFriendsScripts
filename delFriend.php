<?php
    $connect = mysqli_connect("mysql7.000webhost.com", "a2956270_root", "Secha11d", "a2956270_Family");
    
    $username = $_POST["username"];
    $delFriend = $_POST["delFriend"];

        function deleteFriend() {
        global $connect, $delFriend, $username;
        $statement = mysqli_prepare($connect, "DELETE FROM friendship WHERE host = ? and friend = ?"); 
        mysqli_stmt_bind_param($statement, "ss", $username , $delFriend);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        
    }

        function isValidUser() {
        global $connect, $delFriend, $username;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $delFriend);
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
        
        deleteFriend();
        $response["success"] = true; 
    }
    
    echo json_encode($response);
?>