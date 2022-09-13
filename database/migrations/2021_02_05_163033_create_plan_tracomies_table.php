<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTracomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_tracomies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('week_id')->unsigned()->nullable();
            $table->foreign('week_id')->references('id')->on('plan_weeks')->onDelete('restrict');
            $table->bigInteger('day_id')->unsigned()->nullable();
            $table->foreign('day_id')->references('id')->on('plan_days')->onDelete('restrict');
            $table->bigInteger('from_surah_id')->unsigned()->nullable();
            $table->foreign('from_surah_id')->references('id')->on('plan_surahs')->onDelete('restrict');
            $table->string('from_num');
            $table->bigInteger('to_surah_id')->unsigned()->nullable();
            $table->foreign('to_surah_id')->references('id')->on('plan_surahs')->onDelete('restrict');
            $table->string('to_num');
            $table->bigInteger('sub_level_id')->unsigned()->nullable();
            $table->foreign('sub_level_id')->references('id')->on('subject_levels')->onDelete('restrict');
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
        Schema::dropIfExists('plan_tracomies');
    }
}
