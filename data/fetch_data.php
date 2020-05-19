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

                $stamt = "SELECT * FROM posts WHERE college_group = :usercollegeid AND country = :coun ORDER BY postid DESC ";
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

                ?>

                <!-- START SHOW POST  -->
                <?php foreach ($posts as $post) { ?>
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
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                         <!-- Set modal Edit post -->
                       
                            <!-- end  -->
                        <div class="info-user">
                            <p class="desc">
                            <?php echo $post['description'] ?>
                            <?php if ($post['college_group'] == $Userinfo['college']) {
                                ?>
                                <?php
                                if ($post['college_group'] != 0 && !empty($post['college_group'])) { ?>
                                    <a href="../pages.php?pageid=<?php echo $pagesforall['pageid']  ; ?>">#<?php echo $pagesforall['pagename']; ?></a>
                                <?php }
                                ?>
                                <?php
                            } ?>
                            </p>
                        </div>
                        <hr>
                        <!-- LIKE COMMUNT SHARE SYSTEM -->
                        <ul class="lcs ">
                            <li  class="like" value="<?php echo $post['postid'] ?>"><i class="fas fa-thumbs-up <?php echo $Userinfo['modes'] == 'dark'  ? "icons-co" : " " ?>"></i> <?php // echo $liker; ?> </li>
                            <li ><i class="fas fa-comment commentpost <?php echo $Userinfo['modes'] == 'dark'  ? "icons-co" : " " ?>"></i>  <?php echo Counter_All("comment WHERE i_post = ".$post['postid']." ","*"); ?></li>
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
                        <!-- comment style -->
                        <div id="commentuser" class="commetnbook <?php echo $Userinfo['modes'] == 'dark'  ? "border-s" : " " ?>"> 
                          <!-- User information  -->
                         <div class="inforuser">
                            <div class="avatar">
                            <?php if($Userinfo['active'] == 1): ?>
                            <span class="active"></span>
                            <?php endif; ?>
                                <img class="rounded-cricle" src="./u/uploads/avatar/<?php echo $Userinfo['avatar'] ?>" alt="<?php echo $Userinfo['username'] ?>">
                            </div>
                            <div class="infor">
                                <h2><?php echo $Userinfo['username'] ?></h2>
                            </div>
                         </div>
                          <!-- end  --> 
                          <div class="inputs">  
                          <form method="post" action="http://localhost/Ajualna/home.php">
                            <input name="comment" class="form-control ucomment <?php echo $Userinfo['modes'] == 'dark'  ? "input-user " : " " ?>" type="text" placeholder="comment..<?php echo $Userinfo['username']; ?>">
                            <input name="names" type="hidden" value="<?php echo $Userinfo['username'] ?>">
                            <input name="avatar" type="hidden" value="<?php echo $Userinfo['avatar'] ?>">
                            <input name="userid" type="hidden" value="<?php echo $Userinfo['userid'] ?>">
                            <input name="postid" type="hidden" value="<?php echo $post['postid'] ?>">
                            <input id="submit" type="submit" hidden >
                            <button name="btnsendcomment" class="btn btn-light btn-sm btnsendcomment <?php echo $Userinfo['modes'] == 'dark'  ? "btn-dark-color " : " " ?>"><i class="fas fa-paper-plane"></i></button>
                          </form>
                          </div>
                        </div>
                        
                    </div>
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

                    <div class="postshow card border-0">
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
                        <ul class="lcs">
                            <li  class="like" value="<?php echo $post['postid'] ?>"><i class="fas fa-thumbs-up"></i> <?php // echo $liker; ?> Like</li>
                            <li><i class="fas fa-comment"></i> Comment</li>
                            <li><i class="fas fa-share-alt"></i> Share</li>
                        </ul>
                    </div>
                    <?php if($page != $post['pagename']): ?>

                        <div class="alert alert-info p-2">No posts in <strong> <?php echo $page ?></strong></div>
                    <?php endif; ?>
                <?php } ?>





                    <p class="copyright">  Ajualna &copy; <?php echo date("Y"); ?>  </p>



            <!-- END SHOW POST  -->
        <?php



        break; // END POST PUBLIC PAGE
        case 'getpages':
          foreach ($pagesinfo as $pageadmin)
          {
            echo ' <li><a href="pages.php?pageid='.$pageadmin['pageid'].'&page=Home_me"><i class="fas fa-university"></i> '. $pageadmin['pagename'] .'</a></li>';
          }
          break;
}


endif; // end =====================================
?>
<script>
    var com = document.getElementById("btnsendcomment"),
        sub = document.getElementById("submit");
    com.onclick = function () {

        sub.click();
    }
</script>