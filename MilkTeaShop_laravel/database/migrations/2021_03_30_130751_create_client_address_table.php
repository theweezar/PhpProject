<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_address', function (Blueprint $table) {
            $table->id('address_id')->autoIncrement();
            $table->unsignedBigInteger('client_id');
            $table->string('address',100);
            $table->dateTime('updated_at');
            $table->dateTime('created_at')->useCurrent();
            // $table->foreign('client_id')->references('client_id')->on('client')->onUpdate('cascade')
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
        Schema::dropIfExists('client_address');
    }
}
