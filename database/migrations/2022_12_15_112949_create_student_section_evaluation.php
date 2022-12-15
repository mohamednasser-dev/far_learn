<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSectionEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_section_evaluations', function (Blueprint $table) {
            $table->integer('errors');
            $table->bigInteger('errortype_id')->unsigned();
            $table->foreign('errortype_id')->references('id')->on('error_types')->onDelete('restrict');

            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('restrict');

            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('episode_sections')->onDelete('restrict');

            $table->enum('status', ['new', 'ended'])->default('new');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_section_evaluations', function (Blueprint $table) {
            //
        });
    }
}
