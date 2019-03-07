<?php
	if(isset($_POST['newpw'])){
		if($_POST['newpw'] == $_POST['newpw_conf']){
			$sent = mail('', 'PASSWORD CHANGE', 'Please change '.$_POST['username'].'\'s password to '.$_POST['newpw']);
			unset($_POST);
			header('Location: https://go.peachio.co/welcome.php?message=pwsuccess');
		}
		else{
			unset($_POST);
			header('Location: https://go.peachio.co/passwordhelper.php?error=nomatch');
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="peachIO LLC">

    <title>peachIO Portal | Password Helper</title>

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
</head>
<body style="background-image:url('assets/brand_canvas.png');background-repeat:no-repeat;background-size:cover;">
    <div class="container" style="opacity:.9">
	    <?php
		if(isset($_GET['error']) && $_GET['error'] == 'nomatch'){
			print '<div class="row"><div class="col-md-4 col-md-offset-4"><div class="login-panel panel panel-danger"><div class="panel-heading"><h3 class="panel-title">Oops</h3></div><div class="panel-body"><p>Please make sure both passwords match.</p></div></div></div></div>';
		}
		?>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <center><img style="margin-bottom:20px;margin-top:20px;" src="assets/corp_logo_large.png" alt="peachIO" width="90%" /></center>
                        <h3 class="panel-title">
	                        Welcome to the password helper
                        </h3>
                    </div>
                    <div class="panel-body">
	                    <p>Please make sure your password is <strong>8</strong> or more characters and includes at least three of the following: One capital letter, one lowercase letter, one number, one symbol.</p>
	                    <form action="https://go.peachio.co/passwordhelper.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="newpw" type="password">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password (Again)" name="newpw_conf" type="password">
                                </div>
                                <button type="submit" class="btn btn-lg btn-default btn-block">Change</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
