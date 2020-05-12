<?php 

// TITLE PAGE version one

function title($type = null){

    global $PAGENAME;

    if (isset($PAGENAME)):
       
        echo $type . ' ' . $PAGENAME;

    else:
        echo 'No title in this page ';

    endif;

}


// SOURCE PAGE

function sourcepage($PATHNAME)
{

    return ".." . $PATHNAME;

}


// Get Users all 
// ColOne : this is colum one for  username 
// ColTwo : this is colum two for  password 

function users($table,$col1,$col2,$var1,$var2){

    global $db ;
    global $rowQuery ;
    global $count ;
    // global $query;
    $users_statment = "SELECT * FROM $table WHERE $col1 = ? AND $col2 = ?";
    $usersta = $db->prepare($users_statment);
    $usersta->execute(array($var1,$var2));
    $rowQuery = $usersta->fetch();
    $count = $usersta->rowcount();

    return $rowQuery;
    return $count;


    // $users_statment = "SELECT * FROM sign";
    // $usersta = $db->prepare($users_statment);
    // $usersta->execute();

}


// Function To Make Counter the Studient in the dashboard:

function Counter($table,$colName)
{
    global $con; 

    $select = "SELECT COUNT($colName) FROM $table WHERE `admin` != 1 ";
    $getCount = $con->prepare($select);
    $getCount->execute();
    $counter = $getCount->fetchcolumn();
    return $counter;
}

// Function To Make Counter All in the dashboard:


function Counter_All($table,$colName)
{
    global $con; 

    $select = "SELECT COUNT($colName) FROM $table ";
    $getCount = $con->prepare($select);
    $getCount->execute();
    $counter = $getCount->fetchcolumn();
    return $counter;
}



// function to give you number men or women in website


function Get_People($table,$colName,$num)
{
    global $con; 

    $select = "SELECT COUNT($colName) FROM $table WHERE $colName = $num";
    $getCount = $con->prepare($select);
    $getCount->execute();
    $counter = $getCount->fetchcolumn();
    return $counter;
}




// Function To Get Admins in the dashboard:

function get_admins($table,$colName)
{
    global $con; 

    $select = "SELECT $colName FROM $table WHERE `admin` = 1 ";
    $getadmin = $con->prepare($select);
    $getadmin->execute();
    $admins = $getadmin->fetchAll();
    return $admins;
}



// Function To Get ALL PAGES in the dashboard:

function get_something($table,$colName)
{
    global $con; 

    $select = "SELECT $colName FROM $table";
    $getapages = $con->prepare($select);
    $getapages->execute();
    $pages = $getapages->fetchAll();
    return $pages;
}