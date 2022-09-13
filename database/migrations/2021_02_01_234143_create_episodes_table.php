<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->enum('deleted',['0','1'])->default('0');
            $table->enum('gender',['male','female'])->default('male');
            $table->bigInteger('level_id')->unsigned()->nullable();
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('restrict');
            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict');
            $table->bigInteger('subject_level_id')->unsigned()->nullable();
            $table->foreign('subject_level_id')->references('id')->on('subject_levels')->onDelete('restrict');
            $table->bigInteger('teacher_id')->unsigned()->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('restrict');
            $table->bigInteger('student_number');
            $table->enum('listen_type',['single','group'])->default('single');
            $table->enum('active',['y','n'])->default('y');
            $table->string('desc_ar');
            $table->string('desc_en');
            $table->time('time_from');
            $table->time('time_to');
            $table->string('student_link');
            $table->string('teacher_link');

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
        Schema::dropIfExists('episodes');
    }
}
