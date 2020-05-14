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
<?php $numberpage = filter_var($_GET['pageid'],FILTER_VALIDATE_INT); ?>
<?php $namepage = filter_var($_GET['page'],FILTER_SANITIZE_STRING); ?>
<?php 
// if var number
if(is_numeric($numberpage) & $numberpage == $pagesinfo['pageid']):
// START CODE SWITCH ...
echo $pagesinfo['pageid'];
switch ($namepage) {
    case 'Home_me': ?>
    <!-- // START HOME PAGE FOR YOU ==================================== -->
        <?php if($pagesinfo['pageid'] == $numberpage){ ?>
        <div class="container pagehome homeglobal">
            <div class="row mt-5">
                <div class="col-lg-3">
                    <div class="card cardleft mt-5 border-0">
                        <div class="avatar">
                            <?php echo empty($pagesforyou['pagecover']) ? "<i class='fas fa-university'></i>"  : "<img class='avatar_page' src='./u/uplaods/cover/".$pagesforyou['pagecover']."' >" ; ?>
                        </div>
                    </div>
                    <!-- START INFORMATION ABOUT PAGE -->
                    <div class="card cardleft info mt-2 border-0">
                        <h1 ><?php echo $pagesforyou['pagename'] ?></h1>
                        <p >From <?php echo $pagesforyou['country'] ?></p>
                        <hr>
                        <!-- pages click -->
                        <ul>
                            <li><i class="fas fa-user-graduate"></i> University concepts</li>
                            <li id="student"><i class="fas fa-poll"></i> Student Posts and Qus</li>
                        </ul>
                    </div>
                    <!-- END INFORMATION ABOUT PAGE -->
                </div>
                <div class="col-lg-6 center">
                    <!-- START Center -->
                         <!-- START SYSTEM POST  -->
                         <input id="namepage" type="hidden" value="<?php echo $pagesforyou['pagename']; ?>">
                         <input id="pageid" type="hidden" value="<?php echo $pagesforyou['pageid']; ?>">
                         <?php if($Userinformation['admin'] == 1): ?>
                        <div class="card  postsystem border-0 mt-5 p-3">  
                            <textarea class="form-control"  id="description" placeholder="type.."></textarea>
                            <input id="name" type="hidden" value="<?php echo $Userinformation['username']; ?>">
                            <input id="namepage" type="hidden" value="<?php echo $pagesforyou['pagename']; ?>">
                            <input id="country" type="hidden" value="<?php echo $pagesforyou['country']; ?>">
                            <input id="photo" type="hidden" value="<?php echo $Userinformation['avatar']; ?>">
                            <button id="createbtn" class="btn btn-primary">Create</button>
                            <audio id="postmusic" src="./resources/media/post.mp3" type="audio/mp3"></audio>
                        </div>
                         <?php endif; ?>
                        <hr> 
                        <!-- SHOW POSTS ALL  -->
                        <div id="showposts"> 
                            
                        </div>
                    <!-- BETWEEN POST SYSTEM AND SHOW IT  -->
                    <!-- END Center -->
                </div>
                <div class="col-lg-3">
                    <div class="card mt-5 border-0">
                        <?php 
                            if($Userinformation['admin'] == 1):
                                // code ..
                            else: //  ecol admin = 0
                                ?>
                                <div class=" create-class p-2 ">
                                    <span><i class="fas fa-plus"></i></span>
                                    <h2 class="tic">Create Your Class</h2>
                                </div>
                                <?php 
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
            <?php

            }
            ?>
    <!-- // END HOME PAGE FOR YOU  ===================================== -->
                                        
            <?php // endif;?>
       <?php break;
   
}

endif;
?>
<!-- End CHECK IF THE COLLEGE ECOLE COLLEGE HIM -->
<!-- ------------------------------------------------------------------------- -->
<?php // include $source . '/templates/footer.php' ?>
<script src="/Ajualna/layout/js/all.min.js"></script>
<script src="/Ajualna/layout/js/jquery.min.js"></script>
<!-- DATA ALL -->
<script>
$(function(){
    $(window).on("load",function(){
        var namepage = $("#namepage").val();
        $.ajax({
                type:"post",
                url:"/Ajualna/data/fetch_data.php",
                data:{"req":"getpostspage","namepage":namepage},
                beforeSend:function(){$("#waitingpost").show(10);},
                success:function(data,stats){
                    console.log(stats); 
                    console.log(data);
                    $("#showposts").html(data);
                },
                // error:function(err){
                //     console.log(err); 
                // }
               
            });
    });

// name namepage country photo
let CreatePostPages = _ => 
    {
        let id = $("#userid").val(),
              name = $("#name").val(),
              namepage = $("#namepage").val(),
              desc = $("#description").val(),
              photo = $("#photo").val(),
              country = $("#country").val();


            $.ajax({     

                method:"POST",
                url:"/Ajualna/data/post.php",  
                data:{
                    "req":"createpostpage",
                    "id":id,
                    "name":name,
                    "desc":desc,
                    "country":country,
                    "npage":namepage,
                    "photo":photo

                     },
                beforeSend:function(){
                    $("#text").show(100);
                    $("#info").show(1000);
                    $("#info").css({"display":"flex"});
                    $("#notification").show(200);
                },
                success:function(data,stats){
                    if(data == 'Done'){
                        $("#description").html('');
                        $("#text").html('<div class="animated bounceOutDown slow" id="postsuccess"><i class="fas fa-mail-bulk"></i> Success</div>');
                        // $("#text").hide(10000);
                        $("#postmusic")[0].play();
                        $("#postmusicnotif")[0].play();


                        
                     }else 
                     {
                         console.log(data);
                         console.log(stats);
                     }

                    //  console.log(data);
                    //      console.log(stats);

                    // if(data){
                        // console.log(data);
                        // console.log(stats);
                    // }
                },
                error:function(err){
                    console.log(err);
                }

            });

            

           


            

              

    }

        




});

// function to redirect in anypages
let GoPages = (url) =>  {setTimeout(() => { window.location.href=""+ url +"" },500);}

    // LOGIN PAGE
    $('#login').on('click',function (){
        GoPages("login.php");
    });

    $("#dash").on('click', function () {
        GoPages("../../Ajualna/dashboard/dashboard.php?dash=dashboard");
     });

       $("#logout").on('click',function (){
           
             GoPages("../../Ajualna/logout.php");

        });

        // Redirect on profilepage:
        $("#profilepage").on('click', function () {
            var userid = $("#userid").val();
                
            GoPages("../../Ajualna/u/profile.php?user=profilepage&id="+ userid +"");
         });

        
    
    $("#createbtn").on("click",function(){
        CreatePostPages();
    });

   //  When you click this btn show menu profile: 
   $("#ShowMenuPerson").on('click',function (){
        $("#moadlMenu").toggleClass('display');
        $("#modalNotif").removeClass("display");

    });
    $("#ShowNotification").on('click',function () {
        $("#moadlMenu").removeClass('display');
        $("#modalNotif").toggleClass("display");
    });
    $(".container").on('click', function () {
        $("#moadlMenu").removeClass('display');
        $("#modalNotif").removeClass("display");
     });
     
     // Redirect Page > EDIT PROFILE 
    //  profiledit
    $("#brandhome").on('click',function (){
        GoPages("/Ajualna/home.php");

   });
</script>