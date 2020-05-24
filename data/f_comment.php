<?php
session_start();
error_reporting(0);
include '../config/config.php';
include '../resources/functions/functions.php';

if (isset($_POST['req'])):  // if =====================================
$req = $_POST['req'];
$college_session = $_SESSION['college']; // college sesiion
// FUNCTIONS WEBSITE::::
$userid = $_SESSION['id']; // user id
$Users = get_something("signup","*"," ","fetchAll"); // get data users

$Userinfo = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
$pagesforall = get_something("pages","*","WHERE pageid = ".$Userinfo['college']."","fetch"); // get page id you
$pagesforyou = get_something("pages","*","WHERE pageid = ".$Userinfo['college']."","fetch"); // get page id you
// $pagespublic = get_something("pages","*","WHERE pageid = ".$userid."","fetch"); // get pagepublic id you
$pagesinfo = get_something_also("pages","*","WHERE userid = $userid "); // get all pages
$comment = get_something_also("comment","*"); // get all comments 
?>
