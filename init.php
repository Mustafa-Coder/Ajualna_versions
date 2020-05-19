<?php




// INCLUDES ALL FILES
include './config/config.php';
// VAR....

$source = "./resources/";


// INCLUDES

include $source . '/functions/functions.php';
// function used :
if(isset($_SESSION['id'])):
$useridtow = $_SESSION['id'];
$Userinfor = get_something("signup","*","WHERE userid = $useridtow ","fetch"); // get data users
endif;
include $source . '/templates/header.php';
if(isset($_SESSION['user'])):
    if($Userinfor['languages'] == 'ar'):
        include $source . '/langs/ar.php';
    else:
        include $source . '/langs/en.php';
    endif;
endif;