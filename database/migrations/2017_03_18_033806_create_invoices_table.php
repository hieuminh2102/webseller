<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_item')->unsigned();
            $table->foreign('id_item')->references('id')->on('items');
            $table->integer('id_customer')->unsigned();
            $table->foreign('id_customer')->references('id')->on('users');
            $table->integer('id_status')->unsigned();
            $table->foreign('id_status')->references('id')->on('statuses');
            $table->integer('id_shipper')->unsigned();
            $table->foreign('id_shipper')->references('id')->on('users');
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
        Schema::drop('invoices');
    }
}
