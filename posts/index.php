<?php 
if (version_compare(PHP_VERSION,'7.0.0') >= 0) {

    if (session_status() == PHP_SESSION_NONE) {
        session_start(array(
            'cache_limiter' => 'private',
            'read_and_close' => true,
        ));
    }

    elseif (version_compare(PHP_VERSION,'5.4.0') >= 0) {

        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    else {

        if (session_id() == ' ') {
            session_start();
        }
    }
    
}
// ---------------------
$PAGENAME = " Posts | JEEL "  ;
include '../notepad/include.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../layout/images/logos.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../layout/css/all.min.css">
    <link rel="stylesheet" href="../layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="../layout/css/main.css">
    <link rel="stylesheet" href="../layout/css/animate.css">
    <title><?php title() ?></title>
</head>
<?php
$userid = $_SESSION['id'];
$college_session = $_SESSION['college']; 
$Userinformation = get_something("signup","*","WHERE userid = ".$userid." ","fetch"); // get data users
$Users = get_something("signup","*"," ","fetchAll"); // get data users
$liker = get_something("liker","*"," ","fetch"); // get data users
$comment = get_something_also("comment","*"); // get all comments 
$postsforuser = get_something("posts","*","WHERE postid = ".$_GET['postid']."","fetch"); // get data posts

$stamt = "SELECT * FROM posts WHERE postid = ".$_GET['postid']." ";
$set_Stamt = $con->prepare($stamt);
$set_Stamt->execute();
$post = $set_Stamt->fetch();

if($post['postid'] != $_GET['postid']):
    header("location:./home.php");
    exit;
endif;
    
// Sen update post to data 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $newtext  = filter_var($_POST['postvalue'],FILTER_SANITIZE_STRING);
    $postid = $_GET['postid'];
    $date = new DateTime(); // Date now 
    $setDatenow = $date->format("D : M j Y - h:i:s A"); // this is formater namedat month hour,....
    $boxdate = $setDatenow;
    
    $update = "UPDATE posts SET `description` = :updatetext, `datetime` = :dates WHERE postid = :post";
    $setupdate = $con->prepare($update);
    $setupdate->bindparam(":updatetext",$newtext);
    $setupdate->bindparam(":dates",$boxdate);
    $setupdate->bindparam(":post",$postid);
    $setupdate->execute();

    $id = $Userinformation['userid'];
    $desc = filter_var($_POST['postvalue'],FILTER_SANITIZE_STRING);
    $namepage = filter_var($Userinformation['college']);
    $typenotif = "updatePost";
    $seen = 0;
    $date = new DateTime(); // Date now 
    $setDatenow = $date->format("D : M j Y  - h:i:s A"); // this is formater namedat month hour,....
    $boxdate = $setDatenow;
     // Notification System Upload:     
    $notif = "INSERT INTO notifications(u_id,title,pagesname,typenotif,seen,`times`)
                VALUES(:userid,:descrp,:pn,:ti,:se,:tim)";
    $notification = $con->prepare($notif);
    $notification->bindparam(":userid",$id);
    $notification->bindparam(":descrp",$desc);
    $notification->bindparam(":pn",$namepage);
    $notification->bindparam(":ti",$typenotif);
    $notification->bindparam(":se",$seen);
    $notification->bindparam(":tim",$boxdate);
    $notification->execute();
    $count = $notification->rowcount();
   
}


