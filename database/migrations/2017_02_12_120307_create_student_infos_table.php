<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30);
            $table->string('class',10);
            $table->integer('studentId',10);
            $table->boolean('isMale');
            $table->boolean('laptop');
            $table->string('address');
            $table->string('phone',18);
            $table->string('email');
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
        Schema::drop('student_infos');
    }
}
