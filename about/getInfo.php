<?php
	$q = $_GET['q'];
	if($q == "ramon") {
    	echo "
        	<div class='row'>
            	<div class='col p-2' style='background-color:#074224;'>
                	<h5 class='text-white text-center'>Ramon G. Moreno</h5>
                </div>
            </div>
            <div class='row' style='background-image: url(https://www.cpp.edu/~aboutcpp/img/cpp2.jpg); background-size:100%; background-repeat:no-repeat;min-height:500px;'>
            	<div class='col'>
                	<h6 class='text-dark text-center' style='font-weight:600;'> About Me</h6>
                    <p class='text-dark p-1' style='background-color:rgba(255,255,255,.25)'>
                    	I went to the Univesrity of Cal Poly Pomona. My major during the first year was Computer Engineering; however, I found Computer Science and programming much more compelling.
                    </p>
                </div>
            </div>
        ";
    }
	else if ($q == "omar") {
    	echo "<div class='row'>
            	<div class='col p-2' style='background-color:#225588;'>
                	<h5 class='text-orange text-center'>Omar Nabulsi</h5>
                </div>
            </div>
            <div class='row' style='background-image: url(http://10.68.140.245/webapp_v2/assets/images/omar.jpg); background-size:100%; background-repeat:no-repeat;min-height:400px;'>
           <!-- <div class='row' style='background-image: url(http://10.68.140.245/webapp_v2/assets/images/omar.jpg);  background-size:100% 100%; background-repeat:no-repeat;min-height:250px;'>-->
            	<div class='col'><br />
                    <p class='text-orange2 p-1' style='margin-left:17em' style='background-color:rgba(255,255,255,.25)'>                    						
                    	California State University of Fullerton Ungraduate in Computer Science. 
                    </p>
                </div>
            </div>
        ";
    } ?>