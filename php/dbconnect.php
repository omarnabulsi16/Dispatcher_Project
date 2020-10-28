<?php
	function createConnection() {
		if(checkLoginSession()) {
        	$db = mysqli_connect('localhost','d8tmc-user','QxwQwLJmd38Ir7JL','mydb');
           if(checkPriv($db) == "editor" || checkPriv($db) == "admin" || checkPriv($db) == "dispatcher") {
				$username = "d8tmc";
				$password = "d8tmc";
           } else {
           	$username = "d8tmc-user";
			$password = "QxwQwLJmd38Ir7JL";
           }
		} else {
		$username = "d8tmc-user";
		$password = "QxwQwLJmd38Ir7JL";
		}
		$servername = "localhost";
		$dbname = "mydb";
		// Create connection
		 $db = mysqli_connect($servername,$username,$password,$dbname);
		 //$db = mysqli_connect("localhost","root","","database");
		 if (mysqli_connect_errno()) {
			echo "<p style='color:white'>Failed to connect to MySQL: ".mysqli_connect_error()."<p>";
		 } else {
			 return $db;
		 }
	}
	function closeConnection($db) {
		mysqli_close($db);
	} ?>