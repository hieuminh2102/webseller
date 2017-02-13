<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('User');
            $table->integer('company_id');
            $table->foreign('company_id')->references('id')->on('company');
            $table->integer('season');
            $table->foreign('season')->references('id')->on('season');
            $table->string('system&network_skill',100);
            $table->string('specialityCertificate',100);
            $table->string('softSkill',100);
            $table->string('otherDescription',100);
            $table->string('wishedSkill',100);
            $table->boolean('is_confirm');
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
        Schema::drop('registrations');
    }
}
