<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {

            $table->foreign('country')->references('id')->on('countries')->onDelete('cascade');

            $table->bigInteger('level_id')->unsigned()->nullable();
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('restrict');

            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict');

            $table->bigInteger('subject_level_id')->unsigned()->nullable();
            $table->foreign('subject_level_id')->references('id')->on('subjects')->onDelete('restrict');

            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
}
