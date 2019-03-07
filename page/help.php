<?php
require_once('../include/header.php');
require_once('../include/sidebar.php');

if(isset($_POST['feedback'])){
	$to      = 'hannah@peachio.co';
	$subject = 'Portal Feedback/Bug Report';
	$message = $_POST['feedback'];
	$headers = 'From: '.$_POST['email'] . "\r\n" .
    'Reply-To: '.$_POST['email'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);
	unset($_POST);
	$sent = 'yes';
}

?>
	
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
	            Help & support
            </h1>
        </div>
    </div>
    
    <div class="row">
		<div class="col-md-8">
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Help me!</h3>
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Please explain this system</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            The peachIO Portal is a place where everything peachIO does can be managed from one place. Each user sees something slightly different because peachIO Portal pages (or Modules) vary based on permissions. Modules are on the left hand sidebar.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Collapsible Group Item #2</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Collapsible Group Item #3</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
		</div>
		
  		<div class="col-md-4">
	  		<?php if(isset($sent)){print '<div class="alert alert-success" role="alert"><strong>Yay!</strong><p>Thank you for your feedback/bug report!</p></div>';} ?>
	  		<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title">Send feedback/report a bug</h3>
				</div>
				<div class="panel-body">
			    	<form method="post" action="help.php">
					  <div class="form-group">
					    <label for="email">Your e-mail</label>
					    <input type="email" class="form-control" name="email" id="email" value="<?php print $_SESSION['user']['email']; ?>">
					  </div>
					  <div class="form-group">
					    <label for="feedback">Your feedback/bug report</label>
					    <textarea class="form-control" name="feedback" rows="10"></textarea>
					  </div>
					  <button type="submit" class="btn btn-default">Send</button>
					</form>
				</div>
			</div>
  		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="well">
				The peachIO Portal was designed and coded in-house by Hannah Patellis and a team of really annoying cats. The Portal was coded using Bootstrap, HTML5, jQuery, PHP, MySQL, and various libraries from amazing developers. peachIO and the Portal are all hosted through DigitalOcean on Ubuntu 16.04 LTS servers. Thanks, DigitalOcean!<br /><br /><center><small>Coded with love • peachIO Portal v.1.0.0 ß • Still in development</small></center>
			</div>
		</div>
	</div>

</div>

<?php include_once('../include/footer.php'); ?>
