<?php
require_once('../../include/header.php');
require_once('../../include/sidebar.php');
require_once('../../auth/go_connect.php');

// Load the Lead by ID selectivly
$lead = array();
if($stmt = $mysqli->prepare("SELECT lead_id, status_read, status_open, status_archive, date_income, date_open, date_lastcontact, date_archive, agent, process FROM ic_leads WHERE lead_id = (?)")) {
	$stmt->bind_param('s', $_GET['lead_id']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($lead_id, $status_read, $status_open, $status_archive, $date_income, $date_open, $date_lastcontact, $date_archive, $agent, $process);
	
	while($stmt->fetch()){
		$lead = [
			'lead_id' => $lead_id,
			'status_read' => $status_read,
			'status_open' => $status_open,
			'status_archive' => $status_archive,
			'date_income' => $date_income,
			'date_open' => $date_open,
			'date_lastcontact' => $date_lastcontact,
			'date_archive' => $date_archive,
			'agent' => $agent,
			'process' => $process
		];
	}
	$stmt->close();
}

// If changes, update with changes
if(isset($_POST['firstname'])){
	if(isset($_POST['stages'])){$lead_process = json_encode($_POST['stages']);}
	$update = "UPDATE `ic_leads` SET `status_read` = '1', `date_lastcontact` = '".date('M j, y')."', `agent` = '".mysqli_real_escape_string($mysqli, $_POST['agent'])."', `contact_firstname` = '".mysqli_real_escape_string($mysqli, $_POST['firstname'])."', `contact_lastname` = '".mysqli_real_escape_string($mysqli, $_POST['lastname'])."', `contact_position` = '".mysqli_real_escape_string($mysqli, $_POST['position'])."', `contact_company` = '".mysqli_real_escape_string($mysqli, $_POST['company'])."', `contact_email` = '".mysqli_real_escape_string($mysqli, $_POST['email'])."', `contact_phone` = '".mysqli_real_escape_string($mysqli, $_POST['phone'])."', `contact_phonealt` = '".mysqli_real_escape_string($mysqli, $_POST['phonealt'])."', `contact_address` = '".mysqli_real_escape_string($mysqli, $_POST['mail_address'])."', `contact_state` = '".mysqli_real_escape_string($mysqli, $_POST['mail_state'])."', `contact_code` = '".mysqli_real_escape_string($mysqli, $_POST['mail_code'])."', `contact_country` = '".mysqli_real_escape_string($mysqli, $_POST['mail_country'])."', `app_content` = '".mysqli_real_escape_string($mysqli, $_POST['content'])."', `app_assistance` = '".mysqli_real_escape_string($mysqli, $_POST['assistance'])."', `app_goals` = '".mysqli_real_escape_string($mysqli, $_POST['goals'])."', `app_samples` = '".mysqli_real_escape_string($mysqli, $_POST['samples'])."', `proj_type` = '".mysqli_real_escape_string($mysqli, $_POST['type'])."', `proj_synopsis` = '".mysqli_real_escape_string($mysqli, $_POST['synopsis'])."', `proj_submissions` = '".mysqli_real_escape_string($mysqli, $_POST['submissions'])."', `proj_screened` = '".mysqli_real_escape_string($mysqli, $_POST['screened'])."', `proj_goals` = '".mysqli_real_escape_string($mysqli, $_POST['goals'])."', `content_title` = '".mysqli_real_escape_string($mysqli, $_POST['final_title'])."', `content_duration` = '".mysqli_real_escape_string($mysqli, $_POST['final_duration'])."', `content_year` = '".mysqli_real_escape_string($mysqli, $_POST['final_year'])."', `content_genre` = '".mysqli_real_escape_string($mysqli, $_POST['final_genre'])."', `content_keycast` = '".mysqli_real_escape_string($mysqli, $_POST['final_keycast'])."', `content_keycrew` = '".mysqli_real_escape_string($mysqli, $_POST['final_keycrew'])."', `content_writer` = '".mysqli_real_escape_string($mysqli, $_POST['final_writer'])."', `content_adtl` = '".mysqli_real_escape_string($mysqli, $_POST['final_adtl'])."', `notes` = '".mysqli_real_escape_string($mysqli, $_POST['notes'])."', `process` = '".mysqli_real_escape_string($mysqli, $lead_process)."' WHERE `ic_leads`.`lead_id` = ".$_GET['lead_id'];
	if($stmt = $mysqli->prepare($update)) {
		$stmt->execute();
		$stmt->close();
		$updated = true;
	}
	else{
		$updated = false;
	}
}

// If Open is clicked, change to open
if(isset($_GET['open']) && $_GET['open'] == true){
	$update = "UPDATE `ic_leads` SET `status_read` = '1', `status_open` = '1', `status_archive` = '0', `date_open` = '".date('M j, y')."', `date_lastcontact` = '".date('M j, y')."' WHERE `ic_leads`.`lead_id` = ".$_GET['lead_id'];
	if($stmt = $mysqli->prepare($update)) {
		$stmt->execute();
		$stmt->close();
		$updated = true;
	}
	else{
		$updated = false;
	}
}

// If Archive is clicked, change to archive
if(isset($_GET['archive']) && $_GET['archive'] == true){
	$update = "UPDATE `ic_leads` SET `status_read` = '1', `status_open` = '0', `status_archive` = '1', `date_lastcontact` = '".date('M j, y')."', `date_archive` = '".date('M j, y')."' WHERE `ic_leads`.`lead_id` = ".$_GET['lead_id'];
	if($stmt = $mysqli->prepare($update)) {
		$stmt->execute();
		$stmt->close();
		$updated = true;
	}
	else{
		$updated = false;
	}
}

// Reload the entire Lead
if($stmt = $mysqli->prepare("SELECT lead_id, status_read, status_open, status_archive, date_income, date_open, date_lastcontact, date_archive, agent, contact_firstname, contact_lastname, contact_position, contact_company, contact_email, contact_phone, contact_phonealt, contact_address, contact_state, contact_code, contact_country, attachment, app_content, app_assistance, app_goals, app_samples, proj_type, proj_synopsis, proj_submissions, proj_screened, proj_goals, content_title, content_duration, content_year, content_genre, content_keycast, content_keycrew, content_writer, content_adtl, notes, process FROM ic_leads WHERE lead_id = (?)")) {
	$stmt->bind_param('s', $_GET['lead_id']);
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($lead_id, $status_read, $status_open, $status_archive, $date_income, $date_open, $date_lastcontact, $date_archive, $agent, $contact_firstname, $contact_lastname, $contact_position, $contact_company, $contact_email, $contact_phone, $contact_phonealt, $contact_address, $contact_state, $contact_code, $contact_country, $attachment, $app_content, $app_assistance, $app_goals, $app_samples, $proj_type, $proj_synopsis, $proj_submissions, $proj_screened, $proj_goals, $content_title, $content_duration, $content_year, $content_genre, $content_keycast, $content_keycrew, $content_writer, $content_adtl, $notes, $process);
	
	while($stmt->fetch()){
		$lead = [
			'lead_id' => $lead_id,
			'status_read' => $status_read,
			'status_open' => $status_open,
			'status_archive' => $status_archive,
			'date_income' => $date_income,
			'date_open' => $date_open,
			'date_lastcontact' => $date_lastcontact,
			'date_archive' => $date_archive,
			'agent' => $agent,
			'contact_firstname' => $contact_firstname,
			'contact_lastname' => $contact_lastname,
			'contact_position' => $contact_position,
			'contact_company' => $contact_company,
			'contact_email' => $contact_email,
			'contact_phone' => $contact_phone,
			'contact_phonealt' => $contact_phonealt,
			'contact_address' => $contact_address, 
			'contact_state' => $contact_state,
			'contact_code' => $contact_code, 
			'contact_country' => $contact_country, 
			'attachment' => json_decode($attachment),
			'app_content' => $app_content,
			'app_assistance' => $app_assistance, 
			'app_goals' => $app_goals,
			'app_samples' => $app_samples,
			'proj_type' => $proj_type,
			'proj_synopsis' => $proj_synopsis,
			'proj_submissions' => $proj_submissions,
			'proj_screened' => $proj_screened,
			'proj_goals' => $proj_goals,
			'content_title' => $content_title,
			'content_duration' => $content_duration,
			'content_year' => $content_year,
			'content_genre' => $content_genre,
			'content_keycast' => $content_keycast,
			'content_keycrew' => $content_keycrew,
			'content_writer' => $content_writer,
			'content_adtl' => $content_adtl,
			'notes' => $notes,
			'process' => json_decode($process, true)
		];
	}
	$stmt->close();
}
?>
<form action="lead.php?lead_id=<?php print $lead['lead_id']; ?>" method="post">
		
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Indiecast Lead #<?php print $lead['lead_id']; ?>
	            <div style="float:right;">
		            <a href="lead.php?lead_id=<?php print $lead['lead_id']; ?>&open=true" class="btn btn-default">Open lead</a>
		            <a href="lead.php?lead_id=<?php print $lead['lead_id']; ?>&archive=true" class="btn btn-default">Archive lead</a>
		            <button type="submit" class="btn btn-success">Save changes</button>
		        </div>
            </h1>
        </div>
    </div>
	
	<div class="modal fade" id="modal_1" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Contact lead & get additional information</h4>
	      </div>
	      <div class="modal-body">
	        <p>Call the contact on the phone first, if no reply, e-mail</p>
	        <p>Fill out all the information on the lead</p>
	        <p>Fully understand the type of content being submitted. The title, additional titles, and a description are all needed.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="modal_2" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Draft agreement</h4>
	      </div>
	      <div class="modal-body">
	        <p>Download the appropriate agreement below and fill it out accordingly. Upload one copy to the Indiecast Share folder for the lead and send the other copy to the contact</p>
	        <hr />
	        <a href="" class="btn btn-default btn-lg">Agreement for one person</a> <a href="" class="btn btn-default btn-lg">Agreement for a company</a>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="modal_3" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Send agreement</h4>
	      </div>
	      <div class="modal-body">
	        <p>In the Notes section, make note of when and how the agreement was transmitted to the Creator</p>
	        <p>Make sure we have a copy of the agreement in <pre>Indiecast Share/Leads/<?php print $lead['lead_id']; ?></pre></p>
	        <p>Save every single revision of the agreement sent to a Creator</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="modal_4" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Agreement completion</h4>
	      </div>
	      <div class="modal-body">
	        <p>Upon agreement completion, make sure the preliminary agreement(s) are in <pre>Indiecast Share/Leads/<?php print $lead['lead_id']; ?></pre> as well as a scan of the final signed agreement</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="modal_5" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Set up Creator account & billing</h4>
	      </div>
	      <div class="modal-body">
	        <p>Next, you're going to need to convert this lead into a Creator. Click the button below to convert the lead into a Creator and begin setting up the account.</p>
	        <hr />
	        <a href="creator.php?new=<?php print $lead['lead_id']; ?>" class="btn btn-default btn-lg">Convert to Creator</a>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="modal_6" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Receive final media copies and load into IC_VAULT</h4>
	      </div>
	      <div class="modal-body">
	        <p>Through the Creator portal, have the Creator upload the final media copies and store them in <pre>IC_VAULT/Final/<?php print $lead['content_title']; ?></pre></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="modal_7" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Review all information by both parties</h4>
	      </div>
	      <div class="modal-body">
	        <p>Click below to export a page with all the gathered information so far</p>
	        <p>Once the page is generated, save it as a PDF and send it to the Creator for them to sign as their "proof"</p>
	        <hr />
	        <a href="reviewlead.php?lead_id=<?php print $lead['lead_id']; ?>" class="btn btn-default btn-lg">Generate review</a>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="modal_8" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Publish, update Creator file, close lead</h4>
	      </div>
	      <div class="modal-body">
	        <p>Publish the content accordingly through VHX</p>
	        <p>Make sure the Creator file and Lead files are both in good order</p>
	        <p>Review all documents are on file</p>
	        <p>Click below to archive the lead and mark it as closed</p>
	        <hr />
	        <a href="lead.php?lead_id=<?php print $lead['lead_id']; ?>&archive=true" class="btn btn-default btn-lg">Archive lead</a>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<?php
		if(isset($updated)){
			if($updated == true){print '<div class="row"><div class="col-md-12"><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Changes saved successfully</strong></div></div></div>';}
			if($updated == false){print '<div class="row"><div class="col-md-12"><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Shit!</strong> There was an error. Changes not saved.</div></div></div>';}
		}
	?>
	    
    <div class="row">
	    <div class="col-md-12">
		    <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Lead status</h3>
				</div>
				<div class="panel-body">
				    <div class="col-sm-6">
					    Income date: <?php print $lead['date_income']; ?><br/>
					    Date opened: <?php print $lead['date_open']; ?><br/>
					    Date of last edit: <?php print $lead['date_lastcontact']; ?><br/>
					    Date archived: <?php print $lead['date_archive']; ?>
				    </div>
				    <div class="col-sm-3">
						<strong><?php if($lead['status_open'] == 1){print 'This lead is open<br />';}else{print 'This lead is not open<br />';} ?>
						<?php if($lead['status_archive'] == 1){print 'This lead is archived';}else{print '';} ?></strong>
				    </div>
				    <div class="col-sm-3">
					    <div class="form-group">
							<label for="agent">Assigned agent</label>
							<select class="form-control" name="agent">
								<option value="<?php print $lead['agent']; ?>"><?php print $lead['agent']; ?></option>
								<option value="-">--------------</option>
								<option value="Hannah">Hannah</option>
								<option value="Trent">Trent</option>
							</select>
			  			</div>
				    </div>
			    </div>
			</div>
	    </div>
    </div>
    <div class="row">
	    <div class="col-md-6">
		    <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Lead contact</h3>
				</div>
				<div class="panel-body">
				    <div class="form-group">
						<label for="firstname">First name</label>
						<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" value="<?php print $lead['contact_firstname']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="lastname">Last name</label>
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" value="<?php print $lead['contact_lastname']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="position">Position in relation to content being submitted or title</label>
						<input type="text" class="form-control" id="position" name="position" placeholder="Position in relation to content being submitted or title" value="<?php print $lead['contact_position']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="company">Company affiliated with the content</label>
						<input type="text" class="form-control" id="company" name="company" placeholder="Company affiliated with the content" value="<?php print $lead['contact_company']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="email">E-mail</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php print $lead['contact_email']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php print $lead['contact_phone']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="phonealt">Alternate phone</label>
						<input type="text" class="form-control" id="phonealt" name="phonealt" placeholder="Alternate phone" value="<?php print $lead['contact_phonealt']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="mail_address">Mailing address</label>
						<input type="text" class="form-control" id="mail_address" name="mail_address" placeholder="Mailing address" value="<?php print $lead['contact_address']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="mail_state">Mailing state/provence</label>
						<input type="text" class="form-control" id="mail_state" name="mail_state" placeholder="Mailing state/provence" value="<?php print $lead['contact_state']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="mail_code">Mailing postal code</label>
						<input type="text" class="form-control" id="mail_code" name="mail_code" placeholder="Mailing postal code" value="<?php print $lead['contact_code']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="mail_country">Mailing country</label>
						<input type="text" class="form-control" id="mail_country" name="mail_country" placeholder="Mailing country" value="<?php print $lead['contact_country']; ?>">
		  			</div>
			    </div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Attached screening media</h3>
				</div>
				<div class="panel-body">
					<?php if(isset($lead['attachment'])){foreach($lead['attachment'] as $x){ ?>
						<div id="<?php print substr($x, 58); ?>"><a href="<?php print $x; ?>">Download file</a> - <a href="#" onclick="javascript:deleteFile('<?php print substr($x, 58); ?>')">Delete file</a></div>
					<?php }} ?>
					
					<script type="text/javascript">
						function deleteFile(file_name){
						    var r = confirm("Are you sure you want to delete this file on the server?")
						    if(r == true)
						    {
						        $.ajax({
						          url: 'delete.php',
						          data: {'file' : file_name },
						          success: function (response) {
						             $('#' + file_name).fadeout();
						          },
						          error: function () {
						             console.log('err');
						          }
						        });
						    }
						}
					</script>
				</div>
		    </div>
		    <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Application information</h3>
				</div>
				<div class="panel-body">
				    <div class="form-group">
						<label for="content">Do you have content you'd like to submit or will want to submit?</label>
						<select class="form-control" name="content">
							<option value="<?php print $lead['app_content']; ?>"><?php print $lead['app_content']; ?></option>
							<option value="-">--------------</option>
							<option value="Yes, finished content">Yes, finished content</option>
							<option value="Yes, unfinished content">Yes, unfinished content</option>
							<option value="Yes, other">Yes, other</option>
							<option value="No">No</option>
						</select>
		  			</div>
		  			<div class="form-group">
						<label for="assistance">Are you interested in getting assistance on a project?</label>
						<select class="form-control" name="assistance">
							<option value="<?php print $lead['app_assistance']; ?>"><?php print $lead['app_assistance']; ?></option>
							<option value="-">--------------</option>
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
		  			</div>
		  			
		  			
		  			<div class="form-group">
						<label for="goals">What are your goals with Indiecast?</label>
						<textarea class="form-control" rows="3" name="goals"><?php print $lead['app_goals']; ?></textarea>
		  			</div>
		  			<div class="form-group">
						<label for="samples">Do you have any samples of work? (Enter URLs to portfolios or social sites)</label>
						<textarea class="form-control" rows="3" name="samples"><?php print $lead['app_samples']; ?></textarea>
		  			</div>
			    </div>
			</div>
		    <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Project-specific information</h3>
				</div>
				<div class="panel-body">
				    <div class="form-group">
						<label for="type">What type of content are you submitting?</label>
						<select class="form-control" name="type">
							<option value="<?php print $lead['proj_type']; ?>"><?php print $lead['proj_type']; ?></option>
							<option value="-">--------------</option>
							<option value="Motion picture">Motion picture</option>
							<option value="Film">Film</option>
							<option value="Short Film">Short film</option>
							<option value="Web series">Web series</option>
							<option value="TV series">TV series</option>
							<option value="Spoken word album">Spoken word album</option>
							<option value="Music video/project">Music video/project</option>
							<option value="Other media type with only one part">Other media type with only one part</option>
							<option value="Other media type with multiple parts">Other media type with multiple parts</option>
						</select>
		  			</div>
		  			<div class="form-group">
						<label for="synopsis">Content synopsis</label>
						<textarea class="form-control" rows="3" name="synopsis"><?php print $lead['proj_synopsis']; ?></textarea>
		  			</div>
		  			<div class="form-group">
						<label for="submissions">Has this content been submitted anywhere else? If so, where? (Does not effect your application, just required for legal reasons.)</label>
						<textarea class="form-control" rows="3" name="submissions"><?php print $lead['proj_submissions']; ?></textarea>
		  			</div>
		  			<div class="form-group">
						<label for="screened">Has this project been screened or offered for public viewing of any kind? If so, where? (Does not effect your application, just required for legal reasons.)</label>
						<textarea class="form-control" rows="3" name="screened"><?php print $lead['proj_screened']; ?></textarea>
		  			</div>
		  			<div class="form-group">
						<label for="goals">What are your ultimate goals for this project? (Does not effect your application, we would just like to know!)</label>
						<textarea class="form-control" rows="3" name="goals"><?php print $lead['proj_goals']; ?></textarea>
		  			</div>
			    </div>
			</div>
	    </div>
	    <div class="col-md-6">
		    <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Process and convert to Creator</h3>
				</div>
				<div class="panel-body">
					<div class="list-group">
						<div class="checkbox list-group-item list-group-item-info">
						    <label>
						    	<input type="checkbox" name="stages[1]" <?php if(isset($lead['process']['1']) && $lead['process']['1'] == 'on'){?>checked<?php } ?>> Contact lead & get additional information
						    </label>
						    <div style="float:right;"><a href="#" data-toggle="modal" data-target="#modal_1"><i class="fa fa-info-circle"></i></a></div>
						</div>
						<div class="checkbox list-group-item list-group-item-info">
						    <label>
						    	<input type="checkbox" name="stages[2]" <?php if(isset($lead['process']['2']) && $lead['process']['2'] == 'on'){?>checked<?php } ?>> Draft agreement
						    </label>
						    <div style="float:right;"><a href="#" data-toggle="modal" data-target="#modal_2"><i class="fa fa-info-circle"></i></a></div>
						</div>
						<div class="checkbox list-group-item list-group-item-info">
						    <label>
						    	<input type="checkbox" name="stages[3]" <?php if(isset($lead['process']['3']) && $lead['process']['3'] == 'on'){?>checked<?php } ?>> Send agreement
						    </label>
						    <div style="float:right;"><a href="#" data-toggle="modal" data-target="#modal_3"><i class="fa fa-info-circle"></i></a></div>
						</div>
						<div class="checkbox list-group-item list-group-item-info">
						    <label>
						    	<input type="checkbox" name="stages[4]" <?php if(isset($lead['process']['4']) && $lead['process']['4'] == 'on'){?>checked<?php } ?>> Agreement completion
						    </label>
						    <div style="float:right;"><a href="#" data-toggle="modal" data-target="#modal_4"><i class="fa fa-info-circle"></i></a></div>
						</div>
						<div class="checkbox list-group-item list-group-item-info">
						    <label>
						    	<input type="checkbox" name="stages[5]" <?php if(isset($lead['process']['5']) && $lead['process']['5'] == 'on'){?>checked<?php } ?>> Set up Creator account & billing 
						    </label>
						    <div style="float:right;"><a href="#" data-toggle="modal" data-target="#modal_5"><i class="fa fa-info-circle"></i></a></div>
						</div>
						<div class="checkbox list-group-item list-group-item-info">
						    <label>
						    	<input type="checkbox" name="stages[6]" <?php if(isset($lead['process']['6']) && $lead['process']['6'] == 'on'){?>checked<?php } ?>> Receive final media copies and load into IC_VAULT
						    </label>
						    <div style="float:right;"><a href="#" data-toggle="modal" data-target="#modal_6"><i class="fa fa-info-circle"></i></a></div>
						</div>
						<div class="checkbox list-group-item list-group-item-info">
						    <label>
						    	<input type="checkbox" name="stages[7]" <?php if(isset($lead['process']['7']) && $lead['process']['7'] == 'on'){?>checked<?php } ?>> Review all information by both parties
						    </label>
						    <div style="float:right;"><a href="#" data-toggle="modal" data-target="#modal_7"><i class="fa fa-info-circle"></i></a></div>
						</div>
						<div class="checkbox list-group-item list-group-item-info">
						    <label>
						    	<input type="checkbox" name="stages[8]" <?php if(isset($lead['process']['8']) && $lead['process']['8'] == 'on'){?>checked<?php } ?>> Publish, update Creator file, close lead
						    </label>
						    <div style="float:right;"><a href="#" data-toggle="modal" data-target="#modal_8"><i class="fa fa-info-circle"></i></a></div>
						</div>
					</div>
				</div>
		    </div>
		    <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Processing information</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="final_title">Content title</label>
						<input type="text" class="form-control" id="final_title" name="final_title" placeholder="Content title" value="<?php print $lead['content_title']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="final_duration">Duration</label>
						<input type="text" class="form-control" id="final_duration" name="final_duration" placeholder="Duration" value="<?php print $lead['content_duration']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="final_year">Year created</label>
						<input type="text" class="form-control" id="final_year" name="final_year" placeholder="Year created" value="<?php print $lead['content_year']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="final_genre">Genre</label>
						<input type="text" class="form-control" id="final_genre" name="final_genre" placeholder="Genre" value="<?php print $lead['content_genre']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="final_keycast">Key cast</label>
						<textarea class="form-control" rows="3" name="final_keycast"><?php print $lead['content_keycast']; ?></textarea>
		  			</div>
		  			<div class="form-group">
						<label for="final_keycrew">Key crew</label>
						<textarea class="form-control" rows="3" name="final_keycrew"><?php print $lead['content_keycrew']; ?></textarea>
		  			</div>
		  			<div class="form-group">
						<label for="final_writer">Writer</label>
						<input type="text" class="form-control" id="final_writer" name="final_writer" placeholder="Writer" value="<?php print $lead['content_writer']; ?>">
		  			</div>
		  			<div class="form-group">
						<label for="final_adtl">If there's more than one piece of content in the project, list the title for each item</label>
						<textarea class="form-control" rows="3" name="final_adtl"><?php print $lead['content_adtl']; ?></textarea>
		  			</div>
				</div>
		    </div>
		    <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Notes</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label for="notes">Account notes</label>
						<textarea class="form-control" rows="5" name="notes"><?php print $lead['notes']; ?></textarea>
		  			</div>
				</div>
		    </div>
	    </div>
    </div>
</div>

</form>

<?php include_once('../../include/footer.php'); ?>
