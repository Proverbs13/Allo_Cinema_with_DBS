<?php
$servername = "54.180.124.30:57884";
$username = "root";
$password = "@@@@";
$dbname = "FILM_INDUSTRY"; // 데이터베이스 이름

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
   die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>