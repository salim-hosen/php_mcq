<?php
  require_once "../main.php";
  if(isset($_POST['action']) && $_POST['action'] === "update"){
    $admin->upSubject();
  }

  if(isset($_POST['action']) && $_POST['action'] === "delete"){
    $admin->delSubject();
  }

  if(isset($_POST['action']) && $_POST['action'] === "addSubject"){
    $admin->addSubject();
  }
?>
