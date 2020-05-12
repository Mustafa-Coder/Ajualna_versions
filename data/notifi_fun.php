<?php 
session_start();
include '../config/config.php';
include '../resources/functions/functions.php';
// ------------------------------------------------------
if(isset($_POST['req']) or !empty($_POST['req'])):
// Filter data coming :
$req = filter_var($_POST['req'],FILTER_SANITIZE_STRING);
$req = $_POST['req']; 
$college_session = $_SESSION['college']; // college sesiion 
// FUNCTIONS WEBSITE:::: 
$userid = $_SESSION['id']; // user id 
$Userinfo = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
$pagesforall = get_something("pages","*","WHERE pageid = ".$college_session."","fetch"); // get page id you
$pagesforyou = get_something("pages","*","WHERE pageid = ".$userid."","fetch"); // get page id you
// -------------------------------------------------------------------------------------------------

switch ($req) {
    case 'postnotif': // Notification posts 

        
       
        // STATMENT
        
            // $post_statment = "INSERT INTO postpublic(titlename,`description`,userid)VALUES(:title,:descp,:id)";
            // $poststa = $con->prepare($post_statment);
            // $poststa->bindparam(":title",$title);
            // $poststa->bindparam(":descp",$descp);
            // $poststa->bindparam(":id",$id);
            // $poststa->execute();
            // $count = $poststa->rowcount();

            // if ($count > 0) {
            //     echo 'Create';
            // }else {
            //     echo 'wrong';
            // }
        
    break; // End notification posts
// =======================================================
    default:
        header("location:home.php");
        exit;
        break;
}




endif;