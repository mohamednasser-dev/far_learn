<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_interviews', function (Blueprint $table) {
            $table->id();
            $table->date('interview_date');
            $table->time('interview_time');
            $table->timestamp('selected_date');
            $table->string('meeting_id');
            $table->string('topic');
            $table->string('agenda');
            $table->string('start_time');
            $table->string('passcode');
            $table->string('join_url');
            $table->bigInteger('teacher_id')->unsigned()->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('restrict');
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
        Schema::dropIfExists('teacher_interviews');
    }
}
