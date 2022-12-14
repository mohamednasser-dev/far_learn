<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSubjects2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->double('class_amount');
            $table->bigInteger('from_surah_id')->unsigned()->nullable();
            $table->foreign('from_surah_id')->references('id')->on('plan_surahs')->onDelete('restrict');
            $table->string('from_num');
            $table->bigInteger('to_surah_id')->unsigned()->nullable();
            $table->foreign('to_surah_id')->references('id')->on('plan_surahs')->onDelete('restrict');
            $table->string('to_num');
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
