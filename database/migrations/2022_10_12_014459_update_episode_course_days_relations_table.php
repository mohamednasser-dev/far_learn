<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEpisodeCourseDaysRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('episode_course_days', function (Blueprint $table) {

            $table->bigInteger('week_id')->unsigned()->nullable();
            $table->foreign('week_id')->references('id')->on('plan_weeks')->onDelete('restrict');

            $table->bigInteger('day_id')->unsigned()->nullable();
            $table->foreign('day_id')->references('id')->on('days')->onDelete('restrict');

            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('notify_at')->useCurrent();
            $table->enum('send_status',['sended', 'not_sended'])->default('not_sended');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('episode_course_days', function (Blueprint $table) {
            //
        });
    }
}
