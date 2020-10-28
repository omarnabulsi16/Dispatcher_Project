<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	require "requires.php";
	checkSession();
	if(!checkLoginSession()) {
	} else {
		$sql = "DELETE FROM newsmessages WHERE id='".$_GET['id']."'";
		$db = createConnection();
		$db->query($sql);
		closeConnection($db);
	}
	$url = $_SESSION['url'];
	header("Location: $url");