<?php
	function salthash($pass,$salt) {
		$result = $salt."".$pass;
		$result = md5($result);
		return $result;
	} ?>