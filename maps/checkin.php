<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	require "../assets/php/requires.php";
	checkSession();
	$_SESSION['url'] = getUrl();
	if(isset($_POST['rememberMe'])) {
		checkForLogin(true);
	} else {
		checkForLogin(false);
	}
	if(isset($_POST['secondformInput'])) {
		$db = createConnection();
		$sql = "SELECT CURRENT_TIMESTAMP()";
		$result = $db->query($sql);
		$currentTime = $result->fetch_assoc();
		$currentTime = $currentTime['CURRENT_TIMESTAMP()'];
		for($x = 0; $x < count($_POST['checkin']); $x++){
        	$sql = "SELECT * FROM crewinfo WHERE id='".$_POST['checkin'][$x]."'";
        	$result = $db->query($sql);
        	$row = $result->fetch_assoc();
        	$sql = "INSERT INTO 108records (firstname, lastname, submitted, checkin) VALUES ('".$row['firstname']."','".$row['lastname']."','".$_SESSION['login']."','".$currentTime."')";
        	$db->query($sql);
        	$record = mysqli_insert_id($db);
			$sql = "UPDATE crewinfo SET present='".$currentTime."', checkedin='1', record='".$record."', status='".$_POST['status'][$x]."' WHERE id='".$_POST['checkin'][$x]."'";
			$db->query($sql);                                                          
		}
		for($x = 0; $x < count($_POST['checkout']); $x++) {
			$sql = "UPDATE crewinfo SET present='0000-00-00 00:00:00', checkedin='0' WHERE id='".$_POST['checkout'][$x]."'";
			$db->query($sql);
        	$sql = "SELECT CURRENT_TIMESTAMP()";
			$result = $db->query($sql);
			$currentTime = $result->fetch_assoc();
			$currentTime = $currentTime['CURRENT_TIMESTAMP()'];
        	$sql = "SELECT * FROM crewinfo WHERE id='".$_POST['checkout'][$x]."'";
        	$result = $db->query($sql);
        	$row = $result->fetch_assoc();
        	$sql = "UPDATE 108records SET checkout='".$currentTime."' WHERE id='".$row['record']."'";
        	$db->query($sql);
		}
	}
	function checkForStatus($row,$db) {
		$query = "SELECT * FROM statusmessages WHERE firstname='".$row['firstname']."' AND lastname='".$row['lastname']."'";
		$newresult = $db->query($query);
		$query = "SELECT CURRENT_TIMESTAMP();";
		$today = $db->query($query);
		$today = $today->fetch_assoc();
		$today = $today['CURRENT_TIMESTAMP()'];
		if(mysqli_num_rows($newresult)>0){
			while($row2 = $newresult->fetch_assoc()) {
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
					return true;
				}
			}
		}
		return false;
	}
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
<html xmlns = "http://www.w3.org/1999/xhtml">
	<head>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>D8 TMC Web</title>
		<link rel = "icon" href = "../images/favicon.ico" type = "image/ico">
		<link rel = "stylesheet" href = "../assets/css/bootstrap.min.css">
		<link rel = "stylesheet" href = "../assets/css/main.css">
		<script src = "../assets/js/jquery-3.3.1.slim.min.js"></script>
		<script src = "../assets/js/popper.min.js"></script>
		<script src = "../assets/js/bootstrap.min.js"></script>
		<script type = "text/javascript" src = "../assets/js/time.js"></script>
		<script>
			function enableSelect(str) {
				var ele = document.getElementById("status-"+str);
				if(ele.disabled == true) {
                	ele.disabled = false;
                } else {
                	ele.disabled = true;
                }
			}
		</script>
	</head>
