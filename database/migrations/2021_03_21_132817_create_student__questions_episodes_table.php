<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentQuestionsEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student__questions_episodes', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('episode_id');
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('cascade');
            $table->integer('episode_course_id');
            $table->foreign('episode_course_id')->references('id')->on('episode_course_days')->onDelete('cascade');
            $table->integer('from_surah_id');
            $table->integer('from_num');
            $table->integer('to_surah_id');
            $table->integer('to_num');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student__questions_episodes');
    }
}
