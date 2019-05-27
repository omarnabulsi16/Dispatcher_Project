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
		<link rel = "icon" href = "../images/favicon.ico" type = "image/ico">
		<link rel = "stylesheet" href = "../assets/css/bootstrap.min.css">
		<link rel = "stylesheet" href = "../assets/css/main.css">
		<script src = "../assets/js/jquery-3.3.1.slim.min.js"></script>
		<script src = "../assets/js/popper.min.js"></script>
		<script src = "../assets/js/bootstrap.min.js"></script>
		<script type = "text/javascript" src = "../assets/js/time.js"></script>
		<script>
			function loadInfo(str) {
				if(window.XMLHttpRequest) {
                	xmlhttp = new XMLHttpRequest();
                } else {
                	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
				xmlhttp.onreadystatechange = function() {
                	if(this.readyState == 4 && this.status ==200) {
                    	document.getElementById("studentassistant").innerHTML = this.responseText;
                    }
                };
				xmlhttp.open("GET","getInfo.php?q="+str,true);
				xmlhttp.send();
			}
		</script>
	</head>
	<body onload = "startTime()">
		<video autoplay = "" muted = "" loop = "" class = "parallax fixed-top">
			<source src = "../assets/videos/TMC_Video.mp4" type = "video/mp4">
		</video>
		<div id = "top" class = "container-fluid">
			<div class = "row nottransparent sticky-top">
				<div class = "col">
					<div class = "container-fluid" >
						<div class = "contianer-fluid clear">
							<div class = "row">
								<div class = "col">
									<img class = "float-left rounded-circle hidden-sm-down" src = "../assets/images/logo.png" width = "95" height = "90" alt = "Logo">
								</div>				
								<div class = "col-5 col align-self-center">
									<h2 style = "text-align:center;">D8 Division of Maintenance</h2>
								</div>
								<div class = "col">
									<?php
									if(isset($_SESSION['login'])) {
										$db = createConnection();
										$sql = "SELECT * FROM users WHERE username='".$_SESSION["login"]."'";
										$result = $db->query($sql);
										$row = $result->fetch_assoc();
										if($row['avatar'] == NULL) { ?>
									<img class = "float-right rounded-circle hidden-sm-down" src = "../assets/images/noprofile.jpg" width = "82" height = "80" alt = "Avatar">
									<?php } else { ?>
									<img class = "float-right rounded-circle hidden-sm-down" src = "<?php echo "../assets/users/".$row['id']."/".$row['username']."/images/".$row['avatar'];?>" width = "80" height = "80" alt = "Logo">
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
                                     <li class = "nav-item dropdown">
										<a class = "nav-link dropdown-toggle" href = "#" id = "downloadDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style = "color:rgba(255,255,255,1)">
											Download
										</a>
										<div class = "dropdown-menu nottransparent" aria-labelledby = "downloadDropdown">
											<a class = "nav-link" href = "../assets/files/2018-05-01MaintConfidential.xlsm">Phone List</a>
											<a class = "nav-link" href = "../assets/files/2018-06-01 Mtce Post Mile log.xlsx">Post Mile Log</a>
										</div>
									</li>
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
								<span class = "navbar-text"><span id = "date"></span> <span id = "time"></span></span>
							</div>
						</nav>
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
			</div>
			<div class = "row">
				<div class = "col">
					<div class = "container transparent" style = "margin-top:50px;margin-bottom:50px;padding-bottom:25px;">
						<div class = "row">
							<div class = "col">
								<h1 style = "text-align:center; padding-bottom:20px; padding-top:20px;">About Us / Contact Infomation</h1>
							</div>
						</div>
						<div class = "row">
							<div class = "col">
								<div class = "row">
									<div class = "col">
										<table class = "table table-bordered table-dark table-striped">
											<thead>
												<tr>
													<th class = "text-center" colspan = "2">D8 IETMC History</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
														<p style = "text-align:center;">
															The Inland Empire Transportation Management Center is designed and constructed to house both Caltrans and CHP personnel and provide intermodal, interregional, interagency traffic management services 24/7 for the Inland Empire region and is the command and control emergency center during major catastrophes.<br /><br />
															The building is a two-story base isolated structure with a total floor space of approximately 45,000 sf and is designed to achieve LEED Gold rating. A 120 foot communications tower is constructed on the site. The IETMC site occupies approximately 10 acres within an approximate 35-acre State-owned parcel located in the southeast quadrant of the interchange of Interstate 15 (I-15) and State Route 210 (SR-210) in the City of Fontana.<br /><br />
															The IETMC&apos;s jurisdictional bounderies include the counties of San Bernardino and Riverside. The Inland Division Dispatch for CHP is co-located in this facility with the building constructed to meet the Essential Services Act criteria.<br/>(Caltrans District 8)<br /><br />
															The IETMC in partnership with the CHP, Caltrans manages the State Highway and Freeway System in District 8 via the TMC. The TMC provides radio communication between TMT field units and office staff. Provides drivers information during special events and major traffic incidents (accidents, fires, snow, etc.) via Changeable Message Signs (CMS) and Highway Advisory Radio (HAR)<br />
														</p>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class = "row">
									<div class = "col">
										<div id = "carouselIndicators" class = "carousel slide" data-ride = "carousel">
											<ol class = "carousel-indicators">
												<li data-target = "#carouselIndicators" data-slide-to = "0" class = "active"></li>
												<li data-target = "#carouselIndicators" data-slide-to = "1"></li>
												<li data-target = "#carouselIndicators" data-slide-to = "2"></li>
											</ol>
											<div class = "carousel-inner">
												<div class = "carousel-item active">
													<img class = "d-block w-100" src = "../assets/images/tmc1.jpg" alt = "First slide">
												</div>
												<div class = "carousel-item">
													<img class = "d-block w-100" src = "../assets/images/tmc2.jpg" alt = "Second slide">
												</div>
												<div class = "carousel-item">
													<img class = "d-block w-100" src = "../assets/images/tmc3.jpg" alt = "Third slide">
												</div>
											</div>
											<a class = "carousel-control-prev" href = "#carouselIndicators" role = "button" data-slide = "prev">
												<span class = "carousel-control-prev-icon" aria-hidden = "true"></span>
												<span class = "sr-only">Previous</span>
											</a>
											<a class = "carousel-control-next" href = "#carouselIndicators" role = "button" data-slide = "next">
												<span class = "carousel-control-next-icon" aria-hidden = "true"></span>
												<span class = "sr-only">Next</span>
											</a>
										</div>
									</div>
								</div>
								<div class = "row">
									<div class = "col">
										<table class = "table table-bordered table-dark table-striped">
											<thead class = "thead-dark">
												<tr>
													<th class = "text-center" colspan = "2">Web Site Contact Information</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><a class = "btn" role = "button" style = "width:100%;" href = "mailto:Nicholas.Novelich@dot.ca.gov">IETMC Dispatcher Supervisor: Nicholas Novelich</a></td>
												</tr>
												<tr>
													<td><a class = "btn" role = "button" style = "width:100%;" target = "_blank" href = "https://district8.onramp.dot.ca.gov/node/579">IETMC Intranet</a></td>
												</tr>
                                                <tr>
													<td><a class = "btn" role = "button" style = "width:100%;" target = "_blank" href = "studentassistants.html" data-toggle = "modal" data-target = "#studentAssistantsModal">Student Assistants</a></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
                                <div class = "row">
									<div class = "col m-3">
                                    	<div id = "studentassistant"> 		
                                        </div>
                                    </div>
                            	</div>
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
									<li class = "nav-item active">
										<a class = "nav-link" href = "#top" style = "color:rgba(255,255,255,1)">TOP</a>
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
        <!-- Add Post Mile Modal -->
		<div class = "modal fade" id = "studentAssistantsModal" tabindex = "9999" role = "dialog" aria-labelledby = "Title" aria-hidden = "true">
			<div class = "modal-dialog modal-dialog-centered" role = "document">
				<div id = "postmileModal" class = "modal-content bg-dark">
					<div class = "modal-body">
						<a onclick = "loadInfo('ramon')" class = "nav-link text-white text-center text-bold" data-dismiss = "modal" >Ramon G. Moreno</a>
                        <a onclick = "loadInfo('omar')" class = "nav-link text-white text-center text-bold" data-dismiss = "modal" >Omar A. Nabulsi</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>