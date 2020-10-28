<?php
	require "requires.php";
	checkSession();
	$db = createConnection();
	$sql = "SELECT * FROM crewinfo WHERE 1 ORDER BY callsign ASC";
	$result = $db->query($sql);
	echo "<table class='table table-sm table-striped table-light'>";
	echo "<thead class='thead-dark'
			<tr>
				<th>Call Sign</th>
                <th>EFIS</th>
				<th>Status</th>
                <th>Date</th>
                <th>Time</th>";
			if(isset($_SESSION['login'])) {
                echo "<th class='text-center'>Checkout</th>";
            }
			echo "<th>Msg</th></tr>
		   </thead>
		   <tbody class='text-dark'>";
	while($row = $result->fetch_assoc()) {
		if(checkForCheckin($row,$db)) {
        	$sql = "SELECT * FROM crewinfo WHERE crew='".$row['crew']."' ORDER BY present";
        	$msg = $row['message'];
        	$time = explode(' ', $row['present']);
        	$date = $time[0];
        	$time = explode(':', $time[1]);
        	$time = $time[0].":".$time[1];
			echo "<tr class='table-success'>
					<td><a href='maps/crewcallout.php?crew=".$row['crew']."' class='text-dark'><b><u>".$row['callsign']."</u></b></a></td>
                    <td>".$row['efis_number']."</td>";
        	if(isset($_SESSION['login'])) {
            	echo "
					<td>
                    	<select id='select-".$row['id']."' onchange='changeStatus(".$row['id'].")' onfocusin='stopRefresh();' onfocusout='startRefresh();'>";
            	if($row['status'] == 'IN ROUTE') {
                	echo "
                    	<option value='IN ROUTE' selected>IN ROUTE</option>";
                } else {
                	echo "
                    	<option value='IN ROUTE'>IN ROUTE</option>";
                }
            	if($row['status'] == 'NIGHT') {
                	echo "
                    	<option value='NIGHT' selected>NIGHT</option>";
                } else {
                	echo "
                    	<option value='NIGHT'>NIGHT</option>";
                }
            	if($row['status'] == 'STORM') {
                	echo "
                    	<option value='STORM' selected>STORM</option>";
                } else {
                	echo "
                    	<option value='STORM'>STORM</option>";
                }
            	if($row['status'] == '10-8') {
                	echo "
                    	<option value='10-8' selected>10-8</option>";
                } else {
                	echo "
                    	<option value='10-8'>10-8</option>";
                }
            	if($row['status'] == '10-97') {
                	echo "
                    	<option value='10-97' selected>10-97</option>";
                } else {
                	echo "
                    	<option value='10-97'>10-97</option>";
                }
            	if($row['status'] == '10-98') {
                	echo "
                    	<option value='10-98' selected>10-98</option>";
                } else {
                	echo "
                    	<option value='10-98'>10-98</option>";
                }
            	if($row['status'] == 'CLASS') {
                	echo "
                    	<option value='CLASS' selected>CLASS</option>";
                } else {
                	echo "
                    	<option value='CLASS'>CLASS</option>";
                }
            	if($row['status'] == 'OFFICE') {
                	echo "
                    	<option value='OFFICE' selected>OFFICE</option>";
                } else {
                	echo "
                    	<option value='OFFICE'>OFFICE</option>";
                }
            
            	echo "
                		</select>
                	</td>";
            } else {
            	echo "
					<td>".$row['status']."</td>";
            }      
           echo	"
				<td>".$date."</td>
                <td>".$time."</td>";
        			if(isset($_SESSION['login'])) {
                         echo "<td class='text-center align-middle'><input onclick='checkout(".$row['id'].")' type='checkbox'></input></td>";
            }
        	if($msg != '') {
        		echo "<td><a class='btn btn-dark' onclick='getCheckInfo(".$row['id'].")' data-toggle='modal' data-target='#checkModal'><img src='assets/svg/chat2.svg' width='12' height='12' title='View Message'></img></a></td>";
            }
        	else {
           		 echo "<td><a class='btn btn-dark' onclick='getCheckInfo(".$row['id'].")' data-toggle='modal' data-target='#checkModal'><img src='assets/svg/chat.svg' width='12' height='12' title='View Message'></img></a></td>";
            }
            echo "</tr>";    
		}
	}
	echo "<tbody>
		</table>";
	function checkForCheckin($row,$db) {
		/*$query = "SELECT CURRENT_TIMESTAMP();";
		$today = $db->query($query);
		$today = $today->fetch_assoc();
		$today = $today['CURRENT_TIMESTAMP()'];
		$present = $row['present'];
		$query = "SELECT TIMEDIFF('$today','$present');";
		$timeresult = $db->query($query);
		$timeresult = $timeresult->fetch_assoc();
		$timeresult = $timeresult["TIMEDIFF('$today','$present')"];
		$query = "SELECT TIME_TO_SEC('$timeresult');";
		$temp = $timeresult;
		$timeresult = $db->query($query);
		$timeresult = $timeresult->fetch_assoc();
		$timeresult = $timeresult["TIME_TO_SEC('$temp')"];*/
		if($row['checkedin'] == 1) {
			return true;
		}
		return false;
	} ?>