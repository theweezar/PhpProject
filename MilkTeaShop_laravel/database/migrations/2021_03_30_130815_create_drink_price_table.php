<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinkPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drink_price', function (Blueprint $table) {
            $table->unsignedBigInteger('drink_id');
            $table->integer('drink_size');
            $table->unsignedBigInteger('drink_price')->nullable();
            $table->dateTime('updated_at');
            $table->dateTime('created_at')->useCurrent();
            // $table->foreign('drink_id')->references('drink_id')->on('drink')->onUpdate('cascade')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drink_price');
    }
}
