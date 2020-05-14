<?php
// Login
require_once "../main.php";

if(isset($_POST['action']) && $_POST['action'] === "getQuestion"){
  $admin->getEditQuestion();
}

if(isset($_POST['action']) && $_POST['action'] === "upQues"){
  $admin->updateQuestion();
}

?>
