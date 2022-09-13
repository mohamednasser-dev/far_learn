<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colleges', function (Blueprint $table) {
            $table->String('mosque_name')->nullable();
            $table->String('mogmaa_time')->nullable(); //not
            $table->String('mogmaa_type')->nullable();
            $table->json('study_days')->nullable();//not
            $table->json('study_period')->nullable();//not
            $table->String('episode_form')->nullable();
            $table->String('location_lang')->nullable();
            $table->String('location_lat')->nullable();
            $table->String('range')->nullable();
            $table->bigInteger('teacher_id')->nullable()->unsigned();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
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
