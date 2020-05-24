<?php 


$Userinfo = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
$Userinformation = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
$pagesinfo = get_something_also("pages","*","WHERE userid = $userid "); // get all pages
$college_session = $_SESSION['college']; // college sesiion 
$pagesforyou = get_something("pages","*","WHERE pageid = ".$Userinformation['college']."","fetch"); // get page id you
$pagesforall = get_something("pages","*","WHERE pageid = ".$Userinformation['college']."","fetchAll"); // get page id you
$postAll = get_something("posts","*","WHERE userid = ".$userid." ORDER BY postid DESC ","fetchAll");
$pagesall = get_something("pages","*","WHERE userid = ".$userid." ORDER BY pageid DESC ","fetchAll");
$usercollege = get_something("signup","*","WHERE college = ".$Userinfo['college']."","fetchAll"); // Get users colleges
$posts = get_something("posts","*","WHERE userid = ".$userid."","fetch");
?>

