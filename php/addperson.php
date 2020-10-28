<?php
	function addPerson() {
		$db = createConnection();
		$callorder = $_POST['callorder']; $crew = $_POST['crewperson']; $callsign = $_POST['callsign']; $firstname = $_POST['firstname']; $lastname = $_POST['lastname'];
		$sNumber = $_POST['sNumber']; $position = $_POST['position']; $area = $_POST['area']; $alternatephone = $_POST['alternatephone']; $personalcell = $_POST['personalcell'];
		$workphone = $_POST['workphone']; $workcell = $_POST['work']; $messaeg2 = $_POST['message2'];
		$sql = $sql = "INSERT INTO crewinfo (callorder, crew, callsign, firstname, lastname, sNumber, position, area, alternatephone, personalcell, workphone, workcell, message2) VALUES ('$callorder','$crew', '$callsign', '$firstname', '$lastname', '$sNumber', '$position', '$area', '$alternatephone', '$personalcell', '$workphone', '$workcell', '$message2')";	
		$db->query($sql);
		closeConnection($db);
		$url = $_SESSION['url'];
		header("Location: $url");
	} ?>