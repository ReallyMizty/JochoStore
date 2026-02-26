<?php
   $host = 'localhost';
   $db = 'shoe2';
   $user = 'root';
   $pass = '';
   $port = '3306';
   
   try {
       $conn = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
       echo "Connection failed: " . $e->getMessage();
       exit();
   }