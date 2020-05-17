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
        case 'replacemessages': // PAGE REPLACE MESSAGES

            $id = $_POST['id'];
            $re = filter_var($_POST['replace']);

            $statment = "UPDATE supportbox SET r_replace = :re WHERE userid = :id ";
            $setValue = $con->prepare($statment);
            $setValue->bindparam(":re",$re);
            $setValue->bindparam(":id",$id);
            $setValue->execute();
            $count = $setValue->rowcount();
            if ($count > 0) {
                echo 'Send';
            }else {
                echo 'wrong';
            }

        break;  // END PAGE REPLACE MESSAGES
   
}


endif; // end =====================================