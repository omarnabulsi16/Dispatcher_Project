<?php
	function addPerson() {
		$db = createConnection();
		$callorder = $_POST['callorder']; $crew = $_POST['crewperson']; $callsign = $_POST['callsign']; $firstname = $_POST['firstname']; $lastname = $_POST['lastname'];
		$sNumber = $_POST['sNumber']; $position = $_POST['position']; $area = $_POST['area']; $alternatephone = $_POST['alternatephone']; $personalcell = $_POST['personalcell'];
		$workphone = $_POST['workphone']; $workcell = $_POST['workcell']; $email = $_POST['email']; $efis_number = $_POST['efis_number'];
		$sql = $sql = "INSERT INTO crewinfo (callorder, crew, callsign, firstname, lastname, sNumber, position, area, alternatephone, personalcell, workphone, workcell, email, efis_number) VALUES ('$callorder','$crew', '$callsign', '$firstname', '$lastname', '$sNumber', '$position', '$area', '$alternatephone', '$personalcell', '$workphone', '$workcell', '$email', '$efis_number')";	
		$db->query($sql);
		closeConnection($db);
		$url = $_SESSION['url'];
		header("Location: $url");
	}
	function editComment() {
		$db = createConnection();
		$crew = $_GET['crew'];
		$EFIS_number = $_POST['EFIS_number'];
		$commentTitle1 = $_POST['commentTitle1'];$comment1 = $_POST['comment1'];
		$commentTitle2 = $_POST['commentTitle2'];$comment2 = $_POST['comment2'];
		$commentTitle3 = $_POST['commentTitle3'];$comment3 = $_POST['comment3'];
    	$supt = $_POST['supt']; $supt_EFIS = $_POST['supt_EFIS'];
    	$supt_num = $_POST['supt_num']; $imms = $_POST['imms'];
		$sql = "UPDATE crewcomments SET EFIS_number='$EFIS_number', commentTitle1='$commentTitle1',comment1='$comment1',commentTitle2='$commentTitle2',comment2='$comment2',commentTitle3='$commentTitle3',comment3='$comment3',supt='$supt',supt_EFIS='$supt_EFIS',supt_num='$supt_num',imms='$imms' WHERE crew='$crew'";
		$db->query($sql);
		closeConnection($db);
		$url = $_SESSION['url'];
		header("Location: $url");
	}
	function addPostMile() {
		$db = createConnection();
		$crew = $_POST['postcrew'];$description = $_POST['description'];
		$county = $_POST['county'];$route = $_POST['route'];
		$postmile = $_POST['postmile'];$topostmile = $_POST['topostmile'];
		$sql = "INSERT INTO crewarea (crew, county, route, postmile, topostmile, description) VALUES ('$crew', '$county', '$route', '$postmile', '$topostmile', '$description')";
		$db->query($sql);
		closeConnection($db);
		$url = $_SESSION['url'];
		header("Location: $url");
	}
	function addCustomCallout() {
		$db = createConnection();
		$customcrew = $_GET['crew']; $id = $_POST['id']; $customcallorder = $_POST['customcallorder'];
		$sql = "UPDATE crewinfo SET customcrew='$customcrew', customcallorder='$customcallorder' WHERE id='$id'";
		$db->query($sql);
		closeConnection($db);
		$url = $_SESSION['url'];
		header("Location: $url");
	} ?>