<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyAppreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_appreciations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('User');
            $table->integer('general_appreciation_id');
            $table->foreign('general_appreciation_id')->references('id')->on('generalAppreciation');
            $table->boolean('is_continue_receive');
            $table->string('missing_knownledge');
            $table->string('necessary_knownledge');
            $table->boolean('is_language_necessary');
            $table->boolean('is_language_met');
            $table->string('shortcoming');
            $table->string('advantage');
            $table->string('procedure_improvement');
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
        Schema::drop('company_appreciations');
    }
}
