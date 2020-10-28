<?php
	require "requires.php";
	checkSession();
	$id = $_POST['id'];
	$message = $_POST['message'];
	$message = str_replace("'","&apos;",$message);
	$db = createConnection();
	$sql = "UPDATE newsmessages SET content='$message' WHERE id='$id'";
	$db->query($sql); ?>