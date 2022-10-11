<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unique_name');
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->bigInteger('role_id')->unsigned()->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('college_id')->nullable();
            $table->string('api_token')->nullable();
            $table->string('password');
            $table->enum('type',['admin','user'])->default('user');
            $table->enum('gender',['male','female'])->default('male');
            $table->string('work_place')->nullable();
            $table->enum('status',['active','unactive'])->default('active');
            $table->string('main_lang')->default('ar');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
