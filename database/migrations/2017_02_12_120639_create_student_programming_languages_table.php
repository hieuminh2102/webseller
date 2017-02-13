<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProgrammingLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_programming_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studentId');
            $table->integer('programmingLanguageId');
            $table->smallInteger('level');

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
        Schema::drop('student_programming_languages');
    }
}