?>
<body class="<?php echo $Userinformation['modes'] == 'dark'  ? "top" : " " ?>">
<?php include '../resources/templates/menu.php'; // navbar site  ?>
<!-- START CODE ########################################################### -->
<div class="container homeglobal">
    <div class="row">
        <div class="col-lg-12">
        <div class="postshow card border-0  <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>" style="width: 540px;margin: 18% auto;box-shadow: 0 0 10px #101001;">
                <div class="avatar">
                    <?php foreach($Users as $user):  ?>
                        <?php if($user['active'] == 1 && $postsforuser['userid'] == $user['userid']): ?>
                            <span class="active2"></span> 
                        <?php endif; ?>
                    <?php endforeach; ?>
                <img class="img-fiuld rounded-circle" src="../u/uploads/avatar/<?php echo $postsforuser['avatar']; ?>" alt="<?php echo $postsforuser['username']; ?>">                            
                <h2 class="py-1"><?php echo $postsforuser['username'];   ?></h2>
                    <span class="timespan"><?php echo $postsforuser['datetime']; ?></span>
                    <!-- <input class="postid" type="hidden" value=""> -->
                    <i id="ellipsis" class="fas fa-ellipsis-h"></i>
                </div>
                    <!-- Set modal Edit post -->
                    <!-- end  -->
                <div class="info-user">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?postid=<?php echo $_GET['postid'] ?>&user=<?php echo $_GET['user']; ?>">
                    <p id="desc" class="desc">
                    <?php echo $postsforuser['description']; ?>                                                                                              
                    </p>
                    <br>
                    <div id="edit">
                        <input id="btnedit" type="submit" value="Edit" class="btn btn-success" />
                    </div>
                    </form>
                </div>
                <hr>
                <!-- LIKE COMMUNT SHARE SYSTEM -->
                <ul class="lcs ">
                    <!-- <li id="deletelike"  class="like" value="<?php echo $postsforuser['postid'] ?>"><i  style="color:blue !important;" class="fas fa-thumbs-up <?php echo $Userinformation['modes'] == 'dark'  ? "icons-co" : " " ?>"></i> <?php echo Counter_All("liker WHERE like_id = ".$post['postid']." ","*"); ?> </li> -->
                    <li id="liker" class="like" value="<?php echo $postsforuser['postid'] ?>"><i id="setlike" class="fas fa-thumbs-up <?php echo $Userinformation['modes'] == 'dark'  ? "icons-co" : " " ?>"></i> <?php echo Counter_All("liker WHERE like_id = ".$post['postid']." ","*"); ?> </li>
                    <li id="commentspage"><i class="fas fa-comment commentpost commentspage <?php echo $Userinformation['modes'] == 'dark'  ? "icons-co" : " " ?>"></i>  <?php  echo Counter_All("comment WHERE i_post = ".$post['postid']." ","*"); ?></li>
                    <li><i class="fas fa-share-alt <?php echo $Userinformation['modes'] == 'dark'  ? "icons-co" : " " ?>"></i> </li>
                </ul>
                <?php foreach($comment as $com): ?>
                        <?php if($com['i_post'] == $postsforuser['postid']): ?>
                        <!-- comment style -->
                        <div id="commentuser" class="commetnbook <?php echo $postsforuser['modes'] == 'dark'  ? "border-s" : " " ?>"> 
                          <!-- User information  -->
                         <div class="inforuser">
                            <div class="avatar">
                            <?php foreach($Users as $user):  ?>
                                <?php if($user['active'] == 1 && $com['i_user'] == $user['userid']): ?>
                                    <span class="active"></span>
                                <?php endif; ?>
                            <?php endforeach; ?>
                                <img class="rounded-cricle" src="../u/uploads/avatar/<?php echo $com['avatar'] ?>" alt="<?php echo $com['names'] ?>">
                            </div>
                            <div class="infor">
                                <h2><?php echo $com['names']; ?></h2>
                            </div>
                         </div>
                          <!-- end  --> 
                          <div class="inputs  <?php echo $Userinformation['modes'] == 'dark'  ? "input-loop" : " " ?>">  
                            <p  class="form-control ucomments <?php echo $Userinformation['modes'] == 'dark'  ? "input-loop" : " " ?> "><?php echo $com['mesg'] ?></p>
                          </div>
                        </div>
                          <?php endif; ?>
                        <?php endforeach; ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!-- comment style -->
                <div id="commentuser" class="commetnbook border-s"> 
                    <!-- User information  -->
                    <div class="inforuser">
                    <div class="avatar">
                        <span class="active"></span>
                        <img class="rounded-cricle" src="../u/uploads/avatar/<?php echo $Userinformation['avatar']; ?>" alt="<?php  echo $Userinformation['username']; ?>">
                    </div>
                    </div>
                    <!-- end  --> 
                    <div class="inputs">  
                    <form method="post" action="http://localhost/Ajualna/home.php">
                    <input name="comment" class="form-control ucomment input-user " type="text" placeholder="comment..<?php  echo $Userinformation['username']; ?>">
                    <input name="names" type="hidden" value="<?php  echo $Userinformation['username']; ?>">
                    <input name="avatar" type="hidden" value="<?php  echo $Userinformation['avatar']; ?>">
                    <input id="someone" type="hidden" value="<?php  echo $Userinformation['userid']; ?>">
                    <input id="postid" type="hidden" value="<?php  echo $_GET['postid']; ?>">
                    <input id="submit" type="submit" hidden="">
                    <button name="btnsendcomment" class="btn btn-light btn-sm btnsendcomment  <?php echo $Userinformation['modes'] == 'dark'  ? "input-loop" : " " ?> "><i class="fas fa-paper-plane"></i></button>
                    </form>
                    </div>
                </div>
                   <!-- MODAL EDIT DELETE HIDE REPORT POST -->
                 <!-- Modal Users  -->
                <div id="modalpost" class="modal-menu modalpost card <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?> ">
                    <ul> 
                        <?php if($_SESSION['id'] == $_GET['user']): ?>
                        <li id="editpost"> <i class="fas fa-edit icons"></i> <?php echo lang("ed"); ?></li>  
                        <li id="delpost"><i class="fas fa-trash icons"></i> <?php echo lang("de"); ?></a> </li>
                        <li id="createpages" ><i  class="fa fa-fighter-jet icons"></i> <?php echo lang("hi"); ?></li>
                        <?php endif; ?>      
                        <li id="bugs"><i class="fas fa-bug icons"></i>  <?php echo lang("re"); ?> </li>
                    </ul>
                </div>
            <!-- END MODAL EDIT DELETE HIDE REPORT POST -->  
            </div>
            <!-- \
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: auto;
            background: rgba(0, 0, 0, 0.5); -->
             
        </div> 
    </div>
    <div id="showmessage"></div>
