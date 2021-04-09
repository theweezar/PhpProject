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
    public function get_drinks(Request $request, $drink_type_id, $page, $table, $by, $mode){
        // api/drink/type/1/page/1/ordertable/drink/by/created_at/mode/desc
        $drinks = array();

        $fetch_drinks = Drink::join('drink_price','drink.drink_id','=','drink_price.drink_id')
                        ->join('drink_type','drink.drink_type_id','=','drink_type.drink_type_id')
                        ->orderBy($table.'.'.$by,$mode)
                        ->where('drink.is_active','=','1')
                        ->where('drink.drink_type_id','=',$drink_type_id)
                        ->offset(($page - 1) * 2 * 3)
                        ->limit(2 * 3)
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

        return response($drinks, 200);
    }

    public function get_extra(Request $request, $extra_type_id){
        $extras = Extra::join('extra_price','extra.extra_id','=','extra_price.extra_id')
                    ->join('extra_type','extra.extra_type_id','=','extra_type.extra_type_id')
                    ->orderBy('extra.created_at','desc')
                    ->where('extra.is_active','=','1')
                    ->where('extra.extra_type_id','=',$extra_type_id)
                    ->get();
        return $extras;
    }
}
