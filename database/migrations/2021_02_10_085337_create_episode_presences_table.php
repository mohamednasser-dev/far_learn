<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodePresencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_presences', function (Blueprint $table) {
            $table->id();
            $table->enum('deleted',['0','1'])->default('0');
            $table->bigInteger('episode_id')->unsigned();
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('restrict');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('restrict');
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
        Schema::dropIfExists('episode_presences');
    }
}
