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
	</head>
	<body onload = "startTime()">
		<img src = "../assets/images/tmc1.jpg" class = "parallax fixed-top">
<!--<video autoplay = "" muted = "" loop = "" class = "parallax fixed-top">
			<source src = "assets/videos/TMC_Video.mp4" type = "video/mp4">
		</video>-->
		<div id = "top" class = "container-fluid">
			<div class = "row nottransparent sticky-top">
				<div class = "col">
					<div class = "container-fluid">
						<div class = "contianer-fluid clear">
							<div class = "row">
								<div class = "col align-self-center"> 
									<img class = "float-left rounded-circle hidden-sm-down" src = "../assets/images/logo.png" width = "95" height = "90" alt = "Avatar">
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
                                    		<!--<a class = "nav-link" href = "../TMCApplications/postmile.php">View Post Mile</a>
                                    <div class = "dropdown-divider"></div>-->
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
											<!--<a class = "nav-link" href = "../assets/files/2018-06-01 Mtce Post Mile log.xlsx">Post Mile Log</a>-->
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
                                 <?php if(isset($_SESSION['login'])) {
										$temp = checkPriv( createConnection());
										if($temp != "user"){ ?>
								<li class = "nav-item dropdown">
									<a class = "nav-link dropdown-toggle" href = "#" id = "toolDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style = "color:rgba(255,255,255,1)">
										Tools
									</a>
									<div class = "dropdown-menu nottransparent" aria-labelledby = "toolDropdown">
										<a href = "checkin.php" class = "nav-link">Check-In</a>
                                		<a href = "../TMCApplications/emplogin.php" class = "nav-link ">Change Employee Callout Status</a>
									</div>
								</li>
								<?php }
									} ?>
								</ul>
								<form class = "form-inline my-2 my-lg-0" action = "../search/index.php" method = "POST">
     					 			<input class = "form-control mr-sm-2" name = 'search' type = "search" placeholder = "Search" aria-label = "Search" required autocomplete="off">
      								<button class = "btn btn-outline-success my-2 my-sm-0" type = "submit">Search</button>
    							</form>
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
                        <!-------------------------------------------------------------------------------------------------->
			<div class = "row">
				<div class = "col">
					<div class = "container transparent" style = "margin-top:50px;margin-bottom:50px;padding-bottom:25px;">
						<div class = "row">
							<div class = "col">
								<h4 style = "text-align:center; padding-bottom:20px; padding-top:20px;">Maps & Contacts</h4>
							</div>
							<!--<div class = "col" id = "zoomButton">
								<a onclick = "zoom(1)" class = "btn float-right"><img src = "../../assets/svg/zoom-in.svg" width = "16"></img></a>
							</div>-->
						</div>
        	<div class = "row">
        		<div class = "col">
        			<ul class = "nav nav-tabs" id = "myTab" role = "tablist">
        				<li class = "nav-item">
        					<a class = "nav-link active" id = "supt-tab" data-toggle = "tab" href = "#supt" role = "tab" aria-controls = "supt" aria-selected = "true">Superintendents & Managers</a>
        				</li>
        				<li class = "nav-item">
        					<a class = "nav-link" id = "electrical-tab" data-toggle = "tab" href = "#electrical" role = "tab" aria-controls = "electrical" aria-selected = "true">Electrical</a>
        				</li>
        				<li class = "nav-item">
        					<a class = "nav-link" id = "special-tab" data-toggle = "tab" href = "#special" role = "tab" aria-controls = "special" aria-selected = "false">Special</a>
        				</li>
        				<li class = "nav-item">
        					<a class = "nav-link" id = "tree-tab" data-toggle = "tab" href = "#tree" role = "tab" aria-controls = "tree" aria-selected = "false">Tree</a>
        				</li>
        				<li class = "nav-item">
        					<a class = "nav-link" id = "landscape-tab" data-toggle = "tab" href = "#landscape" role = "tab" aria-controls = "landscape" aria-selected = "false">Landscape</a>
        				</li>
        				<li class = "nav-item">
        					<a class = "nav-link" id = "swp-tab" data-toggle = "tab" href = "#swp" role = "tab" aria-controls = "swp" aria-selected = "false">SWP/Spray</a>
        				</li>
        				<li class = "nav-item">
        					<a class = "nav-link" id = "support-tab" data-toggle = "tab" href = "#support" role = "tab" aria-controls = "support" aria-selected = "false">Support</a>
        				</li>
        				<li class = "nav-item">
        					<a class = "nav-link" id = "engineering-tab" data-toggle = "tab" href = "#engineering" role = "tab" aria-controls = "engineering" aria-selected = "false">Engineering</a>
        				</li>
        				<li class = "nav-item">
        					<a class = "nav-link" id = "offices-tab" data-toggle = "tab" href = "#offices" role = "tab" aria-controls = "offices" aria-selected = "false">Offices</a>
        				</li>
        				<li class = "nav-item">
        					<a class = "nav-link" id = "Info-tab" data-toggle = "tab" href = "#info" role = "tab" aria-controls = "info" aria-selected = "false">Info</a>
        				</li>
        			</ul>
        			<div class = "tab-content" id = "myTabContent">
        				<div class = "tab-pane fade show active" id = "supt" role = "tabpanel" aria-labelledby = "supt-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=supt">Superintendents</a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=mgr">Managers </a></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        				<div class = "tab-pane fade" id = "electrical" role = "tabpanel" aria-labelledby = "electrical-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">Electrical Services</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=831">831 | East Electrical </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=832">832 | Central/Metro Electrical </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=833">833 | West Electrical </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=834">834 | North Electrical </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=835">835 | South Electrical </a></td>
        								<td class = "w-50"></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        				<div class = "tab-pane fade" id = "special" role = "tabpanel" aria-labelledby = "special-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">Special Services</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=811">811 | Striping/Pavement Marking </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=812">812 | Bridge Crew </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=813">813 | Sign Crew </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=814">814 | Guardrail </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=815">815 | Storm Water </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=603">603 | HazMat </a></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        				<div class = "tab-pane fade" id = "tree" role = "tabpanel" aria-labelledby = "tree-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">Tree Crews</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=644">644 | North Tree Crew </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=854">854 | Metro Tree Crew </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=615">615 | North Tree Crew </a></td>
        								<td class = "w-50"></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        				<div class = "tab-pane fade" id = "landscape" role = "tabpanel" aria-labelledby = "landscape-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">Metro Landscape (LS)</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=844">844 | Metro LS </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=852">852 | Ontario LS </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=853">853 | Upland LS </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=855">855 | Upland Mtce </a></td>
        							</tr>
        						</tbody>
        					</table>
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">North Landscape (LS)</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=642">642 | Rancho LS </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=643">643 | Fontana LS </a></td>
        							</tr>
       								<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=645">645 | Rialto LS </a></td>
        								<td class = "w-50"></td>
        							</tr>
        						</tbody>
        					</table>
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">South Landscape (LS)</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=715">715 | Banning LS </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=724">724 | Riverside LS </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=744">744 | Indio LS </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=762">762 | Temecula LS </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=764">764 | Corona LS </a></td>
        								<td class = "w-50"></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        				<div class = "tab-pane fade" id = "swp" role = "tabpanel" aria-labelledby = "swp-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">SWP/Spray Crews</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=842">842 | Metro Sweeping & Graffiti </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=843">843 | Metro Spray </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=722">722 | Riverside SWP </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=723">723 | Riverside SWP/Spray </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=764">764 | Corona SWP </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=726">726 | Moreno Valley Graffiti </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=765">765 | Corona SWP & Toll </a></td>
        								<td class = "w-50"></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        				<div class = "tab-pane fade" id = "support" role = "tabpanel" aria-labelledby = "support-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">Maintenance Support</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=600">600 | Maintenance Branch </a></td>
        								<td class = "w-50"></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=601">601 | MTCE Support </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=602">602 | MTCE Support </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=603">603 | MTCE Support/Field </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=604">604 | MTCE Support </a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=606">606 | Shipppig/Receiving </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=698">698 | Equipment Shop </a></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        				<div class = "tab-pane fade" id = "engineering" role = "tabpanel" aria-labelledby = "engineering-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">Engineering</th>
        							</tr>
        						</thead>
        						<tbody>
                        			<tr>
        								<td class = "w-auto"><a class = "btn btn-dark w-100">Engineering Design North </a></td>
        								<td class = "w-auto"><a class = "btn btn-dark w-100">Engineering Design South </a></td>
        							</tr>
        							<tr>
        								<td class = "w-auto"><a class = "btn btn-dark w-100">Project Mgmt. </a></td>
        								<td></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        				<div class = "tab-pane fade" id = "offices" role = "tabpanel" aria-labelledby = "offices-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">Region Offices</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-auto"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=890">890 | Metro Region </a></td>
        								<td class = "w-auto"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=690">690 | North Region </a></td>
        							</tr>
        							<tr>
        								<td class = "w-auto"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=790">790 | South Region </a></td>
                                        <td></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        				<div class = "tab-pane fade" id = "info" role = "tabpanel" aria-labelledby = "info-tab">
        					<table class = "table table-borderless text-center text-white bg-dark border border-white">
        						<thead class = "thead-dark">
        							<tr>
        								<th colspan = "2">Info Crews</th>
        							</tr>
        						</thead>
        						<tbody>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=SHOP">Shop 8 Areas </a></td>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=SAFETY">Safety</a></td>
        							</tr>
        							<tr>
        								<td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=PI">Public Info</a></td>
                                        <td class = "w-50"><a class = "btn btn-dark w-100" href = "crewcallout.php?crew=609">Maintenance Engineering</a></td>
        							</tr>
        						</tbody>
        					</table>
        				</div>
        			</div>
        		</div>
        	</div>
            <div class = "row">
        		<div class = "col">
        			<table class = "table table-sm table-striped table-dark table-bordered text-center">
        				<thead >
        					<tr>
        						<th colspan = "2">Callout</th>
        					</tr>
        				</thead>
        				<tbody>
        					<tr>
        						<td><a class = "btn" href = "map.php"><img src = "../assets/images/calloutMapimg.png" width = "100%;"></img></a></td>
        						<td><a class = "btn" href = "construction.php"><img src = "../assets/images/constructionMap.png" width = "100%;"></img></a></td>
        					</tr>
        					<tr>
        						<td><a class = "btn" target = "_blank" href = "http://quickmap.dot.ca.gov/"><img src = "../assets/images/Quickmaps.png" width = "100%;"></img></a></td>
        						<td><a class = "btn" target = "_blank" href = "../../assets/downloads/Appendix%2028_TMC_Contacts.pdf"><img src = "../assets/images/TMCContacts.png" width = "100%;"></img></a></td>
        					</tr>
        				</tbody>
        			</table>
        		</div>
        		<div class = "col">
        			<table class = "table table-sm table-striped table-dark table-bordered text-center">
        				<thead class = "text-center">
        					<tr>
        						<th colspan = "2">Zoom</th>
        					</tr>
        				</thead>
        				<tbody>
        					<tr>
        						<td><a class = "btn" target = "_blank" href = "https://district8.onramp.dot.ca.gov/node/580"><img src = "../assets/images/DTM_AreaMap.png" width = "100%;"></img></a></td>
        						<td><a class = "btn" target = "_blank" href = "https://district8.onramp.dot.ca.gov/node/578"><img src = "../assets/images/TrafficSignOpMap.png" width = "100%;"></img></a></td>
        					</tr>
        					<tr>
        						<td><a class = "btn" target = "_blank" href = "http://d06web/tmc/tmc_internal/2016/Appendices/Appendix%2005_CHP_dispatch_Centers.pdf"><img src = "../assets/images/CT_CHP_Sectors.png" width = "100%;"></img></a></td>
        						<td><a class = "btn" target = "_blank" href = "http://northregion.dot.ca.gov/rtmc/maps/mapFiles/CT_Districts.pdf"><img src = "../assets/images/CT_Districts.png" width = "100%;"></img></a></td>
        					</tr>
        				</tbody>
        			</table>
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
										<a class = "nav-link" target = "_blank" href = "http://forecast.weather.gov/MapClick.php?CityName=Fresno&state=CA&site=HNX&textField1=36.7478&textField2=-119.771&e=1" style = "color:rgba(255,255,255,1)"><img title = "National Weather Service" src = "../assets/images/nws3.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "http://quickmap.dot.ca.gov/" style = "color:rgba(255,255,255,1)"><img title = "Quick Maps" src = "../assets/images/quickmap.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link " target = "_blank" href = "https://twitter.com/Caltrans8" style = "color:rgba(255,255,255,1)"><img title = "Twitter" src = "../assets/images/Twitter.png" width = "20px" height = "20px"/></a>
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
        </div>
	</body>
</html>