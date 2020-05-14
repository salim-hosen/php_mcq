<?php
// Login
require_once "../main.php";
if(isset($_POST['action']) && $_POST['action'] === "login"){
  $userObj->matchLogin();
}
?>
