<?php
	require "requires.php";
	session_start();
	$db = createConnection();
	$sql = "UPDATE crewinfo SET present='0000-00-00 00:00:00', checkedin='0', message='' WHERE id='".$_GET['id']."'";
	$db->query($sql);
	$sql = "SELECT CURRENT_TIMESTAMP()";
	$result = $db->query($sql);
	$currentTime = $result->fetch_assoc();
	$currentTime = $currentTime['CURRENT_TIMESTAMP()'];
	$sql = "SELECT * FROM crewinfo WHERE id='".$_GET['id']."'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$sql = "UPDATE 108records SET checkout='".$currentTime."' WHERE id='".$row['record']."'";
	$db->query($sql); ?>