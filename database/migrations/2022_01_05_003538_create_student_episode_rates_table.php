<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEpisodeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_episode_rates', function (Blueprint $table) {
            $table->id();
            $table->string('notes')->nullable();
            $table->bigInteger('rate');
            $table->bigInteger('questions_id')->unsigned();
            $table->foreign('questions_id')->references('id')->on('episode_rate_questions')->onDelete('restrict');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('restrict');
            $table->bigInteger('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('restrict');
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('episode_sections')->onDelete('restrict');
            $table->bigInteger('episode_id')->unsigned();
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('restrict');
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
        Schema::dropIfExists('student_episode_rates');
    }
}
