<?php
function Connect()
{
    // $dbhost = "localhost";
	$dbhost= "host.docker.internal";
	$dbuser = "root";
	$dbpass = "123456";
	$dbname = "CarRentalSystem";
    $dbport = 3307;
	//Create Connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname,$dbport) or die($conn->connect_error);

	return $conn;
}
?>