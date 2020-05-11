<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('department');
            $table->string('batch');
            $table->string('subject');
            $table->string('total');
            $table->string('scoredmarks');
            $table->string('outofmarks');
            $table->string('grade');
            /* $table->string('GP');
            $table->string('CG');
            $table->string('GPA');
            $table->string('remark');
            $table->string('grade');
            $table->string('credits'); */
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
        Schema::dropIfExists('results');
    }
}
