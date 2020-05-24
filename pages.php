<?php 
session_start();
error_reporting(0);
$PAGENAME = "Pages | JEEL  ";
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
$avatar = $Userinfo['avatar'];
updatedata("postpublic","avatar","".$avatar."","WHERE userid = ".$userid.""); // update avatar in comment

?>
<body class="<?php echo $Userinformation['modes'] == 'dark'  ? "top" : " " ?> ">
<!-- START INCLUDE MENU -->
<?php include $source . '/templates/menu.php' ?>

<!-- END INCLUDE MENU -->
<!-- CHECK IF THIS PAGE ID NUMERIC OR NOT  -->
<?php $numberpage = filter_var($_GET['pageid'],FILTER_VALIDATE_INT); ?>
<?php $namepage = filter_var($_GET['page'],FILTER_SANITIZE_STRING); ?>
<?php 
// if var number
// START CODE SWITCH ...
switch ($namepage) {
    case 'Home_me': ?>
    <!-- // START HOME PAGE FOR YOU ==================================== -->
        <div class="container pagehome homeglobal">
            <div class="row mt-5"> 
                <div class="col-lg-3">
                    <div class="card cardleft mt-5 border-0 <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?> ">
                        <div class="avatar <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">
                            <?php echo empty($pagesforyou['pagecover']) ? "<i class='fas fa-university'></i>"  : "<img class='avatar_page' src='./u/uploads/cover/".$pagesforyou['pagecover']."' >" ; ?>
                        </div>
                        <?php echo $pagesforyou['userid'] == $_SESSION['id'] ? '<button class="btn btn-primary btn-sm m-auto" style="width:150px;margin-bottom:10px !important;"> <i class="fas fa-edit"></i><a style="text-decoration:none;color:white;" href="'.$_SERVER['PHP_SELF'].'?pageid='.$_GET['pageid'].'&page=editpage">Edit Page</a></button>'  : ' ' ?>
                    </div>
                    <!-- START INFORMATION ABOUT PAGE -->
                    <div class="card cardleft info mt-2 border-0 <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">
                        <h1 ><?php echo $pagesforyou['pagename'] ?></h1>
                        <p >From <?php echo $pagesforyou['country'] ?></p>
                        <hr class="<?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">
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
                        <div class="card  postsystem border-0 mt-5 p-3 <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">  
                            <textarea class="form-control <?php echo $Userinformation['modes'] == 'dark'  ? "input-text" : " " ?>"  id="description" placeholder="type.."></textarea>
                            <input id="name" type="hidden" value="<?php echo $Userinformation['username']; ?>">
                            <input id="namepage" type="hidden" value="<?php echo $pagesforyou['pagename']; ?>">
                            <input id="country" type="hidden" value="<?php echo $pagesforyou['country']; ?>">
                            <input id="photo" type="hidden" value="<?php echo $Userinformation['avatar']; ?>">
                            <button id="createbtn" class="btn btn-primary">Create</button>
                            <audio id="postmusic" src="./resources/media/post.mp3" type="audio/mp3"></audio>
                        </div>
                        <hr> 
                        <!-- SHOW POSTS ALL  -->
                        <div id="showposts"> 
                            
                        </div>
                    <!-- BETWEEN POST SYSTEM AND SHOW IT  -->
                    <!-- END Center -->
                </div>
                <div class="col-lg-3">
                    <div class=" mt-5 border-0 ">
                        <?php if($Userinformation['admin'] == 1): ?>
                            <div class="card infor-page border-0 pt-3 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " "  ?>">
                                <ul class="d-flex">
                                    <li style="margin-right:50px;">Students <br><span><?php echo Counter_All("signup","*","WHERE college = ".$pagesforyou['pageid']." "); ?></span></li>
                                    <li>Posts <br><span style="margin:0% auto;"><?php echo Counter_All("posts","*","WHERE college_group = ".$pagesforyou['pageid']." "); ?></span></li>
                                </ul>
                            </div>
                           <?php else: //  ecol admin = 0 ?>
                                <div class=" create-class p-2 <?php echo $Userinfo['modes'] == 'dark'  ? "bg-bor-col-dark" : " " ?>">
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
          
    <!-- // END HOME PAGE FOR YOU  ===================================== -->
                                        
            <?php // endif;?>
       <?php break;
       // EDIT PAGE UNIVERSITY ===============================================
       case'editpage': ?>
            
        <body class="<?php echo $Userinformation['modes'] == 'dark'  ? "top" : " " ?>">
    <div class="container settings  mt-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card menu-settings mt-5 <?php echo $Userinformation['modes'] == 'dark' ? 'bg-bor-col-dark ' :' ' ?> ">
                        <div class="profile-info">
                            <img class="img-fiuld text-center" <?php if(!empty($pagesforyou['pagecover'])): echo "src='/Ajualna/u/uploads/cover/".$pagesforyou['pagecover']."'"; else: echo "src=/Ajualna/layout/images/icons/user.png";endif;?> alt="image user">
                            <h2 class="username"><?php echo $pagesforyou['pagename'] ?></h2>
                        </div>
                        <ul class="pages">
                            <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo $_GET['pageid']?>&page=editpage"><i class="fas fa-edit"></i>   Edit Details</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo $_GET['pageid']?>&page=picpage"><i class="fas fa-image"></i> Picture Page</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo $_GET['pageid']?>&page=Del"><i class="fas fa-trash"></i> Delete Page</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo $_GET['pageid']?>&page=students"><i class="fas fa-user"></i> Student</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 mt-5">
                     <!--  START Messages for update info -->
                     <div id="html"></div>
                    <!-- END Messages for update info -->
                    <div class="card p-3 set-box  <?php echo $Userinformation['modes'] == 'dark'  ? "bg-bor-col-dark  " : " " ?>">

                    <div class="row py-5">
                        <div class="col-md-12 mb-4">
                        <!-- INFORMATION HIDDEN -->
                        <input id="pageid"  type="hidden" value="<?php echo $pagesforyou['pageid'] ?>">
                        <!-- <input id="mycollege" type="hidden" value="<?php echo $_SESSION['college'] ?>"> -->

                            <label for="Pagename">Pagename</label>
                            <input id="Pagename" class="form-control <?php echo $Userinformation['modes'] == 'dark' ? 'bg-bor-col-dark ' :' ' ?> " type="text" value="<?php echo $pagesforyou['pagename'] ?>">
                        </div>
                        <div class="col-md-12">
                            <label for="bio">Bio</label>
                            <textarea id="bio" class="form-control <?php echo $Userinformation['modes'] == 'dark' ? 'bg-bor-col-dark ' :' ' ?> " type="text" ><?php echo $pagesforyou['pagetitle'] ?></textarea>
                        </div>
                        
                        
                        <div class="col-md-12 mb-3">
                            <label for="user">Public Page</label>
                            <select class="form-control <?php echo $Userinformation['modes'] == 'dark' ? 'bg-bor-col-dark ' :' ' ?> " id="public">
                                    <option <?php  echo $pagesforyou['allowed'] == "1" ? "selected"  : "" ; ?>  value="1">Allowed</option>
                                    <option <?php  echo $pagesforyou['allowed'] == "0" ? "selected"  : "" ; ?>   value="0">Not Allowed</option>
                            </select>
                        </div>
                        
                        <div class="col-md-12">  
                            <label for="user">Country</label>

                            <select id="country" name="country" class="form-control <?php echo $Userinformation['modes'] == 'dark' ? 'bg-bor-col-dark ' :' ' ?> ">
                             <?php include './data/fetch_country.php' ?>
                            </select>
                        </div>
                        <div class="col-md-3 mt-2">
                            <button id="updatepage" class="btn btn-primary mt-4">Save</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
      </div>
       <?php break;
       // END EDIT PAGE UNIVERSITY ===============================================
       case 'picpage':

          // Script Uploade file on database use request no Ajax:
        if($_SERVER['REQUEST_METHOD'] == 'POST'):
            $id = $_GET['pageid'];
            $avatar = $_FILES['images'];
            $avatarName = $_FILES['images']['name'];
            $avatarSize = $_FILES['images']['size'];
            $avatartmp = $_FILES['images']['tmp_name'];
            $avatartype = $_FILES['images']['type'];
            $array = ["png","svg","jpeg","jpg"];
            // Get Last name from data:
            $expload = explode('.',$avatarName);
            
            $end = end($expload);
            // if($avatarSize < 9000):
            // Check if end var == array:
                if(in_array($end,$array)): // start if
                    $newnameavatar = rand(0,10000000000) .'.' . $end;
                    move_uploaded_file($avatartmp,".\u\uploads\cover\\" . $newnameavatar);

                    // Uploade file on data:
                    update("pages","pagecover","pageid",$newnameavatar,$id);
                    $error =  "<div class='alert alert-success mt-2 p-2'>Uploaded Your Image</div>";

                else :

                    $error =  "<div class='alert alert-danger mt-2 p-2'>Your Image not in svg, jpg , jpeg</div>";

                endif; // end if    
            // else:

                // $error =  "<div class='alert alert-danger mt-2 p-2'>Your Image Size Older than 9MG </div>";
                

            // endif;
        endif;
     ?>

    <div class="container settings  mt-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card menu-settings mt-5 <?php echo $Userinformation['modes'] == 'dark' ? 'bg-bor-col-dark ' :' ' ?> ">
                            <div class="profile-info">
                                <img class="img-fiuld text-center" <?php if(!empty($pagesforyou['pagecover'])): echo "src='/Ajualna/u/uploads/cover/".$pagesforyou['pagecover']."'"; else: echo "src=/Ajualna/layout/images/icons/user.png";endif;?> alt="image user">
                                <h2 class="username"><?php echo $pagesforyou['pagename'] ?></h2>
                            </div>
                            <ul class="pages">
                                <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo $_GET['pageid']?>&page=editpage"><i class="fas fa-edit"></i>   Edit Details</a></li>
                                <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo $_GET['pageid']?>&page=picpage"><i class="fas fa-image"></i> Picture Page</a></li>
                                <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo $_GET['pageid']?>&page=Del"><i class="fas fa-trash"></i> Delete Page</a></li>
                                <li class="nav-item"><a class="nav-link <?php echo $Userinformation['modes'] == 'dark' ? 'icons-co ' :' ' ?>  " href="<?php echo $_SERVER['PHP_SELF']; ?>?pageid=<?php echo $_GET['pageid']?>&page=students"><i class="fas fa-user"></i> Student</a></li>
                            </ul>
                        </div>
                </div>
                <div class="col-lg-9 mt-5">
                     <!--  START Messages for update info -->
                     <div id="html"></div>
                    <!-- END Messages for update info -->
                    <div class="card p-3  avatar-box <?php echo $Userinformation['modes'] == 'dark' ? 'bg-bor-col-dark ' :' ' ?>">
                        <h2 class="display-4">Change Your Avatar About Your University Page..</h2>
                        <div class="avatar">
                            <?php if(!empty($pagesforyou['coverpage'])): ?>
                            <img id="openfile" class="img-fiuld rounded" src="/u/uploads/cover/<?php echo $pagesforyou['avatar'] ?>" alt="">
                            <?php else: ?>
                            <img id="openfile" class="img-fiuld rounded" src="./layout/images/icons/011.png" alt="">
                            <?php  endif; ?>
                        </div>
                        <form action="pages.php?pageid=<?php echo $_GET['pageid']?>&page=picpage" method="post" enctype="multipart/form-data">
                            <input type="file" name="images" id="fileToUpload" hidden>
                            <input type="submit" value="Upload" name="uploade"  class="btn btn-primary">
                        </form>
                        <?php echo $error; ?>
                    </div>
                </div>
            </div>
      </div>
       <?php break;

   
}

