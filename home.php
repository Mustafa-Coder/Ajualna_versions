<?php
// session_cache_expire(1440); // This The Chace Time about your session and this 30 value is minute
session_start();
ob_start();
$PAGENAME = "Home | JEEL "  ;
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
$avatar = $Userinfo['avatar'];
$Users = get_something("signup","*"," ","fetchAll"); // get data users
// UPDATE ALL YOUR INFORMATION IN PAGES :::::
updatedata("signup","country","".$countryyou."","WHERE userid = ".$userid.""); // update country in user
updatedata("signup","languages","".$langs."","WHERE userid = ".$userid.""); // update lang in user
updatedata("posts","college_group","".$college."","WHERE userid = ".$userid.""); // update college in posts
updatedata("posts","country","".$countryyou."","WHERE userid = ".$userid.""); // update country in posts
updatedata("comment","avatar","".$avatar."","WHERE i_user = ".$userid.""); // update avatar in comment


// Sen comment to data 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # comment userid postid

    $po  = $_POST['postid'];
    $us = $_POST['userid'];
    $useridpost = $_POST['useridpost'];
    $na = $_POST['names'];
    $ava = $_POST['avatar'];
    $com = $_POST['comment'];
    if(!empty($po) && !empty($us) && !empty($com)):
    // i_post	i_user	mesg	
    $in = "INSERT INTO comment(i_post,i_user,names,avatar,mesg)VALUES(:po,:us,:na,:av,:com)";
    $set = $con->prepare($in);
    $set->bindparam(":po",$po);
    $set->bindparam(":us",$us);
    $set->bindparam(":na",$na);
    $set->bindparam(":av",$ava);
    $set->bindparam(":com",$com);
    $set->execute();
    endif;

    $id = $Userinformation['userid'];
    $desc = filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
    $postid = filter_var($po);
    $typenotif = "comment";
    $seen = 0;
    $date = new DateTime(); // Date now 
    $setDatenow = $date->format("D : M j Y  - h:i:s A"); // this is formater namedat month hour,....
    $boxdate = $setDatenow;
     // Notification System Upload:     
    $notif = "INSERT INTO notifications(u_id,for_id,title,typenotfi_id,typenotif,seen,`times`)
                VALUES(:userid,:for,:descrp,:typenotfi_id,:ti,:se,:tim)";
    $notification = $con->prepare($notif);
    $notification->bindparam(":userid",$id);
    $notification->bindparam(":for",$useridpost);
    $notification->bindparam(":descrp",$desc);
    $notification->bindparam(":typenotfi_id",$postid);
    $notification->bindparam(":ti",$typenotif);
    $notification->bindparam(":se",$seen);
    $notification->bindparam(":tim",$boxdate);
    $notification->execute();
    $count = $notification->rowcount();
   
}


// $postOne = get_something_also("posts","userid");
?>
<!-- START INCLUDE MENU -->
<?php include $source . '/templates/menu.php' ?>
<!-- END INCLUDE MENU -->
<!-- End CHECK IF THE COLLEGE ECOLE COLLEGE HIM -->
<!-- START PAGE HTML -->
<body class="<?php echo $Userinformation['modes'] == 'dark'  ? "top" : " " ?>">

