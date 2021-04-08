<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drink;
use App\DrinkPrice;
use App\DrinkType;
use App\Extra;
use App\ExtraPrice;
use App\ExtraType;

class ApiController extends Controller
{
    public function get_drinks(Request $request, $drink_type_id, $page){
        $drinks = array();
        $fetch_drinks = Drink::join('drink_price','drink.drink_id','=','drink_price.drink_id')
                        // ->join('drink_type','drink.drink_type_id','=','drink_type.drink_type_id')
                        ->orderBy('drink.created_at','desc')
                        ->where('drink.is_active','=','1')
                        ->get();

        // Xử lý giảm những column lặp lại dư thừa để tải ra frontend nhanh hơn
        for($i = 0; $i < count($fetch_drinks); $i += 3){

            $drink_price = array();

            for($j = $i; $j < $i + 3; $j += 1){
                array_push($drink_price, [
                    'drink_size' => $fetch_drinks[$j]['drink_size'],
                    'drink_price' => $fetch_drinks[$j]['drink_price']
                ]);
            }

            array_push($drinks, [
                'drink_id' => $fetch_drinks[$i]['drink_id'],
                'drink_name' => $fetch_drinks[$i]['drink_name'],
                'drink_image_path' => $fetch_drinks[$i]['drink_image_path'],
                'drink_type_id' => $fetch_drinks[$i]['drink_type_id'],
                'drink_describe' => $fetch_drinks[$i]['drink_describe'],
                'price' => $drink_price
            ]);

        }

        return $drinks;
    }

    public function get_food(Request $request){

    }
}
