<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra', function (Blueprint $table) {
            $table->id('extra_id')->autoIncrement();
            $table->string('extra_name',50);
            $table->string('extra_image',1024)->nullable();
            $table->string('extra_image_original_name',1024)->nullable();
            $table->unsignedBigInteger('extra_type_id');
            $table->string('extra_describe',1024);
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
        Schema::dropIfExists('extra');
    }
}
