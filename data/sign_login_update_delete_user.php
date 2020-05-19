<?php 
include '../config/config.php';
include '../resources/functions/functions.php';
session_start();

if (isset($_POST['req'])):  // if =====================================
    
$req = $_POST['req'];


switch($req) {
    case 'login': // LOGIN PAGE

            $username = filter_var($_POST['user']);
            $password = filter_var($_POST['pass']);
            $hasdpass = md5($password);

            // STATMENT
            $users_statment = "SELECT * FROM signup WHERE username = ? AND `password` = ? ";
            $usersta = $con->prepare($users_statment);
            $usersta->execute(array($username,$hasdpass));
            $rowQuery = $usersta->fetch();
            $count = $usersta->rowcount();

            $staus_online = 1;
            $id = $rowQuery['userid'];
            $notac = "UPDATE signup SET active = 1 WHERE userid =  ? ";
            $set = $con->prepare($notac);
            $set->bindparam(":active",$staus_online);
            $set->execute(array($rowQuery['userid']));

            if ($count > 0) {
                echo 'welcome';
                include './session_users.php';
            }else {
                echo 'wrong';
            }

        break; // END LOGIN PAGE
        case 'update' :
            if (isset($_POST['req'])) {

                 // STATMENT
                
               
                // Information coming from user 
                $userid = $_POST['userid'];
                $user = $_POST['user'];
                $last = $_POST['last'];
                $email = $_POST['email'];
                $pass = !empty($_POST['newpass']) ? $_POST['newpass'] : $_POST['oldpass'] ;
                $nationnum  = $_POST['national'];
                $collegeid = $_POST['collegeid'];
                $Gender = $_POST['Gender'];
                $langs = $_POST['langs'];
                $country = $_POST['country'];
                $Np = $_POST['Np'];

       
                // Send All information to database user
                $update = "UPDATE 
                           signup 
                           SET 
                           username = :user ,
                           lastname = :lastN,
                           email = :email, 
                           `password` = :pass,
                            -- famale = :women,
                           nationalNum = :national,
                            college = :college,
                            numberphone = :numberphone,
                            Gender = :Gender,
                            languages = :langs,
                            country = :coun
                            WHERE 
                            userid = :id
                           ";
                $setupdate = $con->prepare($update);
                $setupdate->bindparam(":user",$user);
                $setupdate->bindparam(":lastN",$last);
                $setupdate->bindparam(":email",$email);
                $setupdate->bindparam(":pass",$pass);
                // $setupdate->bindparam(":man",$male);
                $setupdate->bindparam(":Gender",$Gender);
                // $setupdate->bindparam(":sax",$sax);
                $setupdate->bindparam(":national",$nationnum);
                $setupdate->bindparam(":college",$collegeid);
                $setupdate->bindparam(":numberphone",$Np);
                $setupdate->bindparam(":langs",$langs);
                $setupdate->bindparam(":coun",$country);
                $setupdate->bindparam(":id",$userid);
                $setupdate->execute();
                $count = $setupdate->rowcount();
                $rowQuery = $setupdate->fetch();
                 // INFORMATION::
                if ($count == 1) {include './session_users.php';  }
                if ($count > 0) {
                    echo 'Done';
                }else {
                    echo 'Wrong';
                }

                
            }
        break;
        // SIGNUP USER SYSTEM 
        case "signup" :

                $username = filter_var($_POST['full']);
                $last = filter_var($_POST['last']);
                $pass = filter_var($_POST['pass']);
                $hash = md5($pass);
                $email =  filter_var($_POST['email']);
                $sax = filter_var($_POST['gender']);

                $insertdata = 
                "INSERT INTO 
                    signup(username,lastname,`password`,email,Gender)
                 VALUES 
                    (:username,:lastname,:pass,:email,:sax)
                ";

                $setstatment = $con->prepare($insertdata);
                $setstatment->bindparam(":username",$username);
                $setstatment->bindparam(":lastname",$last);
                $setstatment->bindparam(":pass",$hash);
                $setstatment->bindparam(":email",$email);
                $setstatment->bindparam(":sax",$sax);
                $setstatment->execute();
                $count = $setstatment->rowcount();
                
                if($count > 0):
                    echo "Done";
                    // STATMENT
                    $users_statment = "SELECT * FROM signup WHERE username = ?";
                    $usersta = $con->prepare($users_statment);
                    $usersta->execute(array($username));
                    $rowQuery = $usersta->fetch();
                    include './session_users.php';
                    // Update make admin  When userid = 1
                    $updateadmin = "UPDATE signup SET admin = 1 WHERE userid  = 1 ";
                    $admins = $con->prepare($updateadmin);
                    $admins->execute();

                    $staus_online = 1;
                    $id = $rowQuery['userid'];
                    $notac = "UPDATE signup SET active = :active WHERE userid = :id ";
                    $set = $con->prepare($notac);
                    $set->bindparam(":active",$staus_online);
                    $set->bindparam(":id",$id);
                    $set->execute();
                    

                else:
                    echo "wrong";
                endif;

                
        break;
        case 'DeleteUser':
                    if(is_numeric($_POST['id'])):
    
                        $userid = $_POST['id'];
                        // SIGNUP USER
                        $deleted_user = "DELETE FROM signup WHERE userid = ? ";
                        $set_del = $con->prepare($deleted_user);
                        $set_del->execute(array($userid));
                        // PAGES USER
                        $deleted_user = "DELETE FROM pages WHERE userid = ? ";
                        $set_del = $con->prepare($deleted_user);
                        $set_del->execute(array($userid));
                        // POSTS  USER
                        $deleted_user = "DELETE FROM posts WHERE userid = ? ";
                        $set_del = $con->prepare($deleted_user);
                        $set_del->execute(array($userid));
                        // NOTIFICATION USER
                        $deleted_user = "DELETE FROM notifications WHERE u_id = ? ";
                        $set_del = $con->prepare($deleted_user);
                        $set_del->execute(array($userid));
                        
                        // NOTIFICATION USER
                        $deleted_user = "DELETE FROM postpublic WHERE userid = ? ";
                        $set_del = $con->prepare($deleted_user);
                        $set_del->execute(array($userid));
                        $logout = $set_del->rowcount();

                         // support box USER
                         $deleted_user = "DELETE FROM supportbox WHERE userid = ? ";
                         $set_del = $con->prepare($deleted_user);
                         $set_del->execute(array($userid));
                         $logout = $set_del->rowcount();

                         // Comments USER
                         $deleted_user = "DELETE FROM comment  WHERE i_user = ? ";
                         $set_del = $con->prepare($deleted_user);
                         $set_del->execute(array($userid));
                         $logout = $set_del->rowcount();
    
                        echo 'Delete';
    
                    endif;
          break;
}


endif; // end =====================================