<?php
	require "requires.php";
	session_start();
	$db = createConnection();
	$id = $_GET['id'];
	$val = $_GET['val'];
	$sql = "UPDATE crewinfo SET status='".$val."' WHERE id='".$id."'";
	$db->query($sql); ?>