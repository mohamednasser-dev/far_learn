<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         $this->call(PermissionSqlSeeder::class);
        $this->call(RolesSqlSeeder::class);
        $this->call(RolesHasPermissionSqlSeeder::class);

//         $this->call(PermissionSeed::class);
//         $this->call(PermissionFinalSeed::class);
        $this->call(AdminSeeder::class);
        $this->call(RolesSeeder::class);
         $this->call(SettingsSeeder::class);
         $this->call(NationalitySeeder::class);
    }
}