<body onload = "startTime()">
		<!--<video autoplay = "" muted = "" loop = "" class ="parallax fixed-top">
			<source src = "../assets/videos/TMC_Video.mp4" type = "video/mp4">
		</video>-->
		<img src = "../assets/images/tmc1.jpg" class = "parallax fixed-top">
		<div id = "top" class = "container-fluid">
			<div class = "row nottransparent sticky-top">
				<div class = "col">
					<div class = "container-fluid">
						<div class = "contianer-fluid clear">
							<div class = "row">
								<div class = "col align-self-center">
									<img class = "float-left rounded-circle hidden-sm-down" src = "../assets/images/logo.png" width = "95" height = "90" alt = "Logo">
								</div>
								<div class = "col-5 col align-self-center">
									<h2 style = "text-align:center;">D8 Transportation Management Center</h2>
								</div>
								<div class = "col align-self-center">
									<?php
									if(isset($_SESSION['login'])) {
										$db = createConnection();
										$sql = "SELECT * FROM users WHERE username='".$_SESSION["login"]."'";
										$result = $db->query($sql);
										$row = $result->fetch_assoc();
										if($row['avatar'] == NULL) { ?>
									<img class = "float-right rounded-circle" src = "../assets/images/noprofile.jpg" width = "82" height = "80" alt = "Avatar">
									<?php } else { ?>
									<img class = "float-right rounded-circle" src = "<?php echo"../assets/users/".$row['id']."/".$row['username']."/images/".$row['avatar'];?>" width = "80" height = "80" alt = "Logo">
									<?php } 
									} else { ?>
									<img class = "float-right rounded-circle hidden-sm-down" src = "../assets/images/noprofile.jpg" width = "82" height = "80" alt = "Avatar">
									<?php } ?>
								</div>
							</div>
						</div>
						<nav class = "navbar navbar-dark clear navbar-expand-lg">
							<a class = "navbar-brand" href = "../index.php" style = "padding:5px;">HOME</a>
							<button class = "navbar-toggler" type = "button" data-toggle = "collapse" data-target = "#navbarSupportedContent" aria-controls = "navbarSupportedContent" aria-expanded = "false" aria-label = "Toggle navigation">
								<span class = "navbar-toggler-icon"></span>
							</button>
							<div class = "collapse navbar-collapse" id = "navbarSupportedContent">
								<ul class = "navbar-nav mr-auto">
									<li class = "nav-item active">
										<a class = "nav-link" href = "../calendar/index.php">Calendar</a>
									</li>
                                    <li class = "nav-item active">
										<a class = "nav-link" href = "../guidelines/index.php">Guidelines/References</a>
                                    </li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "../maps/index.php">Maps & Contacts</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "../agencies/index.php">Allied Agencies & Contacts</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "../TMCApplications/index.php">TMC Applications</a>
									</li>
									<li class = "nav-item dropdown">
										<a class = "nav-link dropdown-toggle" href = "#" id = "navbarDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style = "color:rgba(255,255,255,1)">
											Other
										</a>
										<div class = "dropdown-menu nottransparent" aria-labelledby = "navbarDropdown">
                                    		<!--<a class = "nav-link" href = "../TMCApplications/postmile.php">View Post Mile</a>-->
											<a class = "nav-link" href = "../SOP/index.php">Standard Operating Procedures</a>
											<a class = "nav-link" href = "../safety/index.php">Safety</a>
											<a class = "nav-link" href = "../TrafficElectrical/index.php">Traffic Electrical</a>
											<div class = "dropdown-divider"></div>
											<a class = "nav-link" target = "_blank" href = "http://10.68.140.160/ietmc/login.php">IE-TMC</a>
										</div>
									</li>
									<li class = "nav-item dropdown">
										<a class = "nav-link dropdown-toggle" href = "#" id = "downloadDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style = "color:rgba(255,255,255,1)">
											Download
										</a>
										<div class = "dropdown-menu nottransparent" aria-labelledby = "downloadDropdown">
											<a class = "nav-link" href = "assets/files/2018-05-01MaintConfidential.xlsm">Phone List</a>
											<!--<a class = "nav-link" href = "assets/files/2018-06-01 Mtce Post Mile log.xlsx">Post Mile Log</a>-->
										</div>
									</li>
									<?php if(!isset($_SESSION['login'])) { ?>
									<li class = "nav-item dropdown">
										<a class = "nav-link dropdown-toggle" href = "#" id = "loginDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style = "color:rgba(255,255,255,1)">
											Login
										</a>
										<div class = "dropdown-menu" aria-labelledby = "loginDropdown">
											<form class = "px-4 py-3" method = "post">
												<input type = "hidden" value = "1" name = "submitted">
												<div class = "form-group">
													<label for = "exampleDropdownFormEmail1">Username</label>
													<input type = "text" class = "form-control" id = "exampleDropdownFormEmail1" name = "user" placeholder = "Username" required>
												</div>
												<div class = "form-group">
													<label for = "exampleDropdownFormPassword1">Password</label>
													<input type = "password" class = "form-control" id = "exampleDropdownFormPassword1" name = "pass" placeholder = "Password" required>
												</div>
												<div class = "form-check">
													<input type = "checkbox" class = "form-check-input" id = "dropdownCheck" name = "rememberMe" value = "TRUE">
													<label class = "form-check-label" for = "dropdownCheck">
														Remember me
													</label>
												</div>
												<button type = "submit" class = "btn btn-primary">Sign in</button>
											</form>
												<div class = "dropdown-divider"></div>
												<a class = "dropdown-item" href = "../account/register.php">New around here? Sign up</a>
												<a class = "dropdown-item" href = "#">Forgot password?</a>
										</div>
									</li>
									<?php } else { ?>
										<li class = "nav-item dropdown">
										<a class = "nav-link dropdown-toggle" href = "#" id = "accountDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style = "color:rgba(255,255,255,1)">
											Account
										</a>
										<div class = "dropdown-menu nottransparent" aria-labelledby = "accountDropdown">
												<h6 class = "pl-2 text-white">Welcome, <?php echo $_SESSION['login']; ?></h6>
												<div class = "dropdown-divider"></div>
												<a class = "nav-link" href = "../account/index.php">View Profile</a>
												<a class = "nav-link" href = "../account/userlist.php">User List</a>
												<div class = "dropdown-divider"></div>
												<a class = "nav-link" href = "../assets/php/logout.php">Logout</a>
											</div>
										</li>
								<?php } ?>
								</ul>
								<span class = "navbar-text"><span id = "date"></span> <span id = "time"></span></span>
							</div>
						</nav>
					</div>
				</div>
			</div>
            <div class = "row">
            	<div class = "col" style = "padding:0px;">
            		<?php if(isset($_SESSION['error']) && $_SESSION['error'] != '') { ?>
							<div class = "alert alert-danger" role = "alert">
								<strong><?php echo $_SESSION['error'];?></strong>
								<button type = "button" class = "close" data-dismiss = "alert" aria-label = "Close">
									<span aria-hidden = "true">&times;</span>
								</button>
							</div>
						<?php } ?>
            	</div>
            </div>
			<div class = "row">
				<div class = "col">
					<div class = "container transparent" style = "margin-top:50px;margin-bottom:50px;padding-bottom:25px;">
						<div class = "row">
							<div class = "col">
								<h3 style = "text-align:center; padding-top:15px;">CHECK-IN</h3> <h3 class = 'text-danger' style = 'text-align:center; font-size: 1rem;'>* Click Submit to finish checking in the crew member(s) *</h3>
							</div>
						</div>
						<div class = "row">
							<div class = "col">
								<form id = "checkinform" method = "POST">
									<label class = "text-white" for = "crew"><strong>Select a Crew :</strong></label>
									<div class = "form-group">
										<select id = "crew" class = "form-control" name = "crew" form = "checkinform">
										<?php
											$db = createConnection();
											$sql = "SELECT DISTINCT crew FROM crewinfo ORDER BY crew ASC";
											$result = $db->query($sql);
											$menu = " ";
											while($row = $result->fetch_assoc()) {
												$sql = "SELECT * FROM crewcomments WHERE crew='".$row['crew']."'";
												$result2 = $db->query($sql);
												$row2 = $result2->fetch_assoc();
												$menu .= "<option value=".$row["crew"].">".$row["crew"]." | ".$row2['commentTitle1']."</option>";
											}
											echo $menu;
											closeConnection($db); ?>
										</select>
									</div>
									<input type = "hidden" name = "formInput">
									<button form = "checkinform" class = "btn btn-primary" value = "submit" type = "submit" style = "width:100%">View Crew</button>
									<hr style = "border-color:rgba(255,255,255,1);background-color:rgba(255,255,255,1);color:rgba(255,255,255,1)">
								</form>
							</div>
						</div>
						<?php if(isset($_POST['formInput'])) { ?>
							<div class = "row">
								<div class = "col">
									<h3 class = "text-center">Crew <?php echo $_POST['crew']; ?></h3>
									<form id = "crewform" method = "POST">
										<table class = "table table-sm table-light table-striped">
											<thead>
												<tr class = "thead-dark">
													<th>Call Sign</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>sNumber</th>
													<th>Position</th>
													<th>Area</th>
													<th class = "text-center">Check-In</th>
													<th class = "text-center">Check-Out</th>
												</tr>
											</thead>
											<tbody class = "text-dark">
												<?php 
													$sql = "SELECT * FROM crewinfo WHERE crew ='".$_POST['crew']."' ORDER BY callorder ASC";
                                                    $db = createConnection();
													$result = $db->query($sql);
													while($row = $result->fetch_assoc()) { ?>
												<?php if(checkForCheckin($row , $db)) { ?>
													<tr class = "table-success">
													<?php } elseif(checkForStatus($row, $db)) { ?>
													<tr class = "table-danger" >
													<?php } else { ?>
													<tr>
												<?php } ?>
													<td><?php echo $row['callsign']; ?></td>
													<td><?php echo $row['firstname']; ?></td>
													<td><?php echo $row['lastname']; ?></td>
													<td><?php echo $row['sNumber']; ?></td>
													<td><?php echo $row['position']; ?></td>
													<td><?php echo $row['area']; ?></td>
													<?php if($row['checkedin'] == '0' || !checkForCheckin($row , $db)) { ?>
                                                    <td class = "align-middle text-center">
                                                    <input type = "checkbox" onclick = "enableSelect(<?php echo $row['id']; ?>)" name = "checkin[]" value = "<?php echo $row['id']; ?>" ></input>
                                                    <select id = "status-<?php echo $row['id'];?>" name = "status[]" form = "crewform" disabled>
                                                    	<option value = 'Entr'>Entr</option>
                                                    	<option value = '10-8' selected>10-8</option>
                                                    	<option value = '97/98'>97/98</option>
                                                    </select>
                                                    </td>
													<td class = "align-middle text-center"><input type = "checkbox" disabled></input></td>
													<?php } else { ?>
													<td class = "align-middle text-center"><input type = "checkbox" disabled></input></td>
													<td class = "align-middle text-center"><input type = "checkbox" name = "checkout[]" value = "<?php echo $row['id'];?>"></input></td>
													<?php } ?>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										<input type = "hidden" name = "secondformInput">
										<button form = "crewform" class = "btn btn-success" value = "submit" type = "submit" style = "width:100%">Submit</button>
                                        <input type = "hidden" name = "formInput">
                                        <input type = "hidden" name = "crew" value = "<?php echo $_POST['crew']; ?>">
									</form>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class = "row">
				<div class = "col">
					<div class = "container-fluid nottransparent fixed-bottom">
						<div class = "row">
							<div class = "col">
								<ul class = "nav">
									<li class = "nav-item active">
										<a class = "nav-link" ref = "#top" style = "color:rgba(255,255,255,1)">TOP</a>
									</li>
								<ul>
							</div>
							<div class = "col">
								<ul class = "nav justify-content-center">
									<li class = "nav-item active">
										<a class = "nav-link" href = "../externallinks/index.php" style = "color:rgba(255,255,255,1)">External Links</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "../about/index.php" style = "color:rgba(255,255,255,1)">About Us</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "../deoc/index.php" style = "color:rgba(255,255,255,1)">DEOC</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "../biz/index.php" style = "color:rgba(255,255,255,1)">Index</a>
									</li>
								</ul>
							</div>
							<div class = "col">
								<ul class = "nav float-right">
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "http://forecast.weather.gov/MapClick.php?CityName=Fresno&state=CA&site=HNX&textField1=36.7478&textField2=-119.771&e=1" style = "color:rgba(255,255,255,1)"><img title = "National Weather Service" src = "../assets/images/nws3.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "http://quickmap.dot.ca.gov/" style = "color:rgba(255,255,255,1)"><img title = "Quick Maps" src = "../assets/images/quickmap.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "https://twitter.com/Caltrans8" style = "color:rgba(255,255,255,1)"><img title = "Twitter" src = "../assets/images/Twitter.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "https://www.waze.com/livemap" style = "color:rgba(255,255,255,1)"><img title = "Waze" src = "../assets/images/waze.png" width = "20px" height = "20px"/></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>