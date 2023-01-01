<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RolesSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Role::get()->count() == 0){
            $path = public_path('sql/roles.sql');
            $sql = file_get_contents($path);
            DB::unprepared($sql);
        }
    }
}
