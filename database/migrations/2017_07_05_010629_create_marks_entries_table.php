<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarksEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks_entries', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('student');
            $table->integer('sub1th');
            $table->integer('sub1pr');
            $table->integer('sub2th');
            $table->integer('sub2pr');
            $table->integer('sub3th');
            $table->integer('sub3pr');
            $table->integer('sub4th');
            $table->integer('sub4pr');
            $table->integer('sub5th');
            $table->integer('sub5pr');
            $table->integer('sub6th');
            $table->integer('sub6pr');
            $table->integer('sub7th');
            $table->integer('sub7pr');
            $table->integer('sub8th');
            $table->integer('sub8pr');
            $table->integer('sub9th');
            $table->integer('sub9pr');
            $table->integer('sub10th');
            $table->integer('sub10pr');
            $table->integer('sub11th');
            $table->integer('sub11pr');
            $table->integer('sub12th');
            $table->integer('sub12pr');
            $table->integer('sub13th');
            $table->integer('sub13pr');
            $table->integer('sub14th');
            $table->integer('sub14pr');
            $table->integer('sub15th');
            $table->integer('sub15pr');
            $table->integer('sub16th');
            $table->integer('sub16pr');
            $table->integer('sub17th');
            $table->integer('sub17pr');
            $table->integer('total');
            $table->float('percentage');
            $table->string('grade');
            $table->integer('status');
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
        Schema::drop('marks_entries');
    }
}
