<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('User');
            $table->integer('company_id');
            $table->foreign('company_id')->references('id')->on('company');
            $table->integer('season');
            $table->foreign('season')->references('id')->on('season');
            $table->integer('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teacher');
            $table->string('purpose',100);
            $table->string('job_content');
            $table->string('result');
            $table->string('advantage');
            $table->string('shortcoming');
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
        Schema::drop('student_reports');
    }
}
