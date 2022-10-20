<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEpisodeStudentsNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('episode_students', function (Blueprint $table) {
            $table->string('status')->default('new');
            $table->enum('deleted',['0','1'])->default('0');
            $table->enum('student_view',['0','1'])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('episode_students', function (Blueprint $table) {
            //
        });
    }
}
