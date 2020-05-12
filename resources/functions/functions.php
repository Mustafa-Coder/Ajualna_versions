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

    $select = "SELECT $colName FROM $table $dosomething";
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


// FUNCTION CREATE ::::::
// [Documentaion]
/*
    $table => Table name for database
    # PARAMETERS.......
    $one => is defualt 
    $two => is defualt 
    $three => Equel null
    $four => Equel null
    $five => Equel null
    $six => Equel null
    # VALUES........
    $vone => is defualt 
    $vtwo => is defualt 
    $vthree => Equel null
    $vfour => Equel null
    $vfive => Equel null
    $vsix => Equel null
    # DATA..........
    $dataone => is defualt
    $datatwo => is defualt
    $datathree =>  null 
    $datafour =>  null 
    $datafive =>  null
    $datasix =>  null
*/

// function Createall(
//                   // TABLES AND COLUMNS NAMES
//                    $table,$one,$two,$three  = null ,
//                    $four  = null ,$five  = null ,$six = null,
//                    // VALUES
//                    $vone,$vtwo,$vthree = null,$vfour = null,$vfive = null,$vsix = null,
//                    // DATAPOSTORGET
//                    $dataone,$datatwo,$datathree = null , $datafour = null , $datafive = null,$datasix = null
//                    )
// {
//         global $con;
//         global $countinsert;

//         $InsertStatment = "INSERT INTO $table($one,$two,$three,$four,$five,$six)VALUES($vone,$vtwo,$vthree,$vfour,$vfive,$vsix)";
//         $statntment = $con->prepare($InsertStatment);
//         // $statntment->execute(array(
//         //     "$vone" => $dataone,
//         //     "$vtwo" => $datatwo,
//         //     "$vthree" => $datathree,
//         //     "$vfour" =>$datafour,
//         //     "$vfive" => $datafive,
//         //     "$vsix" => $datasix
//         // ));
//         $statntment->bindparam("$vone,$vtwo,$vthree,$vfour,$vfive,$vsix",$dataone,$datatwo,$datathree,$datafour,$datafive,$datasix);
//         // $statntment->bindparam("$vtwo",$datatwo);
//         // $statntment->bindparam("$vthree",$datathree); 
//         // $statntment->bindparam("$vfour",$datafour);
//         // $statntment->bindparam("$vfive",$datafive);
//         // $statntment->bindparam("$vsix",$datasix);
//         $statntment->execute();
//         $countinsert = $statntment->rowcount();
//         // $fetchQuery = $stat
//         return $countinsert;
// }


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