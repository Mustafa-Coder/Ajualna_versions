<?php 
session_cache_expire(1440); // This The Chace Time about your session and this 30 value is minute 
session_start();
$PAGENAME = "Home | AJUALNA "  ;
include 'init.php';
if(!isset($_SESSION['user'])):
    header("location:logout.php");
    exit;
endif;
?>
<!-- -------------------------------------------------------------------------- -->

<!-- Global id -->
<input id="userid" type="hidden" value="<?php echo $_SESSION['id']; ?>">
<?php $userid = $_SESSION['id']; ?>
<!-- ALL FUNCTION DATA  -->
<!-- FUNCTION GET TO USER INFORMATION -->
<?php 

include './data/get_function.php';
// $liker = likesCount("liker_id","liker","WHERE post_id = ". $posts['postid'] ."","fetchcolumn");
// INFORMATION::
$avatardata = $Userinfo['avatar'];
$countryyou = $Userinfo['country'];
$langs = $Userinfo['languages'];
$college = $Userinfo['college'];
// UPDATE ALL YOUR INFORMATION IN PAGES :::::
updatedata("signup","country","".$countryyou."","WHERE userid = ".$userid.""); // update country in user
updatedata("signup","languages","".$langs."","WHERE userid = ".$userid.""); // update lang in user
updatedata("posts","college_group","".$college."","WHERE userid = ".$userid.""); // update college in posts
updatedata("posts","country","".$countryyou."","WHERE userid = ".$userid.""); // update country in posts

