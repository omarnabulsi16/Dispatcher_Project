<?php
	require "requires.php";
	checkSession();
	$db = createConnection();
	$sql = "SELECT * FROM crewinfo ORDER BY crew, callorder ASC";
	$result = $db->query($sql);
	echo "<table class='table table-sm table-striped table-light'>";
	echo "<thead class='thead-dark'
			<tr>
				<th>Call Sign</th>
				<th>Coming back on</th>
				<th>Who to Contact</th>
                <th class='text-center'>Info</th>
			</tr>
		   </thead>
		   <tbody class='text-dark'>";
	while($temp = $result->fetch_assoc()) {
		checkForStatus($temp,$db);
    }
	echo "<tbody>
		</table>";
	function checkForStatus($row,$db) {
		$query = "SELECT * FROM statusmessages WHERE firstname='".$row['firstname']."' AND lastname='".$row['lastname']."' AND crew='".$row['crew']."'";
		$newresult = $db->query($query);
		$query = "SELECT CURRENT_TIMESTAMP();";
		$today = $db->query($query);
		$today = $today->fetch_assoc();
		$today = $today['CURRENT_TIMESTAMP()'];
		if(mysqli_num_rows($newresult)>0) {
			while($row2 = $newresult->fetch_assoc()) {
				$startdate = $row2['startdate'];
				$query = "SELECT TIMEDIFF('$startdate','$today');";
				$timeresult = $db->query($query);
				$timeresult = $timeresult->fetch_assoc();
				$timeresult = $timeresult["TIMEDIFF('$startdate','$today')"];
				$query = "SELECT TIME_TO_SEC('$timeresult');";
				$temp = $timeresult;
				$timeresult = $db->query($query);
				$timeresult = $timeresult->fetch_assoc();
				$timeresult = $timeresult["TIME_TO_SEC('$temp')"];
				if($timeresult > 0) {
				} else {
					$enddate = $row2['enddate'];
					$query = "SELECT TIMEDIFF('$enddate','$today');";
					$timeresult = $db->query($query);
					$timeresult = $timeresult->fetch_assoc();
					$timeresult = $timeresult["TIMEDIFF('$enddate','$today')"];
					$query = "SELECT TIME_TO_SEC('$timeresult');";
					$temp = $timeresult;
					$timeresult = $db->query($query);
					$timeresult = $timeresult->fetch_assoc();
					$timeresult = $timeresult["TIME_TO_SEC('$temp')"];
					if($timeresult > 0){
                    	$endoftime = $row2["enddate"];
                   		$endoftime = explode(':', $endoftime);
                    	$endoftime = $endoftime[0].':'.$endoftime[1];
						echo "<tr class='table-danger'>
						<td><a href='maps/crewcallout.php?crew=".$row['crew']."' class='text-dark'><b><u>".$row['callsign']."</u></b></a></td>
						<td>".$endoftime."</td>";
           			if($row2['calloutchoice'] == "YES") {
            			echo		"<td>Available for Callout</td>";
            		} else if($row2['callout'] == "-ADD ALTERNATE HERE-") {
            			echo		"<td>Check More Info</td>";
            		} else {
            			echo "<td>".$row2['callout']."</td>";
           		 	}
            		echo "<td class='text-center'><button type='button' onclick='getInfo(".$row2['id'].")' class='btn' data-toggle='modal' data-target='#moreInfoModal'><img src='assets/svg/info.svg' width='10'></img></button></td>
                  	</tr>";
					}
                }
			}
		}
	} ?>