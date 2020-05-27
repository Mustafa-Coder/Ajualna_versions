<?php
include '../config/config.php';

if (isset($_POST['req'])):  // if =====================================
  $req = filter_var($_POST['req'],FILTER_SANITIZE_STRING);

switch($req) {
    case 'createpages': // PAGE EDIT


    $id = $_POST['id'];
    $pagename = $_POST['pn'];
    $pagetitle = $_POST['t'];
    $country = $_POST['c'];

            $statment = "INSERT INTO pages(pagename,pagetitle,country,userid)VALUES(:np,:pt,:pc,:id) ";
            $setValue = $con->prepare($statment);
            $setValue->bindparam(":np",$pagename);
            $setValue->bindparam(":pt",$pagetitle);
            $setValue->bindparam(":pc",$country);
            $setValue->bindparam(":id",$id);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'Done';
            }else {
                echo 'wrong';
            }

        break; // END PAGE EDIT

        // EDIT PAGES  pagen bio pub coun pageid
        case 'update':

            $p = filter_var($_POST['pagen'],FILTER_SANITIZE_STRING);
            $bi = filter_var($_POST['bio'],FILTER_SANITIZE_STRING);
            $pub = filter_var($_POST['pub'],FILTER_SANITIZE_STRING);
            $c = filter_var($_POST['coun'],FILTER_SANITIZE_STRING);
            $pid = filter_var($_POST['pageid'],FILTER_SANITIZE_NUMBER_INT);
            
            echo $p . $bi .$pub .$c . $pid;

             // Send All information to database user
             $update = "UPDATE 
             pages 
             SET 
             pagename = :pn ,
             pagetitle = :bio,
             country = :coun,
             allowed = :allowed
              
              WHERE 
              pageid = :id
             ";
            $setupdate = $con->prepare($update);
            $setupdate->bindparam(":pn",$p);
            $setupdate->bindparam(":bio",$bi);
            $setupdate->bindparam(":coun",$c);
            $setupdate->bindparam(":allowed",$pub);          
            $setupdate->bindparam(":id",$pid);
            $setupdate->execute();
            $count = $setupdate->rowcount();
            // INFORMATION::
            if ($count == 1) {
                echo 'Done';
            }else {
                echo 'Wrong';
            }

        break;
        // Delete page all info 
        case 'Del':
            $ID = filter_var($_POST['pageid'],FILTER_VALIDATE_INT);
            // NOTIFICATION USER
            $deleted_pages = "DELETE FROM pages WHERE pageid = ? ";
            $set_del = $con->prepare($deleted_pages);
            $set_del->execute(array($ID));
            $DEL = $set_del->rowcount();
            if($DEL == 1):
                echo 'Done';
            else:
                echo 'wrong';
            endif;
            
        break;
        

}



endif; // end =====================================