<div class="container homeglobal mt-5">
    <div class="row mt-5">
        <!-- START SLIDE LEFT  IN HOME PAGE  -->
        <div class="col-lg-3">
            <div class="card user-info border-0 mt-5 <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?> ">
                <div class="avatar">
                    <?php if(empty($Userinfo['avatar'])): ?>
                        <div class="name"><?php echo strtoupper(substr($Userinfo['username'],0,1)); ?></div>
                    <?php else: ?>
                        <?php if($Userinformation['active'] == 1): ?>
                            <span></span>
                            <?php endif; ?>
                        <img src="./u/uploads/avatar/<?php echo $Userinfo['avatar']; ?>" alt="">
                    <?php endif; ?>
                </div>
                <div class="info">
                    <h1><?php echo strtolower($Userinfo['username']); ?></h1>
                    <?php $pagecollege = get_something("pages","*","WHERE pageid = ".$Userinfo['college']."","fetch"); // get page id you  Links($link = null,$underscor = null)?>
                    <p><?php echo !empty($pagecollege['pagename']) ? "<i class='fas fa-university'></i> " . '<a href="pages.php?pageid='.$pagecollege['pageid'].'&page=Home_me" title="'.$pagecollege['pagename'].'">'. substr($pagecollege['pagename'],0,15) .'...</a>' : "<i class='fas fa-university'></i> No College Here !" ?></p>
                </div>
            </div>
            
            <!-- SHECK IF THE USERNAME COLLEGE EQUEL SAME COLLEGE -->
            <div class="card user-info border-0 mt-2 user-info-college p-3  <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?> ">
                    <h2><?php  echo lang("stu_tra") ?> <?php  echo !empty($pagesforyou['pageid']) ?  Counter_All("signup","*","WHERE college = ".$pagesforyou['pageid']."") > 9 ? '<a href="#">+ more</a>' : '' : ' ' ?> </h2>
                    <br>
                    <?php foreach ($usercollege as $collegme) { ?>
                         <?php if($collegme??['college'] == $pagesforyou['pageid'] && $collegme['userid'] != $_SESSION['id']): ?>
                            <?php if($collegme['college'] != 0 && $collegme['userid'] != $_SESSION['id'] /*& $Userinformation['country'] == $collegme['country']*/  ): ?>
                            <div class="person">
                                <div class="avatar">
                                    <?php if(empty($collegme['avatar'])): ?>
                                        <div class="name"><?php echo strtoupper(substr($collegme['username'],0,1)); ?></div>
                                    <?php else: ?>
                                       <?php foreach($Users as $active):  ?>
                                        <?php if($active['active'] == 1 && $collegme['userid'] == $active['userid']): ?>
                                            <span></span>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <img src="./u/uploads/avatar/<?php echo $collegme['avatar']; ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="info">
                                    <h1><?php echo strtolower($collegme['username']); ?></h1>
                                    <p>@ <?php echo strtolower($collegme['lastname']); ?> </p>
                                    <?php $pageme = get_something("pages","*","WHERE pageid = ".$collegme['college']."","fetch"); // get page id you ?>
                                    <!-- <?php if(!empty($pageme['pagename'])):  ?>
                                         <?php if($pageme['pagename'] > 25):  ?>
                                        <p><?php echo !empty($pageme['pagename']) ? "<i class='fas fa-university'></i> " . '<a href="pages.php?pageid='. $collegme['college'].'" title="'.$pageme['pagename'] .'">'. substr($pageme['pagename'] ,0,15).'...</a>' : "<i class='fas fa-university'></i> No College Here !" ?></p>
                                        <?php else: ?>
                                            <p><?php echo !empty($pageme['pagename']) ? "<i class='fas fa-university'></i> " . '<a href="pages.php?pageid='.$collegme['college'].'" title="'.$pageme['pagename'] .'">'.$pageme['pagename'].'</a>' : "<i class='fas fa-university'></i> No College Here !" ?></p>
                                        <?php endif; ?> -->
                                    <!-- <?php else: ?> -->
                                        <!-- <p><i class='fas fa-university'></i> Select Your university</p> -->
                                   <!-- <?php endif; ?>  -->
                                </div>
                            </div>
                        
                             <!-- <p class="Mesgcollege"><i class='fas fa-university'></i>  There is no one in your college</p> -->
                            <?php endif; ?>

                        <?php endif; ?>
                    <?php  } ?>

              
            </div>
            <!-- end  -->

        </div>
        <!-- END SLIDE LEFT  IN HOME PAGE  -->
        <!-- START SYSTEM POST  -->
        <div class="col-lg-6">
        <?php if(!empty($Userinfo['avatar'])): ?>
            <div class="card postsystem border-0 mt-5 p-3 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">
                <textarea class="form-control <?php echo $Userinfo['modes'] == 'dark'  ? "input-text" : " " ?>"  id="description" placeholder="type.."></textarea>
                 <input id="name" type="hidden" value="<?php echo $Userinfo['username']; ?>">
                 <input id="college" type="hidden" value="<?php echo $Userinfo['college']; ?>">
                 <input id="country" type="hidden" value="<?php echo $Userinfo['country']; ?>">
                 <input id="photo" type="hidden" value="<?php echo $Userinfo['avatar']; ?>">
                 <div class="control d-flex" style="position:relative">
                    <button id="postbtn" class="btn btn-primary">Post</button>
                    <select class="form-control form-control-sm <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>" style="width:150px;position: absolute;right: 10px;top: 18px;" id="private">
                        <option value="public"> Public</option>
                        <option value="me only">Me only</option>
                    </select>
                 </div>
               
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
                <div id="showposts">
                </div>
            </div>
