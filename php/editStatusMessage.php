<?php
	require "requires.php";
	checkSession();
	$db = createConnection();
	$q = $_GET['q'];
	$sql = "SELECT * FROM statusmessages WHERE id='$q'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	echo "<textarea id='newStatus' rows='5' style='width:100%;resize:none'>".$row['message']."</textarea>";
	echo "<a class='btn' onclick='saveStatus($q)' title='Save' class='btn btn-success text-white'>Save</a>";
    //echo "<a class='btn' onclick='saveStatus($q)' title='Confirm'><img src='assets/svg/check.svg'></img></a>";
	//echo "<a class='btn' onclick='getInfo($q)' title='Cancel'><img src='assets/svg/x.svg'></img></a>"; 
    echo "<a class='btn' onclick='getInfo($q)' title='Cancel' class='btn btn-success text-white'>Cancel</a>"; ?>