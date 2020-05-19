<?php 
session_start();
include '../config/config.php';
include '../resources/functions/functions.php';
// function pages
$college_session = $_SESSION['college']; // college sesiion 
$userid = $_SESSION['id']; // user id 
$Userinfo = get_something("signup","*","WHERE userid = $userid ","fetch"); // get data users
$pagesforall = get_something("pages","*","WHERE pageid = ".$Userinfo['college']."","fetch"); // get page id you
$pagesforyou = get_something("pages","*","WHERE pageid = ".$userid."","fetch"); // get page id you
if (isset($_POST['req'])):  // if =====================================
  $req = $_POST['req']; 

switch($req) {
    case 'post': // POST PUBLIC

            $title = $_POST['title'];
            $descp = filter_var($_POST['descp']);
            $id = $_POST['userid'];
           
            // STATMENT
            
                $post_statment = "INSERT INTO postpublic(titlename,`description`,userid)VALUES(:title,:descp,:id)";
                $poststa = $con->prepare($post_statment);
                $poststa->bindparam(":title",$title);
                $poststa->bindparam(":descp",$descp);
                $poststa->bindparam(":id",$id);
                $poststa->execute();
                $count = $poststa->rowcount();

                if ($count > 0) {
                    echo 'Create';
                }else {
                    echo 'wrong';
                }
        break; // END POST PUBLIC PAGE
        // START  CREATE NEW POST FOR USER ====================================
        case 'createpost': // userid name college photo
            $id = $_POST['id'];
            $name = $_POST['name'];
            $descp = $_POST['desc'];
            $country = $Userinfo['country'];
            $college = $_POST['college'];
            $avatar = $_POST['photo'];
            // echo $id . $name . $descp . $college . $avatar;
            
                $post_statment = "INSERT INTO posts(username,college_group,avatar,`description`,country,userid)VALUES(:us,:colg,:avat,:descp,:coun,:id)";
                $poststa = $con->prepare($post_statment);
                $poststa->bindparam(":us",$name);
                $poststa->bindparam(":colg",$college);
                $poststa->bindparam(":avat",$avatar);
                $poststa->bindparam(":descp",$descp);
                $poststa->bindparam(":coun",$country);
                $poststa->bindparam(":id",$id);
                // $poststa->bindparam(":userid",$id);
                $poststa->execute();
                $count = $poststa->rowcount();


                if ($count > 0) {
                    echo 'Done';
                    
                    $id = $Userinfo['userid'];
                    $desc = filter_var($_POST['desc'],FILTER_SANITIZE_STRING);
                    $namepage = filter_var($pagesforall['pageid']);
                    $typenotif = "post";
                    $seen = 1;

                    // Notification System Upload:     

                    $notif = "INSERT INTO notifications(u_id,title,pagesname,typenotif,seen)
                              VALUES(:userid,:descrp,:pn,:ti,:se)";
                    $notification = $con->prepare($notif);
                    $notification->bindparam(":userid",$id);
                    $notification->bindparam(":descrp",$desc);
                    $notification->bindparam(":pn",$namepage);
                    $notification->bindparam(":ti",$typenotif);
                    $notification->bindparam(":se",$seen);
                    $notification->execute();
                    $count = $notification->rowcount();

            
                    // echo $id . " " . $desc . " " . $namepage . " " . $typenotif . " " . $seen;


                }else {
                    echo 'wrong';   
                }
        break;
        // END CREATE NEW POST FOR USER ====================================
        // START LIKE SYSTEM UPLOADE IN DATABASE =================================
        case 'addlike':
            if(is_numeric($_POST['id'])):
                // VAR POST DATA:
                $postid = filter_var($_POST['id']);
                $id = $_SESSION['id'];
                // INSERT DATA IN DATABASE: 

                $post_statment = "INSERT INTO liker(liker_id,post_id)VALUES(:liker,:postid)";
                $poststa = $con->prepare($post_statment);
                $poststa->bindparam(":liker",$id);
                $poststa->bindparam(":postid",$postid);
                $poststa->execute();
                $count = $poststa->rowcount();

                if ($count > 0) {
                    echo 'Done';
                }else {
                    echo 'wrong';   
                }

            endif;
        break;
        // END LIKE SYSTEM UPLOADE IN DATABASE =================================
        // START  CREATE NEW POST FOR USER ====================================
        case 'createpostpage': // userid name college photo
            $id = $_POST['id'];
            $name = $_POST['name'];
            $npage = $_POST['npage'];
            $descp = $_POST['desc'];
            $country = $_SESSION['country'];
            $avatar = $_POST['photo'];

            // echo $id . $name . $descp . $npage . $avatar .$country;
            
                $post_statment = "INSERT INTO postpublic(titlename,`description`,pagename,country,avatar,userid)
                VALUES(:us,:descp,:npage,:coun,:avatar,:id)";
                $poststa = $con->prepare($post_statment);
                $poststa->bindparam(":us",$name);
                $poststa->bindparam(":descp",$descp);
                $poststa->bindparam(":npage",$npage);
                $poststa->bindparam(":coun",$country);
                $poststa->bindparam(":avatar",$avatar);
                $poststa->bindparam(":id",$id);
                $poststa->execute();
                $count = $poststa->rowcount();

                // // FUNCTION CREATE TO POST IT ---------
                // Createall(
                //     // TABLES AND COLUMNS NAMES VALUES(:us,:colg,:avat,:descp,:id)";
                //      "posts","username","college_group","avatar","`description`","userid",
                //      // VALUES
                //      ":us",":colg",":avat",":descp",":id",
                //      // DATA 
                //      "$name","$college","$avatar","$descp","$id"
                //     );

                if ($count > 0) {
                    echo 'Done';
                }else {
                    echo 'wrong';   
                }
        break;
        // END CREATE NEW POST FOR USER ====================================
        // START EDIT  POST FOR USER ====================================
        case 'sendcomment':
            echo $_GET['com'];
        break;
        // END EDIT  POST FOR USER ====================================
        
}


endif; // end =====================================