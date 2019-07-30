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
		<!--<video autoplay = "" muted = "" loop = "" class = "parallax fixed-top">
			<source src = "../assets/videos/TMC_Video.mp4" type = "video/mp4">
		</video>-->
		<img src = "../assets/images/tmc1.jpg" class = "parallax fixed-top">
		<div id = "top" class = "container-fluid">
			<div class = "row nottransparent sticky-top">
				<div class = "col">
					<div class = "container-fluid">
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
										<a class = "nav-link" href = " ../TMCApplications/index.php">TMC Applications</a>
									</li>
									<li class = "nav-item dropdown">
										<a class = "nav-link dropdown-toggle" href = "#" id = "navbarDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false" style = "color:rgba(255,255,255,1)">
											Other
										</a>
                                    		<div class = "dropdown-menu nottransparent" aria-labelledby = "navbarDropdown">
                                            	<!--<a class = "nav-link" href = "../TMCApplications/postmile.php">View Post Mile</a>
                                    				<div class = "dropdown-divider"></div>-->
                                            	<a class = "nav-link" href = "../SOP/index.php">Standard Operating Procedures</a>
                                            	<a class = " nav-link" href = "../safety/index.php">Safety</a>
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
												<a class = "nav-link " href = "../assets/php/logout.php">Logout</a>
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
										<a href = "checkin.php" class = "nav-link">Check-In</a>
                                		<a href = "TMCApplications/emplogin.php" class = "nav-link">Change Employee Callout Status</a>
									</div>
								</li>
								<?php }
									} ?>
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
								<h3 style = "text-align:center; padding-top:35px;">D8 Callout Map</h3>
							</div>
						</div>
						<div class = "row text-center">
							<!--<div class = "col">
								<div class = "dropdown">
									<a class = "btn dropdown-toggle clear" href = "#" role = "button" id = "specialCrewDropdown" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">
										<img src = "../assets/images/specCrews.png" />
									</a>
									 <div class = "dropdown-menu" aria-labelledby = "specialCrewDropdown">
										<a class = "dropdown-item" href = "#">Maintenance</a>
										<a class = "dropdown-item" href = "#">District Office | Adminstation</a>
									</div>
								</div>
							</div>-->
							<div class = "col">
								<div class = "dropdown">
									<a class = "btn dropdown-toggle clear" href = "#" role = "button" id = "elecCrewDropdown" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">
										<img src = "../assets/images/ElectricalCrews.png"/>
									</a>
									 <div class = "dropdown-menu" aria-labelledby = "elecCrewDropdown">
										<a class = "dropdown-item" href = "crewcallout.php?crew=831">831 | East Electrical</a>
										<a class = "dropdown-item" href = "crewcallout.php?crew=832">832 | Central/Metro Electrical</a>
										<a class = "dropdown-item" href = "crewcallout.php?crew=833">833 | West Electrical</a>
										<a class = "dropdown-item" href = "crewcallout.php?crew=834">834 | North Electrical</a>
										<a class = "dropdown-item" href = "crewcallout.php?crew=835">835 | South Electrical</a>
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class = "row">
				<div class = "col">
					<div class = "container-fluid text-center mx-auto" style = "margin-top:50px;margin-bottom:50px;padding-bottom:25px;">
						<img class = "mx-auto" src = "../assets/images/map.png" style = "width:1260px;height:955px;" usemap = "#map">
						<map name = "map">
							<area shape = "poly" coords = "797,83,780,135,775,139,764,134,758,137,743,134,638,181,582,230,573,249,564,251,547,275,551,277,566,256,577,252,586,232,638,186,684,167,741,139,749,141,763,141,766,139,777,144,784,137,800,86" href = "crewcallout.php?crew=632" title = "632"/></area>
							<area shape = "poly" coords = "268,369,267,372,271,375,271,382,277,387,272,409,247,437,239,453,236,477,239,478,245,450,244,448,276,411,279,389,285,385,302,382,305,382,309,375,317,374,336,376,358,371,392,362,425,343,482,313,493,301,520,296,535,291,550,279,550,277,547,275,532,288,514,294,486,299,477,308,467,316,418,343,391,359,365,367,330,373,311,370,299,378,282,379,280,383,275,380,275,373,267,368,267,370" href = "crewcallout.php?crew=633" title = "633" /></area>
							<area shape = "poly" coords = "295,385,296,392,298,396,293,404,300,432,311,452,317,463,322,463,312,444,303,428,296,404,302,395,298,383,294,384,306,382,313,384,315,389,370,399,410,402,463,413,505,419,522,432,562,437,579,434,579,429,541,432,519,426,504,414,471,408,465,409,374,394,341,389,317,384,313,381,305,378,304,380" href = "crewcallout.php?crew=631" title = "631" /></area>
							<area shape = "poly" coords = "975,242,979,247,982,257,983,253,984,284,984,310,985,321,992,331,1005,338,1008,348,991,352,972,360,973,363,1002,352,1011,353,1026,348,1029,346,1048,358,1056,365,1061,372,1059,383,1059,409,1056,427,1052,468,1055,470,1058,458,1059,434,1061,417,1064,406,1098,411,1062,367,1049,354,1033,346,1021,345,1011,348,1005,337,992,327,986,312,987,288,985,253,975,241" href  ="crewcallout.php?crew=663" title = "663" /></area>
							<area shape = "poly" coords = "582,430,590,429,602,432,608,433,615,432,620,430,625,430,631,429,636,428,643,427,647,426,652,425,656,425,659,423,662,423,666,424,673,427,681,428,686,428,692,429,699,430,704,430,711,430,717,430,723,429,729,428,733,427,736,425,742,423,751,422,759,420,761,418,769,416,774,412,782,409,786,407,793,403,799,399,805,396,807,394,813,394,817,391,826,390,831,390,838,389,843,387,857,386,862,384,871,384,884,382,892,380,902,378,911,376,918,375,924,374,931,371,930,373,938,369,946,366,952,364,958,362,965,362,969,362,970,364,960,364,956,366,949,368,942,372,936,375,931,376,927,377,923,377,919,377,914,378,906,380,901,381,894,382,889,383,882,384,878,385,864,387,858,389,842,391,834,393,832,393,831,393,827,393,823,393,813,395,804,398,799,400,789,405,786,409,781,412,773,416,765,420,762,422,759,423,751,425,748,426,740,426,735,428,730,429,721,431,709,432,706,432,696,432,688,432,681,430,674,428,666,428,662,428,658,428,652,428,648,430,643,432,638,432,624,434,619,435,614,436,609,438,604,438,601,436,595,434,591,432,582,434,580,431" href = "crewcallout.php?crew=664" title = "664" /></area>
							<area shape = "poly" coords = "1052,477,1052,519,1054,550,1055,572,1059,592,1061,601,1076,616,1050,641,1049,646,1032,655,1014,658,999,658,972,650,928,658,897,669,889,671,881,679,848,668,827,663,818,664,797,657,782,655,779,662,784,662,786,657,824,667,880,681,884,681,890,676,906,670,935,661,947,657,971,654,999,661,1013,662,1038,657,1053,648,1068,631,1080,618,1085,617,1105,639,1106,647,1114,651,1115,656,1118,654,1118,648,1109,643,1109,635,1089,616,1106,612,1122,614,1148,621,1156,624,1173,621,1174,616,1162,619,1156,620,1141,614,1119,609,1103,607,1084,612,1077,611,1063,594,1059,569,1057,532,1055,477,1052,476" href = "crewcallout.php?crew=661" title = "661" /></area>
							<area shape = "poly" coords = "878,682,875,687,875,716,872,758,852,785,831,807,826,812,782,822,773,827,738,831,680,834,679,838,725,840,749,834,779,830,824,815,853,815,907,829,953,844,952,839,909,826,875,817,842,810,835,810,855,787,871,769,877,761,878,718,879,686,881,682,877,682" href = "crewcallout.php?crew=742" title = "742" /></area>
							<area shape = "poly" coords = "1115,657,1115,684,1109,692,1105,699,1099,709,1099,715,1102,717,1102,724,1106,731,1103,754,1110,780,1112,791,1107,795,1102,794,1097,799,1094,800,1094,805,1096,824,1097,836,1072,836,1034,838,977,842,977,848,1049,842,1068,840,1071,876,1055,876,1055,888,1048,888,1049,906,1053,906,1052,891,1059,891,1059,881,1076,880,1073,841,1111,839,1111,834,1101,835,1098,800,1110,797,1116,791,1113,769,1107,751,1109,731,1106,716,1102,715,1104,707,1119,686,1120,679,1119,656,1115,656" href = "crewcallout.php?crew=743" title = "743" /></area>
							<area shape = "poly" coords = "373,632,381,630,386,634,400,643,400,650,382,651,374,654,359,651,340,653,334,659,324,657,315,663,315,678,306,679,298,686,295,690,280,692,261,693,262,697,281,697,298,693,308,684,315,692,325,691,321,670,321,665,342,660,362,654,376,658,382,659,396,653,404,653,404,643,401,638,383,630,378,627,374,630" href = "crewcallout.php?crew=621" title = "621" /></area>
							<area shape = "poly" coords = "234,479,213,510,207,516,204,528,183,528,181,524,178,522,178,527,109,531,105,533,98,534,98,537,108,536,112,534,179,532,180,569,171,584,175,585,200,545,207,532,210,521,220,521,224,517,235,523,247,532,258,532,289,550,314,552,339,551,338,548,327,547,327,512,325,508,321,511,323,514,324,548,313,548,305,545,290,545,263,528,247,527,232,515,220,513,216,515,214,514,227,497,236,478,214,508,204,528,203,532,183,532,184,563,203,530,160,532" href = "crewcallout.php?crew=611" title = "611,613" /></area>
							<area shape = "poly" coords = "119,564,126,570,127,575,138,582,144,589,148,600,156,603,154,590,161,590,169,586,173,587,175,603,166,601,164,607,168,610,178,634,182,636,181,648,173,656,168,656,174,650,179,640,167,629,159,608,143,602,137,589,132,583,123,579,118,583,119,588,116,592,100,587,100,584,107,584,113,587,116,586,114,582,118,577,122,574,115,566,116,564" href = "crewcallout.php?crew=612" title = "612" /></area>
							<area shape = "poly" coords = "66,749,68,733,83,731,73,719,79,719,88,731,103,749,111,769,137,770,133,765,136,746,139,744,139,765,141,768,152,767,154,770,143,772,150,790,156,798,167,814,177,822,201,829,204,834,201,837,195,831,173,826,153,807,152,799,142,788,140,774,109,773,103,779,98,776,107,770,97,750,87,737,76,737,69,748,65,747" href = "crewcallout.php?crew=763" title = "763,764" /></area>
							<area shape = "poly" coords = "325,554,331,553,347,566,366,591,377,605,368,618,374,627,371,631,365,621,350,623,350,628,322,632,316,629,318,623,328,616,355,616,365,611,369,601,339,565,323,553,329,553" href = "crewcallout.php?crew=622" title = "622" /></area>
							<area shape = "poly" coords = "321,751,315,770,314,792,317,790,318,775,325,754,319,750,273,899,275,880,284,875,289,854,289,832,292,829,292,824,259,823,258,816,264,819,286,819,289,821,295,821,298,818,312,818,316,815,328,816,328,813,331,813,334,816,361,815,380,819,381,823,399,830,403,829,405,833,395,837,388,834,388,831,374,823,364,821,341,820,315,819,313,822,299,823,296,825,297,831,293,834,293,855,288,877,279,882,276,899,272,898" href = "crewcallout.php?crew=712" title = "712" /></area>
							<area shape = "poly" coords = "341,548,340,551,359,552,392,561,401,567,406,567,418,576,455,577,458,584,471,588,487,617,488,640,498,665,470,675,450,692,442,705,448,704,453,696,479,676,510,665,661,657,677,662,706,662,764,670,768,676,777,678,783,663,777,662,774,672,769,671,764,666,748,664,704,656,677,658,660,653,505,660,503,664,494,641,492,615,474,584,462,580,456,572,420,572,408,562,402,563,393,556,384,556,357,547,340,546,340,549" href = "crewcallout.php?crew=741" title = "741" /></area>
							<area shape = "poly" coords = "447,749,466,755,480,769,514,791,533,805,558,814,568,815,600,857,606,867,606,867,609,878,607,912,612,920,620,929,626,929,613,916,612,882,613,875,614,876,619,882,632,888,661,889,675,909,694,925,698,925,692,915,681,908,661,884,632,884,615,872,610,870,610,863,599,843,582,821,606,828,617,827,641,834,676,838,677,834,645,828,639,830,620,824,619,823,603,823,578,818,570,810,556,810,550,805,533,801,507,782,474,759,465,752,445,748,445,751" href = "crewcallout.php?crew=744" title = "744" /></area>
							<area shape = "poly" coords = "395,797,398,814,406,815,405,834,427,853,448,880,435,885,407,889,389,900,383,910,366,919,364,934,371,940,376,940,376,936,368,929,371,921,388,911,392,903,409,894,437,890,497,879,513,861,514,846,508,839,505,839,507,853,507,861,492,873,455,882,431,851,418,835,409,831,412,815,408,810,404,812,401,802,402,794,395,793,394,796" href = "crewcallout.php?crew=713" title = "713" /></area>
							<area shape = "poly" coords = "100,202,105,253,122,316,128,342,109,341,102,337,102,340,108,345,130,347,150,424,179,519,180,522,183,522,182,514,161,445,152,417,141,380,143,372,134,347,144,347,177,366,196,371,250,371,266,372,266,367,257,365,225,368,195,367,171,358,144,342,132,343,120,294,108,239,105,204,102,199,99,201" href = "crewcallout.php?crew=637" title = "637" /></area>
							<area shape = "poly" coords = "249,670,252,671,259,655,265,648,265,646,284,645,291,638,305,637,305,629,315,629,317,625,313,621,303,622,299,626,300,631,294,634,290,632,281,640,273,637,267,631,261,631,262,635,265,636,268,641,264,643,262,640,260,645,249,667,251,669" href = "crewcallout.php?crew=623" title = "623" /></area>
							<area shape = "poly" coords = "202,605,200,611,195,615,212,623,215,632,212,637,218,653,221,654,221,664,225,667,224,656,228,654,226,640,260,636,261,632,255,632,258,627,259,618,255,616,249,611,244,611,250,604,241,593,222,593,221,601,220,603,206,604,200,604,205,607,201,615,219,617,222,624,216,626,220,632,227,633,233,630,252,623,253,621,246,615,241,616,239,611,243,604,229,602,222,608,204,608,202,614" href = "crewcallout.php?crew=624" title = "624" /></area>
							<area shape = "poly" coords = "105,751,103,715,81,720,81,717,104,713,103,697,103,694,86,698,87,693,108,691,121,698,137,697,137,688,149,676,155,678,144,688,142,698,143,698,143,700,141,702,141,716,143,721,127,717,109,718,109,750,103,750,107,745,109,713,108,698,119,703,138,703,136,716,126,713,109,714,106,713,106,748" href="crewcallout.php?crew=851" title = "851,852,853,854,855" /></area>
							<area shape = "poly" coords = "172,757,175,759,193,745,197,734,201,729,210,739,217,743,242,804,254,813,255,833,259,832,259,812,245,801,225,748,263,749,265,744,223,743,203,726,208,720,203,718,199,724,178,720,161,715,142,716,142,720,161,720,183,725,196,727,192,740,189,745,174,756,175,758" href = "crewcallout.php?crew=721" title = "721,722,723,724,726" /></area>
							<area shape = "poly" coords = "146,699,146,700,216,701,214,705,219,706,221,702,247,700,260,702,264,710,287,721,290,718,279,710,264,705,254,697,248,695,250,676,253,672,225,667,214,666,215,680,197,682,199,685,215,684,216,697,145,698,145,700,223,698,247,696,247,678,228,670,218,671,221,697,146,700" href = "crewcallout.php?crew=841" title = "841,842,843,844" /></area>
							<area shape = "poly" coords = "442,761,462,776,473,777,478,797,482,799,485,795,480,792,482,785,474,772,464,772,444,759,441,760,281,745,283,748,294,744,303,748,320,750,313,788,317,789,321,761,325,752,324,751,351,750,358,763,366,773,386,798,392,797,392,793,388,794,368,769,368,766,364,763,364,758,357,753,356,750,372,747,377,751,415,749,439,759,444,759,424,749,443,751,446,749,443,746,453,712,447,705,442,706,446,712,442,746,404,746,380,747,376,747,372,743,355,746,321,746,299,729,293,731,313,743,304,746,294,740,280,746,280,745" href = "crewcallout.php?crew=711" title = "711,715" /></area>
							<area shape = "poly" coords = "172,878,177,882,187,859,193,861,194,864,203,862,196,852,205,845,208,844,240,879,264,902,273,921,271,938,280,941,277,922,276,916,263,894,264,880,266,876,266,839,261,834,255,834,262,856,263,876,259,885,259,893,241,875,223,851,213,843,228,830,242,809,240,805,221,830,211,839,205,836,202,838,205,841,201,843,192,854,185,857,172,878,295,917,302,919,318,927,345,928,352,930,355,935,364,936,364,930,359,931,352,925,341,922,316,922,301,913,294,917" href = "crewcallout.php?crew=761" title = "761,762" /></area>
							<area shape = "poly" coords = "95,681,99,677,121,678,150,675,150,677,154,676,156,675,193,675,210,674,213,673,215,672,207,659,184,636,180,638,205,662,208,669,185,671,160,670,171,659,173,657,166,657,155,670,116,673,95,674,91,678,94,680" href = "crewcallout.php?crew=641" title = "641,643" /></area>
						</map>
					</div>
				</div>
			</div>
			<div class = "row">
				<div class = "col">
					<div class = "container transparent" style = "margin-bottom:50px;padding-bottom:25px;padding-top:25px;">
						<div class = "row">
							<div class = "col">
								<table class = "table table-dark">
									<thead>
										<tr>
											<th class = "text-center" colspan = "5">North</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(232,181,158);" href = "crewcallout.php?crew=611">611</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(222,208,91);" href = "crewcallout.php?crew=612">612</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(232,181,158);" href = "crewcallout.php?crew=613">613</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(123,92,154);" href = "crewcallout.php?crew=621">621</a></td>
                    						<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(167,99,171);" href = "crewcallout.php?crew=622">622</a></td>
										</tr>
										<tr>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(142,115,62);" href = "crewcallout.php?crew=623">623</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(125,203,208);" href = "crewcallout.php?crew=624">624</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(13,139,171);" href = "crewcallout.php?crew=631">631</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(44,228,229);" href = "crewcallout.php?crew=632">632</a></td>
                    						<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(96,204,63);" href = "crewcallout.php?crew=633">633</a></td>
										</tr>
										<tr>
                    						<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(236,100,40);" href = "crewcallout.php?crew=637">637</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(16,166,41);" href = "crewcallout.php?crew=641">641</a></td>
               								<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(128,13,171);" href = "crewcallout.php?crew=663">663</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(148,148,148);" href = "crewcallout.php?crew=664">664</a></td>
                    						<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(255,255,255);" href = "crewcallout.php?crew=661">661</a></td>
										</tr>
                                        <tr>
                    						<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(255,255,255);" href = "crewcallout.php?crew=662">662</a></td>
                                        </tr>
									</tbody>
								</table>
							</div>
							<div class = "col">
								<table class = "table table-dark">
									<thead>
										<th class = "text-center" colspan = "4">South</th>
									</thead>
									<tbody>
										<tr>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(249,186,253);" href = "crewcallout.php?crew=711">711</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(160,153,213);" href = "crewcallout.php?crew=712">712</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(174,120,83);" href = "crewcallout.php?crew=713">713</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(249,186,253);" href = "crewcallout.php?crew=715">715</a></td>
										</tr>
										<tr>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(162,79,151);" href = "crewcallout.php?crew=721">721</a></td>
                    						<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(162,79,151);" href = "crewcallout.php?crew=726">726</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(64,222,68);" href = "crewcallout.php?crew=741">741</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(179,177,32);" href = "crewcallout.php?crew=742">742</a></td>
										</tr>
										<tr>
                    						<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(172,197,222);" href = "crewcallout.php?crew=743">743</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(224,79,178);" href = "crewcallout.php?crew=744">744</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(77,124,57);" href = "crewcallout.php?crew=761">761</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(255,234,3);" href = "crewcallout.php?crew=763">763</a></td>
                    						<td></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class = "col">
								<table class = "table table-dark">
									<thead>
										<th class = "text-center" colspan = "4">Metro</th>
									</thead>
									<tbody>
										<tr>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(251,143,37);" href = "crewcallout.php?crew=841">841</a></td>
											<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(255,0,48);" href = "crewcallout.php?crew=851">851</a></td>
                    						<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(255,0,48);" href = "crewcallout.php?crew=852">852</a></td>
                    						<td><a class = "btn btn-sm" style = "width:100%;color:black;background-color:rgb(255,0,48);" href = "crewcallout.php?crew=855">855</a></td>
										</tr>
									</tbody>
								</table>
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