</div>
 <!-- Start Edit -->
 <div class="overlay">
                <div class="report card p-3 ">
                    <h4>Tell Us Why You Want To Report ?</h4>
                    <label for="one">Incites hatred and violence</label>
                    <input class="checkbox" id="one" type="checkbox" value="Incites hatred and violence">
                    <label for="two">It offends me personally</label>
                    <input class="checkbox" id="two" type="checkbox" value="It offends me personally">
                    <label for="three">It has some planning to do something contrary</label>
                    <input class="checkbox" id="three" type="checkbox" value="It has some planning to do something contrary">
                    <label for="four">Against seeing the child</label>
                    <input class="checkbox" id="four" type="checkbox" value="Against seeing the child">
                    <!-- User information --> 
                    <input id="user" type="hidden" value="<?php echo $Userinformation['username'] ?>">
                    <input id="email" type="hidden" value="<?php echo $Userinformation['email'] ?>">
                    <input id="you" type="hidden" value="<?php echo $Userinformation['userid'] ?>">
                    <input id="postid" type="hidden" value="<?php echo $_GET['postid'] ?>">
                    <div class="control d-flex">
                    <button class="btn btn-primary btn-sm mt-3 mr-3"><i class="fas fa-bug"></i> Report</button>            
                    <button class="btn btn-light btn-sm mt-3 "> Close</button>
                    </div>
                </div>
               
            </div>
            <!-- End Edit -->
<style>
.active 
{
    color: rgb(0, 0, 255) !important;
}

#btnedit 
{
    display:none;
}

.overlay 
{
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: auto;
    display:none;
    background: rgba(0, 0, 0, 0.5);
}

.overlay .report 
{
    margin: 21% auto;
    width: 450px;
}

.overlay .report .btn-primary 
{
    width:150px;
}
</style>
<!-- END CODE ########################################################### -->
<?php include '../resources/templates/footer.php'; // navbar site  ?>
<script>
$(function(){

    // console.log($("#liker").val());

    $("#setlike").on("click",function(){

        $("#setlike").addClass("active");

        let id = $("#someone").val(),
            idpost = $("#postid").val();
        $.ajax({

            method:'POST',
            url:'../data/post.php',
            data:{"req":"addlike","id":id,"postid":idpost},
            success:function(d,t){
                
                console.log(d + "done");
                console.log(t + "success");
            },
            
        });
    });

    
    $("#deletelike").on("click",function(){

        let id = $("#someone").val(),
            idpost = $("#postid").val();
        
        $.ajax({

            method:'POST',
            url:'../data/post.php',
            data:{"req":"removelike","id":id,"postid":idpost},
            success:function(d,t){
                
                console.log(d + "done");
                console.log(t + "success");
            },
            
        });
    });

    $("#bugs").on("click",function(){

    //     let id = $("#someone").val(),
    //         idpost = $("#postid").val();
    //     $.ajax({

    //         method:'POST',
    //         url:'../data/post.php',
    //         data:{"req":"removelike","id":id,"postid":idpost},
    //         success:function(d,t){
                
    //             console.log(d + "done");
    //             console.log(t + "success");
    //         }
            
    //     });

    $(".overlay").fadeIn();

    });

    $(".btn-light").on("click",function(){
        $(".overlay").fadeOut();
    });

    // Hide show edit modal 
    $("#ellipsis").on("click",function(){
        $("#modalpost").toggleClass("display");
    });

    $("#modalpost").on("mouseleave",function(){

        $("#modalpost").removeClass("display");
    });
    
                       
    // Edit Settings
    $("#editpost").on("click",function(){
        // console.log(replaceWith)
        $("#desc").replaceWith('<input name="postvalue"  class="form-control <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>" type="text" value="<?php echo $postsforuser['description'] ?>">');
        $("#btnedit").show();
    });


    $("#one").on("click",function(){
        // if ($("#one") == true) {

            let id = $("#you").val(),  
                user = $("#user").val(),
                email = $("#email").val(),
                postid = $("#postid").val(),
                report = $("#one").val();
                $.ajax({

                    method:'POST',
                    url:'../data/settings.php',
                    data:{"req":"sendmessage","i":id,"u":user,"e":email,"s":postid,"m":report},
                    success:function(d,t){
                        
                        console.log(d);
                        console.log(t + "success");
                    }
                    
                });
        
        // } 
    }); 
   

   // Delete post 

   $("#delpost").on("click",function(){
       
            let  idpost = $("#postid").val();

            $.ajax({

                method:'POST',
                url:'../data/post.php',
                data:{"req":"delpost","postid":idpost},
                success:function(d,t){
                    
                  if(d == 'Delete'){
                    $("#showmessage").html('<div class="alert alert-success p-1 m-auto w-50">Your Post Is Delete it We Will Redirect you now...</div>');
                    setTimeout(() => {
                        window.location.href="../home.php"
                    }, 1500);
                  }

                }
                
            });
   });
    


});
</script>
