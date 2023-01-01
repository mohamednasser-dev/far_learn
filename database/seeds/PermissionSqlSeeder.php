<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Permission::get()->count() == 0){
            $path = public_path('sql/permissions.sql');
            $sql = file_get_contents($path);
            DB::unprepared($sql);
        }
    }
}
