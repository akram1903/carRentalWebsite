<?php
function Connect()
{
    // $dbhost = "localhost";
	$dbhost= "host.docker.internal";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "CarRentalSystem";
    $dbport = 3306;
	//Create Connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname,$dbport) or die($conn->connect_error);

	return $conn;
}
?>