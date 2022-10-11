<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::first();
        User::updateOrCreate(
            [
                'id' => 1 ,
                'name' => 'admin',
                'unique_name' => 'admin@admin.com',
                'phone' => '2020',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
                'role_id' => $role->id,
                'type' => 'admin',
                'country_code' => '+966',
                'user_phone' => '+9662020',
                'is_new' => 'accepted',
            ]
        );
    }
}
