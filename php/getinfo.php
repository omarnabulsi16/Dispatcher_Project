<?php
	include "requires.php";
	checkSession();
	$db = createConnection();
	$sql = "SELECT * FROM statusmessages WHERE id='".$_GET['id']."'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$sql = "SELECT * FROM crewinfo WHERE crew='".$row['crew']."'AND firstname = '".$row["firstname"]."'";
	$result = $db->query($sql);
	$row2 = $result->fetch_assoc();
	echo "<span class='text-dark'><b>Crew</b></span><br/>";
	echo "<span class='text-dark'>".$row['crew']."</span>";
	echo "<hr></hr>";
	echo "<span class='text-dark'><b>Call Sign</b></span><br/>";
	echo "<span class='text-dark'>".$row2['callsign']."</span>";
	echo "<hr></hr>";
    echo "<span class='text-dark'><b>Name</b></span><br/>";
    echo "<span class='text-dark'>".$row['firstname']." ".$row['lastname']."</span>";
	echo "<hr></hr>";
	echo "<span class='text-dark'><b>Message</b></span>";
	if(isset($_SESSION['login'])) {
    	echo "<a class='btn float-right' onclick='editStatusMessage(".$_GET['id'].")' class='btn btn-success text-white'>Edit</a> <title='Edit Message'>";
    }
    echo "<br/>";
	echo "<span id='statusMessage' class='text-dark'>".$row['message']."</span>";
	echo "<hr></hr>";
	echo "<span class='text-dark'><b>Start Date: </b>".$row['startdate']."<b>	/	End Date: </b>".$row['enddate']." ";
    if(isset($_SESSION['login'])) {
     echo "<a title='End Leave' class='btn border border-danger'  data-dismiss='modal' onclick='updateTime(".$_GET['id'].")'><img src='assets/svg/clock.svg' width='12'></img></a><em class='text-danger' style=' font-size: .8rem;'>*Sets end date to current date & time</em>";
    }
    echo "</span>"; ?>