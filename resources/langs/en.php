<?php


function lang($translate)
{
    static $lang  = array(

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
        'just_now' => 'Just now',
        'minute_ago' => 'minute',
        'minutes_ago' => 'minutes ago',
        'hour_ago' => 'hour',
        'hours_ago' => 'hours ago',
        'day_ago' => 'day',
        'days_ago' => 'days ago',
        'week_ago' => 'week',
        'weeks_ago' => 'weeks ago',
        'month_ago' => 'month',
        'months_ago' => 'months ago',
        'year_ago' => 'year',
        'years_ago' => 'years ago'


    );

    return $lang[$translate];
}
