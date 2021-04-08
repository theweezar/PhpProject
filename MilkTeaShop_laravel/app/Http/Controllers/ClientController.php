<?php

namespace App\Http\Controllers;

use Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{

    public function render_login_form(Request $request){
        return view('login');
    }

    public function render_register_form(Request $request){
        return view('register');
    }

    public function register(Request $request){
        // xác thực các input có đúng hay ko
        $request->validate(array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:client',
            'password' => 'required|alphaNum|min:5|max:32',
            're_password' => 'required|alphaNum|min:5|max:32',
            'phone_number' => 'required|numeric|min:10|unique:client'
        ));
        // return $request;
        if ($request->input('password') != $request->input('re_password')){
            return back()->with('re_password_failed','Wrong Re-password');
        }
        else{
            // xác thực password và re_password hoàn thành thì hash password và lưu vào database
            $hashed_password = Hash::make($request->input('password'));
            $new_client = Client::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => $hashed_password,
                'phone_number' => $request->input('phone_number'),
            ]);
            return $new_client;
        }    
    }

    public function login(Request $request){

        // Xác thực 2 input
        $request->validate(array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:5|max:32'
        ));

        // Xác thực hoàn thành thì truy xuât theo email trước
        $client = Client::where('email','=',$request->input('email'))->first();

        // Nếu có client thì kiểm tra tiếp hash password, nếu sai thì quay lại
        if (!$client){
            return back()->with('status','Wrong password or email');
        }
        else{
            if (Hash::check($request->input('password'), $client['password'])) {
                return back()->with('status','Login successfully');
            }
            else{
                return back()->with('status','Wrong password or email');
            }
        }
    }

    public function logout(Request $request){
        
    }
}
