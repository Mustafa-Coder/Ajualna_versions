<?php 
session_start();
include 'init.php';
if(!isset($_SESSION['user'])):
    header("location:/Ajualna/logout.php");
    exit;
endif;
if(isset($_SESSION['user'])):
    $userid = $_SESSION['id']; // user id 
    // all information about user in edit 
    $Userinformation = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
    $pagesinfo = get_something_also("pages","*"); // get all pages
    $college_session = $_SESSION['college']; // college sesiion 
    $pagesforyou = get_something("pages","*","WHERE pageid = ".$Userinformation['college']."","fetch"); // get page id you
endif;


?>

<!-- -------------------------------------------------------------------------- -->
<?php 
if(isset($_GET['user'])): ///////////////////////////////////////////..
$req = $_GET['user'];

switch($req) {

    
    // =====================[START SHOW PROFILE] ====================== //
    case'profilepage': ?>
        <!-- First Information  -->
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" href="../layout/images/logo.png" type="image/x-icon">
            <link rel="stylesheet" href="../layout/css/bootstrap.min.css">
            <link rel="stylesheet" href="../layout/css/main.css">
            <title><?php title("Profile | ".$Userinformation['username']." ") ?></title>
        </head>
        <body>
        <?php include "../../Ajualna/resources/templates/menu.php" ?>
        <div class="container profile-page">
            <div class="row mt-5"> 
                <div class="col-lg-12">
                    <div class="card border-0 mt-5 p-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="avatar">
                                    <?php if(empty($Userinformation['avatar'])): ?>
                                         <div class="name"><?php echo strtoupper(substr($Userinformation['username'],0,1)); ?></div>
                                    <?php else: ?>
                                        <img class="img-fiuld rounded-circle" src="./uploads/avatar/<?php echo $Userinformation['avatar']; ?>" alt="user profile " >
                                     <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-9">
                            <div class="info">
                                <h1 class="username"><?php echo $Userinformation['username'] . ' ' . $Userinformation['lastname'] ?></h1>
                                <ul class="linke">
                                    <li><span> <i class="fas fa-venus-mars"></i> </span><?php echo $Userinformation['Gender']; ?></li>
                                    <li><span><i class="fas fa-university"></i></span><?php echo !empty($pagesforyou['pagename']) ?  $pagesforyou['pagename'] : " No College Here !" ?></li>
                                </ul>
                            </div>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Scound Information -->
        <div class="container profile-page-about">
            <div class="row">
                <div class="col-lg-3">
                   <ul class="link-set">
                       <li><a href="#">Settings</a></li>
                       <li><a href="#"><?php echo !empty($pagesforyou['pagename']) ?  $pagesforyou['pagename'] : " No College Here !" ?></a></li>
                       <li><a href="#">Piblic Question</a></li>
                       <li><a href="#">Help</a></li>
                   </ul>
                </div>
                <div class="col-lg-9">
                   <div class="card mt-3 border-0 p-3">
                        <h2 class="mt-2 ml-2">About</h2>
                        <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><i class="fas fa-envelope"></i> <?php echo $Userinformation['email'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><i class="fas fa-globe-asia"></i> <?php echo $Userinformation['country'] ?></p>
                        </div>
                    </div>
                   </div>
                   <!-- Information about website  -->
                    <ul class="infoweb">
                        <li><p>Ajualna &copy; 2020</p></li>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Privce</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Facebook</a></li>
                     </ul>
                    <!-- End Information about website  -->
                </div>
                
            </div>
            
        </div>
    <?php break;
    // =====================[END SHOW PROFILE] ====================== //

    // =====================[START PROFILE EDITING] ====================== //
    case 'profiledit':
    if (isset($_GET['user']) && $_GET['user'] == 'profiledit' && $_GET['id'] == $userid ) { // start edit profile 
     
     ?> 
    <!-- First Information  -->
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" href="../layout/images/logo.png" type="image/x-icon">
            <link rel="stylesheet" href="../layout/css/bootstrap.min.css">
            <link rel="stylesheet" href="../layout/css/main.css">
            <title><?php title("Profile Edit | ".$Userinformation['username']." ") ?></title>
        </head>
        <body>
        <?php include "../../Ajualna/resources/templates/menu.php" ?>
    <div class="container settings  mt-5">
            <div class="row">
                <div class="col-lg-3">
                  <?php include '../resources/templates/menu-set.php'; // Menu Settings ?>
                </div>
                <div class="col-lg-9 mt-5">
                     <!--  START Messages for update info -->
                     <div id="html"></div>
                    <!-- END Messages for update info -->
                    <div class="card p-3 set-box">
                   
                    <div class="row py-5">
                        <div class="col-md-6 mb-4">
                        <!-- INFORMATION HIDDEN -->
                        <input id="userID" class="form-control" type="hidden" value="<?php echo $_SESSION['id'] ?>">
                        <input id="mycollege" class="form-control" type="hidden" value="<?php echo $_SESSION['college'] ?>">

                            <label for="user">Username</label>
                            <input id="user" class="form-control" type="text" value="<?php echo $Userinformation['username'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="user">lastname</label>
                            <input id="last" class="form-control" type="text" value="<?php echo $Userinformation['lastname'] ?>">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="user">email</label>
                            <input id="email" class="form-control" type="email" value="<?php echo $Userinformation['email'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="user">Ntional Number</label>
                            <input id="nationalnum" class="form-control" type="text" value="<?php echo $Userinformation['nationalNum'] ?>">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="user">College</label>
                            <select class="form-control" id="collegeid"><?php 
                                if ($Userinformation['college'] == 0): // When User the college is  ecoal zero 
                                    echo '<option value="0">Chosse Your College</option>';
                                    foreach($pagesinfo as $page){ ?>
                                        <option id="newcollege" value="<?php echo $page['pageid'] ?>"><?php echo $page['pagename']; ?></option>
                                   <?php }
                                endif; // When User the college is not ecoal zero 
                                if($Userinformation['college'] > 0):
                                 ?> <option id="oldcollege" value="<?php echo $pagesforyou['pageid'] ?>"><?php echo $pagesforyou['pagename'] ?? $pagesforyou['pagename'] ?></option> <?php 
                                 foreach($pagesinfo as $page){ ?>
                                        <option id="newcollege" value="<?php echo $page['pageid'] ?>"><?php echo $page['pagename']; ?></option>
                                   <?php }
                                endif; 
                            ?> </select>
                        </div>
                        <div class="col-md-6">
                            <label for="user">Your</label>
                            <select class="form-control" id="Gender">
                                    <option <?php  echo $_SESSION['sax'] == "male" ? "selected"  : "" ; ?>  value="male">Male</option>
                                    <option <?php  echo $_SESSION['sax'] == "famale" ? "selected"  : "" ; ?>   value="famale">Famale</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="user">New password</label>
                            <input id="old-pass"  type="hidden" value="<?php echo $Userinformation['password']; ?>">
                            <input id="new-pass" class="form-control" type="password">
                        </div>
                        <div class="col-md-6">
                            <label for="user">Number Phone</label>
                            <?php if(!empty($Userinformation['numberphone'])): ?>
                                <input class="form-control" type="text" id="numberphone" value="<?php echo $Userinformation['numberphone']; ?>">
                            <?php else: ?>
                                <input class="form-control" type="text" id="numberphone" placeholder="Enter Phone">
                            <?php endif; ?>
                            
                        </div>
                        <div class="col-md-6">
                            <label for="user">Languages</label>
                            <select class="form-control" id="langs">
                                    <option <?php  echo $Userinformation['languages'] == "ar" ? "selected"  : "" ; ?>  value="ar">Arabic</option>
                                    <option <?php  echo $Userinformation['languages'] == "en" ? "selected"  : "" ; ?>   value="en">English</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="user">Country</label>

                            <select id="country" name="country" class="form-control">
                             <?php include '../data/fetch_country.php' ?>
                            </select>
                        </div>
                        <div class="col-md-3 mt-2">
                            <button id="update" class="btn btn-primary mt-4">Save</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
      </div> 
    <?php }else {

        header("location:../../../Ajualna/home.php");
        exit;

    } // end edit profile
        
    break;
    // =====================[END PROFILE EDITING] ====================== //
   // =====================[START PROFILE PICTURE AVATAR] ====================== //
   case 'profileavatar':
    ?>
    <!-- First Information  -->
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" href="../layout/images/logo.png" type="image/x-icon">
            <link rel="stylesheet" href="../layout/css/bootstrap.min.css">
            <link rel="stylesheet" href="../layout/css/main.css">
            <title><?php title("Profile Picture | ".$Userinformation['username']." ") ?></title>
        </head>
        <body>
        <?php include "../../Ajualna/resources/templates/menu.php" ?>
    <?php 
    if (isset($_GET['user']) && $_GET['user'] == 'profileavatar' && $_GET['id'] == $userid ) { // start PICTURE profile 
        // Script Uploade file on database use request no Ajax:
        if($_SERVER['REQUEST_METHOD'] == 'POST'):
            $id = $_SESSION['id'];
            $avatar = $_FILES['images'];
            $avatarName = $_FILES['images']['name'];
            $avatarSize = $_FILES['images']['size'];
            $avatartmp = $_FILES['images']['tmp_name'];
            $avatartype = $_FILES['images']['type'];
            $array = ["png","svg","jpeg","jpg"];
            // Get Last name from data:
            $expload = explode('.',$avatarName);
            $end = end($expload);

            // Check if end var == array:
                if(in_array($end,$array)): // start if 

                    $newnameavatar = rand(0,10000000000) . '__'.$_SESSION['user'].'_62315.' . $end;
                    move_uploaded_file($avatartmp,".\uploads\avatar\\" . $newnameavatar);

                    // Uploade file on data:
                    update("signup","avatar","userid",$newnameavatar,$userid);

                   
                endif; // end if

            
        endif;
     ?> 

    <div class="container settings  mt-5">
            <div class="row">
                <div class="col-lg-3">
                  <?php include '../resources/templates/menu-set.php'; // Menu Settings ?>
                </div>
                <div class="col-lg-9 mt-5">
                     <!--  START Messages for update info -->
                     <div id="html"></div>
                    <!-- END Messages for update info -->
                    <div class="card p-3  avatar-box">
                        <h2 class="display-4">Change Your Avatar About Your Profile..</h2>
                        <div class="avatar">
                            <?php if(!empty($Userinformation['avatar'])): ?>
                            <img id="openfile" class="img-fiuld rounded" src="./uploads/avatar/<?php echo $Userinformation['avatar'] ?>" alt="">
                            <?php else: ?>
                            <img id="openfile" class="img-fiuld rounded" src="../layout/images/icons/011.png" alt="">
                            <?php  endif; ?>
                        </div>
                        <form action="profile.php?user=profileavatar&id=<?php echo $_SESSION['id']; ?>" method="post" enctype="multipart/form-data">
                            <input type="file" name="images" id="fileToUpload" hidden>
                            <input type="submit" value="Upload" name="uploade"  class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
      </div> 
    <?php }else {

        header("location:../../../Ajualna/home.php");
        exit;

    } // end  PICTURE AVATAR 
        
    break;
    // =====================[END PROFILE  PICTURE AVATAR] ====================== //
    // =====================[START PROFILE  DELETE] ====================== //
    case 'DeleteUserall':
        
    ?>
    <!-- First Information  -->
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" href="../layout/images/logo.png" type="image/x-icon">
            <link rel="stylesheet" href="../layout/css/bootstrap.min.css">
            <link rel="stylesheet" href="../layout/css/main.css">
            <title><?php title("Delete Acount | ".$Userinformation['username']." ") ?></title>
        </head>
        <body>
        <?php include "../../Ajualna/resources/templates/menu.php" ?>
    <div class="container settings  mt-5">
                <div class="row">
                    <div class="col-lg-3">
                    <?php include '../resources/templates/menu-set.php'; // Menu Settings ?>
                    </div>
                    <div class="col-lg-9 mt-5">
                        <!--  START Messages for update info -->
                        <div id="html"></div>
                        <!-- END Messages for update info -->
                        <div class="card p-3  avatar-box">
                            <h2 class="display-4">
                            This page is about deleting your account completely.
                            </h2>
                            <p>
                            When you delete your account, 
                            <strong class="text-danger">you will lose all your information on the site,</strong>
                             your photos, and everything posted about you
                            </p>
                                <input id="userid" type="hidden" value="<?php echo $_SESSION['id']; ?>">
                                <div id="textDeleteMesg"></div>
                                <button id="deleteUser" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
        </div> 
    <?php
    break;
    // =====================[END PROFILE  DELETE] ====================== //
    // =====================[START SUPPORT BOX PAGE PROFILE ] ====================== //
    case 'supportbox': ?>
    <!-- First Information  -->
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="shortcut icon" href="../layout/images/logo.png" type="image/x-icon">
            <link rel="stylesheet" href="../layout/css/bootstrap.min.css">
            <link rel="stylesheet" href="../layout/css/main.css">
            <title><?php title("Community Supports | ".$Userinformation['username']." ") ?></title>
        </head>
        <body>
        <?php include "../../Ajualna/resources/templates/menu.php" ?>
       <div class="container mt-5 supportbox">
           <div class="row mt-5">
               <div class="col-lg-12">
                   <div class="card border-0 mesg mt-5 p-3">
                       <h1>Welcome, <?php echo $Userinformation['username']  ?>!</h1>
                       <p>The Support Inbox is your place to:</p>
                       <ul>
                           <li>1.   Get updates about things you've reported</li>
                           <li>2.	Check and reply to messages from the Help Team.</li>
                           <li>3.	See important messages about your account.</li>
                       </ul>
                       <span><i class="fas fa-heart icons-mesg"></i></span>
                       <span><i class="fas fa-grin-hearts icons-mesg2"></i></span>
                   </div>
               </div>
               <div class="col-lg-12 ">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="card mesg-2 mt-4 p-3">
                              <div class="group">
                                  <h2><i class="fas fa-box"></i> We Call You After Revision Your message </h2>
                                  <hr>
                                  <!-- -->
                                  <input id="username" type="hidden" value="<?php echo $Userinformation['username'] ?>">
                                  <input id="email" type="hidden" value="<?php echo $Userinformation['email'] ?>">
                                  <input id="userid" type="hidden" value="<?php echo $Userinformation['userid'] ?>">
                                  <textarea id="message" class="form-control"  id="messagebox" cols="30" rows="10"></textarea>
                                  <audio id="sbm" src="../resources/media/smb.mp3" type="audio/mp3"></audio>
                                  <button id="send" class="btn btn-primary mt-2" >Send message</button>
                              </div>
                          </div>
                          <div class="mesgrequest"></div>
                      </div>
                      <div class="col-md-6">
                            <h4 class="htitle">Help Center</h4>
                            <ul class="link-page">
                                <li><a href="#">Police private</a> <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, alias.</li>
                                <li><a href="#">Police private</a> <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, alias.</li>
                                <li><a href="#">Police private</a> <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, alias.</li>
                                <li><a href="#">Police private</a> <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, alias.</li>
                                <li><a href="#">Police private</a> <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, alias.</li>
                            </ul>
                            <hr>
                            <div class="pages">
                                <!-- ... -->
                            </div>
                      </div>
                  </div>
               </div>
           </div>
       </div>
    <?php break;
    // =====================[END SUPPORT BOX PAGE PROFILE ] ====================== //
}

else: //////////////////////////////////////////////////
header("location:/Ajualna/logout.php");
exit;
endif;
?>
<!-- -------------------------------------------------------------------------- -->

<?php include '../resources/templates/footer.php' ?>

</body>
</html>
