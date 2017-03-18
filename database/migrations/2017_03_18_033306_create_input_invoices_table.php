<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_item')->unsigned();
            $table->foreign('id_item')->references('id')->on('items');
            $table->integer('id_source')->unsigned();
            $table->foreign('id_source')->references('id')->on('sources');
            $table->integer('quatity');
            $table->decimal('unit_cost',10);
            $table->string('date');
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
        Schema::drop('input_invoices');
    }
}
