<?php

use Illuminate\Database\Seeder;
use App\Models\Nationality ;
class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Nationality::get()->count() == 0){
            $path = public_path('sql/nationalities.sql');
            $sql = file_get_contents($path);
            DB::unprepared($sql);
        }

    }
}
