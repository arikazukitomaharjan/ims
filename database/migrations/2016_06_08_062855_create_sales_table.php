<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales',function (Blueprint $table){
            $table->increments('id');
            $table->date('sale_date');
            $table->dateTime('sale_datetime');
            $table->float('cost_price');
            $table->float('sale_price');
            $table->integer('quantity');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->integer('sold_by')->unsigned();
            $table->foreign('sold_by')->references('id')->on('users');
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
        Schema::drop('sales');
    }
}
