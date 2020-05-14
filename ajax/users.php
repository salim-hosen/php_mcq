<?php
// Login
require_once "../main.php";

if(isset($_POST['action']) && $_POST['action'] === "enable"){
  $admin->userStatus($_POST['action']);
}else if(isset($_POST['action']) && $_POST['action'] === "disable"){
  $admin->userStatus($_POST['action']);
}else if(isset($_POST['action']) && $_POST['action'] === "delUser"){
  $admin->userStatus($_POST['action']);
}

if($_POST['action'] === "getUserHtml"){
  $admin->getUserHtml();
}

?>
