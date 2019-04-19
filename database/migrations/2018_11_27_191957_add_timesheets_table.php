<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations_schedule', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('organisation_id')->unsigned();
            $table->integer('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('come_from');

            $table->foreign('organisation_id')->references('id')->on('organisations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organisations_schedule');
    }
}
