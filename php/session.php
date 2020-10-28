<?php
	function checkSession() {
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
			if(!isset( $_SESSION['error'])) {
				$_SESSION['error'] = '';
			}
        	if(!isset($_SESSION['access'])){
            	$_SESSION['access'] = true;
            	$db = mysqli_connect('localhost','d8tmc','d8tmc','mydb');
            	$query = "INSERT INTO d8_page_log (ip_address) VALUES ('".$_SERVER['REMOTE_ADDR']."')";
				$result = $db->query($query);
            }
		}
	}
	function destroySession() {
		session_unset();
		session_destroy();
	} ?>