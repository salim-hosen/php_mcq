<?php
  // Redirection if Logged
  require_once "lib/Session.php";
  Session::init();

  if(!isset($_SESSION['login']) && $_SESSION['login'] == false){
    exit(header("Location: index.php"));
  }

  if(isset($_GET['logout']) && $_GET['logout'] === "yes"){
    unset($_SESSION["login"]);
    exit(header("Location: index.php"));
  }
?>

<!doctype html>

<html lang="en-US">
	<head>
		<title>Online Exam</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<link href="fa/css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
	</head>

	<body>
		<div id="wrapper">
			<header class="well text-center">
				<div  class="container">
					<h1><a href="home.php">Online Exam System</a></h1>
					<p>Test your Knowledge</p>
				</div>
			</header>
