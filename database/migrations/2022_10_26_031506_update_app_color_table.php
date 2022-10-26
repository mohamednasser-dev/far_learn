<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAppColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('web_settings', function (Blueprint $table) {
            $table->string('app_main_color')->default('#0afbff');
            $table->string('app_second_color')->default('#eeff00');
            $table->string('app_background_color')->default('#ffffff');
            $table->string('app_button_color')->default('#00ffee');
            $table->string('app_font_light_color')->default('#ffffff');
            $table->string('app_font_dark_color')->default('#000000');
            $table->string('app_icon_color')->default('#00eeff');
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
