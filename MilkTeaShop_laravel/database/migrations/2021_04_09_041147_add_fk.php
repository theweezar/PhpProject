<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\DrinkType;
use App\ExtraType;

class AddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This is add foreign key function after created all tables
        // Schema::table('<name>', function(Blueprint $table){
            
        // });

        Schema::table('client_address', function(Blueprint $table){
            $table->foreign('client_id')->references('client_id')->on('client')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('drink_price', function(Blueprint $table){
            $table->foreign('drink_id')->references('drink_id')->on('drink')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('drink', function(Blueprint $table){
            $table->foreign('drink_type_id')->references('drink_type_id')->on('drink_type')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('extra_price', function(Blueprint $table){
            $table->foreign('extra_id')->references('extra_id')->on('extra')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('extra', function(Blueprint $table){
            $table->foreign('extra_type_id')->references('extra_type_id')->on('extra_type')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('client_order', function(Blueprint $table){
            $table->foreign('client_id')->references('client_id')->on('client')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('order_status_id')->references('order_status_id')->on('order_status')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('order_drink', function(Blueprint $table){
            $table->foreign('order_id')->references('order_id')->on('client_order')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('drink_id')->references('drink_id')->on('drink')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('order_extra_topping', function(Blueprint $table){
            $table->foreign('id_for_topping')->references('id_for_topping')->on('order_drink')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('extra_id')->references('extra_id')->on('extra')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('order_extra_food', function(Blueprint $table){
            $table->foreign('order_id')->references('order_id')->on('client_order')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('extra_id')->references('extra_id')->on('extra')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('nofitication', function(Blueprint $table){
            $table->foreign('client_id')->references('client_id')->on('client')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('nofi_type_id')->references('nofi_type_id')->on('nofitication_type')->onUpdate('cascade')
            ->onDelete('cascade');
        });

        Schema::table('drink_love', function(Blueprint $table){
            $table->foreign('client_id')->references('client_id')->on('client')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('drink_id')->references('drink_id')->on('drink')->onUpdate('cascade')
            ->onDelete('cascade');
        });
        
        $this->setup();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    public function setup(){
        try {
            $list_drink_type = array('Milk Tea','Soda','Ice cream','Milk shake');
            foreach ($list_drink_type as $index => $type_name) {
                # code...
                DrinkType::create([
                    'drink_type_name' => $type_name
                ]);
            }

            $list_extra_type = array('Topping','Food');
            foreach ($list_extra_type as $index => $type_name) {
                # code...
                ExtraType::create([
                    'extra_type_name' => $type_name
                ]);
            }
            return "Setup successfully";
        } catch (Exception $e) {
            //throw $th;
            return "Setup failed";
        }
    }
}
