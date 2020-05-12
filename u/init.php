<?php




// INCLUDES ALL FILES
include '../config/config.php';
// VAR....

$source = "../resources/";


// INCLUDES

include $source . '/functions/functions.php';
if($_SESSION['lang'] == 'en'):
    include $source . '/langs/en.php';
else:
    include $source . '/langs/ar.php';
endif;
