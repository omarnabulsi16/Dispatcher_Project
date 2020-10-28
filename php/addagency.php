<?php 
	function addAgency($name,$type,$number,$comment,$db) {
		$sql = "INSERT INTO agencycontacts (agencyname, agencytype, contactnumber,comment) VALUES ('$name', '$type', '$number','$comment')";	
		$db->query($sql);
		closeConnection($db);
} ?>