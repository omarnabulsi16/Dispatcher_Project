<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	require "assets/php/requires.php";
	require "assets/php/object_user_priv.php";
	checkSession();
	$_SESSION['url'] = getUrl();
	if(isset($_POST['rememberMe'])) {
		checkForLogin(true);
	} else {
		checkForLogin(false);
	}
	//
	if(isset($_SESSION['login'])) {
    	$_SESSION['priv'] = new privileges($_SESSION['login']);
    } else {
    	$_SESSION['priv'] = new privileges(null);
    }
	//
	if(isset($_POST['messageFormCheck'])) {
    	$db = createConnection();
    	$title = mysqli_real_escape_string($db,$_POST['title']);
    	$login = mysqli_real_escape_string($db,$_SESSION['login']);
    	$message = mysqli_real_escape_string($db,$_POST['message']);
		$sql = "INSERT INTO newsmessages (title, created_by, content) VALUES ('".$title."', '".$login."', '".$message."')";
		$db->query($sql);
		closeConnection($db);
		$url = $_SESSION['url'];
		header("Location: $url");
	} ?>
<html xmlns = "http://www.w3.org/1999/xhtml">
	<head>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>D8 TMC Web</title>
		<link rel = "icon" href = "assets/images/logo.png">
		<link rel = "stylesheet" href = "assets/css/bootstrap.min.css">
		<link rel = "stylesheet" href = "assets/css/main.css">
    	<link href = "https://fonts.googleapis.com/css?family=Anton" rel = "stylesheet">
		<script src = "assets/js/jquery-3.3.1.slim.min.js"></script>
		<script src = "assets/js/popper.min.js"></script>
		<script src = "assets/js/bootstrap.min.js"></script>
		<script type = "text/javascript" src = "assets/js/time.js"></script>
		<script>
		var t1;
		var t2;
		function showCheck() {
        	if (window.XMLHttpRequest) {
            	// code for IE7+, Firefox, Chrome, Opera, Safari
           		xmlhttp = new XMLHttpRequest();
        	} else {
            	// code for IE6, IE5
            	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        	}
        	xmlhttp.onreadystatechange = function() {
            	if (this.readyState == 4 && this.status == 200) {
                	document.getElementById("check").innerHTML = this.responseText;
            	}
        	};
        	xmlhttp.open("GET","assets/php/getcheck.php?buster="+new Date().getTime(),true);
        	xmlhttp.send();
			t1 = setTimeout(showCheck, 3000);
    	}
		function stopRefresh() {
        	clearTimeout(t1);
        }
		function startRefresh() {
        	t1 = setTimeout(showCheck, 3000);
        }
		function showLeave() {
        	if (window.XMLHttpRequest) {
            	// code for IE7+, Firefox, Chrome, Opera, Safari
           		xmlhttp = new XMLHttpRequest();
        	} else {
            	// code for IE6, IE5
            	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        	}
        	xmlhttp.onreadystatechange = function() {
            	if (this.readyState == 4 && this.status == 200) {
                	document.getElementById("leave").innerHTML = this.responseText;
            	}
        	};
        	xmlhttp.open("GET","assets/php/getleave.php?buster="+new Date().getTime(),true);
        	xmlhttp.send();
        	t2 = setTimeout(showLeave, 3000);
    	}
		function getInfo(str) {
       			 if (window.XMLHttpRequest) {
           			 // code for IE7+, Firefox, Chrome, Opera, Safari
           		 	xmlhttp = new XMLHttpRequest();
       			 } else {
           			 // code for IE6, IE5
           			 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
       			 }
      			xmlhttp.onreadystatechange = function() { 
           		 	if (this.readyState == 4 && this.status == 200) {
               			document.getElementById("infobody").innerHTML = this.responseText;
            		} 
       		 	};
        		xmlhttp.open("GET","assets/php/getinfo.php?id="+str,true);
        		xmlhttp.send();
   			 }
