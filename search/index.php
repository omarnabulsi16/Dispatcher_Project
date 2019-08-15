<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	require "../assets/php/requires.php";
	checkSession();
	$_SESSION['url'] = getUrl();
	if(isset($_POST['rememberMe'])) {
		checkForLogin(true);
	} else {
		checkForLogin(false);
	} ?>
<html xmlns = "http://www.w3.org/1999/xhtml">
	<head>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>D8 TMC Web</title>
		<link rel = "icon" href = "../assets/images/logo.png">
		<link rel = "stylesheet" href = "../assets/css/bootstrap.min.css">
		<link rel = "stylesheet" href = "../assets/css/main.css">
		<script src = "../assets/js/jquery-3.3.1.slim.min.js"></script>
		<script src = "../assets/js/popper.min.js"></script>
		<script src = "../assets/js/bootstrap.min.js"></script>
		<script type = "text/javascript" src = "../assets/js/time.js"></script>
	</head>	
		<body onload = "startTime()">
		<img src = "../assets/images/tmc1.jpg" class = "parallax fixed-top">
<!--<video autoplay = "" muted = "" loop = "" class = "parallax fixed-top">
			<source src = "assets/videos/TMC_Video.mp4" type = "video/mp4">
		</video>-->
		<div id = "top" class = "container-fluid">
			<div class = "row nottransparent sticky-top">
				<div class = "col">
					<div class = "container-fluid" >
						<div class = "contianer-fluid clear">
							<div class = "row">
								<div class = "col align-self-center">
									<img class = "float-left rounded-circle hidden-sm-down" src = "../assets/images/logo.png" width = "95" height = "90" alt = "Logo">
								</div>			
								<div class = "col-5 col align-self-center">
									<h2 style = "text-align:center;">D8 Division of Maintenance</h2>
								</div>
								<div class = "col align-self-center">
									<?php
									if(isset($_SESSION['login'])) {
										$db = createConnection();
										$sql = "SELECT * FROM users WHERE username='".$_SESSION["login"]."'";
										$result = $db->query($sql);
										$row = $result->fetch_assoc();
										if($row['avatar'] == NULL) { ?>
									<img class = "float-right rounded-circle hidden-sm-down" src = "../assets/images/noprofile.jpg" width = "82" height = "80" alt = "Avatar">
									<?php } else { ?>
									<img class = "float-right border border-white rounded-circle hidden-sm-down" src = "<?php echo "../assets/users/".$row['id']."/".$row['username']."/images/".$row['avatar'];?>" width = "80" height = "80" alt = "Logo">
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
                                    		<a class = "nav-link" href = "../TMCApplications/postmile.php">View Post Mile</a>
                                    <div class = "dropdown-divider"></div>
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
											<a class = "nav-link" href = "../assets/files/2018-05-01MaintConfidential.xlsm">Phone List</a>
											<a class = "nav-link" href = "../assets/files/2018-06-01 Mtce Post Mile log.xlsx">Post Mile Log</a>
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
												<!--<a class = "dropdown-item" href = "#">Forgot password?</a>-->
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
								<form class = "form-inline my-2 my-lg-0" action = "../search/index.php" method = "POST">
     					 			<input class = "form-control mr-sm-2" name = 'search' type = "search" placeholder = "Search" aria-label = "Search" required autocomplete = "off">
      								<button class = "btn btn-outline-success my-2 my-sm-0" type = "submit">Search</button>
    							</form>
							</div>
						</nav>
					</div>
				</div>
			</div>
            <div class = "row">
            	<div class = "col" style = "border:0px;padding:0px;">
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
								<h3 style = "text-align:center; padding-bottom:20px; padding-top:20px;">Search Results</h3>
							</div>
						</div>
						<div class = "row">
							<div class = "col text-center">
								<?php 
                        			$db = createConnection();
									$search = $_POST['search'];
									$result = $db->query("SELECT * FROM crewcomments WHERE crew LIKE '%$search%' OR EFIS_number LIKE '%$search%' OR commentTitle1 LIKE '%$search%' OR commentTitle2 LIKE '%$search%' ORDER BY crew ASC");
									echo "<table class='table table-sm table-light table-striped table-borderless'>
                                    	<thead class='thead-dark'>
                                        	<tr>
                                            	<th colspan='10'>RESULTS IN CREW</th>
                                            </tr>
                                           	</tr>
                                            	<th>CREW</th>
                                                <th>EFIS NUMBER</th>
                                                <th>NAME</th>
                                                <th>ADDRESS</th>
                                            </tr>
                                        </thead>
                                        <tbody> ";
									if(mysqli_num_rows($result) == 0) {
                                    	echo"
                                        	<tr>
                                            	<td colspan='10'><span class='text-danger'>0 RESULTS</span></td>
                                            </tr> ";
                                    } else { 
                                    	while($crew = $result->fetch_assoc()) { 
                                        	echo "
                                            	<tr class='text-dark'>
                                                	<td><a class='text-dark' href='../maps/crewcallout.php?crew=".$crew['crew']."'><b>".$crew['crew']."</b></a></td>
                                                    <td><span>".$crew['EFIS_number']."</span></td>
                                                    <td><span>".$crew['commentTitle1']."</span></td>
                                                    <td><span>".$crew['commentTitle2']."</span></td>
                                                </tr> ";
                                        }
                                    }
									echo "</tbody>
                                    </table>";
									$result = $db->query("SELECT * FROM crewinfo WHERE crew LIKE '%$search%' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR callsign LIKE '%$search%' OR area LIKE '%$search%' OR position LIKE '%$search%' ORDER BY crew,callorder ASC");
									echo "<table class='table table-sm table-light table-striped table-borderless'>
                                    	<thead class='thead-dark'>
                                        	<tr>
                                            	<th colspan='10'>RESULTS IN INDIVIDUALS</th>
                                            </tr>
                                           	</tr>
                                            	<th>CREW</th>
                                                <th>CALLSIGN</th>
                                                <th>NAME</th>
                                                <th>AREA</th>
                                                <th>POSITION</th>
                                            </tr>
                                        </thead>
                                        <tbody> ";
									if(mysqli_num_rows($result) == 0) {
                                    	echo"
                                        	<tr>
                                            	<td colspan='10'><span class='text-danger'>0 RESULTS</span></td>
                                            </tr> ";
                                    } else {
                                    	while($crew = $result->fetch_assoc()) {
                                        	echo "
                                            	<tr class='text-dark'>
                                                	<td><a class='text-dark' href='../maps/crewcallout.php?crew=".$crew['crew']."'><b>".$crew['crew']."</b></a></td>
                                                    <td><span>".$crew['callsign']."</span></td>
                                                    <td><span>".$crew['firstname']." ".$crew['lastname']."</span></td>
                                                    <td><span>".$crew['position']."</span></td>
                                                    <td><span>".$crew['area']."</span></td>
                                                </tr> ";
                                        }
                                    }
									echo "</tbody>
                                    </table>"; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class = "row">
				<div class = "col">
					<div class = "container-fluid nottransparent fixed-bottom">
						<div class = "row">
							<div class = "col">
								<ul class = "nav">
									<div class = "col">
										<h6 class = "text-white"><span id = "date"></span> <span id = "time"></span></h6>
									</div>
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
										<a class = "nav-link" target = "_blank"  href = "http://forecast.weather.gov/MapClick.php?CityName=Fresno&state=CA&site=HNX&textField1=36.7478&textField2=-119.771&e=1" style = "color:rgba(255,255,255,1)"><img title = "National Weather Service" src = "../assets/images/nws3.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "http://quickmap.dot.ca.gov/" style = "color:rgba(255,255,255,1)"><img title = "Quick Maps" src = "../assets/images/quickmap.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "https://twitter.com/Caltrans8" style = "color:rgba(255,255,255,1)"><img title = "Twitter" src = "../assets/images/Twitter.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank"  href = "https://www.waze.com/livemap" style = "color:rgba(255,255,255,1)"><img title = "Waze" src = "../assets/images/waze.png" width = "20px" height = "20px"/></a>
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