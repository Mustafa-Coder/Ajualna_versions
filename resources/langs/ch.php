<?php 


function lang($translate)
{
    static $lang = array (

        // Navbar:
        "name_site" => "JEEL",
        "name_home" => " Home",
        "Ques" =>  " Questions ",
        "pf" => "Profile",
        "set" => "Settings",
        "log" => "logout ",
        "dash" => "Dashboard",
        "add" => "Create Page",
        "sup" => "Support Box",
        "ed" => "Edit",
        "de" => "Delete",
        "hi" => "Hidden",
        "re" => "Rebort",
        // home page:
        "col_tar" => "Colleges pages",
        "stu_tra" => "Students your College",
        // time 
        'just_now' => '现在',
        'minute_ago' => '分钟前',
        'minutes_ago' => '几分钟前',
        'hour_ago' => 'hour ago',
        'hours_ago' => 'hours ago',
        'day_ago' => 'day ago',
        'days_ago' => 'days ago',
        'week_ago' => 'week ago',
        'weeks_ago' => 'weeks ago',
        'month_ago' => 'month ago',
        'months_ago' => 'months ago',
        'year_ago' => 'year ago',
        'years_ago' => 'years ago'


    );


    return $lang[$translate];
}