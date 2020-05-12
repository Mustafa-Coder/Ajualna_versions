<?php 
include '../config/config.php';
session_start();

if (isset($_POST['req'])):  // if =====================================
  $req = $_POST['req']; 

switch($req) {
    case 'login': // LOGIN PAGE

            $username = filter_var($_POST['user']);
            $password = filter_var($_POST['pass']);
            $hasdpass = md5($password);

            // STATMENT
            $users_statment = "SELECT * FROM signup WHERE username = ? AND `password` = ? AND `admin` = 1 ";
            $usersta = $con->prepare($users_statment);
            $usersta->execute(array($username,$hasdpass));
            $rowQuery = $usersta->fetch();
            $count = $usersta->rowcount();



            if ($count > 0) {
                echo 'welcome';
                include './session_users.php';
            }else {
                echo 'wrong';
            }

        break; // END LOGIN PAGE
    
    default:
        # code...
        break;
}


endif; // end =====================================