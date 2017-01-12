<?php
    $connect = mysqli_connect("mysql7.000webhost.com", "a2956270_root", "Secha11d", "a2956270_Family");
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $response = array();
    function isRegistered() {
        global $connect, $username, $response , $name , $email ;
        $statement = mysqli_prepare($connect, "SELECT * FROM network WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $username);
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

        function modNetwork() {
        global $connect, $username, $response , $name , $email ;
        $statement = mysqli_prepare($connect, "SELECT * FROM network WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        mysqli_stmt_bind_result($statement, $wid, $wname, $wpass, $username);
        	while(mysqli_stmt_fetch($statement)){
        		$response["wid"] = $wid;
        		$response["wname"] = $wname;
        		$response["wpass"] = $wpass;
    		}
    	$response["success"] = true;
    	$response["username"] = $username;
        $response["name"] = $name;
       	$response["email"] = $email;

   	 	}


    
    $response["success"] = false; 

     if (isRegistered()){
        modNetwork(); 
        $response["success"] = true;
    }
   


    echo json_encode($response);
?>