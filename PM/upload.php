<?php
	require "../assets/php/requires.php";
	checkSession();
	if(isset($_SESSION['login'])) {
		if(isset($_FILES['image'])) {
     		$errors= array();
      		$file_name = $_FILES['image']['name'];
      		$file_size = $_FILES['image']['size'];
      		$file_tmp = $_FILES['image']['tmp_name'];
      		$file_type = $_FILES['image']['type'];
      		$file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
      		$ext = array("xlsx");
      		if(in_array($file_ext,$ext) === false) {
         		$errors[] = "extension '".$file_ext."' not allowed.";
      		}
      		if(intval($file_size) > 2097152) {
         		$errors[] = 'File size must be under 2 MB';
      		}
      		if(empty($errors) == true) {
            		move_uploaded_file($file_tmp,"/var/www/webapp_v2/PM/".$file_name);
      				echo "Upload was a success";
            		echo $_FILES['image']['size'];
      		} else {
         		print_r($errors);
      		}
    	} ?>
<form method = "POST" enctype = "multipart/form-data">
	<label class = "custom-file-label" id = "fileLabel" for = "image">Choose file</label>
	<input id = "image" type = "file" name = "image" required>
    <input type = "submit" value = "Upload File" name = "submit">
</form>
<?php
	} else {
    	echo "Login to Upload a file";
    } ?>