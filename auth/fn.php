<?php
// This function file is for authentication and user services onli
require_once('go_connect.php');

// CURL Function
function curlGET($requestURL, $headers, $keyNeeded){
	if($keyNeeded == true){
		$requestURL = $requestURL.'&key=';
	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $requestURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	if(isset($headers)){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}
	$res = curl_exec($ch);
	if (curl_errno($ch)) {
	    echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	return $res;
}

// get GO DB requests
function getAssociates($mysqli){
	$a = array();
	if($stmt = $mysqli->prepare("SELECT ioid, firstname, lastname, middlename, preferedname, pronouns, company, personalemail, peachioemail, phone1, phone1_type, phone2, phone2_type, address1, address2, city, state, postcode, country, admin, type, managerdirector, projects_safe, media_safe, title, quip, image, startdate, enddate, status, notes, ssn, license, license_state, dob, citizenship FROM associates")) {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($ioid, $firstname, $lastname, $middlename, $preferedname, $pronouns, $company, $personalemail, $peachioemail, $phone1, $phone1_type, $phone2, $phone2_type, $address1, $address2, $city, $state, $postcode, $country, $admin, $type, $managerdirector, $projects_safe, $media_safe, $title, $quip, $image, $startdate, $enddate, $status, $notes, $ssn, $license, $license_state, $dob, $citizenship);
		
		while($stmt->fetch()){
			$a[] = [
			    "ioid" => $ioid,
			    "firstname" => $firstname,
			    "lastname" => $lastname,
			    "middlename" => $middlename,
			    "preferedname" => $preferedname,
			    "pronouns" => $pronouns,
			    "company" => $company,
			    "personalemail" => $personalemail,
			    "peachioemail" => $peachioemail,
			    "phone1" => $phone1,
			    "phone1_type" => $phone1_type,
			    "phone2" => $phone2,
			    "phone2_type" => $phone2_type,
			    "address1" => $address1,
			    "address2" => $address2,
			    "city" => $city,
			    "state" => $state,
			    "postcode" => $postcode,
			    "country" => $country,
			    "admin" => $admin,
			    "type" => $type,
			    "managerdirector" => $managerdirector,
			    "projects_safe" => explode(',', $projects_safe),
			    "media_safe" => explode(',', $media_safe),
			    "title" => $title,
			    "quip" => $quip,
			    "image" => $image,
			    "startdate" => $startdate,
			    "enddate" => $enddate,
			    "status" => $status,
			    "notes" => $notes,
			    "ssn" => $ssn,
			    "license" => $license,
			    "license_state" => $license_state,
			    "dob" => $dob,
			    "citizenship" => $citizenship
			];
		}
		$stmt->close();
	}
	return $a;
}
function getAssociate($ioid, $mysqli){
	$a = array();
	if($stmt = $mysqli->prepare("SELECT ioid, firstname, lastname, middlename, preferedname, pronouns, company, personalemail, peachioemail, phone1, phone1_type, phone2, phone2_type, address1, address2, city, state, postcode, country, admin, type, managerdirector, projects_safe, media_safe, title, quip, image, startdate, enddate, status, notes, ssn, license, license_state, dob, citizenship FROM associates WHERE ioid = (?) LIMIT 1")) {
		$stmt->bind_param('s', $ioid);
              $stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($ioid, $firstname, $lastname, $middlename, $preferedname, $pronouns, $company, $personalemail, $peachioemail, $phone1, $phone1_type, $phone2, $phone2_type, $address1, $address2, $city, $state, $postcode, $country, $admin, $type, $managerdirector, $projects_safe, $media_safe, $title, $quip, $image, $startdate, $enddate, $status, $notes, $ssn, $license, $license_state, $dob, $citizenship);
		$stmt->fetch();
			$a = [
			    "ioid" => $ioid,
			    "firstname" => $firstname,
			    "lastname" => $lastname,
			    "middlename" => $middlename,
			    "preferedname" => $preferedname,
			    "pronouns" => $pronouns,
			    "company" => $company,
			    "personalemail" => $personalemail,
			    "peachioemail" => $peachioemail,
			    "phone1" => $phone1,
			    "phone1_type" => $phone1_type,
			    "phone2" => $phone2,
			    "phone2_type" => $phone2_type,
			    "address1" => $address1,
			    "address2" => $address2,
			    "city" => $city,
			    "state" => $state,
			    "postcode" => $postcode,
			    "country" => $country,
			    "admin" => $admin,
			    "type" => $type,
			    "managerdirector" => $managerdirector,
			    "projects_safe" => explode(',', $projects_safe),
			    "media_safe" => explode(',', $media_safe),
			    "title" => $title,
			    "quip" => $quip,
			    "image" => $image,
			    "startdate" => $startdate,
			    "enddate" => $enddate,
			    "status" => $status,
			    "notes" => $notes,
			    "ssn" => $ssn,
			    "license" => $license,
			    "license_state" => $license_state,
			    "dob" => $dob,
			    "citizenship" => $citizenship
			];
		$stmt->close();
	}
	return $a;
}
function getGroup($group, $mysqli){
	$g = array();
	if($group = 'all'){
		if($stmt = $mysqli->prepare("SELECT gid, name, address, notes FROM groups")) {
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($gid, $name, $address, $notes);
			
			while($stmt->fetch()){
				$g[] = [
				    "gid" => $gid,
				    "name" => $name,
				    "address" => $address,
				    "notes" => $notes,
				];
			}
			$stmt->close();
		}
		return $g;
	}
	else{
		if($stmt = $mysqli->prepare("SELECT gid, name, address, notes WHERE address = (?) FROM groups")) {
			$stmt->bind_param('s', $group);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($gid, $name, $address, $notes);
			
			while($stmt->fetch()){
				$g[] = [
				    "gid" => $gid,
				    "name" => $name,
				    "address" => $address,
				    "notes" => $notes,
				];
			}
			$stmt->close();
		}
		return $g;
	}
}
function getPortalMods($mysqli){
	if($stmt = $mysqli->prepare("SELECT modid, portal_access_name, friendly, url, icon, parent, haschildren FROM portal_mods WHERE hidden = 0")) {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($modid, $portal_access_name, $friendly, $url, $icon, $parent, $haschildren);
		
		while($stmt->fetch()){
			$mods[$modid] = [
			    "modid" => $modid,
			    "portal_access_name" => $portal_access_name,
			    "friendly" => $friendly,
			    "url" => $url,
			    "icon" => $icon,
			    "parent" => $parent,
			    "haschildren" => $haschildren,
			];
		}
		$stmt->close();
	}
	return $mods;
}

// Other
function getAllUsers($mysqli){
	if($stmt = $mysqli->prepare("SELECT userid, ioid, gid, name, username, password, domain, email, admin, managerdirector, groups, modules, google_ident_store FROM users")) {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($userid, $ioid, $gid, $name, $username, $password, $domain, $email, $admin, $managerdirector, $groups, $modules, $google_ident_store);
		
		while($stmt->fetch()){
			$u[] = [
			    "userid" => $userid,
			    "ioid" => $ioid,
			    "gid" => $gid,
			    "name" => $name,
			    "username" => $username,
			    "password" => $password,
			    "domain" => $domain,
			    "email" => $email,
			    "admin" => $admin,
			    "managerdirector" => $managerdirector,
			    "groups" => $groups,
			    "modules" => $modules,
			    "google_ident_store" => $google_ident_store,
			];
		}
		$stmt->close();
	}
	return $u;
}
function findnewioid($mysqli){
	$newioid = 0;
	if($stmt = $mysqli->prepare("SELECT ioid FROM associates")) {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($ioid);
		
		while($stmt->fetch()){
			if($ioid > $newioid){
				$newioid = $ioid;
			}
		}
		$newioid++;
		$stmt->close();
	}
	return $newioid;
}
function findnewuserid($mysqli){
	$newuserid = 0;
	if($stmt = $mysqli->prepare("SELECT userid FROM users")) {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($userid);
		
		while($stmt->fetch()){
			if($userid > $newuserid){
				$newuserid = $userid;
			}
		}
		$newuserid++;
		$stmt->close();
	}
	return $newuserid;
}
function findnewleadid($mysqli){
	$newleadid = 0;
	if($stmt = $mysqli->prepare("SELECT lead_id FROM ic_leads")) {
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($lead_id);
		
		while($stmt->fetch()){
			if($lead_id > $newleadid){
				$newleadid = $lead_id;
			}
		}
		$newleadid++;
		$stmt->close();
	}
	return $newleadid;
}
?>