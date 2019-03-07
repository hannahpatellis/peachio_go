<?php
require_once('../include/header.php');
require_once('../include/sidebar.php');
require_once('../auth/fn.php');
require_once('../auth/go_connect.php');
$associate_count = 0;
foreach(getAssociates($mysqli) as $x){$associate_count++;}
?>

<div id="fb-root"></div>
<!-- FB Script -->

<style type="text/css">
	#dashicons{
		width:580px;
		height:100px;
		margin:0 auto;
		text-align:center;
		margin:20px 20px 20px 20px;
	}
	.dashicon{
		float:left;
		margin-right:20px;
	}
	.dashicon:last-child{
		margin-right:0px;
	}
</style>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
	            <?php
					if(date('H') == '12' || date('H') == '13' || date('H') == '14' || date('H') == '15' || date('H') == '16'){
						print ('Good afternoon');
					}
					if(date('H') == '17' || date('H') == '18' || date('H') == '19' || date('H') == '20' || date('H') == '21' || date('H') == '22' || date('H') == '23' || date('H') == '00' || date('H') == '01' || date('H') == '02'){
						print('Good evening');
					}
					if(date('H') == '03' || date('H') == '04' || date('H') == '05' || date('H') == '06' || date('H') == '07' || date('H') == '08' || date('H') == '09' || date('H') == '10' || date('H') == '11'){
						print('Good morning');
					}
				?>, <?php print ucfirst($_SESSION['user']['associate']['preferedname']); ?>!
            </h1>
        </div>
    </div>
    
    <?php
		if(isset($_GET['message']) && $_GET['message'] == 'accessdenied'){
			print '<div class="row"><div class="col-lg-12"><div class="panel panel-danger"><div class="panel-heading"><h3 class="panel-title">Oops!</h3></div><div class="panel-body"><p>I am sorry, you do not have access to that page</p></div></div></div></div>';
		}
	?>
    
    <div class="row">
	    <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body" style="text-align:center;">
			    	<div class="row">
					    <div class="col-md-1"></div>
					    <div class="col-md-2">
					    	<center>
					    		<a href="https://peachio.slack.com/"><img src="../assets/slack.png" width="50%" alt="Slack" /></a>
					    	</center>
				    	</div>
				    	<div class="col-md-2">
					    	<center>
					    		<a href="https://trello.com/peachio"><img src="../assets/trello.png" width="50%" alt="Trello" /></a>
					    	</center>
				    	</div>
				    	<div class="col-md-2">
					    	<center>
					    		<a href="https://fs.peachio.co"><img src="../assets/owncloud.png" width="50%" alt="File System Online" /></a>
					    	</center>
				    	</div>
				    	<div class="col-md-2">
					    	<center>
					    		<a href="https://owncloud.org/install/#install-clients"><img src="../assets/owncloud_desktop.png" width="50%" alt="ownCloud File System Desktop" /></a>
					    	</center>
				    	</div>
				    	<div class="col-md-2">
					    	<center>
					    		<a href="https://mail.google.com/a/peachio.co"><img src="../assets/gmail.png" width="50%" alt="E-mail" /></a>
					    	</center>
				    	</div>
			    	</div>
			    	<hr />
			    	<div class="row">
				    	<div class="col-md-1"></div>
					    <div class="col-md-2">
					    	<center>
					    		<p><strong><a href="https://peachio.slack.com/">Slack</a></strong></p>
					    		<p>For internal communications</p>
					    	</center>
				    	</div>
				    	<div class="col-md-2">
					    	<center>
								<p><strong><a href="https://trello.com/peachio">Trello</a></strong></p>
					    		<p>For guides, brain-storming, protocols, and more</p>
					    	</center>
				    	</div>
				    	<div class="col-md-2">
					    	<center>
					    		<p><strong><a href="https://fs.peachio.co">File System Online</a></strong></p>
					    		<p>For storage of documents and other files (through your web browser)</p>
					    	</center>
				    	</div>
				    	<div class="col-md-2">
					    	<center>
					    		<p><strong><a href="https://owncloud.org/install/#install-clients">ownCloud App for the File System</a></strong></p>
					    		<p>The ownCloud app for desktop and mobile lets you see and sync all or parts of the File System</p>
					    	</center>
				    	</div>
				    	<div class="col-md-2">
					    	<center>
					    		<p><strong><a href="https://mail.google.com/a/peachio.co">E-mail</a></strong></p>
					    		<p>For accessing @peachio.co e-mail, calendar, and more</p>
					    	</center>
				    	</div>
			    	</div>
				</div>
			</div>
	    </div>
	</div>
</div>

<?php include_once('../include/footer.php'); ?>
