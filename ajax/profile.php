<?php
// Login
require_once "../main.php";

if(isset($_POST['action']) && $_POST['action'] === "getProfile"){
  $admin->getProfile();
}

if(isset($_POST['action']) && $_POST['action'] === "upProfile"){
  $admin->updateProfile();
}


?>
