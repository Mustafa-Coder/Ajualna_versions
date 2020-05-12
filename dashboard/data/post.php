<?php 
include '../config/config.php';
session_start();

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
    
    default:
        # code...
        break;
}


endif; // end =====================================