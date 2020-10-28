<?php
	function getUrl() {
		$url  = @($_SERVER["HTTPS"] != 'on') ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
		$url .= ($_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
		$url .= $_SERVER["REQUEST_URI"];
		return $url;
	}
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	function redirect($url) {
		header("Location: $url");
	}
	function checkPriv($db) {
		$sql = "SELECT priv FROM users WHERE username='".$_SESSION['login']."'";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		return $row['priv'];
	}
	function getIP() {
    	return $_SERVER['REMOTE_ADDR'];
    } ?>