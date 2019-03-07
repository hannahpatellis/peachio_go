<?php
require_once('../../include/header.php');
require_once('../../include/sidebar.php');
require_once('../../auth/go_connect.php');

$newLeads = array();
$openLeads = array();
$archiveLeads = array();

if($stmt = $mysqli->prepare("SELECT lead_id, status_read, status_open, status_archive, date_income, contact_lastname, contact_firstname, proj_type, content_title, agent, date_archive, creator_id FROM ic_leads")) {
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($lead_id, $status_read, $status_open, $status_archive, $date_income, $lastname, $firstname, $content_type, $content_name, $agent, $date_archive, $creator_id);
	
	while($stmt->fetch()){
		if($status_open == '0'){
			$newLeads[] = [
				"status_read" => $status_read,
			    "lead_id" => $lead_id,
			    "date_income" => $date_income,
			    "name" => $firstname.' '.$lastname,
			    "content_type" => $content_type,
			];
		}
		if($status_open == '1'){
			$openLeads[] = [
			    "lead_id" => $lead_id,
			    "date_income" => $date_income,
			    "name" => $firstname.' '.$lastname,
			    "content_type" => $content_type,
			    "content_name" => $content_name,
			    "agent" => $agent,
			];
		}
		if($status_archive == '1'){
			$archiveLeads[] = [
			    "lead_id" => $lead_id,
			    "date_income" => $date_income,
			    "date_archive" => $date_archive,
			    "content_type" => $content_type,
			    "content_name" => $content_name,
			    "creator_id" => $creator_id,
			    "agent" => $agent,
			];
		}
	}
	$stmt->close();
}
?>
	
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Indiecast Leads</h1>
        </div>
    </div>
    <div class="row">
	    <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<ul class="nav nav-tabs nav-justified">
						  <li role="presentation" class="active" id="new-item"><a href="#" onclick="showNew()">New leads</a></li>
						  <li role="presentation" id="open-item"><a href="#" onclick="showOpen()">Open leads</a></li>
						  <li role="presentation" id="archived-item"><a href="#" onclick="showArchived()">Archived leads</a></li>
						</ul>
					</h3>
  				</div>
  				<div class="panel-body" id="new-body">
  					<div class="well">These leads are new and have not been marked "Open" by being assigned an Indiecast Creator Agent</div>
  					<p><table id="new" class="display" cellspacing="0" width="100%">
	  					<thead>
		  					<tr>
			  					<th></th>
			  					<th>Lead ID</th>
			  					<th>Income date</th>
			  					<th>Applicant name</th>
			  					<th>Content type</th>
			  					<th></th>
			  				</tr>
			  			</thead>
			  			<tfoot>
				  			<tr>
					  			<th></th>
					  			<th>Lead ID</th>
			  					<th>Income date</th>
			  					<th>Applicant name</th>
			  					<th>Content type</th>
			  					<th></th>
					  		</tr>
					  	</tfoot>
					  	<tbody>
						  	<?php foreach($newLeads as $x) { ?>
						  	<tr>
							  	<td><?php if($x['status_read'] == 0){print '<i class="fa fa-certificate">';} ?></td>
							  	<td><?php print $x['lead_id']; ?></td>
							  	<td><?php print $x['date_income']; ?></td>
							  	<td><?php print $x['name']; ?></td>
							  	<td><?php print $x['content_type']; ?></td>
							  	<td><a href="lead.php?lead_id=<?php print $x['lead_id'] ?>"><i class="fa fa-external-link-square"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table></p>
  				</div>
  				<div class="panel-body" id="open-body">
  					<div class="well">These leads are open and have been assigned an Indiecast Creator Agent</div>
  					<p><table id="open" class="display" cellspacing="0" width="100%">
	  					<thead>
		  					<tr>
			  					<th>Lead ID</th>
			  					<th>Content name</th>
			  					<th>Content type</th>
			  					<th>Contact name</th>
			  					<th>Agent</th>
			  					<th>Income date</th>
			  					<th></th>
			  				</tr>
			  			</thead>
			  			<tfoot>
				  			<tr>
					  			<th>Lead ID</th>
			  					<th>Content name</th>
			  					<th>Content type</th>
			  					<th>Contact name</th>
			  					<th>Agent</th>
			  					<th>Income date</th>
			  					<th></th>
					  		</tr>
					  	</tfoot>
					  	<tbody>
						  	<?php foreach($openLeads as $x) { ?>
						  	<tr>
							  	<td><?php print $x['lead_id']; ?></td>
							  	<td><?php print $x['content_name']; ?></td>
							  	<td><?php print $x['content_type']; ?></td>
							  	<td><?php print $x['name']; ?></td>
							  	<td><?php print $x['agent']; ?></td>
							  	<td><?php print $x['date_income']; ?></td>
							  	<td><a href="lead.php?lead_id=<?php print $x['lead_id'] ?>"><i class="fa fa-external-link-square"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table></p>
  				</div>
  				<div class="panel-body" id="archived-body">
  					<div class="well">These leads have been archived. Archived cases have been marked closed or converted into a Creator file</div>
  					<p><table id="archived" class="display" cellspacing="0" width="100%">
	  					<thead>
		  					<tr>
			  					<th>Lead ID</th>
			  					<th>Income date</th>
			  					<th>Content name</th>
			  					<th>Content type</th>
			  					<th>Creator name</th>
			  					<th>Agent</th>
			  					<th>Archive date</th>
			  					<th></th>
			  				</tr>
			  			</thead>
			  			<tfoot>
				  			<tr>
					  			<th>Lead ID</th>
			  					<th>Income date</th>
			  					<th>Content name</th>
			  					<th>Content type</th>
			  					<th>Creator name</th>
			  					<th>Agent</th>
			  					<th>Archive date</th>
			  					<th></th>
					  		</tr>
					  	</tfoot>
					  	<tbody>
						  	<?php foreach($archiveLeads as $x) { ?>
						  	<tr>
							  	<td><?php print $x['lead_id']; ?></td>
							  	<td><?php print $x['date_income']; ?></td>
							  	<td><?php print $x['content_name']; ?></td>
							  	<td><?php print $x['content_type']; ?></td>
							  	<td><?php print $x['creator_id']; ?></td>
							  	<td><?php print $x['agent']; ?></td>
							  	<td><?php print $x['date_archive']; ?></td>
							  	<td><a href="lead.php?lead_id=<?php print $x['lead_id'] ?>"><i class="fa fa-external-link-square"></i></a></td>
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
	$('#archived-body').hide();
	$('#open-body').hide();
    $(document).ready(function(){
	    $('#new').DataTable();
	});
	$(document).ready(function(){
	    $('#open').DataTable();
	});
	$(document).ready(function(){
	    $('#archived').DataTable();
	});
});
function showNew(){
	$('#archived-body').hide();
	$('#open-body').hide();
	$('#new-body').show();
	$('#new-item').addClass('active');
	$('#open-item').removeClass('active');
	$('#archived-item').removeClass('active');
}
function showOpen(){
	$('#archived-body').hide();
	$('#new-body').hide();
	$('#open-body').show();
	$('#open-item').addClass('active');
	$('#new-item').removeClass('active');
	$('#archived-item').removeClass('active');
}
function showArchived(){
	$('#open-body').hide();
	$('#new-body').hide();
	$('#archived-body').show();
	$('#archived-item').addClass('active');
	$('#open-item').removeClass('active');
	$('#new-item').removeClass('active');
}
</script>

<?php include_once('../../include/footer.php'); ?>
