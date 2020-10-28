<?php
	require "requires.php";
	checkSession();
	$id = $_GET['id'];
	$db = createConnection();
	$sql = "SELECT message FROM crewinfo WHERE id='$id'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	echo $row['message2']; ?>