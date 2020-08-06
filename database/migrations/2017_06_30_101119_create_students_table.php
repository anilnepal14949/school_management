<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('class');
            $table->string('section');
            $table->string('name');
            $table->string('address');
            $table->string('house');
            $table->string('gender');
            $table->integer('age');
            $table->string('parentName');
            $table->string('parentContact');
            $table->string('busStudent');
            $table->text('disability');
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
        Schema::drop('students');
    }
}
