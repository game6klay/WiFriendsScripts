<?php
    mysql_connect("mysql7.000webhost.com", "a2956270_root", "Secha11d");
    mysql_select_db('a2956270_Family') or die(mysql_error());
    $username = $_POST["username"];

    $statement = mysql_query("SELECT * FROM user u  where username <> '$username' and u.username  in ( select friend from friendship where host = '$username') ");
    
    while ($row = mysql_fetch_assoc($statement)) {
                    $response[] = $row;
                }
    
    echo json_encode($response);
?>
