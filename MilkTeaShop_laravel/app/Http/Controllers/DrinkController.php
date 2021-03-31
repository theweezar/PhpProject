<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function insert(){
        
    }

    public function render(){
        return view('drink');
    }

    public function render_form(){
        return view('drinkform');
    }
}
