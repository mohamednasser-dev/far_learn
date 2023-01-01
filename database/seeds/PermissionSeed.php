<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //mail
        Permission::updateOrCreate([
            'name' => "inside mail",//can value
            'name_ar' => "البريد الداخلى",//name_ar
            'type' => "mail",//name_ar
        ]);

        Permission::updateOrCreate([
            'name' => "outside mail",//can value
            'name_ar' => "البريد الخارجى",//name_ar
            'type' => "mail",//name_ar
        ]);

    //students
        Permission::updateOrCreate([
            'name' => "New students",//can value
            'name_ar' => "الطلاب الجدد",//name_ar
            'type' => "students",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Distance education students",//can value
            'name_ar' => "طلاب التعليم عن بعد",//name_ar
            'type' => "students",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Complexes students",//can value
            'name_ar' => "طلاب المجمعات",//name_ar
            'type' => "students",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Dorr students",//can value
            'name_ar' => "طلاب الدور",//name_ar
            'type' => "students",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Refused students to register in the system",//can value
            'name_ar' => "الطلاب المرفوضين بالتسجيل بالنظام",//name_ar
            'type' => "students",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "follow up absence",//can value
            'name_ar' => "متابعه الغياب",//name_ar
            'type' => "students",//name_ar
        ]);

    //teachers
        Permission::updateOrCreate([
            'name' => "new teachers",//can value
            'name_ar' => "المعلمين الجدد",//name_ar
            'type' => "teachers",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Distance education teachers",//can value
            'name_ar' => "معلمين التعليم عن بعد",//name_ar
            'type' => "teachers",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Complexes teachers",//can value
            'name_ar' => "معلمين المجمعات",//name_ar
            'type' => "teachers",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "dorr teachers",//can value
            'name_ar' => "معلمين الدور",//name_ar
            'type' => "teachers",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Refused teachers to register in the system",//can value
            'name_ar' => "المعلمين المرفوضين بالتسجيل بالنظام",//name_ar
            'type' => "teachers",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "New teacher interviews",//can value
            'name_ar' => "مقابلات المعلمين الجدد",//name_ar
            'type' => "teachers",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Teachers permission requests",//can value
            'name_ar' => "طلبات استئذان المعلمين",//name_ar
            'type' => "teachers",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Add absence and presence",//can value
            'name_ar' => "أضافة الغياب والحضور",//name_ar
            'type' => "teachers",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "see absence",//can value
            'name_ar' => "رؤية الغياب",//name_ar
            'type' => "teachers",//name_ar
        ]);




//episodes
        Permission::updateOrCreate([
            'name' => "Distance education episodes",//can value
            'name_ar' => "حلقات التعليم عن بعد",//name_ar
            'type' => "episodes",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Complexes",//can value
            'name_ar' => "المجمعات",//name_ar
            'type' => "episodes",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "women's dorrs",//can value
            'name_ar' => "الدور النسائية",//name_ar
            'type' => "episodes",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Requests to join a distance education seminar",//can value
            'name_ar' => "طلبات الانضمام لحلقة تعليم عن بعد",//name_ar
            'type' => "episodes",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Episode replay requests",//can value
            'name_ar' => "طلبات أعادة تشغيل الحلقة",//name_ar
            'type' => "episodes",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Loop extension",//can value
            'name_ar' => "تمديد الحلقة",//name_ar
            'type' => "episodes",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Certificates",//can value
            'name_ar' => "الشهادات",//name_ar
            'type' => "episodes",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Episode Rating",//can value
            'name_ar' => "تقييم الحلقات",//name_ar
            'type' => "episodes",//name_ar
        ]);

//subjects
        Permission::updateOrCreate([
            'name' => "origin curriculum",//can value
            'name_ar' => "اصل المناهج",//name_ar
            'type' => "subjects",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Distance education evaluation settings",//can value
            'name_ar' => "اعدادات التقييم عن بعد",//name_ar
            'type' => "subjects",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Assessment Statement Settings",//can value
            'name_ar' => "اعدادات التقييم للمجمعات و الدور",//name_ar
            'type' => "subjects",//name_ar
        ]);

//reports
        Permission::updateOrCreate([
            'name' => "data report",//can value
            'name_ar' => "تقرير البيانات",//name_ar
            'type' => "reports",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Staff roles settings",//can value
            'name_ar' => "تقرير حضور الطلاب",//name_ar
            'type' => "reports",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "productivity report",//can value
            'name_ar' => "تقرير الانتاجية",//name_ar
            'type' => "reports",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Daily recitation report",//can value
            'name_ar' => "تقرير التسميع اليومي",//name_ar
            'type' => "reports",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Employee data report",//can value
            'name_ar' => "تقرير بيانات الموظفين",//name_ar
            'type' => "reports",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Teacher attendance report",//can value
            'name_ar' => "تقرير حضور المعلمين",//name_ar
            'type' => "reports",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "teacher achievement report",//can value
            'name_ar' => "تقرير انجاز المعلمين",//name_ar
            'type' => "reports",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "teacher evaluation report",//can value
            'name_ar' => "تقرير تقييم المعلمين",//name_ar
            'type' => "reports",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Student's history",//can value
            'name_ar' => "السجل التاريخى للطالب",//name_ar
            'type' => "reports",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Memorization line count report",//can value
            'name_ar' => "تقرير عدد اسطر الحفظ",//name_ar
            'type' => "reports",//name_ar
        ]);

//sms
        Permission::updateOrCreate([
            'name' => "Message link settings API",//can value
            'name_ar' => "اعدادات ربط الرسائل API",//name_ar
            'type' => "sms",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Send a new message",//can value
            'name_ar' => "ارسال رسالة جديدة",//name_ar
            'type' => "sms",//name_ar
        ]);

//settings
        Permission::updateOrCreate([
            'name' => "General Sign_up",//can value
            'name_ar' => "الإعدادات العامة",//name_ar
            'type' => "settings",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Episode evaluation questions",//can value
            'name_ar' => "اسئلة تقييم الحلقات",//name_ar
            'type' => "settings",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Qualifications",//can value
            'name_ar' => "المؤهلات الدراسية",//name_ar
            'type' => "settings",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Job title",//can value
            'name_ar' => "المسمى الوظيفى",//name_ar
            'type' => "settings",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "degree of kinship",//can value
            'name_ar' => "درجة القرابة",//name_ar
            'type' => "settings",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Nationalities",//can value
            'name_ar' => "الجنسيات",//name_ar
            'type' => "settings",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Countries",//can value
            'name_ar' => "الدول",//name_ar
            'type' => "settings",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "School years",//can value
            'name_ar' => "السنين الدراسية",//name_ar
            'type' => "settings",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "User settings",//can value
            'name_ar' => "اعدادات المستخدمين",//name_ar
            'type' => "settings",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Managing tasks and powers",//can value
            'name_ar' => "إدارة المهام و الصلاحيات",//name_ar
            'type' => "settings",//name_ar
        ]);
//web
        Permission::updateOrCreate([
            'name' => "Sliders",//can value
            'name_ar' => "السليدر",//name_ar
            'type' => "web",//name_ar
        ]);
        Permission::updateOrCreate([
            'name' => "Publications",//can value
            'name_ar' => "المنشورات",//name_ar
            'type' => "web",//name_ar
        ]);
    }
}
