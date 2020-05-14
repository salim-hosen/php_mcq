<?php
// Get Question Set using jquery
require_once "../main.php";
if(isset($_POST['action']) && $_POST['action'] === "getQset"){
  $res = $ques->getQset($_POST['subId']);
  $html = $ques->getHtml($res);
  echo $html;
  exit();
}

if(isset($_POST['action']) && $_POST['action'] === "getQsetAdm"){
  $res = $ques->getQset($_POST['subId']);
  $html = $admin->getQsetHtml($res);
  echo $html;
  exit();
}

if(isset($_POST['action']) && $_POST['action'] === "getQuesSet"){
  $res = $ques->getQset($_POST['subId']);
  $html = $admin->makeQsetHtml($res);
  echo $html;
  exit();
}

if(isset($_POST['action']) && $_POST['action'] === "upQset"){
  $admin->updateQset();
}

if(isset($_POST['action']) && $_POST['action'] === "delQset"){
  $admin->deleteQset();
  $res = $ques->getQset($_POST['subId']);
  $html = "<tr><td>";
  $html .= $admin->makeQsetHtml($res);
  $html .= "</td></tr>";
  echo $html;
  exit();
}
?>
