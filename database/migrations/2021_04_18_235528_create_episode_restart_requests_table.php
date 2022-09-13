<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeRestartRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_restart_requests', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['new','accepted','rejected'])->default('new');
            $table->enum('admin_view',['0','1'])->default('0');
            $table->bigInteger('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('restrict');
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('episode_sections')->onDelete('restrict');
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
        Schema::dropIfExists('episode_restart_requests');
    }
}
