<?php
  $connection = mysqli_connect("localhost", "root", "", "lsbbb");

  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  
  // $DSN='mysql:host = localhost; dbname=lsb';
	// $ConnectingDB = new PDO($DSN,'root','root');
  

  // else {
  //    echo "Good";
  //  }
?>
