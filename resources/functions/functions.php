<?php

// TITLE PAGE version one

function title($type = null){

    global $PAGENAME;

    if (isset($PAGENAME)):

        echo  $PAGENAME;
    endif;


    if (!empty($type) && $type != null):

        echo $type;

    endif;

}


// function NamePages($pageid){

//     global $con;

//     $select = "SELECT $colName FROM $table $dosomething";
//     $getapages = $con->prepare($select);
//     $getapages->execute();
//     $pages = $getapages->fetchAll();
//     return $pages;

// }


// SOURCE PAGE

function sourcepage($PATHNAME)
{

    echo "../" . $PATHNAME;

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


function Get_People($table,$colName,$codition)
{
    global $con;

    $select = "SELECT COUNT($colName) FROM $table WHERE $codition ";
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

function get_something($table,$colName,$dosomething = null ,$namestatus)
{
    global $con;

    $select = "SELECT $colName FROM $table  $dosomething ";
    $getapages = $con->prepare($select);
    $getapages->execute();
    $pages = $getapages->$namestatus();
    return $pages;
}

// function also


function get_something_also($table,$colName,$dosomething = null)
{
    global $con;
    global $countsomething;

    $select = "SELECT $colName FROM $table $dosomething  ";
    $getapages = $con->prepare($select);
    $getapages->execute();
    $pages = $getapages->fetchAll();
    $countsomething = $getapages->rowcount();
    return $pages;
    return $countsomething;

}


// Function Updateing

function update($table,$namecol1,$namecolid2,$dataupload,$userid)
{
    global $con;

    $update = "UPDATE $table SET $namecol1 = :avatar WHERE $namecolid2 = :id ";
    $setUpdate = $con->prepare($update);
    $setUpdate->bindparam(":avatar",$dataupload);
    $setUpdate->bindparam(":id",$userid);
    $setUpdate->execute();


}


// FUNCTION COUNT LIKES :::
function likesCount($clomun,$table,$condition = null,$status)
{
    global $con;

    $select = "SELECT COUNT($clomun) FROM $table";
    $getapages = $con->prepare($select);
    $getapages->execute();
    $pages = $getapages->$status();
    return $pages;

}


// FUNCTION LINK

function Links($link = null,$underscor = null)
{
    if($link != null && $underscor != null):
        echo $link.$underscor;
    endif;
}


// UPDATE DATA USERS


function updatedata($table,$columnname,$something_data,$condition = null)
{
     // CHECK IF DATA = SAME DATA
            global $con;
            $UP = "UPDATE $table SET $columnname = :something   $condition ";
            $SET_UP = $con->prepare($UP);
            $SET_UP->bindparam(":something",$something_data);
            $SET_UP->execute();

}


// Check if column name is exists :
    
function CheckData($col,$table,$do,$something)
{
    global $con;
    global $countcheck;

    $sta = "SELECT $col FROM $table $do $col = :something ";
    $setSta  = $con->prepare($sta);
    $setSta->bindparam(":something",$something);
    $setSta->execute();
    $countcheck = $setSta->rowcount();    
    return  $countcheck;
}
