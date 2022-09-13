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
        $permission = Permission::create([
            'name' => "inside mail",//can value
            'name_ar' => "البريد الداخلى",//name_ar
            'type' => "mail",//name_ar
        ]);

        $permission = Permission::create([
            'name' => "outside mail",//can value
            'name_ar' => "البريد الخارجى",//name_ar
            'type' => "mail",//name_ar
        ]);

    //students
        $permission = Permission::create([
            'name' => "New students",//can value
            'name_ar' => "الطلاب الجدد",//name_ar
            'type' => "students",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Distance education students",//can value
            'name_ar' => "طلاب التعليم عن بعد",//name_ar
            'type' => "students",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Complexes students",//can value
            'name_ar' => "طلاب المجمعات",//name_ar
            'type' => "students",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Dorr students",//can value
            'name_ar' => "طلاب الدور",//name_ar
            'type' => "students",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Refused students to register in the system",//can value
            'name_ar' => "الطلاب المرفوضين بالتسجيل بالنظام",//name_ar
            'type' => "students",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "follow up absence",//can value
            'name_ar' => "متابعه الغياب",//name_ar
            'type' => "students",//name_ar
        ]);

    //teachers
        $permission = Permission::create([
            'name' => "new teachers",//can value
            'name_ar' => "المعلمين الجدد",//name_ar
            'type' => "teachers",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Distance education teachers",//can value
            'name_ar' => "معلمين التعليم عن بعد",//name_ar
            'type' => "teachers",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Complexes teachers",//can value
            'name_ar' => "معلمين المجمعات",//name_ar
            'type' => "teachers",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "dorr teachers",//can value
            'name_ar' => "معلمين الدور",//name_ar
            'type' => "teachers",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Refused teachers to register in the system",//can value
            'name_ar' => "المعلمين المرفوضين بالتسجيل بالنظام",//name_ar
            'type' => "teachers",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "New teacher interviews",//can value
            'name_ar' => "مقابلات المعلمين الجدد",//name_ar
            'type' => "teachers",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Teachers permission requests",//can value
            'name_ar' => "طلبات استئذان المعلمين",//name_ar
            'type' => "teachers",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Add absence and presence",//can value
            'name_ar' => "أضافة الغياب والحضور",//name_ar
            'type' => "teachers",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "see absence",//can value
            'name_ar' => "رؤية الغياب",//name_ar
            'type' => "teachers",//name_ar
        ]);




//episodes
        $permission = Permission::create([
            'name' => "Distance education episodes",//can value
            'name_ar' => "حلقات التعليم عن بعد",//name_ar
            'type' => "episodes",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Complexes",//can value
            'name_ar' => "المجمعات",//name_ar
            'type' => "episodes",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "women's dorrs",//can value
            'name_ar' => "الدور النسائية",//name_ar
            'type' => "episodes",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Requests to join a distance education seminar",//can value
            'name_ar' => "طلبات الانضمام لحلقة تعليم عن بعد",//name_ar
            'type' => "episodes",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Episode replay requests",//can value
            'name_ar' => "طلبات أعادة تشغيل الحلقة",//name_ar
            'type' => "episodes",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Loop extension",//can value
            'name_ar' => "تمديد الحلقة",//name_ar
            'type' => "episodes",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Certificates",//can value
            'name_ar' => "الشهادات",//name_ar
            'type' => "episodes",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Episode Rating",//can value
            'name_ar' => "تقييم الحلقات",//name_ar
            'type' => "episodes",//name_ar
        ]);

//subjects
        $permission = Permission::create([
            'name' => "origin curriculum",//can value
            'name_ar' => "اصل المناهج",//name_ar
            'type' => "subjects",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Distance education evaluation settings",//can value
            'name_ar' => "اعدادات التقييم عن بعد",//name_ar
            'type' => "subjects",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Assessment Statement Settings",//can value
            'name_ar' => "اعدادات التقييم للمجمعات و الدور",//name_ar
            'type' => "subjects",//name_ar
        ]);

//reports
        $permission = Permission::create([
            'name' => "data report",//can value
            'name_ar' => "تقرير البيانات",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Staff roles settings",//can value
            'name_ar' => "تقرير حضور الطلاب",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "productivity report",//can value
            'name_ar' => "تقرير الانتاجية",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Daily recitation report",//can value
            'name_ar' => "تقرير التسميع اليومي",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Employee data report",//can value
            'name_ar' => "تقرير بيانات الموظفين",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Teacher attendance report",//can value
            'name_ar' => "تقرير حضور المعلمين",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "teacher achievement report",//can value
            'name_ar' => "تقرير انجاز المعلمين",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "teacher evaluation report",//can value
            'name_ar' => "تقرير تقييم المعلمين",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Student's history",//can value
            'name_ar' => "السجل التاريخى للطالب",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Memorization line count report",//can value
            'name_ar' => "تقرير عدد اسطر الحفظ",//name_ar
            'type' => "reports",//name_ar
        ]);

//sms
        $permission = Permission::create([
            'name' => "Message link settings API",//can value
            'name_ar' => "اعدادات ربط الرسائل API",//name_ar
            'type' => "sms",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Send a new message",//can value
            'name_ar' => "ارسال رسالة جديدة",//name_ar
            'type' => "sms",//name_ar
        ]);

//settings
        $permission = Permission::create([
            'name' => "General Sign_up",//can value
            'name_ar' => "الإعدادات العامة",//name_ar
            'type' => "settings",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Episode evaluation questions",//can value
            'name_ar' => "اسئلة تقييم الحلقات",//name_ar
            'type' => "settings",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Qualifications",//can value
            'name_ar' => "المؤهلات الدراسية",//name_ar
            'type' => "settings",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Job title",//can value
            'name_ar' => "المسمى الوظيفى",//name_ar
            'type' => "settings",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "degree of kinship",//can value
            'name_ar' => "درجة القرابة",//name_ar
            'type' => "settings",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Nationalities",//can value
            'name_ar' => "الجنسيات",//name_ar
            'type' => "settings",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Countries",//can value
            'name_ar' => "الدول",//name_ar
            'type' => "settings",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "School years",//can value
            'name_ar' => "السنين الدراسية",//name_ar
            'type' => "settings",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "User settings",//can value
            'name_ar' => "اعدادات المستخدمين",//name_ar
            'type' => "settings",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Managing tasks and powers",//can value
            'name_ar' => "إدارة المهام و الصلاحيات",//name_ar
            'type' => "settings",//name_ar
        ]);
//web
        $permission = Permission::create([
            'name' => "Sliders",//can value
            'name_ar' => "السليدر",//name_ar
            'type' => "web",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Publications",//can value
            'name_ar' => "المنشورات",//name_ar
            'type' => "web",//name_ar
        ]);
    }
}
