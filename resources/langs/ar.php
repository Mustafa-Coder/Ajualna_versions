<?php


function lang($translate)
{
    static $lang  = array(

        // Navbar:
        "name_site" => "جيل",
        "name_home" => " الرئيسية",
        "Ques" =>  " الاسئلة الشائعة ",
        "pf" => "الصفحة",
        "set" => "الاعدادات",
        "log" => "تسجيل ",
        "dash" => "المدير",
        "add" => "اضافة صفحة",
        "sup" => "الدعم",
        // post edit
        "ed" => "تعديل",
        "de" => "مسح",
        "hi" => "إخفاء",
        "re" => "مشكلة",
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
