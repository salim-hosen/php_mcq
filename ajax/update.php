<?php
// Update profile
require_once "../main.php";
if(isset($_POST['action']) && $_POST['action'] === "update"){
  $userObj->userUpdate();
}
?>
