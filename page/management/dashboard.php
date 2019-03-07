<?php
require_once('../../include/header.php');
require_once('../../include/sidebar.php');
require_once('../../auth/fn.php');

## DigitalOcean exports as $digitalocean_droplets
$requestURL = 'https://api.digitalocean.com/v2/droplets?page=1&per_page=1';
$headers = array();
$headers[] = "Content-Type: application/json";
$headers[] = "Authorization: Bearer ";
$digitalocean_droplets = json_decode(curlGET($requestURL, $headers, false), true);

## Counts the number of droplets
$dropletcount = 0;
foreach($digitalocean_droplets['droplets'] as $svr_cnt){$dropletcount++;}

## DigitalOcean exports as $digitalocean_accnt
$requestURL = 'https://api.digitalocean.com/v2/account';
$headers = array();
$headers[] = "Content-Type: application/json";
$headers[] = "Authorization: Bearer ";
$digitalocean_accnt = json_decode(curlGET($requestURL, $headers, false), true);
?>
	
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Administration</h1>
        </div>
    </div>
    <div class="row">
	    <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body" style="text-align:center;">
			    	<a href="https://peachio.co/"><button type="button" class="btn btn-default btn-lg" aria-label="Left Align">peachIO Website</button></a> 
			    	<a href="https://fs.peachio.co"><button type="button btn-lg" class="btn btn-default btn-lg" aria-label="Left Align">Files</button></a>
			    	<a href="https://owncloud.org/install/#install-clients"><button type="button btn-lg" class="btn btn-default btn-lg" aria-label="Left Align">Local Files Client</button></a>
			    	
			    	<a href="https://mail.google.com/a/peachio.co"><button type="button" class="btn btn-default btn-lg" aria-label="Left Align">E-mail</button></a>  
			    	<a href="https://calendar.google.com"><button type="button" class="btn btn-default btn-lg" aria-label="Left Align">Calendar</button></a> 
			    	<a href="https://trello.com/peachio"><button type="button" class="btn btn-default btn-lg" aria-label="Left Align">Trello</button></a> 
			    	<a href="https://peachio.slack.com/"><button type="button" class="btn btn-default btn-lg" aria-label="Left Align">Slack</button></a>
				</div>
			</div>
	    </div>
	</div>
    <div class="row">
	    <div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Admin links</h3>
		  		</div>
				<div class="panel-body">
					<a href="https://peachio.co/wp-admin"><button type="button" class="btn btn-default" aria-label="Left Align">Website Admin</button></a>
					<a href="https://go.peachio.co/admin-mysql"><button type="button" class="btn btn-default" aria-label="Left Align">PHPMyAdmin</button></a>
			    	<a href="https://admin.google.com/AdminHome#Home:"><button type="button" class="btn btn-default" aria-label="Left Align">Google Admin</button></a>
			    	<a href="https://cloud.digitalocean.com/droplets"><button type="button" class="btn btn-default" aria-label="Left Align">DigitalOcean</button></a>
					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Finance <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					    <li><a href="https://www.amerisbank.com/">Ameris Bank</a></li>
					    <li><a href="https://qbo.intuit.com/app/homepage">QuickBooks</a></li>
					    <li><a href="https://paypal.com">PayPal</a></li>
					  </ul>
					</div>
					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Store/Purchase <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					    <li><a href="https://qbo.intuit.com/app/homepage">Amazon Business</a></li>
					    <li><a href="https://gateway.usps.com/eAdmin/action/homepage">USPS</a></li>
					  </ul>
					</div>
				</div>
			</div>
	    </div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">DigitalOcean Droplets (<?php print $dropletcount.'/'.$digitalocean_accnt['account']['droplet_limit']; ?>)</h3>
		  		</div>
				<div class="panel-body">
					<?php
						foreach($digitalocean_droplets['droplets'] as $svr){
							print $svr['name'].' - <small>';
							print print $svr['networks']['v4']['0']['ip_address'].'</small> - ';
							print $svr['status'].' / ';
							print $svr['image']['distribution'].' '.$svr['image']['name'].' / ';
							print strtoupper($svr['size']['slug']).' / ';
							print $svr['size']['disk'].'gb / ';
							print $svr['size']['vcpus'].' vcpus / ';
							print strtoupper($svr['region']['slug']).' / $';
							print $svr['size']['price_monthly'].' mo.';
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once('../include/footer.php'); ?>
