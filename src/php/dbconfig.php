<?php
$servername = "43.200.163.101:57135";
$username = "root";
$password = "1234";
$dbname = "FILM_INDUSTRY"; // 데이터베이스 이름

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
   die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>