<?php
session_start();
require_once('../auth/google-api-client/autoload.php');
require_once('../auth/go_connect.php');
require_once('../auth/fn.php');

$currentGroups = array();
if($stmt = $mysqli->prepare("SELECT gid, name, address FROM groups")) {
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($gid, $name, $address);
	
	while($stmt->fetch()){
		$currentGroups[] = [
		    "gid" => $gid,
		    "name" => $name,
		    "address" => $address
		];
	}
	$stmt->close();
}

$headers = array();
$headers[] = "Authorization: Bearer ".$_SESSION['access_token']['access_token'];
$result = json_decode(curlGET('https://www.googleapis.com/admin/directory/v1/groups?customer=C027aiqnn&fields=groups', $headers, true), true);

foreach($result['groups'] as $group){
	foreach($currentGroups as $current){
		if($group['email'] == $current['address']){}
		else{
			if($update_stmt = $mysqli->prepare("INSERT INTO groups (gid, name, address) VALUES (?, ?, ?)")) {
				$update_stmt->bind_param('sss', $group['id'], $group['name'], $group['email']);
				$update_stmt->execute();
				$update_stmt->close();
			}
		}
	}
}

header('Location: https://go.peachio.co/page/directory.php?message=yay');

?>