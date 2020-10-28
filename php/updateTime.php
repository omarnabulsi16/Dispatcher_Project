<?php
	require "requires.php";
	checkSession();
	$id = $_GET['id'];
	$db = createConnection();
	$sql = "UPDATE statusmessages SET enddate=CURRENT_TIMESTAMP() WHERE id='$id'";
	$db->query($sql); ?>