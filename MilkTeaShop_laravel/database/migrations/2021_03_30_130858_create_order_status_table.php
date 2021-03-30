<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->id('order_status_id')->autoIncrement();
            $table->string('order_status_name',100);
            $table->dateTime('updated_at');
            $table->dateTime('created_at')->useCurrent();
        });
        // add FK từ client_order vào
        // Schema::table('client_order', function (Blueprint $table){
        //     $table->foreign('order_status_id')->references('order_status_id')->on('order_status')->onUpdate('cascade')
        //     ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_status');
    }
}
