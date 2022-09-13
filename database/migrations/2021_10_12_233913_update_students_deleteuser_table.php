<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentsDeleteuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->bigInteger('deleted_id')->nullable()->unsigned();
            $table->foreign('deleted_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->bigInteger('deleted_id')->nullable()->unsigned();
            $table->foreign('deleted_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::table('episodes', function (Blueprint $table) {
            $table->bigInteger('deleted_id')->nullable()->unsigned();
            $table->foreign('deleted_id')->references('id')->on('users')->onDelete('restrict');
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
