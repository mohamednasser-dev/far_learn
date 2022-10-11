<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('first_name_ar');
            $table->string('mid_name_ar');
            $table->string('last_name_ar');
            $table->string('first_name_en');
            $table->string('mid_name_en');
            $table->string('last_name_en');
            $table->enum('gender',['male','female'])->default('male');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('main_lang');
            $table->string('country');
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status',['active','unactive'])->default('active');
            $table->enum('is_new',['y', 'n', 'accepted', 'rejected'])->default('y');
            $table->enum('is_verified',['0', '1'])->default('0');
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
        Schema::dropIfExists('teachers');
    }
}
