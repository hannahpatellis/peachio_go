<?php
session_start();
if(isset($_GET['revoke'])){
	$requestURL = 'https://accounts.google.com/o/oauth2/revoke?token='.$_SESSION['access_token']['access_token'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $requestURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	$res = curl_exec($ch);
	if (curl_errno($ch)) {
	    echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
}
unset($_SESSION['access_token']);
unset($_SESSION['user']);
unset($_POST);
$URL = 'Location: https://go.peachio.co/welcome.php';
if(isset($_GET['error'])){
	$code = $_GET['error'];
	$URL = 'Location: https://go.peachio.co/welcome.php?&error='.$code;
}
session_unset();
session_destroy();
header($URL);
?>
