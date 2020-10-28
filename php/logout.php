<?php
	require "requires.php";
	checkSession();
	$url = $_SESSION['url'];
	if(checkLoginSession()) {
		destroySession();
	}
	if(isset($_COOKIE['userid']) && isset($_COOKIE['token'])) {
		deleteCookie(createConnection());
	}
	redirect($url); ?>