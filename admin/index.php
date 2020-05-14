<?php
	include "../config/config.php";
?>

<?php
	ini_set( 'display_errors', 1 );
	error_reporting( E_ALL );
	include "../lib/Session.php";
	Session::init();
  if(isset($_SESSION['admLogin']) && $_SESSION['admLogin'] == true){
    exit(header("Location: panel.php"));
  }
?>
<!doctype html>

<html lang="en-US">
	<head>
		<title>Online Exam</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="../css/admin.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../js/admin.js"></script>
	</head>

	<body style="background:#f4f4f4;">
		<div id="login_wrapper">
			<div id="loginError" class="text-center alert alert-danger"></div>
			<section class="login_panel panel panel-default">
				<div class="lr panel panel-heading">
					<h3>Admin Panel Login</h3>
				</div>
				<div class="panel-body login">
					<p class="text text-danger text-center" id="log_error"></p>
					<form id="admin_login" action="" method="post">
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" type="text" name="email"/>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input class="form-control" type="password" name="password"/>
						</div>
						<div class="form-group">
							<input class="btn btn-primary" type="submit" value="Login"/>
						</div>
					</form>
					
				<div class="alert alert-success">
					<p>Email: <b>admin@gmail.com</b></p>
					<p>Password: <b>password</b></p>
				</div>
				</div>
			</section>
		</div>
	</body>
</html>
