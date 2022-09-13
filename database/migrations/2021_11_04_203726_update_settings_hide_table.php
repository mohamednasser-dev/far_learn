<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSettingsHideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('web_settings', function (Blueprint $table) {
            $table->enum('show_mogmaa_dorr',['0','1'])->default('1');
            $table->enum('show_search_teacher',['0','1'])->default('1');
            $table->enum('show_free_subject',['0','1'])->default('1');
            $table->enum('show_fixed_subject',['0','1'])->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
