<?php
	function login($user,$pass,$db,$temp) {
        $sql = "SELECT * FROM users WHERE username = '$user'";
		$result = $db->query($sql);
		if(mysqli_num_rows($result) > 0 ) {
			$row = $result->fetch_assoc();
			if($row['password'] == salthash($pass,$row['salt'])) {
				updateLastAccess($user);
				$_SESSION['login'] = $user;
				if($temp == true) {
					createCookie($db, $user);
				}
				$_SESSION['error'] = "";
			} else {
				$_SESSION['error'] = "Invalid Password";
			}
		} else {
			$_SESSION['error'] = "User NOT found";
		}
	}
	function updateLastAccess($user) {
		$db = createConnection();
		$sql = "UPDATE users SET last_access=CURRENT_TIMESTAMP WHERE username='$user'";
		$db->query($sql);
	}
	function checkForLogin($temp) {
		if(checkForCookie()) {
		} else if(isset($_POST['submitted'])) {
			unset($_POST['submitted']);
			$db = createConnection();
			login($_POST['user'], $_POST['pass'],$db,$temp);
			closeConnection($db);
			redirect( $_SESSION['url']);
		}
	}
	function checkLoginSession() {
		if(isset($_SESSION['login'])) {
			return true;
		} else {
			return false;
		}
	}
	function checkForCookie() {
		if( isset($_COOKIE['userid']) && isset($_COOKIE['token'])) {
			$db = createConnection();
			$sql = "SELECT token FROM RememberMeSessions WHERE userid='".$_COOKIE['userid']."'"; 
			$result = $db->query($sql);
			$row = $result->fetch_assoc();
			if($row['token'] == $_COOKIE['token']) {
				$sql = "SELECT username FROM users WHERE id='".$_COOKIE['userid']."'";
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
				updateLastAccess($row['username']);
				$_SESSION['login'] = $row['username'];
				updateCookie($db);
				closeConnection($db);
				return true;
			} else {
				deleteCookie($db);
			}
			closeConnection($db);	
		}
		return false;
	}
	function deleteCookie($db) {
		$sql = "DELETE FROM RememberMeSessions WHERE userid='".$_COOKIE["userid"]."'";
		$db->query($sql);
		unset($_COOKIE['userid']);
		unset($_COOKIE['token']);
	}
	function updateCookie($db) {
		$newToken = hash( "sha256" ,generateRandomString(64));
		setcookie('userid', $_COOKIE['userid'] , time() + (86400 * 30), "/");
		setcookie('token', $newToken, time() + (86400 * 30), "/");
		$sql = "UPDATE RememberMeSessions SET token='$newToken' WHERE userid='".$_COOKIE["userid"]."'";
		$db->query($sql);
	}
	function createCookie($db,$user) {
		$sql = "SELECT id FROM users WHERE username='$user'";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		$userid = $row['id'];
		$token = hash("sha256", generateRandomString(64));
    	$ip = getIP();
		setcookie('userid', $userid, time() + (86400 * 30), "/");
		setcookie('token', $token, time() + (86400 * 30), "/");
		$sql = "INSERT INTO RememberMeSessions (userid, token, ip) VALUES ('$userid', '$token', '$ip')";
		$db->query($sql);
	} ?>