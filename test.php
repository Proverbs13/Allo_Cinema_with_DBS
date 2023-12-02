<?php
$servername = "43.201.98.27:52388";
$username = "root";
$password = "1234";

// create Connection
$conn = new mysqlu($servername, %username, $password);

if($conn->connect_error){
	die("Connection failed: "+$conn->connect_error);
}else{
	echo "Success!";
}
?>