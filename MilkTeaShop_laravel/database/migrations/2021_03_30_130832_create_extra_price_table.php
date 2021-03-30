<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_price', function (Blueprint $table) {
            $table->unsignedBigInteger('extra_id');
            $table->unsignedBigInteger('extra_price');
            $table->dateTime('updated_at');
            $table->dateTime('created_at')->useCurrent();
            // $table->foreign('extra_id')->references('extra_id')->on('extra')->onUpdate('cascade')
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
        Schema::dropIfExists('extra_price');
    }
}
