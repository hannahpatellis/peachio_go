<?php
session_start();
if(!isset($_SESSION['user'])){header('Location: https://go.peachio.co/welcome.php');}
$authInfo = $_SESSION;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="peachIO LLC">

    <title>peachIO Portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://go.peachio.co/include/bootstrap/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="https://go.peachio.co/include/bootstrap/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="https://go.peachio.co/include/bootstrap/bootstrap/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="https://go.peachio.co/include/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="https://go.peachio.co/include/bootstrap/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://go.peachio.co/include/bootstrap/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="https://go.peachio.co/include/bootstrap/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="https://go.peachio.co/include/bootstrap/bootstrap/js/sb-admin-2.js"></script>
    <!-- Special Tables -->
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
		@font-face {
		    font-family: 'Lato';
		    src: url('https://go.peachio.co/include/fonts/lato-bold-webfont.woff2') format('woff2'),
		         url('https://go.peachio.co/include/fonts/lato-bold-webfont.woff') format('woff'),
		         url('https://go.peachio.co/include/fonts/lato-bold-webfont.ttf') format('truetype'),
		         url('https://go.peachio.co/include/fonts/lato-bold-webfont.svg#latobold') format('svg');
		    font-weight: bold;
		    font-style: normal;}
		@font-face {
		    font-family: 'Lato';
		    src: url('https://go.peachio.co/include/fonts/lato-bolditalic-webfont.woff2') format('woff2'),
		         url('https://go.peachio.co/include/fonts/lato-bolditalic-webfont.woff') format('woff'),
		         url('https://go.peachio.co/include/fonts/lato-bolditalic-webfont.ttf') format('truetype'),
		         url('https://go.peachio.co/include/fonts/lato-bolditalic-webfont.svg#latobold_italic') format('svg');
		    font-weight: bold;
		    font-style: italic;}
		@font-face {
		    font-family: 'Lato';
		    src: url('https://go.peachio.co/include/fonts/lato-italic-webfont.woff2') format('woff2'),
		         url('https://go.peachio.co/include/fonts/lato-italic-webfont.woff') format('woff'),
		         url('https://go.peachio.co/include/fonts/lato-italic-webfont.ttf') format('truetype'),
		         url('https://go.peachio.co/include/fonts/lato-italic-webfont.svg#latoitalic') format('svg');
		    font-weight: normal;
		    font-style: italic;}
		@font-face {
		    font-family: 'Lato';
		    src: url('https://go.peachio.co/include/fonts/lato-light-webfont.woff2') format('woff2'),
		         url('https://go.peachio.co/include/fonts/lato-light-webfont.woff') format('woff'),
		         url('https://go.peachio.co/include/fonts/lato-light-webfont.ttf') format('truetype'),
		         url('https://go.peachio.co/include/fonts/lato-light-webfont.svg#latolight') format('svg');
		    font-weight: lighter;
		    font-style: normal;}
		@font-face {
		    font-family: 'Lato';
		    src: url('https://go.peachio.co/include/fonts/lato-lightitalic-webfont.woff2') format('woff2'),
		         url('https://go.peachio.co/include/fonts/lato-lightitalic-webfont.woff') format('woff'),
		         url('https://go.peachio.co/include/fonts/lato-lightitalic-webfont.ttf') format('truetype'),
		         url('https://go.peachio.co/include/fonts/lato-lightitalic-webfont.svg#latolight_italic') format('svg');
		    font-weight: lighter;
		    font-style: italic;}
		@font-face {
		    font-family: 'Lato';
		    src: url('https://go.peachio.co/include/fonts/lato-regular-webfont.woff2') format('woff2'),
		         url('https://go.peachio.co/include/fonts/lato-regular-webfont.woff') format('woff'),
		         url('https://go.peachio.co/include/fonts/lato-regular-webfont.ttf') format('truetype'),
		         url('https://go.peachio.co/include/fonts/lato-regular-webfont.svg#latoregular') format('svg');
		    font-weight: normal;
		    font-style: normal;}
    
	    div.forhide {display:hidden;}
	    body{
		    font-family:'Lato',Gotham,Helvetica,Arial,sans-serif;
		    background-image:#fff;
	    }
	    h1{
		    font-family:'Lato',Gotham,Helvetica,Arial,sans-serif;
		    font-weight: lighter;
		    font-size:50px;
	    }
	    h3{
		    font-family:'Lato',Gotham,Helvetica,Arial,sans-serif;
		    font-weight: bold;
		    text-transform: uppercase;
	    }
	    #page-wrapper{
		    background-color:rgba(244, 244, 244, 0.89);
	    }
	    .navbar{
		    margin-bottom: 0;
		    background-color:rgba(244, 244, 244, 0.75);
	    }
	    .sidebar{
		    background-color:rgba(244, 244, 244, 0.6);
	    }
	    .sidebar a{
		    color:#333;
	    }
	    ul#side-menu a.active{
			background-color:rgba(244, 244, 244, 0.5);
	    }
	    ul#side-menu li.active a{
			background-color:rgba(244, 244, 244, 0.5);
	    }
	    ul#side-menu a:hover{
			background-color:rgba(244, 244, 244, 0.5);
	    }
	    #footer{
		    font-family:'Lato',Gotham,Helvetica,Arial,sans-serif;
		    font-weight: lighter;
		    font-size:10px;
		    background-color:rgba(219, 219, 219, 0.8);
		    text-align:center;
		    padding-top:20px;
		    padding-bottom:20px;
	    }
	    .nav-tabs li.active a{
		    background-color:#ddd;
		    border-bottom-color:#ddd!important;
	    }
	</style>
</head>
<body>
<div id="wrapper">
	
	<!-- authInfo -->
    <div class="modal fade" id="authInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Authentication information</h4>
                </div>
                <div class="modal-body">
                    <pre><?php print_r($authInfo); ?></pre>
                </div>
                <div class="modal-footer">
	                <?php if(isset($_SESSION['user']['google_ident_store'])){print '<a href="https://go.peachio.co/destroy.php?revoke=true"><button type="button" class="btn btn-default">Logout and Revoke Token</button></a>';}?>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
	    <div class="navbar-header">
	        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	        </button>
	        <a class="navbar-brand" href="https://go.peachio.co/page/dashboard.php"><img src="https://go.peachio.co/assets/corp_logo.png" alt="peachIO Portal" /></a>
	    </div>
	    
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <!-- User Dropdown -->
                <ul class="dropdown-menu dropdown-messages">
                    <li><a href="#"> <span style="font-weight: bold;"><?php print ucfirst($_SESSION['user']['associate']['preferedname']).' '.ucfirst($_SESSION['user']['associate']['lastname']).'</span>'; ?></a>
                    </li>
                    <li><a href="#"><?php print ucfirst($_SESSION['user']['associate']['title']); ?></a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="https://go.peachio.co/passwordhelper.php"><i class="fa fa-key fa-fw"></i> Change password</a>
                    </li>
                    <li><a href="https://go.peachio.co/destroy.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                    <li class="divider"></li><li><a data-toggle="modal" data-target="#authInfo" href="#">Authenticated</a></li>
                </ul>
            </li>
            <!-- <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-question-circle fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                
                <ul class="dropdown-menu dropdown-messages">
                    <li><a href="https://go.peachio.co/page/help.php">Get help</a></li>
                    <li><a href="https://go.peachio.co/page/help.php">Give feedback</a></li>
                     <li class="divider"></li>
                    <li><a href="https://go.peachio.co/page/help.php">About</a></li>
                </ul>
            </li> -->
        </ul>