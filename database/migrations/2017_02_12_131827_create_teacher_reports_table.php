<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('User');
            $table->integer('company_id');
            $table->foreign('student_id')->references('id')->on('User');
            $table->integer('season');
            $table->text('advantage_disadvantage_improvement');
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
        Schema::drop('teacher_reports');
    }
}
