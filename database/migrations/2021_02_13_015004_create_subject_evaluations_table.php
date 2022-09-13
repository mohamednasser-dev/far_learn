<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_evaluations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('restrict');
            $table->enum('type',['daily','tracomy'])->default('daily');
            $table->bigInteger('amount_tracomy');
            $table->bigInteger('highest_rate');
            $table->bigInteger('excellent');
            $table->bigInteger('very_good');
            $table->bigInteger('good');
            $table->bigInteger('not_pathing');
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
        Schema::dropIfExists('subject_evaluations');
    }
}
