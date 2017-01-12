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

        mysql_connect("mysql7.000webhost.com", "a2956270_root", "Secha11d");
        mysql_select_db('a2956270_Family') or die(mysql_error());
        $statement = mysql_query("SELECT n.wname wname , n.wpass wpass, u.name name1 FROM network n , friendship f ,user u where n.username= f.host and f.host = u.username and f.friend = '$username' "); 

        while ($row = mysql_fetch_assoc($statement)) {
                    $response[] = $row;
                }
        

   	 	}


     if (isRegistered()){
        modNetwork(); 
    }

    echo json_encode($response);
?>