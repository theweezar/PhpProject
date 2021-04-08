<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
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
        $file_original_name = null;

        try {
            // đầu tiên - Lấy file được upload từ client và lưu vào thư mục storage\app\public\img
            // basename là lấy cái file name cuối cùng của mọi đường link
            if ($request->file('drink_image') != null){
                $path = basename($request->file('drink_image')->store('public/img'));
                $file_original_name = $request->file('drink_image')->getClientOriginalName();
            }
            
            // tiếp theo insert table drink trước
            $new_drink = Drink::create([
                "drink_name" => trim($request->input('drink_name')),
                "drink_image_path" => $path,
                "drink_image_original_name" => $file_original_name,
                "drink_type_id" => trim($request->input('drink_type_id')),
                "drink_describe" => trim($request->input('drink_describe')),
                "is_active" => $request->input('is_active') !== null ? true:false
            ]);
            // sau đó lấy cái id mới nhất ra
            // $new_drink_id = Drink::orderBy('created_at','desc')->take(1)->get()[0]['drink_id'];
            
            $list_price = array($request->input('price_size_s'), $request->input('price_size_m'), $request->input('price_size_l'));
            // Thêm giá theo id mới nhất
            foreach ($list_price as $index => $price) {
                DrinkPrice::create([
                    "drink_id" => $new_drink['drink_id'],
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
        $drink = Drink::where('drink_id','=',$drink_id)->get()[0];
        $path = null;
        $file_original_name = null;

        // Kiểm tra xem có ảnh được upload hay không. Nếu có thì store vào
        if ($request->file('drink_image') != null){
            $path = basename($request->file('drink_image')->store('public/img'));
            $file_original_name = $request->file('drink_image')->getClientOriginalName();
            // Kiểm tra xem drink hiện tại có ảnh hay là đang để null. Nếu có thì tìm và xóa
            if ($drink->drink_image_path != null) try {
                Storage::delete('public/img/'.$drink['drink_image_path']);
            } catch (Exception $e) {
                //throw $th;
                return $e->getMessage();
            }
            // Sau hết thì lưu đường link vào database
            $drink->drink_image_path = $path;
            $drink->drink_image_original_name = $file_original_name;
        }

        // update table drink
        $drink->drink_name = trim($request->input('drink_name'));
        $drink->drink_type_id = trim($request->input('drink_type_id'));
        $drink->drink_describe = trim($request->input('drink_describe'));
        $drink->is_active = $request->input('is_active') !== null ? true:false;
        $drink->save();
        // update table drink_price
        $drink_price = DrinkPrice::where('drink_id','=',$drink_id)->get();
        $drink_price[0]->drink_price = $request->input('price_size_s');
        $drink_price[0]->save();
        $drink_price[1]->drink_price = $request->input('price_size_m');
        $drink_price[1]->save();
        $drink_price[2]->drink_price = $request->input('price_size_l');
        $drink_price[2]->save();

        return redirect('/drink');
    }
}
