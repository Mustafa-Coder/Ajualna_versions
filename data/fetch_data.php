<?php 
session_start();
include '../config/config.php';
include '../resources/functions/functions.php';

if (isset($_POST['req'])):  // if =====================================
$req = $_POST['req']; 
$college_session = $_SESSION['college']; // college sesiion 
// FUNCTIONS WEBSITE:::: 
$userid = $_SESSION['id']; // user id 
$Userinfo = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
$pagesforall = get_something("pages","*","WHERE pageid = ".$Userinfo['college']."","fetch"); // get page id you
$pagesforyou = get_something("pages","*","WHERE pageid = ".$Userinfo['college']."","fetch"); // get page id you
// $pagespublic = get_something("pages","*","WHERE pageid = ".$userid."","fetch"); // get pagepublic id you

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
                    <div class="postshow card border-0"> 
                        <div class="avatar">
                            <?php echo empty($post['avatar']) ? '<img class="img-fiuld rounded-circle" src="./layout/images/icons/011.png" alt="">' : '<img class="img-fiuld rounded-circle" src="./u/uploads/avatar/'.$post['avatar'].'" alt="">' ?>
                            <h2 class="py-1"><?php echo $post['username'] ?></h2>
                            <span class="timespan"><?php echo $post['datetime'] ?></span>
                            <!-- <input class="postid" type="hidden" value=""> -->
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                        <div class="info-user">
                            <p class="desc">
                            <?php echo $post['description'] ?>
                            <?php if ($post['college_group'] == $Userinfo['college']) {
                                ?>
                                <?php
                                if ($post['college_group'] != 0) { ?>
                                    <a href="../pages.php?pageid=<?php echo $pagesforall['pageid']  ; ?>">#<?php echo $pagesforall['pagename']; ?></a>
                                <?php }
                                ?>
                                <?php
                            } ?>
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
                <?php } ?>
                <p class="copyright">  Ajualna &copy; <?php echo date("Y"); ?>  </p>

           
                    
            
            <!-- END SHOW POST  -->
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
    default:
        # code...
        break;
}


endif; // end =====================================