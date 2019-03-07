<?php
require_once('../../include/header.php');
require_once('../../include/sidebar.php');
require_once('../../auth/fn.php');
require_once('../../auth/go_connect.php');
$associates = getAssociates($mysqli);
$users = getAllUsers($mysqli);
$users_count = 0;
foreach($users as $x){$users_count++;}
$modules = getPortalMods($mysqli);

if(isset($_GET['update'])){
	if(strlen($_POST['password1'] >= 1)){
		if($_POST['password1'] == $_POST['password2']){
			$modules = '';
			$password = password_hash($_POST['password1'], PASSWORD_BCRYPT);
			foreach($_POST['module'] as $y){
				$modules = $modules .= $y.',';
			}
			$modules = rtrim($modules, ",");
			$modules = trim($modules, "Array");
			$update = "UPDATE `users` SET `userid` = '".$_POST['userid']."', `name` = '".$_POST['name']."', `username` = '".$_POST['username']."', `password` = '".$password."', `domain` = '".$_POST['domain']."', `email` = '".$_POST['email']."', `admin` = '".$_POST['admin']."', `managerdirector` = '".$_POST['managerdirector']."', `modules` = '".$modules."' WHERE `users`.`userid` = ".$_POST['userid'];
			unset($_POST);
			if($stmt = $mysqli->prepare($update)) {
				$stmt->execute();
				$stmt->close();
				$updated = true;
			}
		}
		else{
			unset($_POST);
			$updated = false;
		}
	}
	if(strlen($_POST['password1'] < 1)){
		$modules = '';
		foreach($_POST['module'] as $y){
			$modules = $modules .= $y.',';
		}
		$modules = rtrim($modules, ",");
		$modules = trim($modules, "Array");
		$update = "UPDATE `users` SET `userid` = '".$_POST['userid']."', `name` = '".$_POST['name']."', `username` = '".$_POST['username']."', `domain` = '".$_POST['domain']."', `email` = '".$_POST['email']."', `admin` = '".$_POST['admin']."', `managerdirector` = '".$_POST['managerdirector']."', `modules` = '".$modules."' WHERE `users`.`userid` = ".$_POST['userid'];
		unset($_POST);
		if($stmt = $mysqli->prepare($update)) {
			$stmt->execute();
			$stmt->close();
			$updated = true;
		}
		else{
			unset($_POST);
			$updated = false;
		}
	}
}
if(isset($_GET['add'])){
	if($_POST['password1'] == $_POST['password2']){
		$modules = '';
		$password = password_hash($_POST['password1'], PASSWORD_BCRYPT);
		foreach($_POST['module'] as $y){
			$modules = $modules .= $y.',';
		}
		$modules = rtrim($modules, ",");
		$modules = trim($modules, "Array");
		$new = "INSERT INTO `users` (`userid`, `ioid`, `name`, `username`, `password`, `domain`, `email`, `admin`, `managerdirector`, `modules`) VALUES ('".$_POST['userid']."', '".$_POST['ioid']."', '".$_POST['name']."', '".strtolower($_POST['username'])."', '".$password."', '".strtolower($_POST['domain'])."', '".strtolower($_POST['email'])."', '".$_POST['admin']."', '".$_POST['managerdirector']."', '".$modules."')";
		unset($_POST);
		if($stmt = $mysqli->prepare($new)) {
			$stmt->execute();
			$stmt->close();
			$added = true;
		}
	}
	else{
		unset($_POST);
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
            <h1 class="page-header"><?php print $users_count; ?> users</h1>
        </div>
    </div>
    
    <div class="row">
		<div class="col-lg-6">
			<div class="well">
				Users have access to the peachIO Portal system.
				<hr />
				<center>
					<a href="users.php?new"><button type="button" class="btn btn-default">Add a User</button></a>
				</center>
			</div>
			<br />
			<div>
				<p><table id="users" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>IO ID</th>
	  					<th>Name</th>
	  					<th>Username</th>
	  					<th>Domain</th>
	  					<th>E-mail</th>
	  					<th>M/A</th>
	  					<th></th>
	  				</tr>
	  			</thead>
	  			<tfoot>
		  			<tr>
			  			<th>IO ID</th>
	  					<th>Name</th>
	  					<th>Username</th>
	  					<th>Domain</th>
	  					<th>E-mail</th>
	  					<th>M/A</th>
	  					<th></th>
			  		</tr>
			  	</tfoot>
			  	<tbody>
				  	<?php foreach($users as $u) { ?>
				  	<tr>
					  	<td><?php print $u['ioid']; ?></td>
					  	<td><?php print $u['name']; ?></td>
					  	<td><?php print $u['username']; ?></td>
					  	<td><?php print $u['domain']; ?></td>
					  	<td><?php print $u['email']; ?></td>
					  	<td><?php if($u['managerdirector'] == 1){print 'Yes';}else{print 'No';} ?> / <?php if($u['admin'] == 1){print 'Yes';}else{print 'No';} ?></td>
					  	<td>
						  	<a href="users.php?edit=<?php print $u['userid']; ?>"><i class="fa fa-external-link-square"></i></a>
						  	<a href="associates.php?edit=<?php print $u['ioid']; ?>"><i class="fa fa-user"></i></a> 
					  	</td>
					</tr>
					<?php } ?>
				</tbody>
			</table></p>	
			</div>
		</div>
			
		<!-- UPDATE User -->
		<div class="col-lg-6">
			<?php if(isset($updated)){if($updated == true){print '<h2>User updated</h2>';}} ?>
			<?php if(isset($updated)){if($updated == false){print '<h2>There was an error</h2>';}} ?>
			<?php if(isset($_GET['edit'])){
				foreach($users as $u){
					if($_GET['edit'] == $u['userid']){
						$this_user = $u;}} ?>
				<form method="post" action="users.php?update=<?php print $this_user['userid']; ?>">
					<div class="col-lg-6">
						<div class="form-group">
					    	<label for="userid">User ID</label>
							<input type="text" class="form-control" name="userid" value="<?php print $this_user['userid']; ?>">
						</div>
						<hr />
						<div class="form-group">
					    	<label for="name">Name</label>
							<input type="text" class="form-control" name="name" value="<?php print $this_user['name']; ?>">
						</div>
						<div class="form-group">
					    	<label for="email">E-mail</label>
							<input type="text" class="form-control" name="email" value="<?php print $this_user['email']; ?>">
						</div>
						<div class="form-group">
					    	<label for="username">Username</label>
							<input type="text" class="form-control" name="username" value="<?php print $this_user['username']; ?>">
						</div>
						<div class="form-group">
					    	<label for="domain">Domain</label>
							<input type="text" class="form-control" name="domain" value="<?php print $this_user['domain']; ?>">
						</div>
						<div class="form-group">
					    	<label for="admin">Admin</label>
							<select class="form-control" name="admin">
								<?php if($this_user['admin'] == 0){?>
								<option value="0">No</option>
								<option value="1">Yes</option>
								<?php } ?>
								<?php if($this_user['admin'] == 1){?>
								<option value="1">Yes</option>
								<option value="0">No</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
					    	<label for="managerdirector">Manager/Director</label>
							<select class="form-control" name="managerdirector">
								<?php if($this_user['managerdirector'] == 0){?>
								<option value="0">No</option>
								<option value="1">Yes</option>
								<?php } ?>
								<?php if($this_user['managerdirector'] == 1){?>
								<option value="1">Yes</option>
								<option value="0">No</option>
								<?php } ?>
							</select>
						</div>
						<hr />
						<div class="form-group">
					    	<label for="password1">Password</label>
							<input type="password" class="form-control" name="password1" placeholder="">
						</div>
						<div class="form-group">
					    	<label for="password2">Password (again)</label>
							<input type="password" class="form-control" name="password2" placeholder="">
						</div>
					</div>
					<div class="col-lg-6">
						<?php foreach($modules as $m){
							if($m['haschildren'] == 1){ ?>
								<div style="margin-bottom:20px;"><div class="checkbox">
								  <label>
								    <input type="checkbox" name="module['<?php print $m['modid']; ?>']" value="<?php print $m['modid']; ?>">
								    <?php print $m['friendly']; ?>
								  </label>
								</div>
								<?php foreach($modules as $x){
									if($x['parent'] == $m['portal_access_name']){ ?>
										<div class="checkbox" style="margin-left:20px;">
										  <label>
										    <input type="checkbox" name="module['<?php print $x['modid']; ?>']" value="<?php print $x['modid']; ?>">
										    <?php print $x['friendly']; ?>
										  </label>
										</div>
									<?php }
								} ?>
								</div>
							<?php } ?>
							<?php if($m['haschildren'] == 0 && $m['parent'] == 'top'){ ?>
								<div class="checkbox" style="margin-bottom:20px;">
								  <label>
								    <input type="checkbox" name="module['<?php print $m['modid']; ?>']" value="<?php print $m['modid']; ?>">
								    <?php print $m['friendly']; ?>
								  </label>
								</div>
							<?php }
						} ?>
					</div>
			
			<div class="row" style="margin-bottom:20px;">
				<div class="col-lg-12">
					<button type="submit" class="btn btn-default">Update user</button>
					</form>
				</div>
    		</div>
    		<?php } ?>
    		
    		<!-- NEW ASSOCIATE -->
    		<?php if(isset($added)){if($added == true){print '<h2>User added</h2>';}} ?>
			<?php if(isset($added)){if($added == false){print '<h2>There was an error</h2>';}} ?>
			<?php if(isset($_GET['new'])){ ?>
				<form method="post" action="users.php?add=<?php print findnewuserid($mysqli); ?>">
					<div class="col-lg-6">
						<div class="form-group">
					    	<label for="userid">User ID</label>
							<input type="text" class="form-control" name="userid" value="<?php print findnewuserid($mysqli); ?>">
						</div>
						<hr />
						<div class="form-group">
					    	<label for="ioid">Bind to associate</label>
							<select class="form-control" name="ioid">
								<?php foreach($associates as $a){?>
									<option value="<?php print $a['ioid']; ?>"><?php print ucfirst($a['preferedname']).' '.ucfirst($a['lastname']); ?></option>
								<?php } ?>
							</select>
						</div>
						<hr />
						<div class="form-group">
					    	<label for="name">Name</label>
							<input type="text" class="form-control" name="name" placeholder="Name">
						</div>
						<div class="form-group">
					    	<label for="email">E-mail</label>
							<input type="text" class="form-control" name="email" placeholder="E-mail">
						</div>
						<div class="form-group">
					    	<label for="username">Username</label>
							<input type="text" class="form-control" name="username" placeholder="Username">
						</div>
						<div class="form-group">
					    	<label for="domain">Domain</label>
							<input type="text" class="form-control" name="domain" placeholder="Domain">
						</div>
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
						<hr />
						<div class="form-group">
					    	<label for="password1">Password</label>
							<input type="password" class="form-control" name="password1" placeholder="">
						</div>
						<div class="form-group">
					    	<label for="password2">Password (again)</label>
							<input type="password" class="form-control" name="password2" placeholder="">
						</div>
					</div>
					<div class="col-lg-6">
						<?php foreach($modules as $m){
							if($m['haschildren'] == 1){ ?>
								<div style="margin-bottom:20px;"><div class="checkbox">
								  <label>
								    <input type="checkbox" name="module['<?php print $m['modid']; ?>']" value="<?php print $m['modid']; ?>">
								    <?php print $m['friendly']; ?>
								  </label>
								</div>
								<?php foreach($modules as $x){
									if($x['parent'] == $m['portal_access_name']){ ?>
										<div class="checkbox" style="margin-left:20px;">
										  <label>
										    <input type="checkbox" name="module['<?php print $x['modid']; ?>']" value="<?php print $x['modid']; ?>">
										    <?php print $x['friendly']; ?>
										  </label>
										</div>
									<?php }
								} ?>
								</div>
							<?php } ?>
							<?php if($m['haschildren'] == 0 && $m['parent'] == 'top'){ ?>
								<div class="checkbox" style="margin-bottom:20px;">
								  <label>
								    <input type="checkbox" name="module['<?php print $m['modid']; ?>']" value="<?php print $m['modid']; ?>">
								    <?php print $m['friendly']; ?>
								  </label>
								</div>
							<?php }
						} ?>
					</div>
			
			<div class="row" style="margin-bottom:20px;">
				<div class="col-lg-12">
					<button type="submit" class="btn btn-default">Add user</button>
					</form>
				</div>
    		</div>
    		<?php } ?>
    		
		</div>
		
    </div>
    
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#users').DataTable();
});
</script>

<?php include_once('../../include/footer.php'); ?>
