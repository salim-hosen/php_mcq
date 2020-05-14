<?php
	require_once "../config/config.php";
?>
<?php
  // Redirection if Logged
  require_once "../lib/Session.php";
  Session::init();

  if(!isset($_SESSION['admLogin']) && $_SESSION['admLogin'] == false){
    exit(header("Location: index.php"));
  }

  if(isset($_GET['admLogout']) && $_GET['admLogout'] === "yes"){
    unset($_SESSION["admLogin"]);
    exit(header("Location: index.php"));
  }

?>
<!doctype html>

<html lang="en-US">
	<head>
		<title>Online Exam</title>
		<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="../fa/css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
		<link href="../css/admin.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="../js/admin.js"></script>
	</head>

	<body>
    <header class="container">
      <div class="header">
        <div class="admin_title">
          <h3>Admin Panel</h3>
        </div>
        <div class="btn-group admin_menu">
          <button type="button" class="btn btn-primary">
            <i class="fas fa-user-circle"></i> Admin
          </button>
          <button class="btn btn-primary" id="admin_button" type="button">
            <span class="caret"></span>
          </button>
         <ul class="dropdown-menu" role="menu">
           <li><a id="openProf" href="#">Profile</a></li>
           <li><a href="?admLogout=yes">Logout</a></li>
         </ul>
        </div>
      </div>
    </header>
		<div class="container">
	    <div class="alert alert-danger allError" ></div>
	    <div class="alert alert-success allSuccess" ></div>
	  </div>

		<div id="profile">
			<form id="admin_profile" action="" method="post">
				<div id="upSuccess" class="text-center alert alert-success"></div>
				<div id="upError" class="text-center alert alert-danger"></div>
				<h2 class="text-center">Update Profile</h2>
				<div class="form-group">
					<label>Full Name</label>
					<input id="upName" class="form-control" type="text" name="name"/>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input id="upEmail" class="form-control" type="text" name="email"/>
				</div>
				<div class="form-group">
					<label>New Password</label>
					<input id="upPass" placeholder="Optional" class="form-control" type="password" name="password"/>
				</div>
				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="Update"/>
				</div>
			</form>
		</div>

		<section>
      <div class="container">
        <nav id="admin_nav">
          <ul>
            <li><a href="panel.php">Home</a></li>
            <li><a href="addQuestion.php">Add Questions</a></li>
            <li><a href="quesList.php">Question List</a></li>
            <li><a href="subjects.php">Subjects</a></li>
						<li><a href="manageQset.php">Question Set</a></li>
            <li><a href="users.php">Manage Users</a></li>
          </ul>
        </nav>
