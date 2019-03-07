<?php
session_start();
require_once 'go_connect.php';
require_once 'fn.php';

$passed = json_decode(html_entity_decode(unserialize($_POST['authData'])), true);
print_r($passed);

if(isset($passed)){
	$_SESSION['user'] = $passed;
	$_SESSION['user']['pitsportalmodules'] = explode(',', $_SESSION['user']['pitsportalmodules']);
	unset($_POST);
	$_SESSION['user']['associate'] = getAssociate($_SESSION['user']['ioid'], $mysqli);
	header('Location: https://go.peachio.co/page/dashboard.php');
}
else{
	header('Location: https://go.peachio.co/destroy.php?error=invalidpost_login');
}
?>
