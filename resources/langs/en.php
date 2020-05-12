<?php 


function lang($translate)
{
    static $lang  = array(

        // Navbar: 
        "name_site" => "Ajualna",
        "name_home" => " Home",
        "Ques" =>  " Questions ",
        "pf" => "Profile",   
        "set" => "Settings",
        "log" => "logout ",
        "dash" => "Dashboard",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        // home page:
        "col_tar" => "Colleges pages",
        "stu_tra" => "Students your College",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        "" => "",


    );

    return $lang[$translate];
}