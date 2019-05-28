<?php 
if(isset($_GET['q'])) {
	$y = $_GET['q'];
} else {
	$y = 10;
}
for($x = 0;$x < $y;$x++) {
    echo generateRandomString(8)."<br />";
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} ?>