<?php
require_once('../../include/header.php');
require_once('../../include/sidebar.php');
require_once('../../auth/fn.php');
require_once('../../auth/go_connect.php');
$associates = getAssociates($mysqli);
$associates_count = 0;
foreach($associates as $x){$associates_count++;}

if(isset($_GET['update'])){
	$update = "UPDATE `associates` SET `ioid` = '".$_POST['ioid']."', `firstname` = '".strtolower($_POST['firstname'])."', `lastname` = '".strtolower($_POST['lastname'])."', `middlename` = '".strtolower($_POST['middlename'])."', `preferedname` = '".strtolower($_POST['preferedname'])."', `pronouns` = '".strtolower($_POST['pronouns'])."', `company` = '".$_POST['company']."', `personalemail` = '".strtolower($_POST['personalemail'])."', `peachioemail` = '".strtolower($_POST['peachioemail'])."', `phone1` = '".$_POST['phone1']."', `phone1_type` = '".$_POST['phone1_type']."', `phone2` = '".$_POST['phone2']."', `phone2_type` = '".$_POST['phone2_type']."', `address1` = '".$_POST['address1']."', `address2` = '".$_POST['address2']."', `city` = '".$_POST['city']."', `state` = '".$_POST['state']."', `postcode` = '".$_POST['postcode']."', `country` = '".$_POST['country']."', `admin` = '".$_POST['admin']."', `type` = '".$_POST['type']."', `managerdirector` = '".$_POST['managerdirector']."', `projects_safe` = '".strtolower($_POST['projects_safe'])."', `media_safe` = '".strtolower($_POST['media_safe'])."', `title` = '".$_POST['title']."', `quip` = '".$_POST['quip']."', `image` = '".strtolower($_POST['image'])."', `startdate` = '".$_POST['startdate']."', `enddate` = '".$_POST['enddate']."', `status` = '".$_POST['status']."', `notes` = '".$_POST['notes']."', `ssn` = '".$_POST['ssn']."', `license` = '".$_POST['license']."', `license_state` = '".$_POST['license_state']."', `dob` = '".$_POST['dob']."', `citizenship` = '".$_POST['citizenship']."' WHERE `associates`.`ioid` = ".$_POST['ioid'];
	if($stmt = $mysqli->prepare($update)) {
		$stmt->execute();
		$stmt->close();
		$updated = true;
	}
	else{
		$updated = false;
	}
}
if(isset($_GET['new'])){
	$new = "INSERT INTO `associates` (`ioid`, `firstname`, `lastname`, `middlename`, `preferedname`, `pronouns`, `company`, `personalemail`, `peachioemail`, `phone1`, `phone1_type`, `phone2`, `phone2_type`, `address1`, `address2`, `city`, `state`, `postcode`, `country`, `admin`, `type`, `managerdirector`, `projects_safe`, `media_safe`, `title`, `quip`, `image`, `startdate`, `enddate`, `status`, `notes`, `ssn`, `license`, `license_state`, `dob`, `citizenship`) VALUES ('".$_POST['ioid']."', '".strtolower($_POST['firstname'])."', '".strtolower($_POST['lastname'])."', '".strtolower($_POST['middlename'])."', '".strtolower($_POST['preferedname'])."', '".strtolower($_POST['pronouns'])."', '".$_POST['company']."', '".strtolower($_POST['personalemail'])."', '".strtolower($_POST['peachioemail'])."', '".$_POST['phone1']."', '".$_POST['phone1_type']."', '".$_POST['phone2']."', '".$_POST['phone2_type']."', '".$_POST['address1']."', '".$_POST['address2']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['postcode']."', '".$_POST['country']."', '".$_POST['admin']."', '".$_POST['type']."', '".$_POST['managerdirector']."', '".strtolower($_POST['projects_safe'])."', '".strtolower($_POST['media_safe'])."', '".$_POST['title']."', '".$_POST['quip']."', '".$_POST['image']."', '".$_POST['startdate']."', '".$_POST['enddate']."', '".$_POST['status']."', '".$_POST['notes']."', '".$_POST['ssn']."', '".$_POST['license']."', '".$_POST['license_state']."', '".$_POST['dob']."', '".$_POST['citizenship']."')";
	if($stmt = $mysqli->prepare($new)) {
		$stmt->execute();
		$stmt->close();
		$added = true;
	}
	else{
		$added = false;
	}
}
?>
<style type="text/css">
i.fa{
	margin-right:10px;
}	
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php print $associates_count; ?> associates</h1>
        </div>
    </div>
    
    <div class="row">
		<div class="col-lg-6">
			<div class="well">
				Associates include any entity or individual who does work and/or has entered an agreement with peachIO. Associates can be paid or unpaid, compensated or uncompensated. This is case-by-case. Therefore, some associates are Employees or Independent Contractors. Some associates can be designated as managers or directors.
				<hr />
				<center>
					<a href="associates.php?add"><button type="button" class="btn btn-default">Add an Associate</button></a>
				</center>
			</div>
			<br />
			<div>
				<p><table id="associates" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>IO ID</th>
	  					<th>Name</th>
	  					<th>Company</th>
	  					<th>Title</th>
	  					<th>Type</th>
	  					<th>M/A</th>
	  					<th></th>
	  				</tr>
	  			</thead>
	  			<tfoot>
		  			<tr>
			  			<th>IO ID</th>
			  			<th>Name</th>
	  					<th>Company</th>
	  					<th>Title</th>
	  					<th>Type</th>
	  					<th>M/A</th>
	  					<th></th>
			  		</tr>
			  	</tfoot>
			  	<tbody>
				  	<?php foreach($associates as $a) { ?>
				  	<tr>
					  	<td><?php print $a['ioid']; ?></td>
					  	<td><?php print ucfirst($a['preferedname']).' '.ucfirst($a['lastname']); ?></td>
					  	<td><?php print $a['company']; ?></td>
					  	<td><?php print $a['title']; ?></td>
					  	<td><?php print $a['type']; ?></td>
					  	<td><?php if($a['managerdirector'] == 1){print 'Yes';}else{print 'No';} ?> / <?php if($a['admin'] == 1){print 'Yes';}else{print 'No';} ?></td>
					  	<td>
						  	<a href="associates.php?edit=<?php print $a['ioid']; ?>"><i class="fa fa-external-link-square"></i></a> 
					  	</td>
					</tr>
					<?php } ?>
				</tbody>
			</table></p>	
			</div>
		</div>
			
		<!-- UPDATE ASSOCIATE -->
		<div class="col-lg-6">
			<?php if(isset($updated)){if($updated == true){print '<h2>Associate updated</h2>';}} ?>
			<?php if(isset($updated)){if($updated == false){print '<h2>There was an error</h2>';}} ?>
			<?php if(isset($_GET['edit'])){
				foreach($associates as $a){
					if($_GET['edit'] == $a['ioid']){
						$this_agent = $a;}} ?>
				<form method="post" action="associates.php?update=<?php print $this_agent['ioid']; ?>">
					<div class="col-lg-6">
						<div class="form-group">
					    	<label for="status">Status</label>
							<select class="form-control" name="status">
								<option value="<?php print $this_agent['status']; ?>"><?php print $this_agent['status']; ?></option>
								<option value="0">---</option>
								<option value="Active">Active</option>
								<option value="Hold">Hold</option>
								<option value="Archive">Archive</option>
							</select>
						</div>
						<div class="form-group">
					    	<label for="ioid">IO ID</label>
							<input type="text" class="form-control" name="ioid" value="<?php print $this_agent['ioid']; ?>">
						</div>
						<div class="form-group">
					    	<label for="firstname">First name</label>
							<input type="text" class="form-control" name="firstname" value="<?php print $this_agent['firstname']; ?>">
						</div>
						<div class="form-group">
					    	<label for="lastname">Last name</label>
							<input type="text" class="form-control" name="lastname" value="<?php print $this_agent['lastname']; ?>">
						</div>
						<div class="form-group">
					    	<label for="middlename">Middle name</label>
							<input type="text" class="form-control" name="middlename" value="<?php print $this_agent['middlename']; ?>">
						</div>
						<div class="form-group">
					    	<label for="preferedname">Preferred name</label>
							<input type="text" class="form-control" name="preferedname" value="<?php print $this_agent['preferedname']; ?>">
						</div>
						<div class="form-group">
					    	<label for="company">Company</label>
							<input type="text" class="form-control" name="company" value="<?php print $this_agent['company']; ?>">
						</div>
						<div class="form-group">
					    	<label for="pronouns">Pronouns</label>
							<input type="text" class="form-control" name="pronouns" value="<?php print $this_agent['pronouns']; ?>">
						</div>
						<hr />
						<div class="form-group">
					    	<label for="personalemail">Personal e-mail</label>
							<input type="email" class="form-control" name="personalemail" value="<?php print $this_agent['personalemail']; ?>">
						</div>
						<div class="form-group">
					    	<label for="peachioemail">peachIO e-mail</label>
							<input type="email" class="form-control" name="peachioemail" value="<?php print $this_agent['peachioemail']; ?>">
						</div>
						<div class="form-group">
					    	<label for="address1">Address 1</label>
							<input type="text" class="form-control" name="address1" value="<?php print $this_agent['address1']; ?>">
						</div>
						<div class="form-group">
					    	<label for="address2">Address 2</label>
							<input type="text" class="form-control" name="address2" value="<?php print $this_agent['address2']; ?>">
						</div>
						<div class="form-group">
					    	<label for="city">City</label>
							<input type="text" class="form-control" name="city" value="<?php print $this_agent['city']; ?>">
						</div>
						<div class="form-group">
					    	<label for="state">State abbreviation</label>
							<input type="text" class="form-control" name="state" value="<?php print $this_agent['state']; ?>">
						</div>
						<div class="form-group">
					    	<label for="postcode">Postal code</label>
							<input type="text" class="form-control" name="postcode" value="<?php print $this_agent['postcode']; ?>">
						</div>
						<div class="form-group">
					    	<label for="country">Country</label>
							<input type="text" class="form-control" name="country" value="<?php print $this_agent['country']; ?>">
						</div>
						<div class="form-group">
					    	<label for="phone1">Phone 1</label>
							<input type="text" class="form-control" name="phone1" value="<?php print $this_agent['phone1']; ?>">
							<span id="helpBlock" class="help-block">+X (XXX) XXX-XXXX x. XX</span>
						</div>
						<div class="form-group">
					    	<label for="phone1_type">Phone 1 type</label>
							<input type="text" class="form-control" name="phone1_type" value="<?php print $this_agent['phone2_type']; ?>">
						</div>
						<div class="form-group">
					    	<label for="phone2">Phone 2</label>
							<input type="text" class="form-control" name="phone2" value="<?php print $this_agent['phone2']; ?>">
							<span id="helpBlock" class="help-block">+X (XXX) XXX-XXXX x. XX</span>
						</div>
						<div class="form-group">
					    	<label for="phone2_type">Phone 2 type</label>
							<input type="text" class="form-control" name="phone2_type" value="<?php print $this_agent['phone2_type']; ?>">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
					    	<label for="admin">Admin</label>
							<select class="form-control" name="admin">
								<?php if($this_agent['admin'] == 0){?>
								<option value="0">No</option>
								<option value="1">Yes</option>
								<?php } ?>
								<?php if($this_agent['admin'] == 1){?>
								<option value="1">Yes</option>
								<option value="0">No</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
					    	<label for="managerdirector">Manager/Director</label>
							<select class="form-control" name="managerdirector">
								<?php if($this_agent['managerdirector'] == 0){?>
								<option value="0">No</option>
								<option value="1">Yes</option>
								<?php } ?>
								<?php if($this_agent['managerdirector'] == 1){?>
								<option value="1">Yes</option>
								<option value="0">No</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
					    	<label for="type">Type</label>
							<select class="form-control" name="type">
								<option value="<?php print $this_agent['type']; ?>"><?php print $this_agent['type']; ?></option>
								<option value="0">---</option>
								<option value="Owner">Owner</option>
								<option value="Partner">Partner</option>
								<option value="Internal Associate">Internal Associate</option>
								<option value="External Associate">External Associate</option>
								<option value="Employee">Employee</option>
								<option value="Independant Contractor">Independent Contractor</option>
								<option value="Ambassador">Ambassador</option>
							</select>
						</div>
						<div class="form-group">
					    	<label for="title">Title</label>
							<input type="text" class="form-control" name="title" value="<?php print $this_agent['title']; ?>">
						</div>
						<hr />
						<div class="form-group">
					    	<label for="media_safe">Media</label>
							<input type="text" class="form-control" name="media_safe" value="<?php print implode(',', $this_agent['media_safe']); ?>">
							<span id="helpBlock" class="help-block">Media safe names, comma separated, no spaces</span>
						</div>
						<div class="form-group">
					    	<label for="projects_safe">Projects</label>
							<input type="text" class="form-control" name="projects_safe" value="<?php print implode(',', $this_agent['projects_safe']); ?>">
							<span id="helpBlock" class="help-block">Projects safe names, comma separated, no spaces</span>
						</div>
						<hr />
						<div class="form-group">
					    	<label for="quip">Quip</label>
							<input type="text" class="form-control" name="quip" value="<?php print $this_agent['quip']; ?>">
						</div>
						<div class="form-group">
					    	<label for="image">Image URL</label>
							<input type="text" class="form-control" name="image" value="<?php print $this_agent['image']; ?>">
							<span id="helpBlock" class="help-block">URL of asset.peachio.co/employee_photo</span>
						</div>
						<div class="form-group">
					    	<label for="license">License</label>
							<input type="text" class="form-control" name="license" value="<?php print $this_agent['license']; ?>">
						</div>
						<div class="form-group">
					    	<label for="license_state">License state</label>
							<input type="text" class="form-control" name="license_state" value="<?php print $this_agent['license_state']; ?>">
						</div>
						<div class="form-group">
					    	<label for="citizenship">Citizenship</label>
							<input type="text" class="form-control" name="citizenship" value="<?php print $this_agent['citizenship']; ?>">
						</div>
						<div class="form-group">
					    	<label for="ssn">SSN</label>
							<input type="text" class="form-control" name="ssn" value="<?php print $this_agent['ssn']; ?>">
						</div>
						<div class="form-group">
					    	<label for="dob">Date of birth</label>
							<input type="text" class="form-control" name="dob" value="<?php print $this_agent['dob']; ?>">
							<span id="helpBlock" class="help-block">MMDDYYYY</span>
						</div>
						<div class="form-group">
					    	<label for="startdate">Start date</label>
							<input type="text" class="form-control" name="startdate" value="<?php print $this_agent['startdate']; ?>">
							<span id="helpBlock" class="help-block">MMDDYYYY</span>
						</div>
						<div class="form-group">
					    	<label for="enddate">End date</label>
							<input type="text" class="form-control" name="enddate" value="<?php print $this_agent['enddate']; ?>">
							<span id="helpBlock" class="help-block">MMDDYYYY</span>
						</div>
						<div class="form-group">
					    	<label for="notes">Notes</label>
					    	<textarea class="form-control" rows="3" name="notes" value="<?php print $this_agent['notes']; ?>"></textarea>
						</div>
					</div>
			
			<div class="row" style="margin-bottom:20px;">
				<div class="col-lg-12">
					<button type="submit" class="btn btn-default">Update associate</button>
					</form>
				</div>
    		</div>
    		<?php } ?>
    		
    		<!-- NEW ASSOCIATE -->
    		<?php if(isset($added)){if($added == true){print '<h2>Associate added</h2>';}} ?>
			<?php if(isset($added)){if($added == false){print '<h2>There was an error</h2>';}} ?>
    		<?php if(isset($_GET['add'])){?>
				<form method="post" action="associates.php?new">
					<div class="col-lg-6">
						<div class="form-group">
					    	<label for="status">Status</label>
							<select class="form-control" name="status">
								<option value="Active">Active</option>
								<option value="Hold">Hold</option>
								<option value="Archive">Archive</option>
							</select>
						</div>
						<div class="form-group">
					    	<label for="ioid">IO ID</label>
							<input type="text" class="form-control" name="ioid" value="<?php print findnewioid($mysqli); ?>">
						</div>
						<div class="form-group">
					    	<label for="firstname">First name</label>
							<input type="text" class="form-control" name="firstname" placeholder="First name">
						</div>
						<div class="form-group">
					    	<label for="lastname">Last name</label>
							<input type="text" class="form-control" name="lastname" placeholder="Last name">
						</div>
						<div class="form-group">
					    	<label for="middlename">Middle name</label>
							<input type="text" class="form-control" name="middlename" placeholder="Middle name">
						</div>
						<div class="form-group">
					    	<label for="preferedname">Preferred name</label>
							<input type="text" class="form-control" name="preferedname" placeholder="Prefered name">
						</div>
						<div class="form-group">
					    	<label for="company">Company</label>
							<input type="text" class="form-control" name="company" placeholder="Company">
						</div>
						<div class="form-group">
					    	<label for="pronouns">Pronouns</label>
							<input type="text" class="form-control" name="pronouns" placeholder="Pronouns">
						</div>
						<hr />
						<div class="form-group">
					    	<label for="personalemail">Personal e-mail</label>
							<input type="email" class="form-control" name="personalemail" placeholder="Personal e-mail">
						</div>
						<div class="form-group">
					    	<label for="peachioemail">peachIO e-mail</label>
							<input type="email" class="form-control" name="peachioemail" placeholder="user@peachio.co">
						</div>
						<div class="form-group">
					    	<label for="address1">Address 1</label>
							<input type="text" class="form-control" name="address1" placeholder="Address 1">
						</div>
						<div class="form-group">
					    	<label for="address2">Address 2</label>
							<input type="text" class="form-control" name="address2" placeholder="Address 2">
						</div>
						<div class="form-group">
					    	<label for="city">City</label>
							<input type="text" class="form-control" name="city" placeholder="City">
						</div>
						<div class="form-group">
					    	<label for="state">State abbreviation</label>
							<input type="text" class="form-control" name="state" placeholder="State abbreviation">
						</div>
						<div class="form-group">
					    	<label for="postcode">Postal code</label>
							<input type="text" class="form-control" name="postcode" placeholder="Postal code">
						</div>
						<div class="form-group">
					    	<label for="country">Country</label>
							<input type="text" class="form-control" name="country" placeholder="Country">
						</div>
						<div class="form-group">
					    	<label for="phone1">Phone 1</label>
							<input type="text" class="form-control" name="phone1" placeholder="+X (XXX) XXX-XXXX x. XX">
						</div>
						<div class="form-group">
					    	<label for="phone1_type">Phone 1 type</label>
							<input type="text" class="form-control" name="phone1_type" placeholder="Phone 1 type">
						</div>
						<div class="form-group">
					    	<label for="phone2">Phone 2</label>
							<input type="text" class="form-control" name="phone2" placeholder="+X (XXX) XXX-XXXX x. XX">
						</div>
						<div class="form-group">
					    	<label for="phone2_type">Phone 2 type</label>
							<input type="text" class="form-control" name="phone2_type" placeholder="Phone 2 type">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
					    	<label for="admin">Admin</label>
							<select class="form-control" name="admin">
								<option value="0">No</option>
								<option value="1">Yes</option>
							</select>
						</div>
						<div class="form-group">
					    	<label for="managerdirector">Manager/Director</label>
							<select class="form-control" name="managerdirector">
								<option value="0">No</option>
								<option value="1">Yes</option>
							</select>
						</div>
						<div class="form-group">
					    	<label for="type">Type</label>
							<select class="form-control" name="type">
								<option value="Owner">Owner</option>
								<option value="Partner">Partner</option>
								<option value="Internal Associate">Internal Associate</option>
								<option value="External Associate">External Associate</option>
								<option value="Employee">Employee</option>
								<option value="Independant Contractor">Independent Contractor</option>
								<option value="Ambassador">Ambassador</option>
							</select>
						</div>
						<div class="form-group">
					    	<label for="title">Title</label>
							<input type="text" class="form-control" name="title" placeholder="Title">
						</div>
						<hr />
						<div class="form-group">
					    	<label for="media_safe">Media</label>
							<input type="text" class="form-control" name="media_safe" placeholder="Media">
							<span id="helpBlock" class="help-block">Media safe names, comma separated, no spaces</span>
						</div>
						<div class="form-group">
					    	<label for="projects_safe">Projects</label>
							<input type="text" class="form-control" name="projects_safe" placeholder="Projects">
							<span id="helpBlock" class="help-block">Projects safe names, comma separated, no spaces</span>
						</div>
						<hr />
						<div class="form-group">
					    	<label for="quip">Quip</label>
							<input type="text" class="form-control" name="quip" placeholder="Quip">
						</div>
						<div class="form-group">
					    	<label for="image">Image URL</label>
							<input type="text" class="form-control" name="image" placeholder="Image URL">
							<span id="helpBlock" class="help-block">URL of asset.peachio.co/employee_photo</span>
						</div>
						<div class="form-group">
					    	<label for="license">License</label>
							<input type="text" class="form-control" name="license" placeholder="License">
						</div>
						<div class="form-group">
					    	<label for="license_state">License state</label>
							<input type="text" class="form-control" name="license_state" placeholder="License state">
						</div>
						<div class="form-group">
					    	<label for="citizenship">Citizenship</label>
							<input type="text" class="form-control" name="citizenship" placeholder="Citizenship">
						</div>
						<div class="form-group">
					    	<label for="ssn">SSN</label>
							<input type="text" class="form-control" name="ssn" placeholder="SSN">
						</div>
						<div class="form-group">
					    	<label for="dob">Date of birth</label>
							<input type="text" class="form-control" name="dob" placeholder="MMDDYYYY">
						</div>
						<div class="form-group">
					    	<label for="startdate">Start date</label>
							<input type="text" class="form-control" name="startdate" placeholder="MMDDYYYY">
						</div>
						<div class="form-group">
					    	<label for="enddate">End date</label>
							<input type="text" class="form-control" name="enddate" placeholder="MMDDYYYY">
						</div>
						<div class="form-group">
					    	<label for="notes">Notes</label>
					    	<textarea class="form-control" rows="3" name="notes" placeholder="Notes"></textarea>
						</div>
					</div>
			
			<div class="row" style="margin-bottom:20px;">
				<div class="col-lg-12">
					<button type="submit" class="btn btn-default">Add associate</button>
					</form>
				</div>
    		</div>
    		<?php } ?>
    		
		</div>
		
    </div>
    
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#associates').DataTable();
});
</script>

<?php include_once('../../include/footer.php'); ?>
