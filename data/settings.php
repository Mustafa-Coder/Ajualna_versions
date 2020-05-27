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
            $s = $_POST['s']; // something

            // if ():
            // endif;


            $statment = "INSERT INTO supportbox(username,email,messages,For_something,userid)VALUES(:us,:em,:me,:s,:id)";
            $setValue = $con->prepare($statment);
            $setValue->bindparam(":us",$u);
            $setValue->bindparam(":em",$e);
            $setValue->bindparam(":me",$m);
            $setValue->bindparam(":s",$s);
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
        // Dark mode
        case 'darkmode':

            $mode = $_POST['modes']; // username 
            $id = $_POST['id'];

            // if ():
            // endif;

            $statment = "UPDATE signup SET modes = :mode WHERE userid = :id ";
            $setValue = $con->prepare($statment);
            $setValue->bindparam(":id",$id);
            $setValue->bindparam(":mode",$mode);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'Done';
            }else {
                echo 'wrong';
            }

        break;
        // Dark mode
        case 'updatenotification':

            $seen = $_POST['seen']; // user
            $id = $_POST['id'];

            // if ():
            // endif;

            $statment = "UPDATE notifications SET  seen = :seen  WHERE for_id = :id ";
            $setValue = $con->prepare($statment);
            // $setValue->bindparam(":id",$id);
            $setValue->bindparam(":seen",$seen);
            $setValue->bindparam(":id",$id);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'Done';
            }else {
                echo 'wrong';
            }

        break;
        // Uploade Notes 
        case 'Notes':

            $title = filter_var($_POST['title'],FILTER_SANITIZE_STRING); // title note  
            $content = filter_var($_POST['content'],FILTER_SANITIZE_STRING); // content note 
            $id = $_POST['id']; // id person note

          

            $statments = "INSERT INTO mynotepad(author_id,note_title,note_content)VALUES(:id,:t,:c) ";
            $setValue = $con->prepare($statments);
            // $setValue->bindparam(":id",$id);
            $setValue->bindparam(":id",$id);
            $setValue->bindparam(":t",$title);
            $setValue->bindparam(":c",$content);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'Done';
            }else {
                echo 'wrong';
            }

        break;
}


endif; // end ===================================== 
