<?php
// Register
require_once "../main.php";
if(isset($_POST['action']) && $_POST['action'] === "register"){
  $userObj->userRegistration();
}
?>
