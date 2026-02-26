<?php
    $servername= "localhost";
    $username = "root";
    $password = "";
    $dbname = "shoe2";
    $port = "3306" ;

    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    
    // เช็คการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

?>
    