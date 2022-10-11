<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodeSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode_sections', function (Blueprint $table) {
            $table->id();
            $table->date('epo_date');
            $table->date('epo_link');

            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->enum('status', ['started', 'ended'])->default('started');

            $table->bigInteger('episode_id')->unsigned();
            $table->foreign('episode_id')->references('id')->on('episodes')->onDelete('restrict');
            $table->bigInteger('come_num')->default(0);
            $table->integer('long_time_fifteen')->default(0);
            $table->integer('long_time_thirty')->default(0);
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
        Schema::dropIfExists('episode_sections');
    }
}
