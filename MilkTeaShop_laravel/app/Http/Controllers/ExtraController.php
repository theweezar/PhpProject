<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Extra;
use App\ExtraType;
use App\ExtraPrice;

class ExtraController extends Controller
{

    public function render(Request $request){
        $extras = Extra::orderBy('created_at','desc')->get();
        return view('extra',[
            'extras' => $extras
        ]);
    }
    
    public function render_form_insert(Request $request){
        $extra_type = ExtraType::get();
        return view('extraform',[
            'button' => 'Submit',
            'edit_form' => false,
            'extra_type' => $extra_type
        ]);
    }

    public function insert(Request $request){
        // return $request;
        $alert = null;
        $path = null;
        $file_original_name = null;
        
        try {
            if ($request->file('extra_image') != null){
                $path = basename($request->file('extra_image')->store('public/img'));
                $file_original_name = $request->file('extra_image')->getClientOriginalName();
            }

            $new_extra = Extra::create([
                'extra_name' => $request->input('extra_name'),
                'extra_image_path' => $path,
                'extra_image_original_name' => $file_original_name,
                'extra_type_id' => $request->input('extra_type_id'),
                'extra_describe' => $request->input('extra_describe'),
                'is_active' => $request->input('is_active') !== null ? true:false
            ]);

            ExtraPrice::create([
                'extra_id' => $new_extra['extra_id'],
                'extra_price' => $request->input('extra_price')
            ]);
            $alert = "Insert successfully. Image path: ".$path;
        } catch (Exception $e) {
            $alert = "Insert failed";
        }

        return redirect('/extra/extraform')->with('status', $alert);
    }

    public function render_form_update(Request $request, $extra_id){
        $extra = Extra::where('extra_id','=',$extra_id)->get();
        $extra_price = ExtraPrice::where('extra_id','=',$extra_id)->get();
        $extra_type = ExtraType::get();

        if (count($extra) == 0) return redirect('/extra')->with('status', 'Drink not found');
        else return view('extraform',[
            "button" => "Update",
            "edit_form" => true,
            "extra" => $extra[0],
            "extra_price" => $extra_price,
            "extra_type" => $extra_type
        ]);
    }

    public function update(Request $request){
        return $request;
    }
}
