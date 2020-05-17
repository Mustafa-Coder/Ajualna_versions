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

}


endif; // end =====================================
