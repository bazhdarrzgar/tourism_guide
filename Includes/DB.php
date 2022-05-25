<?php
	$DSN='mysql:host =localhost; dbname=lsbbb';
	$ConnectingDB = new PDO($DSN,'root','');
?>


<?php

	// // for MySQLi OOP
	// $conn = new mysqli('localhost', 'root', 'root', 'lsb');
	// if($conn->connect_error){
	//    die("Connection failed: " . $conn->connect_error);
	// } else {
	// 	die("Connection successful")
	// }

	////////////////

	// // for MySQLi Procedural
	// $conn = mysqli_connect('localhost', 'root', '', 'lsb');
	// if(!$conn){
	//     die("Connection failed: " . mysqli_connect_error());
	// }

?>
