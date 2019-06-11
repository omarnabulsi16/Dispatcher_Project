<div class = "row">
	<div class = "col align-self-center">
		<img src = "assets/images/logo.png" width = "95" height = "90" alt = "Logo">
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