// $postOne = get_something_also("posts","userid");
?>
<!-- START INCLUDE MENU -->
<?php include $source . '/templates/menu.php' ?>
<!-- END INCLUDE MENU -->
<!-- End CHECK IF THE COLLEGE ECOLE COLLEGE HIM -->
<!-- START PAGE HTML -->
<div class="container homeglobal mt-5">
    <div class="row mt-5">
        <!-- START SLIDE LEFT  IN HOME PAGE  -->
        <div class="col-lg-3">
            <div class="card user-info border-0 mt-5">
                <div class="avatar">
                    <?php if(empty($Userinfo['avatar'])): ?>
                        <div class="name"><?php echo strtoupper(substr($Userinfo['username'],0,1)); ?></div>
                    <?php else: ?>
                        <img src="./u/uploads/avatar/<?php echo $Userinfo['avatar']; ?>" alt="">
                    <?php endif; ?>
                </div>
                <div class="info">
                    <h1><?php echo strtolower($Userinfo['username']); ?></h1>
                    <?php $pagecollege = get_something("pages","*","WHERE pageid = ".$Userinfo['college']."","fetch"); // get page id you  Links($link = null,$underscor = null)?>  
                    <p><?php echo !empty($pagecollege['pagename']) ? "<i class='fas fa-university'></i> " . '<a href="pages.php?pageid='.$pagecollege['pageid'].'&page=Home_me" title="'.$pagecollege['pagename'].'">'. substr($pagecollege['pagename'],0,15) .'...</a>' : "<i class='fas fa-university'></i> No College Here !" ?></p>
                </div>
            </div>
            <?php if($Userinfo['admin'] == 1): ?>
                <!-- START SHOW PAGES  -->
                <div class="card college-pages border-0 mt-2 p-2">
                    <h2 class="py-2"><?php  echo lang("col_tar") ?></h2>
                        <ul class="mt-5">
                        <?php foreach ($pagesinfo as $pageadmin) { echo ' <li><a href="pages.php?pageid='.$pageadmin['pageid'].'&page=Home_me"><i class="fas fa-university"></i> '. $pageadmin['pagename'] .'</a></li>';}?>
                        </ul>
                </div>
                <!-- END SHOW PAGES  -->
            <?php endif; ?>

        </div>
        <!-- END SLIDE LEFT  IN HOME PAGE  -->
        <!-- START SYSTEM POST  -->
        <div class="col-lg-6">
        <?php if(!empty($Userinfo['avatar'])): ?>
            <div class="card postsystem border-0 mt-5 p-3"> 
                <textarea class="form-control"  id="description" placeholder="type.."></textarea>
                 <input id="name" type="hidden" value="<?php echo $Userinfo['username']; ?>">
                 <input id="college" type="hidden" value="<?php echo $Userinfo['college']; ?>">
                 <input id="country" type="hidden" value="<?php echo $Userinfo['country']; ?>">
                 <input id="photo" type="hidden" value="<?php echo $Userinfo['avatar']; ?>">
                <button id="postbtn" class="btn btn-primary">Post</button>
                <audio id="postmusic" src="./resources/media/post.mp3" type="audio/mp3"></audio>
            </div>
        <?php else: ?>
        <div class="box-some alert-primary p-1 mt-5">
            <p class="m-1">Please Finsih From Settings </p>
        </div>
        <?php endif; ?>
        
            <hr> <!-- BETWEEN POST SYSTEM AND SHOW IT  -->
            
            <!-- START SHOW POSTS ALL  -->
            <div class="animated " id="waitingpost">
                <div id="showposts"></div>
            </div>
            <!-- END SHOW POSTS ALL  -->
            <!-- START ACCESS DATA  -->
            <?php if(empty($Userinfo['avatar']) && empty($Userinfo['college']) && empty($Userinfo['numberphone'])  && empty($Userinfo['nationalNum']) ): ?>
             <div class="checkdata card border-0 p-3 mt-3">
                 <i class="far fa-frown-open"></i>
                 <p class="op">Oops!!</p>
                 <p><?php echo $Userinfo['avatar'] == '' ? "<i class='fas fa-images icons'></i> Uploade your photo" :"" ?></p>
                 <p><?php echo $Userinfo['college'] == 0 ? "<i class='fas fa-university icons'></i> Select your college" :"" ?></p>
                 <p><?php echo $Userinfo['numberphone'] == '' ? "<i class='fas fa-phone icons'></i> Uploade your Phone" :"" ?></p>
                 <p><?php echo $Userinfo['nationalNum'] == '' ? "<i class='fas fa-credit-card icons'></i> Uploade your national number" :"" ?></p>
             </div>
             <?php endif; ?>
            <!-- END ACCESS DATA  -->
        </div>
        <!-- END SYSYTEM POST -->
        <div class="col-lg-3">
        <!-- SHECK IF THE USERNAME COLLEGE EQUEL SAME COLLEGE -->
            <div class="card user-info border-0 mt-5 user-info-college p-3 ">
                    <h2><?php  echo lang("stu_tra") ?></h2>
                    <br>
                    <?php foreach ($usercollege as $collegme) { ?>
                         <?php if($collegme??['college'] == $pagesforyou['pageid'] && $collegme['userid'] != $_SESSION['id']): ?>
                            <?php if($collegme['college'] != 0 && $collegme['userid'] != $_SESSION['id'] & $Userinformation['country'] == $collegme['country']  ): ?>
                            <div class="person">
                                <div class="avatar">
                                    <?php if(empty($collegme['avatar'])): ?>
                                        <div class="name"><?php echo strtoupper(substr($collegme['username'],0,1)); ?></div>
                                    <?php else: ?>
                                        <img src="./u/uploads/avatar/<?php echo $collegme['avatar']; ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="info">
                                    <h1><?php echo strtolower($collegme['username']); ?></h1>
                                    <?php $pageme = get_something("pages","*","WHERE pageid = ".$collegme['college']."","fetch"); // get page id you ?>
                                    <?php if($pageme['pagename'] >= 25):  ?>
                                    <p><?php echo !empty($collegme['college']) ? "<i class='fas fa-university'></i> " . '<a href="pages.php?pageid='.$collegme['college'].'" title="'.$pageme['pagename'] .'">'. substr($pageme['pagename'] ,0,15).'...</a>' : "<i class='fas fa-university'></i> No College Here !" ?></p>
                                    <?php else: ?>
                                        <p><?php echo !empty($collegme['college']) ? "<i class='fas fa-university'></i> " . '<a href="pages.php?pageid='.$collegme['college'].'" title="'.$pageme['pagename'] .'">'.$pageme['pagename'].'...</a>' : "<i class='fas fa-university'></i> No College Here !" ?></p>
                                   <?php endif; ?>
                                </div>
                            </div>
                             <!-- <p class="Mesgcollege"><i class='fas fa-university'></i>  There is no one in your college</p> -->
                            <?php endif; ?>
                                   
                        <?php endif; ?>
                    <?php  } ?>

                    
            </div>
        </div>
    </div>
    <!-- MODALDATA -->
    <div class="animated" id="text"></div>
    <div id="messagecard" class="card border-0 messagecard">You Don't Have Any Post !</div>
</div>
<!-- END PAGE HTML -->
<!-- -------------------------------------------------------------------------- -->
<?php include $source . '/templates/footer.php' ?>