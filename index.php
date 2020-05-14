<?php
	ini_set( 'display_errors', 1 );
	error_reporting( E_ALL );
	include "lib/Session.php";
	Session::init();
  if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    exit(header("Location: home.php"));
  }
?>
<!doctype html>

<html lang="en-US">
	<head>
		<title>Online Exam</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
	</head>

	<body>
		<div id="login_wrapper">
			<section class="heading text-center">
				<h1>Online Exam System</h1>
			</section>
			<section class="login_panel panel panel-default">
				<div class="lr">
					<a href="#" id="log_link" class="bg-primary">Login</a>
					<a href="register.php" id="reg_link" >Register</a>
				</div>
				<div class="panel-body login">
					<p class="text text-danger text-center" id="log_error"></p>
					<form id="login_form" autocomplete="off" action="" method="post">
						<div class="form-group">
							<label>Email</label>
							<input placeholder="Your Email" value="" class="form-control" type="text" name="email"/>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input placeholder="Your Password" value="" class="form-control" type="password" name="password"/>
						</div>
						<div class="form-group">
							<input class="btn btn-primary" type="submit" value="Login"/>
						</div>
					</form>
				</div>
			</section>
		</div>
	</body>
</html>
