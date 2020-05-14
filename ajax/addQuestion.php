<?php
// Login
require_once "../main.php";
  if(isset($_POST['action']) && $_POST['action'] === "addSingleQues"){
    $ques->addSingleQues();
    exit();
  }

  $admin->insertQuestion();
?>
