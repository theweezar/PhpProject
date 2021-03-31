<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Migration;

class DatabaseTestingController extends Controller
{
    public function test(Request $request){
        return Migration::get();
    }
}
