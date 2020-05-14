<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasknNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskn_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('uniqueid');
            $table->string('department');
            $table->string('batch');
            $table->string('read');
            $table->string('subject')->nullable()->default('none');
            $table->mediumText('description');
            $table->string('type');
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
        Schema::dropIfExists('taskn_notes');
    }
}
