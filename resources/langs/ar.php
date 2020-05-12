<?php 


function lang($translate)
{
    static $lang  = array(

        // Navbar: 
        "name_site" => "اجيالنا",
        "name_home" => " الرئيسية",
        "Ques" =>  " الاسئلة الشائعة ",
        "pf" => "الصفحة",   
        "set" => "الاعدادات",
        "log" => "تسجيل ",
        "dash" => "المدير",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        "" => "",
        // home page:
        "col_tar" => "جميع الكليات",
        "stu_tra" => "طلاب جامعتك",
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