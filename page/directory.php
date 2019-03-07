<?php
require_once('../include/header.php');
require_once('../include/sidebar.php');
require_once('../auth/fn.php');
require_once('../auth/go_connect.php');
$associates = getAssociates($mysqli);
$groups = getGroup('all', $mysqli);
$projects = getProjects($mysqli);
$media = getMedia($mysqli);
?>
<style type="text/css">
i.fa{
	margin-right:10px;
}	
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Directory</h1>
        </div>
    </div>
    <div class="row">
	    <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<ul class="nav nav-tabs nav-justified">
						  <li role="presentation" class="active" id="associates-item"><a href="#" onclick="showAssociates()">associates</a></li>
						  <li role="presentation" id="groups-item"><a href="#" onclick="showGroups()">Google Groups</a></li>
						  <li role="presentation" id="projects-item"><a href="#" onclick="showProjects()">Projects</a></li>
						  <li role="presentation" id="projects-item"><a href="#" onclick="showMedia()">Media</a></li>
						</ul>
					</h3>
  				</div>
  				<div class="panel-body" id="associates-body">
  					<div class="well">Associates include any entity or individual who does work and has entered an agreement with peachIO. By themselves, associates are typically unpaid but possibly compensated volunteers of peachIO. associates could however be anyone working with peachIO who is not an Owner or Partner. Therefore, Employees, Independent Contractors, and Associates  are automatically associates.</div>
  					<p><table id="associates" class="display" cellspacing="0" width="100%">
	  					<thead>
		  					<tr>
			  					<th>Name</th>
			  					<th>Company</th>
			  					<th>Titles</th>
			  					<th>Pronouns</th>
			  					<th>E-mail</th>
			  					<th>Phone</th>
			  					<th>Type</th>
			  					<th>Manager/Director</th>
			  				</tr>
			  			</thead>
			  			<tfoot>
				  			<tr>
					  			<th>Name</th>
			  					<th>Company</th>
			  					<th>Titles</th>
			  					<th>Pronouns</th>
			  					<th>E-mail</th>
			  					<th>Phone</th>
			  					<th>Type</th>
			  					<th>Manager/Director</th>
					  		</tr>
					  	</tfoot>
					  	<tbody>
						  	<?php foreach($associates as $a) { ?>
						  	<tr>
							  	<td><?php print ucfirst($a['preferedname']).' '.ucfirst($a['lastname']); ?></td>
							  	<td><?php print $a['company']; ?></td>
							  	<td><?php print $a['title']; ?></td>
							  	<td><?php print $a['pronouns']; ?></td>
							  	<td><?php print $a['peachioemail']; ?></td>
							  	<td><?php print $a['phone1']; ?> - <?php print $a['phone1_type']; ?>
								  		<?php if(isset($a['phone2'])){ ?>
								  			<br /><?php print $a['phone2']; ?> - <?php print $a['phone2_type']; ?>
								  		<?php } ?>
							  	</td>
							  	<td><?php print $a['type']; ?></td>
							  	<td><?php if($a['managerdirector'] == 1){print 'Yes';}else{print 'No';} ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table></p>
  				</div>
  				<div class="panel-body" id="groups-body">
  					<div class="well">Groups are used within peachIO to better organize members, users, and employees. Groups can be used for communication, permissions, and more. For example, everyone in the "peachIO - Administration" group gets all e-mails sent to admin@peachio.co as well as having permissions to administrative documents.</div>
  					<p><table id="groups" class="display" cellspacing="0" width="100%">
	  					<thead>
		  					<tr>
			  					<th>Name</th>
			  					<th>Address</th>
			  					<th>Notes</th>
			  				</tr>
			  			</thead>
			  			<tfoot>
				  			<tr>
					  			<th>Name</th>
			  					<th>Address</th>
			  					<th>Notes</th>
					  		</tr>
					  	</tfoot>
					  	<tbody>
						  	<?php foreach($groups as $b) { ?>
						  	<tr>
							  	<td><?php print $b['name']; ?></td>
							  	<td><?php print $b['address']; ?></td>
							  	<td><?php print $b['notes']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table></p>
  				</div>
  				<div class="panel-body" id="projects-body">
  					<div class="well">Brands can be reliant on the peachIO division under which they fall and will usually fit into an operational “template” to help deliver them efficiently while maintaining their integrity and individuality. Brands do not have to be separate companies and can be organized within/by peachIO. Brands can and usually are managed in bulk (i.e., podcasts, YouTubers, artists). Brands have an internal Ambassador who reports to a Brand Manager. Brands can have internal and external associates who are managed by the Ambassador and all (including the Ambassador) must sign an agreement with peachIO.</div>
  					<p><table id="projects" class="display" cellspacing="0" width="100%">
	  					<thead>
		  					<tr>
			  					<th>ID</th>
			  					<th>Name</th>
			  					<th>Description</th>
			  					<th>Type</th>
			  					<th>Branch</th>
			  					<th>Sub-Branch</th>
			  					<th>Status</th>
			  					<th>Manager</th>
			  					<th></th>
			  				</tr>
			  			</thead>
			  			<tfoot>
				  			<tr>
					  			<th>ID</th>
			  					<th>Name</th>
			  					<th>Description</th>
			  					<th>Type</th>
			  					<th>Branch</th>
			  					<th>Sub-Branch</th>
			  					<th>Status</th>
			  					<th>Manager</th>
			  					<th></th>
					  		</tr>
					  	</tfoot>
					  	<tbody>
						  	<?php foreach($projects as $p) { ?>
						  	<tr>
							  	<td><?php print $p['pid']; ?></td>
							  	<td><?php print $p['name']; ?> (<?php print $p['name_safe']; ?>)</td>
							  	<td><?php print $p['description']; ?></td>
							  	<td><?php print ucfirst($p['type']); ?></td>
							  	<td><?php print ucfirst($p['branch']); ?></td>
							  	<td><?php print ucfirst($p['sub_branch']); ?></td>
							  	<td><?php print ucfirst($p['status']); ?></td>
								<td><?php 
									foreach($associates as $a){
										if($a['ioid'] == $p['manager_ioid']){
											print ucfirst($a['preferedname']).' '.ucfirst($a['lastname']);
										}
									}
								?></td>
							  	<td>
								  	<a href="<?php print $p['website']; ?>"><i class="fa fa-globe"></i></a> 
								  	<a href="<?php print '//facebook.com/'.$p['facebook']; ?>"><i class="fa fa-facebook"></i></a> 
								  	<a href="<?php print '//twitter.com/'.$p['twitter']; ?>"><i class="fa fa-twitter"></i></a> 
								  	<a href="<?php print '//instagram.com/'.$p['instagram']; ?>"><i class="fa fa-instagram"></i></a> 
							  	</td>
							</tr>
							<?php } ?>
						</tbody>
					</table></p>
  				</div>
  				<div class="panel-body" id="media-body">
  					<div class="well">Associates include any entity or individual who does work and has entered an agreement with peachIO. By themselves, associates are typically unpaid but possibly compensated volunteers of peachIO. associates could however be anyone working with peachIO who is not an Owner or Partner. Therefore, Employees, Independent Contractors, and Associates  are automatically associates.</div>
  					<p><table id="media" class="display" cellspacing="0" width="100%">
	  					<thead>
		  					<tr>
			  					<th>ID</th>
			  					<th>Name</th>
			  					<th>Description</th>
			  					<th>Type</th>
			  					<th>Branch</th>
			  					<th>Sub-Branch</th>
			  					<th>Status</th>
			  					<th>Ambassador</th>
			  					<th>Manager</th>
			  					<th></th>
			  				</tr>
			  			</thead>
			  			<tfoot>
				  			<tr>
					  			<th>ID</th>
			  					<th>Name</th>
			  					<th>Description</th>
			  					<th>Type</th>
			  					<th>Branch</th>
			  					<th>Sub-Branch</th>
			  					<th>Status</th>
			  					<th>Ambassador</th>
			  					<th>Manager</th>
			  					<th></th>
					  		</tr>
					  	</tfoot>
					  	<tbody>
						  	<?php foreach($media as $m) { ?>
						  	<tr>
							  	<td><?php print $m['mid']; ?></td>
							  	<td><?php print $m['name']; ?> (<?php print $m['name_safe']; ?>)</td>
							  	<td><?php print $m['description']; ?></td>
							  	<td><?php print ucfirst($m['type']); ?></td>
							  	<td><?php print ucfirst($m['branch']); ?></td>
							  	<td><?php print $m['sub_branch']; ?></td>
							  	<td><?php print ucfirst($m['status']); ?></td>
								<td><?php 
									foreach($associates as $a){
										if($a['ioid'] == $m['manager_ioid']){
											print ucfirst($a['preferedname']).' '.ucfirst($a['lastname']);
										}
									}
								?></td>
								<td><?php 
									foreach($associates as $a){
										if($a['ioid'] == $m['ambassador_ioid']){
											print ucfirst($a['preferedname']).' '.ucfirst($a['lastname']);
										}
									}
								?></td>
							  	<td>
								  	<a href="<?php print $m['website']; ?>"><i class="fa fa-globe"></i></a> 
								  	<a href="<?php print '//facebook.com/'.$m['facebook']; ?>"><i class="fa fa-facebook"></i></a> 
								  	<a href="<?php print '//twitter.com/'.$m['twitter']; ?>"><i class="fa fa-twitter"></i></a> 
								  	<a href="<?php print '//instagram.com/'.$m['instagram']; ?>"><i class="fa fa-instagram"></i></a> 
							  	</td>
							</tr>
							<?php } ?>
						</tbody>
					</table></p>
  				</div>
			</div>
	    </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$('#groups-body').hide();
	$('#projects-body').hide();
	$('#media-body').hide();
    $(document).ready(function(){
	    $('#associates').DataTable();
	});
	$(document).ready(function(){
	    $('#groups').DataTable();
	});
	$(document).ready(function(){
	    $('#projects').DataTable();
	});
	$(document).ready(function(){
	    $('#media').DataTable();
	});
});
function showAssociates(){
	$('#groups-body').hide();
	$('#projects-body').hide();
	$('#media-body').hide();
	$('#associates-body').show();
	$('#associates-item').addClass('active');
	$('#groups-item').removeClass('active');
	$('#projects-item').removeClass('active');
	$('#media-item').removeClass('active');
}
function showGroups(){
	$('#associates-body').hide();
	$('#projects-body').hide();
	$('#media-body').hide();
	$('#groups-body').show();
	$('#associates-item').removeClass('active');
	$('#projects-item').removeClass('active');
	$('#groups-item').addClass('active');
	$('#media-item').removeClass('active');
}
function showProjects(){
	$('#associates-body').hide();
	$('#groups-body').hide();
	$('#media-body').hide();
	$('#projects-body').show();
	$('#associates-item').removeClass('active');
	$('#groups-item').removeClass('active');
	$('#projects-item').addClass('active');
	$('#media-item').removeClass('active');
}
function showMedia(){
	$('#associates-body').hide();
	$('#groups-body').hide();
	$('#media-body').show();
	$('#projects-body').hide();
	$('#associates-item').removeClass('active');
	$('#groups-item').removeClass('active');
	$('#media-item').addClass('active');
	$('#projects-item').removeClass('active');
}
</script>

<?php include_once('../include/footer.php'); ?>
