<?php
	//creating mysql DB connection.
	function getConnectionDb(){
		//creating mysql DB connection.
		// $servername = "166.62.10.33";
		// $username = "ibigdo";
		// $password = "ibigdotech";
		// $dbname = "ibigdo";
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ibigdo";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die($conn->connect_error);
		}else{
			// echo "connected db";
			return $conn;
		}

	}
?>

