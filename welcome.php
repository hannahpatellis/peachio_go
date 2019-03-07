<?php
session_start();
if(isset($_SESSION['user'])){header('Location: https://go.peachio.co/page/dashboard.php');}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="peachIO LLC">

    <title>peachIO Portal | Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="include/bootstrap/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="include/bootstrap/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="include/bootstrap/bootstrap/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="include/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="include/bootstrap/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="include/bootstrap/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="include/bootstrap/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../include/bootstrap/bootstrap/js/sb-admin-2.js"></script>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
	    @media screen and (max-width:767px){
		    #bottomBar{display:none;}}
	</style>
</head>
<body>
    <div class="container" style="opacity:.9">
	    <?php
		if(isset($_GET['error']) && $_GET['error'] == 'invalidlogin'){
			print '<div class="row"><div class="col-md-4 col-md-offset-4"><div class="login-panel panel panel-danger"><div class="panel-heading"><h3 class="panel-title">Oops</h3></div><div class="panel-body"><p>Your username or password is incorrect (AD_AUTH_INVALID_AUTH)</p></div></div></div></div>';
		}
		if(isset($_GET['error']) && $_GET['error'] == 'invalidpost'){
			print '<div class="row"><div class="col-md-4 col-md-offset-4"><div class="login-panel panel panel-danger"><div class="panel-heading"><h3 class="panel-title">Oops</h3></div><div class="panel-body"><p>Something went wrong. Please try again (AD_AUTH_INVALID_POST)</p></div></div></div></div>';
		}
		if(isset($_GET['error']) && $_GET['error'] == 'invalidpost_login'){
			print '<div class="row"><div class="col-md-4 col-md-offset-4"><div class="login-panel panel panel-danger"><div class="panel-heading"><h3 class="panel-title">Oops</h3></div><div class="panel-body"><p>Something went wrong. Please try again (GOLOGIN_INVALID_POST)</p></div></div></div></div>';
		}
		if(isset($_GET['message']) && $_GET['message'] == 'pwsuccess'){
			print '<div class="row"><div class="col-md-4 col-md-offset-4"><div class="login-panel panel panel-danger"><div class="panel-heading"><h3 class="panel-title">Yay!</h3></div><div class="panel-body"><p>Please allow up to an hour for your password change to populate all peachIO systems.</p></div></div></div></div>';
		}
		?>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <center><img style="margin-bottom:20px;margin-top:20px;" src="assets/corp_logo_large.png" alt="peachIO" width="90%" /></center>
                    </div>
                    <div class="panel-body">
	                    <form action="https://pits.peachio.co/ad_auth/go.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <button type="submit" class="btn btn-lg btn-default btn-block">Login</button>
                            </fieldset>
                        </form>

                    </div>
                    <center><p><a href="https://go.peachio.co/passwordhelper.php">Change my password</a></p></center>
                </div>
            </div>
        </div>
    </div>
<!-- Tracking script -->
</body>
</html>
