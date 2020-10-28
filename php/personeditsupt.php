<?php
	// Basic example of PHP script to handle with jQuery-Tabledit plug-in.
	// Note that is just an example. Should take precautions such as filtering the input data.
	header('Content-Type: application/json');
	$input = filter_input_array(INPUT_POST);
	$mysqli = new mysqli('localhost', 'd8tmc', 'd8tmc', 'mydb');
	if (mysqli_connect_errno()) {
	  echo json_encode(array('mysqli' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
	  exit;
	}
	if ($input['action'] === 'edit') {
		$mysqli->query("UPDATE crewinfo SET crew='" . $input['crew'] . "', callsign='" . $input['callsign'] . "', efis_number='" . $input['efis_number'] . "', firstname='" . $input['firstname'] . "',  lastname='" . $input['lastname'] . "',  sNumber='" . $input['sNumber'] . "',  position='" . $input['position'] . "',  area='" . $input['area'] . "',  alternatephone='" . $input['alternatephone'] . "',  personalcell='" . $input['personalcell'] . "',  workphone='" . $input['workphone'] . "',  workcell='" . $input['workcell'] . "' WHERE id='" . $input['id'] . "'");
	} if ($input['action'] === 'delete') {
		$mysqli->query("DELETE FROM crewinfo WHERE id='" . $input['id'] . "'");
	} else if ($input['action'] === 'restore') {
		$mysqli->query("UPDATE users SET deleted=0 WHERE id='" . $input['id'] . "'");
	}
	mysqli_close($mysqli);
	echo json_encode($input); ?>