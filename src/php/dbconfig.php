<?php
$servername = "127.0.0.1:3306";
$username = "root";
$password = "tmdals2580@";
$dbname = "FILM_INDUSTRY"; // 데이터베이스 이름

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
   die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>