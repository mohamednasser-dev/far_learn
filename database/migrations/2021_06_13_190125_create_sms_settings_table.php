<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_settings', function (Blueprint $table) {
            $table->id();
            $table->string("url");
            $table->string("encoding");
            $table->string("encoding_value");
            $table->string("user_id");
            $table->string("user_id_value");
            $table->string("to");
            $table->string("password");
            $table->string("password_value");
            $table->string("msg");
            $table->string("sender");
            $table->string("sender_value");
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
        Schema::dropIfExists('sms_settings');
    }
}
