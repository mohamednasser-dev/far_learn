<?php

use Illuminate\Database\Seeder;

class RolesHasPermissionSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('role_has_permissions')->get()->count() == 0){
            $path = public_path('sql/role_has_permissions.sql');
            $sql = file_get_contents($path);
            DB::unprepared($sql);
        }
    }
}
