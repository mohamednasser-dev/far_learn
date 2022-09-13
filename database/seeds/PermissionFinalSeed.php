<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionFinalSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//teachers
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
//episodes
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
//reports
        $permission = Permission::create([
            'name' => "Daily recitation report",//can value
            'name_ar' => "تقرير التسميع اليومي",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "teacher evaluation report",//can value
            'name_ar' => "تقرير تقييم المعلمين",//name_ar
            'type' => "reports",//name_ar
        ]);
        $permission = Permission::create([
            'name' => "Memorization line count report",//can value
            'name_ar' => "تقرير عدد اسطر الحفظ",//name_ar
            'type' => "reports",//name_ar
        ]);
//sms
        $permission = Permission::create([
            'name' => "Send a new message",//can value
            'name_ar' => "ارسال رسالة جديدة",//name_ar
            'type' => "sms",//name_ar
        ]);
//settings
        $permission = Permission::create([
            'name' => "Episode evaluation questions",//can value
            'name_ar' => "اسئلة تقييم الحلقات",//name_ar
            'type' => "settings",//name_ar
        ]);
    }
}
