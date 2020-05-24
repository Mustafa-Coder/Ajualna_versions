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
$pagesforall = get_something_also("pages","*","WHERE userid = $userid "); // get all pages
$comment = get_something_also("comment","*"); // get all comments 
$liker = get_something("liker","*","WHERE liker_id = ".$Userinfo['userid']."","fetch"); // get page id you
$pages = get_something("pages","*"," ","fetchAll");
$supportbox = get_something("supportbox","*"," ","fetchAll");
$supportboxperson = get_something("supportbox","*"," ","fetch");
switch($req) {
    case 'getposts': // POST PUBLIC

       

            $collegeuserid = $Userinfo['college'];
            $country = $Userinfo['country'];
            // STATMENT
        //    get_something("posts","*","WHERE userid = ".$id." ORDER BY postid DESC ","fetchAll");

                // if ($countsomething > 0) {
                //     echo 'Done';
                // }else {
                //     echagesrong';
                // }

                $stamt = "SELECT * FROM posts WHERE college_group = :usercollegeid AND country = :coun  ORDER BY postid DESC ";
                $set_Stamt = $con->prepare($stamt);
                $set_Stamt->bindparam(":usercollegeid",$collegeuserid);
                $set_Stamt->bindparam(":coun",$country);
                $set_Stamt->execute();
                $posts = array() ;
                while ($query = $set_Stamt->fetch()) {
                    array_push($posts,$query);
                }


                // CHECK IF DATA = SAME DATA
                if($pagesforyou??['userid'] == $_SESSION['id']):
                    if($pagesforyou??['avatar'] != $Userinfo['avatar']):
                        $UP = "UPDATE posts SET avatar = :avatarforyou WHERE userid = :id ";
                        $SET_UP = $con->prepare($UP);
                        $SET_UP->bindparam(":avatarforyou",$Userinfo['avatar']);
                        $SET_UP->bindparam(":id",$userid);
                        $SET_UP->execute();
                        $count = $SET_UP->rowcount();
                        if($count > 0):
                            include './session_users.php';
                        endif;
                    endif;
                endif;

                // Stat get id liker 

            

                ?>

                <!-- START SHOW POST  -->
                <?php foreach ($posts as $post) { ?>
                    <?php if($post['private'] == 'public' && $post['private'] != 'me only' && !empty($post['private'])): ?>
                    <div class="postshow card border-0  <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">
                        <div class="avatar">
                        <?php foreach($Users as $user):  ?>
                                <?php if($user['active'] == 1 && $post['userid'] == $user['userid']): ?>
                                    <span class="active2"></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php echo empty($post['avatar']) ? '<img class="img-fiuld rounded-circle" src="./layout/images/icons/011.png" alt="">' : '<img class="img-fiuld rounded-circle" src="./u/uploads/avatar/'.$post['avatar'].'" alt="">' ?>
                            <h2 class="py-1"><?php echo $post['username'] ?></h2>
                            <span class="timespan"><?php echo $post['datetime'] ?></span>
                            <!-- <input class="postid" type="hidden" value=""> -->
                            <a href="posts/index.php?postid=<?php echo $post['postid'] ?>&user=<?php echo $post['userid'] ?>"><i class="fas fa-ellipsis-h"></i></a>
                        </div>
                         <!-- Set modal Edit post -->
                       
                            <!-- end  -->
                        <div class="info-user">
                            <p class="desc">
                            <?php echo $post['description'] ?>
                           
                            <?php // if ($post['college_group'] == $Userinfo['college']) {
                                ?>
                                <!-- Report message -->
                                <?php foreach($supportbox as $support): ?>
                                    <?php if($support['For_something'] == $post['postid'] && $post['userid'] == $_SESSION['id']): ?>
                                        <p class="text-danger " style="margin-top: 12px;font-size:13px;"><?php echo $support['username'] ?> Report Your Post <i class="fa fa-bug"></i> </p>
                                    <?php endif; ?>
                                <?php endforeach;?>
                                <!-- end rebort message  -->
                            </p>
                        </div>
                        <hr>
                        <!-- LIKE COMMUNT SHARE SYSTEM -->
                        
                        <ul class="lcs ">
                                <a href="posts/index.php?postid=<?php echo $post['postid'] ?>&user=<?php echo $post['userid'] ?>"><li  class="like" ><i class="fas fa-thumbs-up <?php echo $Userinfo['modes'] == 'dark'  ? "icons-co" : " " ?>"></i> <?php echo Counter_All("liker WHERE like_id = ".$post['postid']." ","*"); ?> </li></a>
                            <li id="commentspage"><i class="fas fa-comment commentpost commentspage <?php echo $Userinfo['modes'] == 'dark'  ? "icons-co" : " " ?>"></i>  <?php echo Counter_All("comment WHERE i_post = ".$post['postid']." ","*"); ?></li>
                            <li><i class="fas fa-share-alt <?php echo $Userinfo['modes'] == 'dark'  ? "icons-co" : " " ?>"></i> </li>
                        </ul>
                        <?php foreach($comment as $com): ?>
                        <?php if($com['i_post'] == $post['postid']): ?>
                        <!-- comment style -->
                        <div id="commentuser" class="commetnbook <?php echo $Userinfo['modes'] == 'dark'  ? "border-s" : " " ?>"> 
                          <!-- User information  -->
                         <div class="inforuser">
                            <div class="avatar">
                            <?php foreach($Users as $user):  ?>
                                <?php if($user['active'] == 1 && $com['i_user'] == $user['userid']): ?>
                                    <span class="active"></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                                <img class="rounded-cricle" src="./u/uploads/avatar/<?php echo $com['avatar'] ?>" alt="<?php echo $com['names'] ?>">
                            </div>
                            <div class="infor">
                                <h2><?php echo $com['names']; ?></h2>
                            </div>
                         </div>
                          <!-- end  --> 
                          <div class="inputs  <?php echo $Userinfo['modes'] == 'dark'  ? "input-loop" : " " ?>">  
                            <p  class="form-control ucomments <?php echo $Userinfo['modes'] == 'dark'  ? "input-loop" : " " ?> "><?php echo $com['mesg'] ?></p>
                          </div>
                        </div>
                          <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if(!empty($Userinfo['avatar'])): ?>
                        <!-- comment style -->
                        <div id="commentuser" class="commetnbook <?php echo $Userinfo['modes'] == 'dark'  ? "border-s" : " " ?>"> 
                          <!-- User information  -->
                         <div class="inforuser">
                            <div class="avatar">
                            <?php if($Userinfo['active'] == 1): ?>
                            <span class="active"></span>
                            <?php endif; ?>
                                <img class="rounded-cricle" src="<?php echo !empty($Userinfo['avatar']) ? "./u/uploads/avatar/".$Userinfo['avatar']."" : "./layout/images/icons/011.png" ?>"  alt="<?php echo $Userinfo['username'] ?>">
                            </div>
                            <div class="infor">
                                <!-- <h2><?php echo $Userinfo['username'];  ?></h2> -->
                            </div>
                         </div>
                          <!-- end  --> 
                          <div class="inputs"> 
                          
                          <!-- Report message -->
                                
                            <!-- <?php  if($supportboxperson['For_something'] != $post['postid'] ): ?> -->
                                <!-- end rebort message  --> 
                          <form method="post" action="http://localhost/Ajualna/home.php">
                            <input name="comment" class="form-control ucomment <?php echo $Userinfo['modes'] == 'dark'  ? "input-user " : " " ?>" type="text" placeholder="comment..<?php echo $Userinfo['username']; ?>">
                            <input name="names" type="hidden" value="<?php echo $Userinfo['username'] ?>">
                            <input name="avatar" type="hidden" value="<?php echo $Userinfo['avatar'] ?>">
                            <input name="userid" type="hidden" value="<?php echo $Userinfo['userid'] ?>">
                            <input name="postid" type="hidden" value="<?php echo $post['postid'] ?>">
                            <input id="submit" type="submit" hidden >
                            <button name="btnsendcomment" class="btn btn-light btn-sm btnsendcomment <?php echo $Userinfo['modes'] == 'dark'  ? "btn-dark-color " : " " ?>"><i class="fas fa-paper-plane"></i></button>
                          </form>
                            <!-- <?php  endif; ?> -->
                          </div>
                        </div>
                          <?php endif; ?>
                        
                    </div>

                          <?php endif; ?>
                <?php } ?>
                <!-- end  -->
                
                <p class="copyright">  Ajualna &copy; <?php echo date("Y"); ?>  </p>




            <!-- END SHOW POST  -->
        <?php
        ?>
        
        
        
        <?php                 
        break; // END POST PUBLIC PAGE
        // Get all data about pages
        case 'getpostspage': // POST PUBLIC


            $page = $_POST['namepage'];



                $stamt = "SELECT * FROM postpublic WHERE pagename = :pagename ORDER BY postid DESC ";
                $set_Stamt = $con->prepare($stamt);
                $set_Stamt->bindparam(":pagename",$page);
                $set_Stamt->execute();
                $posts = array() ;
                while ($query = $set_Stamt->fetch()) {

                    array_push($posts,$query);
                }

                // $select = "SELECT * FROM postpublic WHERE pagename = :pagename ";
                // $getapages = $con->prepare($select);
                // $getapages->bindparam(":pagename",$page);
                // $getapages->execute();
                // $pages = $getapages->fetch(PDO::FETCH_ASSOC);

                // // CHECK IF DATA = SAME DATA
                // if($pagesforyou??['userid'] == $_SESSION['id']):
                //     if($pagesforyou??['avatar'] != $Userinfo['avatar']):
                //         $UP = "UPDATE posts SET avatar = :avatarforyou WHERE userid = :id ";
                //         $SET_UP = $con->prepare($UP);
                //         $SET_UP->bindparam(":avatarforyou",$Userinfo['avatar']);
                //         $SET_UP->bindparam(":id",$userid);
                //         $SET_UP->execute();
                //         $count = $SET_UP->rowcount();
                //         if($count > 0):
                //             include './session_users.php';
                //         endif;
                //     endif;
                // endif;

                ?>

                <!-- START SHOW POST  -->
                <?php foreach ($posts as $post) { ?>

                    <div class="postshow card border-0 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">
                        <div class="avatar">
                            <?php echo empty($post['avatar']) ? '<img class="img-fiuld rounded-circle" src="./layout/images/icons/011.png" alt="">' : '<img class="img-fiuld rounded-circle" src="./u/uploads/avatar/'.$post['avatar'].'" alt="">' ?>
                            <h2 class="py-1"><?php echo $post['titlename'] . " > " ?><?php echo substr($post['pagename'],0,40) ?>...</h2>
                            <!-- <span class="timespan"><?php echo $post['datetime'] ?></span> -->
                            <!-- <input class="postid" type="hidden" value=""> -->
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                        <div class="info-user">
                            <p class="desc">
                            <?php echo $post['description'] ?>
                            </p>
                        </div>
                        <hr>
                        <!-- LIKE COMMUNT SHARE SYSTEM -->
                        <ul class="lcs <?php echo $Userinfo['modes'] == 'dark'  ? "icons-co" : " " ?>">
                            <li  class="like" value="<?php echo $post['postid'] ?>"><i class="fas fa-thumbs-up"></i> <?php // echo $liker; ?> Like</li>
                            <li><i class="fas fa-comment"></i> Comment</li>
                            <li><i class="fas fa-share-alt"></i> Share</li>
                        </ul>
                    </div>
                    <?php if($page != $post['pagename']): ?>

                        <div class="alert alert-info p-2">No posts in <strong> <?php echo $page ?></strong></div>
                    <?php endif; ?>
                <?php } ?>





                    <p class="copyright">  JEEL &copy; <?php echo date("Y"); ?>  </p>



            <!-- END SHOW POST  -->
        <?php



        break; // END POST PUBLIC PAGE
        case 'getpages':
          foreach ($pagesinfo as $pageadmin)
          {
            echo ' <li><a href="pages.php?pageid='.$pageadmin['pageid'].'&page=Home_me"><i class="fas fa-university"></i> '. $pageadmin['pagename'] .'</a></li>';
          }
          break;
        /// Fetch All notification 
        case 'getNotification': 

          $get_notification = get_something("notifications","*","WHERE pagesname = ".$college_session." ORDER BY id DESC ","fetchAll"); // get data users
          $get_notification_id = get_something("notifications","u_id","WHERE u_id = ".$userid."","fetch"); // get data users


?>
            

       <?php  foreach ($get_notification as $value) { ?>
        <?php if($value['pagesname'] == $Userinfo['college']): ?>
            <?php
                $select = "SELECT *  FROM signup WHERE userid = :userid ";
                $notif = $con->prepare($select);
                $notif->bindparam(":userid",$value['u_id']);
                $notif->execute();
                $rowdata = $notif->fetch();
            ?>
        <div class="info">
            <div class="avatar">
            <img src="./u/uploads/avatar/<?php echo $rowdata['avatar']; ?>" alt="">
            </div>
            <div class="user">
                <h2 class="username"> <?php echo $rowdata['username'] . " " .  $rowdata['lastname']  ?> <!-- > <a href="#"><?php echo $pagesforyou["pagename"] ?></a>--></h2>
                <p class="time"><i class="fas fa-clock"></i><?php echo $value['times'] ?></p>
                <?php if($value['typenotif'] == 'comment'): ?>
                    <p class="desc">
                         <img class="dotoimg" src="./layout/images/icons/1f5e8.png" alt="icons">  <?php echo $rowdata['username'] ?> <?php echo $_SESSION['id'] == $value['u_id'] ? 'your' : ' ' ?>  comment   <?php  echo  substr($value['title'],0,65) . "..." ?>
                    </p>
                <?php endif;?>
                <?php if($value['typenotif'] == 'post'): ?>
                    <p class="desc">
                     <img class="dotoimg" src="./layout/images/icons/1f4f0.png" alt="icons">   <?php echo $_SESSION['id'] == $value['u_id'] ? 'your' : ' '  ?> Post: <?php  echo  substr($value['title'],0,65) . "..." ?> -->
                    </p>
                <?php endif;?>
                <?php if($value['typenotif'] == 'updatePost'): ?>
                    <p class="desc">
                         <img class="dotoimg" src="./layout/images/icons/1f4e4.png" alt="icons">   <?php echo $_SESSION['id'] == $value['u_id'] ? 'your ' : ' '  ?>Update Post: <?php  echo  substr($value['title'],0,65) . "..." ?> -->
                    </p>
                <?php endif;?>
            </div>
        </div>
        <?php endif; ?>
        <?php  }  ?>
                
        <?php break;
}


endif; // end =====================================
?>
<script>
    
</script>