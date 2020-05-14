<?php
// Cache Controll
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");

// Import Library Files
include "config/config.php";
include "lib/Database.php";
require_once "lib/Session.php";


// Import All Classes
spl_autoload_register(function($file){
  require_once "classes/".$file.".php";
});

// All Objects
$db = new Database();
$valid = new Validate($db);
$userObj = new User($db,$valid);
$ques = new Questions($db,$valid);
$admin = new Admin($db,$valid);



// Calculate results
if(isset($_POST['submit_ans']) && $_POST['submit_ans'] === "Submit"){
  Session::init();
  $mark = $ques->getMarks();
  $_SESSION['qsetId'] = $_POST['qsetId'];
  $_SESSION['mark'] = $mark;
  header("Location: complete.php");
}

?>
