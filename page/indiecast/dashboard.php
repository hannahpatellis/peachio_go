<?php
require_once('../../include/header.php');
require_once('../../include/sidebar.php');
require_once('../../auth/go_connect.php');

$leads = array();
if($stmt = $mysqli->prepare("SELECT status_read, status_open FROM ic_leads")) {
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($status_read, $status_open);
	
	while($stmt->fetch()){
		$leads[] = [
		    "read" => $status_read,
		    "open" => $status_open
		];
	}
	$stmt->close();
}	

$new_count = 0;
$open_count = 0;	
foreach($leads as $x){
	if($x['read'] == 0){$new_count++;}
	if($x['open'] == 1){$open_count++;}
}
?>
	
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <center><h1 class="page-header"><img src="../../assets/indiecast.png" alt="Indiecast" /></h1></center>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-certificate fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php print $new_count; ?></div>
                            <div>Unread/unassigned leads</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-folder-open fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php print $open_count; ?></div>
                            <div>Open leads</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-life-ring fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">0</div>
                            <div>Open support cases</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">0</div>
                            <div>Total revenue</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
	    <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Quick links</h3>
		  		</div>
				<div class="panel-body">
			    	<a href="http://indiecast.tv/"><button type="button" class="btn btn-default" aria-label="Left Align">Indiecast Home Website</button></a>
			    	<a href="https://submit.indiecast.tv/"><button type="button" class="btn btn-default" aria-label="Left Align">Indiecast Creator Home Website</button></a>
			    	<a href="http://indiecast.tv/"><button type="button" class="btn btn-default" aria-label="Left Align">Facebook</button></a>
			    	<a href="https://twitter.com/indiecast_tv"><button type="button" class="btn btn-default" aria-label="Left Align">Twitter</button></a>
				</div>
			</div>
	    </div>
	</div>
	<div class="row">
	    <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Services</h3>
		  		</div>
				<div class="panel-body">
			    	<a href="https://indiecasttv.vhx.tv/admin/dashboard/products"><button type="button" class="btn btn-default" aria-label="Left Align">VHX</button></a>
			    	<a href="https://indiecast.freshdesk.com/helpdesk/tickets/filter/all_tickets"><button type="button" class="btn btn-default" aria-label="Left Align">Freshdesk</button></a>
				</div>
			</div>
	    </div>
	</div>
	<div class="row">
	    <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">VHX Quick Picks</h3>
		  		</div>
				<div class="panel-body">
			    	<a href="https://indiecasttv.vhx.tv/admin/customers"><button type="button" class="btn btn-default" aria-label="Left Align">View Customers</button></a>
			    	<a href="https://indiecasttv.vhx.tv/admin/transactions"><button type="button" class="btn btn-default" aria-label="Left Align">View Transactions</button></a>
			    	<a href="https://indiecasttv.vhx.tv/admin/videos"><button type="button" class="btn btn-default" aria-label="Left Align">Video Content</button></a>
			    	<a href="https://indiecasttv.vhx.tv/admin/extras"><button type="button" class="btn btn-default" aria-label="Left Align">Extras Content</button></a>
			    	<a href="https://indiecasttv.vhx.tv/admin/collections"><button type="button" class="btn btn-default" aria-label="Left Align">Collections Content</button></a>
			    	<a href="https://indiecasttv.vhx.tv/admin/design"><button type="button" class="btn btn-default" aria-label="Left Align">Edit Theme</button></a>							</div>
			</div>
	    </div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Resources</h3>
		  		</div>
				<div class="panel-body">
			    	<p>When looking for any kind of protocol or up-to-date information, use <a href="https://trello.com/peachio">Trello</a></p>
			    	<p>When storing ANY files, store them on the <a href="https://fs.peachio.co">peachIO File System</a> <strong>NEVER EVER ANYWHERE ELSE</strong></p>
			    	<p>For internal communication, use <a href="https://peachio.slack.com/">Slack</a></p>
			    	<hr />
			    	<a href="//assets.peachio.co/branding_assets-v1r3.zip"><button type="button" class="btn btn-default" aria-label="Left Align">Branding Assets v1r3</button></a>
			    	<a href="#"><button type="button" class="btn btn-default" aria-label="Left Align" disabled>Business Guidelines</button></a>
				</div>
			</div>
		</div>
	</div>
    
</div>

<?php include_once('../../include/footer.php'); ?>
