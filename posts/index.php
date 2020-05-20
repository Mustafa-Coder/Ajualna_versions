<?php 
session_start();
$PAGENAME = "PAGES | AJUALNA  ";
include 'init.php';
if(!isset($_SESSION['user'])):
    header("location:logout.php");
    exit;
endif;
?>
<!-- -------------------------------------------------------------------------- -->

<!-- ALL FUNCTION DATA  -->
<!-- FUNCTION GET TO USER INFORMATION -->
<!-- Global id -->
<input id="userid" type="hidden" value="<?php echo $_SESSION['id']; ?>">
<?php $userid = $_SESSION['id']; ?>
<?php 

$Userinfo = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
$Userinformation = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
$pagesinfo = get_something("pages","*","WHERE pageid = ".$Userinfo['college']." ","fetch"); 
$college_session = $_SESSION['college']; // college sesiion 
$pagesforyou = get_something("pages","*","WHERE pageid = ".$_GET['pageid']."","fetch"); // get page id you
$pagesforall = get_something("pages","*","WHERE pageid = ".$Userinformation['college']."","fetchAll"); // get page id you
$postAll = get_something("posts","*","WHERE userid = ".$userid." ORDER BY postid DESC ","fetchAll");
$usercollege = get_something("signup","*","WHERE college = ".$Userinfo['college']."","fetchAll"); // Get users colleges
$posts = get_something("posts","*","WHERE userid = ".$userid."","fetch");

?>
<!-- START INCLUDE MENU -->
<?php include $source . '/templates/menu.php' ?>
<!-- END INCLUDE MENU -->
<!-- CHECK IF THIS PAGE ID NUMERIC OR NOT  -->
<?php $namepage = filter_var($_GET['ps'],FILTER_SANITIZE_STRING); ?>
<?php 
// if var number
if(is_numeric($numberpage) & $numberpage == $pagesinfo['pageid']):
// START CODE SWITCH ...
echo $pagesinfo['pageid'];
switch ($namepage) {
    case 'Home_me': ?>

        sssssssssssssssssssssssss
   
       <?php break;
   
}

endif;
?>
<!-- End CHECK IF THE COLLEGE ECOLE COLLEGE HIM -->
<!-- ------------------------------------------------------------------------- -->
<?php // include $source . '/templates/footer.php' ?>
<script src="/Ajualna/layout/js/all.min.js"></script>
<script src="/Ajualna/layout/js/jquery.min.js"></script>
