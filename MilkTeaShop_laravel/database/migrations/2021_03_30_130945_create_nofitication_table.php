<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNofiticationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nofitication', function (Blueprint $table) {
            $table->id('nofi_id')->autoIncrement();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('nofi_type_id');
            $table->string('nofi_content');
            $table->boolean('is_read');
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
        Schema::dropIfExists('nofitication');
    }
}
