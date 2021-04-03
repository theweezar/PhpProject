<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drink;
use App\DrinkPrice;
use App\DrinkType;

class DrinkController extends Controller
{
    
    public function render(Request $request){
        $drinks = Drink::orderBy('created_at','desc')->get();
        return view('drink',[
            "drinks" => $drinks
        ]);
    }
    
    public function render_form_insert(Request $request){
        $drink_type = DrinkType::get();
        return view('drinkform',[
            "button" => "Submit",
            "edit_form" => false,
            "drink_type" => $drink_type
        ]);
    }

    public function insert(Request $request){
        // return $request;
        $alert = null;
        $path = null;

        try {
            // đầu tiên - Lấy file được upload từ client và lưu vào thư mục storage\app\public\img
            // basename là lấy cái file name cuối cùng của mọi đường link
            if ($request->file('drink_image') != null)
                $path = basename($request->file('drink_image')->store('public/img'));
            
            // tiếp theo insert table drink trước
            Drink::create([
                "drink_name" => trim($request->input('drink_name')),
                "drink_image" => $path,
                "drink_type_id" => trim($request->input('drink_type_id')),
                "drink_describe" => trim($request->input('drink_describe')),
                "is_active" => $request->input('is_active') !== null ? true:false
            ]);
            // sau đó lấy cái id mới nhất ra
            $new_drink_id = Drink::orderBy('created_at','desc')->take(1)->get()[0]['drink_id'];
            
            $list_price = array($request->input('price_size_s'), $request->input('price_size_m'), $request->input('price_size_l'));
            // Thêm giá theo id mới nhất
            foreach ($list_price as $index => $price) {
                DrinkPrice::create([
                    "drink_id" => $new_drink_id,
                    "drink_size" => $index + 1,
                    "drink_price" => $price
                ]);
            }

            $alert = "Insert successfully. Image path: ".$path;
        } catch (Exception $e) {
            $alert = "Insert failed";
        }
        
        // redirect kèm theo 1 session status để thông báo, trong file view nó chính là session('status')
        return redirect('/drink/drinkform')->with('status', $alert);
    }

    public function render_form_update(Request $request, $drink_id){
        $drink = Drink::where('drink_id','=',$drink_id)->get();
        $drink_price = DrinkPrice::where('drink_id','=',$drink_id)->get();
        $drink_type = DrinkType::get();
        
        if (count($drink) == 0) return redirect('/drink')->with('status', 'Drink not found');
        else return view('drinkform',[
            "button" => "Update",
            "edit_form" => true,
            "drink" => $drink[0],
            "drink_price" => $drink_price,
            "drink_type" => $drink_type
        ]);
    }
    
    public function update(Request $request, $drink_id){
        // kiểm tra xem ảnh mới upload lên có phải ảnh mới ko hay là ảnh được giữ nguyên
    }
}
