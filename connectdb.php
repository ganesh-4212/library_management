<?php
	$con=new mysqli("localhost","root","","libdb");
	if ($con->connect_error) {
    	die("Connection failed: " . $con->connect_error);
	} 
?>