function editmodule(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5 
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} 
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("editmodule1").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET","assets/php/editmessage.php?id="+str+"&token="+new Date().getTime(),true);
	xmlhttp.send();
}
function changeStatus(newStatus) {
	var selection = "select-"+newStatus;
	var val = document.getElementById(selection).value;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
        	document.getElementById(selection).blur();
		}
	}
	xmlhttp.open("GET","assets/php/updatestatus.php?id="+newStatus+"&val="+val+"&token="+new Date().getTime(),true);
	xmlhttp.send();
}
function newmessage() {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
    	if(this.readyState == 4 && this.status == 200) {
        	document.getElementById('saveto').innerHTML = "SAVED!";
        }
    };
	xmlhttp.open("POST","assets/php/newmessage.php"); 
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("id="+document.getElementById('messageid').value+"&message="+document.getElementById('newmessage').value.split('&').join("%26"));
}
function checkout(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	/*xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) { 
		}
	};*/
	xmlhttp.open("GET","assets/php/updatecheckout.php?id="+str+"&token="+new Date().getTime(),true);
	xmlhttp.send();
}
function getCheckInfo(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
    	if(this.readyState == 4 && this.status == 200) {
        	document.getElementById('checkInfo').innerHTML = this.responseText;
        	viewCheckMessage(str);
        }
    };
	xmlhttp.open("GET","assets/php/getCheckInfo.php?id="+str, true);
	xmlhttp.send();
}
function viewCheckMessage(str) {
	document.getElementById('hiddenID').value = str;
	document.getElementById('save').innerHTML = "";
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
    	if(this.readyState == 4 && this.status == 200) {
        	document.getElementById('crewMessage').value = this.responseText;
        }
    };
	xmlhttp.open("GET","assets/php/getCheckMessage.php?id="+str+"", true);
	xmlhttp.send();
}
function saveCheckMessage() {
	var id = document.getElementById('hiddenID').value;
	var message = document.getElementById('crewMessage').value.split(' ').join('_');
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
    	if(this.readyState == 4 && this.status == 200) {
        	document.getElementById('save').innerHTML = "SAVED!";
        }
    };
	xmlhttp.open("GET","assets/php/saveCheckMessage.php?id="+id+"&message="+message, true);
	xmlhttp.send();
}
function saveStatus(str) {
	var message = document.getElementById('newStatus').value.split(' ').join('_');
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
    	if(this.readyState == 4 && this.status == 200) {
        	getInfo(str);
        }
    };
	xmlhttp.open("GET","assets/php/saveStatus.php?id="+str+"&message="+message, true);
	xmlhttp.send();
}
function editStatusMessage(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
    	if(this.readyState == 4 && this.status == 200) {
        	document.getElementById('statusMessage').innerHTML = this.responseText;
        }
    };
	xmlhttp.open("GET","assets/php/editStatusMessage.php?q="+str, true);
	xmlhttp.send();
}
function updateTime(str) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
    	if(this.readyState == 4 && this.status == 200) {
        }
    };
	xmlhttp.open("GET","assets/php/updateTime.php?id="+str, true);
	xmlhttp.send();
}
		</script>
	</head>
	<body onload = "startTime()">
		<img src = "assets/images/tmc1.jpg" class = "parallax fixed-top">
			<source src = "assets/videos/TMC_Video.mp4" type = "video/mp4">
		</video>
		<div id = "top" class = "container-fluid">
			<div class = "row nottransparent sticky-top">
				<div class = "col">
					<div class = "container-fluid">
						<div class = "contianer-fluid clear d-none d-lg-block">
							<div class = "row">
								<div class = "col align-self-center">
									<img class = "float-left rounded-circle hidden-sm-down" src = "assets/images/logo.png" width = "95" height = "90" alt = "Logo">
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
									<img class = "float-right rounded-circle hidden-sm-down" src = "assets/images/noprofile.jpg" width = "82" height = "80" alt = "Avatar">
									<?php } else { ?>
									<img class = "float-right border border-white rounded-circle hidden-sm-down" src = "<?php echo "assets/users/".$row['id']."/".$row['username']."/images/".$row['avatar'];?>" width = "80" height = "80" alt = "Logo">
									<?php } 
									} else { ?>
									<img class = "float-right rounded-circle hidden-sm-down" src = "assets/images/noprofile.jpg" width = "82" height = "80" alt = "Avatar">
									<?php } ?>
								</div>
							</div>
						</div>
						<nav class = "navbar navbar-dark clear navbar-expand-lg">
							<a class = "navbar-brand" href = "index.php" style = "padding:5px;">HOME</a>
							<button class = "navbar-toggler" type = "button" data-toggle = "collapse" data-target = "#navbarSupportedContent" aria-controls = "navbarSupportedContent" aria-expanded = "false" aria-label = "Toggle navigation">
								<span class = "navbar-toggler-icon"></span>
							</button>
							<div class = "collapse navbar-collapse" id = "navbarSupportedContent">
								<ul class = "navbar-nav mr-auto">
                                    <li class = "nav-item active">
                                    	<a class = "nav-link" href = "calendar/index.php">Calendar</a>
                                    </li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "guidelines/index.php">Guidelines/References</a>
                                    </li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "maps/index.php">Maps & Contacts</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "agencies/index.php">Allied Agencies & Contacts</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "TMCApplications/index.php">TMC Applications</a>
									</li>
									<li class = "nav-item dropdown">
										<a class = "nav-link dropdown-toggle" href = "#" id = "navbarDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style = "color:rgba(255,255,255,1)">
											Other
										</a>
										<div class = "dropdown-menu nottransparent" aria-labelledby = "navbarDropdown">
                                   	 		<!--<a class = "nav-link" href = "TMCApplications/postmile.php">View Post Mile</a>
                                   			 <div class = "dropdown-divider"></div>-->
											<a class = "nav-link" href = "SOP/index.php">Standard Operating Procedures</a>
											<a class = "nav-link" href = "safety/index.php">Safety</a>
											<a class = "nav-link" href = "TrafficElectrical/index.php">Traffic Electrical</a>
											<div class = "dropdown-divider"></div>
											<a class = "nav-link" target = "_blank" href = "http://10.68.140.160/ietmc/login.php">IE-TMC</a>
										</div>
                                    	</a>
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
												<a class = "dropdown-item" href = "account/register.php">New around here? Sign up</a>
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
											<a class = "nav-link" href = "account/index.php">View Profile</a>
                                    		<a class = "nav-link" href = "account/userlist.php">User List</a>
                                    		<div class = "dropdown-divider"></div>
											<a class = "nav-link" href = "assets/php/logout.php">Logout</a>
										</div>
										</li>
								<?php } ?>
								<?php if(isset($_SESSION['login'])) {
										$temp = checkPriv(createConnection());
										if($temp != "user") { ?>
								<li class = "nav-item dropdown">
									<a class = "nav-link dropdown-toggle" href = "#" id = "toolDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style = "color:rgba(255,255,255,1)">
										Tools
									</a>
                                	<div class = "dropdown-menu nottransparent" aria-labelledby = "toolDropdown">
										<a href = "maps/checkin.php" class = "nav-link">Check-In</a>
                                		<a role = "button" class = "nav-link" data-toggle = "modal" data-target = "#messageModal">Add Message</a>
                                		<a href = "TMCApplications/emplogin.php" class = "nav-link">Change Employee Callout Status</a>
									</div>
								</li>
								<?php }
									} ?>
								</ul>
                                <form class = "form-inline my-2 my-lg-0" action = "search/index.php" method = "POST">
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
								<h3 style = "text-align:center; padding-bottom:20px; padding-top:20px;">Homepage</h3>
							</div> 
						</div> 
                    <!------------------------------------------------------------------------------------->
                    	<table class = "table table-bordered table-dark table-striped">
							<tbody> 
								<tr> 
                                    <th><a class = "btn" role = "button" style = "width:100%;" href = "../webapp_v2/PM" target = "_blank">Web Post Mile</a></th>
                    				<th style = "text-align:center;"> ENTAC - (916) 843-4199 <br> Road Info - (800) 427-7623</th>
                    				<th style = "text-align:center;font-size:14px;">US Army Core of Engineers <br> Ref: Prado Dam<br>PIO (213) 452-3623</th>
                    			</tr> 
							</tbody>  
						</table> 
                    <!------------------------------------Weather widget-------------------------------------
					<div class = "row">
						<div class = "col">
                  			<a class = "weatherwidget-io" href = "https://forecast7.com/en/34d11n117d59/rancho-cucamonga/?unit=us" data-label_1 = "RANCHO CUCAMONGA" data-label_2 = "WEATHER" data-font = "Ubuntu" data-icons = "Climacons Animated" data-								theme = "dark" data-suncolor = "#fff100">RANCHO CUCAMONGA WEATHER</a>
								<script> 
									!function(d,s,id) { var js,fjs = d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js = d.createElement(s);js.id = id;js.src = 'https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}										(document,'script','weatherwidget-io-js');
								</script>
						</div> 
					</div> 
                    ---https://ct.dot.ca.gov/dfs08/maintenance/maintenance/student%20assistants/ietmc.jpg--->
                        <div class = "row"> 
                             <div class = "col text-center"> 
                             </div> 
                        </div> 
                        <hr style = "border-color:rgba(255,255,255,.1);background-color:rgba(255,255,255,.1);color:rgba(255,255,255,.1)">
                        <div class = "row"> 
                             <div class = "col">
                                <h6 class = "text-white; text-center"><b>Checked In</h6></b>
                             	<div id = "check">
                                	<script>
                                		showCheck();
                                	</script>
                                </div>
                             </div>
                             <div class = "col">
                                <h6 class = "text-white; text-center"><b>On Leave</h6></b>
                             	<div id = "leave">
                                	<script>
                                		showLeave();
                                	</script>
                                </div>
                             </div> 
                        </div>
                        <hr style = "border-color:rgba(255,255,255,.1);background-color:rgba(255,255,255,.1);color:rgba(255,255,255,.1)">
                                    <div class = "row mt-4">
							<!--<div class = "col-sm-auto">
								<a class = "twitter-timeline" data-height = "500" href = "https://twitter.com/Caltrans8">Tweets by CaltransDist6</a> <script async src = "https://platform.twitter.com/widgets.js" charset = "utf-8"></script>
							</div>-->  
							<div class = "col-lg">
								<?php 
									$sql = "SELECT * FROM newsmessages ORDER BY creation_date DESC";
									$db = createConnection();
									$result = $db->query($sql);
									if(mysqli_num_rows($result) > 0) {
										while($row = $result->fetch_assoc()) { ?> 
								<div class = "container messages" style = "border: 1px solid rgba(255,255,255,1);">
									<div class = "row" style = "background-color:rgba(100,100,100,1)">
										<div class = "col text-center">
											<span><strong><?php echo $row['title']; ?></strong></span>
										</div>
									</div>
                                <!------------------------------------------------------------------------------------------------------------------------------>
                                <?php
                                	if($row['title'] == 'Updates') { ?>
										<div class = "row" style = "background-color:rgba(0, 0, 0, .4)">
                                			<div class = "col">
                                				<span><?php echo nl2br($row['content']); ?></span>
									<?php } else { ?> 
										<div class = "row" style = "background-color:rgba(252, 22, 18, .65)">
                                			<div class = "col">
                                				<span><b><?php echo nl2br($row['content']); ?></b></span>
                                    <?php } ?>   
                                <!------------------------------------------------------------------------------------------------------------------------------->
										</div>
									</div>
									<div class = "row" style = "background-color:rgba(100,100,100,1)">
										<div class = "col-auto align-self-start">
											<span><strong>Created By: </strong><?php echo $row['created_by']; ?></span>
										</div>
										<div class = "col align-self-center">
											<!--<span><strong>//Date Created: </strong><?php echo $row['creation_date']; ?></span>-->
										</div>
										<?php
											$db = createConnection();
											if(checkPriv($db) == "admin" || checkPriv($db) == "dispatcher") { ?>
										<div class = "col-auto text-right align-self-end"> 
											<a data-toggle = 'modal' data-target = '#editmodule' class = 'btn' onclick = 'editmodule(<?php echo $row["id"]; ?>)'><img src = 'assets/svg/pencil-white.svg' title = 'Edit Message' width = '10'</img></a>
 											<a class = "clear" href = "assets/php/deletepost.php?id=<?php echo $row['id']; ?>"><img src = 'assets/svg/trash-white.svg' title = 'Delete Message' width = '10'></img></a>
										</div>
										<?php } ?>
									</div>
								</div>
								<hr style = "border-color:rgba(255,255,255,.1);background-color:rgba(255,255,255,.1);color:rgba(255,255,255,.1)">
								<?php }
									} ?>
							</div>
						</div>
                                    <div class = "text-center row"> 
                        	<div class = "col text-center"> 
                              	<span class = "text-center text-danger">Contact <a class = "text-warning" href = "mailto:Nicholas.Novelich@dot.ca.gov" title = "Mail Nicholas">Nicholas.Novelich@dot.ca.gov</a> if you have any questions/suggestions about the website</span>
                        	</div>
                        </div>
					</div>	               
				</div>                     
			</div>
			<div class = "row">
				<div class = "col">
					<div class = "container-fluid nottransparent fixed-bottom d-none d-lg-block">
						<div class = "row">
							<div class = "col">
								<h6 class = "text-white"><span id = "date"></span> <span id = "time"></span></h6>
							</div>
							<div class = "col">
								<ul class = "nav justify-content-center">
									<li class = "nav-item active"> 
										<a class = "nav-link" href = "externallinks/index.php" style = "color:rgba(255,255,255,1)">External Links</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "about/index.php" style = "color:rgba(255,255,255,1)">About Us</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "deoc/index.php" style = "color:rgba(255,255,255,1)">DEOC</a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" href = "biz/index.php" style = "color:rgba(255,255,255,1)">Index</a>
									</li>
								</ul>
							</div>
							<div class = "col">
								<ul class = "nav float-right">
                                	<!-- -->
                                	<?php
                                		if($_SESSION['priv']->get_view_privilege()) { ?>
                                	<li class = "nav-item active">
										<a class = "nav-link super-secret-link" target = "_blank" href = "dispatchers/index.php"><b class="secret-icon">!</b>  Dispatchers  <b class="secret-icon">&iexcl;</b></a>
									</li>
                                	<?php } ?>
                                	<!-- -->
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "http://forecast.weather.gov/MapClick.php?CityName=Fresno&state=CA&site=HNX&textField1=36.7478&textField2=-119.771&e=1" style = "color:rgba(255,255,255,1)"><img title = "National Weather Service" src = "assets/images/nws3.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "http://quickmap.dot.ca.gov/" style = "color:rgba(255,255,255,1)"><img title = "Quick Maps" src = "assets/images/quickmap.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "https://twitter.com/Caltrans8" style = "color:rgba(255,255,255,1)"><img title = "Twitter" src = "assets/images/Twitter.png" width = "20px" height = "20px"/></a>
									</li>
									<li class = "nav-item active">
										<a class = "nav-link" target = "_blank" href = "https://www.waze.com/livemap" style = "color:rgba(255,255,255,1)"><img title = "Waze" src = "assets/images/waze.png" width = "20px" height = "20px"/></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Add to Message Modal -->
		<div class = "modal fade" id = "messageModal" tabindex = "9999" role = "dialog" aria-labelledby = "Title" aria-hidden = "true">
			<div class = "modal-dialog modal-dialog-centered modal-lg" role = "document">
				<div id = "messageModal" class = "modal-content">
					<div class = "modal-header">
						<h5 style = "color:rgba(0,0,0,1);" class = "modal-title" id = "Title">Add Message</h5>
						<button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
							<span aria-hidden = "true">&times;</span>
						</button>
					</div>
					<div class = "modal-body">
						<form id = "addmessage" method = "post">
							<div class = "form-group row mr-1 ml-1">
								<label class = "col col-form-label" for = "title"><b style = "color:rgba(0,0,0,1);">Title</b></label>
								<input class = "form-control" type = "text" name = "title" placeholder = "Enter Title" required></input>
							</div>
							<div class = "form-group row mr-1 ml-1">
								<label class = "col col-form-label" for = "message"><b style = "color:rgba(0,0,0,1);">Message</b></label>
								<textarea class = "form-control" form = "addmessage" rows = "5" name = "message" style = "resize:none;" placeholder = "Enter Message" required></textarea>
							</div>
							<input type = "hidden" value = "1" name = "messageFormCheck" >
						</form>
					</div>
					<div class = "modal-footer">	
						<button type = "button" class = "btn btn-secondary" data-dismiss = "modal">Close</button>
						<button form = "addmessage" type = "reset" class = "btn btn-danger">Reset</button>
						<button form = "addmessage" type = "submit" class = "btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
    	<!-- Leave Info Modal -->
		<div class = "modal fade" id = "moreInfoModal" tabindex = "9999" role = "dialog" aria-labelledby = "getInfoModal" aria-hidden = "true">
  			<div class = "modal-dialog modal-dialog-centered modal-lg" role = "document">
    			<div class = "modal-content">
     				 <div class = "modal-header">
       					 <h5 class = "modal-title text-dark" >Status Message</h5>
       	 					<button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
          						<span aria-hidden = "true">&times;</span>
       						</button> 
      				</div> 
      				<div class = "modal-body" id = "infobody">
       			 	...
     				</div> 
      				<div class = "modal-footer">
        				<button type = "button" class = "btn btn-secondary" data-dismiss = "modal">Close</button>
      				</div> 
    			</div> 
  			</div> 
		</div> 
       	<!-- Check Info Modal -->
		<div class = "modal fade" id = "checkModal" tabindex = "9999" role = "dialog" aria-labelledby = "checkModal" aria-hidden = "true">
  			<div class = "modal-dialog modal-dialog-centered modal-lg" role = "document">
    			<div class = "modal-content">
     				 <div class = "modal-header">
       					 <h5 class = "text-dark">Message</h5><span class = "text-danger align-middle align-bottom" style = 'margin-left:.5em'>* Messages will NOT save unless you are logged in</span>
       	 				<button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
          					<span aria-hidden = "true">&times;</span>
       					</button>
      				</div> 
      				<div class = "modal-body" id = "checkbody">
                        <div id = "checkInfo"></div>
       			 		<form> 
                            <input id = "hiddenID" type = "hidden" value = "0">
                        	<textarea id = "crewMessage" rows = '10' style = "width:100%;resize:none;"></textarea>    
                        </form>
     				</div>
      				<div class = "modal-footer">
                        <span class = "text-danger" id = "save"></span>
                        <a onclick = "saveCheckMessage()" class = "btn btn-success text-white">Save</a>
        				<button type = "button" class = "btn btn-secondary" data-dismiss = "modal">Close</button>
      				</div>
    			</div>
  			</div>
		</div>
            <div class = "modal fade" id = "editmodule" tabindex = "9999" role = "dialog" aria-labelledby = "editmodule" aria-hidden = "true">
  			<div class = "modal-dialog modal-dialog-centered modal-lg" role = "document">
    			<div class = "modal-content">
     				 <div class = "modal-header">
       					 <h5 class = "text-dark">Edit Message </h5>
       	 				<button type = "button" class = "close" data-dismiss = "modal" aria-label = "Close">
          					<span aria-hidden = "true">&times;</span>
       					</button>
      				</div>
      				<div class = "modal-body" id = "editmodule1">
                        ...
     				</div>
      				<div class = "modal-footer">
                        <span class = "text-danger" id = "saveto"></span>
                        <a onclick = "newmessage()" class = "btn btn-success text-white">Save</a>
        				<button type = "button" class = "btn btn-secondary" data-dismiss = "modal">Close</button>
      				</div>
    			</div>
  			</div>
		</div>
	</body>
</html>