// endif;
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
                }
               
               
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


                },
                error:function(err){
                    console.log(err);
                }

            });

            
       


            

              

    }

        

    $("#createbtn").on("click",function(){
        CreatePostPages();
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

   // Check post input is not empty 

  
   $("#description").on("mouseleave",function(){
        if($("#description").val().length == 0){
            $("#createbtn").attr("disabled",true);
        }else {
            $("#createbtn").attr("disabled",false);
        }
   });

   // Edit PAGE DETAILS 
      
   let EditPageDetails = _ =>
    {
         
        var   pagen = $("#Pagename").val(),
              bio = $("#bio").val(),
              pub = $("#public").val(),
              country = $("#country").val(),
              pageid = $("#pageid").val();



            $.ajax({

                method:"POST",
                url:"/Ajualna/data/pages.php",
                data:{
                    "req":"update",
                    "pagen":pagen, 
                    "bio":bio,
                    "pub":pub,
                    "coun":country,
                    "pageid":pageid
                    },
                success:function(data,stats){
                    if(data == 'Done'){
                      $("#html").html('<div class="alert alert-primary">Succssfully Updating </div>');
                    }

                    if(data == 'wrong'){
                        $("#html").html('<div class="alert alert-danger">Nothing Updating </div>');
                    }

                }

            });






    }

    $("#updatepage").on("click",function(){
        EditPageDetails();
    });

    
 // Uploade file on database for avatar

 $("#openfile").on("click",function(){
    $("#fileToUpload").click();
});

});

</script>