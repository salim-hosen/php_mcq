<?php
// Delete Score
require_once "../main.php";
if(isset($_POST['action']) && $_POST['action'] === "delete"){
  $ques->deleteResult();
}

if(isset($_POST['action']) && $_POST['action'] === "delQues"){
  $admin->delQuestion();
}
?>
