<?php
	require "requires.php";
	checkSession();
	$id = $_GET['id'];
	$message = str_replace("_"," ",$_GET['message']);
	$db = createConnection();
	$sql = "UPDATE statusmessages SET message='$message' WHERE id='$id'";
	$db->query($sql); ?>