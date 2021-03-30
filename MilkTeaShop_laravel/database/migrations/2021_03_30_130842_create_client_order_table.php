<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_order', function (Blueprint $table) {
            $table->id('order_id')->autoIncrement();
            $table->unsignedBigInteger('client_id');
            $table->string('address',1024);
            $table->string('note',1024);
            $table->boolean('is_paid');
            // FK có thể được add ở trong file migration khác
            $table->unsignedBigInteger('order_status_id');
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
        Schema::dropIfExists('client_order');
    }
}
