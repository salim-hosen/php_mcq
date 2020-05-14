<?php
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
					<a href="index.php" id="log_link">Login</a>
					<a href="#" id="reg_link" class="bg-primary">Register</a>
				</div>
				<div class="panel-body register">
					<p class="text text-danger text-center" id="reg_error"></p>
					<p class="text text-success text-center" id="reg_success"></p>
					<form id="reg_form" autocomplete="off">
						<div class="form-group">
							<label>Full Name</label>
							<input class="form-control" type="text" name="name"/>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" type="text" name="email"/>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input class="form-control" type="password" name="password"/>
						</div>
						<div class="form-group">
							<label>Re-Password</label>
							<input class="form-control" type="password" name="repassword"/>
						</div>
						<div class="form-group">
							<input class="btn btn-primary" type="submit" name="login" value="Register"/>
						</div>
					</form>
				</div>
			</section>
		</div>
	</body>
</html>
