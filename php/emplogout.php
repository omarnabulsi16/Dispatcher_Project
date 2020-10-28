<?php
	session_start();
	setcookie('firstname', "", time() - 36000, '/');
	setcookie('lastname', "", time() - 36000, '/');
	setcookie('crew', "", time() - 36000, '/');
	setcookie('status','', time() - 600, '/');
	setcookie('leave', '', time() - 600, '/');
	setcookie('startyear','', time() - 600, '/');
	setcookie('startmonth', '', time() - 600, '/');
	setcookie('startday', '', time() - 600, '/');
	setcookie('starttime', '', time() - 600, '/');
	setcookie('endyear', '', time() - 600, '/');
	setcookie('endmonth', '', time() - 600, '/');
	setcookie('endday', '', time() - 600, '/');
	setcookie('endtime', '', time() - 600, '/');
	setcookie('callout', '', time() - 600, '/');
	setcookie('calloutPerson', '', time() - 600, '/');
	header("Location: ../../TMCApplications/emplogin.php"); ?>