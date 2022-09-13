<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inboxes', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->string('subject');
            $table->bigInteger('sender_id')->unsigned();
            $table->bigInteger('receiver_id')->nullable()->unsigned();
            $table->enum('sender_type', ['admin', 'teacher', 'student'])->default('admin');
            $table->enum('receiver_type', ['admin', 'teacher', 'student'])->default('admin');

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
        Schema::dropIfExists('inboxes');
    }
}
