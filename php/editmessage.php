<?php
	require "requires.php";
	checkSession();
	$id = $_GET['id'];
	$db = createConnection();
	$sql = "SELECT * FROM newsmessages WHERE id='$id'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
echo "
<input type ='hidden' id='messageid' value='$id' ><textarea id='newmessage' rows='5' style='width:100%'>".$row['content']."</textarea>"; ?>