<?php
	if(!isset($_SESSION)){
		session_start();
	}
  
 $conn=mysqli_connect("localhost","root","Na@9119553127","hostel_management_system");

  if (!$conn) {
    die("Connection Failed: ".mysqli_connect_error());
  }
?>
