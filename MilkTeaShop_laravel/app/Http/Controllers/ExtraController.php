<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public function insert(Request $request){
        $path = $request->file('drink_image')->store('avatars');
        return $path;
    }

    public function render(Request $request){
        return view('extra');
    }

    public function render_form(Request $request){
        return view('extraform',[
            "button" => "Submit"
        ]);
    }
}
