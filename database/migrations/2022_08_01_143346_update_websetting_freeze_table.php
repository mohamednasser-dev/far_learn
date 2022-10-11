<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWebsettingFreezeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('web_settings', function (Blueprint $table) {
            $table->integer('show_freeze')->default(0);
            $table->string('logo_ar')->nullable();
            $table->string('logo_en')->nullable();
            $table->string('color')->nullable();
            $table->string('color_side_bar')->nullable();
            $table->string('admin_logo_ar')->nullable();
            $table->string('admin_logo_en')->nullable();
            $table->string('about_ar')->nullable();
            $table->string('about_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_settings', function (Blueprint $table) {
            //
        });
    }
}
