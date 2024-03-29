<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drink', function (Blueprint $table) {
            $table->id('drink_id')->autoIncrement();
            $table->string('drink_name',50);
            $table->string('drink_image_path',1024)->nullable();
            $table->string('drink_image_original_name',1024)->nullable();
            $table->unsignedBigInteger('drink_type_id');
            $table->string('drink_describe',1024);
            $table->boolean('is_active');
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
        Schema::dropIfExists('drink');
    }
}
