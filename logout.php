<?php
include "./init.php"; 
session_start();

$staus_online = 0;
$id = $_SESSION['id'];

$notac = "UPDATE signup SET active = :notactive WHERE userid = :id ";
$set = $con->prepare($notac);
$set->bindparam(":notactive",$staus_online);
$set->bindparam(":id",$id);
$set->execute();

session_unset();
session_destroy();
header('location:login.php');
exit;