<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inboxes', function (Blueprint $table) {
            $table->bigInteger('inbox_id')->unsigned()->nullable();
            $table->foreign('inbox_id')->references('id')->on('inboxes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('type', ['single', 'all_teachers', 'all_students'])->default('single');
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