<!-- <input id="useridpost" type="hidden" value="<?php echo $_POST['postid']; ?>"> -->

            <!-- END SHOW POSTS ALL  -->
            
        </div>
        <!-- END SYSYTEM POST -->
        <!-- Details Profile  SYSYTEM -->
        <div class="col-lg-3">
           <div class="notecreate card mt-5 p-1 border-0 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?> ">
                <div class="all">
                    <img src="./layout/images/icons/1f4d1.png "  alt="Notes">
                    <div class="newnotes">
                    <a href="./notepad/index.php">Create New Note</a>
                    </div>
                </div>
           </div>
           <div class="notecreate card mt-2 p-1 border-0 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?> ">
                <div class="all">
                    <img src="./layout/images/icons/1f4e5.png "  alt="Notes">
                    <div class="newnotes">
                    <a href="./notepad/main.php">See All Your  Note <span><?php echo Counter_All("mynotepad","id","WHERE author_id = ".$userid.""); ?></span></a>
                    </div>
                </div>
            
           </div>
           <?php if ($Userinformation['work'] == 'teacher'): ?>
           <!-- Create New Page -->
           <div class="notecreate card mt-2 p-1 border-0 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?> ">
                <div class="all">
                    <img src="./layout/images/icons/1f4e2.png"  alt="pages">
                    <div class="newnotes">
                    <a id="createpages" style="cursor:pointer;">Create New Page</a>
                    </div>
                </div>
           </div>
           <div class="notecreate card mt-2 p-1 border-0 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?> ">
                <!-- START SHOW PAGES  -->
                    <a class="py-2 ml-2"><?php  echo lang("col_tar") ?></a>
                        <!-- show pagename -->
                            <ul id="pages" style="    margin-left: -23px;">
                                <?php foreach($pagesall as $pa): ?>
                                    <?php if($pa['pagecover'] != null ): ?>
                                        <li class="newcollege mt-3"> <img class="rounded-circle" src="./u/uploads/cover/<?php echo $pa['pagecover']; ?>" alt="<?php echo $pa['pagecover']; ?>" /> <a style=" color: rgb(139, 142, 159);" href="pages.php?pageid=<?php echo $pa['pageid']; ?>&page=Home_me"><?php echo $pa['pagename']; ?></a></li>
                                    <?php else: ?>
                                        <li class="newcollege mt-3"> <img class="rounded-circle" src="./layout/images/icons/011.png" /> <a style=" color: rgb(139, 142, 159);" href="pages.php?pageid=<?php echo $pa['pageid']; ?>&page=Home_me"><?php echo $pa['pagename']; ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <!-- end -->
                <!-- END SHOW PAGES  -->
           </div>
           <?php endif; ?>
           <!-- START ACCESS DATA  -->
           <?php if(empty($Userinfo['avatar'])   or  empty($Userinfo['numberphone']) or empty($Userinfo['nationalNum']) ): ?>
             <h5 class="setuptext mb-0 mt-2 <?php echo $Userinfo['modes'] == 'dark'  ? "text-light" : " " ?>">Setup up</h5>
             <div class="checkdata card border-0 p-1 mt-2 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark shadows" : " " ?>">
                <ul>
                
                 <?php echo $Userinfo['avatar'] == '' ? "<li><i class='fas fa-false icons errros'></i>  Picture</li>" :"<li><i class='fas fa-check icons trues'></i> Picture Done</li>" ?>
                 <li><?php echo $Userinfo['college'] == 0 ? "<li><i class='fas fa-false icons errros'></i> college</li>" :"<li><i class='fas fa-check icons trues'></i>College Done</li>" ?></li>
                 <li><?php echo $Userinfo['numberphone'] == '' ? "<li><i class='fas fa-false icons errros'></i>  Phone</li>" :"<li><i class='fas fa-check icons trues'></i>phone Done</li>" ?></li>
                 <li><?php echo $Userinfo['nationalNum'] == '' ? "<li><i class='fas fa-false icons errros'></i>  national number</li>" :"<li><i class='fas fa-check icons trues'></i>number Done</li>" ?></li>
                </ul>
                 
             </div>
             <?php endif; ?>
            <!-- END ACCESS DATA  -->
        </div>
        
    <!-- MODALDATA -->
    <div class="animated" id="text"></div>
    <div id="messagecard" class="card border-0 messagecard">You Don't Have Any Post !</div>
    <!-- MODAL CREATE PAGES  pagename titlepage cpage -->
    <div id="modalpage" class="overlay-pages animated shakeX " style="<?php echo $Userinfo['modes'] == 'dark'  ? "background: rgba(42, 42, 72, 0.53) !important;" : " " ?>">
      <div class="card p-3 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">
        <i class="fas fa-university"></i>
        <div class="row">
          <div class="col-md-6">
            <input id="pagename" class="form-control mb-3 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>" type="text" placeholder="Name Page">
          </div>
          <div class="col-md-6">
            <input id="titlepage" class="form-control mb-3 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>" type="text" placeholder="Bio">
          </div>
          <div class="col-md-6">
            <select class="form-control <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>" id="cpage">
              <?php include 'data/fetch_country.php'; ?>
            </select>
          </div>
          <div class="col-md-6">
            <button class="btn btn-primary" type="button" id="buttoncreate">Create</button>
            <button class="btn btn-light" type="" id="hidemodalcreate">Close</button>

          </div>
        </div>
      </div>
    </div>
    <!-- END MODAL CREATE PAGES -->
</div>
<!-- END PAGE HTML -->
<!-- ######################################################################## -->
<?php
 include $source . '/templates/footer.php';
  ?>
