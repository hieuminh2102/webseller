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
            $table->integer('studentId');
            $table->integer('companyId');
            $table->integer('season');
            $table->string('system&network_skill',100);
            $table->string('specialityCertificate',100);
            $table->string('softSkill',100);
            $table->string('otherDescription',100);
            $table->string('wishedSkill',100);
            $table->boolean('confirm');
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
