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
        'just_now' => 'الان',
        'minute_ago' => 'دقيقة',
        'minutes_ago' => 'دقائق',
        'hour_ago' => 'ساعة',
        'hours_ago' => 'ساعات',
        'day_ago' => 'يوم',
        'days_ago' => 'ايام',
        'week_ago' => 'أسبوع',
        'weeks_ago' => 'أسابيع',
        'month_ago' => 'شهر',
        'months_ago' => 'شهور',
        'year_ago' => 'سنة',
        'years_ago' => 'سنين'


    );

    return $lang[$translate];
}
