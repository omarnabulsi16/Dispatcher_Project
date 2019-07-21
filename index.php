<?php
session_start();
if(isset($_SESSION['login'])) {
	require "../assets/php/object_user_priv.php";
	$_SESSION['priv'] = new privileges($_SESSION['login']);
	if($_SESSION['priv']->get_view_privilege()) {
    
    } else {
    	header("Location: ../index.php");
    }
} else {
	header("Location: ../index.php");
}
$servername = "localhost";
$username = "d8tmc";
$password = "d8tmc";
$dbname = "mydb";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT ID, name, cell_number, email FROM d8_for_dispatchers");
    $stmt->execute();
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
} ?>
<!DOCTYPE html>
<html lang = "en" xmlns = "http://www.w3.org/1999/xhtml">
<head>
    <meta charset = "utf-8" />
    <title>Table for Dispatchers</title>
    <link rel = "stylesheet" href = "StyleSheet1.css?r=<?php echo microtime(true); ?>">
	<link href = "https://fonts.googleapis.com/css?family=Orbitron" rel = "stylesheet">
    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class = "main-background"></div>
	<div class = "content">
		<h1 class = "title">* For Dispatchers</h1>
        <table class = "dispatcher-table" id = "myTable">
            <thead>
                <tr>
    				<th>sNumber</th>
                    <th>Name</th>
					<th>Cell #</th>
    				<th>Email</th>
                </tr>
            </thead>
			<tbody>
<?php
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
	$conn = null;
?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan = "4">*NOT YET COMPLETE</th>
				</tr>
			</tfoot>
        </table>
	</div>
</body>
</html>
<?php
class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
        return "<td>" . parent::current(). "</td>";
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
} 
?>