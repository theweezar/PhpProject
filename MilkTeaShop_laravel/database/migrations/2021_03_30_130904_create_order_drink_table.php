<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDrinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_drink', function (Blueprint $table) {
            $table->id('id_for_topping')->autoIncrement();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('drink_id');
            $table->integer('drink_size');
            $table->unsignedBigInteger('drink_price');
            $table->dateTime('updated_at');
            $table->dateTime('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_drink');
    }
}
