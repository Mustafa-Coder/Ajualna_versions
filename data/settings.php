<?php
include '../config/config.php';

if (isset($_POST['req'])):  // if =====================================
  $req = $_POST['req'];

switch($req) {
    case 'allowed': // PAGE EDIT


            $id = $_POST['id'];

            $statment = "UPDATE pages SET allowed = 0 ";
            $setValue = $con->prepare($statment);
            $setValue->bindparam(":id",$id);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'Done';
            }else {
                echo 'wrong';
            }


        break; // END PAGE EDIT
        case 'notallowed': // PAGE EDIT NOT ALLOWED

            $id = $_POST['id'];

            $statment = "UPDATE pages SET allowed = 1 ";
            $setValue = $con->prepare($statment);
            $setValue->bindparam(":id",$id);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'Done';
            }else {
                echo 'wrong';
            }

        break; // PAGE EDIT NOT ALLOWED

        case 'delete': // PAGE EDIT DELETE PAGE

            $id = $_POST['id'];

            $statment = "DELETE FROM pages WHERE pageid = :id ";
            $setValue = $con->prepare($statment);
            $setValue->bindparam(":id",$id);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'Done';
            }else {
                echo 'wrong';
            }

        break; // PAGE EDIT DELETE PAGE
        case 'create': // PAGE EDIT CREATE PAGE

            $id = $_POST['id'];
            $name = $_POST['namepage'];


            $statment = "INSERT INTO pages(pagename,pagetitle,pagecover,userid)VALUES(:title,'','',:id)";
            $setValue = $con->prepare($statment);
            $setValue->bindparam(":id",$id);
            $setValue->bindparam(":title",$name);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'Done';
            }else {
                echo 'wrong';
            }

        break; // PAGE EDIT CREATE PAGE
        // Send Message Support Box 
        case 'sendmessage':

            $u = $_POST['u']; // username 
            $e = $_POST['e']; // email 
            $m = $_POST['m']; // message
            $i = $_POST['i']; // user id 

            // if ():
            // endif;


            $statment = "INSERT INTO supportbox(username,email,messages,userid)VALUES(:us,:em,:me,:id)";
            $setValue = $con->prepare($statment);
            $setValue->bindparam(":us",$u);
            $setValue->bindparam(":em",$e);
            $setValue->bindparam(":me",$m);
            $setValue->bindparam(":id",$i);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'send';
            }else {
                echo 'wrong';
            }
        break;
        // End Send Message Support Box 

}


endif; // end =====================================
