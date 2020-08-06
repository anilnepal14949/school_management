<?php

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
        Schema::create('results', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('student');
            $table->string('sub1th');
            $table->string('sub1pr');
            $table->string('sub2th');
            $table->string('sub2pr');
            $table->string('sub3th');
            $table->string('sub3pr');
            $table->string('sub4th');
            $table->string('sub4pr');
            $table->string('sub5th');
            $table->string('sub5pr');
            $table->string('sub6th');
            $table->string('sub6pr');
            $table->string('sub7th');
            $table->string('sub7pr');
            $table->string('sub8th');
            $table->string('sub8pr');
            $table->string('sub9th');
            $table->string('sub9pr');
            $table->string('sub10th');
            $table->string('sub10pr');
            $table->string('sub11th');
            $table->string('sub11pr');
            $table->string('sub12th');
            $table->string('sub12pr');
            $table->string('sub13th');
            $table->string('sub13pr');
            $table->string('sub14th');
            $table->string('sub14pr');
            $table->string('sub15th');
            $table->string('sub15pr');
            $table->string('sub16th');
            $table->string('sub16pr');
            $table->string('sub17th');
            $table->string('sub17pr');
            
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
        Schema::drop('results');
    }
}
