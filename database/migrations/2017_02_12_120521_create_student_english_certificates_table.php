<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEnglishCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_english_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studentId');

            $table->integer('certificateId');
            $table->decimal('point',4,1);
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
        Schema::drop('student_english_certificates');
    }
}
