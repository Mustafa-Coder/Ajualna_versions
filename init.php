<?php




// INCLUDES ALL FILES
include './config/config.php';
// VAR....

$source = "./resources/";


// INCLUDES

include $source . '/functions/functions.php';
include $source . '/templates/header.php';
if(isset($_SESSION['user'])):
    // if($_SESSION['lang'] == 'en'):
    //     include $source . '/langs/en.php';
    // endif;
    if($_SESSION['lang'] == 'ar'):
        include $source . '/langs/ar.php';
    else:
        include $source . '/langs/en.php';
    endif;
endif;