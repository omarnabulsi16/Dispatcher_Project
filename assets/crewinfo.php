<?php
require "../assets/php/requires.php";
checkSession();
$crew = $_GET['crew'];
$db = createConnection();
$sql = "SELECT * FROM crewinfo WHERE crew = '".$crew."' ORDER BY callorder ASC";
$result = $db->query($sql);
$tooltip = "<a href='#' data-toggle='tooltip' data-placement='top' title='Hooray!'>";
if(checkLoginSession() && checkPriv($db) != 'user') {
	echo "<table id='emailTable' class='table table-sm table-light table-striped'>";
} else {
	echo "<table class='table table-sm table-light table-striped'>";
}
echo "<tr class='thead-dark'>";
echo "<th>First Name</th>
<th>Last Name</th>
<th>sNumber</th>
<th>Position</th>
<th>Email</th>
</tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr class='text-dark' style='font-size:12px;'>";
    echo "<td>" . $row['firstname'] . "</a></td>";
	echo "<td>" . $row['lastname'] . "</td>";
    echo "<td>" . $row['sNumber'] . "</td>";
    echo "<td>" . $row['position'] . "</td>";
 	if($row['email'] == "") {
    	echo "<td>" . $row['email'] . "</td>";
    } else {
    	echo "<td><a class='text-dark' href='mailto:".$row['email']."' title='Email ".$row['firstname']."'>" . $row['email'] . "</a></td>";
    }
    echo "</tr>";
}
echo "</table>";
closeConnection($db); ?>