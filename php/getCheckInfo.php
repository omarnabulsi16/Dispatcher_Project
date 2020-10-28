<?php
	require "requires.php";
	checkSession();
	$id = $_GET['id'];
	$db = createConnection();
	$sql = "SELECT * FROM crewinfo WHERE id='$id'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	echo "<span class='text-dark'><b>Crew</b></span><br/>";
	echo "<span class='text-dark'>".$row['crew']."</span>";
	echo "<hr></hr>";
	echo "<span class='text-dark'><b>Call Sign</b></span><br/>";
	echo "<span class='text-dark'>".$row['callsign']."</span>";
	echo "<hr></hr>";
    echo "<span class='text-dark'><b>Name</b></span><br/>";
    echo "<span class='text-dark'>".$row['firstname']." ".$row['lastname']."</span>";
	echo "<hr></hr>"; ?>