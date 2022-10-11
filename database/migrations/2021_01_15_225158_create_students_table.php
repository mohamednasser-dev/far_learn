<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('unique_name');
            $table->string('email')->unique();
            $table->string('first_name_ar');
            $table->string('mid_name_ar');
            $table->string('last_name_ar');
            $table->string('first_name_en');
            $table->string('mid_name_en');
            $table->string('last_name_en');
            $table->enum('gender',['male','female'])->default('male');
            $table->enum('epo_type',['far_learn', 'dorr', 'mogmaa'])->default('far_learn');

            $table->date('date_of_birth')->nullable();
            $table->string('password');
            $table->string('main_lang')->default('ar');
            $table->bigInteger('country')->unsigned();

            $table->string('phone')->nullable();
            $table->string('country_code')->nullable()->default('+966');
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status',['active','unactive'])->default('active');
            $table->enum('is_new',['y', 'n', 'accepted', 'rejected'])->default('y');
            $table->enum('interview',['y', 'n'])->default('n');
            $table->enum('is_verified',['0', '1'])->default('0');
            $table->integer('code')->nullable();
            $table->string('api_token')->nullable();
            $table->string('ident_num')->nullable();
            $table->bigInteger('qualification')->nullable();
            $table->string('nationality')->nullable();
            $table->double('save_quran_num')->nullable();
            $table->string('save_quran_limit')->nullable();
            $table->enum('parent_data',['not_complete', 'complete'])->default('complete');
            $table->enum('complete_data',['0', '1'])->default('0');
            $table->bigInteger('admin_view')->default(0);
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
        Schema::dropIfExists('students');
    }
}
