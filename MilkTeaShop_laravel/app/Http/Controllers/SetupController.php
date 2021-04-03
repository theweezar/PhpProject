<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DrinkType;
use App\ExtraType;

class SetupController extends Controller
{
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
